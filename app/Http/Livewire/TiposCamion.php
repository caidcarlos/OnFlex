<?php

namespace App\Http\Livewire;

use App\Models\TipoCamion;
use Livewire\Component;
use Livewire\WithPagination;

class TiposCamion extends Component
{
    use WithPagination;
    public $pivot = 1, $cantidad = 10, $busqueda;
    public $nombre, $status, $id_tipo;
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
            $tipos = TipoCamion::select(
                    'nombre',
                    'status',
                    'id',
                )
                ->where('nombre', 'LIKE', '%'.$this->busqueda.'%')
                ->orderBy('id', 'desc')
                ->paginate($this->cantidad);
        }
        if($this->pivot == 2){
            $tipos = TipoCamion::select(
                    'nombre',
                    'status',
                    'id',
                )
                ->where('status', true)
                ->orderBy('id', 'desc')
                ->paginate($this->cantidad);
        }
        if($this->pivot == 3){
            $tipos = TipoCamion::select(
                    'nombre',
                    'status',
                    'id',
                )
                ->where('status', false)
                ->orderBy('id', 'desc')
                ->paginate($this->cantidad);
        }
        return view('livewire.tipos-camion.tipos-camion', compact('tipos'));
    }

    public function registrarTipoCamion(){
        $this->limpiarCampos();
        $this->abrirModalCreate();
    }

    public function guardarTipoCamion(){
        $this->validate();
        TipoCamion::create([
            'nombre' => $this->nombre,
            'status' => true,
        ]);
        $this->cerrarModalCreate();
    }

    public function editar($tipo_id){
        $tipo = TipoCamion::find($tipo_id);
        $this->id_tipo = $tipo->id;
        $this->nombre = $tipo->nombre;
        $this->status = $tipo->status;
        $this->abrirModalUpdate();
    }

    public function modificar($tipo_id){
        $this->validate();
        TipoCamion::updateOrCreate(['id' => $tipo_id], [
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

    public function verStatus($tipo_id){
        $tipo = TipoCamion::find($tipo_id);
        $this->nombre = $tipo->nombre;
        $this->status = $tipo->status;
        $this->id_tipo = $tipo->id;
        $this->abrirModalConfirm();
    }

    public function cambiarStatus($tipo_id){
        if($this->status == true){
            $this->status = false;
        }else{
            $this->status = true;
        }
        TipoCamion::updateOrCreate(['id' => $tipo_id],[
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
