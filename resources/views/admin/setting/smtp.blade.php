@extends('layouts.admin')

@section('admin-content')
<div class="content-wrapper" style="min-height: 458px;">
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Setting</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Setting</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <!-- left column -->
            <div class="col-md-6">
              <!-- general form elements -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Your Mail Setting</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{route('smtp.setting.update')}}" method="POST">
                    @csrf
                  <div class="card-body">
                    <div class="form-group">
                      <label for="mailer">Mail Mailer</label>
                      <input type="text" class="form-control" id="mailer" placeholder="Mail Title" name="mailer" value="{{ $data->mailer }}">
                    </div> 
                      <div class="form-group">
                      <label for="host">Mail Host</label>
                      <input type="text" class="form-control" id="host" placeholder="Mail Host" name="host" value="{{ $data->host }}">
                    </div>  
                       <div class="form-group">
                      <label for="port">Mail Port</label>
                      <input type="text" class="form-control" id="port" placeholder="Mail Port" name="port" value="{{ $data->port }}">
                    </div>  
                      <div class="form-group">
                      <label for="user_name">Mail Username</label>
                      <input type="text" class="form-control" id="user_name" placeholder="Mail Username" name="user_name" value="{{ $data->user_name }}">
                    </div>  
                      <div class="form-group">
                      <label for="password">Mail Password</label>
                      <input type="text" class="form-control" id="password" placeholder="Meta Password" name="password" value="{{ $data->password }}">
                    </div> 
                    <input type="hidden" name="id" value="{{$data->id}}">
              
                    
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="exampleCheck1">
                      <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div>
                  </div>
                  <!-- /.card-body -->
  
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div>
    
  
            </div>

          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
  </div>
@endsection