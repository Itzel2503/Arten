<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ARTEN/KIRCOF</title>

    @livewireStyles
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Icons -->
    {{-- https://tabler.io/icons --}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>

    <!-- fullcalendar -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js'></script>

    <!-- alpine -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Toastr -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    
    <!-- SweetAlert2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .scrollEdit::-webkit-scrollbar {
            width: 6px;
            /* width of the entire scrollbar */
            border-radius: 20px;
        }

        .scrollEdit::-webkit-scrollbar-track {
            background: #ccc;
            /* color of the tracking area */
            border-radius: 20px;
        }

        .scrollEdit::-webkit-scrollbar-thumb {
            background-color: #324d57;
            /* color of the scroll thumb */
            border-radius: 20px;
            /* roundness of the scroll thumb */
            border: 2.5px solid #324d57;
            /* creates padding around scroll thumb */

        }

        .scrollEdit::-webkit-scrollbar-thumb:hover {
            background: #154854;
            box-shadow: 0 0 2px 1px rgb(0 0 0 / 20%);
            border: #ccc;
        }

        /* Estilos para pantallas de hasta 640px de ancho */
        @media (max-width: 767px) {
            #container {
                flex-direction: column; /* Cambia la disposición a vertical en pantallas pequeñas */
            }
        }
    </style>

<body>
    <div id="container"  class="flex h-screen relative">
        <!-- Desktop sidebar -->
        <div class="z-20 w-52 overflow-y-auto shadow-md flex-shrink-0 hidden md:block bg-secondary-fund">
            <div class="bg-secondary-fund py-1" style="height:100%">
                
                @if (Auth::user())
                <div class="mt-5 flex justify-center justify-items-center">
                    @if (Auth::user()->profile_photo)
                        <img class="h-20 w-20 rounded-full object-cover mx-auto" aria-hidden="true" src="{{ asset('usuarios/' . Auth::user()->profile_photo) }}" alt="Avatar" />
                    @else
                        <img class="h-20 w-20 rounded-full object-cover mx-auto" aria-hidden="true" src="{{ Avatar::create(Auth::user()->name)->toBase64() }}" alt="Avatar" />
                    @endif
                </div>
                <div class="text-white pt-2 mb-10 w-full text-center text-base">{{ Auth::user()->name }}</div>
                @endif
                <ul class="mt-6">
                    <li class="relative px-6 py-3">
                        @yield('profile')
                        <a class="text-white inline-flex items-center w-full text-base font-semibold transition-colors duration-150 hover:text-yellow-400 @yield('black1')" href="{{ route('profile.index' ) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-circle" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                <path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" />
                            </svg>                             
                            <span class="ml-4">Perfil</span>
                        </a>
                    </li>
                    @if (Auth::user()->type_user == 1)
                        <li class="relative px-6 py-3">
                            @yield('userCatalog')
                            <a class="text-white inline-flex items-center w-full text-base font-semibold transition-colors duration-150 hover:text-yellow-400 @yield('black2')" href="{{ route('userCatalog.index') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users-group" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                    <path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1" />
                                    <path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                    <path d="M17 10h2a2 2 0 0 1 2 2v1" />
                                    <path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                    <path d="M3 13v-1a2 2 0 0 1 2 -2h2" />
                                </svg>                        
                                <span class="ml-4">Usuarios</span>
                            </a>
                        </li>
                        <li class="relative px-6 py-3">
                            @yield('customers')
                            <a class="text-white inline-flex items-center w-full text-base font-semibold transition-colors duration-150 hover:text-yellow-400  @yield('black3')" href="{{ route('customers.index') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                    <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                    <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                                </svg>                                                       
                                <span class="ml-4">Clientes</span>
                            </a>
                        </li>
                    @endif
                    <li class="relative px-6 py-3">
                        @yield('projects')
                        <a class="text-white inline-flex items-center w-full text-base font-semibold transition-colors duration-150 hover:text-yellow-400  @yield('black4')" href="{{ route('projects.index') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-books" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M5 4m0 1a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1v14a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1z" />
                                <path d="M9 4m0 1a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1v14a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1z" />
                                <path d="M5 8h4" />
                                <path d="M9 16h4" />
                                <path d="M13.803 4.56l2.184 -.53c.562 -.135 1.133 .19 1.282 .732l3.695 13.418a1.02 1.02 0 0 1 -.634 1.219l-.133 .041l-2.184 .53c-.562 .135 -1.133 -.19 -1.282 -.732l-3.695 -13.418a1.02 1.02 0 0 1 .634 -1.219l.133 -.041z" />
                                <path d="M14 9l4 -1" />
                                <path d="M16 16l3.923 -.98" />
                            </svg>                             
                            <span class="ml-4">Proyectos</span>
                        </a>
                    </li>
                    {{-- <li class="relative px-6 py-3">
                        @yield('permits')
                        <a class="text-white inline-flex items-center w-full text-base font-semibold transition-colors duration-150 hover:text-yellow-400  @yield('black5')" href="{{ route('permits.index') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-run" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M13 4m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                <path d="M4 17l5 1l.75 -1.5"></path>
                                <path d="M15 21l0 -4l-4 -3l1 -6"></path>
                                <path d="M7 12l0 -3l5 -1l3 3l3 1"></path>
                            </svg>
                            <span class="ml-4">Permisos</span>
                        </a>
                    </li> --}}
                    {{-- <li class="relative px-6 py-3">
                        @yield('control_activities')
                        <a class="text-white inline-flex items-center w-full text-base font-semibold transition-colors duration-150 hover:text-yellow-400  @yield('black6')" href="">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-user" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M12 21h-6a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v4.5"></path>
                                <path d="M16 3v4"></path>
                                <path d="M8 3v4"></path>
                                <path d="M4 11h16"></path>
                                <path d="M19 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                <path d="M22 22a2 2 0 0 0 -2 -2h-2a2 2 0 0 0 -2 2"></path>
                            </svg>
                            <span class="ml-4">Control de actividades</span>
                        </a>
                    </li> --}}
                    {{-- <li class="relative px-6 py-3">
                        @yield('petty_cash')
                        <a class="text-white inline-flex items-center w-full text-base font-semibold transition-colors duration-150 hover:text-yellow-400  @yield('black7')" href="">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-currency-dollar" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2"></path>
                                <path d="M12 3v3m0 12v3"></path>
                            </svg>
                            <span class="ml-4">Caja chica</span>
                        </a>
                    </li> --}}
                </ul>

                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf
                    <div class="text-center pt-20">
                        <span class="text-base font-semibold text-yellow-400">
                            <button value="Log out" type="submit" class="bg-transparent text-yellow-400 font-semibold py-2 px-4 border border-yellow-400 rounded hover:text-white hover:border-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-logout w-5 h-5 float-right ml-2 mt-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                                    <path d="M9 12h12l-3 -3" />
                                    <path d="M18 15l3 -3" />
                                </svg>
                                Cerrar sesión
                            </button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <!-- Mobile sidebar -->
        <!-- Backdrop -->
        <div x-on:keydown.escape.prevent.stop="close($refs.button)" x-on:focusin.window="! $refs.panel.contains($event.target) && close()" x-id="['dropdown-button']"
            x-data="{
                open: false,
                toggle() {
                    if (this.open) {
                        return this.close()
                    }
                    this.$refs.button.focus()
                    this.open = true
                },

                close(focusAfter) {
                    if (! this.open) return
                    this.open = false
                    focusAfter && focusAfter.focus()
                }
            }" class="md:hidden block bg-secondary-fund">
            <div class="p-4 flex @if(Route::currentRouteName() == 'projects.reports.index') justify-between @else justify-end @endif">
                @if(Route::currentRouteName() == 'projects.reports.index')
                    <a class="text-white inline-flex items-center w-auto text-base font-semibold transition-colors duration-150 hover:text-yellow-400"  href="{{ route('projects.index') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back-up" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M9 14l-4 -4l4 -4" />
                            <path d="M5 10h11a4 4 0 1 1 0 8h-1" />
                        </svg>                          
                        <span class="ml-2">Regresar</span>
                    </a>
                @endif
                <button x-ref="button"x-on:click="toggle()":aria-expanded="open":aria-controls="$id('dropdown-button')"
                    type="button" class="flex items-center gap-2 text-white px-5 py-2.5 rounded-md shadow">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-menu-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M4 6l16 0" />
                        <path d="M4 12l16 0" />
                        <path d="M4 18l16 0" />
                    </svg>
                </button>
            </div>
            <div x-ref="panel" x-show="open"  x-on:click.outside="close($refs.button)" :id="$id('dropdown-button')" style="display: none;"
            class="absolute w-full py-4 z-40 rounded-b-md bg-secondary-fund textg-white shadow-md">
                <ul>
                    <li class="relative px-6 py-3">
                        @yield('profile')
                        <a class="w-full inline-flex text-white hover:text-yellow-400 transition-colors duration-150 text-base font-semibold @yield('black1')" href="{{ route('profile.index' ) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-circle" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                <path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" />
                            </svg>                             
                            <span class="ml-4">Perfil</span>
                        </a>
                    </li>
                    @if (Auth::user()->type_user == 1)
                    <li class="relative px-6 py-3">
                        @yield('userCatalog')
                        <a class="w-full inline-flex text-white hover:text-yellow-400 transition-colors duration-150 text-base font-semibold @yield('black2')" href="{{ route('userCatalog.index') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users-group" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                <path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1" />
                                <path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                <path d="M17 10h2a2 2 0 0 1 2 2v1" />
                                <path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                <path d="M3 13v-1a2 2 0 0 1 2 -2h2" />
                            </svg>                        
                            <span class="ml-4">Usuarios</span>
                        </a>
                    </li>
                    <li class="relative px-6 py-3">
                        @yield('customers')
                        <a class="w-full inline-flex text-white hover:text-yellow-400 transition-colors duration-150 text-base font-semibold @yield('black3')" href="{{ route('customers.index') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                            </svg>                                                       
                            <span class="ml-4">Clientes</span>
                        </a>
                    </li>
                    @endif
                    <li class="relative px-6 py-3">
                        @yield('projects')
                        <a class="text-white inline-flex items-center w-full text-base font-semibold transition-colors duration-150 hover:text-yellow-400  @yield('black4')" href="{{ route('projects.index') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-books" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M5 4m0 1a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1v14a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1z" />
                                <path d="M9 4m0 1a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1v14a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1z" />
                                <path d="M5 8h4" />
                                <path d="M9 16h4" />
                                <path d="M13.803 4.56l2.184 -.53c.562 -.135 1.133 .19 1.282 .732l3.695 13.418a1.02 1.02 0 0 1 -.634 1.219l-.133 .041l-2.184 .53c-.562 .135 -1.133 -.19 -1.282 -.732l-3.695 -13.418a1.02 1.02 0 0 1 .634 -1.219l.133 -.041z" />
                                <path d="M14 9l4 -1" />
                                <path d="M16 16l3.923 -.98" />
                            </svg>                             
                            <span class="ml-4">Proyectos</span>
                        </a>
                    </li>
                    {{-- <li class="relative px-6 py-3">
                        @yield('permits')
                        <a class="text-white inline-flex items-center w-full text-base font-semibold transition-colors duration-150 hover:text-yellow-400  @yield('black5')" href="{{ route('permits.index') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-run" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M13 4m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                <path d="M4 17l5 1l.75 -1.5"></path>
                                <path d="M15 21l0 -4l-4 -3l1 -6"></path>
                                <path d="M7 12l0 -3l5 -1l3 3l3 1"></path>
                            </svg>
                            <span class="ml-4">Permisos</span>
                        </a>
                    </li> --}}
                    {{-- <li class="relative px-6 py-3">
                        @yield('control_activities')
                        <a class="text-white inline-flex items-center w-full text-base font-semibold transition-colors duration-150 hover:text-yellow-400  @yield('black6')" href="">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-user" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M12 21h-6a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v4.5"></path>
                                <path d="M16 3v4"></path>
                                <path d="M8 3v4"></path>
                                <path d="M4 11h16"></path>
                                <path d="M19 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                <path d="M22 22a2 2 0 0 0 -2 -2h-2a2 2 0 0 0 -2 2"></path>
                            </svg>
                            <span class="ml-4">Control de actividades</span>
                        </a>
                    </li> --}}
                    {{-- <li class="relative px-6 py-3">
                        @yield('petty_cash')
                        <a class="text-white inline-flex items-center w-full text-base font-semibold transition-colors duration-150 hover:text-yellow-400  @yield('black7')" href="">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-currency-dollar" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2"></path>
                                <path d="M12 3v3m0 12v3"></path>
                            </svg>
                            <span class="ml-4">Caja chica</span>
                        </a>
                    </li> --}}
                    <li class="relative px-6 py-3">
                        <form method="POST" action="{{ route('logout') }}" x-data>
                            @csrf
                            <button value="Log out" type="submit" class="text-white inline-flex items-center w-full text-base font-semibold transition-colors duration-150 hover:text-yellow-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-logout" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                                    <path d="M9 12h12l-3 -3" />
                                    <path d="M18 15l3 -3" />
                                </svg>
                                <span class="ml-4">Cerrar sesión</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
        <div class="flex flex-col flex-1 w-full overflow-x-auto">
            <main class="h-full overflow-y-auto pb-20 scrollEdit">
                @yield('content')
            </main>
        </div>
    </div>
    @livewireScripts
    @stack('scripts')
</body>

</html>