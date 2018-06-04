<div class="modal fade" id="sendEmailModal" tabindex="-1" role="dialog" aria-labelledby="sendEmailModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            {{-- Header --}}
            <div class="modal-header">
                <h5 class="modal-title" id="sendEmailModalTitle">@lang('passwords.resetPasswordTitle')</h5>
            </div>
            {{-- Body --}}
            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif
            <form id="sendEmailForm" method="POST" action="{{ route('password.email') }}">
                @csrf
            <div class="modal-body">
                {{-- Email Address --}} 
                <div class="form-group row">
                    <label for="email" class="col-md-3 col-form-label text-md-right">@lang('passwords.emailLabel')</label>
                    <div class="col-md-9">
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times-circle mr-2"></i>@lang('messages.button.close')</button>
                <button type="submit" class="btn btn-primary">@lang('messages.button.sendResetLink')</button>
            </div>
            </form>
        </div>
    </div>
</div>
