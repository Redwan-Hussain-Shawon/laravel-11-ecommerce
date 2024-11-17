<form method="POST" action="{{route('warehouse.update')}}">
    @csrf
    <div class="modal-body">

        <div class="form-group">
            <label for="warehouse_name">Warehouse Name</label>
            <input type="text" class="form-control" id="warehouse_name" name="warehouse_name" required
                placeholder="warehouse name" value="{{ $data->warehouse_name }}">
        </div>
        <div class="form-group">
            <label for="warehouse_phone">Warehouse Phone</label>
            <input type="text" class="form-control" id="warehouse_phone" name="warehouse_phone" required
                placeholder="warehouse phone" value="{{ $data->warehouse_phone }}">
        </div>
        <div class="form-group">
            <label for="warehouse_address">Warehouse Address</label>
            <input type="text" class="form-control" id="warehouse_address" name="warehouse_address"
                required placeholder="warehouse address" value="{{ $data->warehouse_address }}">
        </div>
        <input type="hidden" name="id" value="{{$data->id}}">

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>