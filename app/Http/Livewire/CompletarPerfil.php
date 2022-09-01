<?php

namespace App\Http\Livewire;

use App\Models\Comercial;
use App\Models\Empresa;
use App\Models\Transportista;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CompletarPerfil extends Component
{
    public $cedula, $nombre, $apellido, $licencia, $peso, $estatura;//transportistas
    public $razon_social, $nit, $nombre_rep, $apellido_rep, $telefono, $comercial; //empresas

    public function render()
    {
        $comerciales = Comercial::where('status', '=', true)->get();
        return view('livewire.completar-perfil', compact('comerciales'));
    }

    public function guadarNombre($nombre){
        $user = User::findOrFail(Auth::user()->id);
        $user->nombre = $nombre;
        $user->save();
    }

    public function guardarTransportista(){
        $this->validate([
            'cedula' => 'required|min:6|max:12|unique:transportista',
            'nombre' => 'required|min:2|max:50',
            'apellido' => 'required|min:2|max:50',
            'licencia' => 'required',
            'peso' => 'required',
            'estatura' => 'required',
        ]);
        $this->guadarNombre($this->nombre);
        Transportista::create([
            'cedula' => $this->cedula,
            'apellido' => $this->apellido,
            'num_pase' => $this->licencia,
            'peso' => $this->peso,
            'estatura' => $this->estatura,
            'usuario_id' => Auth::user()->id,
        ]);
        return redirect()->route('subir-foto-perfil');
    }

    public function guardarEmpresa(){
        $this->validate([
            'nit' => 'required|min:6|max:12|unique:empresa',
            'razon_social' => 'required|min:2|max:50',
            'nombre_rep' => 'required|min:2|max:50',
            'comercial' => 'required',
            'apellido_rep' => 'required',
            'telefono' => 'required',
        ]);
        $this->guadarNombre($this->razon_social);
        Empresa::create([
            'nit' => $this->nit,
            'nombre_resp' => $this->nombre_rep,
            'apellido_resp' => $this->apellido_rep,
            'telefono' => $this->telefono,
            'comercial_id' => $this->comercial,
            'usuario_id' => Auth::user()->id,
        ]);
        return redirect()->route('subir-foto-perfil');
    }
}
