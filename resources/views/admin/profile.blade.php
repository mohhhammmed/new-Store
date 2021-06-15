<div class="widget user-dashboard-profile">
    <!-- User Image -->
    <div class="profile-thumb">
      <img src="{{asset('admin/profile/admin.png')}}" alt="" class="rounded-circle">
    </div>
    <!-- User Name -->
    <h5 class="text-center">Mohamed Fouad</h5>
    <p>Joined February 06, 2021</p>
    <a href="user-profile.html" class="btn btn-main-sm">Edit Profile</a>
  </div>
  <div class="widget user-dashboard-menu">
    <ul>
      <li class="active"><a href="dashboard-my-ads.html"><i class="fa fa-user"></i> My Ads</a></li>
      <li><a href="dashboard-favourite-ads.html"><i class="fa fa-bookmark-o"></i> Favourite Ads <span>5</span></a></li>
      <li><a href="dashboard-archived-ads.html"><i class="fa fa-file-archive-o"></i>Archived Ads <span>12</span></a></li>
      <li><a href="dashboard-pending-ads.html"><i class="fa fa-bolt"></i> Pending Approval<span>23</span></a></li>
      <li><a href="{{route('store.logout')}}"><i class="fa fa-cog"></i> Logout</a></li>
      <li><a href="" data-toggle="modal" data-target="#deleteaccount"><i class="fa fa-power-off"></i>Delete
          Account</a></li>
    </ul>
  </div>
