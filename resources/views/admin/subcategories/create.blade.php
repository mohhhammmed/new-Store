@extends('layouts.html')
@section('content')

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
        @if(isset($maincategories)&& $maincategories->count()>0)
            @foreach($maincategories as $maincategory)
		<li><a href="category.html">{{$maincategory->category}} <span>{{$maincategory->subcategories->count()}}</span></a></li>

            @endforeach
            @endif
	</ul>
</div>

<div class="widget category-list">
	<h4 class="widget-header">Nearby</h4>
	<ul class="category-list">
        @if(isset($branches)&& $branches->count() > 0)
            @foreach($branches as $branch)
		<li><a href="category.html">{{$branch->governorate}}</a></li>

            @endforeach
            @endif
	</ul>
</div>

				</div>
			</div>
			<div class="col-md-9">
				<div class="category-search-filter">
					<div class="row">
						<div class="col-md-6 btn-group btn-group-lg">
							<strong>Add SubCategory</strong>

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
								  @include('alarms.alarm')

							  <form id='allData'  action="{{route('store_subcategory')}}"method='POST'enctype='multipart/form-data'>
								@csrf

								<select name='maincategory_id'>
									@if(isset($maincats) && count($maincats) > 0)
									@foreach ($maincats as $maincategory)
									<option value="{{$maincategory->id}}" @if(isset($subcategory_edit) && $subcategory_edit->maincategory_id == $maincategory->id) selected @endif>{{$maincategory->category}}</option>
									@endforeach
									@endif
								</select>{{'  '}}<label for="exampleFormControlInput1" class="form-label">Main Category</label>
								<h3><small type='hidden' id='maincategory_id_er'class='text text-danger'></small></h3>
									<br>


                                  <select name='parent_id'>
                                      @if(isset($parentSubCat) && $parentSubCat->count() > 0)
                                          @foreach ($parentSubCat as $parent)
                                              <option value="{{$parent->id}}" @if(isset($subcategory_edit) && $subcategory_edit->parent_id == $parent->id) selected @endif>{{$parent->type}}</option>
                                          @endforeach
                                      @endif

                                  </select>{{'  '}}<label for="exampleFormControlInput1" class="form-label">Main Category Type</label>
                                  <h3><small type='hidden' id='parent_id_er'class='text text-danger'></small></h3>
                                  <br>

                                  @if(isset($subcategory_edit) &&$subcategory_edit !=null )

                                    <img width="200px" height="150px" src="{{asset(\App\Models\SubCategory::PathImage().$subcategory_edit->image)}}">
                                  @endif
                                     <br>
								<label for="exampleFormControlInput1" class="form-label">Image SubCategory</label>
								<input type="file" name='image' class="form-control">
								<strong><h3><small type='hidden' id='image_er'class='text text-danger'></small></h3></strong>
								<br>


								<input class="form-control  form-control-lg" value="{{isset($subcategory_edit)?$subcategory_edit->name:''}}" name='name' type="text" placeholder="Name" aria-label=".form-control-lg example">
								<h3><small type='hidden' id='name_er'class='text text-danger'></small></h3><br>


                                  <input class="form-control form-control-lg" value="{{isset($subcategory_edit)?$subcategory_edit->the_price:''}}" name='the_price' type="text" placeholder="The Price" aria-label=".form-control-lg example">
                                  <h3><small type='hidden' id='the_price_er'class='text text-danger'></small></h3>

                                  @isset($subcategory_edit)
                                      <input type="hidden" value="{{$subcategory_edit->id}}"name="id">
                                  @endisset

                                  <textarea name="description"  placeholder="Description *" class="border w-100 p-3 mt-3 mt-lg-4">@if(isset($subcategory_edit)){{$subcategory_edit->description->description}}@endif</textarea>

                                  <h3><small type='hidden' id='description_er'class='text text-danger'></small></h3>


                                  <br>
									<input class="form-control form-control-sm"value="{{isset($lang_maincategory->translation_lang)? $lang_maincategory->translation_lang :$subcategory_edit->translation_lang}}" type="hidden"name='translation_lang' placeholder="The Lang" aria-label=".form-control-sm example">
								<h3><small type='hidden' id='translation_lang_er'class='text text-danger' ></small></h3>


							      <div class="form-check form-swi tch">

								<input class="form-check-input" name="statue"value='1' type="checkbox" id="flexSwitchCheckDefault"@if(isset($subcategory_edit) && $subcategory_edit->getActive())checked @endif>

								<label class="form-check-label" for="flexSwitchCheckDefault">Statue</label>
							  </div>


                                    <button type="submit"id='submitData' class="d-block py-3 px-5 bg-primary text-white border-0 rounded font-weight-bold mt-3">Add</button>

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
@endsection

@section('scripts')
    @isset($subcategory_edit)
        <script>
            $(document).on('click','#submitData',function(e){
                e.preventDefault();
                var data=new FormData($('#allData')[0]);
                $('#translation_lang_er').text('');
                $('#image_er').text('');
                $('#name_er').text('');
                $('#category_id_er').text('');
                $('#the_price_er').text('');
                $('#description_er').text('');
                $.ajax({
                    type:'POST',
                    url:"{{route('edit_subcategory')}}",
                    data:data,
                    //'_token':'{{csrf_token()}}',
                    processData: false,
                    contentType: false,
                    cache: false,
                    success:function(data){
                        if(data.statue==true){
                            alert(data.msg);
                        }
                        alert(data.msg);
                    },
                    error:function(reject){
                        var response=$.parseJSON(reject.responseText);
                        $.each(response.errors,function(key,val){
                            $('#' + key + '_er').text(val[0]);
                        });
                    }
                });
            });
        </script>
        @else
        <script>
            $(document).on('click','#submitData',function(e){
                e.preventDefault();
                var data=new FormData($('#allData')[0]);
                $('#translation_lang_er').text('');
                $('#image_er').text('');
                $('#name_er').text('');
                $('#category_id_er').text('');
                $('#the_price_er').text('');
                $('#description_er').text('');
                $.ajax({
                    type:'POST',
                    url:"{{route('store_subcategory')}}",
                    data:data,
                    //'_token':'{{csrf_token()}}',
                    processData: false,
                    contentType: false,
                    cache: false,
                    success:function(data){
                        if(data.statue==true){
                            alert(data.msg);
                        }
                        alert(data.msg);
                    },
                    error:function(reject){
                        var response=$.parseJSON(reject.responseText);
                        $.each(response.errors,function(key,val){
                            $('#' + key + '_er').text(val[0]);
                        });
                    }
                });
            });
        </script>
        @endisset


@endsection

