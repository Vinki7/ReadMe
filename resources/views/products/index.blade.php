@extends('layouts.app')
@section('title', 'Products - ReadMe')
@push('styles')
    @vite(['resources/css/_products.scss'])
@endpush

@section('content')
    <main class="container-fluid row row-cols-auto mx-0 justify-content-center">
		<!-- Side filter panel -->
		<aside class="col-lg-3 d-none d-lg-block pt-5 ps-5">
			<div class="filter-box">
				<h5>Filter</h5>
				<div class="price-card">
					<label>
						Price Range
					</label>
					<div class="price-content">
						<div>
							<label>Min</label>
							<p id="min-value">€0</p>
						</div>
						<div>
							<label>Max</label>
							<p id="max-value">€9999</p>
						</div>
					</div>

					<div class="range-slider">
						<div class="range-fill"></div>

						<input
							type="range"
							class="min-price"
							value="0"
							min="0"
							max="9990"
							step="10"
						/>

						<input
							type="range"
							class="max-price"
							value="9990"
							min="0"
							max="9990"
							step="10"
						/>
					</div>
				</div>



				<label class="form-label mt-3">Genre</label>
				<select class="form-select">
					<option class="option-value">All</option>
					<option class="option-value">Option data1</option>
					<option class="option-value">Option data2</option>
					<option class="option-value">Option data3</option>
				</select>

				<label class="form-label mt-3">Author</label>
				<select class="form-select">
					<option class="option-value">All</option>
					<option class="option-value">Option data1</option>
					<option class="option-value">Option data2</option>
					<option class="option-value">Option data3</option>
				</select>

				<label class="form-label mt-3">Language</label>
				<select class="form-select">
					<option class="option-value">All</option>
					<option class="option-value">Option data1</option>
					<option class="option-value">Option data2</option>
					<option class="option-value">Option data3</option>
				</select>
			</div>
		</aside>

		<!-- Small screen filter button -->
		<div class="d-lg-none col-8 col-sm-3 text-center">
			<button class="filter-button btn btn-charcoal d-lg-none col-12 my-3" data-bs-toggle="offcanvas" data-bs-target="#filterOffcanvas">
				Filter
			</button>
		</div>

		<!-- Small screenfilter panel -->
		<div class="offcanvas offcanvas-start" tabindex="-1" id="filterOffcanvas">
			<div class="offcanvas-header">
				<h5 class="offcanvas-title">Filter</h5>
				<button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
			</div>
			<div class="offcanvas-body">
				<div class="filter-box">
					<label>Price Range</label>
					<div class="price-content">
						<div>
							<label>Min</label>
							<p id="min-value">€0</p>
						</div>
						<div>
							<label>Max</label>
							<p id="max-value">€9999</p>
						</div>
					</div>

					<div class="range-slider">
						<div class="range-fill"></div>
						<input
							type="range"
							class="min-price"
							value="0"
							min="0"
							max="9990"
							step="10"
						/>

						<input
							type="range"
							class="max-price"
							value="9990"
							min="0"
							max="9990"
							step="10"
						/>
					</div>
				</div>

				<label class="form-label mt-3">Genre</label>
				<select class="form-select">
					<option class="option-value">All</option>
					<option class="option-value">Option data1</option>
					<option class="option-value">Option data2</option>
					<option class="option-value">Option data3</option>
				</select>

				<label class="form-label mt-3">Author</label>
				<select class="form-select">
					<option class="option-value">All</option>
					<option class="option-value">Option data1</option>
					<option class="option-value">Option data2</option>
					<option class="option-value">Option data3</option>
				</select>

				<label class="form-label mt-3">Language</label>
				<select class="form-select">
					<option class="option-value">All</option>
					<option class="option-value">Option data1</option>
					<option class="option-value">Option data2</option>
					<option class="option-value">Option data3</option>
				</select>
			</div>
		</div>


		<!-- Main area-->
		<section class="col-12 col-lg-9 pt-5">
			<!-- Search/order area -->
			<div class="btn-container row row-cols-1 row-cols-md-2 align-items-center justify-content-center gap-3 gap-lg-0 gap mb-4 px-md-5">
				<!-- Search bar -->
				<div class="col">
					<input type="text" class="form-control col-12" placeholder="Search">
				</div>

				<!-- Ordering buttons -->
				<div class="col-7 col-sm-4 d-flex flex-column justify-content-end flex-md-row flex-wrap gap-2" role="group">
					<!-- Name sort buttons -->
					<div class="d-flex flex-column flex-xl-row gap-2">
						<div>
							<input type="radio" id="name-asc" name="sort" class="order-radio">
							<label for="name-asc" class="order-button btn btn-secondary">
								Name <img src="../../public/images/icons/chevron_up_icon.png" class="order-icon">
							</label>
						</div>

						<div>
							<input type="radio" id="name-desc" name="sort" class="order-radio">
							<label for="name-desc" class="order-button btn btn-secondary">
								Name <img src="../../public/images/icons/chevron_down_icon.png" class="order-icon">
							</label>
						</div>
					</div>
					<!-- Price Sort Buttons -->
					<div class="d-flex flex-column flex-xl-row gap-2">
						<div>
							<input type="radio" id="price-asc" name="sort" class="order-radio">
							<label for="price-asc" class="order-button btn btn-secondary">
								Price <img src="../../public/images/icons/chevron_up_icon.png" class="order-icon">
							</label>
						</div>

						<div>
							<input type="radio" id="price-desc" name="sort" class="order-radio">
							<label for="price-desc" class="order-button btn btn-secondary">
								Price <img src="../../public/images/icons/chevron_down_icon.png" class="order-icon">
							</label>
						</div>
					</div>
				</div>
			</div>

			<!-- Product Grid -->
			<div class="row row-cols-auto justify-content-center gap-4 pb-3 g-0">
				<article class="card col-12 col-md-5 col-xl-3 flex-column px-0">
					<div class="d-flex flex-column flex-sm-row">
						<div class="col-12 col-sm-5">
							<img src="../../public/images/products/harry-potter-1/front-cover.PNG" class="card-img img-fluid" alt="Harry Potter a Kameň mudrcov" title="Harry Potter a Kameň mudrcov">
						</div>
						<div class="card-body flex-grow-1 flex-column">
							<a class="title card-title" href="../product-details/product-details.html"title" href="../product-details/product-details.html">Harry Potter a Kameň mudrcov</a>
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

				<article class="card col-12 col-md-5 col-xl-3 flex-column px-0">
					<div class="d-flex flex-column flex-sm-row">
						<div class="col-12 col-sm-5">
							<img src="../../public/images/products/harry-potter-2/front-cover.PNG" class="card-img img-fluid" alt="Harry Potter a Tajomná komnata" title="Harry Potter a Tajomná komnata">
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

				<article class="card col-12 col-md-5 col-xl-3 flex-column px-0">
					<div class="d-flex flex-column flex-sm-row">
						<div class="col-12 col-sm-5">
							<img src="../../public/images/products/harry-potter-5/front-cover.PNG" class="card-img img-fluid" alt="Harry Potter a Fénixov rád" title="Harry Potter a Fénixov rád">
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

				<article class="card col-12 col-md-5 col-xl-3 flex-column px-0">
					<div class="d-flex flex-column flex-sm-row">
						<div class="col-12 col-sm-5">
							<img src="../../public/images/products/game-of-thrones-2/front-cover.PNG" class="card-img img-fluid" alt="Game of Thrones - A Clash of Kings" title="Game of Thrones - A Clash of Kings">
						</div>
						<div class="card-body flex-grow-1 flex-column">
							<a class="title card-title" href="../product-details/product-details.html">Game of Thrones - A Clash of Kings</a>
							<div class="card-text">
								<p>Author:<br>George R. R. Martin</p>
								<p><strong>9990 €</strong></p>
							</div>
						</div>
					</div>
					<footer class="card-footer mt-auto d-flex justify-content-center flex-row flex-wrap">
						<button class="btn btn-secondary">Add to Cart</button>
					</footer>
				</article>

				<article class="card col-12 col-md-5 col-xl-3 flex-column px-0">
					<div class="d-flex flex-column flex-sm-row">
						<div class="col-12 col-sm-5">
							<img src="../../public/images/products/myslenim-k-bohatstvi/front-cover.PNG" class="card-img img-fluid" alt="Myšlením k bohatství" title="Myšlením k bohatství">
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

				<article class="card col-12 col-md-5 col-xl-3 flex-column px-0">
					<div class="d-flex flex-column flex-sm-row">
						<div class="col-12 col-sm-5">
							<img src="../../public/images/products/ako-nabrat-svaly/front-cover.PNG" class="card-img img-fluid" alt="Ako nabrať svaly" title="Ako nabrať svaly">
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

				<article class="card col-12 col-md-5 col-xl-3 flex-column px-0">
					<div class="d-flex flex-column flex-sm-row">
						<div class="col-12 col-sm-5">
							<img src="../../public/images/products/cashflow-kvadrant/front-cover.PNG" class="card-img img-fluid" alt="Cashflow kvadrant" title="Cashflow kvadrant">
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

				<article class="card col-12 col-md-5 col-xl-3 flex-column px-0">
					<div class="d-flex flex-column flex-sm-row">
						<div class="col-12 col-sm-5">
							<img src="../../public/images/products/inteligentni-investor/front-cover.PNG" class="card-img img-fluid" alt="Inteligentní investor" title="Inteligentní investor">
						</div>
						<div class="card-body flex-grow-1 flex-column">
							<a class="title card-title" href="../product-details/product-details.html">Inteligentní investor</a>
							<div class="card-text">
								<p>Author:<br>Benjamin Graham</p>
								<p><strong>9990 €</strong></p>
							</div>
						</div>
					</div>
					<footer class="card-footer mt-auto d-flex justify-content-center flex-row flex-wrap">
						<button class="btn btn-secondary">Add to Cart</button>
					</footer>
				</article>

				<article class="card col-12 col-md-5 col-xl-3 flex-column px-0">
					<div class="d-flex flex-column flex-sm-row">
						<div class="col-12 col-sm-5">
							<img src="../../public/images/products/nejbohatsi-muz-v-babylone/front-cover.PNG" class="card-img img-fluid" alt="Nejbohatší muž v Babylóně" title="Nejbohatší muž v Babylóně">
						</div>
						<div class="card-body flex-grow-1 flex-column">
							<a class="title card-title" href="../product-details/product-details.html">Nejbohatší muž v Babylóně</a>
							<div class="card-text">
								<p>Author:<br>George S. Clason</p>
								<p><strong>9990 €</strong></p>
							</div>
						</div>
					</div>
					<footer class="card-footer mt-auto d-flex justify-content-center flex-row flex-wrap">
						<button class="btn btn-secondary">Add to Cart</button>
					</footer>
				</article>
			</div>
			<div class="row btn-container justify-content-center gap-4 pb-3">
				<button class="btn btn-secondary col-1 active-selection">1</button>
				<button class="btn btn-secondary col-1">2</button>
				<button class="btn btn-secondary col-1">3</button>
			</div>
		</section>
	</main>
@endsection