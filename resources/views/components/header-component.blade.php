<header class="navbar navbar-expand-lg bg-white shadow-sm">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand fw-bold logo" href="{{ route("home.index") }}" wire:navigate title="Bring me home">Read<span>Me</span></a>

        <!-- Toggler -->
        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation -->
        <livewire:layout.navigation />

        <span class="navbar-collapse d-flex justify-content-center mt-3 mt-lg-0 flex-wrap">
            @auth
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-primary mx-2" title="Log out">
                    Log out
                </button>
            </form>
            @endauth
            @guest
                <a href="{{ route("login") }}" class="btn btn-primary mx-2" title="Navigate to Sign In page">Sign In</a>
                <a href="{{ route("register") }}" class="btn mx-2" title="Navigate to Register page">Register</a>
            @endguest
            <a href="{{ url("/cart") }}" class="btn btn-icon mx-2 position-relative" title="Navigate to Cart page">
                <img src="{{ asset("images/icons/cart.png") }}" alt="cart">
                @if (session()->has("cart.items") && count(session("cart.items")) > 0)
                    <span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
                        <span class="visually-hidden">Items in cart</span>
                    </span>
                @endif
            </a>
        </span>
    </div>
</header>
