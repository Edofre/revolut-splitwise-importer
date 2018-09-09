@extends('layouts.app')

@section('title')
    {{ __('import.import_file') }}
@endsection

@section('content')
    <div class="col-md-6">
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-file-import"></i> {{ __('import.import_file') }}
            </div>
            <div class="card-body">

                {!!  Form::open(['route' => 'import.upload', 'files' => true, 'class' => 'form-inline']) !!}

                <label class="sr-only" for="revolut-export">{{ __('import.import_file') }}</label>
                {!! Form::file('revolut-export', ['class' => 'form-control mb-2 mr-sm-2', 'accept' => '.csv']) !!}

                <button type="submit" class="btn btn-primary mb-2">{{ __('import.upload') }}</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@push('styles')

@endpush

@push('scripts')

@endpush