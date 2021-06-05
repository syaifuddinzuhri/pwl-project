<form action="{{route('car.updatestatus', $data->id)}}" method="POST">
    <div class="modal-body">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" id="status_tersedia" value="1" {{ $data->status == 1 ? 'checked' : ''}}>
                    <label class="form-check-label" for="status_tersedia">
                        Tersedia
                    </label>
                </div>
            </div>
            <div class="col">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" id="status_tidak_tersedai" value="0" {{ $data->status == 0 ? 'checked' : ''}}>
                    <label class="form-check-label" for="status_tidak_tersedai">
                        Tidak Tersedia
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-outline-secondary" data-dismiss="modal"><i class="fa fa-mail-reply"></i>Close</button>
        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i>Simpan</button>
    </div>
</form>
