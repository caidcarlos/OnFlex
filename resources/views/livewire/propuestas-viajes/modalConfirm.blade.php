<div class="fixed w-full inset-0 z-50 overflow-hidden items-center animated fadeIn faster" style="background: rgba(0,0,0,.7);">
    <div class="w-full text-right">
        <button wire:click.prevent="cerrarModalConfirm()" class="p-3 text-white mr-2 mt-2">
            X
        </button>
    </div>
    <div class="mx-auto my-auto md:w-2/5 sm:w-11/12 bg-white rounded-md">
        <div class="p-4 font-bold text-xl bg-gray-700 text-center text-green-400">
            Cancelar Viaje
        </div>
        <div class="px-6 pb-2">
            <div class="p-8 text-center text-black text-xl">
                ¿Estás seguro que deseas <b>cancelar</b> este viaje?
            </div>
            <div class="mx-auto flex justify-between w-11/12 mt-4">
                <div class="w-1/2">
                    <button class="inline-flex items-center px-4 py-2 rounded-md bg-gray-700 hover:bg-green-400 font-bold text-sm text-white hover:text-gray-700 uppercase active:bg-gray-700 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-600 disabled:opacity-50 transition"
                        wire:click.prevent = "cancelar({{$id_viaje}})"
                        wire:loading.attr="disabled">
                            Cancelar
                    </button>
                </div>
                <div class="w-1/2">
                    <button class="inline-flex items-center px-4 py-2 rounded-md bg-gray-700 hover:bg-green-400 font-bold text-sm text-white hover:text-gray-700 uppercase active:bg-gray-700 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-600 disabled:opacity-50 transition"
                        wire:click.prevent = "cerrarModalConfirm()"
                        wire:loading.attr="disabled">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>