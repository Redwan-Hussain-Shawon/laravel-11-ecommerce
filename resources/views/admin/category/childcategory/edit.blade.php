<form method="POST" action="{{route('childcategory.update',$child_cat->id)}}" id="add-form">
    @csrf
    <div class="modal-body">
      <div class="form-group">
        <label for="category_name"> Category / Subcategory Name</label>
        <select name="subcategory_id" id="" class="form-control" required>
          @foreach ($category as $row )
          @php 
            $subcat = DB::table('subcategories')->where('category_id',$row->id)->get();
          @endphp
          <option disabled style="color: blue">{{$row->category_name}}</option>
          @foreach ($subcat as $sub_row )
          <option value="{{ $sub_row->id }}" @if($sub_row->id == $child_cat->subcategory_id) selected @endif > ----- {{$sub_row->subcategory_name}}</option>
          @endforeach
          @endforeach
        </select>
      </div>

      <div class="form-group">
        <label for="subcategory_name">Child Category Name</label>
        <input type="text" class="form-control" id="childcategory_name" name="childcategory_name" required value="{{$child_cat->childcategory_name}}">
        <small id="category_name" class="form-text text-muted">This is your main Child Category</small>
      </div>

    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      <button type="submit" class="btn btn-primary"><span class="d-none">loading....</span>Submit</button>
    </div>
  </form>