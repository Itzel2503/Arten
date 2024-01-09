<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\Permit;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Area::create([
            'name' => 'Administrador'
        ]);
        Area::create([
            'name' => 'Administración'
        ]);
        Area::create([
            'name' => 'Programación'
        ]);
        Area::create([
            'name' => 'Diseño'
        ]);
        Area::create([
            'name' => 'Soporte'
        ]);

        Permit::create([
            'name' => 'Home Office'
        ]);
        Permit::create([
            'name' => 'Horas fuera de oficina'
        ]);
        Permit::create([
            'name' => 'Permiso de ausencia'
        ]);
        Permit::create([
            'name' => 'Vacaciones'
        ]);
        Permit::create([
            'name' => 'Tiempo extra'
        ]);

        User::create([
            'name' => 'Super admin',
            'lastname' => 'Kircof',
            'email' => 'admin@kircof.com',
            'password' => Hash::make('Arten.123!'),
            'type_user' => '1',
            'date_birthday' => Carbon::now(),
            'area_id' => '1',
        ]);
        User::create([
            'name' => 'Administrador',
            'lastname' => 'Arten',
            'email' => 'admin@arten.com',
            'password' => Hash::make('Arten.123!'),
            'type_user' => '1',
            'date_birthday' => Carbon::now(),
            'area_id' => '1',
        ]);
        User::create([
            'name' => 'Itzel',
            'lastname' => 'De La Cruz',
            'email' => 'itzel@artendigital.mx',
            'password' => Hash::make('Arten.123!'),
            'type_user' => '2',
            'date_birthday' => Carbon::now(),
            'area_id' => '3',
        ]);
        User::create([
            'name' => 'Jonathan',
            'lastname' => 'Quistiano',
            'email' => 'jonathan@artendigital.mx',
            'password' => Hash::make('Arten.123!'),
            'type_user' => '2',
            'date_birthday' => Carbon::now(),
            'area_id' => '3',
        ]);
    }
}