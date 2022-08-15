<div>
    <div>
        <x-guest-layout>
            <x-jet-authentication-card>
                <x-slot name="logo">
                    <x-jet-authentication-card-logo />
                </x-slot>
        
                <div class="mb-4 text-sm text-[#303c4e]">
                    @if (Auth::user()->tipo_usuario == 2)
                        {{ __('¡Muy bien! Ya conocemos los datos de tu empresa, ahora es turno de que sepamos cómo se ve el logo de tu emrpesa') }}
                    @endif
                    @if (Auth::user()->tipo_usuario == 3)
                        {{ __('¡Muy bien! Ya conocemos tus datos, ahora es turno de que sepamos cómo te ves...') }}                    
                    @endif
                </div>
                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-[#00f2a1]">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="mt-4">
                    <input id="imagen" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" 
                        type="file" name="imagen" wire:model.defer = "imagen" required />
                    @error('imagen')
                        <div class = "text-sm text-red-600 ">{{$message}}</div>
                    @enderror
                    <div>
                        <div wire:loading wire:target="imagen"
                            class="mt-4 py-4 text-center w-ful mx-auto rounded-md text-sm text-white bg-gray-700">
                            <p class="px-4">Un momento, cargando vista previa de imagen seleccionada.</p>
                        </div>
                        @if($imagen)
                            <div class="flex">
                                <div class="sm:w-full md:w-1/3">Vista Previa</div>
                                <div class="sm:w-full md:w-2/3 text-center">
                                    <img src="{{$imagen->temporaryUrl()}}" width="100%" > 
                                </div>                                       
                            </div>
                        @endif
                    </div>
                </div>
                <div class="flex justify-around mt-4">
                    <button class = "inline-flex items-center px-4 py-2 rounded-md bg-[#303c4e] font-bold text-sm text-white hover:text-[#00f2a1] active:bg-[#303c4e] focus:outline-none focus:border-[#303c4e] focus:ring focus:ring-[#303c4e] disabled:opacity-50 transition"
                        wire:click.prevent = "guardarImagen()"
                        wire:loading.attr = "disabled"
                        wire:target = "imagen">
                        Guardar Foto
                    </button>
                </div>
            </x-jet-authentication-card>
        </x-guest-layout>
    </div>
    </div>
