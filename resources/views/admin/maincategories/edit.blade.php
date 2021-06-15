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

          {{-- forma --}}

          <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-0">
            <!-- Recently Favorited -->
            <div class="widget dashboard-container my-adslist">
              @include('messages.err_or_succ')
                <h3 class="widget-header">Edit Category</h3>
          <form action="{{route('edit_maincategory',$data_category->id)}}"method='POST'enctype='multipart/form-data'>
            @csrf
                 <input type='hidden' name="id"value='{{$data_category->id}}'>
            {{-- photo --}}
            <label for="exampleFormControlInput1" class="form-label">Image Category</label><br>
            <img width="120px" height="auto" src="{{asset('admin/images/maincategories/'.$data_category->image)}}"><br>

            <label for="exampleFormControlInput1" class="form-label"></label><br>
            <input type="file" name='image' class="form-control"><br>
            @error('image')
              <div class="alert alert-danger" role="alert">
                {{$message}}
              </div>
            @enderror
          <input class="form-control form-control-sm" type="text"name='category[0][category]'value="{{$data_category->category}}" placeholder="The Category" aria-label=".form-control-sm example"><br>
          @error('category.0.category')
          <div class="alert alert-danger" role="alert">
            {{$message}}
          </div>
          @enderror
                 <select name="category[0][translation_lang]">
                    @foreach($langs as $lang)
                         <option @if($lang->abbr==$data_category->translation_lang) selected @endif>{{$lang->abbr}}</option>
                      @endforeach

{{--          <input class="form-control form-control-lg"name='category[0][translation_lang]' type="text" placeholder="The Lang" aria-label=".form-control-lg example"> <br>--}}
                 </select>
        @error('category.0.translation_lang')
        <div class="alert alert-danger" role="alert">
          {{$message}}
        </div>
        @enderror
          <div class="form-check form-switch">

            <input class="form-check-input" name="category[0][action]"value='1'
             type="checkbox" id="flexSwitchCheckDefault"@if($data_category->action==1) checked @endif >

            <label class="form-check-label" for="flexSwitchCheckDefault">Statue</label>
          </div>


          <button type="submit" class="d-block py-3 px-5 bg-primary text-white border-0 rounded font-weight-bold mt-3">Update</button>
          </form>

            </div>


<ul class="nav nav-tabs">
  @isset($data_category->transes)

  @foreach ($data_category->transes as $c=> $trans)



        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#home{{$trans->id}}">{{$trans->translation_lang}}</a>
        </li>

  @endforeach
  @endisset
</ul>

<div class="tab-content">
  @foreach ($data_category->transes as $c=> $trans)

  <div class="tab-pane container active" id="home{{$trans->id}}">
    <div class="widget dashboard-container my-adslist">
      @include('messages.err_or_succ')
        <h3 class="widget-header">Edit Category</h3>

    <form action="{{route('edit_maincategory',$trans->id)}}"method='POST'enctype='multipart/form-data'>
      @csrf
      <input type='hidden' name="id"value='{{$trans->id}}'>
       {{-- photo --}}
       <label for="exampleFormControlInput1" class="form-label">Image Category</label>
            <img width="120px" height="auto" src="{{asset('admin/images/maincategories/'.$trans->image)}}"><br>


            <input type="file" name='image' class="form-control">
            @error('image')
              <div class="alert alert-danger" role="alert">
                {{$message}}
              </div>
            @enderror
            <br>
        <select name="category[0][translation_lang]">
            @foreach($langs as $lang)
                <option @if($lang->abbr==$trans->translation_lang) selected @endif>{{$lang->abbr}}</option>
            @endforeach


        </select> <br>
    @error('category.0.translation_lang')
    <div class="alert alert-danger" role="alert">
      {{$message}}
    </div>
    @enderror
    <input class="form-control form-control-sm" type="text"
    name='category[0][category]'value="{{$trans->category}}" placeholder="abbr" aria-label=".form-control-sm example">
    @error('category.0.category')
    <div class="alert alert-danger" role="alert">
      {{$message}}
    </div>
    @enderror
    <div class="form-check form-switch">

      <input class="form-check-input" name="category[0][action]"value='1'
       type="checkbox" id="flexSwitchCheckDefault"@if($trans->action==1) checked @endif >

      <label class="form-check-label" for="flexSwitchCheckDefault">Statue</label>
    </div>


    <button type="submit" class="d-block py-3 px-5 bg-primary text-white border-0 rounded font-weight-bold mt-3">Update</button>
    </form>
  </div>
  </div>
  @endforeach



  </div>

                        </div>
                      </div>
          </div>

                </div>
        <!-- Row End -->
      </div>
      <!-- Container End -->
    </section>

    <!--================
    @include('layouts.footer')
@endsection
