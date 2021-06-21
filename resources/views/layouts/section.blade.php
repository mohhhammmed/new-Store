


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
							<li class="nav-item active">
								<a class="nav-link" href="{{route('home')}}">Home</a>
							</li>


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

                                        <a class="dropdown-item" href="{{route('create_parent')}}">Add parent of sub Categories</a>
                                        <a class="dropdown-item" href="{{route('all_subcategories')}}">Sub Categories</a>
                                        <a class="dropdown-item" href="{{route('create_subcategory')}}">Add Sub Categories</a>

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
                                    @else
                                    <a class="nav-link login-button" href="{{route('all_requests')}}">Seller Notifications<span class="badge bg-primary rounded-pill" style="color:white">{{\App\Models\Notify::find(1)->counter==0?'':\App\Models\Notify::find(1)->counter}}</span>
                                    </a>
								@endif
                                @auth()
                                    @else
                                        <a class="nav-link login-button" href="{{route('login')}}">Login</a>
                                    @endauth

							</li>
							@if(Auth::guard('web')->user())
							<li class="nav-item">
								<a class="nav-link text-white add-button" href="{{route('sell_your_category')}}"><i class="fa fa-plus-circle"></i>Sell Category</a>
							</li>
							@endif
						</ul>
					</div>
				</nav>
			</div>
		</div>
	</div>
</section>



