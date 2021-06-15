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
                                        <img src="store/images/account/Account1.png" class="img-fluid mb-2" alt="">
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

                    <div class="row">
                        <div class="col-lg-12 col-md-6">
                            <div class="widget personal-info">
                                @include('messages.err_or_succ')

                                <h3 class="widget-header user">Edit Information</h3>
                                <form action="{{route('admin.edit_profile',Auth::guard('admin')->id())}}"method='post' enctype='multipart/form-data'>
                                     @csrf
                                    <!-- Name -->
                                    <div class="form-group">
                                        <label for="first-name">Edit Name</label>
                                        <input type="text"name='name' value="{{$admin->name}}" class="form-control" id="first-name">
                                    </div>
                                    @error('name')
                                    <div class="text text-success">{{$message}}</div>
                                    @enderror

                                     <!--New Email -->

                                    <div class="form-group">
                                        <label for="current-email">Edit Email</label>
                                        <input type="email" value="{{$admin->email}}" name='email' class="form-control" id="current-email">
                                    </div>

                                         <!-- Id -->
                                         <input type="hidden"name="id"value="{{$admin->id}}">

                                         <!-- Password -->

                                    <div class="form-group">
                                        <label for="new-password">New Password</label>
                                        <input type="password"name='password'class="form-control" id="new-password">
                                    </div>
                                    @error('password')
                                    <div class="text text-success">{{$message}}</div>
                                    @enderror
                                <!-- Confirm New Password -->
                                    <div class="form-group">
                                        <label for="confirm-password">Confirm New Password</label>
                                        <input type="password"name='confirmation_password' class="form-control" id="confirm-password">
                                    </div>
                                    @error('confirmation_password')
                                    <div class="text text-success">{{$message}}</div>
                                    @enderror

                                     <!-- Image -->

                                    <div class="form-group choose-file d-inline-flex">
                                        <i class="fa fa-user text-center px-3"></i>
                                        <input type="file"name='image' class="form-control-file mt-2 pt-1" id="input-file">
                                    </div>
                                    @error('image')
                                    <div class="text text-success">{{$message}}</div>
                                    @enderror
                                    <button class="btn btn-transparent">Update</button>
                                </form>
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

