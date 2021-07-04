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

                        @include('admin.modal')

                    </div>
                </div>

                {{-- forma --}}

                <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-0">
                    <!-- Recently Favorited -->
                    <div class="widget dashboard-container my-adslist">
                        @include('alarms.alarm')
                        <h3 class="widget-header">Add Branch</h3>
                        <form id="allData" action=""method='POST'enctype='multipart/form-data'>
                            @csrf
                            {{-- @if(isset($governorates) && $governorates->count() > 0)
                            <select name="governorate_id">

                                @foreach($governorates as $governorate)
                                    <option value="{{$governorate->id}}">{{$governorate->name}}</option>
                                @endforeach

                            </select>
                            @endif
                            <br><br> --}}

                            <label for="exampleFormControlInput1" class="form-label">Branch</label>
                            <input type="text" name='branch' class="form-control">
								<strong><h3><small type='hidden' id='branch_er'class='text text-danger'></small></h3></strong>
								<br>
                                <input type="hidden" name='translation_lang'value="{{locale_lang()}}">
                            <button id="submitData" type="submit" class="d-block py-3 px-5 bg-primary text-white border-0 rounded font-weight-bold mt-3">Add</button>
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


    @include('layouts.footer')
@endsection
@section('scripts')
    <script>
        $(document).on('click','#submitData',function(e){
            e.preventDefault();
            var data=new FormData($('#allData')[0]);
            $.ajax({
                url:"{{route('store_branch')}}",
                type:'POST',
                data:data,
                processData: false,
                contentType: false,
                cache: false,
                success :function(data){
                    if(data.status==true){
                        alert(data.msg);
                    }
                    alert(data.msg);

                },
                error:function(reject){

                }


            });
        });

             /////////////////////////
///////////////////delete Account/////////////////
        @include('accounts.delete_account');
    </script>
@endsection
