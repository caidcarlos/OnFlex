<?php

namespace Database\Seeders;

use App\Models\TipoCamion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoCamionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoCamion::create(['nombre' => 'Tracto Mula', 'status' => true]);
        TipoCamion::create(['nombre' => 'Patineta', 'status' => true]);
        TipoCamion::create(['nombre' => 'Turbo', 'status' => true]);
        TipoCamion::create(['nombre' => 'Sencillo', 'status' => true]);
        TipoCamion::create(['nombre' => 'Doble Troque', 'status' => true]);
        TipoCamion::create(['nombre' => 'Cuatro Manos', 'status' => true]);
        TipoCamion::create(['nombre' => 'Mini Mula', 'status' => true]);
        TipoCamion::create(['nombre' => 'Tracto Camión', 'status' => true]);
        TipoCamion::create(['nombre' => 'Consolidado', 'status' => true]);
        TipoCamion::create(['nombre' => 'Otro', 'status' => true]);
    }
}
