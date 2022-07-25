<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class SubirFotoPerfil extends Component
{
    use WithFileUploads;
    public $imagen;
    protected $rules = [
        'imagen' => 'required|image|max:2048',
    ];

    public function render()
    {
        return view('livewire.subir-foto-perfil');
    }

    public function guardarImagen(){
        $this->validate();
        $fotoUrl = $this->imagen->store('user-img');
        $user = User::findOrFail(Auth::user()->id);
        $user->profile_photo_path = $fotoUrl;
        $user->save();
        if(Auth::user()->tipo_usuario == 1){
            return redirect()->route('dashboard');
        }
        if(Auth::user()->tipo_usuario == 2){
            return redirect()->route('mensaje-final');
        }
        if(Auth::user()->tipo_usuario == 3){
            return redirect()->route('subir-camiones');
        }
    }
}
