<?php

namespace App\Http\Middleware;

use App\Models\Camion;
use App\Models\Empresa;
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
            $transportista = Transportista::where('usuario_id', '=', Auth::user()->id)->get();
            if($transportista->isEmpty()){
                return redirect()->route('completar-perfil');
            }
        }
        if(is_null(Auth::user()->profile_photo_path)){
            return redirect()->route('subir-foto-perfil');
        }
        $camiones = Camion::where('transportista_id', '=', Auth::user()->id)->get();
        //if(($camiones->isEmpty()) && (Auth::user()->tipo_usuario == 2)){
        //    return redirect()->route('mensaje-final');
        //}
        if(($camiones->isEmpty()) && (Auth::user()->tipo_usuario == 3)){
            return redirect()->route('subir-camiones');
        }
        return $next($request);
    }
}
