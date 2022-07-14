<div class="fixed w-full inset-0 z-50 overflow-hidden items-center animated fadeIn faster" style="background: rgba(0,0,0,.7);">
    <div class="w-full text-right">
        <button wire:click.prevent="cerrarModalCreate()" class="p-3 text-white mr-2 mt-2">
            X
        </button>
    </div>
    <div class="mx-auto my-auto md:w-3/5 sm:w-5/6 sm:h-1/2 md:h-5/6 bg-white rounded-md overflow-y-scroll">
        <div class="p-4 font-bold text-xl">
            Gestión de Gastos
        </div>
        <div class="px-6 pb-2">
            @if($estado_viaje != 'TERMINADO')
            <div class="w-full py-2 md:flex md:justify-around">
                <div class="sm:w-full md:w-2/5 ">
                    <input id="concepto" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" 
                        type="text" name="concepto" wire:model.defer="concepto" placeholder="Concepto" required />
                    @error('concepto')
                        <div id="text-sm text-red-500">{{$message}}</div>
                    @enderror
                </div>
                <div class="sm:w-1/3 md:w-1/5 ">
                    <input id="precio" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" 
                        type="text" name="precio" wire:model.defer="precio" placeholder="Precio" required />
                    @error('precio')
                        <div id="text-sm text-red-500">{{$message}}</div>
                    @enderror
                </div>
                <div class="sm:w-1/3 md:w-1/5 ">
                    <input id="cantidad" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" 
                        type="text" name="cantidad" wire:model.defer="cantidad" placeholder="Cantidad" required />
                    @error('cantidad')
                        <div id="text-sm text-red-500">{{$message}}</div>
                    @enderror
                </div>
                <div class="sm:w-1/3 md:w-1/5 mt-1">
                    @if($modif == false)
                        <button class="inline-flex w-full items-center rounded-md px-4 py-2 bg-gray-700 hover:bg-green-500 font-bold text-sm text-white uppercase active:bg-gray-700 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-600 disabled:opacity-50 transition"
                            wire:click.prevent = "guardarGasto({{$id_viaje}})"
                            wire:loading.attr="disabled">
                                Registrar
                        </button>
                    @else
                        <button class="inline-flex w-full items-center rounded-md px-4 py-2 bg-gray-700 hover:bg-green-500 font-bold text-sm text-white uppercase active:bg-gray-700 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-600 disabled:opacity-50 transition"
                            wire:click.prevent = "cambiarGasto({{$id_gasto}})"
                            wire:loading.attr="disabled">
                                Modificar
                        </button>
                    @endif
                </div>
            </div>
            @endif
            <div class = "w-full border border-gray-700 my-1">
                <table class="w-full border-1 border-gray-700 rounded-sm">
                    <thead>
                        <tr class="bg-green-400">
                            <th class="w-1/5 text-gray-700 font-bold py-2 text-md border border-gray-700">
                                Concepto
                            </th>
                            <th class="w-1/5 text-gray-700 font-bold py-2 text-md border border-gray-700">
                                Cantidad
                            </th>
                            <th class="w-1/5 text-gray-700 font-bold py-2 text-md border border-gray-700">
                                Precio
                            </th>
                            <th class="w-1/5 text-gray-700 font-bold py-2 text-md border border-gray-700">
                                Total
                            </th>
                            <th class="w-1/5 text-gray-700 font-bold py-2 text-md border border-gray-700">
                                Opciones
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (($gastos->isEmpty()) OR ($gastos == null))
                            <tr>
                                <td colspan = "5">
                                    <div class = "py-2 text-center font-bold text-md text-black">
                                        No hay gastos relacionados con este viaje...
                                    </div>
                                </td>
                            </tr>
                        @endif
                        @foreach ($gastos as $g)
                            <tr class="hover:bg-gray-200 text-md text-center py-1">
                                <td>{{$g->concepto}}</td>
                                <td>{{$g->cantidad}}</td>
                                <td>{{$g->precio}}</td>
                                <td>
                                    @php
                                        echo $g->cantidad*$g->precio;
                                    @endphp
                                </td>
                                <td>
                                    <button wire:click.prevent = "modificarGasto({{$g->id}})"
                                        wire:load.attr="disabled">
                                        Modificar
                                    </button>
                                    <button wire:click.prevent = "borrarGasto({{$g->id}})"
                                        wire:load.attr="disabled">
                                        Eliminar
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @php
                    $total = 0;
                    foreach($gastos as $g){
                        $total = $total + ($g->cantidad*$g->precio);
                    }
                @endphp
                <div class = "text-md text-right font-bold py-2">
                    Total Gastado: {{$total}}
                </div>
            </div>
            <div class="mx-auto md:flex md:justify-between w-11/12 mt-4">
                <div class="md:w-1/2 sm:w-full sm:text-center sm:mt-2 md:mt-0">
                    <button class="inline-flex items-center px-4 py-2 rounded-md bg-gray-700 hover:bg-green-400 font-bold text-sm text-white hover:text-gray-700 uppercase active:bg-gray-700 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-600 disabled:opacity-50 transition"
                        wire:click.prevent = "cerrarModalVerGastos()"
                        wire:loading.attr="disabled">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>