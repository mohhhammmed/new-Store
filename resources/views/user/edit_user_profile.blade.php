
@extends('layouts.html')

@section('content')

@endsection
@include('layouts.section')
<!--==================================
=            User Profile            =
===================================-->

<section class="user-profile section">
	<div class="container">
		<div class="row">
			<div class="col-md-10 offset-md-1 col-lg-3 offset-lg-0">
				<div class="sidebar">
					<!-- User Widget -->
					<div class="widget user">
						<!-- User Image -->
						<div class="image d-flex justify-content-center">
							<img src="{{asset('user/images/'.$user->image)}}" alt="" class="">
						</div>
						<!-- User Name -->
						<h5 class="text-center">{{$user->name}}</h5>
					</div>
					<!-- Dashboard Links -->
					<div class="widget dashboard-links">
						<ul>
							<li><a class="my-1 d-inline-block" href="">Savings Dashboard</a></li>
							<li><a class="my-1 d-inline-block" href="">Saved Offer <span>(5)</span></a></li>
							<li><a class="my-1 d-inline-block" href="">Favourite Stores <span>(3)</span></a></li>
							<li><a class="my-1 d-inline-block" href="">Recommended</a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-md-10 offset-md-1 col-lg-9 offset-lg-0">
				<!-- Edit Profile Welcome Text -->
				<div class="widget welcome-message">
					@include('messages.err_or_succ')
					<h2>Edit profile</h2>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p>
				</div>
				<!-- Edit Personal Info -->
				<div class="row">
					<div class="col-lg-6 col-md-6">
						<div class="widget personal-info">

							<h3 class="widget-header user">Edit Personal Information</h3>
							<form action="{{route('edit_profile')}}"method='post' enctype='multipart/form-data'>
								<!-- First Name -->@csrf
								<div class="form-group">
									<label for="first-name">New Name</label>
									<input type="text"name='name' class="form-control" id="first-name">
								</div>
                                   @error('name')
									   <div class="text text-success">{{$message}}</div>
								   @enderror
								<div class="form-group choose-file d-inline-flex">
									<i class="fa fa-user text-center px-3"></i>
									<input type="file"name='image' class="form-control-file mt-2 pt-1" id="input-file">
								 </div>
								 @error('image')
								 <div class="text text-success">{{$message}}</div>
							 @enderror

								<input type='hidden'name='id'value='{{$user->id}}'>

								<button class="btn btn-transparent">Save My Changes</button>
							</form>
						</div>
					</div>
					<div class="col-lg-6 col-md-6">
						<!-- Change Password -->
					<div class="widget change-password">
						<h3 class="widget-header user">Edit Password</h3>
						<form action="{{route('edit_profile')}}"method='post'>
							<!-- Current Password -->@csrf

							<div class="form-group">
								<label for="new-password">New Password</label>
								<input type="password"name='new_password' class="form-control" id="new-password">
							</div>
							@error('new_password')
							<div class="text text-success">{{$message}}</div>
						@enderror
							<!-- Confirm New Password -->
							<div class="form-group">
								<label for="confirm-password">Confirm New Password</label>
								<input type="password"name='confirm_password' class="form-control" id="confirm-password">
							</div>
							@error('confirm_password')
							<div class="text text-success">{{$message}}</div>
						@enderror
							<!-- Submit Button -->
							<button class="btn btn-transparent">Change Password</button>
						</form>
					</div>
					</div>
					<div class="col-lg-6 col-md-6">
						<!-- Change Email Address -->
					<div class="widget change-email mb-0">
						<h3 class="widget-header user">Edit Email Address</h3>
						<form action="{{Route('edit_profile')}}" method='POST'>
							@csrf
							<!-- Current Password -->
							<div class="form-group">
								<label for="current-email">Current Email</label>
								<input type="email" name='email' class="form-control" id="current-email">
							</div>
							<!-- New email -->
							<div class="form-group">
								<label for="new-email">New email</label>
								<input type="email" name='new_email' class="form-control" id="new-email">
							</div>
							<!-- Submit Button -->
							<button class="btn btn-transparent">Change email</button>
						</form>
					</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!--============================
=            Footer            =
=============================-->
@include('layouts.footer')
