<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        $messages = [
            'terms.required' => 'Debe aceptar nuestro Términos y Condiciones y nuestras Políticas de seguridad para continuar.'
        ];

        Validator::make($input, [
            'tipo_usuario' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terminos_y_politicas' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate($messages);

        $newser =  User::create([
            'tipo_usuario' => $input['tipo_usuario'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'status' => true,
        ]);
        if($input['tipo_usuario'] == '2'){
            $newser->assignRole('Empresa');
        }
        if($input['tipo_usuario'] == '3'){
            $newser->assignRole('Transportista');
        }
        return $newser;
    }

}
