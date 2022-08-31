<div>
    <div>
        <x-guest-layout>
            <x-jet-authentication-card>
                <x-slot name="logo">
                    <x-jet-authentication-card-logo />
                </x-slot>
                @if (is_null($verificacion))
                    <div class="mb-2 text-sm text-[#303c4e]">
                        {{ __('Bienvenido a OnFlex. Antes de comenzar, por favor realiza tu pago por solo $79.999 COP y 
                        regístralo en el formulario a continuación. Los datos de la cuenta a depositar son:') }}
                    </div>
                    <div class="mb-1 text-md text-[#303c4e] font-bold">
                        {{ __('Banco:') }}
                    </div>
                    <div class="mb-2 text-md text-[#303c4e]">
                        {{ __('Davivienda') }}
                    </div>
                    <div class="mb-1 text-md text-[#303c4e] font-bold">
                        {{ __('Nombre de la Empresa:') }}
                    </div>
                    <div class="mb-2 text-md text-[#303c4e]">
                        {{ __('Bussiness Technology Transp S.A.S.') }}
                    </div>
                    <div class="mb-1 text-md text-[#303c4e] font-bold">
                        {{ __('Tipo de Cuenta:') }}
                    </div>
                    <div class="mb-2 text-md text-[#303c4e]">
                        {{ __('Ahorro') }}
                    </div>
                    <div class="mb-1 text-md text-[#303c4e] font-bold">
                        {{ __('Número de Cuenta:') }}
                    </div>
                    <div class="mb-2 text-md text-[#303c4e]">
                        {{ __('108900206898') }}
                    </div>
                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-[#00f2a1]">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST">
                        <div class="mt-4">
                            <x-jet-label for="referencia" value="{{ __('Referencia') }}" />
                            <input id="referencia" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" 
                                type="text" name="referencia" maxlength="15" wire:model.defer="referencia" required />
                            @error('referencia')
                                <div id="text-sm text-red-500">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <x-jet-label for="fecha_pago" value="{{ __('fecha de Pago') }}" />
                            <input id="fecha_pago" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" 
                                type="date" max="{{date('Y-m-d')}}" name="fecha_pago" wire:model.defer="fecha_pago" required />
                            @error('fecha_pago')
                                <div id="text-sm text-red-500">{{$message}}</div>
                            @enderror
                        </div>
                        <!--div class="mt-4">
                            <x-jet-label for="monto" value="{ { __('Monto') }}" />
                            <input id="monto" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" 
                                type="number" step="0.01" name="monto" wire:model.defer = "monto" required />
                            @ error('monto')
                                <div id="text-sm text-red-500">{ {$message}}</div>
                            @ enderror
                        </div-->
                        <div class="flex justify-start">
                            <button class="mt-4 inline-flex items-center px-4 py-2 rounded-md bg-gray-700 font-bold text-sm text-white hover:text-green-400 active:bg-gray-700 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-600 disabled:opacity-50 transition"
                                wire:click.prevent = "guardarPago()">
                                Registrar Pago
                            </button>
                            <div class="mt-4 ml-4">
                                <form>
                                    <script
                                        src="https://checkout.epayco.co/checkout.js"
                                        class="epayco-button"
                                        data-epayco-key="28f77f799ead4ee69f14fbf98c62c1c0"
                                        data-epayco-amount="79999"
                                        data-epayco-name="Pago Suscripcion"
                                        data-epayco-description="Pago Suscripcion"
                                        data-epayco-currency="cop"
                                        data-epayco-country="co"
                                        data-epayco-test="true"
                                        data-epayco-external="false"
                                        data-epayco-response="http://apponflex.co/response"
                                        data-epayco-confirmation="http://apponflex.co/confirmacion"
                                        data-epayco-methodconfirmation="get">
                                    </script>
                                </form>
                            </div>
                        </div>
                    </form>
                @else
                    @if ($verificacion->status_pago == false)
                        <div class="mb-2 text-md text-[#303c4e]">
                            Su pago de referencia <strong>{{$verificacion->referencia}}</strong>, 
                            hecho el día: <strong>{{date('d-m-Y', strtotime($verificacion->fecha_pago))}}</strong>, 
                            está siendo verificado. Le notificaremos a su correo electrónico el resultado del proceso.</strong>
                        </div>
                    @endif
                    @if (($verificacion->status_pago == true) && (!is_null($rechazado)))
                        <div class="mb-2 text-sm text-[#303c4e]">
                            {{ __('Lamentamos decirte que tu pago ha sido rechazado. 
                                Si deseas, vuelve a reportar un pago en el formulario a continuación. 
                                Te recordamos que nuestroas datos son:') }}
                        </div>
                        <div class="mb-1 text-md text-[#303c4e] font-bold">
                            {{ __('Banco:') }}
                        </div>
                        <div class="mb-2 text-md text-[#303c4e]">
                            {{ __('Davivienda') }}
                        </div>
                        <div class="mb-1 text-md text-[#303c4e] font-bold">
                            {{ __('Nombre de la Empresa:') }}
                        </div>
                        <div class="mb-2 text-md text-[#303c4e]">
                            {{ __('Bussiness Technology Transp S.A.S.') }}
                        </div>
                        <div class="mb-1 text-md text-[#303c4e] font-bold">
                            {{ __('Tipo de Cuenta:') }}
                        </div>
                        <div class="mb-2 text-md text-[#303c4e]">
                            {{ __('Ahorro') }}
                        </div>
                        <div class="mb-1 text-md text-[#303c4e] font-bold">
                            {{ __('Número de Cuenta:') }}
                        </div>
                        <div class="mb-2 text-md text-[#303c4e]">
                            {{ __('108900206898') }}
                        </div>
                        @if (session('status'))
                            <div class="mb-4 font-medium text-sm text-[#00f2a1]">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="POST">
                            <div class="mt-4">
                                <x-jet-label for="referencia" value="{{ __('Referencia') }}" />
                                <input id="referencia" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" 
                                    type="text" name="referencia" maxlength="15" wire:model.defer="referencia" required />
                                @error('referencia')
                                    <div id="text-sm text-red-500">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mt-4">
                                <x-jet-label for="fecha_pago" value="{{ __('fecha de Pago') }}" />
                                <input id="fecha_pago" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" 
                                    type="date" max="{{date('Y-m-d')}}" name="fecha_pago" wire:model.defer="fecha_pago" required />
                                @error('fecha_pago')
                                    <div id="text-sm text-red-500">{{$message}}</div>
                                @enderror
                            </div>
                            <!--div class="mt-4">
                                <x-jet-label for="monto" value="{ { __('Monto') }}" />
                                <input id="monto" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" 
                                    type="number" step="0.01" name="monto" wire:model.defer = "monto" required />
                                @ error('monto')
                                    <div id="text-sm text-red-500">{ {$message}}</div>
                                @ enderror
                            </div-->
                            <div class="flex justify-start">
                                <button class="mt-4 inline-flex items-center px-4 py-2 rounded-md bg-gray-700 font-bold text-sm text-white hover:text-green-400 active:bg-gray-700 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-600 disabled:opacity-50 transition"
                                    wire:click.prevent = "guardarPago()">
                                    Registrar Pago
                                </button>
                                <div class="mt-4 ml-4">
                                    <form>
                                        <script
                                            src="https://checkout.epayco.co/checkout.js"
                                            class="epayco-button"
                                            data-epayco-key="28f77f799ead4ee69f14fbf98c62c1c0"
                                            data-epayco-amount="79999"
                                            data-epayco-name="Pago Suscripcion"
                                            data-epayco-description="Pago Suscripcion"
                                            data-epayco-currency="cop"
                                            data-epayco-country="co"
                                            data-epayco-test="true"
                                            data-epayco-external="false"
                                            data-epayco-response="http://apponflex.co/response"
                                            data-epayco-confirmation="http://apponflex.co/confirmacion"
                                            data-epayco-methodconfirmation="get">
                                        </script>
                                    </form>
                                </div>
                            </div>
                        </form>
                    @endif
                    @if (($verificacion->status_pago == true) && (is_null($rechazado)))
                        <div class="mb-2 text-sm text-[#303c4e]">
                            ¡Muy bien! Tu pago ha sido aprobado. Ya puedes comenzar con el registro de tus datos en el perfil.<br />
                            <a href="{{route('completar-perfil')}}" 
                                class ="mt-4 inline-flex items-center px-4 py-2 rounded-md bg-gray-700 font-bold text-sm text-white hover:text-green-400 active:bg-gray-700 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-600 disabled:opacity-50 transition">
                                Continuar
                            </a>
                        </div>
                    @endif
                @endif
            </x-jet-authentication-card>
        </x-guest-layout>
    </div>
</div>
