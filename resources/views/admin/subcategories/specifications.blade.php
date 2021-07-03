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


                                <th class='text text-center'>Subcategories</th>
                                <th class='text text-center'>Specifications</th>

                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($subcategory_specifications) && !empty($subcategory_specifications))

                                    <tr row='6'>
                                        <td class="text-center">
                                       <a href="{{route('form_edit_subcategory',$subcategory_specifications->id)}}"> {{$subcategory_specifications->name}}</a>
                                        </td>
                                        <td class='text text-center'>{{$subcategory_specifications->specification->specification}}</td>

                                    </tr>
                                    @else

                                    <tr row='6'>
                                        <td class="text-center">
                                       <a href="{{route('form_edit_subcategory',$sub_has_reviews->id)}}"> {{$sub_has_reviews->name}}</a>
                                        </td>
                                        @if(count($sub_has_reviews->reviews) > 0)

                                        <td class='text text-center'>
                                            @foreach ($sub_has_reviews->reviews as $review)
                                              {{$review->opinion}}
                                            @endforeach
                                        </td>

                                        @endif
                                    </tr>

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
