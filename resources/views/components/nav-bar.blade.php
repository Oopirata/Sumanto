<nav x-data="{ mobileMenuIsOpen: false }" @click.away="mobileMenuIsOpen = false" class="flex items-center justify-between px-6 py-4">
    <!-- Welcome Message -->
    @if ($dosens)
        <h1 class="font-semibold text-lg mr-auto">{{ $dosens->name }} 👋</h1>
    @elseif ($mahasiswa)
        <h1 class="font-semibold text-lg mr-auto">{{ $mahasiswa->nama }} 👋</h1>
    @elseif ($dekan)
        <h1 class="font-semibold text-lg mr-auto">{{ $dekan->name }} 👋</h1>
    @elseif ($user)
        <h1 class="font-semibold text-lg mr-auto">{{ $user->name }} 👋</h1>
    @else
        <h1 class="font-semibold text-lg mr-auto">Muhammad Sumbul 👋</h1>
    @endif
    
    <!-- Desktop Menu -->
    <ul class="hidden items-center gap-4 flex-shrink-0 sm:flex">
        <li>
            <a href="" class="hover:text-gray-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16">
                    <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2M8 1.918l-.797.161A4 4 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4 4 0 0 0-3.203-3.92zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5 5 0 0 1 13 6c0 .88.32 4.2 1.22 6"/>
                </svg>
            </a>
        </li>
        <!-- User Pic -->
        <li x-data="{ userDropDownIsOpen: false, openWithKeyboard: false }" @keydown.esc.window="userDropDownIsOpen = false, openWithKeyboard = false" class="relative flex items-center">
            <button 
                @click="userDropDownIsOpen = !userDropDownIsOpen" 
                :aria-expanded="userDropDownIsOpen" 
                @keydown.space.prevent="openWithKeyboard = true" 
                @keydown.enter.prevent="openWithKeyboard = true" 
                @keydown.down.prevent="openWithKeyboard = true" 
                class="rounded-full focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black hover:opacity-80 transition-opacity" 
                aria-controls="userMenu"
            >
                <img src="https://penguinui.s3.amazonaws.com/component-assets/avatar-8.webp" alt="User Profile" class="size-10 rounded-full object-cover" />
            </button>
            <!-- User Dropdown -->
            <ul 
                x-cloak 
                x-show="userDropDownIsOpen || openWithKeyboard" 
                x-transition.opacity 
                x-trap="openWithKeyboard" 
                @click.outside="userDropDownIsOpen = false, openWithKeyboard = false" 
                @keydown.down.prevent="$focus.wrap().next()" 
                @keydown.up.prevent="$focus.wrap().previous()" 
                id="userMenu" 
                class="absolute right-0 top-12 flex w-auto min-w-[250px] flex-col overflow-hidden rounded-md border border-neutral-300 bg-white shadow-lg py-1.5 z-30"
            >
                <li class="border-b border-neutral-300">
                    <div class="flex flex-col px-4 py-2">
                        @if($dosens)
                            <span class="text-sm font-semibold text-neutral-900">{{ $dosens->name }}</span>
                            <p class="text-xs text-neutral-600 break-words">{{ $dosens->email }}</p>
                        @elseif ($mahasiswa)
                            <span class="text-sm font-semibold text-neutral-900">{{ $mahasiswa->nama }}</span>
                            <p class="text-xs text-neutral-600 break-words">{{ $user->email }}</p>
                        @elseif ($dekan)
                            <span class="text-sm font-semibold text-neutral-900">{{ $dekan->name }}</span>
                            <p class="text-xs text-neutral-600 break-words">{{ $dekan->email }}</p>
                        @elseif ($user)
                            <span class="text-sm font-semibold text-neutral-900">{{ $user->name }}</span>
                            <p class="text-xs text-neutral-600 break-words">{{ $user->email }}</p>
                        @else
                            <span class="text-sm font-semibold text-neutral-900">Muhammad Sumbul</span>
                            <p class="text-xs text-neutral-600">emailnya apa yaa</p>
                        @endif
                    </div>
                </li>
                <li>
                    <a href="#" class="block px-4 py-2 text-sm text-neutral-700 hover:bg-neutral-100 transition-colors">Settings</a>
                </li>
                <li>
                    <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm text-neutral-700 hover:bg-neutral-100 transition-colors">Sign Out</a>
                </li>
            </ul>
        </li>
    </ul>
 
    <!-- Mobile Menu Button -->
    <button 
        @click="mobileMenuIsOpen = !mobileMenuIsOpen" 
        :aria-expanded="mobileMenuIsOpen" 
        :class="mobileMenuIsOpen ? 'fixed top-6 right-6 z-20' : null" 
        type="button" 
        class="flex text-neutral-600 hover:text-neutral-900 transition-colors sm:hidden" 
        aria-label="mobile menu" 
        aria-controls="mobileMenu"
    >
        <svg x-cloak x-show="!mobileMenuIsOpen" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
        <svg x-cloak x-show="mobileMenuIsOpen" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
        </svg>
    </button>
 
    <!-- Mobile Menu -->
    <ul 
        x-cloak 
        x-show="mobileMenuIsOpen" 
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="-translate-y-full" 
        x-transition:enter-end="translate-y-0"
        x-transition:leave="transition ease-out duration-300"
        x-transition:leave-start="translate-y-0" 
        x-transition:leave-end="-translate-y-full" 
        class="fixed max-h-svh overflow-y-auto inset-x-0 top-0 z-10 flex flex-col rounded-b-md border-b border-neutral-300 bg-white px-8 pb-6 pt-10 shadow-lg sm:hidden"
    >
        <li class="mb-4 border-none">
            <div class="flex items-center gap-4 py-2">
                <img src="https://penguinui.s3.amazonaws.com/component-assets/avatar-8.webp" alt="User Profile" class="size-12 rounded-full object-cover"  />
                <div>
                    @if($dosens)
                        <span class="font-semibold text-neutral-900">{{ $dosens->name }}</span>
                        <p class="text-sm text-neutral-600 break-words">{{ $dosens->email }}</p>
                    @elseif ($mahasiswa)
                        <span class="font-semibold text-neutral-900">{{ $mahasiswa->nama }}</span>
                        <p class="text-sm text-neutral-600 break-words">{{ $user->email }}</p>
                    @elseif ($dekan)
                        <span class="font-semibold text-neutral-900">{{ $dekan->name }}</span>
                        <p class="text-sm text-neutral-600 break-words">{{ $dekan->email }}</p>
                    @elseif ($user)
                        <span class="font-semibold text-neutral-900">{{ $user->name }}</span>
                        <p class="text-sm text-neutral-600 break-words">{{ $user->email }}</p>
                    @else
                        <span class="font-semibold text-neutral-900">Muhammad Sumbul</span>
                        <p class="text-sm text-neutral-600">emailnya apa yaa</p>
                    @endif
                </div>    
            </div>
        </li>
        <hr class="my-2 border-neutral-200">
        <li>
            <a href="#" class="block py-2 text-neutral-700 hover:text-neutral-900 transition-colors">Settings</a>
        </li>
        <li class="mt-4">
            <a 
                href="{{ route('logout') }}" 
                class="block w-full text-center bg-black text-white rounded-md px-4 py-2 font-medium hover:bg-black/80 transition-colors"
            >
                Sign Out
            </a>
        </li>
    </ul>
 </nav>
 <div class="border-b-4"></div>