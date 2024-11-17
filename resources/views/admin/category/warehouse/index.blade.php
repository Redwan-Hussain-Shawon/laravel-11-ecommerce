@extends('layouts.admin')

@section('admin-content')
<div class="content-wrapper" style="min-height: 458px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Category</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#storeModal">+
                            Add New</button>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">All Warehouse List Here</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Warehouse Name</th>
                                        <th>Warehouse Phone</th>
                                        <th>Warehouse Address</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($data as $row )
                                    <tr id="row_{{$row->id}}">
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$row->warehouse_name}}</td>
                                        <td>{{$row->warehouse_phone}}</td>
                                        <td>{{$row->warehouse_address}}</td>
                                        <td>
                                            <a href="" data-toggle="modal" id="editwarehouse" data-id='{{$row->id}}'
                                                data-target="#editModal" class="btn btn-info btn-sm "><i
                                                    class="fas fa-edit"></i></a>
                                            <a href="#" id="btnDelete" class="btn btn-danger btn-sm "
                                                data-id='{{$row->id}}'><i class="fas fa-trash"></i></a>
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
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="add-warehouse">
                    @csrf
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="warehouse_name">Warehouse Name</label>
                            <input type="text" class="form-control" id="warehouse_name" name="warehouse_name" required
                                placeholder="warehouse name">
                        </div>
                        <div class="form-group">
                            <label for="warehouse_phone">Warehouse Phone</label>
                            <input type="text" class="form-control" id="warehouse_phone" name="warehouse_phone" required
                                placeholder="warehouse phone">
                        </div>
                        <div class="form-group">
                            <label for="warehouse_address">Warehouse Address</label>
                            <input type="text" class="form-control" id="warehouse_address" name="warehouse_address"
                                required placeholder="warehouse address">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="saveBtn">Save</button>
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <div class="editcontent"></div>
            </div>
        </div>
    </div>
    @endsection

    @push('script')
    <script>
        $('#add-warehouse').on('submit',function(e){
    $('#saveBtn').prop('disabled',true);
    e.preventDefault();
    let fromData = new FormData(this);
    $.ajax({
        type: "POST",
        url: "{{ route('warehouse.store')}}",
        processData: false, 
        contentType: false,
        data:fromData,
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            if(response.status==true){
                window.location.reload();                  
            }
           $('#saveBtn').prop('disabled',false);
        }
    });
   })

   $(document).on('click','#btnDelete',function(e){
    Swal.fire({
        title:'Are your Want to delete Warehouse?',
        text:'Once Delete, This will be Permanently Delete!',
        icon:'warning',
        showDenyButton: true, // Display cancel button
        confirmButtonText: 'Yes, Deleted!',
        denyButtonText: `No, stay there!`
      }).then((result)=>{
        if(result.isConfirmed){
            let id = $(this).data('id');
           $.get(`{{ url('admin/warehouse/delete')}}/${id}`,function(data){
            if(data.status==true){
               $('#row_'+id).animate({
                opacity: 0,
                height: "0px",
                }, 300, function() {
                $(this).remove();
                });

            }
           })
        }else{
          Swal.fire('Your data Safe ')
        }
      })

   })

   $(document).on('click','#editwarehouse',function(){
    let id = $(this).data('id');
    $.get("{{ url('admin/warehouse/edit')}}/"+id,function(data){
        $('.editcontent').html(data);
    })
   })


    </script>
    @endpush