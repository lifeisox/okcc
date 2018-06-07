<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            {{-- Header --}}
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalTitle">@lang('passwords.loginTitle')</h5>
            </div>
            {{-- Body --}}
            <form id="loginForm" method="POST" action="{{ route('login') }}">
                @csrf
            <div class="modal-body">
                {{-- Email Address --}}
                <div class="form-group row">
                    <label for="email" class="col-sm-3 col-form-label text-md-right">@lang('passwords.emailLabel')</label>
                    <div class="col-md-9">
                        <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
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
                {{-- Remember --}}
                <div class="form-group row">
                    <div class="col-md-9 offset-md-3">
                        <div class="checkbox">
                            <label>
                                <input class="mr-2" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> @lang('passwords.rememberLabel')
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times-circle mr-2"></i>@lang('messages.button.close')</button>
                <button type="button" class="btn btn-info" data-dismiss="modal" data-toggle="modal" data-target="#sendEmailModal">@lang('messages.button.forgotPassword')</button>
                <button type="button" class="btn btn-success" data-dismiss="modal" data-toggle="modal" data-target="#signupModal">@lang('messages.button.signup')</button>
                <button type="submit" class="btn btn-primary"><i class="fas fa-sign-in-alt mr-2"></i>@lang('messages.button.login')</button>
            </div>
            </form>
        </div>
    </div>
</div>
