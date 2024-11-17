<form method="POST" action="{{ route('pickuppoint.update') }}">
    @csrf
    <div class="modal-body">

        <div class="form-group">
            <label for="pickup_point_name">Pickup Point Name</label>
            <input type="text" class="form-control" id="pickup_point_name" name="pickup_point_name" required
                placeholder="pickup point name" value="{{ $data->pickup_point_name }}">
        </div>
        <div class="form-group">
            <label for="pickup_point_phone">Pickup Point Phone</label>
            <input type="text" class="form-control" id="pickup_point_phone" name="pickup_point_phone" required
                placeholder="pickup point phone" value="{{ $data->pickup_point_phone }}">
        </div> 
        <input type="hidden" name="id" value="{{ $data->id }}">
        <div class="form-group">
            <label for="pickup_point_phone_two">Pickup Point Phone Two</label>
            <input type="text" class="form-control" id="pickup_point_phone_two" name="pickup_point_phone_two" 
                placeholder="pickup point phone two" value="{{ $data->pickup_point_phone_two }}">
        </div>
        <div class="form-group">
            <label for="pickup_point_address">Pickup Point Address</label>
            <input type="text" class="form-control" id="pickup_point_address" name="pickup_point_address" required
                placeholder="pickup point address" value="{{ $data->pickup_point_address }}">
        </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="saveBtn">Save</button>
    </div>
</form>