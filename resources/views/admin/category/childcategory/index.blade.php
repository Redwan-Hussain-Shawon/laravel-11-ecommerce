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
              <h3 class="card-title">All Child Categories List Here</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="" class="table table-bordered table-striped ytable">
                <thead>
                  <tr>
                    <th>SL</th>
                    <th>ChildCategory Name</th>
                    <th>Category Name</th>
                    <th>Sub Category Slug</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>

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
          <h5 class="modal-title" id="exampleModalLabel">Add New Child Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="{{route('childcategory.store')}}" id="add-form">
          @csrf
          <div class="modal-body">
            <div class="form-group">
              <label for="category_name"> Category / Subcategory Name</label>
              <select name="subcategory_id" id="" class="form-control" required>
                @foreach ($category as $row )
                @php 
                  $subcat = DB::table('subcategories')->where('category_id',$row->id)->get();
                @endphp
                <option>{{$row->category_name}}</option>
                @foreach ($subcat as $sub_row )
                <option value="{{ $sub_row->id }}"> ----- {{$sub_row->subcategory_name}}</option>
                @endforeach
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label for="subcategory_name">Child Category Name</label>
              <input type="text" class="form-control" id="childcategory_name" name="childcategory_name" required>
              <small id="category_name" class="form-text text-muted">This is your main Child Category</small>
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary"><span class="d-none">loading....</span>Submit</button>
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
          <h5 class="modal-title" id="exampleModalLabel">Edit Sub Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div id="model_body_edit">

        </div>
    
      </div>
    </div>
  </div>
  @endsection



  @push('script')
    <script>
      //   $(document).on('click','#editCategory',function(){
      //   let sub_cat_id = $(this).data('id');
      //   $.get(" {{ url('admin/subcategory/edit') }}/"+sub_cat_id,function(data){
      //     $('#model_body_edit').html(data)
      //   } )

      // })
      $(document).on('click','#editChildCat',function(){
        let child_cat_id = $(this).data('id');
        $.get("{{ url('admin/childcategory/edit')}}/"+child_cat_id,function(data){
          $('#model_body_edit').html(data)
        })}
      )
      $(function childcategory(){
        let table = $('.ytable').DataTable({
          processing:true,
          serverSide:true,
          ajax:"{{ route('childcategory.index') }}",
          columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },   // Corrected property name
            { data: 'childcategory_name', name: 'childcategory_name' },
            { data: 'category_name', name: 'category_name' },
            { data: 'subcategory_name', name: 'subcategory_name' },
            { data: 'action', name: 'action', orderable: true, searchable: true } 
        ]
        })
      })

    </script>
  @endpush