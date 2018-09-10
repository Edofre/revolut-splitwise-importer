@extends('layouts.app')

@section('title')
    {{ __('import.import_file') }}
@endsection

@section('content')
    <div class="col-md-10">
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-file-import"></i> {{ __('import-row.overview') }}
            </div>
            {!!  Form::open(['route' => ['import.rows.send', $import]]) !!}
            <div class="card-body">
                @foreach($importRows as $importRow)
                    @include('import-rows._import-row', ['importRow' => $importRow])
                @endforeach
            </div>
            <div class="card-footer">
                {!! Form::button(__('import.upload'), ['type' => 'submit','class' => 'btn btn-primary mb-2']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@push('styles')

@endpush

@push('scripts')
    <script type="text/javascript">
        $(document).on('click', "[data-remove-row-id]", function () {
            // Fetch the id of the row we just clicked
            var id = $(this).data('remove-row-id');
            // Properly remove it
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: route('import.rows.destroy', [id]),
                type: 'DELETE',
                success: function () {
                    // Remove the row
                    $('[data-row-id="' + id + '"]').remove();
                }
            });
        });
    </script>
@endpush