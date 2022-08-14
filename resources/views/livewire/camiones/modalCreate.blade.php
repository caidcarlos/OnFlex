<div class="fixed w-full inset-0 z-50 overflow-hidden items-center animated fadeIn faster" style="background: rgba(0,0,0,.7);">
    <div class="w-full text-right">
        <button wire:click.prevent="cerrarModalCreate()" class="p-3 text-white mr-2 mt-2">
            X
        </button>
    </div>
    <div class="mx-auto my-auto md:w-3/5 w-5/6 sm:h-1/2 md:h-5/6 bg-white rounded-md overflow-y-scroll">
        <div class="p-4 font-bold text-xl">
            Nuevo Camión
        </div>
        <div class="px-6 pb-2">
            <div class="mt-4">
                <x-jet-label for="placa" value="{{ __('Placa') }}" />
                <input id="placa" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" 
                    type="text" min="6" name="placa" wire:model.defer="placa" required />
                @error('placa')
                    <div id="text-sm text-red-500">{{$message}}</div>
                @enderror
            </div>
            <div class="mt-4">
                <x-jet-label for="peso_soporte" value="{{ __('Peso de Soporte (En Toneladas)') }}" />
                <input id="peso_soporte" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" 
                    type="text" name="peso_soporte" placeholder="1.86" title="Por favor use de separador decimal un punto (.)" maxlenght="5" onKeyPress="return validarDecimal(event,this);" wire:model.defer="peso_soporte" required />
                @error('peso_soporte')
                    <div id="text-sm text-red-500">{{$message}}</div>
                @enderror
            </div>
            <div class="mt-4">
                <x-jet-label for="anno" value="{{ __('Año') }}" />
                <input id="anno" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" 
                    type="number" min="2000" max="{{date('Y')}}" step="1.0" name="anno" wire:model.defer="anno" required />
                @error('anno')
                    <div id="text-sm text-red-500">{{$message}}</div>
                @enderror
            </div>
            <div class="mt-4">
                <x-jet-label for="marca" value="{{ __('Marca') }}" />
                <select id="marca" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" 
                    name="marca" wire:model="marca" required>
                    <option class="bg-gray-200" value=null>Seleccione una Marca</option>
                    @foreach ($marcas as $marca)
                        <option value="{{$marca->id}}">{{$marca->nombre}}</option>
                    @endforeach
                </select>
                @error('marca')
                    <div id="text-sm text-red-500">{{$message}}</div>
                @enderror
            </div>
            <div class="mt-4">
                <x-jet-label for="modelo" value="{{ __('Modelo') }}" />
                <input id="modelo" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" 
                    type="text" min="6" name="modelo" wire:model.defer="modelo" required />
                @error('modelo')
                    <div id="text-sm text-red-500">{{$message}}</div>
                @enderror
            </div>
            <div class="mt-4">
                <x-jet-label for="tipo_camion" value="{{ __('Tipo de Camion') }}" />
                <select id="tipo_camion_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" 
                    name="tipo_camion_id" wire:model.defer="tipo_camion_id" required>
                    <option class="bg-gray-200" value=null>Seleccione un Tipo de Camión</option>
                    @foreach ($tipoCamion as $tc)
                        <option value="{{$tc->id}}">{{$tc->nombre}}</option>
                    @endforeach
                </select>
                @error('tipo_camion_id')
                    <div id="text-sm text-red-500">{{$message}}</div>
                @enderror
            </div>
            <div class="mx-auto flex justify-between w-full mt-4">
                <div class="w-1/2 sm:text-center">
                    <button class="inline-flex items-center px-4 py-2 rounded-md bg-gray-700 font-bold text-sm text-white hover:text-green-400 active:bg-gray-700 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-600 disabled:opacity-50 transition"
                        wire:click.prevent = "guardar()"
                        wire:loading.attr="disabled">
                        Guardar
                    </button>
                </div>
                <div class="md:w-1/2 sm:text-center">
                    <button class="inline-flex items-center px-4 py-2 rounded-md bg-gray-700 font-bold text-sm text-white hover:text-green-400 active:bg-gray-700 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-600 disabled:opacity-50 transition"
                        wire:click.prevent = "cerrarModalCreate()"
                        wire:loading.attr="disabled">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>