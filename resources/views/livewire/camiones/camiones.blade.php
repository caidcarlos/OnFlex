<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mis Camiones') }}
        </h2>
    </x-slot>
    @if($modalCreate)
        @include('livewire.camiones.modalCreate')
    @endif
    @if($modalUpdate)
        @include('livewire.camiones.modalUpdate')
    @endif
    @if($modalConfirm)
        @include('livewire.camiones.modalConfirm')
    @endif
    <div class="bg-white min-h-screen min-w-screen pt-2">
        <div class="mt-1 mx-auto">
            @if ($camiones->isEmpty())
                <div class = "my-2 w-4/5 p-4 text-center mx-auto font-bold text-sm rounded-md shadow bg-gray-700 text-green-400">
                    No tienes un camión registrado, agrégalo haciendo clic en el botón de abajo  
                </div>
            @else
                <div class="mt-4 md:flex md:justify-around w-5/6 shadow mx-auto">
                    @foreach ($camiones as $camion)
                        <div class="my-4 sm:w-full md:w-1/2 border md:mx-1 sm:p-1 md:p-2 border-green-400 rounded-md mx-auto">
                            <div class="mt-4">
                                <x-jet-label for="nombre" value="{{ __('Placa') }}" />
                                <div class="text-center block w-full text-lg font-bold rounded-md shadow-sm">
                                    {{$camion->placa}}
                                </div>
                            </div>
                            <div class="mt-4">
                                <x-jet-label for="nombre" value="{{ __('Peso de Soporte') }}" />
                                <div class="text-center block w-full text-lg font-bold rounded-md shadow-sm">
                                    {{$camion->peso_soporte}} Kilogramos
                                </div>
                            </div>
                            <div class="mt-4">
                                <x-jet-label for="nombre" value="{{ __('Año') }}" />
                                <div class="text-center block w-full text-lg font-bold rounded-md shadow-sm">
                                    {{$camion->anno}}
                                </div>
                            </div>
                            <div class="mt-4">
                                <x-jet-label for="nombre" value="{{ __('Marca') }}" />
                                <div class="text-center block w-full text-lg font-bold rounded-md shadow-sm">
                                    {{$camion->marca}}
                                </div>
                            </div>
                            <div class="mt-4">
                                <x-jet-label for="nombre" value="{{ __('Modelo') }}" />
                                <div class="text-center block w-full text-lg font-bold rounded-md shadow-sm">
                                    {{$camion->modelo}}
                                </div>
                            </div>
                            <div class="mt-4">
                                <x-jet-label for="nombre" value="{{ __('Tipo de Camión') }}" />
                                <div class="text-center block w-full text-lg font-bold rounded-md shadow-sm">
                                    {{$camion->tipo_camion}}
                                </div>
                            </div>
                            <div class="md:flex md:justify-center my-2">
                                <div class="sm:w-full md:w-auto">
                                    <button class="md:mr-2 sm:w-full md:w-auto inline-flex items-center sm:px-3 md:px-4 sm:py-1 md:py-2 bg-gray-700 hover:bg-green-500 font-bold text-sm text-white uppercase active:bg-gray-700 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-600 disabled:opacity-50 transition"
                                        wire:click.prevent = "editar({{$camion->id}})">
                                        Editar
                                    </button>  
                                </div>
                                <div class="sm:mt-4 md:mt-0 sm:w-full md:w-auto">
                                    <button class="md:ml-2 sm:w-full md:w-auto inline-flex items-center sm:px-3 md:px-4 sm:py-1 md:py-2 bg-gray-700 hover:bg-green-500 font-bold text-sm text-white uppercase active:bg-gray-700 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-600 disabled:opacity-50 transition"
                                        wire:click.prevent = "eliminar({{$camion->id}})">
                                        Eliminar
                                    </button>  
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
            @if ($camiones->count() < 2)
                <div class="w-11/12 mx-auto text-center my-2">
                    <button class="inline-flex items-center px-4 py-2 bg-gray-700 hover:bg-green-400 font-bold text-sm text-white uppercase active:bg-gray-700 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-600 disabled:opacity-50 transition"
                        wire:click.prevent = "registrar()">
                        Agregar Camión
                    </button>
                </div>
            @endif
            <!--div class="w-5/6 p-4 border boder-gray-700 rounded-sm mx-auto">
                Podrá hacer cambios o eliminar al beneficiario después de 90 días, luego del registro o última modificación.<br>
                Fecha de últimos cambios:
            </div-->
        </div>
    </div>
    <div class="w-full text-center bg-gray-700 font-bold text-green-400 text-md py-8">
        OnFlex. Conetando al país. 2022. - Todos los derechos reservados.
    </div>
</div>
