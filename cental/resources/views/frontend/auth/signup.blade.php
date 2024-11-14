@extends('frontend.layout.main')
@section('title','Create a Account')
@section('content')
<div class="container  py-5">
    <div class="card p-4 shadow-sm mx-auto" style="max-width: 500px">
<form action="{{route('registerSave')}}" method="POST">
    @csrf
    <h4>Register</h4>
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Name</label>
      <input type="text" class="form-control" id="exampleInputEmail1" name="name" aria-describedby="emailHelp">
      @error('name')
      <span class="text-red">
        {{ $message }}
      </span>
      @enderror
    </div>
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Email</label>
      <input type="email" class="form-control" id="exampleInputPassword1" name="email">
      @error('email')
      <span class="text-red">
        {{ $message }}
      </span>
      @enderror
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" name="password">
        @error('password')
        <span class="text-red">
          {{ $message }}
        </span>
        @enderror
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" name="password_confirmation">
        @error('password_confirmation')
        <span class="text-red">
          {{ $message }}
        </span>
        @enderror
      </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
</div>
@endsection