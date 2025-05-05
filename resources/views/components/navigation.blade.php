<nav class="navbar-collapse justify-content-end collapse" id="navbarNav" x-data="{ open: false }" @keydown.window.escape="open = false">
    <!-- Primary Navigation Menu -->
    <ul class="navbar-nav d-flex gap-5 mx-5">
        <li class="nav-item">
            <x-nav-link :href="route('home.index')" :active="request()->routeIs('home.index')" wire:navigate>
                {{ __('Home') }}
            </x-nav-link>
        </li>
        <li class="nav-item">
            <x-nav-link :href="route('products.index')" :active="request()->routeIs('products.index')" wire:navigate>
                {{ __('Products') }}
            </x-nav-link>
        </li>
    </ul>
</nav>
