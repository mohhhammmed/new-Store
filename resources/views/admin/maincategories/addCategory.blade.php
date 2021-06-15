@extends('layouts.html')
@section('content')

@endsection
@include('layouts.section')
<section class="page-search">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<!-- Advance Search -->
				<div class="advance-search">
					<form>
						<div class="form-row">
							<div class="form-group col-md-4">
								<input type="text" class="form-control my-2 my-lg-0" id="inputtext4" placeholder="What are you looking for">
							</div>
							<div class="form-group col-md-3">
								<input type="text" class="form-control my-2 my-lg-0" id="inputCategory4" placeholder="Category">
							</div>
							<div class="form-group col-md-3">
								<input type="text" class="form-control my-2 my-lg-0" id="inputLocation4" placeholder="Location">
							</div>
							<div class="form-group col-md-2">

								<button type="submit" class="btn btn-primary">Search Now</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="section-sm">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="search-result bg-gray">
					<h2>Results For "Electronics"</h2>
					<p>123 Results on 12 December, 2017</p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3">
				<div class="category-sidebar">
					<div class="widget category-list">
	<h4 class="widget-header">All Category</h4>
	<ul class="category-list">
		<li><a href="category.html">Laptops <span>93</span></a></li>
		<li><a href="category.html">Iphone <span>233</span></a></li>
		<li><a href="category.html">Microsoft  <span>183</span></a></li>
		<li><a href="category.html">Monitors <span>343</span></a></li>
	</ul>
</div>

<div class="widget category-list">
	<h4 class="widget-header">Nearby</h4>
	<ul class="category-list">
		<li><a href="category.html">New York <span>93</span></a></li>
		<li><a href="category.html">New Jersy <span>233</span></a></li>
		<li><a href="category.html">Florida  <span>183</span></a></li>
		<li><a href="category.html">California <span>120</span></a></li>
		<li><a href="category.html">Texas <span>40</span></a></li>
		<li><a href="category.html">Alaska <span>81</span></a></li>
	</ul>
</div>

<div class="widget filter">
	<h4 class="widget-header">Show Produts</h4>
	<select>
		<option>Popularity</option>
		<option value="1">Top rated</option>
		<option value="2">Lowest Price</option>
		<option value="4">Highest Price</option>
	</select>
</div>

<div class="widget price-range w-100">
	<h4 class="widget-header">Price Range</h4>
	<div class="block">
						<input class="range-track w-100" type="text" data-slider-min="0" data-slider-max="5000" data-slider-step="5"
						data-slider-value="[0,5000]">
				<div class="d-flex justify-content-between mt-2">
						<span class="value">$10 - $5000</span>
				</div>
	</div>
</div>

<div class="widget product-shorting">
	<h4 class="widget-header">By Condition</h4>
	<div class="form-check">
	  <label class="form-check-label">
	    <input class="form-check-input" type="checkbox" value="">
	    Brand New
	  </label>
	</div>
	<div class="form-check">
	  <label class="form-check-label">
	    <input class="form-check-input" type="checkbox" value="">
	    Almost New
	  </label>
	</div>
	<div class="form-check">
	  <label class="form-check-label">
	    <input class="form-check-input" type="checkbox" value="">
	    Gently New
	  </label>
	</div>
	<div class="form-check">
	  <label class="form-check-label">
	    <input class="form-check-input" type="checkbox" value="">
	    Havely New
	  </label>
	</div>
</div>

				</div>
			</div>
			<div class="col-md-9">
				<div class="category-search-filter">
					<div class="row">
						<div class="col-md-6 btn-group btn-group-lg">
							<strong>Add Category</strong>

						</div>
						<div class="col-md-6">
							<div class="view">
								<strong>Views</strong>
								<ul class="list-inline view-switcher">
									<li class="list-inline-item">
										<a href="#" onclick="event.preventDefault();" class="text-info"><i class="fa fa-th-large"></i></a>
									</li>
									<li class="list-inline-item">
										<a href="ad-list-view.html"><i class="fa fa-reorder"></i></a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="product-grid-list">
					<div class="row mt-30">

							<!-- product card -->
							<div class="col-md-10 offset-md-1 col-lg-10 offset-lg-0">
								<!-- Recently Favorited -->
								<div class="widget dashboard-container my-adslist">
								  @include('messages.err_or_succ')
									<h3 class="widget-header">Add Category</h3>
							  <form id="allData"  action="#"method='POST'enctype='multipart/form-data'>

								@csrf
                                  @if(isset($types_categories) && $types_categories->count() >0 )
                                      <label for="exampleFormControlInput1" class="form-label">Type Categories</label>
                                      <select name="type_id">

                                      @foreach($types_categories as $type)
                                          <option value="{{$type->id}}">{{$type->type}}</option>
                                          @endforeach
                                      </select>
                                      <small type="hidden"id="type_id_er"></small>
                                      @endif
                                  <br><br>
								@if(isset($langs))
								<label for="exampleFormControlInput1" class="form-label">Image Category</label>

								<input type="file" name='image' class="form-control"><br>
                                      <small type="hidden"id="image"></small>
								@foreach ($langs as $count=> $lang)
									<h2 class="alert alert-primary d-flex align-items-center">{{'Category by lang '.$lang->name}}</h2>


									<input class="form-control form-control-lg"name='category[{{$count}}][category]' type="text" placeholder="Name" aria-label=".form-control-lg example">

                                          <small type="hidden"class="category{{$count}}"></small>
									<input class="form-control form-control-sm"value='{{$lang->abbr}}' type="hidden"name='category[{{$count}}][translation_lang]' placeholder="abbr" aria-label=".form-control-sm example">
                                          <small type="hidden"id="translation_lang"></small>
                                      <br>
                                          <div class="form-check form-switch">

                                              <input class="form-check-input" name="category[{{$count}}][action]"value='1' type="checkbox" id="flexSwitchCheckDefault" checked>

                                              <label class="form-check-label" for="flexSwitchCheckDefault">Statue</label>
                                          </div>

							  @endforeach

							  @endif
                                  <input class="form-control form-control-sm" placeholder="Price Average" type="text"name='average' aria-label=".form-control-sm example">
                                  <small type="hidden" id="average-er"></small>
                                  <br>

							  <button id="submitData" type="submit" class="d-block py-3 px-5 bg-primary text-white border-0 rounded font-weight-bold mt-3">Add</button>
							  </form>
								</div>
						</div>
					</div>
				</div>


				</div>
			</div>
		</div>
	</div>
</section>
<!--============================
=            Footer            =
=============================-->
@include('layouts.footer')

<!-- JAVASCRIPTS -->
@section('scripts')
    <script>
        $(document).on('click','#submitData',function(e){
            e.preventDefault();
            var data = new FormData($('#allData')[0]);
            $.ajax({
                type:'POST',
                url:"{{route('admin_store_maincategories')}}",
                data:data,
                processData: false,
                contentType: false,
                cache: false,
                {{--//'_token':'{{csrf_token()}}',--}}
                success:function(data){
                    if(data.statue==true){
                        alert(data.msg);
                    }
                    alert(data.msg);
                },
                error:function(reject){


                }

            });
        });
    </script>
    @endsection
