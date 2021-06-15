@extends('admin.layouts.html')
@section('content')
    @include('admin.layouts.section')
    <section class="dashboard section">
        <!-- Container Start -->
        <div class="container">
          <!-- Row Start -->
          <div class="row">
            <div class="col-md-10 offset-md-1 col-lg-4 offset-lg-0">
              <div class="sidebar">
                <!-- User Widget -->
                <div class="widget user-dashboard-profile">
                  <!-- User Image -->
                  <div class="profile-thumb">
                    <img src="store/images/user/user-thumb.jpg" alt="" class="rounded-circle">
                  </div>
                  <!-- User Name -->
                  <h5 class="text-center">Samanta Doe</h5>
                  <p>Joined February 06, 2017</p>
                  <a href="user-profile.html" class="btn btn-main-sm">Edit Profile</a>
                </div>
                <!-- Dashboard Links -->
                <div class="widget user-dashboard-menu">
                  <ul>
                    <li class="active"><a href="dashboard-my-ads.html"><i class="fa fa-user"></i> My Ads</a></li>
                    <li><a href="dashboard-favourite-ads.html"><i class="fa fa-bookmark-o"></i> Favourite Ads <span>5</span></a></li>
                    <li><a href="dashboard-archived-ads.html"><i class="fa fa-file-archive-o"></i>Archived Ads <span>12</span></a></li>
                    <li><a href="dashboard-pending-ads.html"><i class="fa fa-bolt"></i> Pending Approval<span>23</span></a></li>
                    <li><a href="#"><i class="fa fa-cog"></i> Logout</a></li>
                    <li><a href="" data-toggle="modal" data-target="#deleteaccount"><i class="fa fa-power-off"></i>Delete
                        Account</a></li>
                  </ul>
                </div>

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

          {{-- forma --}}

          <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-0">
            <!-- Recently Favorited -->
            <div class="widget dashboard-container my-adslist">
              @include('admin.messages.err_or_succ')
                <h3 class="widget-header">{{isset($data_lang) ?'Update Lang':'Add Lang'}}</h3>
          <form action="{{isset($data_lang)?route('edit_lang',$data_lang->id):route('store_lang')}}"method='POST'>
            @csrf
          <input class="form-control form-control-lg"name='name'value='{{isset($data_lang) ?$data_lang->name:''}}' type="text" placeholder="Name" aria-label=".form-control-lg example"> <br>
          @error('name')
          <div class="alert alert-danger" role="alert">
            {{$message}}
          </div>
          @enderror
          <input class="form-control form-control-sm" type="text"name='abbr'value="{{isset($data_lang) ?$data_lang->abbr:''}}" placeholder="abbr" aria-label=".form-control-sm example"><br>
          @error('abbr')
          <div class="alert alert-danger" role="alert">
            {{$message}}
          </div>
          @enderror
          <select class="form-select"name='direction' aria-label="Default select example">
            @isset($data_lang)
            <option selected>Open this select menu</option>
            <option value="rtl"@if ($data_lang->direction=='rtl')  selected @endif>Rtl</option>
            <option value="ltr"@if ($data_lang->direction=='ltr')  selected @endif>Ltr</option>
            @else
            <option selected>Open this select menu</option>
            <option value="rtl">Rtl</option>
            <option value="ltr">Ltr</option>
            @endisset


          </select><br><br>
          <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
            @isset($data_lang)
            <input type="radio" class="btn-check" name="statue[]"value='1' id="btnradio1"autocomplete="off" @if($data_lang->action=='active') checked @endif   >
            <label class="btn btn-outline-primary" for="btnradio1">active</label>

            <input type="radio" class="btn-check" value='0' name="statue[]" id="btnradio2"autocomplete="off" @if($data_lang->action=='not active') checked @endif >
            <label class="btn btn-outline-primary" for="btnradio2">not active</label>

            @else

            <input type="radio" class="btn-check" name="statue[]"value='1' id="btnradio1"autocomplete="off" checked  >
            <label class="btn btn-outline-primary" for="btnradio1">active</label>

            <input type="radio" class="btn-check" value='0' name="statue[]" id="btnradio2"autocomplete="off" >
            <label class="btn btn-outline-primary" for="btnradio2">not active</label>

            @endisset

          </div>
          <button type="submit" class="d-block py-3 px-5 bg-primary text-white border-0 rounded font-weight-bold mt-3">Add</button>
          </form>
            </div>
          </div>
        </div>
        <!-- Row End -->
      </div>
      <!-- Container End -->
    </section>
    <!--================
    @include('admin.layouts.footer')
@endsection