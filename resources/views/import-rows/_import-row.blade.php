<div class="card p-2 mb-1" data-row-id="{{ $importRow->id }}">
    <div class="form-row">
        <div class="col-md-8">
            <input name="rows[reference][{{ $importRow->id }}]" id="rows[reference][{{ $importRow->id }}]" value="{{ $importRow->splitwiseReference }}" class="form-control">
        </div>
        <div class="col-md-3">
            <input name="rows[price][{{ $importRow->id }}]" id="rows[price][{{ $importRow->id }}]" value="{{ $importRow->paid_out }}" class="form-control">
        </div>
        <div class="col-md-1">
            <div class="btn btn-danger" data-remove-row-id="{{ $importRow->id }}">
                <i class="fas fa-times-circle"></i>
            </div>
        </div>
    </div>
</div>


