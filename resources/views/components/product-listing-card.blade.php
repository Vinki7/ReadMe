<article class="card col-12 col-md-5 col-lg-3 flex-column">
    <div class="d-flex flex-column flex-sm-row">
         <div class="col-12 col-sm-5">
               <img src="{{ asset($frontCoverPath) }}" class="card-img img-fluid" alt="{{ $title }}" title="{{ $title }}">
         </div>
         <div class="card-body flex-grow-1 flex-column">
               <a class="title card-title" href="{{ $detailsUrl }}">
                    {{ $title }}
               </a>
               <div class="card-text">
                    <p>Author:<br>{{ implode(', ', $authors) }}</p>
                    <p><strong>{{ $price }} €</strong></p>
               </div>
         </div>
    </div>
    <footer class="card-footer mt-auto d-flex justify-content-center flex-row flex-wrap">
         <button class="btn btn-secondary">Add to Cart</button>
    </footer>
</article>
