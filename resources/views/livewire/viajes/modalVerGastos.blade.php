<div class="fixed w-full inset-0 z-50 overflow-hidden items-center animated fadeIn faster" style="background: rgba(0,0,0,.7);">
    <div class="w-full text-right">
        <button wire:click.prevent="cerrarModalVerGastos()" class="p-3 text-white mr-2 mt-2">
            X
        </button>
    </div>
    <div class="mx-auto my-auto md:w-3/5 w-5/6 h-3/4 md:h-5/6 bg-white rounded-md overflow-y-scroll">
        <div class="p-4 font-bold text-xl">
            Gestión de Gastos
        </div>
        <div class="px-6 pb-2">
            @if($estado_viaje != 'TERMINADO')
            <div class="w-full py-2 md:flex md:justify-around">
                <div class="w-full md:w-2/5 ">
                    <input id="concepto" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" 
                        type="text" name="concepto" wire:model.defer="concepto" placeholder="Concepto" required />
                    @error('concepto')
                        <div id="text-sm text-red-500">{{$message}}</div>
                    @enderror
                </div>
                <div class="flex justify-around">
                    <div class="w-1/2 md:w-1/5 ">
                        <input id="precio" class="block mr-1 mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" 
                            type="text" name="precio" wire:model.defer="precio" placeholder="Precio" required />
                        @error('precio')
                            <div id="text-sm text-red-500">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="w-1/2 md:w-1/5 ">
                        <input id="cantidad" class="block ml-1 mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" 
                            type="text" name="cantidad" wire:model.defer="cantidad" placeholder="Cantidad" required />
                        @error('cantidad')
                            <div id="text-sm text-red-500">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="w-auto md:w-1/5 mt-1">
                    @if($modif == false)
                        <button class="inline-flex items-center rounded-md px-4 py-2 bg-[#303c4e] hover:text-[#00f2a1] font-bold text-sm text-white active:bg-[#303c4e] focus:outline-none focus:border-[#303c4e] focus:ring focus:ring-gray-600 disabled:opacity-50 transition"
                            wire:click.prevent = "guardarGasto({{$id_viaje}})"
                            wire:loading.attr="disabled">
                                Registrar
                        </button>
                    @else
                        <button class="inline-flex items-center rounded-md px-4 py-2 bg-[#303c4e] hover:text-[#00f2a1] font-bold text-sm text-white active:bg-[#303c4e] focus:outline-none focus:border-[#303c4e] focus:ring focus:ring-gray-600 disabled:opacity-50 transition"
                            wire:click.prevent = "cambiarGasto({{$id_gasto}})"
                            wire:loading.attr="disabled">
                                Modificar
                        </button>
                    @endif
                </div>
            </div>
            @endif
            <div class = "w-full border border-[#303c4e] my-1 overflow-x-auto">
                <table class="w-full border-1 border-[#303c4e] rounded-sm">
                    <thead>
                        <tr class="bg-[#303c4e]">
                            <th class="w-1/5 text-white font-bold py-2 text-md border border-[#303c4e]">
                                Concepto
                            </th>
                            <th class="w-1/5 text-white font-bold py-2 text-md border border-[#303c4e]">
                                Cantidad
                            </th>
                            <th class="w-1/5 text-white font-bold py-2 text-md border border-[#303c4e]">
                                Precio
                            </th>
                            <th class="w-1/5 text-white font-bold py-2 text-md border border-[#303c4e]">
                                Total
                            </th>
                            <th class="w-1/5 text-white font-bold py-2 text-md border border-[#303c4e]">
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
                            <tr class="hover:bg-gray-200 text-md text-center border-gray-200 py-1">
                                <td class="border-gray-400">{{$g->concepto}}</td>
                                <td class="border-gray-400">{{$g->cantidad}}</td>
                                <td class="border-gray-400">{{$g->precio}}COP</td>
                                <td class="border-gray-400">
                                    @php
                                        echo $g->cantidad*$g->precio."COP";
                                    @endphp
                                </td>
                                <td class="border-gray-400">
                                    @if($estado_viaje != 'TERMINADO')
                                        <button wire:click.prevent = "modificarGasto({{$g->id}})"
                                            wire:load.attr="disabled">
                                            Modificar
                                        </button>
                                        <button wire:click.prevent = "borrarGasto({{$g->id}})"
                                            wire:load.attr="disabled">
                                            Eliminar
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        @php
                            $total = 0;
                            foreach($gastos as $g){
                                $total = $total + ($g->cantidad*$g->precio);
                            }
                        @endphp
                        <tr class="border-t border-t-[#303c4e] text-lg py-2 text-center font-bold">
                            <td colspan="3">
                                Total Gastado:
                            </td>
                            <td colspan="2">
                                {{$total}} COP
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="mx-auto text-center mt-4">
                    <button class="inline-flex items-center px-4 py-2 rounded-md bg-[#303c4e] font-bold text-sm text-white hover:text-[#00f2a1] active:bg-[#303c4e] focus:outline-none focus:border-[#303c4e] focus:ring focus:ring-gray-600 disabled:opacity-50 transition"
                        wire:click.prevent = "cerrarModalVerGastos()"
                        wire:loading.attr="disabled">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>