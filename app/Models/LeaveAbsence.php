<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveAbsence extends Model
{
    use HasFactory;

    public function userPermission()
    {
        return $this->morphOne(UserPermission::class, 'type');
    }
}
