<div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="signupModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            {{-- Header --}}
            <div class="modal-header">
                <h5 class="modal-title" id="sighupModalTitle">@lang('passwords.signupTitle')</h5>
            </div>
            {{-- Body --}}
            <form id="sighupForm" method="POST" action="{{ route('register') }}">
                @csrf
            <div class="modal-body">
                <div class="form-group row text-center">
                    <h6 class="col-md-12 pb-2 text-secondary">@lang('passwords.signupHeader')</h6>
                </div>
                {{-- User Name --}}
                <div class="form-group row">
                    <label for="name" class="col-md-3 col-form-label text-md-right">@lang('passwords.userNameLabel')</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                        @if ($errors->has('name'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                {{-- Email Address --}}
                <div class="form-group row">
                    <label for="email" class="col-md-3 col-form-label text-md-right">@lang('passwords.emailLabel')</label>
                    <div class="col-md-9">
                        <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                {{-- Password --}}
                <div class="form-group row">
                    <label for="password" class="col-md-3 col-form-label text-md-right">@lang('passwords.passwordLabel')</label>
                    <div class="col-md-9">
                        <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                {{-- Password Confirm --}}
                <div class="form-group row">
                    <label for="password-confirm" class="col-md-3 col-form-label text-md-right">@lang('passwords.confirmPasswordLabel')</label>
                    <div class="col-md-9">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times-circle mr-2"></i>@lang('messages.button.close')</button>
                <button type="submit" class="btn btn-primary"><i class="fas fa-sign-in-alt mr-2"></i>@lang('messages.button.register')</button>
            </div>
            </form>
        </div>
    </div>
</div>
