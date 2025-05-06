<article class="card col-12 col-md-5 col-lg-3 flex-column">
    <div class="d-flex flex-column flex-sm-row overflow-hidden">
         <div class="col-12 col-sm-5">
               <img src="{{ asset($frontCoverPath) }}" class="card-img img-fluid" alt="{{ $title }}" title="{{ $title }}">
         </div>
         <div class="card-body flex-grow-1 flex-column">
               <a class="title card-title" href="{{ route('products.show', $productId) }}">
                    {{ $title }}
               </a>
               <div class="card-text">
                    <p>Author:<br>{{ implode(', ', $authors) }}</p>
                    <p><strong>{{ $price }} €</strong></p>
               </div>
         </div>
    </div>
    <form method="POST" action="{{ route('cart.add', $id) }}" class="card-footer mt-auto d-flex justify-content-center flex-row flex-wrap">
        @csrf
        <input type="hidden" name="quantity" value="1">
        <input class="btn btn-secondary" type="submit" value="Add to Cart">
    </form>
</article>
