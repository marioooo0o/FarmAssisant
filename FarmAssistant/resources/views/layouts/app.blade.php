<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <meta charset='utf-8' />
        
        <!--Full Calendar -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
        
        {{--         <script src="D:/xampp/htdocs/Laravel/FarmAssistant/FarmAssisant/FarmAssistant/resources/fullcalendar/pl.js"></script>
 --}}
       

        
        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">


        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            
            
            <nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="flex-shrink-0 flex items-center">
                                @if (@isset($activeFarm))
                                    <a href="/home/{{ $activeFarm->id }}">
                                        <div class="logo-farm" style="width: 50px; height: 50px;">
                                            <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
                                        </div>
                                        
                                    </a>
                                    <a href="/home/{{ $activeFarm->id }}" class="nav-name">
                                    {{ config('app.name')}}
                                    </a>
                                @else
                                    <a href="{{ route('farm.create') }}">
                                        <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
                                    </a>
                                    <a href="{{ route('farm.create') }}}}" class="nav-name">
                                    {{ config('app.name')}}
                                    </a>
                                @endif
                                
                                    
                                    <script>
                                        function redirectClick(id) {
                                            if(id != "0") window.location.href = `/home/${id}`;
                                            else window.location.href = `/farm/create`
                                        }
                                    </script>
                                    {{-- <input list="farms" class="farms-input" placeholder="Wybierz farmę..." >
                                    <datalist id="farms" >
                                        @foreach ($farms as $farm)
                                        <option value="{{ $farm->name }}" id="{{ $farm->id }}"></option>
                                        @endforeach
                                        
                                    </datalist> --}}

                               
                                
                            
                            </div>
            
                            <!-- Navigation Links -->
                            <!-- <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                                    
                                </x-nav-link>
                            </div> -->
                        </div>

                        <select name="companies" class="farms-input"  onChange="redirectClick(this.options[this.options.selectedIndex].value)">
                            <option value="0">Dodaj gospodarstwo</option>
                            @if (@isset($activeFarm))
                                <option value="{{ $activeFarm->id }}" selected>{{ $activeFarm->name }}</option>

                                @foreach ($farms as $farm)
                                    @if ($farm->id == $activeFarm->id)
                                    
                                    @else
                                        <option value="{{ $farm->id }}">{{ $farm->name }}</option>
                                    @endif
                                @endforeach
                            @else
                                @foreach ($farms as $farm)
                                    <option value="{{ $farm->id }}">{{ $farm->name }}</option>
                                @endforeach
                            @endif
                               
                                
                            
                            
                            

                           
                        </select>
            
                        <!-- Settings Dropdown -->
                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            <x-dropdown allign="right" width="48">
                                <x-slot name="trigger">
                                    <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                        <div>{{ Auth::user()->name }}</div>
            
                                        <div class="ml-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>
            
                                <x-slot name="content">
                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
            
                                        <x-dropdown-link :href="route('logout')"
                                                onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
            
                        <!-- Hamburger -->

                    </div>
                </div>
            
                <!-- Responsive Navigation Menu -->
                <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
                    <div class="pt-2 pb-3 space-y-1">
                        <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            {{ __('Dashboard') }}
                        </x-responsive-nav-link>
                    </div>
            
                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200">
                        <div class="px-4">
                            <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                            <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                        </div>
            
                        <div class="mt-3 space-y-1">
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
            
                                <x-responsive-nav-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Wyloguj') }}
                                </x-responsive-nav-link>
                            </form>
                        </div>
                    </div>
                </div>
            </nav>
            
           
            @yield('content')
            
        </div>
        
    </body>
</html>
