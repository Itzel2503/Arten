<?php

namespace App\Http\Livewire\Permits;

use App\Models\HomeOffice;
use App\Models\LeaveAbsence;
use App\Models\OutOfOfficeHours;
use App\Models\Permit;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ModalCreate extends Component
{
    public $date;
    //PERMIT1
    public $reason, $activities, $delegate_activities;

    public function render()
    {
        $permits = Permit::all();
            
        // PERMIT1 Y PERMIT2
        $motiveOptions = [
            HomeOffice::FAMILY => 'Situación familiar',
            HomeOffice::PERSONAL => 'Situación personal',
            HomeOffice::DISEASE => 'Enfermedad',
            HomeOffice::MEDICAL => 'Trámites médicos',
            HomeOffice::LEGAL => 'Trámites legales',
            HomeOffice::OTHER => 'Otro',
        ];

        // PERMIT2
        $typeHours = [
            OutOfOfficeHours::LATE => 'Llegada tarde',
            OutOfOfficeHours::EARLY => 'Salida tamprano',
            OutOfOfficeHours::BETWEEN => 'Horas entre turno',
        ];

        // PERMIT3
        $salaryPermits = [
            LeaveAbsence::WITH_PAY => 'Con goce de sueldo (Se descuenta un día de vacaciones o días autorizados)',
            LeaveAbsence::WITHOUT_PAY => 'Sin goce de sueldo',
        ];
        
        $users = User::all();
        foreach ($users as $key => $user) {
            if ($user->id === Auth::user()->id) {
                unset($users[$key]);
            }
        }

        $takeHours = [];
        for ($i=0; $i < 7; $i++) { 
            $takeHours[$i] = $i + 1;
        }
        
        return view('livewire.permits.modal-create', [
            'permits' => $permits,
            'motiveOptions' => $motiveOptions,
            'typeHours' => $typeHours,
            'salaryPermits' => $salaryPermits,
            'users' => $users,
            'takeHours' => $takeHours,
        ]);
    }

    public function createPermit1()
    {
        dd($this);
    }
}