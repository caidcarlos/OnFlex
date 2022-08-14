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
        <div class = "flex justify-center w-11/12 md:w-2/3 mx-auto border-r-4 rounded-sm shadow">
            <div class = "w-1/4 md:w-1/3">
                <button class="w-full rounded-tl-md pl-2 py-3 text-left text-sm bg-gray-700 text-white hover:text-green-400 disabled:bg-gray-700 disabled:text-green-400"
                    wire:click.prevent="cambiarVista({{$a}})"
                    @if($vista == 1)
                        disabled
                    @endif
                    >
                    Información General
                </button>
                <button class="w-full pl-2 py-3 text-left text-sm bg-gray-700 text-white hover:text-green-400 disabled:bg-gray-700 disabled:text-green-400"
                    wire:click.prevent="cambiarVista({{$b}})"
                    @if($vista == 2)
                        disabled
                    @endif
                    >
                    Imagen de Perfil
                </button>
                <button class="w-full pl-2 py-3 text-left text-sm bg-gray-700 text-white hover:text-green-400 disabled:bg-gray-700 disabled:text-green-400"
                    wire:click.prevent="cambiarVista({{$c}})"
                    @if($vista == 3)
                        disabled
                    @endif
                    >
                    Actualizar Contraseña
                </button>
                <button class="w-full pl-2 rounded-bl-md py-3 text-left text-sm bg-gray-700 text-white hover:text-green-400 disabled:bg-gray-700 disabled:text-green-400"
                    wire:click.prevent="cambiarVista({{$d}})"
                    @if($vista == 4)
                        disabled
                    @endif
                    >
                    Cancelar Suscripción
                </button>
            </div>
            <div class = "w-3/4 md:w-2/3 border-l-4 border-gray-700">
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
                            <div class="mt-4">
                                <x-jet-label for="razon_social" value="{{ __('Nombre') }}" />
                                <div class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                    ADMINISTRADOR
                                </div>
                            </div>
                        @endif
                        @if(Auth::user()->tipo_usuario == '2')
                            <form method="POST">
                                <div class="mt-4">
                                    <x-jet-label for="razon_social" value="{{ __('Razón Social') }}" />
                                    <input id="razon_social" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" 
                                        type="text" name="razon_social" wire:model.defer="razon_social" required />
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
                                    <button class="inline-flex items-center px-4 py-2 rounded-md bg-gray-700 font-bold text-sm text-white hover:text-green-400 active:bg-gray-700 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-600 disabled:opacity-50 transition"
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
                                        type="text" name="nombre" wire:model.defer = "nombre" required />
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
                                <!--div class="mt-4">
                                    <x-jet-label for="peso" value="{{ __('Peso (en kilogramos. Utilice punto para separar decimal)') }}" />
                                    <input id="peso" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" 
                                        type="text" name="peso" placeholder="90.00" title="Por favor use de separador decimal un punto (.)" maxlength="5" onKeyPress="return validarDecimal(event,this);" wire:model.defer = "peso" required />
                                    @error('peso')
                                        <div class = "text-sm text-red-600 ">{{$message}}</div>
                                    @enderror
                                    @if (session()->has('msj_peso'))
                                        <div class="text-sm text-red-600 ">
                                            {{ session('msj_peso') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="mt-4">
                                    <x-jet-label for="estatura" value="{{ __('Estatura (En metros. Utilice punto para separar decimal)') }}" />
                                    <input id="estatura" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" 
                                        type="text" name="estatura" placeholder="1.86" title="Por favor use de separador decimal un punto (.)" maxlenght="4" onKeyPress="return validarDecimal(event,this);" wire:model.defer = "estatura" required />
                                    @error('estatura')
                                        <div class = "text-sm text-red-600 ">{{$message}}</div>
                                    @enderror
                                    @if (session()->has('msj_estatura'))
                                        <div class="text-sm text-red-600 ">
                                            {{ session('msj_estatura') }}
                                        </div>
                                    @endif

                                </div-->
                                <div class="flex justify-around mt-4">
                                    <button class = "inline-flex items-center px-4 py-2 rounded-md bg-gray-700 font-bold text-sm text-white hover:text-green-400 active:bg-gray-700 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-600 disabled:opacity-50 transition"
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
                        <div>
                            <div class="flex">
                                <div class="sm:w-full md:w-1/3">Imagen Actual</div>
                                <div class="sm:w-full md:w-2/3 text-center">
                                    @if (is_null(Auth::user()->profile_photo_path))
                                        <img src="{{asset('storage/user-img/no-avatar-user.png')}}" width="70%" alt="no-avatar-user">                                        
                                    @else
                                        <img src="{{asset("storage/".Auth::user()->profile_photo_path)}}" width="70%" alt="{{Auth::user()->nombre}}">                                        
                                    @endif
                                </div>
                            </div>
                            <div class="sm:w-full md:w-1/3">
                                <input type="file" wire:model="foto_perfil" />
                                @error('foto_perfil')
                                    <div class = "text-sm text-red-600 ">{{$message}}</div>
                                @enderror
                            </div>
                            <div wire:loading wire:target="foto_perfil"
                                class="py-4 text-center w-ful mx-auto rounded-md text-sm text-white bg-gray-700">
                                <p class="px-4">Un momento, cargando vista previa de imagen seleccionada.</p>
                            </div>
                            @if($foto_perfil)
                                <div class="flex">
                                    <div class="sm:w-full md:w-1/3">Vista Previa</div>
                                    <div class="sm:w-full md:w-2/3 text-center">
                                        <img src="{{$foto_perfil->temporaryUrl()}}" width="70%" > 
                                    </div>                                       
                                </div>
                            @endif
                            <div class="flex justify-around mt-5">
                                <button class = "inline-flex items-center px-4 py-2 rounded-md bg-gray-700 font-bold text-sm text-white hover:text-green-400 active:bg-gray-700 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-600 disabled:opacity-50 transition"
                                    wire:click.prevent = "subirImagen()"
                                    wire:loading.attr = "disabled"
                                    wire:target = "foto_perfil">
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
                        </div>
                    @endif
                    @if ($vista == 3)
                        <h3 class="text-lg font-medium text-gray-900">Actualizar Contraseña</h3>
                        <div class="mt-4">
                            <x-jet-label for="act_pass" value="{{ __('Contraseña Actual') }}" />
                            <input wire:model.defer="act_pass" 
                                class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" 
                                type="password">
                            @error('act_pass')
                                <div class = "text-sm text-red-600 ">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <x-jet-label for="n_pass" value="{{ __('Nueva Contraseña') }}" />
                            <input wire:model.defer="n_pass" 
                                class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" 
                                type="password" >
                            @error('n_pass')
                                <div class = "text-sm text-red-600 ">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <x-jet-label for="conf_pass" value="{{ __('Actualizar Contraseña') }}" />
                            <input wire:model.defer="conf_pass" 
                                class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" 
                                type="password">
                            @error('conf_pass')
                                <div class = "text-sm text-red-600 ">{{$message}}</div>
                            @enderror
                        </div>
                        <div class ="flex justify-around mt-4">
                            <button class = "my-4 inline-flex items-center px-4 py-2 rounded-md bg-gray-700 font-bold text-sm text-white hover:text-green-400 active:bg-gray-700 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-600 disabled:opacity-50 transition"
                            wire:loading.attr = "disabled"
                            wire:click.prevent = "cambiarPassword()">
                            Actualizar Contraseña
                            </button>
                            <div class="mt-4">
                                @if (session()->has('notificacion'))
                                    <div class="text-small text-black bg-green-300 p-2 mr-2 rounded-md">
                                        {{ session('notificacion') }}
                                    </div>
                                @endif
                                @if (session()->has('notificacion-cnc'))
                                    <div class="text-small text-black bg-red-300 p-2 mr-2 rounded-md">
                                        {{ session('notificacion-cnc') }}
                                    </div>
                                @endif
                                @if (session()->has('notificacion-cnv'))
                                    <div class="text-small text-black bg-red-300 p-2 mr-2 rounded-md">
                                        {{ session('notificacion-cnv') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                    @if ($vista == 4)
                        <h3 class="text-lg font-medium text-gray-900">Cancelar Suscripción</h3>
                        <div class = "p-4">
                            <p class="text-md text-black">Te extrañaremos en OnFlex. Por favor, permite que sepamos porqué nos dejas:</p>
                                <textarea name="motivo" id="motivo" cols="40" rows="5" 
                                class="w-full border-gray-400 rounded-sm focus:border-blue-400"></textarea>
                            <button class = "inline-flex items-center px-4 py-2 rounded-md bg-gray-700 hover:bg-green-400 font-bold text-sm text-white hover:text-gray-700 uppercase active:bg-gray-700 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-600 disabled:opacity-50 transition"
                                wire:click.prevent = "cancelarSuscripción()">
                                Cancelar Suscripción
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
        <!--footer-->
        <div class="w-full text-center bottom-0 relative bg-gray-700 font-bold text-green-500 text-md py-8">
            OnFlex. Conetando al país. 2022. - Todos los derechos reservados.
        </div>
</div>
