<div class="fixed w-full inset-0 z-50 overflow-hidden items-center animated fadeIn faster" style="background: rgba(0,0,0,.7);">
    <div class="w-full text-right">
        <button wire:click.prevent="cerrarModalConfirmRechazo()" class="p-3 text-white mr-2 mt-2">
            X
        </button>
    </div>
    <div class="mx-auto my-auto md:w-2/5 w-5/6 bg-white rounded-md">
        <div class="p-4 font-bold text-xl bg-[#303c4e] text-center text-[#00f2a1]">
            Rechazar Pago
        </div>
        <div class="px-6 pb-2">
            <div class="p-8 text-center text-black text-xl">
                ¿Estás seguro que deseas <b>Rechazar</b> el siguiente pago?<br />
                Referencia: {{$referencia}}<br />
                Fecha de Pago: {{date('d-m-Y', strtotime($fecha_pago))}}<br />
                <!-- Monto: { {$monto}} -->
            </div>
            <div>
                Si es así, indique el motivo:
                <textarea wire:model.defer="motivo" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"></textarea>
            </div>
            <div class="mx-auto flex justify-between w-full mt-4">
                <div class="w-1/2 text-center">
                    <button class="inline-flex items-center px-4 py-2 rounded-md bg-[#303c4e] font-bold text-sm text-white hover:text-[#00f2a1] active:bg-[#303c4e] focus:outline-none focus:border-[#303c4e] focus:ring focus:ring-[#303c4e] disabled:opacity-50 transition"
                        wire:click.prevent = "confirmarRechazo({{$id_pago}})"
                        wire:loading.attr="disabled">
                        Rechazar
                    </button>
                </div>
                <div class="w-1/2 text-center">
                    <button class="inline-flex items-center px-4 py-2 rounded-md bg-[#303c4e] font-bold text-sm text-white hover:text-[#00f2a1] active:bg-[#303c4e] focus:outline-none focus:border-[#303c4e] focus:ring focus:ring-[#303c4e] disabled:opacity-50 transition"
                        wire:click.prevent = "cerrarModalConfirmRechazo()"
                        wire:loading.attr="disabled">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>