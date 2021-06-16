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
          <!-- User Widget -->
          @include('profiles.profile')
          <!-- Dashboard Links -->


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
        @include('alarms.alarm')
        <div class="widget dashboard-container my-adslist">
          <h3 class="widget-header">My Ads</h3>
          <table class="table table-responsive product-dashboard-table">
            <thead>
              <tr>
                <th class="text-center">Vendor Name</th>
                <th class="text-center">Main Category </th>
                <th class="text-center">Mail</th>
                <th class="text-center">Statue</th>
                <th class="text-center">phone Num </th>
                <th class="text-center">logo</th>
                <th class="text-center">Title</th>
                <th class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
              @if (isset($vendors))
                  @foreach ($vendors as $vendor)
                  <tr>


                    <td class="product">
                      <span class="location">{{$vendor->name}}</span>
                    </td>
                    @if (isset($vendor->mainCategory->category))
                    <td class="product">
                      <span class="location">{{$vendor->mainCategory->category}}</span>
                    </td>
                    @else
                    <td class="product">
                      <span class="location">{{'لا يوجد'}}</span>
                    </td>
                    @endif

                    <td class="product-category"><span class="categories">{{$vendor->email}}</span></td>
                    <td class="product-category"><span class="categories">{{$vendor->getAction()}}</span></td>
                    <td class="product-category"><span class="categories">{{$vendor->mobile}}</span></td>
  <td class="product-category"><span class="categories"><img height="30px" width='50px'src="{{asset('admin/images/vendors/'.$vendor->logo)}}"></span></td>
                    <td class="product-category"><span class="categories">{{$vendor->address}}</span></td>

                    <td class="action" data-title="Action">
                      <div class="">
                        <ul class="list-inline justify-content-center">
                          <li class="list-inline-item">
                            <a data-toggle="tooltip" data-placement="top" title="{{$vendor->action==1? 'Disactivate':'Activate'}}" class="view" href="{{route('change_statue_vendor',$vendor->id)}}">
                              <i class="fa fa-edit"></i>
                            </a>
                          </li>
                            <li class="list-inline-item">
                                <a class="edit" data-toggle="tooltip" data-placement="top" title="Edit" href="{{route('form_edit_vendor',$vendor->id)}}">
                                    <i class="fa fa-pencil"></i>
                                </a>
                            </li>
                          <li class="list-inline-item">
                            <a class="delete" data-toggle="tooltip" data-placement="top" title="Delete" href="{{route('delete_vendor',$vendor->id)}}">
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
							{{$vendors->links()}}
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

