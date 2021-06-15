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
                <!-- admin Widget -->
                @include('admin.profile')



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

          {{-- forma --}}

          <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-0">
            <!-- Recently Favorited -->
            <div class="widget dashboard-container my-adslist">
              @include('admin.messages.err_or_succ')
                <h3 class="widget-header">{{isset($data_vendor) ?'Update Vendor':'Add Vendor'}}</h3>
          <form enctype='multipart/form-data' action="{{isset($data_vendor)?route('vendor.update',$data_vendor->id):route('store.storeVendor')}}"method='POST'>
            @csrf
            @isset($data_vendor)
              <label for="exampleFormControlInput1" class="form-label">Logo Vendor</label><br>
              <img width="120px" height="auto" src="{{asset('store/images/vendors/'.$data_vendor->logo)}}"><br>
              @endisset
              <label for="exampleFormControlInput1" class="form-label">Choose Logo</label>

            <input type="file" name='logo' class="form-control"><br>
            @error('logo')
              <div class="alert alert-danger" role="alert">
                {{$message}}
              </div>
            @enderror

          <input class="form-control form-control-lg"name='name'value='{{isset($data_vendor) ?$data_vendor->name:''}}' type="text" placeholder="Name of Vendor" aria-label=".form-control-lg example"> <br>
          @error('name')
          <div class="alert alert-danger" role="alert">
            {{$message}}
          </div>
          @enderror
          <input class="form-control form-control-sm" type="text"name='email'value="{{isset($data_vendor) ?$data_vendor->email:''}}" placeholder="Email" aria-label=".form-control-sm example"><br>
          @error('email')
          <div class="alert alert-danger" role="alert">
            {{$message}}
          </div>
          @enderror
            <input  class="form-control form-control-sm" type="text"name='address'value="{{isset($data_vendor) ?$data_vendor->address:''}}" placeholder="Address" aria-label=".form-control-sm example"><br>
             @error('address')
            <div class="alert alert-danger" role="alert">
              {{$message}}
             </div>
           @enderror
          <div class="btn-group" role="group" aria-label="Basic radio toggle button group">

            <input class="form-control form-control-sm" type="text"name='mobile'value="{{isset($data_vendor) ?$data_vendor->mobile:''}}" placeholder="Mobile" aria-label=".form-control-sm example"><br>
            @error('mobile')
            <div class="alert alert-danger" role="alert">
              {{$message}}
            </div>
            @enderror


          </div>
          <select  class="form-select"name='category_id' aria-label="Default select example">

                  <option selected disabled >Main Categories</option>
            @foreach ($maincategory as $cat)
                  <option value="{{$cat->id}}"@isset($data_vendor) @if($data_vendor->category_id==$cat->id) selected @endif  @endisset>{{$cat->category}}</option>
            @endforeach

          </select>
          @error('category_id')
          <div class="alert alert-danger" role="alert">
            {{$message}}
          </div>
          @enderror

     @isset($data_vendor)  <input name='id'type='hidden'value='{{$data_vendor->id}}'>@endisset
          <br><br>
         @isset($data_vendor)
          <div class="form-check form-switch">
            <input class="form-check-input"name='action' value='1' type="checkbox" id="flexSwitchCheckChecked" @if($data_vendor->action==1) checked @endif>
            <label class="form-check-label" for="flexSwitchCheckChecked">Statue</label>
          </div>
          @else
          <div class="form-check form-switch">
            <input class="form-check-input"name='action' value='1' type="checkbox" id="flexSwitchCheckChecked"checked >
            <label class="form-check-label" for="flexSwitchCheckChecked">Statue</label>
          </div>
         @endisset

          <button type="submit" class="d-block py-3 px-5 bg-primary text-white border-0 rounded font-weight-bold mt-3">{{isset($data_vendor)? 'Update' :'Add'}}</button>
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
