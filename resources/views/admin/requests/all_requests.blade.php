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
      <div  class="col-md-12 offset-md-1 col-lg-12 offset-lg-0">
				<!-- Recently Favorited -->
				<div class="widget dashboard-container my-adslist">
					<h3 class="widget-header">My Ads</h3>
					<table  class="table table-responsive product-dashboard-table">
						<thead>
							<tr>

                                <th >seller</th>
                                <th class="text-center">email</th>
                                <th class="text-center">category</th>
                                <th class="text-center">Image</th>
                                <th class="text-center">mobile</th>
                                <th class="text-center">Product Description</th>
                                <th class="text-center">Address</th>
                                <th class="text-center">price</th>
                                <th class="text-center">condition</th>
								<th class="text-center">Action</th>
							</tr>
						</thead>
						<tbody>
                        @if(isset($requests) && !empty($requests))
                            @foreach($requests as $request)
                                <tr>
                                    <td>{{$request->name}}</td>
                                    <td class="text-center">{{$request->email}}</td>
                                    <td class="text-center">{{$request->category}}</td>
                                    <td class="product-thumb text-center">
                                        <img width="80px" height="auto" src="{{asset(\App\Models\CategoryOfSeller::PathImage().$request->image)}}" alt="image description"></td>
                                    <td class="text-center">{{$request->mobile}}</td>
                                    <td class="product-details text-center">

                                        {{$request->description}}
                                    </td>
                                    <td class="text-center">{{$request->address}}</td>
                                    <td class="text-center">{{$request->the_price}}</td>
                                    <td class="text-center">{{$request->condition}}</td>
{{--                                    <td class="product-category"><span class="categories">Laptops</span></td>--}}
                                    <td class="action text-center" data-title="Action">
                                        <div class="">
                                            <ul class="list-inline justify-content-center">
                                                <li class="list-inline-item">
                                                    <a data-toggle="tooltip" data-placement="top" title="Edit" class="edit" href="">
                                                        <i class="fa fa-clipboard"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a data-toggle="tooltip" data-placement="top" title="trash" get_id="{{$request->id}}" class="delete delData" href="{{route('delete_request',$request->id)}}">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            @endif

						</tbody>
					</table>

				</div>

				<!-- pagination -->
				<div class="pagination justify-content-center">
					<nav aria-label="Page navigation example">
						<ul class="pagination">

                            {{$requests->links()}}


						</ul>
					</nav>
				</div>
				<!-- pagination -->


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

<style>
    .w-5{
        display: none;
    }


</style>
@section('scripts')

    <script>
        $(document).on('click','.delData',function(e){
            e.preventDefault();
            var id=$(this).attr('get_id');
            $.ajax({
                type:'POST',
                url:"{{route('delete_request')}}",
                data:{
                    'id':id,
                    '_token':"{{csrf_token()}}",
                },

                success:function(data){
                    if(data.statue==true) {
                        alert(data.msg);
                    }
                    alert(data.msg);
                },
                error:function(reject){

                }

            });
        });
    </script>
@endsection
