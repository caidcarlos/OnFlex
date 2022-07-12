<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class usuario_roles_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create(['name' => 'Administrador']);
        $role1 = Role::create(['name' => 'Empresa']);
        $role1 = Role::create(['name' => 'Transportista']);

        User::create([
            'nombre' => 'Administrador',
            'tipo_usuario' => '1',
            'email' => 'admin@onflex.test',
            'password' => Hash::make('123oNFleX45.*'),
        ])->assignRole($role1);
    }
}
