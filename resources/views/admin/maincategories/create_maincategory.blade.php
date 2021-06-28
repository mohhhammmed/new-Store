@extends('layouts.html')
@section('content')

@endsection
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
							<strong>Add Main Category</strong>

						</div>
						<div class="col-md-6">
							<div class="view">
								<strong>Views</strong>
								<ul class="list-inline view-switcher">
									<li class="list-inline-item">
										<a href="#" onclick="event.preventDefault();" class="text-info"><i class="fa fa-th-large"></i></a>
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
									<h3 class="widget-header"></h3>
							  <form id="allData"  action="#"method='POST'enctype='multipart/form-data'>

								@csrf
                                  @if(isset($types_categories) && $types_categories->count() >0 )
                                      <label for="exampleFormControlInput1" class="form-lable">Type Main Categories</label>
                                      <select  style='border-radius:10px' name="type_id">

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
									<h2 class="alert alert-primary d-flex align-items-center">{{__('trans.Category by lang '.$lang->abbr)}}</h2>


									<input class="form-control form-control-lg"name='category[{{$count}}][category]' type="text" placeholder="Name" aria-label=".form-control-lg example">

                                          <small type="hidden"class="category{{$count}}"></small>
									<input class="form-control form-control-sm"value='{{$lang->abbr}}' type="hidden"name='category[{{$count}}][translation_lang]' placeholder="abbr" aria-label=".form-control-sm example">
                  <small type="hidden"id="translation_lang"></small>
                              <br>
                     <div style='margin-left:20px' class="form-check form-switch">

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
    <!-- Row End -->
  </div>
  <!-- Container End -->
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
                url:"{{route('store_maincategory')}}",
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
