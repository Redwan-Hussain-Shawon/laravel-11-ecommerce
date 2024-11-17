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
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#storeModal">+ Add
              New</button>
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
                    <th>Sub Category Name</th>
                    <th>Category Name</th>
                    <th>Sub Category Slug</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>

                  @foreach ($data as $row )
                  <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$row->brand_name}}</td>
                    <td>{{$row->brand_slug}}</td>
                    <td><img src="{{asset($row->brand_logo)}}" alt="" style="width: 80px;height:60px" class="rounded-1">
                    </td>
                    <td>
                      <a href="" data-toggle="modal" id="editBrand" data-id='{{$row->id}}' data-target="#editModal"
                        class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                      <a href="{{ route('brand.delete',$row->id) }}" class="btn btn-danger btn-sm " id="deleteBtn"><i
                          class="fas fa-trash"></i></a>
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

  <div class="modal fade" id="storeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New Brand</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="{{route('brand.store')}}" enctype="multipart/form-data">
          @csrf
          <div class="modal-body">

            <div class="form-group">
              <label for="subcategory_name">Brand Name</label>
              <input type="text" class="form-control" id="brand_name" name="brand_name" required>
              <small id="category_name" class="form-text text-muted">This is your main brand name</small>
            </div>
            <div class="form-group">
              <label for="subcategory_name">Brand Image</label>
              <input type="file" class="form-control dropify" id="brand_logo" name="brand_logo"
                data-disable-remove="true" required>
              <small id="category_name" class="form-text text-muted">This is your brand logo</small>
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

  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Brand </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div id="model_body_edit">

        </div>

      </div>
    </div>
  </div>
</div>
  @endsection


  @push('script')
  <script>
    $('.dropify').dropify({
    messages: {
    	'default': 'Drag and drop file',
    	'replace': 'Drag and drop or click to replace',
    	'remove':  'Remove',
      'error':   'Sorry, this file is too large'

    }
}
    )
        $(document).on('click','#editCategory',function(){
        let sub_cat_id = $(this).data('id');
        $.get(" {{ url('admin/subcategory/edit') }}/"+sub_cat_id,function(data){
          $('#model_body_edit').html(data)
        } )

      })

      $(document).on('click','#editBrand',function(){
        let brand_id = $(this).data('id');
        $.get("{{ url('admin/brand/edit') }}/"+brand_id,function (data) {
           $('#model_body_edit').html(data);
          })
      })
  </script>
  @endpush