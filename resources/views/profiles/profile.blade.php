
@if(Auth::guard('admin')->user())
<div class="widget user-dashboard-profile">
    <!-- User Image -->
    <div class="profile-thumb">
        <img src="{{asset('admin/profile/'.$admin->image)}}" alt="" class="rounded-circle">
    </div>
    <!-- User Name -->
    <h5 class="text-center">{{$admin->name}}</h5>
    <p>Joined February 06, 2017</p>
    <a href="{{route('profile',Auth::guard('admin')->id())}}" class="btn btn-main-sm">Edit</a>
</div>
<!-- Dashboard Links -->
<div class="widget user-dashboard-menu">
    <ul>

        <li>
            <a href=""><i class="fa fa-cog"></i> Logout</a>
        </li>
        <li>
            <a href="#" data-toggle="modal" data-target="#deleteaccount"><i class="fa fa-power-off"></i>Delete Account</a>
        </li>
    </ul>
</div>
@else

    <div class="widget user-dashboard-profile">
        <!-- User Image -->
        <div class="profile-thumb">
            <img src="{{asset('user/images/'.$user->image)}}" alt="" class="rounded-circle">
        </div>
        <!-- User Name -->
        <h5 class="text-center">{{$user->name}}</h5>
        <p>Joined February 06, 2017</p>
        <a href="{{route('user_profile')}}" class="btn btn-main-sm">Edit</a>
    </div>
    <!-- Dashboard Links -->
    <div class="widget user-dashboard-menu">
        <ul>

            <li>
                <a href=""><i class="fa fa-cog"></i> Logout</a>
            </li>
            <li>
                <a href="#" data-toggle="modal" data-target="#deleteaccount"><i class="fa fa-power-off"></i>Delete Account</a>
            </li>
        </ul>
    </div>

@endif
