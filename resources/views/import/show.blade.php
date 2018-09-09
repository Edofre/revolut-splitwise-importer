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


    @if($importRows->isEmpty())
        <div class="col-md-10">
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-tasks"></i> {{ __('import.import_rows') }}
                </div>
                <div class="card-body">
                    <div class="form-row text-center">
                        <div class="col-12">
                            <a href="{{ route('import.process', ['import' => $import->id]) }}" class="btn btn-primary">
                                <i class="fas fa-cogs"></i> {{ __('import.no_rows_process_now') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="col-md-10">
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-tasks"></i> {{ __('import.import_rows') }}
                    <div class="pull-right">
                        <div data-action="remove-rows" class="btn btn-sm btn-danger btn-js disabled">
                            <span class="icon is-small"><i class="fa fa-trash"></i></span>
                            <span>{{ __('import-row.delete_rows') }}</span>
                            <span data-remove-rows-loader style="display: none"><i class='fas fa-spinner fa-spin'></i></span>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm" data-datatable-import-rows width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th scope="col">&nbsp;</th>
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
                </div>
            </div>
        </div>
    @endif
@endsection

@push('styles')

@endpush

@push('scripts')
    @if($importRows->isNotEmpty())
        <script type="text/javascript">
            // Keep track of selected items
            let selected = [];

            let importRowsDatatable = $('[data-datatable-import-rows]').DataTable({
                ajax: {
                    url: route('import.rows.data', ['{{ $import->id }}'])
                },
                paging: false,
                // Set a team attribute for the team
                createdRow: function (row, data) {
                    $(row).attr('data-id', data.id);
                },
                columns: [
                    {data: 'check', name: 'check', searchable: false, orderable: false},
                    {data: 'id', name: 'id'},
                    {data: 'completed_date', name: 'completed_date'},
                    {data: 'reference', name: 'reference'},
                    {data: 'paid_out', name: 'paid_out'},
                    {data: 'category', name: 'category'},
                    {data: 'action', name: 'action', searchable: false, orderable: false}
                ]
            });

            $(document).on('click', "[data-action='remove-rows']", function () {
                if ($(this).hasClass('disabled') === false) {
                    // Confirmation?
                    if (confirm("Are you sure you want to delete " + selected.length + " items?")) {
                        // Get our loading indicator
                        let loader = $('[data-remove-rows-loader]');
                        // Make ajax request to load the form
                        $.ajax({
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            url: route('import.rows.destroy.multiple'),
                            type: 'DELETE',
                            data: {
                                'import-rows': selected,
                            },
                            beforeSend: function (xhr) {
                                loader.show(); // Show the loader
                            },
                            complete: function () {
                                loader.hide(); // Hide the loader
                            },
                            success: function (result) {
                                // Refresh datatable
                                importRowsDatatable.draw();
                            }
                        });
                    }
                }
            });

            $('[data-datatable-import-rows] tbody').on('click', 'tr', function () {
                // Values from tr
                let id = $(this).data('id');

                if ($.inArray(id, selected) === -1) {
                    // Add the selected items in the arrays
                    selected.push(id);

                    // Enable the delete rows actions
                    if (selected.length !== 0) {
                        $("[data-action='remove-rows']").removeClass('disabled');
                    }

                    // Add a check in the checkbox and set the selected class for tr
                    $('input:checkbox', this).prop('checked', true);
                    $(this).addClass('selected');
                } else {
                    // Remove the unselected items from the arrays
                    selected.splice($.inArray(id, selected), 1);

                    // Disable all the bulk actions when no users are selected
                    if (selected.length === 0) {
                        $("[data-action='remove-rows']").addClass('disabled');
                    }
                    // Remove the check and selected class from tr
                    $('input:checkbox', this).prop('checked', false);
                    $(this).removeClass('selected');
                }
            });


        </script>
    @endif

@endpush