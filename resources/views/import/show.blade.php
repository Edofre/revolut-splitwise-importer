@extends('layouts.app')

@section('title')
    {{ __('import.import_name', ['name' => $import->name]) }}
@endsection

@section('content')
    <section class="hero is-primary">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    <span class="icon">
                        <i class="fas fa-file-import"></i>
                    </span>
                    &nbsp;{{ __('import.import_name', ['name' => $import->name]) }}
                </h1>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">

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