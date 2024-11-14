@extends('frontend.layout.main')
@section('title','Login your account')
@section('content')
<div class="container  py-5">
    <div class="card p-4 shadow-sm mx-auto" style="max-width: 500px">
        @if ($errors->any())
        <div class="alert alert-danger mt-2">
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </div>
        @endif
<form action="{{route('loginmatch')}}" method="POST">
    @csrf
   
    <h4>Login</h4>
    @if(session('success'))
    <div class="alert alert-success" role="alert">
        {{session('success')}}
      </div>
    @endif
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Email address</label>
      <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
    </div>
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Password</label>
      <input type="password" class="form-control" id="exampleInputPassword1" name="password">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>

</div>
</div>
@endsection