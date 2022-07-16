<div class="fixed w-full inset-0 z-50 overflow-hidden items-center animated fadeIn faster" style="background: rgba(0,0,0,.7);">
    <div class="w-full text-right">
        <button wire:click.prevent="cerrarModalConfirm()" class="p-3 text-white mr-2 mt-2">
            X
        </button>
    </div>
    <div class="mx-auto my-auto md:w-2/5 sm:w-11/12 bg-white rounded-md">
        <div class="p-4 font-bold text-xl bg-gray-700 text-center text-green-400">
            @if($status==true) Desactivar @else Reactivar @endif Tipo de Camión
        </div>
        <div class="px-6 pb-2">
            <div class="p-8 text-center text-black text-xl">
                ¿Estás seguro que deseas @if($status==true) <b>Desactivar</b> @else <b>Reactivar</b> @endif 
                el Tipo de Camión: {{$nombre}}?
            </div>
            <div class="flex justify-around w-full mt-4 text-center">
                    @if($status==true)
                        <button class="inline-flex items-center px-4 py-2 rounded-md bg-gray-700 font-bold text-sm text-white hover:text-green-400 active:bg-gray-700 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-600 disabled:opacity-50 transition"
                            wire:click.prevent = "cambiarStatus({{$id_tipo}})">
                            Desactivar
                        </button>
                    @else
                        <button class="inline-flex items-center px-4 py-2 rounded-md bg-gray-700 font-bold text-sm text-white hover:text-green-400 active:bg-gray-700 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-600 disabled:opacity-50 transition"
                            wire:click.prevent = "cambiarStatus({{$id_tipo}})"
                            wire:loading.attr="disabled">
                            Activar
                        </button>
                    @endif
                    <button class="inline-flex items-center px-4 py-2 rounded-md bg-gray-700 font-bold text-sm text-white hover:text-green-400 active:bg-gray-700 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-600 disabled:opacity-50 transition"
                        wire:click.prevent = "cerrarModalConfirm()"
                        wire:loading.attr="disabled">
                        Cerrar
                    </button>
            </div>
        </div>
    </div>
</div>