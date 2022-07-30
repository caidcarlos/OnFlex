<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(usuario_roles_seeder::class);
        $this->call(TipoCamionSeeder::class);
        $this->call(ciuadesSeeder::class);
        $this->call(MarcaModeloSeeder::class);
    }
}
