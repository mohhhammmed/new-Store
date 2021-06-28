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

          {{-- forma --}}

          <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-0">
            <!-- Recently Favorited -->
            <div class="widget dashboard-container my-adslist">
              @include('alarms.alarm')
                <h3 class="widget-header">{{isset($data_lang) ?'Update Lang':'Add Lang'}}</h3>
          <form id="allData" action="{{isset($data_lang)?'':route('store_lang')}}"method='POST'>
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
            <option disapled>Choose Direction</option>
            <option value="rtl"@if ($data_lang->direction=='rtl')  selected @endif>Rtl</option>
            <option value="ltr"@if ($data_lang->direction=='ltr')  selected @endif>Ltr</option>
            @else
            
            <option disapled>Choose Direction</option>
            <option value="rtl">Rtl</option>
            <option value="ltr">Ltr</option>
            @endisset

         @isset($data_lang)
             <input type="hidden"name="id" value="{{$data_lang->id}}">
                @endisset
          </select><br><br>


          <div class="form-check">
            @isset($data_lang)
          <input class="form-check-input"name='statue' value='1' type="radio" value="" id="flexCheckDefault" @if($data_lang->getStatue()=='active') checked @endif>
          <label class="form-check-label" for="flexCheckDefault">Active</label>


          <input style='margin-left:5px' class="form-check-input"name='statue' value='0' type="radio" value="" id="flexCheckChecked" @if($data_lang->getStatue()=='not active') checked @endif>
          <label  style='margin-left:27px' class="form-check-label" for="flexCheckChecked">Not Active</label>


            @else

          <input class="form-check-input"name='statue' value='1' type="radio" value="" id="flexCheckDefault">
          <label class="form-check-label" for="flexCheckDefault">Active</label>


          <input style='margin-left:5px' class="form-check-input"name='statue' value='0' type="radio" value="" id="flexCheckChecked" checked>
          <label  style='margin-left:27px' class="form-check-label" for="flexCheckChecked">Not Active</label>
           
            @endisset

          </div>
       

          <button type="submit" id='submitData' class="d-block py-3 px-5 bg-primary text-white border-0 rounded font-weight-bold mt-3">Add</button>
          </form>
            </div>
          </div>
        </div>
        <!-- Row End -->
      </div>
      <!-- Container End -->
    </section>
    <!--======== Footer ========-->
    @include('layouts.footer')
@endsection

@section('scripts')

    @if(isset($data_lang))
        <script>
            $(document).on('click','#submitData',function(e){
                e.preventDefault();
                var data = new FormData($('#allData')[0]);
                $.ajax({
                    type:'POST',
                    url:"{{route('edit_lang')}}",
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
    @else
        <script>
            $(document).on('click','#submitData',function(e){
                e.preventDefault();
                var data = new FormData($('#allData')[0]);
                $.ajax({
                    type:'POST',
                    url:"{{route('store_lang')}}",
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
    @endif

@endsection
