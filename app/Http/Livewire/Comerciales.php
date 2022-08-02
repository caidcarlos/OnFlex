<?php

namespace App\Http\Livewire;

use App\Models\Comercial;
use App\Models\Empresa;
use Livewire\Component;
use Livewire\WithPagination;

class Comerciales extends Component
{
    use WithPagination;
    public $busqueda;
    public $numero = 10, $pivot = 1;
    public $modalCreate = false, $modalUpdate = false, $modalConfirm = false;
    public $nombre, $apellido, $id_comercial, $status;
    protected $rules = [
        'nombre' => 'required|max:50',
        'apellido' => 'required|max:50',
    ];

    public function updatingBusqueda(){
        $this->resetPage();
    }

    public function render()
    {
        $comerciales = Comercial::where('nombre', 'LIKE', '%'.$this->busqueda.'%')
            ->orWhere('apellidos', 'LIKE', '%'.$this->busqueda.'%')
            ->orderBy('id', 'desc')
            ->paginate($this->numero);
        $empresas = Empresa::select('comercial_id AS comercial')->get();
        return view('livewire.comerciales.comerciales', compact('comerciales', 'empresas'));
    }

    public function registrar(){
        $this->limpiarCampos();
        $this->abrirModalCreate();
    }

    public function guardar(){
        $this->validate();
        Comercial::create([
            'nombre' => $this->nombre,
            'apellidos' => $this->apellido,
            'status' => true,
        ]);
        $this->cerrarModalCreate();
    }

    public function modificar($id_comercial){
        $comercial = Comercial::findOrFail($id_comercial);
        $this->id_comercial = $comercial->id;
        $this->nombre = $comercial->nombre;
        $this->apellido = $comercial->apellidos;
        $this->abrirModalUpdate();
    }

    public function cambiar($id_comercial){
        $comercial = Comercial::findOrFail($id_comercial);
        $comercial->nombre = $this->nombre;
        $comercial->apellidos = $this->apellido;
        $comercial->save();
        $this->cerrarModalUpdate();
    }

    public function verStatus($id_comercial){
        $comercial = Comercial::findOrFail($id_comercial);
        $this->id_comercial = $comercial->id;
        $this->nombre = $comercial->nombre;
        $this->apellido = $comercial->apellidos;
        $this->status = $comercial->status;
        $this->abrirModalConfirm();
    }

    public function cambiarStatus($id_comercial){
        $comercial = Comercial::findOrFail($id_comercial);
        if($comercial->status == true){
            $comercial->status = false;
        }else{
            $comercial->status = true;
        }
        $comercial->save();
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
        $this->apellido = '';
        $this->status = '';
    }
}
