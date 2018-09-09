<div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="delete-modal-title">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="delete-modal-title">{{ __('app.confirm_delete_header') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="delete-modal-body">
                {{ __('app.confirm_delete') }}
            </div>
            <div class="modal-footer">
                <button id="delete-cancel" type="button" class="btn btn-sm btn-primary" data-dismiss="modal">
                    <span class="icon"><i class="fa fa-ban"></i></span>
                    {{ __('app.cancel') }}
                </button>
                <button id="delete-confirm" data-table="#" data-route="#" data-token="{{ csrf_token() }}" type="button" class="btn btn-sm btn-danger" dusk="delete-button">
                    <span class="icon"><i class="fa fa-trash"></i></span>
                    {{ __('app.delete') }}
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript">
        $(document).on('click', "[data-target='destroy-model']", function () {
            // Make sure we're not disabled
            if (!$(this).attr('disabled')) {
                // Show the modal
                let modal = $('#delete-modal');
                let deleteButton = $('#delete-modal').find('#delete-confirm');

                // Show the modal
                modal.modal('show');

                // Set name and title
                let name = $(this).data('name');
                let title = "{{ __('app.delete_model_title') }}";
                title = title.replace(":name", name);
                let body = "{{ __('app.delete_model_body') }}";
                body = body.replace(":name", name);

                modal.find('#delete-modal-title').html(title);
                modal.find('#delete-modal-body').html(body);

                // Set the route for the delete button
                let route = $(this).data('route');
                deleteButton.data('route', route);

                let table = $(this).parents('table');
                deleteButton.data('table', table.attr('id'));
            }
        });

        $(document).on('click', "#delete-confirm", function () {
            let token = $(this).data('token');
            let route = $(this).data('route');

            // Close the modal
            let modal = $('#delete-modal');
            modal.modal('hide');

            let table = $(this).data('table');

            $.ajax({
                url: route,
                type: 'POST',
                data: {_method: 'delete', _token: token},
                success: function (result) {
                    let dataTable = $('#' + table).DataTable();
                    // Redraw the datatable
                    dataTable.draw();
                }
            });
        });
    </script>
@endpush