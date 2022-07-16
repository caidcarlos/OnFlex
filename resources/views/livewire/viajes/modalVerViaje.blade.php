<div class="fixed w-full inset-0 z-50 overflow-hidden items-center animated fadeIn faster" style="background: rgba(0,0,0,.7);">
    <div class="w-full text-right">
        <button wire:click.prevent="cerrarModalVerViaje()" class="p-3 text-white mr-2 mt-2">
            X
        </button>
    </div>
    <div class="mx-auto my-auto md:w-3/5 sm:w-5/6 sm:h-1/2 md:h-5/6 bg-white rounded-md overflow-y-scroll">
        <div class="p-4 font-bold text-xl">
            Detalle de Viaje
        </div>
        <div class="px-6 pb-2 mx-auto">
            @foreach ($detallesV as $dv)
                <div class="w-full p-4 md:flex md:justify-around">
                    <div class="mt-4 sm:w-full md:w-1/2">
                        <x-jet-label for="carga_total" value="{{ __('Ciudad Origen') }}" />
                        @foreach ($ciudades as $ciudad)
                            @if ($ciudad->id == $dv->origen)
                                {{$ciudad->nombre}}
                            @endif
                        @endforeach
                    </div>
                    <div class="mt-4 sm:w-full md:w-1/2">
                        <x-jet-label for="carga_total" value="{{ __('Ciudad Destino') }}" />
                        @foreach ($ciudades as $ciudad)
                            @if ($ciudad->id == $dv->destino)
                                {{$ciudad->nombre}}
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="w-full p-4 md:flex md:justify-around">
                    <div class="mt-4 sm:w-full md:w-1/2">
                        <x-jet-label for="fecha_viaje" value="{{ __('Fecha de Viaje') }}" />
                        <div class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"> 
                            {{date("d-m-Y", strtotime($dv->fecha_viaje))}}
                        </div>
                    </div>
                    <div class="mt-4 sm:w-full md:w-1/2">
                        <x-jet-label for="tipo_viaje" value="{{ __('Tipo de Viaje') }}" />
                        <div class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                            {{$dv->tipoV}}
                        </div>
                    </div>
                </div>
                <div class="w-full p-4 md:flex md:justify-start">
                    <div class="mt-4 sm:w-full md:w-1/2">
                        <x-jet-label for="carga_total" value="{{ __('Peso de Carga Total') }}" />
                        <div class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                            {{$dv->peso_carga}} Kilogramos
                        </div>
                    </div>
                    @if (Auth::user()->tipo_usuario == 3)
                        <div class="mt-4 sm:w-full md:w-1/2">
                            <x-jet-label for="empresa" value="{{ __('Empresa') }}" />
                            <div class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                <button wire:click.prevent="verPerfil({{$dv->idE}})" title="Haz clic para ver perfil de {{$dv->nombreE}}"
                                    class="text-gray-700 bg-transparent p-0 underline underline-offset-2">
                                    {{$dv->nombreE}}
                                <button>
                            </div>
                        </div>
                    @endif
                    @if (Auth::user()->tipo_usuario == 2)
                        <div class="mt-4 sm:w-full md:w-1/2">
                            <x-jet-label for="transportista" value="{{ __('Transportista') }}" />
                            <div class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                <button wire:click.prevent="verPerfil({{$dv->idT}})" title="Haz clic para ver perfil de {{$dv->nombreT}} {{$dv->apellidoT}}"
                                    class="text-gray-700 bg-transparent p-0 underline underline-offset-2">
                                    {{$dv->nombreT}} {{$dv->apellidoT}}
                                <button>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="w-full p-4 md:flex md:justify-start">
                    <div class="mt-4 w-full">
                        <x-jet-label for="observaciones" value="{{ __('Observaciones') }}" />
                        <div class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                            {{$dv->observacion}}
                        </div>
                    </div>
                </div>                
                <div class="w-full p-4 md:flex md:justify-start">
                    <div class="mt-4 w-full">
                        <x-jet-label for="estadoV" value="{{ __('Estado del Viaje') }}" />
                        <div class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                            @if ((Auth::user()->tipo_usuario == 1) OR (Auth::user()->tipo_usuario == 2))
                                {{$dv->estadoV}}
                            @endif
                            @if (Auth::user()->tipo_usuario == 3)
                                <select wire:model.defer = "estadoV" 
                                    class = "block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                @switch($dv->estadoV)
                                    @case('LISTA DE CARGA')
                                            <option value="LISTA DE CARGA">En lista de carga</option>
                                            <option value="CARGANDO">Cargando</option>
                                        @break
                                    @case('CARGANDO')
                                            <option value="CARGANDO">Cargando</option>
                                            <option value="EN VÍA">En la vía</option>
                                        @break
                                    @case('EN VÍA')
                                            <option value="EN VÍA">En la vía</option>
                                            <option value="PERNOCTANDO">Pernoctando</option>
                                            <option value="EN TRANCA">En tranca</option>
                                            <option value="LISTA DE DESCARGA">En lista de Descarga</option>
                                        @break
                                    @case('PERNOCTANDO')
                                            <option value="PERNOCTANDO">Pernoctando</option>
                                            <option value="EN VÍA">En la vía</option>
                                            <option value="EN TRANCA">En tranca</option>
                                        @break
                                    @case('EN TRANCA')
                                            <option value="EN TRANCA">En tranca</option>
                                            <option value="EN VÍA">En la vía</option>
                                            <option value="PERNOCTANDO">Pernoctando</option>
                                        @break
                                    @case('LISTA DE DESCARGA')
                                            <option value="EN LISTA DE DESCARGA">En lista de Descarga</option>
                                            <option value="DESCARGANDO">Descargando</option>
                                        @break
                                    @case('DESCARGANDO')
                                            <option value="DESCARGANDO">Descargando</option>
                                            <option value="TERMINADO">Terminado</option>
                                        @break
                                    @case('TERMINADO')
                                            <option value="TERMINADO">Terminado</option>
                                        @break
                                @endswitch
                                </select>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="mx-auto flex justify-between w-11/12 mt-4">
                    @if((Auth::user()->tipo_usuario == 3) && ($dv->estadoV != 'TERMINADO'))
                        <div class="w-full sm:text-center sm:mt-2 md:mt-0">
                            <button class="inline-flex items-center px-4 py-2 rounded-md bg-gray-700 font-bold text-sm text-white hover:text-green-400 active:bg-gray-700 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-600 disabled:opacity-50 transition"
                                wire:click.prevent = "actualizarEstado({{$dv->idV}})"
                                wire:loading.attr = "disabled">
                                Guardar Cambios
                            </button>
                        </div>
                    @endif
                    <div class="w-full sm:text-center sm:mt-2 md:mt-0">
                        <button class="inline-flex items-center px-4 py-2 rounded-md bg-gray-700 font-bold text-sm text-white hover:text-green-400 active:bg-gray-700 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-600 disabled:opacity-50 transition"
                            wire:click.prevent = "cerrarModalVerViaje()"
                            wire:loading.attr="disabled">
                            Cerrar
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>