@extends('layouts.html')
@section('content')

@include('layouts.section')

<section class="dashboard section">
  <!-- Container Start -->
  <div class="container">
    <!-- Row Start -->
    <div class="row">
      <div class="col-md-10 offset-md-1 col-lg-4 offset-lg-0">
        <div class="sidebar">
          <!-- admin Widget -->
           @include('profiles.profile')



          <!-- delete-account modal -->
          						  <!-- delete account popup modal start-->
                <!-- Modal -->
                <div class="modal fade" id="deleteaccount" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                  aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header border-bottom-0">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body text-center">
                        <img src="{{asset('admin/images/account/Account1.png')}}" class="img-fluid mb-2" alt="">
                        <h6 class="py-2">Are you sure you want to delete your account?</h6>
                        <p>Do you really want to delete these records? This process cannot be undone.</p>
                        <textarea name="message" id="" cols="40" rows="4" class="w-100 rounded"></textarea>
                      </div>
                      <div class="modal-footer border-top-0 mb-3 mx-5 justify-content-lg-between justify-content-center">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger">Delete</button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- delete account popup modal end-->
          <!-- delete-account modal -->

        </div>
      </div>


	  <div class="col-md-12 offset-md-1 col-lg-8 offset-lg-0">
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
										<a href="" onclick="event.preventDefault();" class="text-info"><i class="fa fa-th-large"></i></a>
									</li>
									
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="product-grid-list">
					<div class="row mt-30">

							<!-- product card -->
							<div class="col-md-10 offset-md-4 col-lg-12 offset-lg-0">
								<!-- Recently Favorited -->
								<div class="widget dashboard-container my-adslist">
								  @include('alarms.alarm')
									<h3 class="widget-header">Add Category</h3>
						 <form id='allData'  action="{{route('store_subcategory')}}"method='POST'enctype='multipart/form-data'>
								@csrf

								<label for="exampleFormControlInput1" class="form-label">Main Category</label>
								<select  name='maincategory_id'>
									@if(isset($maincategories) && $maincategories->count() > 0)
									@foreach ($maincategories as $maincategory)
									<option value="{{$maincategory->id}}" @if(isset($subcategory_edit) && $subcategory_edit->maincategory_id == $maincategory->id) selected @endif>{{$maincategory->category}}</option>
									@endforeach
									@endif
								</select>
								<h3><small type='hidden' id='maincategory_id_er'class='text text-danger'></small></h3>
									<br>

									<label for="exampleFormControlInput1" class="form-label">Main Category Type</label>
                                  <select  name='parent_id'>
                                      @if(isset($parentSubCat) && $parentSubCat->count() > 0)
                                          @foreach ($parentSubCat as $parent)
                                              <option value="{{$parent->id}}" @if(isset($subcategory_edit) && $subcategory_edit->parent_id == $parent->id) selected @endif>{{$parent->type}}</option>
                                          @endforeach
                                      @endif

                                  </select>
                                  <h3><small type='hidden' id='parent_id_er'class='text text-danger'></small></h3>
                                 

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
    <!-- Row End -->
  </div>
  <!-- Container End -->
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

