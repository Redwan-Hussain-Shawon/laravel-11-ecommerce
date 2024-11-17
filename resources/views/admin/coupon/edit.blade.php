<form method="POST" action="{{ route('coupon.update') }}">
    @csrf
    <div class="modal-body">

        <div class="form-group">
            <label for="coupon_code">Coupon Code</label>
            <input type="text" class="form-control" id="coupon_code" name="coupon_code" required
                placeholder="coupon code" value="{{$data->coupon_code}}">
        </div>
        <div class="form-group">
            <label for="type">Coupon Type</label>
            <select name="type" id="type" class="form-control">
                <option value="1" {{ $data->type==1 ? 'selected' : ''}}>Fixed</option>
                <option value="2" {{ $data->type==2 ? 'selected' : ''}} >Percentage</option>
            </select>
        </div>
        <input type="hidden" name="id" value="{{ $data->id }}">
        <div class="form-group">
            <label for="coupon_amount">Coupon Amount</label>
            <input type="text" class="form-control" id="coupon_amount" name="coupon_amount" required
                placeholder="coupon amount" value="{{$data->coupon_amount}}">
        </div>
        <div class="form-group">
            <label for="valid_date">Valid Date</label>
            <input type="date" class="form-control" id="valid_date" name="valid_date" required
                placeholder="valid date" value="{{$data->valid_date}}">
        </div>
        <div class="form-group">
            <label for="status">Coupon Status</label>
            <select name="status" id="status" class="form-control">
                <option value="1" {{ $data->status==1 ? 'selected' : ''}}>Active</option>
                <option value="2" {{ $data->status==2 ? 'selected' : ''}}>Inactive </option>
            </select>
        </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="saveBtn">Save</button>
    </div>
</form>