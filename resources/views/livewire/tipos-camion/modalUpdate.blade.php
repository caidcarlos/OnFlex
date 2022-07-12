<div class="fixed w-full inset-0 z-50 overflow-hidden items-center animated fadeIn faster" style="background: rgba(0,0,0,.7);">
    <div class="w-full text-right">
        <button wire:click.prevent="cerrarModalUpdate()" class="p-3 text-white mr-2 mt-2">
            X
        </button>
    </div>
    <div class="mx-auto my-auto w-3/5 sm:h-1/2 md:h-5/6 bg-white rounded-md overflow-y-scroll">
        <div class="p-4 font-bold text-xl">
            Editar Tipo de Camión
        </div>
        <div class="px-6 pb-2">
            <div class="mt-4">
                <x-jet-label for="nombre" value="{{ __('Nombre') }}" />
                <input id="nombre" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" 
                    type="text" name="nombre" wire:model.defer="nombre" required />
                @error('nombre')
                    <div id="text-sm text-red-500">{{$message}}</div>
                @enderror
            </div>
            <div class="mx-auto md:flex md:justify-between w-11/12 mt-4">
                <div class="md:w-1/2 sm:w-full">
                    <button class="inline-flex items-center px-4 py-2 bg-gray-700 hover:bg-green-500 font-bold text-sm text-white uppercase active:bg-gray-700 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-600 disabled:opacity-50 transition"
                        wire:click.prevent = "modificar({{$id_tipo}})"
                        wire:loagind.attr="disabled">
                        Modificar
                    </button>
                </div>
                <div class="md:w-1/2 sm:w-full sm:text-center sm:mt-2 md:mt-0">
                    <button class="inline-flex items-center px-4 py-2 bg-gray-700 hover:bg-green-500 font-bold text-sm text-white uppercase active:bg-gray-700 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-600 disabled:opacity-50 transition"
                        wire:click.prevent = "cerrarModalUpdate()"
                        wire:loading.attr="disabled">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>