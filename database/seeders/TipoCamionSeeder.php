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
    }
}
