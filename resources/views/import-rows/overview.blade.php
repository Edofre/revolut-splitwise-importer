@extends('layouts.app')

@section('title')
    {{ __('import.import_file') }}
@endsection

@section('content')
    <div class="col-md-6">
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-file-import"></i> {{ __('import-row.overview') }}
            </div>
            <div class="card-body">
                @foreach($importRows as $importRow)
                    @include('import-rows._import-row', ['importRow' => $importRow])
                @endforeach
            </div>
        </div>
    </div>
@endsection

@push('styles')

@endpush

@push('scripts')

@endpush