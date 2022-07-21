<div class="fixed w-full inset-0 z-50 overflow-hidden items-center animated fadeIn faster" style="background: rgba(0,0,0,.7);">
    <div class="w-full text-right">
        <button wire:click.prevent="cerrarModalUpdate()" class="p-3 text-white mr-2 mt-2">
            X
        </button>
    </div>
    <div class="mx-auto my-auto md:w-3/5 sm:w-5/6 sm:h-1/2 md:h-5/6 bg-white rounded-md overflow-y-scroll">
        <div class="p-4 font-bold text-xl">
            Detalle de Viaje
        </div>
        <div class="px-6 pb-2 mx-auto">
            <div class="w-full p-4 md:flex md:justify-around">
                <div class="mt-4 sm:w-full md:w-1/2">
                    <x-jet-label for="carga_total" value="{{ __('Ciudad Origen') }}" />
                    @foreach ($ciudades as $ciudad)
                        @if ($ciudad->id == $origen)
                            {{$ciudad->nombre}}
                        @endif
                    @endforeach
                </div>
                <div class="mt-4 sm:w-full md:w-1/2">
                    <x-jet-label for="carga_total" value="{{ __('Ciudad Destino') }}" />
                    @foreach ($ciudades as $ciudad)
                        @if ($ciudad->id == $destino)
                            {{$ciudad->nombre}}
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="w-full p-4 md:flex md:justify-around">
                <div class="mt-4 sm:w-full md:w-1/2">
                    <x-jet-label for="fecha_viaje" value="{{ __('Fecha de Viaje') }}" />
                    <div class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"> 
                        {{date("d-m-Y", strtotime($fecha_viaje))}}
                    </div>
                </div>
                <div class="mt-4 sm:w-full md:w-1/2">
                    <x-jet-label for="tipo_viaje" value="{{ __('Tipo de Viaje') }}" />
                    <div class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                        {{$tipo_viaje}}
                    </div>
                </div>
            </div>
            <div class="w-full p-4 md:flex md:justify-start">
                <div class="mt-4 sm:w-full md:w-1/2">
                    <x-jet-label for="carga_total" value="{{ __('Peso de Carga Total') }}" />
                    <div class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                        {{$carga_total}} Kilogramos
                    </div>
                </div>
                @if (Auth::user()->tipo_usuario == 3)
                    <div class="mt-4 sm:w-full md:w-1/2">
                        <x-jet-label for="empresa" value="{{ __('Empresa') }}" />
                        <div class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                            <button wire:click.prevent="verPerfil({{$perfil_id}})" title="Haz clic para ver perfil de {{$empresa}}"
                                class="text-gray-700 bg-transparent p-0 underline underline-offset-2">
                                {{$empresa}}
                            <button>
                        </div>
                    </div>
                @endif
            </div>
            <div class="w-full p-4 md:flex md:justify-start">
                <div class="mt-4 w-full">
                    <x-jet-label for="observaciones" value="{{ __('Observaciones') }}" />
                    <div class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                        {{$observacion}}
                    </div>
                </div>
            </div>
            @if(Auth::user()->tipo_usuario == 3)
                <div class = "w-full border border-gray-700 rounded-sm">
                    <div class = "text-lg text-center text-white py-2 px-4 font-bold bg-gray-700 w-full">
                        Estado de tu solicitud
                    </div>
                    @if(($solicitudesViaje == null) OR ($solicitudesViaje->isEmpty()))
                        <div class = "text-md text-black text-center py-2">No has hecho ninguna solicitud para esta propuesta de viaje.</div>
                    @else
                        @foreach ($solicitudesViaje as $solV)
                            @switch($solV->estado)
                                @case('EN ESPERA')
                                    <div class = "text-md text-black text-center py-2">Su solicitud está en espera de respuesta por la empresa.</div>
                                    @break
                                @case('APROBADO')
                                    <div class = "text-md text-black text-center py-2">Su solicitud ha sido aprobada. Ir a <a href="{{route('viajes')}}"
                                        class ="text-gray-700 bg-transparent p-0 underline underline-offset-2">
                                            Mis Viajes
                                        </a>
                                    </div>
                                    @break
                                @case('RECHAZADO')
                                    <div class = "text-md text-black text-center py-2">Su solicitud ha sido rechazada. <button
                                        class="text-gray-700 bg-transparent p-0 underline underline-offset-2 hover:bg-green-400"
                                        wire:click.prevent = "resolicitarViaje({{$solV->idSolic}})"
                                        wire:loading.attr="disabled">
                                            Solicitar de nuevo
                                        </button>
                                    </div>
                                    @break
                            @endswitch
                        @endforeach
                    @endif
                </div>
            @endif
            @if(Auth::user()->tipo_usuario == 2)
                <div class = "w-full border border-gray-700 rounded-sm">
                    <div class = "text-lg text-center text-white py-2 px-4 font-bold bg-gray-700 w-full">
                        Solicitudes del Viaje
                    </div>
                    @if(($solicitudesViaje == null) OR ($solicitudesViaje->isEmpty()))
                        <div class = "text-md text-black text-center py-2">Esta propuesta no tiene solicitudes todavía</div>
                    @else
                        @foreach ($solicitudesViaje as $solV)
                            <div class = "w-full sm:text-sm md:text-md hover:bg-gray-300 flex justify-around">
                                <div class = "p-2 w-1/2">
                                    <button wire:click.prevent="verPerfil({{$solV->idT}})" title="Haz clic para ver perfil del transportista {{$solV->nombreT}} {{$solV->apellidoT}}"
                                        class="text-gray-700 bg-transparent sm:py-0 md:py-2 underline underline-offset-2">
                                        {{$solV->nombreT}} {{$solV->apellidoT}}
                                    <button>
                                </div>
                                @if ($solV->estado == 'EN ESPERA')
                                    <div class = "p-2 w-1/4 text-right">
                                        <button wire:click.prevent="aceptarSolicitudViaje({{$solV->idSolic}})"
                                            wire:loading.attr = "disabled"
                                            class="inline-flex items-center px-4 py-2 bg-gray-700 hover:bg-green-500 font-bold text-sm text-white uppercase active:bg-gray-700 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-600 disabled:opacity-50 transition">
                                            Aceptar
                                        <button>
                                    </div>
                                    <div class = "p-2 w-1/4 text-right">
                                        <button wire:click.prevent="rechazarSolicitudViaje({{$solV->idSolic}})"
                                            class="inline-flex items-center px-4 py-2 bg-gray-700 hover:bg-green-500 font-bold text-sm text-white uppercase active:bg-gray-700 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-600 disabled:opacity-50 transition">
                                            Rechazar
                                        <button>
                                    </div>
                                @endif
                                @if ($solV->estado == 'APROBADO')
                                    <div class = "p-2  w-1/2 text-right">
                                        ¡Aprobado! <button wire:click.prevent="reconsiderarSolicitudViaje({{$solV->idSolic}})"
                                            wire:loading.attr = "disabled"
                                            class="inline-flex items-center px-4 py-2 bg-gray-700 hover:bg-green-500 font-bold text-sm text-white uppercase active:bg-gray-700 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-600 disabled:opacity-50 transition">
                                            Deshacer
                                        <button>
                                    </div>
                                @endif
                                @if ($solV->estado == 'VIAJE INICIADO')
                                    <div class = "p-2  w-1/2 text-right">
                                        ¡Ya el viaje ha sido iniciado! Puede ver los detalles en <a href="{{route('viajes')}}">'Mis Viajes'</a>.
                                    </div>
                                @endif
                                @if ($solV->estado == 'RECHAZADO')
                                    <div class = "p-2  w-1/2 text-right">
                                        <button wire:click.prevent="reconsiderarSolicitudViaje({{$solV->idSolic}})"
                                            disabled
                                            class="inline-flex items-center px-4 py-2 bg-gray-700 hover:bg-green-500 font-bold text-sm text-white uppercase active:bg-gray-700 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-600 disabled:opacity-50 transition">
                                                RECHAZADA
                                        </button>
                                    </div>
                                @endif
                                @if ($solV->estado == 'VIAJE EMPEZADO')
                                    <div class = "p-2  w-1/2 text-right">
                                        ¡Viaje empezado! <button wire:click.prevent="verViaje({{$solV->idSolic}})"
                                            class="inline-flex items-center px-4 py-2 bg-gray-700 hover:bg-green-500 font-bold text-sm text-white uppercase active:bg-gray-700 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-600 disabled:opacity-50 transition">
                                                Ver Viaje
                                        </button>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    @endif
                </div>
            @endif
            <div class="mx-auto md:flex md:justify-between w-11/12 mt-4">
                <div class="w-full sm:text-center sm:mt-2 md:mt-0">
                    <button class="inline-flex items-center px-4 py-2 rounded-md bg-gray-700 font-bold text-sm text-white hover:text-green-400 active:bg-gray-700 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-600 disabled:opacity-50 transition"
                        wire:click.prevent = "cerrarModalUpdate()"
                        wire:loading.attr = "disabled"
                        wire:loading.attr="disabled">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>