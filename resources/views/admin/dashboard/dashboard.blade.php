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
                @include('admin.modal')
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
                                <th class='text text-center'>Subcategories</th>
                               <!-- // <th class='text text-center'>Action</th> -->
                               
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($type_categories) && !empty($type_categories))
                                @foreach($type_categories as $type)
                                    <tr row='6'>
                                        <td>{{$type->type}}</td>
                                       
                                        <td class="text-center">
                                        @foreach($type->maincategories  as $maincategory)
                                        @foreach($maincategory->subcategories  as $c=> $subcategory)
                                       <a href="{{route('form_edit_subcategory',$subcategory->id)}}"> {{$subcategory->name}}</a> -
                                       @if($c % 3 == 0 && $c != 0 && $c !=3|| $c == 2)<br> @endif
                                       @endforeach
                                        @endforeach
                                        </td>
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

@section('scripts')
<script>
  @include('accounts.delete_account');  
</script>

@endsection