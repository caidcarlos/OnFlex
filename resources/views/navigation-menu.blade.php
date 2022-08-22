<nav x-data="{ open: false }" class="bg-[#303c4e] sticky border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-start h-16">
            <div class="flex sm:w-5/6">
                <!-- Logo -->
                <div class="shrink-0 flex items-center w-1/4">
                    <a href="{{ route('dashboard') }}">
                        <!--x-jet-application-mark class="block h-9 w-auto" /-->
                        <img src="{{asset('img/onflex-logo.png')}}" alt="OnFlex">
                    </a>
                </div>

                <!-- Navigation Links -->
                @if (Auth::user()->tipo_usuario == 1)
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-jet-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                            {{ __('Dashboard') }}
                        </x-jet-nav-link>
                    </div>

                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex pt-4">
                    <x-jet-dropdown align="left" width="48">
                        <x-slot name="trigger">
                            <span class="inline-flex rounded-md bg-[#303c4e]">
                                <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-[#303c4e] hover:text-[#00f2a1] focus:outline-none transition">
                                    Archivos
                                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </span>
                        </x-slot>
                        <x-slot name="content">
                            <x-jet-dropdown-link href="{{ route('ciudades') }}">
                                {{ __('Ciudades') }}
                            </x-jet-dropdown-link>
                            <x-jet-dropdown-link href="{{ route('comerciales') }}">
                                {{ __('Comerciales') }}
                            </x-jet-dropdown-link>
                            <x-jet-dropdown-link href="{{ route('marcas') }}">
                                {{ __('Marcas') }}
                            </x-jet-dropdown-link>
                            <x-jet-dropdown-link href="{{ route('modelos') }}">
                                {{ __('Modelos') }}
                            </x-jet-dropdown-link>
                            <x-jet-dropdown-link href="{{ route('planes-pago') }}">
                                {{ __('Planes de Pago') }}
                            </x-jet-dropdown-link>
                            <x-jet-dropdown-link href="{{ route('revisiones-pagos') }}">
                                {{ __('Revisiones de Pago') }}
                            </x-jet-dropdown-link>
                            <x-jet-dropdown-link href="{{ route('tipos-camion') }}">
                                {{ __('Tipos de Camión') }}
                            </x-jet-dropdown-link>
                        </x-slot>
                    </x-jet-dropdown>
                </div>
                @endif
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-jet-nav-link href="{{ route('propuestas-viajes') }}" :active="request()->routeIs('Propuestas-viajes')">
                        {{ __('Propuestas de Viaje') }}
                    </x-jet-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <!-- Teams Dropdown -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="ml-3 relative">
                        <x-jet-dropdown align="right" width="60">
                            <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:bg-gray-50 hover:text-[#303c4e] focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition">
                                        {{ Auth::user()->currentTeam->name }}

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                            </x-slot>

                            <x-slot name="content">
                                <div class="w-60">
                                    <!-- Team Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Manage Team') }}
                                    </div>

                                    <!-- Team Settings -->
                                    <x-jet-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                        {{ __('Team Settings') }}
                                    </x-jet-dropdown-link>

                                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                        <x-jet-dropdown-link href="{{ route('teams.create') }}">
                                            {{ __('Create New Team') }}
                                        </x-jet-dropdown-link>
                                    @endcan

                                    <div class="border-t border-gray-100"></div>

                                    <!-- Team Switcher -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Switch Teams') }}
                                    </div>

                                    @foreach (Auth::user()->allTeams() as $team)
                                        <x-jet-switchable-team :team="$team" />
                                    @endforeach
                                </div>
                            </x-slot>
                        </x-jet-dropdown>
                    </div>
                @endif

                <!-- Settings Dropdown -->
                <div class="ml-3 relative">
                    <x-jet-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (!is_null(Auth::user()->profile_photo_path))
                                <button class="flex texte-center text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                    <img class="h-10 w-10 rounded-full bg-white object-cover" src="{{ "storage/".Auth::user()->profile_photo_path }}" alt="{{ Auth::user()->name }}" />
                                </button>
                            @else
                                <span class="inline-flex rounded-md bg-[#303c4e]">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-[#303c4e] hover:text-[#00f2a1] focus:outline-none transition">
                                        @if(is_null(Auth::user()->nombre))
                                            {{ Auth::user()->email }}
                                        @else
                                            {{ Auth::user()->nombre }}
                                        @endif

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                            @endif
                        </x-slot>
                        <div class="z-50">
                            <x-slot name="content">
                                <x-jet-dropdown-link href="{{ route('perfil-usuario') }}">
                                    {{ __('Ver Perfil') }}
                                </x-jet-dropdown-link>
                                @if(Auth::user()->tipo_usuario == 3)
                                    <x-jet-dropdown-link href="{{ route('beneficiario') }}">
                                        {{ __('Beneficiario') }}
                                    </x-jet-dropdown-link>
                                    <x-jet-dropdown-link href="{{ route('camiones') }}">
                                        {{ __('Mis Camiones') }}
                                    </x-jet-dropdown-link>
                                    <x-jet-dropdown-link href="{{ route('mis-pagos') }}">
                                        {{ __('Mis Pagos') }}
                                    </x-jet-dropdown-link>
                                @endif
                                <x-jet-dropdown-link href="{{ route('viajes') }}">
                                    {{ __('Mis Viajes') }}
                                </x-jet-dropdown-link>
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf
                                
                                    <x-jet-dropdown-link href="{{ route('logout') }}"
                                        @click.prevent="$root.submit();">
                                        {{ __('Cerrar Sesión') }}
                                    </x-jet-dropdown-link>
                                </form>
                            </x-slot>
    
                        </div>
                    <!-- Authentication -->
                    </x-jet-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-[#00f2a1] hover:text-[#303c4e] hover:bg-[#00f2a1] focus:outline-none focus:bg-[#00f2a1] focus:text-[#303c4e] transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @if (Auth::user()->tipo_usuario == 1)
               
            <x-jet-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-jet-responsive-nav-link>
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="flex items-center px-4 border-b border-white">
                    <div class="">
                        <div class="text-base font-bold text-white uppercase">Archivos</div>
                    </div>
                </div>
                <div class="mt-3 space-y-1">
                    
                    <x-jet-responsive-nav-link href="{{ route('ciudades') }}" :active="request()->routeIs('ciudades')">
                        {{ __('Ciudades') }}
                    </x-jet-responsive-nav-link>
                    <x-jet-responsive-nav-link href="{{ route('marcas') }}" :active="request()->routeIs('marcas')">
                        {{ __('Marcas') }}
                    </x-jet-responsive-nav-link>
                    <x-jet-responsive-nav-link href="{{ route('comerciales') }}" :active="request()->routeIs('comerciales')">
                        {{ __('Comerciales') }}
                    </x-jet-responsive-nav-link>
                    <x-jet-responsive-nav-link href="{{ route('modelos') }}" :active="request()->routeIs('modelos')">
                        {{ __('Modelos') }}
                    </x-jet-responsive-nav-link>
                    <x-jet-responsive-nav-link href="{{ route('planes-pago') }}" :active="request()->routeIs('planes-pago')">
                        {{ __('Planes de Pago') }}
                    </x-jet-responsive-nav-link>
                    <x-jet-responsive-nav-link href="{{ route('revisiones-pagos') }}" :active="request()->routeIs('revisiones-pagos')">
                        {{ __('Revisiones de Pago') }}
                    </x-jet-responsive-nav-link>
                    <x-jet-responsive-nav-link href="{{ route('tipos-camion') }}" :active="request()->routeIs('tipos-camion')">
                        {{ __('Tipos de Camión') }}
                    </x-jet-responsive-nav-link>
                </div>
            </div>
            @endif

            <x-jet-responsive-nav-link href="{{ route('propuestas-viajes') }}" :active="request()->routeIs('propuestas-viajes')">
                {{ __('Propuestas de Viaje') }}
            </x-jet-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                @if (Auth::user()->profile_photo_path)
                    <div class="shrink-0 mr-3">
                        <img class="h-10 w-10 rounded-full object-cover bg-white" src="{{ "storage/".Auth::user()->profile_photo_path }}" alt="{{ Auth::user()->nombre }}" />
                    </div>
                @endif

                <div>
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <x-jet-responsive-nav-link href="{{ route('perfil-usuario') }}" :active="request()->routeIs('perfil-usuario')">
                    {{ __('Ver Perfil') }}
                </x-jet-responsive-nav-link>
                @if(Auth::user()->tipo_usuario == 3)
                    <x-jet-responsive-nav-link href="{{ route('beneficiario') }}" :active="request()->routeIs('beneficiario')">
                        {{ __('Beneficiario') }}
                    </x-jet-responsive-nav-link>
                    <x-jet-responsive-nav-link href="{{ route('camiones') }}" :active="request()->routeIs('camiones')">
                        {{ __('Mis Camiones') }}
                    </x-jet-responsive-nav-link>
                    <x-jet-responsive-nav-link href="{{ route('mis-pagos') }}" :active="request()->routeIs('mis-pagos')">
                        {{ __('Mis Pagos') }}
                    </x-jet-responsive-nav-link>
                @endif
                <x-jet-responsive-nav-link href="{{ route('viajes') }}" :active="request()->routeIs('viajes')">
                    {{ __('Mis Viajes') }}
                </x-jet-responsive-nav-link>
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf
                    <x-jet-responsive-nav-link href="{{ route('logout') }}"
                            @click.prevent="$root.submit();">
                        {{ __('Cerrar Sesión') }}
                    </x-jet-responsive-nav-link>
                </form>

            </div>
        </div>
    </div>
</nav>
