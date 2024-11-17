@extends('layouts.admin')

@section('admin-content')
<div class="content-wrapper" style="min-height: 458px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Offer</h1>
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
                            <h3 class="card-title">All Coupon List Here</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Pickup Point</th>
                                        <th>Phone</th>
                                        <th>Phone Two</th>
                                        <th>Address</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($data as $row )
                                    <tr id="row_{{$row->id}}">
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$row->pickup_point_name}}</td>
                                        <td>{{$row->pickup_point_phone}}</td>
                                        <td>{{$row->pickup_point_phone_two}}</td>
                                        <td>{{$row->pickup_point_address}}</td>
                                        <td>
                                            <a href="" data-toggle="modal" id="editcoupon" data-id='{{$row->id}}'
                                                data-target="#editModal" class="btn btn-info btn-sm "><i
                                                    class="fas fa-edit"></i></a>
                                            <a href="{{ route('pickuppoint.delete',$row->id)}}" id="deleteBtn" class="btn btn-danger btn-sm "
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
                    <h5 class="modal-title" id="exampleModalLabel">Add Pickup Point</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('pickuppoint.store') }}">
                    @csrf
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="pickup_point_name">Pickup Point Name</label>
                            <input type="text" class="form-control" id="pickup_point_name" name="pickup_point_name" required
                                placeholder="pickup point name">
                        </div>
                        <div class="form-group">
                            <label for="pickup_point_phone">Pickup Point Phone</label>
                            <input type="text" class="form-control" id="pickup_point_phone" name="pickup_point_phone" required
                                placeholder="pickup point phone">
                        </div> 
                        <div class="form-group">
                            <label for="pickup_point_phone_two">Pickup Point Phone Two</label>
                            <input type="text" class="form-control" id="pickup_point_phone_two" name="pickup_point_phone_two" 
                                placeholder="pickup point phone two">
                        </div>
                        <div class="form-group">
                            <label for="pickup_point_address">Pickup Point Address</label>
                            <input type="text" class="form-control" id="pickup_point_address" name="pickup_point_address" required
                                placeholder="pickup point address">
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit Pickup Point</h5>
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
        $(document).on('click','#editcoupon',function(){
            let id = $(this).data('id');
            $.get("{{ url('admin/pickup-point/edit') }}/"+id, function(data, status){
                if(status=='success'){
                    $('.editcontent').html(data)
                }
            })
        })
    </script>
    @endpush