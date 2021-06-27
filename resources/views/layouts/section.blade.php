


<section>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<nav class="navbar navbar-expand-lg navbar-light navigation">
					<a class="navbar-brand" href="index.html">
						<img src="{{asset('admin/images/logo.png')}}" alt="">
					</a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
					 aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					@if(auth()->guard('admin')->user()  || auth()->user())
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="navbar-nav ml-auto main-nav ">
                        @if(Auth::guard('web')->user())
							<li class="nav-item active">
								<a class="nav-link" href="{{route('home')}}">Home</a>
							</li>
                          @else 
                          <li class="nav-item active">
								<a class="nav-link" href="{{route('dashboard')}}">Dashboard</a>
							</li>
                          @endif

									@if(Auth::guard('admin')->user())
                                <li class="nav-item dropdown dropdown-slide">
                                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="">Main Categories<span><i class="fa fa-angle-down"></i></span>
                                    </a>
                                    <!-- Dropdown list -->
                                    <div class="dropdown-menu">

                                        <a class="dropdown-item" href="{{route('all_maincategories')}}">Main Categories</a>
                                        <a class="dropdown-item" href="{{route('create_maincategory')}}">Add Main Categories</a>
                                   </div>
                            </li>
                                <li class="nav-item dropdown dropdown-slide">
                                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="">Sub Categories<span><i class="fa fa-angle-down"></i></span>
                                    </a>
                                    <!-- Dropdown list -->
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{route('create_parent')}}">Add parent of subcategories</a>
                                        <a class="dropdown-item" href="{{route('all_subcategories')}}">Subcategories</a>
                                        <a class="dropdown-item" href="{{route('create_subcategory')}}">Add Subcategories</a>
                                        <a class="dropdown-item" href="{{route('add_images_subcategory')}}">Add Images For Subategory</a>
                                    </div>
                                </li>
                                <li class="nav-item dropdown dropdown-slide">
                                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="">Vendors<span><i class="fa fa-angle-down"></i></span>
                                    </a>

                                    <!-- Dropdown list -->
                                    <div class="dropdown-menu">

                                        <a class="dropdown-item" href="{{route('all_vendors')}}">All Vendors</a>
                                        <a class="dropdown-item" href="{{route('create_vendor')}}">Add Vendor</a>

                                    </div>
                                </li>

                            @endif
                            @if(Auth::guard('web')->user())
                            <li class="nav-item active">
                                <a class="nav-link" href="{{route('all_stores')}}">All Stores</a>
                            </li>
                            @endif
							<li class="nav-item dropdown dropdown-slide">
								<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="">Lang<span><i class="fa fa-angle-down"></i></span>
								</a>

								<!-- Dropdown list -->


								<div class="dropdown-menu">

                                    @foreach(App\Models\Lang::all() as $lang)
                                        @if($lang->getActive())

                                        <a data-toggle="tooltip" data-placement="top" title="{{$lang->abbr==app()->getLocale()?'the Used':'choose'}}" class="dropdown-item" href="{{ LaravelLocalization::getLocalizedURL($lang->abbr) }}">
                                            {{$lang->name}}
                                        </a>
                                        @endif
                                    @endforeach


									@if(Auth::guard('admin')->user())
                                  <a class="dropdown-item" data-toggle="tooltip" title="settings" href="{{route('available_langs')}}">Langs</a>
									<a class="dropdown-item" href="{{route('create_Lang')}}">Add Lang</a>

									@endif

								</div>

							</li>
							@if(Auth::guard('web')->user())
							<li class="nav-item active">
								<a class="nav-link" href="{{route('form_edit_user_profile',Auth::guard('web')->id())}}">Edit Profile</a>
							</li>
							@endif
						</ul>
						@endif
                        <ul class="navbar-nav ml-auto mt-10">
							<li class="nav-item">
								@if(Auth::guard('web')->user())
								<a class="nav-link login-button" href="{{route('logout')}}">Logout</a>
                                    @elseif(Auth::guard('admin')->user())
                                    <a  style="border-radius:10px" class="nav-link login-button" href="{{route('overs')}}">
                                        Overs<span class="badge bg-primary rounded-pill" style="color:white;margin-left:5px;">
                                            {{\App\Models\Notify::GetNotifyOver() != null?\App\Models\Notify::GetNotifyOver()->counter:0}}</span>
                                    </a>
                                              </li><li class="navbar-nav ml-auto mt-10">
                                    <a  style="border-radius:10px" class="nav-link login-button" href="{{route('orders')}}">Orders<span class="badge bg-primary rounded-pill" style="color:white;margin-left:5px">
                                            {{\App\Models\Notify::GetNotifyOrder() != null ?\App\Models\Notify::GetNotifyOrder()->counter:0}}</span>
                                    </a>
								@endif
                                @auth()
                                    @else
                                        <a class="nav-link login-button" href="{{route('login')}}">Login</a>
                                    @endauth

							</li>
							@if(Auth::guard('web')->user())
							<li class="nav-item">
								<a class="nav-link text-white add-button" href="{{route('make_over')}}">Sell Category</a>
							</li>
							@endif
						</ul>
					</div>
				</nav>
               
			
            </div>
		</div>
	</div>
</section>



