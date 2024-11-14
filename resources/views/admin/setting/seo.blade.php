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
                  <h3 class="card-title">Your Seo Setting</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{route('seo.setting.update')}}" method="POST">
                    @csrf
                  <div class="card-body">
                    <div class="form-group">
                      <label for="meta_title">Meta Title</label>
                      <input type="text" class="form-control" id="meta_title" placeholder="Meta Title" name="meta_title" value="{{ $data->meta_title }}">
                    </div> 
                    <input type="hidden" name="id" value="{{$data->id}}">
                    <div class="form-group">
                      <label for="meta_author">Meta Author</label>
                      <input type="text" class="form-control" id="meta_author" placeholder="Meta Author " name="meta_author" value="{{ $data->meta_author }}">
                    </div>
                       <div class="form-group">
                      <label for="meta_tag">Meta Tag</label>
                      <input type="text" class="form-control" id="meta_tag" placeholder="Meta Tag" name="meta_tag" value="{{ $data->meta_tag }}">
                    </div>
                       <div class="form-group">
                      <label for="meta_description">Meta Title</label>
                      <textarea class="form-control" name="meta_description" id="meta_description" cols="30" rows="3">{{ $data->meta_description }}</textarea>
                    </div>
                       <div class="form-group">
                      <label for="meta_keyword">Meta Keyword</label>
                      <input type="text" class="form-control" id="meta_keyword" placeholder="Meta Keyword" name="meta_keyword" value="{{ $data->meta_keyword }}">
                    </div>
                    <strong class="text-center text-success">-- Other Option -- </strong>
                       <div class="form-group">
                      <label for="google_verification">Google Verification</label>
                      <input type="text" class="form-control" id="google_verification" placeholder="Google Verification" name="google_verification" value="{{ $data->google_verification }}">
                    </div>
                       <div class="form-group">
                      <label for="alexa_verification">Alexa Verification</label>
                      <input type="text" class="form-control" id="alexa_verification" placeholder="Alexa Verification" name="alexa_verification" value="{{ $data->alexa_verification }}">
                    </div>
                    <div class="form-group">
                        <label for="meta_description">Google Analytics</label>
                        <textarea class="form-control" name="google_analytics" id="google_analytics" cols="30" rows="3">{{ $data->google_analytics }}</textarea>
                      </div> 
                       <div class="form-group">
                        <label for="google_adsense">Google Adsense</label>
                        <textarea class="form-control" name="google_adsense" id="google_adsense" cols="30" rows="3">{{ $data->google_adsense }}</textarea>
                      </div>
                    
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