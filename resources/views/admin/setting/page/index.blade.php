@extends('layouts.admin')

@section('admin-content')
<div class="content-wrapper" style="min-height: 458px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">All Page List Here</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <a href="{{route('page.create')}}" class="btn btn-primary">+ Add New</a>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">All Categories List Here</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                          <thead>
                          <tr>
                            <th>SL</th>
                            <th>Page Name</th>
                            <th>Page Title</th>
                            <th>Action</th>
                          </tr>
                          </thead>
                          <tbody>

                            @foreach ($page as $row )
                          <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$row->page_name}}</td>
                            <td>{{$row->page_title}}</td>
                            <td> 
                                <a href="{{ route('page.edit',$row->id) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                <a href="{{ route('page.delete',$row->id) }}" class="btn btn-danger btn-sm " id="deleteBtn"><i class="fas fa-trash"></i></a>
                            </td>
                          </tr>
                          @endforeach
                          </tbody>
                        </table>
                      </div>
                    <!-- /.card-body -->
                  </div>
            </div>
          </div>
        </div>
    </section>
    
 
@endsection
