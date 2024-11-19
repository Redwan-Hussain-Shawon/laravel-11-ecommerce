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
                        <a href="{{ route('product.create') }}">
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#storeModal">+
                                Add
                                New</button>
                        </a>
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
                            <h3 class="card-title">All Product List</h3>
                        </div>
                        <div class="row p-3" style="padding-bottom: 0px !important">
                        
                            <div class="form-group col-3">
                                <label for="">Category</label>
                                <select name="category_id" class="form-control submitable" id="category_id">
                                    <option value="">All</option>
                                    @foreach ($category as $row)
                                        <option value="{{ $row->id }}">{{ $row->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-3">
                                <label for="">Brand</label>
                                <select name="brand_id" class="form-control submitable" id="brand_id">
                                    <option value="">All</option>
                                    @foreach ($brand as $row)
                                        <option value="{{ $row->id }}">{{ $row->brand_name }}</option>
                                    @endforeach
                                </select>
                            </div> 
                             <div class="form-group col-3">
                                <label for="">Warehouse</label>
                                <select name="category_id" class="form-control submitable" id="warehouse_id">
                                    <option value="">All</option>
                                    @foreach ($warehouse as $row)
                                        <option value="{{ $row->id }}">{{ $row->warehouse_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-3">
                                <label for="">Status</label>
                                <select name="category_id" class="form-control submitable" id="status">
                                    <option value="">All</option>
                                    <option value="1">Active</option>
                                    <option value="0">Iactive</option>
                                </select>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="productTabele" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Thumbnail</th>
                                        <th>Name</th>
                                        <th>Code</th>
                                        <th>Category</th>
                                        <th>Subcategory</th>
                                        <th>Brand</th>
                                        <th>Featured</th>
                                        <th>Today Deal</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                {{-- <tbody>
                                    @foreach ($data as $row )
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><img src="{{ asset($row->thumbnail) }}"
                                                style="width: 40px;height:35px;border-radius:2px" /> </td>
                                        <td>{{ $row->name }}</td>
                                        <td>{{ $row->code }}</td>
                                        <td>{{ $row->category->category_name }}</td>
                                        <td>{{ $row->subcategory->subcategory_name }}</td>
                                        <td>{{ $row->brand->brand_name }}</td>
                                        <td>
                                            @if($row->featured == 1)
                                            <a href="" data-id="{{ $row->id }}" class="dactive_featured">
                                                <i class="fa fa-thumbs-up text-success" aria-hidden="true"></i>
                                                <span class="badge badge-success">active</span>
                                            </a>
                                            @else
                                            <a href="#" data-id="{{ $row->id }}" class="active_featured">
                                                <i class="fa fa-thumbs-down text-danger" aria-hidden="true"></i>
                                                <span class="badge badge-danger">dactive</span>
                                            </a>
                                            @endif
                                        </td>

                                        <td>
                                            @if($row->today_deal == 1)
                                            <a href="">
                                                <i class="fa fa-thumbs-up text-success" aria-hidden="true"></i>
                                                <span class="badge badge-success">active</span>
                                            </a>
                                            @else
                                            <a href="#">
                                                <i class="fa fa-thumbs-down text-danger" aria-hidden="true"></i>
                                                <span class="badge badge-danger">dactive</span>
                                            </a>
                                            @endif
                                        </td>
                                        <td>
                                            @if($row->status == 1)
                                            <a href="">
                                                <i class="fa fa-thumbs-up text-success" aria-hidden="true"></i>
                                                <span class="badge badge-success">active</span>
                                            </a>
                                            @else
                                            <a href="#">
                                                <i class="fa fa-thumbs-down text-danger" aria-hidden="true"></i>
                                                <span class="badge badge-danger">dactive</span>
                                            </a>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-info btn-sm edit"><i class="fas fa-edit"></i></a>
                                            <a href="#" class="btn btn-primary btn-sm edit"><i
                                                    class="fas fa-eye"></i></a>
                                            <a href="{{ route('product.delete',$row->id) }}"
                                                class="btn btn-danger btn-sm edit" id="deleteBtn"><i
                                                    class="fas fa-trash"></i></a>

                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody> --}}
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </section>


</div>
@endsection


@push('script')

<script>
    $(document).ready(function(){
    $('body').on('click','.dactive_featured',function(e){
        e.preventDefault();
        let id = $(this).data('id');
       $.get(" {{ url('admin/product/dactive-featured') }}/"+id,function(data,status){
        if (status == 'success') {
            table.ajax.reload()
    }

       })
    })


    $('body').on('click','.active_featured',function(e){
        e.preventDefault();
        let id = $(this).data('id');
       $.get(" {{ url('admin/product/active-featured') }}/"+id,function(data,status){
        if (status == 'success') {
            table.ajax.reload()
    }

       })
    })

    let table = new DataTable('#productTabele',{
        serverside:true,
        processing:true,
        searching:true,
        ajax: {
        url: "{{ route('product.index') }}",
        data:function(d){
            d.cateogry_id = $('#category_id').val();
            d.brand_id = $('#brand_id').val();
            d.warehouse_id = $('#warehouse_id').val();
            d.status = $('#status').val();
        }
      },
      columns:[
        {data:'id',name:'id'},
        {data:'thumbnail',name:'name',
            render:function(data){
                return `<img src="${data}" alt='thumbnail'  style="width: 40px;height:35px;border-radius:2px" />`;
            }
        },
        {data:'name',name:'name'},
        { data: 'code', name: 'code' },
        { data: 'category', name: 'category' },
        { data: 'subcategory', name: 'subcategory' },
         { data: 'brand', name: 'brand' },
        { data: 'featured', name: 'featured' },
        { data: 'today_deal', name: 'today_deal' },
        { data: 'status', name: 'status' },
        { data: 'action', name: 'action', orderable: false, searchable: false },
      ]
    });



    $(document).on('change','.submitable',function (){
        table.ajax.reload();
      })


})
</script>

@endpush