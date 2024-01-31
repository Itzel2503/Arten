<?php

namespace App\Http\Livewire\Projects;

use App\Models\Project;
use App\Models\Report;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class TableReports extends Component
{
    use WithFileUploads;

    public $listeners = ['reloadPage' => 'reloadPage'];
    // modal
    public $modalShow = false, $modalEdit = false, $modalDelete = false;
    public $showReport = false, $showEdit = false, $showDelete = false;

    // table, action's reports
    public $leader = false;
    public $search, $project, $reportShow, $reportEdit, $reportDelete;
    public $perPage = '10';
    public $selectedState = '';
    public $rules = [], $usersFiltered = [];

    // inputs
    public $name, $type, $priority, $customer, $file, $comment;

    public function render()
    {
        $this->dispatchBrowserEvent('reloadModalAfterDelay');

        $user = Auth::user();
        $allUsers = User::all();

        $reports = Report::where('project_id', $this->project->id)
            ->where(function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%')
                    ->orWhere('comment', 'like', '%' . $this->search . '%')
                    ->orWhere('state', 'like', '%' . $this->search . '%')
                    ->orWhereHas('delegate', function ($subQuery) {
                        $subQuery->where('name', 'like', '%' . $this->search . '%');
                    });
                // Buscar por 'reincidencia' para seleccionar reportes con 'repeat' en true
                if (strtolower($this->search) === 'reincidencia' || strtolower($this->search) === 'Reincidencia') {
                    $query->orWhere('repeat', true);
                }
            })
            ->when($this->selectedState, function ($query) {
                $query->where('state', $this->selectedState);
            })
            ->with(['user', 'delegate'])
            ->paginate($this->perPage);

        // REICIDENCIAS
        $reincidenceCounters = [];

        // LEADER TABLE
        foreach ($this->project->users as $projectUser) {
            if ($projectUser->id === $user->id && $projectUser->pivot->leader) {
                $this->leader = true;
                break;
            }
        }
        
        // ADD ATRIBUTES
        foreach ($reports as $report) {
            // ACTIONS
            $report->filteredActions = $this->getFilteredActions($report->state);
            // DELEGATE
            $report->usersFiltered = $allUsers->reject(function ($user) use ($report) {
                return $user->id === $report->delegate_id;
            })->values();
            // PROGRESS
            if ($report->progress && $report->updated_at) {
                $progress = Carbon::parse($report->progress);
                $updated_at = Carbon::parse($report->updated_at);
                $diff = $progress->diff($updated_at);

                $units = [
                    'año' => $diff->y,
                    'mes' => $diff->m,
                    'semana' => floor($diff->days / 7),
                    'dia' => $diff->d % 7, // Días restantes después de calcular las semanas
                    'hora' => $diff->h,
                    'minuto' => $diff->i,
                    'segundo' => $diff->s,
                ];

                $timeDifference = '';
                foreach ($units as $unit => $value) {
                    if ($value > 0) {
                        $timeDifference = $value . ' ' . $unit . ($value > 1 ? 's' : '');
                        break;
                    }
                }

                $report->timeDifference = $timeDifference;
            } else {
                $report->timeDifference = null;
            }
            // REICIDENCIAS
            if ($report->repeat && isset($report->report_id)) {
                // Inicializar el contador para este report_id si aún no se ha hecho
                if (!isset($reincidenceCounters[$report->report_id])) {
                    $reincidenceCounters[$report->report_id] = 0;
                }
                // Incrementar el contador para este report_id y asignarlo al reporte
                $reincidenceCounters[$report->report_id]++;
                $report->reincidenceNumber = $reincidenceCounters[$report->report_id];
            } else {
                $report->reincidenceNumber = null;
            }
        }

        return view('livewire.projects.table-reports', [
            'reports' => $reports,
        ]);
    }
    // ACTIONS
    public function create($project_id)
    {
        return redirect()->route('projects.reports.create', ['project' => $project_id]);
    }

    public function updateState($id, $state)
    {
        $report = Report::find($id);

        if ($report) {
            $report->state = $state;

            if ($state == 'Proceso' || $state == 'Conflicto') {
                $report->progress = Carbon::now();
            }

            if ($state == 'Resuelto') {
                $report->resolved_id = Auth::id();
            }

            $report->save();

            // Emitir un evento de navegador
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',
                'title' => 'Estado actualizado',
            ]);
        }
    }

    public function updateDelegate($id, $delegate)
    {
        $report = Report::find($id);
        if ($report) {
            $report->delegate_id = $delegate;
            $report->save();

            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',
                'title' => 'Delegado actualizado',
            ]);
        }
    }

    public function update($id, $project_id)
    {
        $report = Report::find($id);
        $project = Project::find($project_id);

        if ($report) {
            if ($this->file) {
                $filePath = now()->format('Y') . '/' . now()->format('F') . '/' . $project->customer->name . '/' . $project->name;
                $fileName = $this->file->getClientOriginalName();

                $fullNewFilePath = $filePath . '/' . $fileName;

                // Verificar y eliminar el archivo anterior si existe y coincide con la nueva ruta
                if ($report->content && Storage::disk('reports')->exists($report->content)) {
                    $existingFilePath = pathinfo($report->content, PATHINFO_DIRNAME);

                    if ($existingFilePath == $filePath) {
                        Storage::disk('reports')->delete($report->content);
                    }
                }
                // Guardar el archivo en el disco 'reports'
                $this->file->storeAs($filePath, $fileName, 'reports');

                $extension = $this->file->extension();
                $extensionesImagen = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg', 'webp'];
                $extensionesVideo = ['mp4', 'mov', 'wmv', 'avi', 'avchd', 'flv', 'mkv'];

                if (in_array($extension, $extensionesImagen)) {
                    $report->image = true;
                    $report->video = false;
                } elseif (in_array($extension, $extensionesVideo)) {
                    $report->image = false;
                    $report->video = true;
                } else {
                    $report->image = false;
                    $report->video = false;
                }

                $report->content = $fullNewFilePath;
            }
            
            $report->comment = $this->comment;
            $report->save();

            
            $this->modalEdit = false;

            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',
                'title' => 'Guardado exitoso',
            ]);
        }
        
    }

    public function destroy($id)
    {
        $report = Report::find($id);

        if ($report) {
            if ($report->content) {
                $contentPath = 'reportes/' . $report->content;
                $fullPath = public_path($contentPath);
                if (File::exists($fullPath)) {
                    File::delete($fullPath);
                }
            }
            $report->delete();
        }

        $this->modalDelete = false;
        $this->emit('reloadPage');
    }
    // INFO MODAL
    public function showReport($id)
    {
        $this->showReport = true;

        if ($this->modalShow == true) {
            $this->modalShow = false;
        } else {
            $this->modalShow = true;
        }

        $this->reportShow = Report::find($id);
        $user = Auth::user();

        if ($this->reportShow && $this->reportShow->delegate_id == $user->id && $this->reportShow->state == 'Abierto') {
            $this->reportShow->state = 'Proceso';
            $this->reportShow->progress = Carbon::now();
            $this->reportShow->save();

            // Emitir un evento de navegador
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',
                'title' => 'Estado actualizado',
            ]);
        }
    }

    public function showEdit($id)
    {
        $this->showEdit = true;

        if ($this->modalEdit == true) {
            $this->modalEdit = false;
        } else {
            $this->modalEdit = true;
        }

        $this->reportEdit = Report::find($id);
        $this->comment = $this->reportEdit->comment;
    }

    // INFO MODAL
    public function showDelete($id)
    {
        $this->showDelete = true;

        if ($this->modalDelete == true) {
            $this->modalDelete = false;
        } else {
            $this->modalDelete = true;
        }

        $this->reportDelete = Report::find($id);
    }
    // MODAL
    public function modalShow()
    {
        if ($this->modalShow == true) {
            $this->modalShow = false;
        } else {
            $this->modalShow = true;
        }
    }

    public function modalEdit()
    {
        $this->showEdit = false;

        if ($this->modalEdit == true) {
            $this->modalEdit = false;
        } else {
            $this->modalEdit = true;
        }
    }

    public function modalDelete()
    {
        if ($this->modalDelete == true) {
            $this->modalDelete = false;
        } else {
            $this->modalDelete = true;
        }
    }
    // EXTRAS
    public function reportRepeat($project_id, $report_id)
    {
        return redirect()->route('projects.reports.show', ['project' => $project_id, 'report' => $report_id]);
    }

    protected function getFilteredActions($currentState)
    {
        $actions = ['Abierto', 'Proceso', 'Resuelto', 'Conflicto'];

        if ($currentState == 'Conflicto') {
            return ['Resuelto'];
        }
    
        if ($currentState == 'Resuelto') {
            return [];
        }
    
        if ($currentState == 'Proceso') {
            return array_filter($actions, function ($action) {
                return !in_array($action, ['Abierto', 'Proceso']);
            });
        }
    
        // En cualquier otro caso, elimina el estado actual del arreglo
        return array_filter($actions, function ($action) use ($currentState) {
            return $action != $currentState;
        });
    }

    public function reloadPage()
    {
        $this->reset();
        $this->render();
    }
}