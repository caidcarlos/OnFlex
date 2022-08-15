<div class="fixed w-full inset-0 z-50 overflow-hidden items-center animated fadeIn faster" style="background: rgba(0,0,0,.7);">
    <div class="w-full text-right">
        <button wire:click.prevent="cerrarModalConfirm()" class="p-3 text-white mr-2 mt-2">
            X
        </button>
    </div>
    <div class="mx-auto my-auto md:w-2/5 w-5/6 bg-white rounded-md">
        <div class="p-4 font-bold text-xl bg-[#303c4e] text-center text-[#00f2a1]">
            Cancelar Suscripción
        </div>
        <div class="px-6 pb-2">
            <div class="p-8 text-center text-black text-xl">
                ¿Estás seguro que deseas <b>cancelar</b> tu suscripción a OnFlex?
            </div>
            <div class="mx-auto flex justify-between mt-4">
                <div class="w-1/2 text-center">
                    <button class="inline-flex items-center px-4 py-2 rounded-md bg-[#303c4e] font-bold text-sm text-white hover:text-[#00f2a1] active:bg-[#303c4e] focus:outline-none focus:border-[#303c4e] focus:ring focus:ring-[#303c4e] disabled:opacity-50 transition"
                        wire:click.prevent = "cancelarSuscripcion()"
                        wire:loading.attr="disabled">
                            Sí, ¡quiero irme!
                    </button>
                </div>
                <div class="w-1/2 text-center">
                    <button class="inline-flex items-center px-4 py-2 rounded-md bg-[#303c4e] font-bold text-sm text-white hover:text-[#00f2a1] active:bg-[#303c4e] focus:outline-none focus:border-[#303c4e] focus:ring focus:ring-[#303c4e] disabled:opacity-50 transition"
                        wire:click.prevent = "cerrarModalConfirm()"
                        wire:loading.attr="disabled">
                            Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>