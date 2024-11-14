



<a href="{{route('logout')}}">Logout</a>
<a href="{{route('user.profile',Auth::id())}}">Edit</a>

@can('isAdmin')
<h2 class="alert alert-success">Your Number Is Set </h2>
@else
  <h2 class="alert alert-danger">Your Number Not Set Plaze Set Your Number</h2>
@endcan