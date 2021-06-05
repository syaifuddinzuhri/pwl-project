<form action="{{route('customer.uploadbukti', $data->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="modal-body">
        <div class="alert alert-info">
            Silahkan transfer pembayaran sewa mobil ke Nomor Rekening 1234xxxx
        </div>
        <div class="form-group form-primary ">
            <label for="proof_of_payment">Upload Bukti Pembayaran</label>
            <input type="file" class="form-control" name="proof_of_payment" id="proof_of_payment" accept="image/*" required>
            <span class="form-bar"></span>
            @error('proof_of_payment')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-outline-secondary" data-dismiss="modal"><i class="fa fa-mail-reply"></i>Close</button>
        <button type="submit" class="btn btn-sm btn-primary">Submit</button>
    </div>
</form>
