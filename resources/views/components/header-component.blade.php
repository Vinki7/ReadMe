<header class="navbar navbar-expand-lg bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold logo" href="../home/index.html" title="Bring me home">Read<span>Me</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <nav class="navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav d-flex gap-5 mx-5">
                <li class="nav-item">
                    <a class="nav-link active" href="index.html" title="Navigate to home page">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../products/products.html" title="Navigate to product listing">Products</a>
                </li>
            </ul>
        </nav>
        <span class="navbar-collapse d-flex justify-content-center mt-3 mt-lg-0 flex-wrap">
            <a href="../auth/sign-in.html" class="btn btn-primary mx-2" title="Navigate to Sign In page">Sign In</a>
            <a href="../auth/register.html" class="btn mx-2" title="Navigate to Register page">Register</a>
            <a href="../cart/cart.html" class="btn btn-icon mx-2" title="Navigate to Cart page">
                <img src="{{ asset("images/icons/cart.png") }}" alt="cart">
            </a>
        </span>
    </div>
</header>
