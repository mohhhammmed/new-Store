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
                                <th >Subcategories</th>
                                <th class='text text-center'>Images</th>

                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($subcategory_images) && !empty($subcategory_images))

                                    <tr >
                                        <td >
                                       <a href="{{route('form_edit_subcategory',$subcategory_images->id)}}"> {{$subcategory_images->name}}</a>
                                        </td>
                                            <td class="text text-center">
                                                @if (isset($subcategory_images->images) && $subcategory_images->images->count() >0)
                                                   @foreach($subcategory_images->images as $counter=> $image)
                                                            @if ($counter %5 == 0)
                                                                <br>
                                                            @endif
                                                      <img src="{{asset(App\Models\Subcategory::PathImage() . $image->image)}}" width="80px" height="70px">
                                                @endforeach
                                                @endif
                                            </td>
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
    </div><!-- Row End -->
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
