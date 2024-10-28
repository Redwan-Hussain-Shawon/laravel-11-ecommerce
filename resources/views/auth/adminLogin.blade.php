@extends('layouts.admin')

@section('admin-content')
<div class="login-page px-4" style="min-height: 466px;">
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary py-3">
      <div class="card-header text-center">
        <a href="../../index2.html" class="h1"><b>Admin</b>Panel</a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Admin Login Panel</p>
  
        <form action="{{ route('login') }}" method="POST">
          @if(session('error'))
           <div class="alert alert-default-danger">
              {{session('error')}}
          </div>
          @endif
          @csrf
          <div class="mb-3">
          <div class="input-group mb-1">
            <input type="email" class="form-control " placeholder="Email" name="email" value="{{old('email')}}">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
           
          </div>
          @error('email')
          <p class="text-danger mt-0">
            {{$message}}
          </p>
        @enderror
          </div>
        <div class="mb-3">
          <div class="input-group mb-1">
            <input type="password" class="form-control" placeholder="Password" name="password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          @error('password')
          <p class="text-danger mt-0">
            {{$message}}
          </p>
        @enderror
      </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="remember">
                <label for="remember">
                  Remember Me
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.login-box -->

  
</div>
@endsection