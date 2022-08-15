<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#303c4e] leading-tight">
            {{ __('Viajes') }}
        </h2>
    </x-slot>
    <div class="bg-white min-h-screen min-w-screen border-t border-gray-400 pt-2">
        <div class="mt-1 mx-auto">
            @if($modalVerViaje)
                @include('livewire.viajes.modalVerViaje')
            @endif
            @if($modalVerGastos)
                @include('livewire.viajes.modalVerGastos')
            @endif
            @if (Auth::user()->tipo_usuario == 2)
                <div class="mt-4 shadow w-11/12 mx-auto overflow-x-auto relative">
                    <div class = "text-lg text-[#303c4e] text-center uppercase font-bold py-4 w-full bg-white">
                        Viajes en Curso
                    </div>
                    <table class="px-2 w-full border-1 border-[#303c4e] rounded-sm">
                        <thead>
                            <tr class="bg-[#303c4e]">
                                <th class="w-1/5 text-white font-bold py-2 text-md border border-[#303c4e]">
                                    Origen / Destino
                                </th>
                                <th class="w-1/5 text-white font-bold py-2 text-md border border-[#303c4e]">
                                    Fecha de Viaje
                                </th>
                                <th class="w-1/5 text-white font-bold py-2 text-md border border-[#303c4e]">
                                    Transportista
                                </th>
                                <th class="w-1/5 text-white font-bold py-2 text-md border border-[#303c4e]">
                                    Estado
                                </th>
                                <th class="w-1/5 text-white font-bold py-2 text-md border border-[#303c4e]">
                                    Opciones
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($viajesEnCurso->isEmpty())
                                <tr>
                                    <td colspan="5">
                                        <div class = "text-black font-bold text-sm text-center py-2">
                                            Disculpe, no tiene viajes en curso...
                                        </div>
                                    </td>
                                </tr>
                            @endif
                            @foreach ($viajesEnCurso as $vec)
                                <tr class="hover:bg-gray-200 text-sm text-center">
                                    <td>
                                        @foreach ($ciudades as $city)
                                            @if ($vec->origen == $city->id)
                                                {{$city->nombre}} /
                                            @endif
                                        @endforeach
                                        @foreach ($ciudades as $city)
                                            @if ($vec->destino == $city->id)
                                                {{$city->nombre}}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>{{date('d-m-Y', strtotime($vec->fechaV))}}</td>
                                    <td>
                                        <!--button wire:click.prevent = "verPerfil({{$vec->idT}})" title="Haga clic para ver perfil de {{$vec->nombreT}} {{$vec->apellidoT}}"
                                            class="bd-transparent p-0 underline"-->
                                            {{$vec->nombreT}} {{$vec->apellidoT}}
                                        <!--/button-->
                                    </td>
                                    <td>{{$vec->estadoV}}</td>
                                    <td>
                                        <button class="inline-flex items-center px-4 py-2 rounded-md bg-[#303c4e] font-bold text-sm text-white hover:text-[#00f2a1] active:bg-[#303c4e] focus:outline-none focus:border-[#303c4e] focus:ring focus:ring-gray-600 disabled:opacity-50 transition"
                                            wire:click.prevent = "verDetalleViaje({{$vec->idV}})">
                                                Ver Detalles
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="py-2">{{$viajesEnCurso->links()}}</div>
                <div class = "mt-4 text-lg text-[#303c4e] text-center font-bold py-4 w-full bg-whiteuppercase">
                    Viajes Terminados
                </div>
                <div class="mt-4 shadow w-11/12 mx-auto overflow-x-auto relative">
                    <table class="px-2 w-full border-1 border-[#303c4e] rounded-sm">
                        <thead>
                            <tr class="bg-[#303c4e]">
                                <th class="w-1/5 text-white font-bold py-2 text-md border border-[#303c4e]">
                                    Origen / Destino
                                </th>
                                <th class="w-1/5 text-white font-bold py-2 text-md border border-[#303c4e]">
                                    Fecha de Viaje
                                </th>
                                <th class="w-1/5 text-white font-bold py-2 text-md border border-[#303c4e]">
                                    Transportista
                                </th>
                                <th class="w-1/5 text-white font-bold py-2 text-md border border-[#303c4e]">
                                    Estado
                                </th>
                                <th class="w-1/5 text-white font-bold py-2 text-md border border-[#303c4e]">
                                    Opciones
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($viajesTerminados->isEmpty())
                                <tr>
                                    <td colspan="5">
                                        <div class = "text-black font-bold text-sm text-center py-2">
                                            Disculpe, no tiene viajes terminados...
                                        </div>
                                    </td>
                                </tr>
                            @endif
                            @foreach ($viajesTerminados as $vt)
                                <tr class="hover:bg-gray-200 text-sm text-center">
                                    <td>
                                        @foreach ($ciudades as $city)
                                            @if ($vt->origen == $city->id)
                                                {{$city->nombre}} /
                                            @endif
                                        @endforeach
                                        @foreach ($ciudades as $city)
                                            @if ($vt->destino == $city->id)
                                                {{$city->nombre}}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>{{date('d-m-Y'), strtotime($vt->fechaV)}}</td>
                                    <td>
                                        <!--button wire:click.prevent = "verPerfil({{$vt->idT}})" title="Haga clic para ver perfil de {{$vt->nombreT}} {{$vt->apellidoT}}"
                                            class="bd-transparent p-0 underline"-->
                                            {{$vt->nombreT}} {{$vt->apellidoT}}
                                        <!--/button-->
                                    </td>
                                    <td>{{$vt->estadoV}}</td>
                                    <td>
                                        <button class="inline-flex items-center px-4 py-2 rounded-md bg-[#303c4e] font-bold text-sm text-white hover:text-[#00f2a1] active:bg-[#303c4e] focus:outline-none focus:border-[#303c4e] focus:ring focus:ring-gray-600 disabled:opacity-50 transition"
                                            wire:click.prevent = "verDetalleViaje({{$vt->idV}})">
                                                Ver Detalles
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="py-2">{{$viajesTerminados->links()}}</div>
            @endif
            @if (Auth::user()->tipo_usuario == 3)
                <div class="mt-4 shadow w-11/12 mx-auto overflow-x-auto relative">
                    <div class = "text-lg text-[#303c4e] text-center font-bold py-4 w-full bg-white uppercase">
                        Viajes en Curso
                    </div>
                    <table class="px-2 w-full border-1 border-[#303c4e] rounded-sm">
                        <thead>
                            <tr class="bg-[#303c4e]">
                                <th class="w-1/5 text-white font-bold py-2 text-md border border-[#303c4e]">
                                    Origen / Destino
                                </th>
                                <th class="w-1/5 text-white font-bold py-2 text-md border border-[#303c4e]">
                                    Fecha de Viaje
                                </th>
                                <th class="w-1/5 text-white font-bold py-2 text-md border border-[#303c4e]">
                                    Empresa
                                </th>
                                <th class="w-1/5 text-white font-bold py-2 text-md border border-[#303c4e]">
                                    Estado
                                </th>
                                <th class="w-1/5 text-white font-bold py-2 text-md border border-[#303c4e]">
                                    Opciones
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($viajesEnCurso->isEmpty())
                                <tr>
                                    <td colspan="5">
                                        <div class = "text-black font-bold text-sm text-center py-2">
                                            Disculpe, no tiene viajes en curso...
                                        </div>
                                    </td>
                                </tr>
                            @endif
                            @foreach ($viajesEnCurso as $vec)
                                <tr class="hover:bg-gray-200 text-sm text-center">
                                    <td>
                                        @foreach ($ciudades as $city)
                                            @if ($vec->origen == $city->id)
                                                {{$city->nombre}} /
                                            @endif
                                        @endforeach
                                        @foreach ($ciudades as $city)
                                            @if ($vec->destino == $city->id)
                                                 {{$city->nombre}}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>{{date('d-m-Y', strtotime($vec->fechaV))}}</td>
                                    <td>
                                        <!--button wire:click.prevent = "verPerfil({{$vec->idE}})" title="Haga clic para ver perfil de {{$vec->nombreE}}"
                                            class="bd-transparent p-0 underline"-->
                                            {{$vec->nombreE}}
                                        <!--/button-->
                                    </td>
                                    <td>{{$vec->estadoV}}</td>
                                    <td>
                                        <div class = "w-full md:flex md:justify-around">
                                            <button class="inline-flex mb-1 mr-0 md:mb-0 md:mr-1 items-center px-4 py-2 rounded-md bg-[#303c4e] font-bold text-sm text-white hover:text-[#00f2a1] active:bg-[#303c4e] focus:outline-none focus:border-[#303c4e] focus:ring focus:ring-gray-600 disabled:opacity-50 transition"
                                                wire:click.prevent = "verDetalleViaje({{$vec->idV}})">
                                                    Ver Detalles
                                            </button>
                                            <button class="inline-flex mt-1 mr-0 md:mt-0 md:mr-1 items-center px-4 py-2 rounded-md bg-[#303c4e] font-bold text-sm text-white hover:text-[#00f2a1] active:bg-[#303c4e] focus:outline-none focus:border-[#303c4e] focus:ring focus:ring-gray-600 disabled:opacity-50 transition"
                                                wire:click.prevent = "verGastos({{$vec->idV}})">
                                                    Ver Gastos
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-4 shadow w-11/12 mx-auto overflow-x-auto relative">
                    <div class = "mt-4 text-lg text-[#303c4e] text-center font-bold py-4 w-full bg-white uppercase">
                        Viajes Terminados
                    </div>
                    <table class="px-2 w-full border-1 border-[#303c4e] rounded-sm">
                        <thead>
                            <tr class="bg-[#303c4e]">
                                <th class="w-1/5 text-white font-bold py-2 text-md border border-[#303c4e]">
                                    Origen / Destino
                                </th>
                                <th class="w-1/5 text-white font-bold py-2 text-md border border-[#303c4e]">
                                    Fecha de Viaje
                                </th>
                                <th class="w-1/5 text-white font-bold py-2 text-md border border-[#303c4e]">
                                    Empresa
                                </th>
                                <th class="w-1/5 text-white font-bold py-2 text-md border border-[#303c4e]">
                                    Estado
                                </th>
                                <th class="w-1/5 text-white font-bold py-2 text-md border border-[#303c4e]">
                                    Opciones
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($viajesTerminados->isEmpty())
                                <tr>
                                    <td colspan="5">
                                        <div class = "text-black font-bold text-sm text-center py-2">
                                            Disculpe, no tiene viajes terminados...
                                        </div>
                                    </td>
                                </tr>
                            @endif
                            @foreach ($viajesTerminados as $vt)
                                <tr class="hover:bg-gray-200 text-sm text-center">
                                    <td>
                                        @foreach ($ciudades as $city)
                                            @if ($vt->origen == $city->id)
                                                {{$city->nombre}} /
                                            @endif
                                        @endforeach
                                        @foreach ($ciudades as $city)
                                            @if ($vt->destino == $city->id)
                                                {{$city->nombre}}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>{{date('d-m-Y', strtotime($vt->fechaV))}}</td>
                                    <td>
                                        <!--button wire:click.prevent = "verPerfil({{$vt->idE}})" title="Haga clic para ver perfil de {{$vt->nombreE}}"
                                            class="bd-transparent p-0 underline"-->
                                            {{$vt->nombreE}}
                                        <!--/button-->
                                    </td>
                                    <td>{{$vt->estadoV}}</td>
                                    <td>
                                        <div class = "w--full md:flex md:justify-around">
                                            <button class="inline-flex mb-1 mr-0 md:mb-0 md:mr-1 items-center px-4 py-2 rounded-md bg-[#303c4e] font-bold text-sm text-white hover:text-[#00f2a1] active:bg-[#303c4e] focus:outline-none focus:border-[#303c4e] focus:ring focus:ring-gray-600 disabled:opacity-50 transition"
                                                wire:click.prevent = "verDetalleViaje({{$vt->idV}})">
                                                    Ver Detalles
                                            </button>
                                            <button class="inline-flex mt-1 mr-0 md:mt-0 md:mr-1 items-center px-4 py-2 rounded-md bg-[#303c4e] font-bold text-sm text-white hover:text-[#00f2a1] active:bg-[#303c4e] focus:outline-none focus:border-[#303c4e] focus:ring focus:ring-gray-600 disabled:opacity-50 transition"
                                                wire:click.prevent = "verGastos({{$vt->idV}})">
                                                    Ver Gastos
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="py-2">{{$viajesTerminados->links()}}</div>
            @endif
        </div>
    </div>
    <div class="w-full text-center bg-[#303c4e] font-bold text-[#00f2a1] text-md py-8">
            OnFlex. Conetando al país. 2022. - Todos los derechos reservados.
    </div>
</div>
