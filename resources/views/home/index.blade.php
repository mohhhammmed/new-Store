@extends('layouts.html')
@section('content')
   @include('layouts.section')
    <section class="hero-area bg-1 text-center overly">
        <!-- Container Start -->
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Header Contetnt -->
                    <div class="content-block">
                        <h1>{{__('trans.Buy & Sell Near You')}}</h1>
                        <p>{{__('trans.Join the millions who buy and sell from each other')}}<br>{{__('trans.everyday in local communities around the world')}}</p>
                        <div class="short-popular-category-list text-center">
                            <h2>{{__('trans.Popular Category')}}</h2>
                            <ul class="list-inline">
                                   @if(isset($maincategories))

                                    @foreach($maincategories as $count=>$category)
                                        @if($count>=0 && $count <5)

                                        <li class="list-inline-item">
                                            <a href="{{route('all_categories',$category->id)}}"><i class="fa fa-{{__('trans.'.$category->category)}}"></i>{{$category->category}}</a>
                                        </li>
                                      @endif
                                    @endforeach
                                       @endif
                            </ul>
                        </div>

                    </div>
                    <!-- Advance Search -->
                    <div class="advance-search">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-12 col-md-12 align-content-center">
                                    @include('alarms.alarm')
                                    <form action="{{route('search_categories')}}" method="POST">
                                        @csrf
                                        <div class="form-row">


                                            <div class="form-group col-md-9">
                                                <input type="text" name="category" class="form-control my-2 my-lg-1" id="inputLocation4" placeholder="{{__('trans.category by lang '. app()->getLocale())}}">
                                            </div>
                                            <div style="margin-left: 50px" class="form-group col-md-2 align-self-end">
                                                <button type="submit" class="btn btn-primary">Search Now</button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- Container End -->
    </section>

    <!--===========================================
    =            Popular deals section            =
    ============================================-->

    <section class="popular-deals section bg-gray">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title">
                        <h2>{{__('trans.Trending Adds')}}</h2>
                        <p>{{__('trans.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas, magnam')}}.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- offer 01 -->
                <div class="col-lg-12">
                    <div class="trending-ads-slide">

                        @if(isset($subcategories))
                            @foreach($subcategories as $count => $subcategory)
                                @if($count >=0 && $count <= 10)
                                <div class="col-sm-12 col-lg-4">
                                    <!-- product card -->
                                    <div class="product-item bg-light">
                                        <div class="card">
                                            <div class="thumb-content">
                                                <!-- <div class="price">$200</div> -->
                                                <a href="{{route('description_category',$subcategory->id)}}">
                                                    <img class="card-img-top img-fluid" src="{{asset('admin/images/subcategories/'.$subcategory->image)}}" alt="Card image cap">
                                                </a>
                                            </div>
                                            <div class="card-body">
                                                <h4 class="card-title"><a href="{{route('description_category',$subcategory->id)}}">{{$subcategory->name}}</a></h4>
                                                <ul class="list-inline product-meta">
                                                    <li class="list-inline-item">
                                                        <a href="{{isset($subcategory->maincategory->type->type)?'#'.$subcategory->maincategory->type->type:''}}"><i class="fa fa-folder-open-o"></i>{{isset($subcategory->maincategory->type->type)?__('trans.'.$subcategory->maincategory->type->type) : '' }}</a>

                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a href="#"><i class="fa fa-calendar"></i>26th December</a>
                                                    </li>
                                                </ul>
                                                <p class="card-text">{{isset($subcategory->description->description)? $subcategory->description->description :''}}</p>
                                                <div class="product-ratings">
                                                    <ul class="list-inline">
                                                        <li>{{$subcategory->the_price}}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            @endforeach
                            @endif
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!--==========================================
    =            All Category Section            =
    ===========================================-->

    <section class=" section">
        <!-- Container Start -->
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Section title -->
                    <div class="section-title">
                        <h2>All Categories</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis, provident!</p>
                    </div>
                    <div class="row">
                        <!-- Category list -->
                        @if(isset($main_categories_byType))
                        @foreach($main_categories_byType as $type)

                            <div id="{{$type->type}}" class="col-lg-3 offset-lg-0 col-md-5 offset-md-1 col-sm-6 col-6">

                                <div class="category-block">
                                    <div class="header">
                                        <i class="fa fa-laptop icon-bg-1"></i>

                                        <h4>{{$type->type}}</h4>
                                    </div>
                                    <ul class="category-list" >

                                        @foreach($type->maincategories as $main_category)

                                        <li><a href="{{route('all_categories',$main_category->id)}}">{{$main_category->category}} <span>{{$main_category->subcategories->count()}}</span></a></li>

                                        @endforeach
                                    </ul>

                                </div>

                            </div>

                            @endforeach
                        @endif


                    </div>
                </div>
            </div>
        </div>
        <!-- Container End -->
    </section>
    <!--============================
    =            Footer            =
    =============================-->

   @include('layouts.footer')
    @endsection
