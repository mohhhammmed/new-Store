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

<div id='app'>
	  <div id="main" style='margin:-610px 0px 0px 360px'>
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

        <div class="page-heading">
      
            <section class="section">
                <div class="card">
                    <div class="card-header">
                       Our Categories
                    </div>
                    <div class="card-body">
                        <table class="table table-striped" id="table1">
                            <thead>
                            <tr>
                               
                                <th >Type</th>
                                <th class='text text-center'>Main Categories</th>
                               <!-- // <th class='text text-center'>Action</th> -->
                               
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($type_categories) && !empty($type_categories))
                                @foreach($type_categories as $type)
                                    <tr row='6'>
                                        <td>{{$type->type}}</td>
                                       
                                        <td class="text-center">
                                        @foreach($type->maincategories  as $c=> $maincategory)
                                       <a href="{{route('form_edit_maincategory',$maincategory->id)}}"> {{$maincategory->category}}</a> -
                                       @if($c % 4 == 0 && $c != 0)<br> @endif
                                        @endforeach
                                        </td>
                                       
<!--                                       
                                        <td class="action text-center" data-title="Action">
                                            <div class="">
                                                <ul class="list-inline justify-content-center">
                                                    <li class="list-inline-item">
                                                        <a data-toggle="tooltip" data-placement="top" title="Edit" class="edit" href="">
                                                            <i class="fa fa-clipboard"></i>
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a data-toggle="tooltip" data-placement="top" title="trash" get_id="" class="delete delData" href="">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td> -->
                                    </tr>
                                @endforeach
                            @else
                            @endif

                            </tbody>
                        </table>

                    </div>
                </div>

            </section>

      

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

