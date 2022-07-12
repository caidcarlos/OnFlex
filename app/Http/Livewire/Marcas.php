<?php

namespace App\Http\Livewire;

use App\Models\Marca;
use Livewire\Component;
use Livewire\WithPagination;

class Marcas extends Component
{
    use WithPagination;
    public $pivot = 1, $cantidad = 10, $busqueda;
    public $nombre, $status, $id_marca;
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
            $marcas = Marca::select(
                    'nombre',
                    'status',
                    'id',
                )
                ->where('nombre', 'LIKE', '%'.$this->busqueda.'%')
                ->orderBy('id', 'desc')
                ->paginate($this->cantidad);
        }
        if($this->pivot == 2){
            $marcas = Marca::select(
                    'nombre',
                    'status',
                    'id',
                )
                ->where('status', true)
                ->orderBy('id', 'desc')
                ->paginate($this->cantidad);
        }
        if($this->pivot == 3){
            $marcas = Marca::select(
                    'nombre',
                    'status',
                    'id',
                )
                ->where('status', false)
                ->orderBy('id', 'desc')
                ->paginate($this->cantidad);
        }
        return view('livewire.marcas.marcas', compact('marcas'));
    }

    public function registrarMarca(){
        $this->limpiarCampos();
        $this->abrirModalCreate();
    }

    public function guardarMarca(){
        $this->validate();
        Marca::create([
            'nombre' => $this->nombre,
            'status' => true,
        ]);
        $this->cerrarModalCreate();
    }

    public function editar($marca_id){
        $marca = Marca::find($marca_id);
        $this->id_marca = $marca->id;
        $this->nombre = $marca->nombre;
        $this->status = $marca->status;
        $this->abrirModalUpdate();
    }

    public function modificar($marca_id){
        $this->validate();
        Marca::updateOrCreate(['id' => $marca_id], [
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

    public function verStatus($marca_id){
        $marca = Marca::find($marca_id);
        $this->nombre = $marca->nombre;
        $this->status = $marca->status;
        $this->id_marca = $marca->id;
        $this->abrirModalConfirm();
    }

    public function cambiarStatus($marca_id){
        if($this->status == true){
            $this->status = false;
        }else{
            $this->status = true;
        }
        Marca::updateOrCreate(['id' => $marca_id],[
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
