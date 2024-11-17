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
                                        <th>Coupon Code</th>
                                        <th>Coupon Amount</th>
                                        <th>Coupon Date</th>
                                        <th>Coupon Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($data as $row )
                                    <tr id="row_{{$row->id}}">
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$row->coupon_code}}</td>
                                        <td>{{$row->coupon_amount}}</td>
                                        <td>{{$row->valid_date}}</td>
                                        <td>{{$row->status}}</td>
                                        <td>
                                            <a href="" data-toggle="modal" id="editcoupon" data-id='{{$row->id}}'
                                                data-target="#editModal" class="btn btn-info btn-sm "><i
                                                    class="fas fa-edit"></i></a>
                                            <a href="{{ route('coupon.delete',$row->id)}}" id="deleteBtn" class="btn btn-danger btn-sm "
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
                    <h5 class="modal-title" id="exampleModalLabel">Add New Coupon</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('coupon.store') }}">
                    @csrf
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="coupon_code">Coupon Code</label>
                            <input type="text" class="form-control" id="coupon_code" name="coupon_code" required
                                placeholder="coupon code">
                        </div>
                        <div class="form-group">
                            <label for="type">Coupon Type</label>
                            <select name="type" id="type" class="form-control">
                                <option value="1">Fixed</option>
                                <option value="2">Percentage</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="coupon_amount">Coupon Amount</label>
                            <input type="text" class="form-control" id="coupon_amount" name="coupon_amount" required
                                placeholder="coupon amount">
                        </div>
                        <div class="form-group">
                            <label for="valid_date">Valid Date</label>
                            <input type="date" class="form-control" id="valid_date" name="valid_date" required
                                placeholder="valid date">
                        </div>
                        <div class="form-group">
                            <label for="status">Coupon Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1">Active</option>
                                <option value="2">Inactive </option>
                            </select>
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit Coupon</h5>
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
            $.get("{{ url('admin/coupon/edit') }}/"+id, function(data, status){
                if(status=='success'){
                    $('.editcontent').html(data)
                }
            })
        })
    </script>
    @endpush