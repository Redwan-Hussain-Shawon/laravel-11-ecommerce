@extends('layouts.admin')

@section('admin-content')
<div class="content-wrapper" style="min-height: 458px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Category</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#storeModal">+ Add New</button>
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
                            <th>Category Name</th>
                            <th>Category Slug</th>
                            <th>Action</th>
                          </tr>
                          </thead>
                          <tbody>

                            @foreach ($data as $row )
                          <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$row->category_name}}</td>
                            <td>{{$row->category_slug}}</td>
                            <td> 
                                <a href="" data-toggle="modal" id="editCategory" data-id='{{$row->id}}' data-target="#editModal" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                <a href="{{ route('category.delete',$row->id) }}"  class="btn btn-danger btn-sm " id="deleteBtn"><i class="fas fa-trash"></i></a>
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
    
    <div class="modal fade" id="storeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="POST" action="{{route('category.store')}}">
            @csrf
          <div class="modal-body">
       
              <div class="form-group">
                <label for="category_name">Category Name</label>
                <input type="text" class="form-control" id="category_name" name="category_name" required>
                <small id="category_name" class="form-text text-muted">This is your main Category</small>
              </div>
           
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
        </form>
        </div>
      </div>
    </div>
        
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="POST" action="{{route('category.update')}}">
            @csrf
          <div class="modal-body">
       
              <div class="form-group">
                <label for="category_name">Category Name</label>
                <input type="text" class="form-control" id="cat_edit_name" name="category_name" required>
                <small id="category_name" class="form-text text-muted">This is your main Category</small>
              </div>
           <input type="hidden" name="category_id" id="cat_edit_id">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
        </form>
        </div>
      </div>
    </div>
@endsection

@push('script')
  <script>
    $(document).on('click','#editCategory',function(){
       let cat_id = $(this).data('id');
       $.get("{{ url('admin/category/edit')}}/"+cat_id,function(data){
        $('#cat_edit_name').val(data.category_name)
        $('#cat_edit_id').val(data.id)
       }).fail(function(jqXHR, textStatus, errorThrown) {
            console.error("Error: " + textStatus, errorThrown);
        });
      })
  </script>
@endpush