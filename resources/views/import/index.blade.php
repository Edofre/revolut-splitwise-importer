@extends('layouts.app')

@section('title')
    {{ __('import.import_file') }}
@endsection

@section('content')
    <section class="hero is-primary">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    <span class="icon">
                        <i class="fas fa-file-import"></i>
                    </span>
                    &nbsp;{{ __('import.import_file') }}
                </h1>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="field is-horizontal">
                {!!  Form::open(['route' => 'import.upload', 'files' => true]) !!}
                <div class="field-body">
                    <div class="file">
                        <label class="file-label">
                            {!! Form::file('revolut-export', ['class' => 'file-input', 'accept' => '.csv']) !!}
                            <span class="file-cta">
                                <span class="file-icon">
                                    <i class="fas fa-upload"></i>
                                </span>
                                <span class="file-label">{{ __('import.choose_file') }}</span>
                            </span>
                            <span class="file-name hide-on-load" data-file-name></span>
                        </label>
                    </div>
                    <div class="field">
                        <button class="button is-success" type="submit">{{ __('import.upload') }}</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>

        </div>
    </section>
@endsection

@push('styles')

@endpush

@push('scripts')
    <script type="text/javascript">
        $('input[type=file]').change(function (e) {

            var fileName = e.target.files[0].name;
            var element = $('[data-file-name]');

            element.html(fileName);
            element.show();
        })
    </script>
@endpush