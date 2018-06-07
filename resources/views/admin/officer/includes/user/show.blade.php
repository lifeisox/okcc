<div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="showModalTitle">@lang('admin.title.userShow')</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container col-sm-12">
                    <div class="row py-2">
                        <div class="col-sm-3 text-right py-2">@lang('admin.table.userName')</div>
                        <div class="col-sm-9 rounded bg-light py-2"><span class="align-middle" name="name"></span></div>
                    </div>
                    <div class="row py-2">
                        <div class="col-sm-3 text-right py-2">@lang('admin.table.userEmail')</div>
                        <div class="col-sm-9 rounded bg-light py-2"><span class="align-middle" name="email"></span></div>
                    </div>
                    <div class="row py-2">
                        <div class="col-sm-3 text-right py-2">@lang('admin.table.userStatus')</div>
                        <div class="col-sm-9 rounded bg-light py-2"><span class="align-middle" name="privilege"></span></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer text-right">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><span class="fas fa-times mr-1"></span>@lang('admin.modal.closeButton')</button>
            </div>
        </div>
    </div>
</div>