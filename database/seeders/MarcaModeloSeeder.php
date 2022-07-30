<?php

namespace Database\Seeders;

use App\Models\Marca;
use App\Models\Modelo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MarcaModeloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $marca1 = Marca::create(['nombre' => 'Chevrolet', 'status' => true]);
        $marca2 = Marca::create(['nombre' => 'Kenworth', 'status' => true]);
        $marca3 = Marca::create(['nombre' => 'HINO', 'status' => true]);
        $marca4 = Marca::create(['nombre' => 'JAC', 'status' => true]);
        $marca5 = Marca::create(['nombre' => 'Fotón', 'status' => true]);
        $marca6 = Marca::create(['nombre' => 'International', 'status' => true]);
        $marca7 = Marca::create(['nombre' => 'Freightliner', 'status' => true]);
        $marca8 = Marca::create(['nombre' => 'Volkswagen', 'status' => true]);
        $marca9 = Marca::create(['nombre' => 'Mercedez Benz', 'status' => true]);
        $marca10 = Marca::create(['nombre' => 'Mitsubishi Fuso', 'status' => true]);
        $marca11 = Marca::create(['nombre' => 'JMC', 'status' => true]);
        $marca12 = Marca::create(['nombre' => 'Stark', 'status' => true]);
        $marca13 = Marca::create(['nombre' => 'Sinotruk', 'status' => true]);
        $marca14 = Marca::create(['nombre' => 'Yuejin - Naveco', 'status' => true]);
        $marca15 = Marca::create(['nombre' => 'Mack', 'status' => true]);
        $marca16 = Marca::create(['nombre' => 'Daf', 'status' => true]);
        $marca17 = Marca::create(['nombre' => 'Scania', 'status' => true]);
        $marca18 = Marca::create(['nombre' => 'Iveco', 'status' => true]);
        $marca19 = Marca::create(['nombre' => 'Hyundai', 'status' => true]);
        $marca20 = Marca::create(['nombre' => 'Faw', 'status' => true]);
        $marca21 = Marca::create(['nombre' => 'Sterling', 'status' => true]);
        $marca22 = Marca::create(['nombre' => 'Otro', 'status' => true]);

        //Modelos Chevrolet
/*        Modelo::create(['nombre' => 'NHR versión Standar', 'marca_id' => $marca1->id, 'status' => true]);
        Modelo::create(['nombre' => 'NHR versión Aire Acondicionado', 'marca_id' => $marca1->id, 'status' => true]);
        Modelo::create(['nombre' => 'NHR versión Airbag', 'marca_id' => $marca1->id, 'status' => true]);
        Modelo::create(['nombre' => 'NKR', 'marca_id' => $marca1->id, 'status' => true]);
        Modelo::create(['nombre' => 'NPR', 'marca_id' => $marca1->id, 'status' => true]);
        Modelo::create(['nombre' => 'NPS', 'marca_id' => $marca1->id, 'status' => true]);
        Modelo::create(['nombre' => 'NQR', 'marca_id' => $marca1->id, 'status' => true]);
        Modelo::create(['nombre' => 'NRR', 'marca_id' => $marca1->id, 'status' => true]);*/
    }
}
