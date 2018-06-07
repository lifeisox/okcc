<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            {{-- Header --}}
            <div class="modal-header">
                <h4 class="modal-title" id="editModalTitle">@lang('admin.title.userEdit')</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="false">&times;</span>
                </button>
            </div>
            <form id="editForm">
            {{-- Body --}}
            <div class="modal-body">
                {{--  User name  --}}
                <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label text-right">@lang('admin.table.userName')</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="name" name="name" placeholder="@lang('admin.table.userName')">
                    </div>
                </div>
                {{-- Email  --}}
                <div class="form-group row">
                    <label for="email" class="col-sm-3 col-form-label text-right">@lang('admin.table.userEmail')</label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control" id="email" name="email" placeholder="@lang('admin.table.userEmail')">
                    </div>
                </div>
                {{-- Privilege  --}}
                <div class="form-group row">
                    <label for="privileges" class="col-sm-3 col-form-label text-right">@lang('admin.table.userStatus')</label>
                    <div class="col-sm-9">
                        <select id="editPrivilegeCombo" class="form-control" name="privilege" data-placeholder="@lang('admin.table.userStatus')">
                        </select>
                    </div>
                </div>
            </div>
            {{-- Footer --}}
            <div class="modal-footer">
                {{-- Buttons --}}
                <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal"><span class="fas fa-times mr-1"></span>@lang('admin.modal.cancelButton')</button>
                <button type="button" class="btn btn-info editButton"><span class="fas fa-check mr-1"></span>@lang('admin.modal.saveButton')</button>
            </div>
            </form>
        </div>
    </div>
</div>