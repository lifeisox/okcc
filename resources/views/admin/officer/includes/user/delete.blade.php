<div class="modal draggable fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="deleteModalTitle">@lang('admin.title.userDelete')</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body bg-dark text-warning" style="font-size: 1.3em;">
                <div class="container col-sm-11" id="deleteBody">@lang('admin.modal.confirmMessage')</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal"><span class="fas fa-times mr-1"></span>@lang('admin.modal.cancelButton')</button>
                <button type="button" class="btn btn-danger deleteButton"><span class="fas fa-trash-alt mr-1"></span>@lang('admin.modal.deleteButton')</button>
            </div>
        </div>
    </div>
</div>