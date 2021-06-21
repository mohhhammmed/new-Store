@extends('layouts.html')
@section('content')

@include('layouts.section')

<!-- page title -->
<!--================================
=            Page Title            =
=================================-->
<section class="page-title">
    <!-- Container Start -->
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2 text-center">
                <!-- Title text -->
                <h3>Contact Us</h3>
            </div>
        </div>
    </div>
    <!-- Container End -->
</section>
<!-- page title -->

<!-- contact us start-->
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="contact-us-content p-4">
                    <h5>Contact Us</h5>
                    <h1 class="pt-3">Hello, what's on your mind?</h1>
                    <p class="pt-3 pb-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla elit dolor, blandit vel euismod ac, lentesque et dolor. Ut id tempus ipsum.</p>
                </div>
            </div>
            <div class="col-md-6">
                    <form id="allData" action="" method="post">
                        @csrf
                        <fieldset class="p-4">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6 py-2">
                                        <input type="text"name="name" placeholder="Name" class="form-control" >
                                    </div>
                                    <small type="hidden" id="name" class="text text-danger"></small>
                                    <div class="col-lg-6 py-2">
                                        <input type="text"name="email" placeholder="Your Email" class="form-control" >
                                    </div>
                                    <small type="hidden" id="email" class="text text-danger"></small>
                                </div>
                                <div >
                                    <input type="text"name="mobile" placeholder="Mobile" class="form-control w-100" >
                                </div>
                                <small type="hidden" id="mobile" class="text text-danger" ></small>
                            </div>

                            <div >
                                <label><strong>Your Category</strong></label>
                                <input type="text"value="{{$subcategory->name}}"name="category" placeholder="Category Name" class="form-control w-100" required>
                            </div>
                            <small type="hidden" id="category" class="text text-danger"></small>

                            <div >
                                <label><strong>Your Category</strong></label>
                                <input type="hidden"value="{{$subcategory->id}}"name="id">
                            </div>

                            <div class="btn-grounp">
                                <button type="submit" id="submitData" class="btn btn-primary mt-2 float-right">SUBMIT</button>
                            </div>
                        </fieldset>
                    </form>
            </div>
        </div>
    </div>
</section>
<!-- contact us end -->

<!--============================
=            Footer            =
=============================-->
@include('layouts.footer')
@endsection

        @section('scripts')
            <script>
                $(document).on('click','#submitData',function(e){
                    e.preventDefault();
                    var data=new FormData($('#allData')[0]);
                    $('#email').text('');
                    $('#name').text('');
                    $('#mobile').text('');
                    $('#category').text('');

                   // return data;
                   //  $.ajaxSetup({
                   //      headers: {
                   //          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   //      }
                   //  });
                    $.ajax({
                        type:'post',
                        url:"{{route('make_order')}}",
                        data:data,
                        processData: false,
                        contentType: false,
                        cache: false,
                        '_token':'{{csrf_token()}}',
                        success:function(data){
                            if(data.statue==true){
                                alert(data.msg);
                            }
                            alert(data.msg);
                        },
                        error:function(reject){
                            var response=$.parseJSON(reject.responseText);
                            $.each(response.errors,function(key,val){

                               $('#' + key).text(val[0]);

                            });

                        }
                    });
                });
            </script>
         @endsection
