<?php

namespace App\Http\Livewire;

use App\Models\Ciudad;
use App\Models\Gastos;
use App\Models\PropuestaViaje;
use App\Models\Solicitud;
use App\Models\Transportista;
use App\Models\User;
use App\Models\Viaje;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Viajes extends Component
{
    use WithPagination;
    public $modalVerViaje = false, $modalVerGastos = false, $modif = false;
    public $detallesV = null;
    public $estadoV;
    public $estado_viajes, $id_viaje, $gastos = null;
    public $concepto, $precio, $cantidad;

    public function render()
    {
        if(Auth::user()->tipo_usuario == 2){
            $viajesEnCurso = Viaje::join('solicitud', 'viaje.solicitud_id', '=', 'solicitud.id')
                ->join('propuesta_viaje', 'propuesta_viaje.id', '=', 'solicitud.propuesta_id')
                ->join('users', 'users.id', '=', 'solicitud.transportista_id')
                ->join('transportista', 'users.id', '=', 'transportista.usuario_id')
                ->select(
                    'propuesta_viaje.origen_id AS origen',
                    'propuesta_viaje.destino_id AS destino',
                    'propuesta_viaje.fecha_viaje AS fechaV',
                    'users.nombre AS nombreT',
                    'users.id AS idT',
                    'transportista.apellido AS apellidoT',
                    'viaje.estado AS estadoV',
                    'viaje.id AS idV',
                )
                ->where('viaje.estado', '<>', 'TERMINADO')
                ->orderBy('propuesta_viaje.fecha_viaje', 'desc')
                ->paginate(5);
            $viajesTerminados = Viaje::join('solicitud', 'viaje.solicitud_id', '=', 'solicitud.id')
                ->join('propuesta_viaje', 'propuesta_viaje.id', '=', 'solicitud.propuesta_id')
                ->join('users', 'users.id', '=', 'solicitud.transportista_id')
                ->join('transportista', 'users.id', '=', 'transportista.usuario_id')
                ->select(
                    'propuesta_viaje.origen_id AS origen',
                    'propuesta_viaje.destino_id AS destino',
                    'propuesta_viaje.fecha_viaje AS fechaV',
                    'users.nombre AS nombreT',
                    'users.id AS idT',
                    'transportista.apellido AS apellidoT',
                    'viaje.estado AS estadoV',
                    'viaje.id AS idV',
                )
                ->where('viaje.estado', '=', 'TERMINADO')
                ->orderBy('propuesta_viaje.fecha_viaje', 'desc')
                ->paginate(5);
        }
        if(Auth::user()->tipo_usuario == 3){
            $viajesEnCurso = Viaje::join('solicitud', 'viaje.solicitud_id', '=', 'solicitud.id')
                ->join('propuesta_viaje', 'propuesta_viaje.id', '=', 'solicitud.propuesta_id')
                ->join('users', 'users.id', '=', 'propuesta_viaje.id_empresa')
                ->select(
                    'propuesta_viaje.origen_id AS origen',
                    'propuesta_viaje.destino_id AS destino',
                    'propuesta_viaje.fecha_viaje AS fechaV',
                    'users.nombre AS nombreE',
                    'users.id AS idE',
                    'viaje.estado AS estadoV',
                    'viaje.id AS idV',
                )
                ->where('viaje.estado', '<>', 'TERMINADO')
                ->where('solicitud.transportista_id', '=', Auth::user()->id)
                ->orderBy('propuesta_viaje.fecha_viaje', 'desc')
                ->get();
            $viajesTerminados = Viaje::join('solicitud', 'viaje.solicitud_id', '=', 'solicitud.id')
                ->join('propuesta_viaje', 'propuesta_viaje.id', '=', 'solicitud.propuesta_id')
                ->join('users', 'users.id', '=', 'propuesta_viaje.id_empresa')
                ->select(
                    'propuesta_viaje.origen_id AS origen',
                    'propuesta_viaje.destino_id AS destino',
                    'propuesta_viaje.fecha_viaje AS fechaV',
                    'users.nombre AS nombreE',
                    'users.id AS idE',
                    'viaje.estado AS estadoV',
                    'viaje.id AS idV',
                )
                ->where('viaje.estado', '=', 'TERMINADO')
                ->where('solicitud.transportista_id', '=', Auth::user()->id)
                ->orderBy('propuesta_viaje.fecha_viaje', 'desc')
                ->paginate(15);
        }
        $ciudades = Ciudad::all();
        return view('livewire.viajes.viajes', compact('viajesEnCurso', 'viajesTerminados', 'ciudades'));
    }

    public function verDetalleViaje($id_viaje){
        if(Auth::user()->tipo_usuario == 3){
            $this->detallesV = Viaje::join('solicitud', 'viaje.solicitud_id', '=', 'solicitud.id')
                ->join('propuesta_viaje', 'propuesta_viaje.id', '=', 'solicitud.propuesta_id')
                ->join('users', 'users.id', '=', 'propuesta_viaje.id_empresa')
                ->select(
                    'propuesta_viaje.origen_id AS origen',
                    'propuesta_viaje.observacion AS observacion',
                    'propuesta_viaje.destino_id AS destino',
                    'propuesta_viaje.fecha_viaje AS fechaV',
                    'propuesta_viaje.tipo_viaje AS tipoV',
                    'propuesta_viaje.peso_carga_total AS peso_carga',
                    'users.nombre AS nombreE',
                    'users.id AS idE',
                    'viaje.estado AS estadoV',
                    'viaje.id AS idV',
                )
                ->where('viaje.id', '=', $id_viaje)
                ->get();
        }
        if(Auth::user()->tipo_usuario == 2){
            $this->detallesV = Viaje::join('solicitud', 'viaje.solicitud_id', '=', 'solicitud.id')
                ->join('propuesta_viaje', 'propuesta_viaje.id', '=', 'solicitud.propuesta_id')
                ->join('users', 'users.id', '=', 'solicitud.transportista_id')
                ->join('transportista', 'users.id', '=', 'transportista.usuario_id')
                ->select(
                    'propuesta_viaje.origen_id AS origen',
                    'propuesta_viaje.observacion AS observacion',
                    'propuesta_viaje.destino_id AS destino',
                    'propuesta_viaje.fecha_viaje AS fechaV',
                    'propuesta_viaje.tipo_viaje AS tipoV',
                    'propuesta_viaje.peso_carga_total AS peso_carga',
                    'users.nombre AS nombreT',
                    'users.id AS idT',
                    'transportista.apellido AS apellidoT',
                    'viaje.estado AS estadoV',
                    'viaje.id AS idV',
                )
                ->where('viaje.id', '=', $id_viaje)
                ->get();
        }
        $this->abrirModalVerViaje();
    }

    public function actualizarEstado($id_viaje){
        Viaje::updateOrCreate(['id' => $id_viaje], [
            'estado' => $this->estadoV
        ]);
        $this->cerrarModalVerViaje();
    }

    public function verGastos($id_viaje){
        $viaje = Viaje::findOrFail($id_viaje);
        $this->id_viaje = $viaje->id;
        $this->estado_viaje = $viaje->estado;
        $this->gastos = Gastos::where('viaje_id', '=', $id_viaje)
            ->get();
        $this->abrirModalVerGastos();
    }

    public function guardarGasto($id_viaje){
        $this->validate([
            'concepto' => 'required|max:90',
            'precio' => 'required',
            'cantidad' => 'required',
        ]);
        Gastos::create([
            'concepto' => $this->concepto,
            'precio' => $this->precio,
            'cantidad' => $this->cantidad,
            'viaje_id' => $id_viaje,
        ]);
        $this->gastos = Gastos::where('viaje_id', '=', $id_viaje)
            ->get();
    }

    public function modificarGasto($gasto_id){
        $gasto = Gastos::findOrFail($gasto_id);
        $this->concepto = $gasto->concepto;
        $this->precio = $gasto->precio;
        $this->cantidad = $gasto->cantidad;
        $this->id_gasto = $gasto->id;
        $this->gastos = Gastos::where('viaje_id', '=', $gasto->viaje_id)
            ->get();
        $this->modif = true;
    }

    public function cambiarGasto($id_gasto){
        $this->validate([
            'concepto' => 'required|max:90',
            'precio' => 'required',
            'cantidad' => 'required',
        ]);
        Gastos::updateOrCreate(['id' => $id_gasto],[
            'concepto' => $this->concepto,
            'precio' => $this->precio,
            'cantidad' => $this->cantidad,
        ]);
        $this->modif = false;
        $this->concepto = '';
        $this->cantidad = '';
        $this->precio = '';
        $gasto = Gastos::findOrFail($id_gasto);
        $this->gastos = Gastos::where('viaje_id', '=', $gasto->viaje_id)
            ->get();
    }

    public function borrarGasto($id_gasto){
        $gasto = Gastos::findOrFail($id_gasto);
        $id_viaje = $gasto->viaje_id;
        $gasto->delete();
        $this->gastos = Gastos::where('viaje_id', '=', $id_viaje)
            ->get();
    }

    public function abrirModalVerViaje(){
        $this->modalVerViaje = true;
    }

    public function cerrarModalVerViaje(){
        $this->modalVerViaje = false;
    }

    public function abrirModalVerGastos(){
        $this->modalVerGastos = true;
    }

    public function cerrarModalVerGastos(){
        $this->modalVerGastos = false;
    }
}
