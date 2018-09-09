@extends('layouts.app')

@section('title')
    {{ __('import.import_name', ['name' => $import->name]) }}
@endsection

@section('content')
    <div class="col-md-10">
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-file-import"></i> {{ $import->name }}
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-md-12">
                        <dl class="dl-horizontal">
                            <dt>{{ __('import.id') }}</dt>
                            <dd>{{ $import->id }}</dd>

                            <dt>{{ __('import.name') }}</dt>
                            <dd>{{ $import->name }}</dd>

                            <dt>{{ __('import.file_name') }}</dt>
                            <dd>{{ $import->file_name }}</dd>

                        </dl>
                    </div>
                </div>
            </div>
            <div class="card-footer small text-muted">
                <span class="created-at">
                    {{ __('import.created_at') }}
                    <strong>{{ !is_null($import->created_at) ? $import->created_at->format('Y-m-d H:i:s') : '-' }}</strong>
                </span>
            </div>
        </div>
    </div>


    <div class="col-md-10">
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-tasks"></i> {{ __('import.import_rows') }}
            </div>
            <div class="card-body">
                @if($importRows->isEmpty())
                    <div class="form-row text-center">
                        <div class="col-12">
                            <a href="{{ route('import.process', ['import' => $import->id]) }}" class="btn btn-primary">
                                <i class="fas fa-cogs"></i> {{ __('import.no_rows_process_now') }}
                            </a>
                        </div>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm" data-datatable-import-rows width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th scope="col">{{ __('import-row.id') }}</th>
                                <th scope="col">{{ __('import-row.completed_date') }}</th>
                                <th scope="col">{{ __('import-row.reference') }}</th>
                                <th scope="col">{{ __('import-row.paid_out') }}</th>
                                <th scope="col">{{ __('import-row.category') }}</th>
                                <th scope="col">&nbsp;</th>
                            </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection

@push('styles')

@endpush

@push('scripts')
    @if($importRows->isNotEmpty())
        <script type="text/javascript">
            $('[data-datatable-import-rows]').DataTable({
                ajax: {
                    url: route('import.rows.data', ['{{ $import->id }}'])
                },
                paging: false,
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'completed_date', name: 'completed_date'},
                    {data: 'reference', name: 'reference'},
                    {data: 'paid_out', name: 'paid_out'},
                    {data: 'category', name: 'category'},
                    {data: 'action', name: 'action', searchable: false, orderable: false}
                ]
            });
        </script>
    @endif

@endpush