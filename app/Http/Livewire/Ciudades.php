<?php

namespace App\Http\Livewire;

use App\Models\Ciudad;
use Livewire\Component;
use Livewire\WithPagination;

class Ciudades extends Component
{
    use WithPagination;
    public $pivot = 1, $cantidad = 10, $busqueda;
    public $nombre, $status, $id_ciudad;
    public $modalCreate = false, $modalUpdate = false, $modalConfirm = false;
    protected $rules = [
        'nombre' => 'required|max:70',
    ];

    public function updatingBusqueda(){
        $this->resetPage();
    }

    public function render()
    {
        if($this->pivot == 1){
            $ciudades = Ciudad::select(
                    'nombre',
                    'status',
                    'id',
                )
                ->where('nombre', 'LIKE', '%'.$this->busqueda.'%')
                ->orderBy('id', 'desc')
                ->paginate($this->cantidad);
        }
        if($this->pivot == 2){
            $ciudades = Ciudad::select(
                    'nombre',
                    'status',
                    'id',
                )
                ->where('status', true)
                ->orderBy('id', 'desc')
                ->paginate($this->cantidad);
        }
        if($this->pivot == 3){
            $ciudades = Ciudad::select(
                    'nombre',
                    'status',
                    'id',
                )
                ->where('status', false)
                ->orderBy('id', 'desc')
                ->paginate($this->cantidad);
        }
        return view('livewire.ciudades.ciudades', compact('ciudades'));
    }

    public function registrarCiudad(){
        $this->limpiarCampos();
        $this->abrirModalCreate();
    }

    public function guardarCiudad(){
        $this->validate();
        Ciudad::create([
            'nombre' => $this->nombre,
            'status' => true,
        ]);
        $this->cerrarModalCreate();
    }

    public function editar($ciudad_id){
        $ciudad = Ciudad::find($ciudad_id);
        $this->id_ciudad = $ciudad->id;
        $this->nombre = $ciudad->nombre;
        $this->status = $ciudad->status;
        $this->abrirModalUpdate();
    }

    public function modificar($ciudad_id){
        $this->validate();
        Ciudad::updateOrCreate(['id' => $ciudad_id], [
            'nombre' => $this->nombre,
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

    public function verStatus($ciudad_id){
        $ciudad = Ciudad::find($ciudad_id);
        $this->nombre = $ciudad->nombre;
        $this->status = $ciudad->status;
        $this->id_ciudad = $ciudad->id;
        $this->abrirModalConfirm();
    }

    public function cambiarStatus($ciudad_id){
        if($this->status == true){
            $this->status = false;
        }else{
            $this->status = true;
        }
        Ciudad::updateOrCreate(['id' => $ciudad_id],[
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
