
@extends('layouts.html')
@section('content')

@include('layouts.section')

<section class="page-title">
    <!-- Container Start -->
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2 text-center">
                <!-- Title text -->
                <h3>{{__("trans.You are welcome")}}</h3>
            </div>
        </div>
    </div>
    <!-- Container End -->
</section>
<!--===================================
=            Store Section            =
====================================-->
<section class="section bg-gray">
	<!-- Container Start -->
	<div class="container">
		<div class="row">
			<!-- Left sidebar -->
			<div class="col-md-8">
				<div class="product-details">
					<h1 class="product-title">{{isset($category->name)?$category->name:''}}</h1>
					<div class="product-meta">
						<ul class="list-inline">
							
							<li class="list-inline-item"><i class="fa fa-folder-open-o"></i> Category<a href="">{{isset($category->maincategory)?$category->maincategory->type->type:''}}</a></li>
							
						</ul>
					</div>

					<!-- product slider -->
					
					@if(isset($category->images) && $category->images->count() > 0)
					<div class="product-slider">
					@foreach($category->images as $image)
						<div class="product-slider-item my-4" data-image="{{asset('admin/images/subcategories/'.$image->image)}}">
							<img class="img-fluid w-100" src="{{asset('admin/images/subcategories/'.$image->image)}}" alt="product-img">
						</div>
						@endforeach
						</div>
						@endif
					
					<!-- product slider -->

					<div class="content mt-5 pt-5">
						<ul class="nav nav-pills  justify-content-center" id="pills-tab" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home"
								 aria-selected="true">{{__("trans.Product Details")}}</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile"
								 aria-selected="false">{{__("trans.Specifications")}}</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact"
								 aria-selected="false">{{__("trans.Reviews")}}</a>
							</li>
						</ul>
						<div class="tab-content" id="pills-tabContent">
							<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
								<h3 class="tab-title">{{__("trans.Product Description")}}</h3>
								<p>{{$category->name}}</p>

								<iframe width="100%" height="400" src="https://www.youtube.com/embed/LUH7njvhydE?rel=0&amp;controls=0&amp;showinfo=0"
								 frameborder="0" allowfullscreen></iframe>
								<p></p>
								<p>{{isset($category->description)?$category->description->description:''}}</p>

							</div>
							<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
								<h3 class="tab-title">{{__("trans.Product Specifications")}}</h3>
								<table class="table table-bordered product-table">
									<tbody>
										<tr>
											<td>Seller Price</td>
											<td>${{round($category->the_price /18)}}</td>
										</tr>
										<tr>
											<td>Added</td>
											<td>{{$category->created_at}}</td>
										</tr>
										<tr>
											<td>State</td>
											<td>New</td>
										</tr>
										
										<tr>
											<td>Model</td>
											<td>{{date('y',time())}}</td>
										</tr>
										
										
									</tbody>
								</table>
							</div>
							<div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
								<h3 class="tab-title">{{__("trans.Product Review")}}</h3>
								<div class="product-review">
									<div class="media">
										<!-- Avater -->
										<img src="{{asset(\App\Models\SubCategory::PathImage().$category->image)}}" alt="avater">
										<div class="media-body">
											<!-- Ratings -->
											<div class="ratings">
												<ul class="list-inline">

                                                        @for( $c=0; $c<5; $c++)
                                                        <li class="list-inline-item">
                                                            <i class="fa fa-star"></i>
                                                        </li>
                                                            @endfor

												</ul>
											</div>
											<div class="name">
												<h5>{{isset($category->name)?$category->name:''}}</h5>
											</div>
											<div class="date">
												<p>Mar 20, 2018</p>
											</div>
											<div class="review-comment">
												<p>
                                                    {{__('trans.Your review matters to us')}}
												</p>
											</div>
										</div>
									</div>
									<div class="review-submission">
										<h3 class="tab-title">{{__('trans.Submit your review')}}</h3>
										<!-- Rate -->
										<div class="rate">
											<div class="starrr"></div>
										</div>
										<div class="review-submit">
											<form id="allData" action="#" class="row">
												<div class="col-lg-6">
													<input type="text" name="name" id="name" class="form-control" placeholder="Name">
												</div>
												<div class="col-lg-6">
													<input type="email" name="email" id="email" class="form-control" placeholder="Email">
												</div>
												<div class="col-12">
													<textarea name="review" id="review" rows="10" class="form-control" placeholder="Message"></textarea>
												</div>
												<div class="col-12">
													<button id="submitData" type="submit" class="btn btn-main">Sumbit</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="sidebar">
					<div class="widget price text-center">
						<h4>{{locale_lang() != 'en' ? __('trans.Price'):'Price'}}</h4>
						<p>${{round($category->the_price /18)}}</p>
					</div>
					<!-- User Profile widget -->
					<div class="widget user text-center">
						<img class="rounded-circle img-fluid mb-5 px-5" src="images/user/user-thumb.jpg" alt="">
						<h4><a href="">Jonathon Andrew</a></h4>
						<p class="member-time">Member Since Jun 27, 2017</p>
						<a href="">See all ads</a>
						<ul class="list-inline mt-20">
							<li class="list-inline-item"><a href="{{route('make_order',$category->id)}}" class="btn btn-contact d-inline-block  btn-primary px-lg-5 my-1 px-md-6">Contact</a></li>
                            <li class="list-inline-item"><a href="{{route('make_order_electronic',$category->id)}}" class="btn btn-contact d-inline-block  btn-primary px-lg-5 my-1 px-md-3">ُُElectronic Payment</a></li>

						</ul>
					</div>
					<!-- Map Widget -->
					<div class="widget map">
						<div class="map">
							<div id="map_canvas" data-latitude="51.507351" data-longitude="-0.127758"></div>
						</div>
					</div>
					<!-- Rate Widget -->
					
					<!-- Safety tips widget -->
					<div class="widget disclaimer">
						<h5 class="widget-header">Safety Tips</h5>
						<ul>
							<li>{{__('trans.Payment after receiving delivery to all provinces')}}</li>
						</ul>
					</div>
					<!-- Coupon Widget -->
					<div class="widget coupon text-center">
						<!-- Coupon description -->
						<p>{{__('trans.Have a great product to post ? Share it with your fellow users')}}.
						</p>
						<!-- Submii button -->
						<a href="{{route('make_over')}}" class="btn btn-transparent-white">{{__('trans.Submit Listing')}}</a>
					</div>

				</div>
			</div>

		</div>
	</div>
	<!-- Container End -->
</section>
<!--============================
=            Footer            =
=============================-->
@include('layouts.footer')
@endsection


@section('scripts')
    <script>
        $(document).on('click','#submitData',function(e){
            e.preventDefault();
            var data=new FormData($('#allData')[0]);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type:'POST',
                url:"{{route('review')}}",
                data:data,
                processData: false,
                contentType: false,
                cache: false,

                success:function(data){
                    if(data.statue==true){

                    }

                },
                error:function(reject){


                }


            });
        });
    </script>

    @endsection
