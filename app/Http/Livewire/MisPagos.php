<?php

namespace App\Http\Livewire;

use App\Models\PagoActivo;
use App\Models\PagoManual;
use App\Models\PagoRechazado;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class MisPagos extends Component
{
    use WithPagination;

    public $modalCreatePago = false, $modalUpdatePago = false, $modalConfirmEliminar = false;
    public $modalDetalleAprob = false, $modalDetalleRechazo = false;
    public $referencia, $fecha_pago, $monto, $dias_act, $id_pago;
    public $motivo, $detalleAprobado, $detalleRechazado;
    public $cantidadRev, $cantidadAcept, $cantidadRecha;
    protected $rules = [
        'referencia' => 'required|max:15',
        'fecha_pago' => 'required'
    ];

    public function render()
    {
        $pendientes = PagoManual::join('users', 'users.id', '=', 'pago_manual.id_user')
            ->select(
                'pago_manual.referencia AS referencia',
                'pago_manual.fecha_pago AS fecha_pago',
//                'pago_manual.monto AS monto',
                'pago_manual.status_pago AS status_pago',
                'pago_manual.id AS id',
            )
            ->where('users.id', '=', Auth::user()->id)
            ->paginate($this->cantidadRev);

        $aprobados = PagoActivo::join('pago_manual', 'pago_manual.id', '=', 'pago_activo.id_pago')
            ->join('users', 'users.id', '=', 'pago_manual.id_user')
            ->select(
                'pago_manual.referencia AS referencia',
                'pago_manual.fecha_pago AS fecha_pago',
                'pago_manual.id AS id',
                'pago_activo.fecha_act AS fecha_act',
            )
            ->where('users.id', '=', Auth::user()->id)
            ->paginate($this->cantidadAcept);

        $rechazados = PagoRechazado::join('pago_manual', 'pago_manual.id', '=', 'pago_rechazado.id_pago')
            ->join('users', 'users.id', '=', 'pago_manual.id_user')
            ->select(
                'pago_manual.referencia AS referencia',
                'pago_manual.fecha_pago AS fecha_pago',
                'pago_manual.id AS id',
            )
            ->where('users.id', '=', Auth::user()->id)
            ->paginate($this->cantidadRecha);
        return view('livewire.usuarios.mis-pagos', compact('pendientes', 'aprobados', 'rechazados'));
    }

    public function registrarPago(){
        $this->limpiarCampos();
        $this->abrirModalCreatePago();
    }

    public function guardar(){
        date_default_timezone_set('America/Bogota');
        $this->validate();
        PagoManual::create([
            'referencia' => $this->referencia,
            'fecha_pago' => $this->fecha_pago,
            'status_pago' => false,
            'id_user' => Auth::user()->id,
        ]);
        $this->cerrarModalCreatePago();
    }

    public function modificarPago($id_pago){
        $this->limpiarCampos();
        $pago = PagoManual::findOrFail($id_pago);
        $this->referencia = $pago->referencia;
        $this->id_pago = $pago->id;
        $this->fecha_pago = $pago->fecha_pago;
        $this->abrirModalUpdatePago();
    }

    public function cambiar($id_pago){
        $pago = PagoManual::findOrFail($id_pago);
        $pago->referencia = $this->referencia;
        $pago->fecha_pago = $this->fecha_pago;
        $pago->save();
        $this->cerrarModalUpdatePago();
    }

    public function eliminarPago($id_pago){
        $pago = PagoManual::findOrFail($id_pago);
        $this->referencia = $pago->referencia;
        $this->id_pago = $pago->id;
        $this->fecha_pago = $pago->fecha_pago;
        $this->abrirModalConfirmEliminar();
    }

    public function borrar($id_pago){
        $pago = PagoManual::findOrFail($id_pago);
        $pago->delete();
        $this->cerrarModalConfirmEliminar();
    }

    public function verDetalleAprobado($id_pago){
        $this->abrirModalDetalleAprob();
        $this->detalleAprobado = PagoManual::join('users', 'users.id', '=', 'pago_manual.id_user')
            ->join('pago_activo', 'pago_activo.id_pago', '=', 'pago_manual.id')
            ->select(
                'users.email AS email',
                'pago_manual.referencia AS referencia',
                'pago_manual.fecha_pago AS fecha_pago',
//                'pago_manual.monto AS monto',
                'pago_activo.fecha_act AS fecha_act',
                'pago_activo.dias_act AS dias_act',
            )
            ->where('pago_manual.id', '=', $id_pago)
            ->get();
    }

    public function verDetalleRechazado($id_pago){
        $this->abrirModalDetalleRechazo();
        $this->detalleRechazado = PagoManual::join('users', 'users.id', '=', 'pago_manual.id_user')
        ->join('pago_rechazado', 'pago_rechazado.id_pago', '=', 'pago_manual.id')
        ->select(
            'users.email AS email',
            'pago_manual.referencia AS referencia',
            'pago_manual.fecha_pago AS fecha_pago',
//            'pago_manual.monto AS monto',
            'pago_rechazado.motivo AS motivo',
        )
        ->where('pago_manual.id', '=', $id_pago)
        ->get();
    }

    public function limpiarCampos(){
        $this->referencia = '';
        $this->fecha_pago = '';
    }

    public function abrirModalCreatePago(){
        $this->modalCreatePago = true;
    }

    public function cerrarModalCreatePago(){
        $this->modalCreatePago = false;
    }

    public function abrirModalUpdatePago(){
        $this->modalUpdatePago = true;
    }

    public function cerrarModalUpdatePago(){
        $this->modalUpdatePago = false;
    }

    public function abrirModalConfirmEliminar(){
        $this->modalConfirmEliminar = true;
    }

    public function cerrarModalConfirmEliminar(){
        $this->modalConfirmEliminar = false;
    }

    public function abrirModalDetalleAprob(){
        $this->modalDetalleAprob = true;
    }

    public function cerrarModalDetalleAprob(){
        $this->modalDetalleAprob = false;
    }

    public function abrirModalDetalleRechazo(){
        $this->modalDetalleRechazo = true;
    }

    public function cerrarModalDetalleRechazo(){
        $this->modalDetalleRechazo = false;
    }

}
