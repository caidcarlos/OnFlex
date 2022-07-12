<?php

namespace App\Http\Livewire;

use App\Models\Empresa;
use App\Models\Transportista;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;

class Usuarios extends Component
{
    use WithFileUploads;
    public $vista = 1;
    public $cedula, $nombre, $apellido, $num_pase, $estatura, $peso, $id_trans;
    public $nit, $razon_social, $nombre_rep, $apellido_rep, $telefono, $id_empresa;
    public $email, $contrasenna, $foto_perfil;

    public function render()
    {
        if(Auth::user()->tipo_usuario == '2'){
            $perfil = Empresa::where('usuario_id', Auth::user()->id)->get();
            if($perfil->isEmpty()){
                $this->nit = '';
                $this->razon_social = '';
                $this->nombre_rep = '';
                $this->apellido_rep = '';
                $this->telefono = '';
                $this->id_empresa = 0;
            }else{
                foreach($perfil as $p){
                    $this->nit = $p->nit;
                    $this->nombre_rep = $p->nombre_resp;
                    $this->apellido_rep = $p->apellido_resp;
                    $this->telefono = $p->telefono;
                    $this->id_empresa = $p->id;
                }                
            }
        };
        if(Auth::user()->tipo_usuario == '3'){
            $perfil = Transportista::where('usuario_id', Auth::user()->id)->get();
            if($perfil->isEmpty()){
                $this->cedula = '';
                $this->nombre = '';
                $this->apellido = '';
                $this->num_pase = '';
                $this->estatura = '';
                $this->peso = '';
                $this->id_trans = 0;
            }else{
                foreach($perfil as $p){
                    $this->cedula = $p->cedula;
                    $this->apellido = $p->apellido;
                    $this->num_pase = $p->num_pase;
                    $this->estatura = $p->estatura;
                    $this->peso = $p->peso;
                    $this->id_trans = $p->id;
                }
            }
        };
        $this->razon_social = Auth::user()->nombre;
        $this->nombre = Auth::user()->nombre;
        $this->email = Auth::user()->email;
        return view('livewire.usuarios.usuarios', compact('perfil'));
    }

    public function cambiarVista($v){
        $this->vista = $v;
    }

    public function guardarEmpresa($id_empresa){
        $this->validate([
            'razon_social' => 'required|max:50',
        ]);
        User::updateOrCreate(['id' => Auth::user()->id], [
            'email' => $this->email,
            'nombre' => $this->razon_social,
        ]);
        if($id_empresa == 0){
            $this->validate([
                'nit' => 'unique:empresa|required|max:20',
                'nombre_rep' => 'required|max:50',
                'apellido_rep' => 'required|max:50',
                'telefono' => 'required',
            ]);
            Empresa::create([
                'nit' => $this->nit,
                'nombre_resp' => $this->nombre_rep,
                'apellido_resp' => $this->apellido_rep,
                'telefono' => $this->telefono,
                'usuario_id' => Auth::user()->id,
            ]);
        }else{
            $this->validate([
                'nombre_rep' => 'required|max:50',
                'apellido_rep' => 'required|max:50',
                'telefono' => 'required',
            ]);
            Empresa::updateOrCreate(['id' => $id_empresa], [
                'nit' => $this->nit,
                'nombre_resp' => $this->nombre_rep,
                'apellido_resp' => $this->apellido_rep,
                'telefono' => $this->telefono,
                'usuario_id' => Auth::user()->id,
            ]);
        }
        session()->flash('notificacion', '¡Datos guardados con éxito!');
    }

    public function guardarTransportista($id_trans){
        $this->validate([
            'nombre' => 'string|required|max:50',
        ]);
        User::updateOrCreate(['id' => Auth::user()->id], [
            'email' => $this->email,
            'nombre' => $this->nombre,
        ]);
        if($id_trans == 0){
            $this->validate([
                'nombre' => 'string|required|max:50',
                'cedula' => 'unique:transportista|required|max:15',
                'apellido' => 'string|required|max:50',
                'num_pase' => 'required',
                'peso' => 'required',
                'estatura' => 'required',
            ]);
            Transportista::create([
                'cedula' => $this->cedula,
                'apellido' => $this->apellido,
                'num_pase' => $this->num_pase,
                'peso' => $this->peso,
                'estatura' => $this->estatura,
                'usuario_id' => Auth::user()->id,
            ]);
        }else{
            $this->validate([
                'cedula' => 'required|max:15',
                'apellido' => 'string|required|max:50',
                'num_pase' => 'required',
                'peso' => 'required',
                'estatura' => 'required',
            ]);
            Transportista::updateOrCreate(['id' => $id_trans], [
                'cedula' => $this->cedula,
                'apellido' => $this->apellido,
                'num_pase' => $this->num_pase,
                'peso' => $this->peso,
                'estatura' => $this->estatura,
                'usuario_id' => Auth::user()->id,
            ]);
        }
        session()->flash('notificacion', '¡Datos guardados con éxito!');
    }

    public function updatePassword(){
        
    }

    public function limpiarCampos(){
        $this->cedula = '';
        $this->nombre = '';
        $this->apellido = '';
        $this->num_pase = '';
        $this->estatura = '';
        $this->peso = '';
        $this->id_trans;
        $this->nit = '';
        $this->razon_social = '';
        $this->nombre_rep = '';
        $this->apellido_rep = '';
        $this->telefono;
        $this->email = '';
        $this->contrasenna = '';
        $this->foto_perfil = '';   
    }
}
