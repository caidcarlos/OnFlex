<?php

namespace App\Http\Livewire;

use App\Models\PlanPago;
use Livewire\Component;
use Livewire\WithPagination;

class PlanesPago extends Component
{
    use WithPagination;
    public $busqueda, $cantidad = 10;
    public $pivot = 1;
    public $nombre, $descripcion, $dias_duracion, $precio, $status, $id_plan;
    public $modalCreate = false, $modalUpdate = false, $modalConfirm = false; 
    protected $rules = [
        'nombre' => 'required|max:50',
        'descripcion' => 'max:150',
        'dias_duracion' => 'required|numeric',
        'precio' => 'required|numeric',
    ];

    public function updatingBusqueda(){
        $this->resetPage();
    }

    public function render()
    {
        if($this->pivot == 1){
            $planes = PlanPago::select(
                    'nombre',
                    'dias_duracion',
                    'precio',
                    'status',
                    'id',
                )
                ->where('nombre', 'LIKE', '%'.$this->busqueda.'%')
                ->orWhere('dias_duracion', 'LIKE', '%'.$this->busqueda.'%')
                ->orderBy('id', 'desc')
                ->paginate($this->cantidad);
        }
        if($this->pivot == 2){
            $planes = PlanPago::select(
                    'nombre',
                    'dias_duracion',
                    'precio',
                    'status',
                    'id',
                )
                ->where('status', true)
                ->orderBy('id', 'desc')
                ->paginate($this->cantidad);
        }
        if($this->pivot == 3){
            $planes = PlanPago::select(
                    'nombre',
                    'dias_duracion',
                    'precio',
                    'status',
                    'id',
                )
                ->where('status', false)
                ->orderBy('id', 'desc')
                ->paginate($this->cantidad);
        }
        return view('livewire.planes-pago.planes-pago', compact('planes'));
    }

    public function registrarPlan(){
        $this->limpiarCampos();
        $this->abrirModalCreate();
    }

    public function guardarPlan(){
        $this->validate();
        PlanPago::create([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'dias_duracion' => $this->dias_duracion,
            'precio' => $this->precio,
            'status' => true,
        ]);
        $this->cerrarModalCreate();
    }

    public function editar($plan_id){
        $plan = PlanPago::find($plan_id);
        $this->id_plan = $plan->id;
        $this->nombre = $plan->nombre;
        $this->descripcion = $plan->descripcion;
        $this->dias_duracion = $plan->dias_duracion;
        $this->precio = $plan->precio;
        $this->status = $plan->status;
        $this->abrirModalUpdate();
    }

    public function modificar($plan_id){
        $this->validate();
        PlanPago::updateOrCreate(['id' => $plan_id], [
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'dias_duracion' => $this->dias_duracion,
            'precio' => $this->precio,
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

    public function verStatus($plan_id){
        $plan = PlanPago::find($plan_id);
        $this->nombre = $plan->nombre;
        $this->status = $plan->status;
        $this->id_plan = $plan->id;
        $this->abrirModalConfirm();
    }

    public function cambiarStatus($plan_id){
        if($this->status == true){
            $this->status = false;
        }else{
            $this->status = true;
        }
        PlanPago::updateOrCreate(['id' => $plan_id],[
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
        $this->descripcion = '';
        $this->dias_duracion = 0;
        $this->precio = 0;
    }
}
