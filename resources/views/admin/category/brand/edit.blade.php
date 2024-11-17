<form method="POST" action="{{route('brand.update')}}" enctype="multipart/form-data">
    @csrf
    <div class="modal-body">
      <div class="form-group">
        <label for="subcategory_name">Brand Name</label>
        <input type="text" class="form-control" id="brand_name" name="brand_name" value="{{$data->brand_name}}" required>
        <small id="category_name" class="form-text text-muted">This is your main brand name</small>
      </div>
      <input type="hidden" name="id" value="{{$data->id}}">
         <div class="form-group">
        <label for="subcategory_name">Brand Image</label>
        <input type="file" class="form-control dropify" id="brand_logo" name="brand_logo"  data-disable-remove="true" data-default-file="{{asset($data->brand_logo)}}" >
        <small id="category_name" class="form-text text-muted">This is your brand logo</small>
        <input type="hidden" name="old_brand_logo" value="{{$data->brand_logo}}">
      </div>

    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      <button type="submit" class="btn btn-primary">Save</button>
    </div>
  </form>


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
      </script>