<div>
    <div>
        <x-guest-layout>
            <x-jet-authentication-card>
                <x-slot name="logo">
                     <x-jet-authentication-card-logo />
                </x-slot>
                <div class="mb-4 text-sm text-gray-600">
                    @if (Auth::user()->tipo_usuario == 2)
                        {{ __('¡Excelente! Ya conocemos tus datos y cómo se ve el logo de tu empresa, ya solo queda que hagas tu primera propuesta de viaje. Que tengas una feliz experiencia con OnFlex') }}
                    @endif
                    @if (Auth::user()->tipo_usuario == 3)
                        {{ __('¡Excelente! Ya conocemos tus datos, cómo te ves y que camión tienes...') }}
                    @endif
                </div>
                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif
                @if(Auth::user()->tipo_usuario == 2)
                    <div class="bg-gray-700 text-white text-md mt-2 rounded">
                        <div class="p-2">El perfil de tu empresa está completo, haz tu primera proposición de viaje <a class="underline text-green-400" 
                        href="{{route('propuestas-viajes')}}">aquí</a>.</div>
                    </div>
                    <div class="bg-gray-700 text-white text-md mt-2 rounded">
                        <div class="p-2">Por otro lado, en la parte superior derecha puedes revisar tu menú y actualizar la información que nos has suministrado cada vez que quieras.</div>
                    </div>
                @endif
                @if(Auth::user()->tipo_usuario == 3)
                    <div class="bg-gray-700 text-white text-md mt-2 rounded">
                        <div class="p-2">Ya tu perfil está completo, echa un vistazo a las proposiciones de viaje disponibles para ti, <a class="underline text-green-400" 
                        href="{{route('propuestas-viajes')}}">aquí</a></div>
                    </div>
                    <div class="bg-gray-700 text-white text-md mt-2 rounded">
                        <div class="p-2">Por otro lado, en la parte superior derecha puedes revisar tu menú y actualizar la información que nos has suministrado cada vez que quieras.</div>
                    </div>
                    <div class="bg-gray-700 text-white text-md mt-2 rounded">
                        <div class="p-2">Recuerda que tu bienestar y el de los tuyos es importante para nosotros. Es por eso que OnFlex te ofrece la oportunidad de hacer amena tu experiencia y la de las personas más cercanas a ti, ofreciéndole beneficios. Para que tu beneficiario disfruten de esos servicios, registralo <a class="underline text-green-400" 
                        href="{{route('beneficiario')}}">aquí</a></div>
                    </div>
                    <div class="bg-gray-700 text-white text-md mt-2 rounded">
                        <div class="p-2">En OnFlex, puedes registrar hasta dos vehículos... Si posees otro, no dudes en registrarlo <a class="underline text-green-400" 
                        href="{{route('camiones')}}">aquí</a></div>
                    </div>
                @endif
            </x-jet-authentication-card>
        </x-guest-layout>
    </div>
</div>
