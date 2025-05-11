<article class="card col-12 col-md-5 col-lg-3 flex-column">
    <div class="d-flex flex-column flex-sm-row overflow-hidden">
         <div class="col-12 col-sm-5">
               <img src="{{ asset($frontCoverPath) }}" class="card-img img-fluid" alt="{{ $title }}" title="{{ $title }}">
         </div>
         <div class="card-body flex-grow-1 flex-column">
               <a class="title card-title" href="{{ route('admin.products.edit', $productId) }}">
                    {{ $title }}
               </a>
               <div class="card-text">
                    <p>Author:<br>{{ implode(', ', $authors) }}</p>
                    <p><strong>{{ $price }} €</strong></p>
               </div>
         </div>
    </div>
    <div class="card-footer mt-auto d-flex justify-content-center gap-5">
        <a href="{{ route('admin.products.edit', $productId) }}" class="btn btn-primary">
            Edit
        </a>
        <form method="POST" action="{{ route('admin.products.destroy', $productId) }}" onsubmit="return confirm('Are you sure you want to delete this product?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-icon">
                <img src="{{ asset('images/icons/remove.png') }}" alt="Remove item" title="Remove item">
            </button>
        </form>
    </div>
</article>
