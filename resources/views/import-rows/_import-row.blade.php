<div class="card p-2 mb-1" data-row-id="{{ $importRow->id }}">
    <div class="form-row">
        <div class="col-md-8">
            <input name="rows[{{ $importRow->id }}][reference]" id="rows[{{ $importRow->id }}][reference]" value="{{ $importRow->splitwiseReference }}" class="form-control">
        </div>
        <div class="col-md-3">
            <input name="rows[{{ $importRow->id }}][price]" id="rows[{{ $importRow->id }}][price]" value="{{ $importRow->paid_out }}" class="form-control">
        </div>
        <div class="col-md-1">
            <div class="btn btn-danger" data-remove-row-id="{{ $importRow->id }}">
                <i class="fas fa-times-circle"></i>
            </div>
        </div>
    </div>
</div>


