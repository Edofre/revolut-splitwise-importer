<div class="form-row">
    <div class="form-group col-md-6">
        <label for="reference[{{ $importRow->id }}]">{{ __('import-row.reference') }}</label>
        <input id="reference[{{ $importRow->id }}]" value="{{ $importRow->splitwiseReference }}" class="form-control">
    </div>
    <div class="form-group col-md-6">
        <label for="price[{{ $importRow->id }}]">{{ __('import-row.paid_out') }}</label>
        <input id="price[{{ $importRow->id }}]" value="{{ $importRow->paid_out }}" class="form-control">
    </div>
</div>
