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

            <div class="file">
                <label class="file-label">
                    <input class="file-input" type="file" name="resume">
                    <span class="file-cta">
                        <span class="file-icon">
                            <i class="fas fa-upload"></i>
                        </span>
                        <span class="file-label">
                            Choose a file…
                        </span>
                    </span>
                </label>
            </div>

        </div>
    </section>
@endsection

@section('styles')

@endsection

@section('scripts')

@endsection