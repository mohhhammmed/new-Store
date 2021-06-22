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
                        @if(isset($orders) && !empty($orders))
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{$order->name}}</td>
                                    <td class="text-center">{{$order->email}}</td>
                                    <td class="text-center">{{$order->category}}</td>
                                    <td class="product-thumb text-center">
                                        <img width="80px" height="auto" src="{{asset(\App\Models\CategoryOfSeller::PathImage().$order->image)}}" alt="image description"></td>
                                    <td class="text-center">{{$order->mobile}}</td>
                                    <td class="product-details text-center">

                                        {{$order->description}}
                                    </td>
                                    <td class="text-center">{{$order->address}}</td>
                                    <td class="text-center">{{$order->the_price}}</td>
                                    <td class="text-center">{{$order->condition}}</td>
                                    <td class="product-category"><span class="categories">Laptops</span></td>
                                    <td class="action text-center" data-title="Action">
                                        <div class="">
                                            <ul class="list-inline justify-content-center">
                                                <li class="list-inline-item">
                                                    <a data-toggle="tooltip" data-placement="top" title="Edit" class="edit" href="">
                                                        <i class="fa fa-clipboard"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a data-toggle="tooltip" data-placement="top" title="trash" get_id="{{$order->id}}" class="delete delData" href="{{route('delete_order',$order->id)}}">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            @else
                            @endif

						</tbody>
					</table>

				</div>

				<!-- pagination -->
				<div class="pagination justify-content-center">
					<nav aria-label="Page navigation example">
						<ul class="pagination">

                            {{$orders->links()}}


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
                url:"{{route('delete_order')}}",
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
