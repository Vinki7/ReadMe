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
            <a href="../auth/sign-in.html" class="btn btn-primary mx-2" title="Navigate to Sign In page">Sign In</a>
            <a href="../auth/register.html" class="btn mx-2" title="Navigate to Register page">Register</a>
            <a href="{{ url("/cart") }}" class="btn btn-icon mx-2" title="Navigate to Cart page">
                <img src="{{ asset("images/icons/cart.png") }}" alt="cart">
            </a>
        </span>
    </div>
</header>
