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
                        <form action="{{route('website.setting.update')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="currency">Currency</label>
                                    <select name="currency" id="currency" class="form-control">
                                        <option value="৳" @if($setting->currency=='৳') selected @endif >৳</option>
                                        <option value="$" @if($setting->currency=='$') selected @endif>$</option>
                                    </select>
                                </div>
                                <input type="hidden" name="id" value="{{$setting->id}}">
                                <div class="form-group">
                                    <label for="phone_one">Phone One</label>
                                    <input type="text" class="form-control" id="phone_one" placeholder="Phone One "
                                        name="phone_one" value="{{ $setting->phone_one }}">
                                </div>
                                <div class="form-group">
                                    <label for="phone_two">Phone Two</label>
                                    <textarea class="form-control" name="phone_two" id="phone_two" cols="30" rows="3">{{
                                        $setting->phone_two }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="main_email">Main Email</label>
                                    <input type="text" class="form-control" id="main_email" placeholder="Main Email"
                                        name="main_email" value="{{ $setting->main_email }}">
                                </div> 
                                   <div class="form-group">
                                    <label for="support_email">Support Email</label>
                                    <input type="text" class="form-control" id="support_email" placeholder="Support Email"
                                        name="support_email" value="{{ $setting->support_email }}">
                                </div>
                                <div class="form-group">
                                    <label for="address">Address</label>
                                        <textarea class="form-control" name="address" id="address"
                                        cols="30" rows="3">{{ $setting->address }}</textarea>
                                </div>
                                <strong class="text-info"> Social Link </strong>
                                <div class="form-group">
                                    <label for="support_email">Facebook</label>
                                    <input type="text" class="form-control" id="facebook" placeholder="Facebook"
                                        name="facebook" value="{{ $setting->facebook }}">
                                </div>
                                <div class="form-group">
                                    <label for="twitter">Twitter</label>
                                    <input type="text" class="form-control" id="twitter" placeholder="Twitter"
                                        name="twitter" value="{{ $setting->twitter }}">
                                </div>
                                <div class="form-group">
                                    <label for="instagram">Instagram</label>
                                    <input type="text" class="form-control" id="instagram" placeholder="Instagram"
                                        name="instagram" value="{{ $setting->instagram }}">
                                </div>
                                <div class="form-group">
                                    <label for="linkedin">Linkedin</label>
                                    <input type="text" class="form-control" id="linkedin" placeholder="Linkedin"
                                        name="linkedin" value="{{ $setting->linkedin }}">
                                </div>
                                <div class="form-group">
                                    <label for="youtube">Youtube</label>
                                    <input type="text" class="form-control" id="youtube" placeholder="Youtube"
                                        name="youtube" value="{{ $setting->youtube }}">
                                </div>
                                <strong class="text-info"> Logo & Favicon </strong>
                                <div class="form-group">
                                    <label for="logo">Main Logo</label>
                                    <input type="file" class="form-control" id="logo" placeholder="Youtube"
                                        name="logo" data-default-file="{{asset($setting->logo)}}">
                                     <input type="hidden" name="old_logo" value="{{$setting->logo}}">
                                </div>
                                <div class="form-group">
                                    <label for="youtube">Favicon</label>
                                    <input type="file" class="form-control" id="favicon" placeholder="favicon"
                                        name="favicon"  data-default-file="{{asset($setting->favicon)}}" >
                                        <input type="hidden" name="old_favicon" value="{{$setting->favicon}}">
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

@push('script')
<script>
    $('#logo').dropify({
    messages: {
    	'default': 'Drag and drop logo',
    	'replace': 'Drag and drop or click to replace',
    	'remove':  'Remove',
      'error':   'Sorry, this file is too large'

    }
}
    ) 
    
    $('#favicon').dropify({
    messages: {
    	'default': 'Drag and drop favicon',
    	'replace': 'Drag and drop or click to replace',
    	'remove':  'Remove',
      'error':   'Sorry, this file is too large'

    }
}
    )
  </script>
  @endpush