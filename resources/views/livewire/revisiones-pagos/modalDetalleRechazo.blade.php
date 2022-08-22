<div class="fixed w-full inset-0 z-50 overflow-hidden items-center animated fadeIn faster" style="background: rgba(0,0,0,.7);">
    <div class="w-full text-right">
        <button wire:click.prevent="cerrarModalDetalleRechazo()" class="p-3 text-white mr-2 mt-2">
            X
        </button>
    </div>
    <div class="mx-auto my-auto md:w-2/5 w-5/6 bg-white rounded-md">
        <div class="p-4 font-bold text-xl bg-[#303c4e] text-center text-[#00f2a1]">
            Detalles de Pago Rechazado
        </div>
        <div class="px-6 pb-2">
            <div class="p-4">
                @foreach ($detalleRechazado as $dr)
                    <div class="md:flex md:justify-around">
                        <div class="w-full md:w-1/2">
                            <div class="text-sm text-gray-900 mx-2 my-2 font-bold">Correo de Usuario</div>
                            <div class="text-sm text-gray-900 mx-2 my-2">{{$dr->email}}</div>
                        </div>
                        <div class="w-full md:w-1/2">
                            <div class="text-sm text-gray-900 mx-2 my-2 font-bold">Referencia</div>
                            <div class="text-sm text-gray-900 mx-2 my-2">{{$dr->referencia}}</div>
                        </div>
                    </div>
                    <div class="md:flex md:justify-start">
                        <div class="w-full md:w-1/2">
                            <div class="text-sm text-gray-900 mx-2 my-2 font-bold">Fecha de Pago</div>
                            <div class="text-sm text-gray-900 mx-2 my-2">{{date('d-m-Y', strtotime($dr->fecha_pago))}}</div>
                        </div>
                        <!--div class="w-full md:w-1/2">
                            <div class="text-sm text-gray-900 mx-2 my-2 font-bold">Monto</div>
                            <div class="text-sm text-gray-900 mx-2 my-2">{ {$dr->monto}}</div>
                        </div-->
                    </div>
                    <div class="w-full">
                        <div class="text-sm text-gray-900 mx-2 my-2 font-bold">Motivo</div>
                        <div class="text-sm text-gray-900 mx-2 my-2 overflow-x-auto">{{$dr->motivo}}</div>
                    </div>
                @endforeach
            </div>
            <div class="mx-auto flex justify-between w-full mt-4">
                <div class="w-full text-center">
                    <button class="inline-flex items-center px-4 py-2 rounded-md bg-[#303c4e] font-bold text-sm text-white hover:text-[#00f2a1] active:bg-[#303c4e] focus:outline-none focus:border-[#303c4e] focus:ring focus:ring-[#303c4e] disabled:opacity-50 transition"
                        wire:click.prevent = "cerrarModalDetalleRechazo()"
                        wire:loading.attr="disabled">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>