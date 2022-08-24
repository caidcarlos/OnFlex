<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mt-4">
                <x-jet-label for="tipo_usuario" value="{{ __('Tipo de Usuario') }}" />
                <select class = "block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" 
                    id="tipo_usuario" name="tipo_usuario" required>
                    <option value="">Elija un tipo de usuario</option>
                    <option value="2">Empresa</option>
                    <option value="3">Transportista</option>
                </select>
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Correo Electrónico') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Contraseña') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirmar Contraseña') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terminos_y_politicas">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terminos_y_politicas" id="terminos_y_politicas"/>

                            <div class="ml-2">
                                {!! __('He leído y acepto los :terms_of_service y las :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="https://onflex.co/pdf/Terminos-y-Condiciones-ONFLEX.pdf" class="underline text-sm text-gray-600 hover:text-[#303c4e]">'.__('Términos y Condiciones').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="https://onflex.co/pdf/politica-de-proteccion-de-datos-personales-ONFLEX.pdf" class="underline text-sm text-gray-600 hover:text-[#303c4e]">'.__('Políticas de Privacidad').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('¿Ya estás registrado?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Registrar') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
