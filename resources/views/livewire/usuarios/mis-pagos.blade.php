<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mis Pagos') }}
        </h2>
    </x-slot>
    @if($modalCreatePago)
        @include('livewire.usuarios.modalCreatePago')
    @endif
    @if($modalUpdatePago)
        @include('livewire.usuarios.modalUpdatePago')
    @endif
    @if($modalConfirmEliminar)
        @include('livewire.usuarios.modalConfirmEliminar')
    @endif
    @if($modalDetalleAprob)
        @include('livewire.usuarios.modalDetalleAprob')
    @endif
    @if($modalDetalleRechazo)
        @include('livewire.usuarios.modalDetalleRechazo')
    @endif
    <div class="bg-white min-h-screen min-w-screen border-t border-gray-400 pt-2">
        <div class="mt-1 mx-auto">
            @if (session()->has('msj'))
            <div class="py-4 text-white bg-red-500 font-bold text-center w-11/12 mx-auto rounded-md">
                {{ session('msj') }}
            </div>
        @endif
            <div class="py-2 w-11/12 mx-auto">
                <button class="mr-0 mb-1 md:mr-1 md:mb-0 inline-flex items-center px-4 py-2 rounded-md bg-gray-700 font-bold text-sm text-white hover:text-green-400 active:bg-gray-700 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-600 disabled:opacity-50 transition"
                    wire:click.prevent = "registrarPago()">
                    Reportar Pago
                </button>
            </div>
            <div class="mt-4 shadow w-11/12 mx-auto">
                <div class="py-3 md:py-4 text-lg md:text-xl font-bold uppercase text-center">
                    Mis Pagos pendientes de revisión
                </div>
                <div class="w-11/12 sm:mx-auto md:flex md:justify-between my-2 mx-auto">
                    <div class="sm:w-full md:w-1/4 flex justify-around">
                        <div class="mt-3 mr-2 md:w-1/3">Ver</div>
                        <div class="w-1/3">
                            <select wire:model="cantidadRev" 
                                class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                <option value=5>10</option>
                                <option value=10>20</option>
                                <option value=15>30</option>
                                <option value=20>50</option>
                            </select>
                        </div>
                        <div class="mt-3 ml-1 md:w-1/3">registros</div>
                    </div>
                </div>
                <div class="overflow-x-auto shadow-sm rounded-md">
                    <table class="mx-2 px-2 w-full border-1 border-gray-500">
                        <thead>
                            <tr class="bg-gray-700">
                                <th class="w-2/5 text-white font-bold py-2 text-md border border-gray-700">
                                    Referencia
                                </th>
                                <th class="w-2/5 text-white font-bold py-2 text-md border border-gray-700">
                                    Fecha de Pago
                                </th>
                                <th class="w-1/5 text-white font-bold py-2 text-md border border-gray-700">
                                    Opciones
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($pendientes->isEmpty())
                                <tr>
                                    <td colspan="5">
                                        <div class="py-4 text-center font-semibold text-lg">
                                            No hay pagos pendientes de aprobación.
                                        </div>
                                    </td>
                                </tr>
                            @else
                                @foreach ($pendientes as $pendiente)
                                    @if ($pendiente->status_pago == false)
                                        <tr class="hover:bg-gray-200 text-sm text-center">
                                            <td>{{$pendiente->referencia}}</td>
                                            <td>{{date('d-m-Y', strtotime($pendiente->fecha_pago))}}</td>
                                            <td>
                                                <div class="md:flex md:justify-center my-2">
                                                    <button class="mr-0 mb-1 md:mr-1 md:mb-0 inline-flex items-center px-4 py-2 rounded-md bg-gray-700 font-bold text-sm text-white hover:text-green-400 active:bg-gray-700 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-600 disabled:opacity-50 transition"
                                                        wire:click.prevent = "modificarPago({{$pendiente->id}})">
                                                        Modificar
                                                    </button>
                                                    <button class="ml-0 mt-1 md:ml-1 md:mt-0 inline-flex items-center px-4 py-2 rounded-md bg-gray-700 font-bold text-sm text-white hover:text-green-400 active:bg-gray-700 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-600 disabled:opacity-50 transition"
                                                        wire:click.prevent = "eliminarPago({{$pendiente->id}})">
                                                        Eliminar
                                                    </button>  
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="py-2 px-2">
                    {{$pendientes->links()}}
                </div>
            </div>
            <div class="mt-4 shadow w-11/12 mx-auto">
                <div class="py-3 md:py-4 text-lg md:text-xl font-bold uppercase text-center">
                    Mis Pagos Aprobados
                </div>
                <div class="w-11/12 sm:mx-auto md:flex md:justify-between my-2 mx-auto">
                    <div class="sm:w-full md:w-1/4 flex justify-around">
                        <div class="mt-3 mr-2 md:w-1/3">Ver</div>
                        <div class="w-1/3">
                            <select wire:model="cantidadAcept" 
                                class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                <option value=5>10</option>
                                <option value=10>20</option>
                                <option value=15>30</option>
                                <option value=20>50</option>
                            </select>
                        </div>
                        <div class="mt-3 ml-1 md:w-1/3">registros</div>
                    </div>
                </div>
                <div class="overflow-x-auto shadow-sm rounded-md">
                    <table class="mx-2 px-2 w-full border-1 border-gray-500">
                        <thead>
                            <tr class="bg-gray-700">
                                <th class="w-1/4 text-white font-bold py-2 text-md border border-gray-700">
                                    Referencia
                                </th>
                                <th class="w-1/4 text-white font-bold py-2 text-md border border-gray-700">
                                    Fecha de Pago
                                </th>
                                <th class="w-1/4 text-white font-bold py-2 text-md border border-gray-700">
                                    Fecha de Aprobación
                                </th>
                                <th class="w-1/4 text-white font-bold py-2 text-md border border-gray-700">
                                    Opciones
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($aprobados->isEmpty())
                                <tr>
                                    <td colspan="5">
                                        <div class="py-4 text-center font-semibold text-lg">
                                            No hay pagos aprobados.
                                        </div>
                                    </td>
                                </tr>
                            @else
                                @foreach ($aprobados as $aprobado)
                                    <tr class="hover:bg-gray-200 text-sm text-center">
                                        <td>{{$aprobado->referencia}}</td>
                                        <td>{{date('d-m-Y', strtotime($aprobado->fecha_pago))}}</td>
                                        <td>{{date('d-m-Y', strtotime($aprobado->fecha_act))}}</td>
                                        <td>
                                            <div class="md:flex md:justify-center my-2">
                                                <button class="inline-flex items-center px-4 py-2 rounded-md bg-gray-700 font-bold text-sm text-white hover:text-green-400 active:bg-gray-700 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-600 disabled:opacity-50 transition"
                                                    wire:click.prevent = "verDetalleAprobado({{$aprobado->id}})">
                                                    Ver Detalles
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="py-2 px-2">
                    {{$aprobados->links()}}
                </div>
            </div>
            <div class="mt-4 shadow w-11/12 mx-auto">
                <div class="py-3 md:py-4 text-lg md:text-xl font-bold uppercase text-center">
                    Mis Pagos Rechazados
                </div>
                <div class="w-11/12 sm:mx-auto md:flex md:justify-between my-2 mx-auto">
                    <div class="sm:w-full md:w-1/4 flex justify-around">
                        <div class="mt-3 mr-2 md:w-1/3">Ver</div>
                        <div class="w-1/3">
                            <select wire:model="cantidadRecha" 
                                class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                <option value=5>10</option>
                                <option value=10>20</option>
                                <option value=15>30</option>
                                <option value=20>50</option>
                            </select>
                        </div>
                        <div class="mt-3 ml-1 md:w-1/3">registros</div>
                    </div>
                </div>
                <div class="overflow-x-auto shadow-sm rounded-md">
                    <table class="mx-2 px-2 w-full border-1 border-gray-500">
                        <thead>
                            <tr class="bg-gray-700">
                                <th class="w-2/5 text-white font-bold py-2 text-md border border-gray-700">
                                    Referencia
                                </th>
                                <th class="w-2/5 text-white font-bold py-2 text-md border border-gray-700">
                                    Fecha de Pago
                                </th>
                                <th class="w-1/5 text-white font-bold py-2 text-md border border-gray-700">
                                    Opciones
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($rechazados->isEmpty())
                                <tr>
                                    <td colspan="5">
                                        <div class="py-4 text-center font-semibold text-lg">
                                            No hay pagos pendientes de aprobación.
                                        </div>
                                    </td>
                                </tr>
                            @else
                                @foreach ($rechazados as $rechazado)
                                    <tr class="hover:bg-gray-200 text-sm text-center">
                                        <td>{{$rechazado->referencia}}</td>
                                        <td>{{date('d-m-Y', strtotime($rechazado->fecha_pago))}}</td>
                                        <td>
                                            <div class="md:flex md:justify-center my-2">
                                                <button class="inline-flex items-center px-4 py-2 rounded-md bg-gray-700 font-bold text-sm text-white hover:text-green-400 active:bg-gray-700 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-600 disabled:opacity-50 transition"
                                                    wire:loading.attr = "disabled"
                                                    wire:click.prevent = "verDetalleRechazado({{$rechazado->id}})">
                                                    Ver Detalles
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="py-2 px-2">
                    {{$pendientes->links()}}
                </div>
            </div>
        </div>
    </div>
    <div class="w-full text-center bg-gray-700 font-bold text-green-400 text-md py-8">
            OnFlex. Conetando al país. 2022. - Todos los derechos reservados.
    </div>
</div>
