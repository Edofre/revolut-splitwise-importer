@extends('layouts.app')

@section('title')
    {{ __('import.import_name', ['name' => $import->name]) }}
@endsection

@section('content')
    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-file-import"></i> {{ $import->name }}
        </div>
        <div class="card-body">
            <?php var_dump($import->getAttributes()) ?>
        </div>
    </div>
@endsection

@push('styles')

@endpush

@push('scripts')

@endpush