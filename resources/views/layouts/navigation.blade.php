<nav x-data="{ open: false }" class="bg-white border-b border-gray-200 shadow-sm">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Kiri: Logo + Menu -->
            <div class="flex items-center space-x-8">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
    <a href="{{ route('dashboard') }}">
        <img src="{{ asset('asset/img/logo/logo_sallavia2.png') }}" alt="Logo" class="block h-9 w-auto">
    </a>
</div>


                <!-- Navigation Links -->
                <div class="hidden sm:flex sm:space-x-6">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    <x-nav-link :href="route('products.index')" :active="request()->routeIs('products.*')">
                        {{ __('Produk') }}
                    </x-nav-link>

                    <!-- <x-nav-link :href="route('accessories.index')" :active="request()->routeIs('accessories.*')">
                        {{ __('Aksesoris') }}
                    </x-nav-link> -->

                    <x-nav-link :href="route('newarrival.index')" :active="request()->routeIs('new_arrivals.*')">
                        {{ __('New Arrival') }}
                    </x-nav-link>
                    
                    <x-nav-link :href="route('promo.index')" :active="request()->routeIs('promo.*')">
                        {{ __('Promo & Unggulan') }}
                    </x-nav-link>

                    <x-nav-link :href="route('banners.index')" :active="request()->routeIs('banners.*')">
                    {{ __('Banner Header') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Kanan: Dropdown Akun -->
            <div class="hidden sm:flex sm:items-center space-x-4">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent 
                                   text-sm leading-4 font-medium rounded-md text-gray-600 bg-white 
                                   hover:text-gray-800 focus:outline-none transition ease-in-out duration-150">
                            <div class="font-semibold">{{ Auth::user()->name }}</div>
                            <svg class="ml-2 h-4 w-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path fill="currentColor" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.25a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z"/>
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger (Mobile) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 
                           hover:text-gray-500 hover:bg-gray-100 focus:outline-none 
                           focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }"
                              class="inline-flex" stroke-linecap="round" stroke-linejoin="round" 
                              stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" 
                              class="hidden" stroke-linecap="round" stroke-linejoin="round" 
                              stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white border-t border-gray-200">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('products.index')" :active="request()->routeIs('products.*')">
                {{ __('Produk') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('accessories.index')" :active="request()->routeIs('accessories.*')">
                {{ __('Aksesoris') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('newarrival.index')" :active="request()->routeIs('newarrival.*')">
                {{ __('New Arrival') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link href="#">
                {{ __('Banner Header') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link href="#">
                {{ __('Promo & Unggulan') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
