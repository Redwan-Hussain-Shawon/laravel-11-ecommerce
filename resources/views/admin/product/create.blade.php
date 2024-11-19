@extends('layouts.admin')

@section('admin-content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" rel="stylesheet">

<style>
    /* .bootstrap-tagsinput .tag{
        background: #007bff;
        padding: 5px;
        border-radius: 4px
    } */
    .bootstrap-tagsinput{
        width: 100%;
        padding:8px;
        display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 6px;
    }
</style>
<div class="content-wrapper" style="min-height: 458px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Product</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Add New Product</h3>
                            </div>
                            @if ($errors->any())
                            <div class="alert alert-default-danger m-2">
                                {{ $errors->first() }}
                            </div>
                            @endif
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label for="name">Product Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="enter product name" required value="{{old('name')}}">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="code">Product Code <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="code" name="code"
                                            placeholder="enter product code" required value="{{old('code')}}">
    
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label for="subcategory_id">Category/Subcategory <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" name="subcategory_id" id="subcategory_id" required>
                                            @foreach ($category as $row )
                                            <option disabled style="color: blue"><b>{{
                                                    $row->category_name }}</b></option>
                                            @php
                                            $subcategory =
                                            DB::table('subcategories')->where('category_id',$row->id)->get()
                                            @endphp
                                            @forelse ($subcategory as $row )
                                            <option value="{{ $row->id }}">--{{$row->subcategory_name }}---</option>
                                            @empty

                                            @endforelse
                                            @endforeach

                                        </select>
                                        @error('subcategory_id')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                        @enderror

                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="childcategory_id">Child Category <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" name="childcategory_id" id="childcategory_id">
                                            <option value="">Select a Sub Category</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label for="brand_id">Brand <span class="text-danger">*</span></label>
                                        <select class="form-control" name="brand_id" id="brand_id">
                                            @foreach ($brand as $row )
                                            <option value="{{ $row->id}}">{{ $row->brand_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('brand_id')
                                        <div class="alert alert-default-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="pickup_point_id">Pickup Point <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" name="pickup_point_id" id="pickup_point_id">
                                            @foreach ($pickup_point as $row )
                                            <option value="{{ $row->id}}">{{ $row->pickup_point_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label for="unit">Unit <span class="text-danger">*</span></label>
                                        <select class="form-control" name="unit" id="unit">
                                            <option value="1">1</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="warehouse">Warehouse <span class="text-danger">*</span></label>
                                        <select class="form-control" name="warehouse" id="warehouse">
                                            @foreach ($warehouse as $row )
                                            <option value="{{ $row->id }}">{{ $row->warehouse_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <label for="purchase_price">Purchase Price</label>
                                        <input type="text" class="form-control" id="purchase_price"
                                            name="purchase_price">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="selling_price">Selling Price <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="selling_price" name="selling_price"
                                            required value="{{old('selling_price')}}">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="discount_price">Discount Price <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="discount_price"
                                            name="discount_price">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label for="tags">Tags</label>
                                        <input type="text" class="form-control tag-input" id="tags " name="tags" >
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="stock_quantity">Stock</label>
                                        <input type="text" class="form-control" id="stock_quantity"
                                            name="stock_quantity">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label for="color">Color</label>
                                        <input type="text" class="form-control tag-input" id="color " name="color">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="size">Size</label>
                                        <input type="text" class="form-control tag-input" id="size" name="size" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="description">Product Details</label>
                                    <textarea name="description" id="description" class="form-control" cols="30"
                                        rows="10"></textarea>
                                    @error('description')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="thumbnail">Main Thumbnail <span class="text-danger">*</span></label>
                                    <input type="file" name="thumbnail" id="thumbnail">
                                </div>
                                <div class="form-group">
                                    <table class="table">
                                        <tbody id="dynamic_field">
                                            <tr class="dynamic_added">
                                                <td><input type="file" accept="image/*" name="images[]"
                                                        class="form-control  name_list"></td>
                                                <td><button type="button" class="btn btn-success" id="add">Add</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="form-group card p-3">
                                    <label for="featured">Featured Product</label>
                                    <div class="bootstrap-switch-wrapper">
                                        <div class="bootstrap-switch-container">
                                            <span class="bootstrap-switch-label">&nbsp;</span>
                                            <input type="checkbox" id="featured" name="featured" checked
                                                data-bootstrap-switch>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group card p-3">
                                    <label for="today_deal">Today Deal </label>
                                    <div class="bootstrap-switch-wrapper">
                                        <div class="bootstrap-switch-container">
                                            <span class="bootstrap-switch-label">&nbsp;</span>
                                            <input type="checkbox" id="today_deal" name="today_deal" checked
                                                data-bootstrap-switch>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group card p-3">
                                    <label for="status">Status </label>
                                    <div class="bootstrap-switch-wrapper">
                                        <div class="bootstrap-switch-container">
                                            <span class="bootstrap-switch-label">&nbsp;</span>
                                            <input type="checkbox" id="status" name="status" checked
                                                data-bootstrap-switch>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </form>
        </div>
</div>
</div>
</section>

@endsection

@push('script')
<script src="{{asset('public/backend/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>
<!-- Bootstrap Tags Input Plugin JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
<script>
    $(function () {
    $('#description').summernote()
  })

  $('#thumbnail').dropify({
    messages: {
    	'default': 'Drag and drop file',
    	'replace': 'Drag and drop or click to replace',
    	'remove':  'Remove',
      'error':   'Sorry, this file is too large'
    }
}
    )

    $(document).ready(function(){
        let i =1;

        $('#add').click(function(){
            $('#dynamic_field').append(`<tr class="dynamic_added" id="row_${i}">
                                                <td><input type="file" accept="image/*" name="images[]"
                                                        class="form-control  name_list"></td>
                                                <td><button type="button" class="btn btn-danger" data-id="row_${i}" id="btn_remove">X</button></td>
                                            </tr>`)
        })

    $(document).on('click','#btn_remove',function(){
    let parent_id = $(this).data('id');
    $('#' + parent_id).hide(300, function () {
        $(this).remove();
    });
});


$("input[data-bootstrap-switch]").each(function () {
    $(this).bootstrapSwitch('state', $(this).prop('checked'));
    $(this).val($(this).prop('checked') ? 1 : 0);
});

    $('#subcategory_id').change(function(){
        let id = $(this).val();
        $('select[name="childcategory_id"]').empty();
        $.get("{{ url('admin/childcategory/get-childcategory')}}/"+id, function(data, status){
             if(status == 'success'){
                if(data.length>0){
                data.forEach(subcategory => {
                $('select[name="childcategory_id"]').append(`
                <option value="${subcategory.id}">${subcategory.childcategory_name}</option
                `)
            });
        }else{
            $('select[name="childcategory_id"]').append(`
                <option value="">No childcategory available</option
                `)
        }
             }
         });
    })


    $('.tag-input').tagsinput({
        tagClass: 'badge bg-primary text-white',  // Style each tag with AdminLTE classes
        confirmKeys: [13],  // Allow the 'Enter' key to add tags
        trimValue: true     // Remove any trailing spaces
    });


    })
</script>
</script>
@endpush