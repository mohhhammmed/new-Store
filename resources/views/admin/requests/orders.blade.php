@extends('layouts.html')
@section('content')
    @include('layouts.section')
    <!--==================================
=            User Profile            =
===================================-->

 <div id="main" style='margin:-90px 0px 0px 0px'>
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

        <div class="page-heading">

            <section class="section">
                <div class="card">
                    <div class="card-header">
                       <span style='margin-left:600px;'>Our Orders</span>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped" id="table1">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th class='text text-center'>Email</th>
                                <th class='text text-center'>Product</th>
                                <th class='text text-center'>Phone</th>
                                <th class='text text-center'>Image</th>
                                <th class='text text-center'>Title</th>
                                <th class='text text-center'>Price</th>
                                <th class='text text-center'>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($orders) && !empty($orders))
                                @foreach($orders as $order)
                                    <tr>
                                        <td>{{$order->name}}</td>
                                        <td class="text-center">{{$order->email}}</td>
                                        <td class="text-center">{{$order->category}}</td>
                                        <td class="text-center">{{$order->mobile}}</td>
                                        <td class="product-thumb text-center">
                                            <img width="80px" height="auto"
                                                 src="{{asset(\App\Models\Subcategory::PathImage().$order->image)}}"
                                                 alt="image description"></td>
                                        <td class="text-center">{{$order->address}}</td>
                                        <td class="text-center">{{$order->the_price}}</td>
                                        <td class="action text-center" data-title="Action">
                                            <div class="">
                                                <ul class="list-inline justify-content-center">
                                                    <li class="list-inline-item">
                                                        <a data-toggle="tooltip" data-placement="top" title="trash" get_id="{{$order->id}}" class="delete delData" href="{{route('delete_orders',$order->id)}}">
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
                </div>

            </section>



   </div>
   </div>
    <!--============================
    =            Footer            =
    =============================-->

    @include('layouts.footer')

                @endsection





 @section('scripts')

    <script>
        $(document).on('click','.delData',function(e){
            e.preventDefault();
            var id=$(this).attr('get_id');
            $.ajax({
                type:'POST',
                url:"{{route('delete_orders')}}",
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
