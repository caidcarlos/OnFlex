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
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class Camiones extends Component
{
    public Camion $camion;
    public $modalCreate = false, $modalUpdate = false, $modalConfirm = false;
    public $placa, $anno, $peso_soporte, $tipo_camion_id, $modelo, $marca, $camion_id;
    public $modelos;

    protected $rules = [
            'placa' => 'required|unique:camiones,placa',
            'peso_soporte' => 'required|numeric|min:10|max:35',
            'anno' => 'required|numeric|min:2000',
            'marca' => 'required',
            'modelo' => 'required|max:10',
            'tipo_camion_id' => 'required',
        ];

    protected $validationAttributes = [
        'anno' => 'año',
        'tipo_camion_id' => 'tipo de camión',
        'peso_soporte' => 'peso de soporte',
    ];

    public function render()
    {
        $camiones = Camion::join('tipos_camion', 'tipos_camion.id', '=', 'camiones.tipo_camion_id')
        ->join('marcas', 'camiones.marca_id', '=', 'marcas.id')
        ->select(
            'camiones.id AS id',
            'camiones.placa AS placa',
            'camiones.anno AS anno',
            'camiones.peso_soporte AS peso_soporte',
            'camiones.modelo AS modelo',
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
            'marca_id' => $this->marca,
            'modelo' => $this->modelo,
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
        $this->modelo = $camion->modelo;
        $marca = Marca::find($camion->marca_id);
        $this->marca = $marca->id;
        $this->abrirModalUpdate();
    }

    public function modificar($camion_id){
        $camion = Camion::findOrFail($camion_id);
        $validateData = $this->validate([
            'placa' => 'required',
            'peso_soporte' => 'required|numeric|min:10|max:35',
            'anno' => 'required|numeric|min:2000',
            'marca' => 'required',
            'modelo' => 'required|max:10',
            'tipo_camion_id' => 'required',
        ]);
        $camion->placa = $this->placa;
        $camion->anno = $this->anno;
        $camion->peso_soporte = $this->peso_soporte;
        $camion->marca_id = $this->marca;
        $camion->modelo = $this->modelo;
        $camion->tipo_camion_id = $this->tipo_camion_id;
        $camion->save($validateData);
        $this->cerrarModalUpdate();
    }

    public function eliminar($camion_id){
        $camion = Camion::find($camion_id);
        $this->camion_id = $camion->id;
        $this->placa = $camion->placa;
        $this->modelo = $camion->modelo;
        $marca = Marca::find($camion->marca_id);
        $this->marca = $marca->nombre;
        $this->abrirModalConfirm();
    }

    public function borrar($camion_id){
        $camion = Camion::find($camion_id);
        $camion->delete();
        Notification::send(Auth::user(), new BorradoCamion($camion));
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
        $this->marca = '';
        $this->modelo = '';
        $this->tipo_camion_id = '';
    }

}
