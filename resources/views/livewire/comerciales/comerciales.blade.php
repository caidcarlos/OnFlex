<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Comerciales') }}
        </h2>
    </x-slot>
    <div class="bg-white min-h-screen min-w-screen border-t border-gray-400 pt-2">
        <div class="mt-1 mx-auto">
            <div class="w-11/12 mx-auto">
                <button class="inline-flex items-center px-4 py-2 rounded-md bg-gray-700 font-bold text-sm text-white hover:text-green-400 active:bg-gray-700 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-600 disabled:opacity-50 transition"
                    wire:click.prevent = "registrar()">
                    Nuevo Comercial
                </button>
            </div>
            <div class="w-11/12 sm:mx-auto md:flex md:justify-between mt-2 mx-auto">
                <div class="sm:w-full md:w-1/4 flex justify-around">
                    <div class="mt-3 mr-2 md:w-1/3">Ver</div>
                    <div class="w-1/3">
                        <select wire:model="numero" 
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
                    @include('livewire.comerciales.modalCreate')
                @endif
                @if($modalUpdate)
                    @include('livewire.comerciales.modalUpdate')
                @endif
                @if($modalConfirm)
                    @include('livewire.comerciales.modalConfirm')
                @endif
            <div class="mt-4 shadow w-11/12 mx-auto overflow-x-auto">
                <table class="px-2 w-full border-1 border-gray-700">
                    <thead>
                        <tr class="bg-gray-700">
                            <th class="w-1/5 text-white font-bold py-2 text-md border border-gray-700">
                                Nombre y Apellido
                            </th>
                            <th class="w-1/5 text-white font-bold py-2 text-md border border-gray-700">
                                Cuentas Vendidas a Empresas
                            </th>
                            <th class="w-1/5 text-white font-bold py-2 text-md border border-gray-700">
                                Cuentas Vendidas a Transportistas
                            </th>
                            <th class="w-1/5 text-white font-bold py-2 text-md border border-gray-700">
                                Status
                            </th>
                            <th class="w-1/5 text-white font-bold py-2 text-md border border-gray-700">
                                Opciones
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($comerciales as $comercial)
                            @if($pivot == 1)
                                <tr class="hover:bg-gray-200 text-sm text-center">
                                    <td>{{$comercial->nombre}} {{$comercial->apellidos}}</td>
                                    <td>
                                        @php
                                            $i = 0;
                                            foreach($empresas as $e){
                                                if($e->comercial == $comercial->id){
                                                    $i++;
                                                }
                                            }
                                            echo $i;
                                        @endphp
                                    </td>
                                    <td>
                                        @php
                                            $i = 0;
                                            foreach($transportistas as $t){
                                                if($t->comercial == $comercial->id){
                                                    $i++;
                                                }
                                            }
                                            echo $i;
                                        @endphp
                                    </td>
                                    <td>
                                        @if($comercial->status == true)
                                            Activo
                                        @else
                                            Inactivo
                                        @endif
                                    </td>
                                    <td>
                                        <div class="md:flex md:justify-around text-center my-2">
                                            <button class="w-full md:mr-1 mr-0 md:mb-0 mb-2 inline-flex items-center px-4 py-2 rounded-md bg-gray-700 font-bold text-center text-sm text-white hover:text-green-400 active:bg-gray-700 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-600 disabled:opacity-50 transition"
                                                wire:click.prevent = "modificar({{$comercial->id}})">
                                                Editar
                                            </button>  
                                            <button class="w-full md:mr-1 mr-0 md:mb-0 mb-2 inline-flex items-center px-4 py-2 rounded-md bg-gray-700 font-bold text-center text-sm text-white hover:text-green-400 active:bg-gray-700 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-600 disabled:opacity-50 transition"
                                                wire:click.prevent = "verStatus({{$comercial->id}})">
                                                @if($comercial->status==true)
                                                    Desactivar
                                                @else
                                                    Reactivar
                                                @endif
                                            </button>  
                                        </div>
                                    </td>
                                </tr>
                            @endif
                            @if($pivot == 2)
                            @if($comercial->status == true)
                                <tr class="hover:bg-gray-200 text-sm text-center">
                                    <td>{{$comercial->nombre}}</td>
                                    <td>{{$comercial->apellidos}}</td>
                                    <td>
                                        @php
                                            $i = 0;
                                            foreach($empresas as $e){
                                                if($e->comercial == $comercial->id){
                                                    $i++;
                                                }
                                            }
                                            echo $i;
                                        @endphp
                                    </td>
                                    <td>
                                        @if($comercial->status == true)
                                            Activo
                                        @else
                                            Inactivo
                                        @endif
                                    </td>
                                    <td>
                                        <div class="md:flex md:justify-around text-center my-2">
                                            <button class="w-full md:mr-1 mr-0 md:mb-0 mb-2 inline-flex items-center px-4 py-2 rounded-md bg-gray-700 font-bold text-center text-sm text-white hover:text-green-400 active:bg-gray-700 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-600 disabled:opacity-50 transition"
                                                wire:click.prevent = "modificar({{$comercial->id}})">
                                                Editar
                                            </button>
                                            <button class="w-full md:mr-1 mr-0 md:mb-0 mb-2 inline-flex items-center px-4 py-2 rounded-md bg-gray-700 font-bold text-center text-sm text-white hover:text-green-400 active:bg-gray-700 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-600 disabled:opacity-50 transition"
                                                wire:click.prevent = "verStatus({{$comercial->id}})">
                                                @if($comercial->status==true)
                                                    Desactivar
                                                @else
                                                    Reactivar
                                                @endif
                                            </button>  
                                        </div>
                                    </td>
                                </tr>
                            @endif
                            @endif
                            @if($pivot == 3)
                            @if($comercial->status == false)
                                <tr class="hover:bg-gray-200 text-sm text-center">
                                    <td>{{$comercial->nombre}}</td>
                                    <td>{{$comercial->apellidos}}</td>
                                    <td>
                                        @php
                                            $i = 0;
                                            foreach($empresas as $e){
                                                if($e->comercial == $comercial->id){
                                                    $i++;
                                                }
                                            }
                                            echo $i;
                                        @endphp
                                    </td>
                                    <td>
                                        @if($comercial->status == true)
                                            Activo
                                        @else
                                            Inactivo
                                        @endif
                                    </td>
                                    <td>
                                        <div class="md:flex md:justify-around text-center my-2">
                                            <button class="w-full md:mr-1 mr-0 md:mb-0 mb-2 inline-flex items-center px-4 py-2 rounded-md bg-gray-700 font-bold text-center text-sm text-white hover:text-green-400 active:bg-gray-700 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-600 disabled:opacity-50 transition"
                                                wire:click.prevent = "modificar({{$comercial->id}})">
                                                Editar
                                            </button>  
                                            <button class="w-full md:mr-1 mr-0 md:mb-0 mb-2 inline-flex items-center px-4 py-2 rounded-md bg-gray-700 font-bold text-center text-sm text-white hover:text-green-400 active:bg-gray-700 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-600 disabled:opacity-50 transition"
                                                wire:click.prevent = "verStatus({{$comercial->id}})">
                                                @if($comercial->status==true)
                                                    Desactivar
                                                @else
                                                    Reactivar
                                                @endif
                                            </button>  
                                        </div>
                                    </td>
                                </tr>
                            @endif
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="w-11/12 mx-auto shadow">
                {{$comerciales->links()}}
            </div>
        </div>
    </div>
    <div class="w-full text-center bg-gray-700 font-bold text-green-400 text-md py-8">
            OnFlex. Conetando al país. 2022. - Todos los derechos reservados.
    </div>
</div>
