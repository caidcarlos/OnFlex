<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Planes de Pago') }}
        </h2>
    </x-slot>
    <div class="bg-white min-h-screen min-w-screen border-t border-gray-400 pt-2">
        <div class="mt-1 mx-auto">
            <div class="w-11/12 mx-auto">
                <button class="inline-flex items-center px-4 py-2 bg-gray-700 hover:bg-green-400 font-bold text-sm text-white uppercase active:bg-gray-700 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-600 disabled:opacity-50 transition"
                    wire:click.prevent = "registrarPlan()">
                    Nuevo Plan de Pago
                </button>
            </div>
            <div class="w-11/12 sm:mx-auto md:flex md:justify-between mt-2 mx-auto">
                <div class="sm:w-full md:w-1/4 flex justify-around">
                    <div class="mt-3 mr-2 md:w-1/3">Ver</div>
                    <div class="w-1/3">
                        <select wire:model="cantidad" 
                            class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                            <option value=5>5</option>
                            <option value=10>10</option>
                            <option value=15>15</option>
                            <option value=20>20</option>
                            <option value=25>25</option>
                        </select>
                    </div>
                    <div class="mt-3 ml-1 md:w-1/3">registros</div>
                </div>
                <div class="sm:w-full md:w-1/2">
                    <input type="text" wire:model="busqueda" placeholder="Buscar..."
                        class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                </div>
                <div class="sm:w-full md:w-1/4 flex justify-around text-center">
                    <div class="mt-3 mr-2 w-1/3">
                        Ver
                    </div>
                    <div class="w-2/3">
                        <select class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                            wire:model="pivot">
                            <option value=1>Todos</option>
                            <option value=2>Activos</option>
                            <option value=3>Inactivos</option>
                        </select>
                    </div>
                </div>
            </div>
            @if($modalCreate)
                @include('livewire.planes-pago.modalCreate')
            @endif
            @if($modalUpdate)
                @include('livewire.planes-pago.modalUpdate')
            @endif
            @if($modalConfirm)
                @include('livewire.planes-pago.modalConfirm')
            @endif
            <div class="mt-4 shadow w-11/12 mx-auto">
                <table class="px-2 w-full border-1 border-gray-500">
                    <thead>
                        <tr class="bg-green-400">
                            <th class="w-1/4 text-white font-bold py-2 text-md border border-gray-700">
                                Nombre
                            </th>
                            <th class="w-1/4 text-white font-bold py-2 text-md border border-gray-700">
                                Días de Duración
                            </th>
                            <th class="w-1/4 text-white font-bold py-2 text-md border border-gray-700">
                                Precio
                            </th>
                            <th class="w-1/4 text-white font-bold py-2 text-md border border-gray-700">
                                Opciones
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($planes as $plan)
                            <tr class="hover:bg-gray-200 text-sm text-center">
                                <td>{{$plan->nombre}}</td>
                                <td>{{$plan->dias_duracion}} días</td>
                                <td>{{$plan->precio}} COP</td>
                                <td>
                                    <div class="md:flex md:justify-center my-2">
                                        <div class="sm:w-full md:w-auto">
                                            <button class="md:mr-2 sm:w-full md:w-auto inline-flex items-center sm:px-3 md:px-4 sm:py-1 md:py-2 bg-gray-700 hover:bg-green-500 font-bold text-sm text-white uppercase active:bg-gray-700 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-600 disabled:opacity-50 transition"
                                                wire:click.prevent = "editar({{$plan->id}})">
                                                Editar
                                            </button>  
                                        </div>
                                        <div class="sm:mt-4 md:mt-0 sm:w-full md:w-auto">
                                            <button class="md:ml-2 sm:w-full md:w-auto inline-flex items-center sm:px-3 md:px-4 sm:py-1 md:py-2 bg-gray-700 hover:bg-green-500 font-bold text-sm text-white uppercase active:bg-gray-700 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-600 disabled:opacity-50 transition"
                                                wire:click.prevent = "verStatus({{$plan->id}})">
                                                @if($plan->status==true)
                                                    Desactivar
                                                @else
                                                    Reactivar
                                                @endif
                                            </button>  
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="w-11/12 mx-auto shadow">
                {{$planes->links()}}
            </div>
        </div>
    </div>
    <div class="w-full text-center bg-gray-700 font-bold text-green-400 text-md py-8 mt-8">
        OnFlex. Conetando al país. 2022. - Todos los derechos reservados.
    </div>
</div>
