<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Perfil de Usuario') }}
        </h2>
    </x-slot>
    @php
        $a = 1;
        $b = 2;
        $c = 3;
        $d = 4;
    @endphp
   
    <div class = "bg-white min-h-screen min-w-screen border-t border-gray-400 pt-8">
        <div class = "flex justify-center w-2/3 mx-auto border-r-4 rounded-sm shadow">
            <div class = "w-1/3">
                <button class="w-full pl-2 py-3 text-left text-sm bg-green-500 hover:bg-gray-700 text-white disabled:bg-white disabled:text-black"
                    wire:click.prevent="cambiarVista({{$a}})"
                    @if($vista == 1)
                        disabled
                    @endif
                    >
                    Información General
                </button>
                <button class="w-full pl-2 py-3 text-left text-sm bg-green-500 hover:bg-gray-700 text-white disabled:bg-white disabled:text-black"
                    wire:click.prevent="cambiarVista({{$b}})"
                    @if($vista == 2)
                        disabled
                    @endif
                    >
                    Imagen de Perfil
                </button>
                <button class="w-full pl-2 py-3 text-left text-sm bg-green-500 hover:bg-gray-700 text-white disabled:bg-white disabled:text-black"
                    wire:click.prevent="cambiarVista({{$c}})"
                    @if($vista == 3)
                        disabled
                    @endif
                    >
                    Actualizar Contraseña
                </button>
                <button class="w-full pl-2 py-3 text-left text-sm bg-green-500 hover:bg-gray-700 text-white disabled:bg-white disabled:text-black"
                    wire:click.prevent="cambiarVista({{$d}})"
                    @if($vista == 4)
                        disabled
                    @endif
                    >
                    Cancelar Suscripción
                </button>
            </div>
            <div class = "w-2/3 border-l-4 border-green-500">
                <div class="p-3">
                    @if ($vista == 1)
                        <h3 class="text-lg font-medium text-gray-900">Información General</h3>
                        <div class="mt-4">
                            <x-jet-label for="email" value="{{ __('Correo Electrónico') }}" />
                            <input wire:model.defer="email" 
                                class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" 
                                type="email" disabled>
                            @error('email')
                                <div class = "text-sm text-red-600 ">{{$message}}</div>
                            @enderror
                        </div>
                        @if(Auth::user()->tipo_usuario == '1')

                        @endif
                        @if(Auth::user()->tipo_usuario == '2')
                            <form method="POST">
                                <div class="mt-4">
                                    <x-jet-label for="razon_social" value="{{ __('Razón Social') }}" />
                                    <input id="razon_social" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" 
                                        type="text" name="razon_social" wire:model="razon_social" required />
                                    @error('razon_social')
                                        <div id="text-sm text-red-500">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="mt-4">
                                    <x-jet-label for="nit" value="{{ __('NIT') }}" />
                                    <input id="nit" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" 
                                        type="text" name="nit" wire:model.defer="nit" required />
                                    @error('nit')
                                        <div id="text-sm text-red-500">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="mt-4">
                                    <x-jet-label for="nombre_rep" value="{{ __('Nombre de Representante') }}" />
                                    <input id="nombre_rep" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" 
                                        type="text" name="nombre_rep" wire:model.defer = "nombre_rep" required />
                                    @error('nombre_rep')
                                        <div id="text-sm text-red-500">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="mt-4">
                                    <x-jet-label for="apellido_rep" value="{{ __('Apellido de Representante') }}" />
                                    <input id="apellido_rep" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" 
                                        type="text" name="apellido_rep" wire:model.defer = "apellido_rep" required />
                                    @error('apellido_rep')
                                        <div id="text-sm text-red-500">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="mt-4">
                                    <x-jet-label for="telefono" value="{{ __('Teléfono') }}" />
                                    <input id="telefono" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" 
                                        type="text" name="telefono" wire:model.defer = "telefono" required />
                                    @error('telefono')
                                        <div id="text-sm text-red-500">{{$message}}</div>
                                    @enderror
                                </div>
                                <div id="flex justify-around">
                                    <button class="inline-flex mt-4 items-center px-4 py-2 font-bold text-sm bg-gray-700 text-white uppercase hover:bg-green-500 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-600 disabled:opacity-50 transition"
                                        wire:click.prevent = "guardarEmpresa({{$id_empresa}})">
                                        Guardar Cambios
                                    </button>
                                    <div class="mt-4">
                                        @if (session()->has('notificacion'))
                                            <div class="text-small text-black bg-green-300 p-2 mr-2 rounded-md">
                                                {{ session('notificacion') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        @endif
                        @if(Auth::user()->tipo_usuario == '3')
                            <form method="POST">
                                <div class="mt-4">
                                    <x-jet-label for="cedula" value="{{ __('Cédula') }}" />
                                    <input id="cedula" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" 
                                        type="text" name="cedula" wire:model.defer = "cedula" required />
                                    @error('cedula')
                                        <div class = "text-sm text-red-600 ">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="mt-4">
                                    <x-jet-label for="nombre" value="{{ __('Nombre') }}" />
                                    <input id="nombre" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" 
                                        type="text" name="nombre" wire:model = "nombre" required />
                                    @error('nombre')
                                        <div class = "text-sm text-red-600 ">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="mt-4">
                                    <x-jet-label for="apellido" value="{{ __('Apellido') }}" />
                                    <input id="apellido" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" 
                                        type="text" name="apellido" wire:model.defer = "apellido" required />
                                    @error('apellido')
                                        <div class = "text-sm text-red-600 ">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="mt-4">
                                    <x-jet-label for="num_pase" value="{{ __('Número de Pase') }}" />
                                    <input id="num_pase" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" 
                                        type="text" name="num_pase" wire:model.defer = "num_pase" required />
                                    @error('num_pase')
                                        <div class = "text-sm text-red-600 ">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="mt-4">
                                    <x-jet-label for="peso" value="{{ __('Peso (en kilogramos)') }}" />
                                    <input id="peso" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" 
                                        type="text" name="peso" wire:model.defer = "peso" required />
                                    @error('peso')
                                        <div class = "text-sm text-red-600 ">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="mt-4">
                                    <x-jet-label for="estatura" value="{{ __('Estatura (en metros)') }}" />
                                    <input id="estatura" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" 
                                        type="text" name="estatura" wire:model.defer = "estatura" required />
                                    @error('estatura')
                                        <div class = "text-sm text-red-600 ">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class = "flex justify-around">
                                    <button class = "inline-flex items-center mt-4 px-4 py-2 bg-gray-700 font-bold text-sm text-white uppercase hover:bg-green-500 active:bg-gray-700 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-600 disabled:opacity-50 transition"
                                        wire:click.prevent = "guardarTransportista({{$id_trans}})">
                                        Guardar Cambios
                                    </button>
                                    <div class="mt-4">
                                        @if (session()->has('notificacion'))
                                            <div class="text-small text-black bg-green-300 p-2 mr-2 rounded-md">
                                                {{ session('notificacion') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        @endif
                    @endif
                    @if ($vista == 2)
                        <h3 class="text-lg font-medium text-gray-900">Imagen de Perfil</h3>
                    @endif
                    @if ($vista == 3)
                    <x-jet-form-section submit="updatePassword">
                        <x-slot name="title">
                            {{ __('Actualizar Contraseña') }}
                        </x-slot>
                    
                        <x-slot name="description">
                            {{ __('') }}
                        </x-slot>
                    
                        <x-slot name="form">
                            <div class="col-span-6 sm:col-span-4">
                                <x-jet-label for="current_password" value="{{ __('Contraseña Actual') }}" />
                                <x-jet-input id="current_password" type="password" class="mt-1 block w-full" wire:model.defer="state.current_password" autocomplete="current-password" />
                                <x-jet-input-error for="current_password" class="mt-2" />
                            </div>
                    
                            <div class="col-span-6 sm:col-span-4">
                                <x-jet-label for="password" value="{{ __('Nueva Contraseña') }}" />
                                <x-jet-input id="password" type="password" class="mt-1 block w-full" wire:model.defer="state.password" autocomplete="new-password" />
                                <x-jet-input-error for="password" class="mt-2" />
                            </div>
                    
                            <div class="col-span-6 sm:col-span-4">
                                <x-jet-label for="password_confirmation" value="{{ __('Confirmar Contraseña') }}" />
                                <x-jet-input id="password_confirmation" type="password" class="mt-1 block w-full" wire:model.defer="state.password_confirmation" autocomplete="new-password" />
                                <x-jet-input-error for="password_confirmation" class="mt-2" />
                            </div>
                        </x-slot>
                    
                        <x-slot name="actions">
                            <x-jet-action-message class="mr-3" on="saved">
                                {{ __('Contraseña Actualizada.') }}
                            </x-jet-action-message>
                    
                            <x-jet-button>
                                {{ __('Actualizar Contraseña') }}
                            </x-jet-button>
                        </x-slot>
                    </x-jet-form-section>
                    @endif
                    @if ($vista == 4)
                        <h3 class="text-lg font-medium text-gray-900">Cancelar Suscripción</h3>
                        <div class = "p-4">
                            <p class="text-md text-black">Te extrañaremos en OnFlex. Por favor, permite que sepamos porqué nos dejas:</p>
                                <textarea name="motivo" id="motivo" cols="40" rows="5" 
                                class="w-full border-gray-400 rounded-sm focus:border-blue-400"></textarea>
                            <button class = "inline-flex items-center mt-4 px-4 py-2 bg-blue-700 rounded-lg font-bold text-sm text-white uppercase hover:bg-gray-700 active:bg-gray-700 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-600 disabled:opacity-50 transition"
                                wire:click.prevent = "cancelarSuscripción()">
                                Cancelar Suscripción
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <!--footer-->
        <div class="w-full text-center bg-gray-700 font-bold text-green-500 text-md py-8 mt-8">
            OnFlex. Conetando al país. 2022. - Todos los derechos reservados.
        </div>
    </div>
</div>
