<div class="fixed w-full inset-0 z-50 overflow-hidden items-center animated fadeIn faster" style="background: rgba(0,0,0,.7);">
    <div class="w-full text-right">
        <button wire:click.prevent="cerrarModalCreate()" class="p-3 text-white mr-2 mt-2">
            X
        </button>
    </div>
    <div class="mx-auto my-auto md:w-3/5 sm:w-5/6 sm:h-1/2 md:h-5/6 bg-white rounded-md overflow-y-scroll">
        <div class="p-4 font-bold text-xl">
            Nueva Propuesta de Viaje
        </div>
        <div class="px-6 pb-w">
            <div class="w-full p-4 flex mx-auto justify-around">
                <div class="mt-4 w-1/2">
                    <select id="origen" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" 
                        name="origen" wire:model.defer="origen" required>
                        <option class="bg-gray-200" value=null>Seleccione la Ciudad Origen</option>
                        @foreach ($ciudades as $ciudad)
                            <option value="{{$ciudad->id}}">{{$ciudad->nombre}}</option>
                        @endforeach
                    </select>
                    @error('origen')
                        <div id="text-sm text-red-500">{{$message}}</div>
                    @enderror
                </div>
                <div class="mt-4 w-1/2 mr-1">
                    <select id="destino" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" 
                        name="destino" wire:model.defer="destino" required>
                        <option class="bg-gray-200" value=null>Seleccione la Ciudad Destino</option>
                        @foreach ($ciudades as $ciudad)
                            <option value="{{$ciudad->id}}">{{$ciudad->nombre}}</option>
                        @endforeach
                    </select>
                    @error('destino')
                        <div id="text-sm text-red-500">{{$message}}</div>
                    @enderror
                </div>
            </div>
            <div class="mt-4">
                <x-jet-label for="fecha_viaje" value="{{ __('Fecha de Viaje') }}" />
                <input id="fecha_viaje" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" 
                    type="date" min="{{date('Y-m-d')}}" name="fecha_viaje" wire:model.defer="fecha_viaje" required />
                @error('fecha_viaje')
                    <div id="text-sm text-red-500">{{$message}}</div>
                @enderror
            </div>
            <div class="mt-4">
                <x-jet-label for="tipo_viaje" value="{{ __('Tipo de Viaje') }}" />
                <select id="tipo_viaje" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" 
                    name="tipo_viaje" wire:model="tipo_viaje" required>
                    <option class="bg-gray-200" value=null>Seleccione un Tipo de Viaje</option>
                    <option value="COMPLETO">Completo</option>
                    <option value="FRACCIONADO">Fraccionado</option>
                </select>
                @error('tipo_viaje')
                    <div id="text-sm text-red-500">{{$message}}</div>
                @enderror
            </div>
            <div class="mt-4">
                <x-jet-label for="carga_total" value="{{ __('Peso de Carga Total (En Kilogramos)') }}" />
                <input type="number" id="carga_total" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" 
                    name="carga_total" wire:model.defer="carga_total" required>
                @error('carga_total')
                    <div id="text-sm text-red-500">{{$message}}</div>
                @enderror
            </div>
            <div class="mt-4">
                <x-jet-label for="observacion" value="{{ __('Observación') }}" />
                <input type="text" id="observacion" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" 
                    name="observacion" wire:model.defer="observacion" required>
                @error('observacion')
                    <div id="text-sm text-red-500">{{$message}}</div>
                @enderror
            </div>
            <div class="mx-auto md:flex md:justify-between w-11/12 mt-4">
                <div class="md:w-1/2 sm:w-full sm:text-center">
                    <button class="inline-flex items-center px-4 py-2 rounded-md bg-gray-700 hover:bg-green-400 font-bold text-sm text-white hover:text-gray-700 uppercase active:bg-gray-700 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-600 disabled:opacity-50 transition"
                        wire:click.prevent = "guardar()"
                        wire:loading.attr="disabled">
                        Guardar
                    </button>
                </div>
                <div class="md:w-1/2 sm:w-full sm:text-center sm:mt-2 md:mt-0">
                    <button class="inline-flex items-center px-4 py-2 rounded-md bg-gray-700 hover:bg-green-400 font-bold text-sm text-white hover:text-gray-700 uppercase active:bg-gray-700 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-600 disabled:opacity-50 transition"
                        wire:click.prevent = "cerrarModalCreate()"
                        wire:loading.attr="disabled">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>