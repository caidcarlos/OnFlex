<div>
    <x-guest-layout>
        <x-jet-authentication-card>
            <x-slot name="logo">
                <x-jet-authentication-card-logo />
            </x-slot>
            
            @if (Auth::user()->tipo_usuario == '2')
                <div class="mb-4 text-sm text-[#303c4e]">
                    {{ __('¡Muy bien! Antes de comenzar a utilizar la aplicación, por favor tómate unos minutos para completar tu perfil de usuario') }}
                </div>    
            @endif
            @if (Auth::user()->tipo_usuario == '3')
                <div class="mb-4 text-sm text-[#303c4e]">
                    {{ __('¡Muy bien! Hemos validado tu pago. Antes de comenzar a utilizar la aplicación, por favor tómate unos minutos para completar tu perfil de usuario') }}
                </div>
            @endif
    
            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-[#00f2a1]">
                    {{ session('status') }}
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
                        <x-jet-label for="nombre_rep" value="{{ __('Nombre de Responsable') }}" />
                        <input id="nombre_rep" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" 
                            type="text" name="nombre_rep" wire:model.defer = "nombre_rep" required />
                        @error('nombre_rep')
                            <div id="text-sm text-red-500">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mt-4">
                        <x-jet-label for="apellido_rep" value="{{ __('Apellido de Responsable') }}" />
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
                    <div class="mt-4">
                        <x-jet-label for="comercial" value="{{ __('Asesorado por:') }}" />
                        <select id="comercial" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" 
                            type="text" name="comercial" wire:model.defer = "comercial" required>
                            <option value=null>Seleccione un comercial de la lista</option>
                            @foreach ($comerciales as $comercial)
                                <option value="{{$comercial->id}}">{{$comercial->nombre}} {{$comercial->apellidos}}</option>
                            @endforeach
                        </select>
                        @error('comercial')
                            <div id="text-sm text-red-500">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mt-4">
                        <button class="inline-flex items-center px-4 py-2 rounded-md bg-gray-700 font-bold text-sm text-white hover:text-green-400 active:bg-gray-700 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-600 disabled:opacity-50 transition"
                            wire:click.prevent = "guardarEmpresa({{Auth::user()->id}})">
                            Guardar Cambios
                        </button>
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
                        <x-jet-label for="num_pase" value="{{ __('Número de Licencia') }}" />
                        <input id="licencia" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" 
                            type="text" name="licencia" wire:model.defer = "licencia" required />
                        @error('licencia')
                            <div class = "text-sm text-red-600 ">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mt-4">
                        <x-jet-label for="peso" value="{{ __('Peso (En kilogramos. Utilice punto para separar decimal)') }}" />
                        <input id="peso" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" 
                            type="number" name="peso" placeholder="90.00" wire:model.defer = "peso" required />
                        @error('peso')
                            <div class = "text-sm text-red-600 ">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mt-4">
                        <x-jet-label for="estatura" value="{{ __('Estatura (En metros. Utilice punto para separar decimal)') }}" />
                        <input id="estatura" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" 
                            type="number" name="estatura" placeholder="1.86" wire:model.defer = "estatura" required />
                        @error('estatura')
                            <div class = "text-sm text-red-600 ">{{$message}}</div>
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
                    <div class="mt-4">
                        <x-jet-label for="comercial" value="{{ __('Asesorado por:') }}" />
                        <select id="comercial" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" 
                            type="text" name="comercial" wire:model.defer = "comercial" required>
                            <option value=null>Seleccione un comercial de la lista</option>
                            @foreach ($comerciales as $comercial)
                                <option value="{{$comercial->id}}">{{$comercial->nombre}} {{$comercial->apellidos}}</option>
                            @endforeach
                        </select>
                        @error('comercial')
                            <div id="text-sm text-red-500">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mt-4">
                        <button class = "inline-flex items-center px-4 py-2 rounded-md bg-[#303c4e] font-bold text-sm text-white hover:text-[#00f2a1] active:bg-[#303c4e] focus:outline-none focus:border-[#303c4e] focus:ring focus:ring-[#303c4e] disabled:opacity-50 transition"
                            wire:click.prevent = "guardarTransportista({{Auth::user()->id}})">
                            Guardar Cambios
                        </button>
                    </div>
                </form>
            @endif
        </x-jet-authentication-card>
    </x-guest-layout>
</div>
