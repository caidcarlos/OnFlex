<?php

namespace App\Http\Livewire;

use App\Models\PagoActivo;
use App\Models\PagoManual;
use App\Models\PagoRechazado;
use Livewire\Component;
use Livewire\WithPagination;

class RevisionesPagos extends Component
{
    use WithPagination;
    public $busquedaRev, $cantidadRev;
    public $busquedaAcept, $cantidadAcept;
    public $busquedaRecha, $cantidadRecha;
    public $modalConfirmAcept = false, $modalConfirmRechazo = false;
    public $modalDetalleAprob = false, $modalDetalleRechazo = false;
    public $referencia, $fecha_pago, $monto, $dias_act, $id_pago;
    public $motivo, $detalleAprobado, $detalleRechazado;

    public function updatingBusquedaRev()
    {
        $this->resetPage();
    }

    public function updatingBusquedaAcept()
    {
        $this->resetPage();
    }

    public function updatingBusquedaRecha()
    {
        $this->resetPage();
    }

    public function render()
    {
        $pendientes = PagoManual::join('users', 'users.id', '=', 'pago_manual.id_user')
            ->select(
                'users.email AS email',
                'pago_manual.referencia AS referencia',
                'pago_manual.fecha_pago AS fecha_pago',
//                'pago_manual.monto AS monto',
                'pago_manual.status_pago AS status_pago',
                'pago_manual.id AS id',
            )
            ->where('users.email', 'LIKE', '%'.$this->busquedaRev.'%')
            ->orWhere('pago_manual.referencia', 'LIKE', '%'.$this->busquedaRev.'%')
            ->orWhere('pago_manual.fecha_pago', 'LIKE', '%'.$this->busquedaRev.'%')
//            ->orWhere('pago_manual.monto', 'LIKE', '%'.$this->busquedaRev.'%')
            ->paginate($this->cantidadRev);

        $aprobados = PagoActivo::join('pago_manual', 'pago_manual.id', '=', 'pago_activo.id_pago')
            ->join('users', 'users.id', '=', 'pago_manual.id_user')
            ->select(
                'users.email AS email',
                'pago_manual.referencia AS referencia',
                'pago_manual.fecha_pago AS fecha_pago',
                'pago_manual.id AS id',
                'pago_activo.fecha_act AS fecha_act',
            )
            ->where('users.email', 'LIKE', '%'.$this->busquedaAcept.'%')
            ->orWhere('pago_manual.referencia', 'LIKE', '%'.$this->busquedaAcept.'%')
            ->orWhere('pago_manual.fecha_pago', 'LIKE', '%'.$this->busquedaAcept.'%')
            ->orWhere('pago_activo.fecha_act', 'LIKE', '%'.$this->busquedaAcept.'%')
            ->paginate($this->cantidadAcept);

        $rechazados = PagoRechazado::join('pago_manual', 'pago_manual.id', '=', 'pago_rechazado.id_pago')
        ->join('users', 'users.id', '=', 'pago_manual.id_user')
        ->select(
            'users.email AS email',
            'pago_manual.referencia AS referencia',
            'pago_manual.fecha_pago AS fecha_pago',
            'pago_manual.id AS id',
        )
        ->where('users.email', 'LIKE', '%'.$this->busquedaRecha.'%')
        ->orWhere('pago_manual.referencia', 'LIKE', '%'.$this->busquedaRecha.'%')
        ->orWhere('pago_manual.fecha_pago', 'LIKE', '%'.$this->busquedaRecha.'%')
        ->paginate($this->cantidadRecha);

        return view('livewire.revisiones-pagos.revisiones-pagos', compact('pendientes', 'aprobados', 'rechazados'));
    }

    public function aprobarPago($id_pago){
        $this->abrirModalConfirmAcept();
        $pago = PagoManual::findOrFail($id_pago);
        $this->referencia = $pago->referencia;
        $this->fecha_pago = $pago->fecha_pago;
//        $this->monto = $pago->monto;
        $this->id_pago = $pago->id;
    }

    public function confirmarAprobacion($id_pago){
        PagoActivo::create([
            'id_pago' => $id_pago,
            'fecha_act' => date('Y-m-d'),
            'dias_act' => $this->dias_act
        ]);
        $pagoManual = PagoManual::find($id_pago);
        $pagoManual->status_pago = true;
        $pagoManual->save();
        $this->cerrarModalConfirmAcept();
    }

    public function rechazarPago($id_pago){
        $this->abrirModalConfirmRechazo();
        $pago = PagoManual::findOrFail($id_pago);
        $this->referencia = $pago->referencia;
        $this->fecha_pago = $pago->fecha_pago;
//        $this->monto = $pago->monto;
        $this->id_pago = $pago->id;
    }

    public function confirmarRechazo($id_pago){
        PagoRechazado::create([
            'id_pago' => $id_pago,
            'motivo' => $this->motivo
        ]);
        $pagoManual = PagoManual::find($id_pago);
        $pagoManual->status_pago = true;
        $pagoManual->save();
        $this->cerrarModalConfirmRechazo();
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

    public function abrirModalConfirmAcept(){
        $this->modalConfirmAcept = true;
    }

    public function cerrarModalConfirmAcept(){
        $this->modalConfirmAcept = false;
    }

    public function abrirModalConfirmRechazo(){
        $this->modalConfirmRechazo = true;
    }

    public function cerrarModalConfirmRechazo(){
        $this->modalConfirmRechazo = false;
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
