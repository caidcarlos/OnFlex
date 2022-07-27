<?php

namespace App\Http\Livewire;

use App\Models\Beneficiario;
use App\Models\Ciudad;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Notification;
use App\Notifications\RegistroBeneficiario;
use App\Notifications\BorradoBeneficiario;

class Beneficiarios extends Component
{
    public $modalCreate = false, $modalUpdate = false, $modalConfirm = false;
    public $cedula, $nombre, $apellido, $email, $telefono, $sexo, $ciudad_id, $beneficiario_id;
    protected $rules=[
        'cedula' => 'required|max:15',
        'nombre' => 'required|max:50',
        'apellido' => 'required|max:50',
        'email' => 'required',
        'telefono' => 'required|max:15',
        'sexo' => 'required',
        'ciudad_id' => 'required',
    ];

    public function render()
    {
        $beneficiario = Beneficiario::join('ciudades', 'ciudades.id', '=', 'beneficiarios.ciudad_id')
            ->select([
                'beneficiarios.cedula AS cedula',
                'beneficiarios.nombre AS nombre',
                'beneficiarios.apellido AS apellido',
                'beneficiarios.email AS email',
                'beneficiarios.telefono AS telefono',
                'beneficiarios.sexo AS sexo',
                'beneficiarios.updated_at AS updated_at',
                'ciudades.nombre AS ciudad',
            ])
            ->where('transportista_id', '=', Auth::user()->id)
            ->get();
        $ciudades = Ciudad::where('status', true)->get();
        return view('livewire.beneficiarios.beneficiarios', compact('beneficiario', 'ciudades'));
    }

    public function registrarBeneficiario(){
        $this->limpiarCampos();
        $this->abrirModalCreate();
    }

    public function guardarBeneficiario(){
        $this->validate();
        $beneficiario = Beneficiario::create([
            'cedula' => $this->cedula,
            'nombre' => $this->nombre,
            'apellido' => $this->apellido,
            'email' => $this->email,
            'sexo' => $this->sexo,
            'telefono' => $this->telefono,
            'ciudad_id' => $this->ciudad_id,
            'transportista_id' => Auth::user()->id,
        ]);
        Notification::send(Auth::user(), new RegistroBeneficiario($beneficiario));
        $this->cerrarModalCreate();
    }

    public function editar($id_beneficiario){
        $benef = Beneficiario::find($id_beneficiario);
        $this->cedula = $benef->cedula;
        $this->nombre = $benef->nombre;
        $this->apellido = $benef->apellido;
        $this->email = $benef->email;
        $this->telefono = $benef->telefono;
        $this->sexo = $benef->sexo;
        $this->ciudad_id = $benef->ciudad_id;
        $this->beneficiario_id = $benef->id;
        $this->abrirModalUpdate();
    }

    public function modificar($id_beneficiario){
        $this->validate();
        Beneficiario::updateOrCreate(['id' => $id_beneficiario], [
            'cedula' => $this->cedula,
            'nombre' => $this->nombre,
            'apellido' => $this->apellido,
            'email' => $this->email,
            'sexo' => $this->sexo,
            'telefono' => $this->telefono,
            'ciudad_id' => $this->ciudad_id,
        ]);
        $this->cerrarModalUpdate();
    }

    public function eliminar($id_beneficiario){
        $benef = Beneficiario::find($id_beneficiario);
        $this->nombre = $benef->nombre;
        $this->apellido = $benef->apellido;
        $this->beneficiario_id = $benef->id;
        $this->abrirModalConfirm();
    }

    public function borrar($id_beneficiario){
        $beneficiario = Beneficiario::find($id_beneficiario);
        //Notification::send(Auth::user(), new BorradoBeneficiario($beneficiario));
        $beneficiario->delete();
        $this->cerrarModalConfirm();
    }

    public function abrirModalCreate(){
        $this->modalCreate = true;
    }

    public function cerrarModalCreate(){
        $this->modalCreate = false;
    }
    
    public function abrirModalUpdate(){
        $this->modalUpdate = true;
    }

    public function cerrarModalUpdate(){
        $this->modalUpdate = false;
    }
    
    public function abrirModalConfirm(){
        $this->modalConfirm = true;
    }

    public function cerrarModalConfirm(){
        $this->modalConfirm = false;
    }
    
    public function limpiarCampos(){
        $this->cedula = '';
        $this->nombre = '';
        $this->apellido = '';
        $this->email = '';
        $this->telefono = '';
        $this->sexo = '';
    }
}
