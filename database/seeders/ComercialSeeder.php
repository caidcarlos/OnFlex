<?php

namespace Database\Seeders;

use App\Models\Comercial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComercialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Comercial::create(['nombre' => 'Alba', 'apellidos' => 'Aredondo', 'status' => true]);
        Comercial::create(['nombre' => 'Valentina', 'apellidos' => 'Parra', 'status' => true]);
        Comercial::create(['nombre' => 'Carolina', 'apellidos' => 'Duarte', 'status' => true]);
        Comercial::create(['nombre' => 'Juan José', 'apellidos' => 'García', 'status' => true]);
        Comercial::create(['nombre' => 'Julio', 'apellidos' => 'Rodriguez', 'status' => true]);
        Comercial::create(['nombre' => 'Daniel', 'apellidos' => 'Restrepo', 'status' => true]);
        Comercial::create(['nombre' => 'Viviana', 'apellidos' => 'Díaz', 'status' => true]);
    }
}
