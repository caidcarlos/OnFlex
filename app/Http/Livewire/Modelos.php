<?php

namespace App\Http\Livewire;

use App\Models\Marca;
use App\Models\Modelo;
use Livewire\Component;
use Livewire\WithPagination;

class Modelos extends Component
{
    use WithPagination;
    public $pivot = 1, $cantidad = 10, $busqueda;
    public $nombre, $status, $marca_id, $id_modelo;
    public $modalCreate = false, $modalUpdate = false, $modalConfirm = false;
    protected $rules = [
        'nombre' => 'required|max:70',
        'marca_id' => 'required',
    ];
    public function updatingBusqueda(){
        $this->resetPage();
    }

    public function render()
    {
        if($this->pivot == 1){
            $modelos = Modelo::join('marcas', 'marcas.id', '=', 'modelos.marca_id')
                ->select(
                    'modelos.nombre AS nombre',
                    'modelos.status AS status',
                    'modelos.id AS id',
                    'marcas.nombre AS marca',
                )
                ->where('modelos.nombre', 'LIKE', '%'.$this->busqueda.'%')
                ->orWhere('marcas.nombre', 'LIKE', '%'.$this->busqueda.'%')
                ->orderBy('modelos.id', 'desc')
                ->paginate($this->cantidad);
        }
        if($this->pivot == 2){
            $modelos = Modelo::join('marcas', 'marcas.id', '=', 'modelos.marca_id')
                ->select(
                    'modelos.nombre AS nombre',
                    'modelos.status AS status',
                    'modelos.id AS id',
                    'marcas.nombre AS marca',
                )
                ->where('modelos.status', true)
                ->orderBy('modelos.id', 'desc')
                ->paginate($this->cantidad);
        }
        if($this->pivot == 3){
            $modelos = Modelo::join('marcas', 'marcas.id', '=', 'modelos.marca_id')
                ->select(
                    'modelos.nombre AS nombre',
                    'modelos.status AS status',
                    'modelos.id AS id',
                    'marcas.nombre AS marca',
                )
                ->where('modelos.status', false)
                ->orderBy('modelos.id', 'desc')
                ->paginate($this->cantidad);
        }
        $marcas = Marca::where('status', true)->get();
        return view('livewire.modelos.modelos', compact('modelos', 'marcas'));
    }

    public function registrarModelo(){
        $this->limpiarCampos();
        $this->abrirModalCreate();
    }

    public function guardarModelo(){
        $this->validate();
        Modelo::create([
            'nombre' => $this->nombre,
            'marca_id' => $this->marca_id,
            'status' => true,
        ]);
        $this->cerrarModalCreate();
    }

    public function editar($modelo_id){
        $modelo = Modelo::find($modelo_id);
        $this->id_modelo = $modelo->id;
        $this->nombre = $modelo->nombre;
        $this->marca_id = $modelo->marca_id;
        $this->status = $modelo->status;
        $this->abrirModalUpdate();
    }

    public function modificar($modelo_id){
        $this->validate();
        Modelo::updateOrCreate(['id' => $modelo_id], [
            'nombre' => $this->nombre,
            'marca_id' => $this->marca_id,
        ]);
        $this->limpiarCampos();
        $this->cerrarModalUpdate();
    }

    public function cambiarVista(){
        if($this->pivot == true){
            $this->pivot = false;
        }else{
            $this->pivot = true;
        }
    }

    public function verStatus($modelo_id){
        $modelo = Modelo::find($modelo_id);
        $this->nombre = $modelo->nombre;
        $this->status = $modelo->status;
        $this->modelo_id = $modelo->id;
        $this->abrirModalConfirm();
    }

    public function cambiarStatus($modelo_id){
        if($this->status == true){
            $this->status = false;
        }else{
            $this->status = true;
        }
        Modelo::updateOrCreate(['id' => $modelo_id],[
            'status' => $this->status,
        ]);
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
        $this->nombre = '';
    }
}
