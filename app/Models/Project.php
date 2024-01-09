<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function customer()
    {
        return $this->belongsTo(Project::class);
    }
}