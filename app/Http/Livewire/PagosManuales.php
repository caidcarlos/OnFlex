<?php

namespace App\Http\Livewire;

use App\Models\PagoManual;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PagosManuales extends Component
{
    public $referencia, $fecha_pago, $monto, $status_pago, $id_user, $id_pago;

    protected $rules = ([
        'referencia' => 'required|max:15',
        'fecha_pago' => 'required',
//        'monto' => 'required|numeric',
    ]);
    public function render()
    {
        $verificacion = PagoManual::select(
                'status_pago',
                'referencia',
                'fecha_pago',
            )
            ->where('id_user', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->first();
        $rechazado = PagoManual::join('pago_rechazado', 'pago_rechazado.id_pago', '=', 'pago_manual.id')
            ->select(
                'pago_manual.referencia AS referencia',
                'pago_manual.fecha_pago AS fecha_pago',
                'pago_rechazado.motivo AS motivo',
            )
            ->where('pago_manual.id_user', Auth::user()->id)
            ->orderBy('pago_manual.id', 'desc')
            ->first();
        return view('livewire.pagos-manuales', compact('verificacion', 'rechazado'));
    }

    public function guardarPago(){
        date_default_timezone_set('America/Bogota');
        $this->validate();
        PagoManual::create([
            'referencia' => $this->referencia,
            'fecha_pago' => $this->fecha_pago,
//            'monto' => $this->monto,
            'status_pago' => false,
            'id_user' => Auth::user()->id,
        ]);
    }


}
