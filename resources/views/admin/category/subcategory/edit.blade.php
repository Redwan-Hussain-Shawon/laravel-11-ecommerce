<form method="POST" action="{{route('subcategory.update',$data->id)}}">
    @csrf
    <div class="modal-body">

        <div class="form-group">
            <label for="category_name"> Category Name</label>
            <select name="category_id" id="" class="form-control" required>
              @foreach ($category as $row )
              <option value="{{ $row->id }}" @if($row->id==$data->category_id) selected @endif>{{$row->category_name}}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label for="subcategory_name">Sub Category Name</label>
            <input type="text" class="form-control" id="subcategory_name" value="{{ $data->subcategory_name }}" name="subcategory_name" required>
            <small id="category_name" class="form-text text-muted">This is your main Sub Category</small>
          </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      <button type="submit" class="btn btn-primary">Update</button>
    </div>
  </form>