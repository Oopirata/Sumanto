@auth
<nav x-data="{ mobileMenuIsOpen: false }" @click.away="mobileMenuIsOpen = false" class="flex items-center justify-between px-6 py-4">
    <!-- Welcome Message -->
    <h1 class="font-semibold text-lg mr-auto">{{ Auth::user() -> name }}</h1>
    
    <!-- Desktop Menu -->
    <ul class="hidden items-center gap-4 flex-shrink-0 sm:flex">
        <li><a href=""><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16">
            <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2M8 1.918l-.797.161A4 4 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4 4 0 0 0-3.203-3.92zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5 5 0 0 1 13 6c0 .88.32 4.2 1.22 6"/>
            </svg></a></li>
        <!-- User Pic -->
        <li x-data="{ userDropDownIsOpen: false, openWithKeyboard: false }" @keydown.esc.window="userDropDownIsOpen = false, openWithKeyboard = false" class="relative flex items-center">
            <button @click="userDropDownIsOpen = ! userDropDownIsOpen" :aria-expanded="userDropDownIsOpen" @keydown.space.prevent="openWithKeyboard = true" @keydown.enter.prevent="openWithKeyboard = true" @keydown.down.prevent="openWithKeyboard = true" class="rounded-full focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black dark:focus-visible:outline-white" aria-controls="userMenu">
                <img src="https://penguinui.s3.amazonaws.com/component-assets/avatar-8.webp" alt="User Profile" class="size-10 rounded-full object-cover" />
            </button>
            <!-- User Dropdown -->
            <ul x-cloak x-show="userDropDownIsOpen || openWithKeyboard" x-transition.opacity x-trap="openWithKeyboard" @click.outside="userDropDownIsOpen = false, openWithKeyboard = false" @keydown.down.prevent="$focus.wrap().next()" @keydown.up.prevent="$focus.wrap().previous()" id="userMenu" class="absolute right-0 top-12 flex w-full min-w-[12rem] flex-col overflow-hidden rounded-md border border-neutral-300 bg-neutral-50 py-1.5 dark:border-neutral-700 dark:bg-neutral-900 z-30">
                <li class="border-b border-neutral-300 dark:border-neutral-700">
                    <div class="flex flex-col px-4 py-2">    
                        <span class="text-sm font-medium text-neutral-900 dark:text-white">{{ Auth::user() -> name }}</span>
                        <p class="text-xs text-neutral-600 dark:text-neutral-300">{{ Auth::user() -> email }}</p>
                    </div>
                </li>
                <li><a href="#" class="block bg-neutral-50 px-4 py-2 text-sm text-neutral-600 hover:bg-neutral-900/5 hover:text-neutral-900 focus-visible:bg-neutral-900/10 focus-visible:text-neutral-900 focus-visible:outline-none dark:bg-neutral-900 dark:text-neutral-300 dark:hover:bg-neutral-50/5 dark:hover:text-white dark:focus-visible:bg-neutral-50/10 dark:focus-visible:text-white">Settings</a></li>
                <li><a href="#" class="block bg-neutral-50 px-4 py-2 text-sm text-neutral-600 hover:bg-neutral-900/5 hover:text-neutral-900 focus-visible:bg-neutral-900/10 focus-visible:text-neutral-900 focus-visible:outline-none dark:bg-neutral-900 dark:text-neutral-300 dark:hover:bg-neutral-50/5 dark:hover:text-white dark:focus-visible:bg-neutral-50/10 dark:focus-visible:text-white">Sign Out</a></li>
            </ul>
        </li>
    </ul>
    <!-- Mobile Menu Button -->
    <button @click="mobileMenuIsOpen = !mobileMenuIsOpen" :aria-expanded="mobileMenuIsOpen" :class="mobileMenuIsOpen ? 'fixed top-6 right-6 z-20' : null" type="button" class="flex text-neutral-600 dark:text-neutral-300 sm:hidden" aria-label="mobile menu" aria-controls="mobileMenu">
        <svg x-cloak x-show="!mobileMenuIsOpen" xmlns="http://www.w3.org/2000/svg" fill="none" aria-hidden="true" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
        <svg x-cloak x-show="mobileMenuIsOpen" xmlns="http://www.w3.org/2000/svg" fill="none" aria-hidden="true" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
        </svg>
    </button>
    <!-- Mobile Menu -->
    <ul x-cloak x-show="mobileMenuIsOpen" x-transition:enter="transition motion-reduce:transition-none ease-out duration-300" x-transition:enter-start="-translate-y-full" x-transition:enter-end="translate-y-0" x-transition:leave="transition motion-reduce:transition-none ease-out duration-300" x-transition:leave-start="translate-y-0" x-transition:leave-end="-translate-y-full" class="fixed max-h-svh overflow-y-auto inset-x-0 top-0 z-10 flex flex-col rounded-b-md border-b border-neutral-300 bg-neutral-50 px-8 pb-6 pt-10 dark:border-neutral-700 dark:bg-neutral-900 sm:hidden">
        <li class="mb-4 border-none">
            <div class="flex items-center gap-2 py-2">
                <img src="https://penguinui.s3.amazonaws.com/component-assets/avatar-8.webp" alt="User Profile" class="size-12 rounded-full object-cover"  />
                <div>
                    <span class="font-medium text-neutral-900 dark:text-white">Alice Brown</span>
                    <p class="text-sm text-neutral-600 dark:text-neutral-300">alice.brown@gmail.com</p>
                </div>    
            </div>
        </li>
        <hr role="none" class="my-2 border-outline dark:border-neutral-700">
        <li class="p-2"><a href="#" class="w-full text-neutral-600 focus:underline dark:text-neutral-300">Settings</a></li>
        <!-- CTA Button -->
        <li class="mt-4 w-full border-none"><a href="{{ route ('logout') }}" class="rounded-md bg-black px-4 py-2 block text-center font-medium tracking-wide text-neutral-100 hover:opacity-75 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black active:opacity-100 active:outline-offset-0 dark:bg-white dark:text-black dark:focus-visible:outline-white">Sign Out</a></li>
    </ul>
</nav>
<div class="border-b-4"></div>
@endauth