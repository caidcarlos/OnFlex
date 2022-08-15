<div>
    <div>
        <x-guest-layout>
            <x-jet-authentication-card>
                <x-slot name="logo">
                     <x-jet-authentication-card-logo />
                </x-slot>
                <div class="mb-4 text-sm text-[#303c4e]">
                    @if (Auth::user()->tipo_usuario == 2)
                        {{ __('¡Excelente! Ya conocemos tus datos y cómo se ve el logo de tu empresa, ya solo queda que hagas tu primera propuesta de viaje. Que tengas una feliz experiencia con OnFlex') }}
                    @endif
                    @if (Auth::user()->tipo_usuario == 3)
                        {{ __('¡Excelente! Ya conocemos tus datos, cómo te ves y que camión tienes...') }}
                    @endif
                </div>
                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-[#00f2a1]">
                        {{ session('status') }}
                    </div>
                @endif
                @if(Auth::user()->tipo_usuario == 2)
                    <div class="bg-[#303c4e] text-white text-md mt-2 rounded">
                        <div class="p-2">El perfil de tu empresa está completo, haz tu primera proposición de viaje <a class="underline text-[#00f2a1]" 
                        href="{{route('propuestas-viajes')}}">aquí</a>.</div>
                    </div>
                    <div class="bg-[#303c4e] text-white text-md mt-2 rounded">
                        <div class="p-2">Por otro lado, en la parte superior derecha puedes revisar tu menú y actualizar la información que nos has suministrado cada vez que quieras.</div>
                    </div>
                @endif
                @if(Auth::user()->tipo_usuario == 3)
                    <div class="bg-[#303c4e] text-white text-md mt-2 rounded">
                        <div class="p-2">Ya tu perfil está completo, echa un vistazo a las proposiciones de viaje disponibles para ti, <a class="underline text-[#00f2a1]" 
                        href="{{route('propuestas-viajes')}}">aquí</a></div>
                    </div>
                    <div class="bg-[#303c4e] text-white text-md mt-2 rounded">
                        <div class="p-2">Por otro lado, en la parte superior derecha puedes revisar tu menú y actualizar la información que nos has suministrado cada vez que quieras.</div>
                    </div>
                    <div class="bg-[#303c4e] text-white text-md mt-2 rounded">
                        <div class="p-2">Recuerda que tu bienestar y el de los tuyos es importante para nosotros. Es por eso que OnFlex te ofrece la oportunidad de hacer amena tu experiencia y la de las personas más cercanas a ti, ofreciéndole beneficios. Para que tu beneficiario disfruten de esos servicios, registralo <a class="underline text-[#00f2a1]" 
                        href="{{route('beneficiario')}}">aquí</a></div>
                    </div>
                    <div class="bg-[#303c4e] text-white text-md mt-2 rounded">
                        <div class="p-2">En OnFlex, puedes registrar hasta dos vehículos... Si posees otro, no dudes en registrarlo <a class="underline text-[#00f2a1]" 
                        href="{{route('camiones')}}">aquí</a></div>
                    </div>
                @endif
                <form>
                    <script src='https://checkout.epayco.co/checkout.js'
                        data-epayco-key='28f77f799ead4ee69f14fbf98c62c1c0' 
                        class='epayco-button' 
                        data-epayco-amount='79990' 
                        data-epayco-tax='0.00'  
                        data-epayco-tax-ico='0.00'               
                        data-epayco-tax-base='79990'
                        data-epayco-name='Suscripción a OnFlex 1 mes' 
                        data-epayco-description='Suscripción a OnFlex 1 mes' 
                        data-epayco-currency='cop'    
                        data-epayco-country='CO' 
                        data-epayco-test='true' 
                        data-epayco-external='false' 
                        data-epayco-response=''  
                        data-epayco-confirmation='' 
                        data-epayco-button='https://multimedia.epayco.co/dashboard/btns/btn3.png'> 
                    </script> 
                </form> 

            </x-jet-authentication-card>
        </x-guest-layout>
    </div>
</div>
