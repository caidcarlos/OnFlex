<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Models\PagoManual;
use App\Models\Transactionlog;

use Illuminate\Support\Facades\Auth;

class PagoValidacion extends Controller
{
    public function index(){
        return view('epayco.checkout');
    }

    public function pagoresponse(Request $request){
        
        $url= "https://secure.epayco.co/validation/v1/reference/{$request->ref_payco}";
        $response = Http::get($url);
        $monto = 50000;
        $data = $response->json();
        $referencia = $request->ref_payco;
        switch ($data['data']['x_cod_transaction_state']) {
            case 1:
                # Aprobada
                $status_pago=true;
                $ruta='completar-perfil';
                break;
            case 2:
                # Rechazada
                $status_pago=false;
                $ruta='pagos-manuales';
                break;
            case 3:
                # Pendiente
                $status_pago=false;
                $ruta='pagos-manuales';
                break;
            case 4:
                # Fallida
                $status_pago=false;
                $ruta='pagos-manuales';
            case 4:
                # Reversada
                $status_pago=false;
                $ruta='pagos-manuales';
                break;
            case 4:
                # Retenida
                $status_pago=false;
                $ruta='pagos-manuales';
                break;
            case 4:
                # Iniciada
                $status_pago=false;
                $ruta='pagos-manuales';
                break;
            case 4:
                # Caducada
                $status_pago=false;
                $ruta='pagos-manuales';
                break;
            case 4:
                # Abandonada
                $status_pago=false;
                $ruta='pagos-manuales';
                break;
            case 4:
                # Cancelada
                $status_pago=false;
                $ruta='pagos-manuales';
                break;
            
            default:
                # code...
                break;
        }
        $fecha = date('Y-m-d');
        $pagomanual = PagoManual::create([
            'referencia'    => $referencia,
            'fecha_pago'    => $fecha,
            'monto'         => $monto,
            'status_pago'   => $status_pago,
            'id_user'       => Auth::user()->id,
        ]);
        $transaction_log = Transactionlog::create([
            'refer'             => $referencia,
            'refer_payco'       => $data['data']['x_ref_payco'],
            'bill'              => $data['data']['x_id_factura'],
            'description'       => $data['data']['x_description'],
            'status'            => $data['data']['x_cod_transaction_state'],
            'bankname'          => $data['data']['x_bank_name'],
            'ip'                => $data['data']['x_customer_ip'],
            'signature'         => $data['data']['x_signature'],
            'transaction_date'  => $data['data']['x_transaction_date']
        ]);

        return redirect()->route($ruta);
    }
}
