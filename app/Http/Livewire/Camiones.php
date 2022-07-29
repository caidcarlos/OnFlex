<?php

namespace App\Http\Livewire;

use App\Models\Camion;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\TipoCamion;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Notification;
use App\Notifications\RegistroCamion;
use App\Notifications\BorradoCamion;

class Camiones extends Component
{
    public $modalCreate = false, $modalUpdate = false, $modalConfirm = false;
    public $placa, $anno, $peso_soporte, $tipo_camion_id, $camion_id;
    public $selectedModelo = null, $selectedMarca = null;
    public $marca, $modelo;
    public $modelos;
    protected $rules = [
        'placa' => 'required',
        'peso_soporte' => 'required',
        'anno' => 'required|numeric|min:2000',
//        'marca_id' => 'required',
        'selectedModelo' => 'required',
        'tipo_camion_id' => 'required',
    ];

    public function render()
    {
        $camiones = Camion::join('tipos_camion', 'tipos_camion.id', '=', 'camiones.tipo_camion_id')
        ->join('modelos', 'modelos.id', '=', 'camiones.modelo_id')
        ->join('marcas', 'modelos.marca_id', '=', 'marcas.id')
        ->select(
            'camiones.id AS id',
            'camiones.placa AS placa',
            'camiones.anno AS anno',
            'camiones.peso_soporte AS peso_soporte',
            'modelos.nombre AS modelo',
            'marcas.nombre AS marca',
            'tipos_camion.nombre AS tipo_camion',
        )
        ->where('camiones.transportista_id', '=', Auth::user()->id)
        ->get();
        $marcas = Marca::where('status', true)->get();
        $tipoCamion = TipoCamion::where('status', true)->get();
        return view('livewire.camiones.camiones', compact('camiones', 'marcas', 'tipoCamion'));
    }

    public function updatedselectedMarca($marca_id){
        $this->modelos = Modelo::where('marca_id', '=', $marca_id)->get();
    }

    public function registrar(){
        $this->limpiarCampos();
        $this->abrirModalCreate();
    }

    public function guardar(){
        $this->validate();
        $camion = Camion::create([
            'placa' => $this->placa,
            'anno' => $this->anno,
            'peso_soporte' => $this->peso_soporte,
            'modelo_id' => $this->selectedModelo,
            'tipo_camion_id' => $this->tipo_camion_id,
            'transportista_id' => Auth::user()->id,
        ]);
        Notification::send(Auth::user(), new RegistroCamion($camion));
        $this->cerrarModalCreate();
    }

    public function editar($camion_id){
        $this->limpiarCampos();
        $camion = Camion::find($camion_id);
        $this->camion_id = $camion->id;
        $this->placa = $camion->placa;
        $this->peso_soporte = $camion->peso_soporte;
        $this->anno = $camion->anno;
        $this->tipo_camion_id = $camion->tipo_camion_id;
        $this->selectedModelo = $camion->modelo_id;
        $modelo = Modelo::find($this->selectedModelo);
        $this->selectedMarca = $modelo->marca_id;
        $this->abrirModalUpdate();
    }

    public function modificar($camion_id){
        $this->validate();
        Camion::updateOrCreate(['id' =>$camion_id],[
            'placa' => $this->placa,
            'anno' => $this->anno,
            'peso_soporte' => $this->peso_soporte,
            'modelo_id' => $this->selectedModelo,
            'tipo_camion_id' => $this->tipo_camion_id,
        ]);
        $this->cerrarModalUpdate();
    }

    public function eliminar($camion_id){
        $camion = Camion::find($camion_id);
        $this->camion_id = $camion->id;
        $this->placa = $camion->placa;
        $this->selectedModelo = $camion->modelo_id;
        $modelo = Modelo::find($this->selectedModelo);
        $this->modelo = $modelo->nombre;
        $marca = Marca::find($modelo->marca_id);
        $this->marca = $marca->nombre;
        $this->abrirModalConfirm();
    }

    public function borrar($camion_id){
        $camion = Camion::find($camion_id);
        Notification::send(Auth::user(), new BorradoCamion($camion));
        $camion->delete();
        $this->cerrarModalConfirm();
    }

    public function abrirModalCreate(){
        $this->modalCreate = true;
    }

    public function cerrarModalCreate(){
        $this->modalCreate = false;
    }

    public function abrirModalUpdate(){
        $this->modalUpdate = true;
    }

    public function cerrarModalUpdate(){
        $this->modalUpdate = false;
    }

    public function abrirModalConfirm(){
        $this->modalConfirm = true;
    }

    public function cerrarModalConfirm(){
        $this->modalConfirm = false;
    }

    public function limpiarCampos(){
        $this->placa = '';
        $this->anno = '';
        $this->peso_soporte = '';
        $this->selectedModelo = '';
        $this->selectedMarca = '';
        $this->tipo_camion_id = '';
    }

}
