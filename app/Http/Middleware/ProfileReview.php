<?php

namespace App\Http\Middleware;

use App\Models\Camion;
use App\Models\Empresa;
use App\Models\PagoManual;
use App\Models\PagoRechazado;
use App\Models\Transportista;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileReview
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::user()->tipo_usuario == 2){
            $empresa = Empresa::where('usuario_id', '=', Auth::user()->id)->get();
            if($empresa->isEmpty()){
                return redirect()->route('completar-perfil');
            }
        }
        if(Auth::user()->tipo_usuario == 3){
            $pagoManual = PagoManual::where('id_user', '=', Auth::user()->id)->get();
            if($pagoManual->isEmpty()){
                return redirect()->route('pagos-manuales');
            }
            if($pagoManual->count() == 1){
                foreach($pagoManual as $pm){
                    if($pm->status_pago == false){
                        return redirect()->route('pagos-manuales');
                    }
                }
            }

            $pagoVigenteAceptado = PagoManual::join('pago_activo', 'pago_activo.id_pago', '=', 'pago_manual.id')
                ->select(
                    'pago_activo.fecha_act', 
                    'pago_activo.dias_act',
                )
                ->where('pago_manual.id_user', '=', Auth::user()->id)
                ->orderBy('pago_manual.id', 'desc')
                ->first();
            if(is_null($pagoVigenteAceptado)){
                return redirect()->route('pagos-manuales');
            }else{
                $activación = $pagoVigenteAceptado->fecha_act;
                $dias = $pagoVigenteAceptado->dias_act;
                $fechaCorte = date('Y-m-d', strtotime($activación."+ ".$dias." days"));
                if($fechaCorte < date('Y-m-d')){
                    session()->flash('msj', 'Pago vencido, debes registrar un nuevo pago.');
                    return redirect()->route('mis-pagos');
                }
            }
            $transportista = Transportista::where('usuario_id', '=', Auth::user()->id)->get();
            if($transportista->isEmpty()){
                return redirect()->route('completar-perfil');
            }
        }
        if(is_null(Auth::user()->profile_photo_path)){
            return redirect()->route('subir-foto-perfil');
        }
        $camiones = Camion::where('transportista_id', '=', Auth::user()->id)->get();
        if(($camiones->isEmpty()) && (Auth::user()->tipo_usuario == 3)){
            return redirect()->route('subir-camiones');
        }
        return $next($request);
    }
}
