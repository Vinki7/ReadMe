@extends('layouts.app')
@section('title', 'Home - ReadMe')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endpush

@section('content')
<main class="container-fluid flex-grow-1 flex-column px-5">
    <section class="container-fluid title-section" role="img" aria-labelledby="hero-heading">
            <div class="text-white d-flex flex-column justify-content-center align-items-start">
            <h1>ReadMe</h1>
            <h3 class="ms-lg-5">The place where stories live...</h3>
        </div>
    </section>
    <section class="container my-5 d-flex justify-content-center flex-column gap-3">
        <header class="category-header d-flex justify-content-start w-full">
            <a class="btn btn-charcoal" href="../products/products.html">Fantasy</a>
        </header>
        <div class="d-flex justify-content-start flex-column flex-md-row flex-wrap gap-5">
            <article class="card col-12 col-md-5 col-lg-3 flex-column">
                <div class="d-flex flex-column flex-sm-row">
                    <div class="col-12 col-sm-5">
                        <img src="{{ asset('images/products/harry-potter-1/front-cover.PNG') }}" class="card-img img-fluid" alt="Harry Potter a Kameň mudrcov" title="Harry Potter a Kameň mudrcov">
                    </div>
                    <div class="card-body flex-grow-1 flex-column">
                        <a class="title card-title" href="../product-details/product-details.html" href="../product-details/product-details.html">Harry Potter a Kameň mudrcov</a>
                        <div class="card-text">
                            <p>Author:<br>J. K. Rowling</p>
                            <p><strong>9990 €</strong></p>
                        </div>
                    </div>
                </div>
                <footer class="card-footer mt-auto d-flex justify-content-center flex-row flex-wrap">
                    <button class="btn btn-secondary">Add to Cart</button>
                </footer>
            </article>
            <article class="card col-12 col-md-5 col-lg-3 flex-column">
                <div class="d-flex flex-column flex-sm-row">
                    <div class="col-12 col-sm-5">
                        <img src="{{ asset("images/products/harry-potter-2/front-cover.PNG") }}" class="card-img img-fluid" alt="Harry Potter a Tajomná komnata" title="Harry Potter a Tajomná komnata">
                    </div>
                    <div class="card-body flex-grow-1 flex-column">
                        <a class="title card-title" href="../product-details/product-details.html">Harry Potter a Tajomná komnata</a>
                        <div class="card-text">
                            <p>Author:<br>J. K. Rowling</p>
                            <p><strong>9990 €</strong></p>
                        </div>
                    </div>
                </div>
                <footer class="card-footer mt-auto d-flex justify-content-center flex-row flex-wrap">
                    <button class="btn btn-secondary">Add to Cart</button>
                </footer>
            </article>
            <article class="card col-12 col-md-5 col-lg-3 flex-column">
                <div class="d-flex flex-column flex-sm-row">
                    <div class="col-12 col-sm-5">
                        <img src="{{ asset("images/products/harry-potter-5/front-cover.PNG") }}" class="card-img img-fluid" alt="Harry Potter a Fénixov rád" title="Harry Potter a Fénixov rád">
                    </div>
                    <div class="card-body flex-grow-1 flex-column">
                        <a class="title card-title" href="../product-details/product-details.html">Harry Potter a Fénixov rád</a>
                        <div class="card-text">
                            <p>Author:<br>J. K. Rowling</p>
                            <p><strong>9990 €</strong></p>
                        </div>
                    </div>
                </div>
                <footer class="card-footer mt-auto d-flex justify-content-center flex-row flex-wrap">
                    <button class="btn btn-secondary">Add to Cart</button>
                </footer>
            </article>
        </div>
    </section>
    <section class="container my-5 d-flex justify-content-center flex-column gap-3">
        <span class="category-header d-flex justify-content-start w-full">
            <a class="btn btn-charcoal" href="../products/products.html">Educative</a>
        </span>
        <section class="d-flex justify-content-start flex-column flex-md-row flex-wrap gap-5">
            <article class="card col-12 col-md-5 col-lg-3 flex-column">
                <div class="d-flex flex-column flex-sm-row">
                    <div class="col-12 col-sm-5">
                        <img src="{{ asset("images/products/myslenim-k-bohatstvi/front-cover.PNG") }}" class="card-img img-fluid" alt="Myšlením k bohatství" title="Myšlením k bohatství">
                    </div>
                    <div class="card-body flex-grow-1 flex-column">
                        <a class="title card-title" href="../product-details/product-details.html">Myšlením k bohatství</a>
                        <div class="card-text">
                            <p>Author:<br>Napoleon Hill</p>
                            <p><strong>9990 €</strong></p>
                        </div>
                    </div>
                </div>
                <footer class="card-footer mt-auto d-flex justify-content-center flex-row flex-wrap">
                    <button class="btn btn-secondary">Add to Cart</button>
                </footer>
            </article>
            <article class="card col-12 col-md-5 col-lg-3 flex-column">
                <div class="d-flex flex-column flex-sm-row">
                    <div class="col-12 col-sm-5">
                        <img src=" {{ asset("images/products/ako-nabrat-svaly/front-cover.PNG") }}" class="card-img img-fluid" alt="Ako nabrať svaly" title="Ako nabrať svaly">
                    </div>
                    <div class="card-body flex-grow-1 flex-column">
                        <a class="title card-title" href="../product-details/product-details.html">Ako nabrať svaly</a>
                        <div class="card-text">
                            <p>Author:<br>Boris Prekop</p>
                            <p><strong>9990 €</strong></p>
                        </div>
                    </div>
                </div>
                <footer class="card-footer mt-auto d-flex justify-content-center flex-row flex-wrap">
                    <button class="btn btn-secondary">Add to Cart</button>
                </footer>
            </article>
            <article class="card col-12 col-md-5 col-lg-3 flex-column">
                <div class="d-flex flex-column flex-sm-row">
                    <div class="col-12 col-sm-5">
                        <img src="{{ asset("images/products/cashflow-kvadrant/front-cover.PNG") }}" class="card-img img-fluid" alt="Cashflow kvadrant" title="Cashflow kvadrant">
                    </div>
                    <div class="card-body flex-grow-1 flex-column">
                        <a class="title card-title" href="../product-details/product-details.html">Cashflow kvadrant</a>
                        <div class="card-text">
                            <p>Author:<br>Robert. T. Kiyosaki</p>
                            <p><strong>9990 €</strong></p>
                        </div>
                    </div>
                </div>
                <footer class="card-footer mt-auto d-flex justify-content-center flex-row flex-wrap">
                    <button class="btn btn-secondary">Add to Cart</button>
                </footer>
            </article>
        </section>
    </section>
</main>
@endsection
