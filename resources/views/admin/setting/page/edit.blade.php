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
                            <h3 class="card-title">Update Page</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{route('page.update',$data->id)}}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="page_positon">Page Position </label>
                                    <select name="page_positon" class="form-control" id="page_positon">
                                        <option value="1" @if($data->page_positon==1) selected @endif>Line 1</option>
                                        <option value="2"@if($data->page_positon==2) selected @endif>Line 2</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="page_name">Page Name </label>
                                    <input type="text" class="form-control" id="page_name" placeholder="Page Name"
                                        name="page_name" value="{{$data->page_name}}">
                                </div>
                                <div class="form-group">
                                    <label for="page_title">Page Title </label>
                                    <input type="text" class="form-control" id="page_title" placeholder="Page Title"
                                        name="page_title" value="{{$data->page_title}}">
                                </div>
                                <div class="form-group">
                                    <label for="page_description">Page Description</label>
                                    <textarea class="form-control" name="page_description" id="page_description" cols="30"
                                        rows="4">{{$data->page_description}}</textarea>
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
         $(function () {
    $('#page_desciption').summernote()

    // CodeMirror
    CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
      mode: "htmlmixed",
      theme: "monokai"
    });
  })
    </script>
@endpush