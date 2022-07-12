<div class="fixed w-full inset-0 z-50 overflow-hidden items-center animated fadeIn faster" style="background: rgba(0,0,0,.7);">
    <div class="w-full text-right">
        <button wire:click.prevent="cerrarModalConfirm()" class="p-3 text-white mr-2 mt-2">
            X
        </button>
    </div>
    <div class="mx-auto my-auto md:w-2/5 sm:w-11/12 bg-white rounded-md">
        <div class="p-4 font-bold text-xl bg-gray-700 text-center text-green-400">
            @if($status==true) Desactivar @else Reactivar @endif Plan de Pago
        </div>
        <div class="px-6 pb-2">
            <div class="p-8 text-center text-black text-xl">
                ¿Estás seguro que deseas @if($status==true) <b>Desactivar</b> @else <b>Reactivar</b> @endif 
                el Plan de Pago: {{$nombre}}?
            </div>
            <div class="mx-auto flex justify-between w-11/12 mt-4">
                <div class="w-1/2">
                    @if($status==true)
                        <button class="inline-flex items-center px-4 py-2 bg-gray-700 hover:bg-green-500 font-bold text-sm text-white uppercase active:bg-gray-700 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-600 disabled:opacity-50 transition"
                            wire:click.prevent = "cambiarStatus({{$id_plan}})"
                            wire:loading.attr="disabled">
                            Desactivar
                        </button>
                    @else
                        <button class="inline-flex items-center px-4 py-2 bg-gray-700 hover:bg-green-500 font-bold text-sm text-white uppercase active:bg-gray-700 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-600 disabled:opacity-50 transition"
                            wire:click.prevent = "cambiarStatus({{$id_plan}})"
                            wire:loading.attr="disabled">
                            Activar
                        </button>
                    @endif
                </div>
                <div class="w-1/2">
                    <button class="inline-flex items-center px-4 py-2 bg-gray-700 hover:bg-green-500 font-bold text-sm text-white uppercase active:bg-gray-700 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-600 disabled:opacity-50 transition"
                        wire:click.prevent = "cerrarModalConfirm()">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>