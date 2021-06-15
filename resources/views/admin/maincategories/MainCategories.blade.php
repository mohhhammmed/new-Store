@extends('layouts.html')
@section('content')
@include('layouts.section')
<!--==================================
=            User Profile            =
===================================-->
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


      <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-0">
        <!-- Recently Favorited -->
        <div class="widget dashboard-container my-adslist">

          <h3  class="widget-header">My Ads {{' '}} <a style="margin-left: 10px" href='{{route('admin_create_maincategories')}}'class="btn-sm btn btn-outline-info btn-small"><strong>Add Main Category</strong> </a> </h3>


          @include('messages.err_or_succ')
          <table class="table table-responsive product-dashboard-table">
            <thead>
              <tr>
                <th>Image</th>
                <th>lang</th>
                <th class="text-center">Category</th>
                <th class="text-center">Statue</th>
                <th class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
              @if (isset($maincategories))
						  @foreach ($maincategories as $maincategory)
              <tr>

                <td class="product-thumb">
                  <img width="80px" height="auto" src="{{asset('admin/images/maincategories/'.$maincategory->image)}}" alt="image description"></td>

                <td class="translation_lang">
                  {{$maincategory->translation_lang}}
                </td>
                <td class="product-category"><span class="categories"> {{$maincategory->category}}</span></td>
                <td class="product-category"><span class="categories"> {{$maincategory->getAction()}}</span></td>
                <td class="action" data-title="Action">
                  <div class="">
                    <ul class="list-inline justify-content-center">
                      <li class="list-inline-item">
                        <a data-toggle="tooltip" data-placement="top" title="{{$maincategory->action==1? 'Disactivate':'Activate'}}" class="view" href="{{route('maincategory_activate',$maincategory->id)}}">
                          <i class="fa fa-edit"></i>
                        </a>
                      </li>
                      <li class="list-inline-item">
                        <a class="edit" data-toggle="tooltip" data-placement="top" title="Edit" href="{{route('form_edit_maincategory',$maincategory->id)}}">
                          <i class="fa fa-pencil"></i>
                        </a>
                      </li>
                      <li class="list-inline-item">
                        <a class="delete delData" data-toggle="tooltip"get_id="{{$maincategory->id}}" data-placement="top" title="Delete" href="{{route('maincategory_delete',$maincategory->id)}}">
                          <i class="fa fa-trash"></i>
                        </a>
                      </li>
                    </ul>
                  </div>
                </td>
              </tr>
              @endforeach
              @endif

            </tbody>
          </table>

        </div>

        <!-- pagination -->
        <div class="pagination justify-content-center">
					<nav aria-label="Page navigation example">
						<ul class="pagination">
							<li class="page-item">
								<a class="page-link" href="#" aria-label="Previous">
									<span aria-hidden="true">&laquo;</span>
									<span class="sr-only">Previous</span>
								</a>
							</li>
                          {{$maincategories->links()}}
								<a class="page-link" href="#" aria-label="Next">
									<span aria-hidden="true">&raquo;</span>
									<span class="sr-only">Next</span>
								</a>
							</li>
						</ul>
					</nav>
				</div>
        <!-- pagination -->

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

<style>
    .w-5{
        display: none;
    }
</style>
@section('scripts')
    <script>
        $(document).on('click','.delData',function(e){
            e.preventDefault();
            var id=$(this).attr('get_id');
            $.ajax({
                type:'POST',
              url:"{{route('maincategory_delete')}}",
              data:{
                'id':id,
                  '_token':"{{csrf_token()}}",
                   },

                success:function(data){
                if(data.statue==true) {
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
