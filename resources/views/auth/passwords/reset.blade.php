@extends('layouts.master')

@section('content')
<header class="intro">
    <div class="container">
        <div class="intro-card">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        {{-- Header --}}
                        <div class="card-header text-left"><h5>@lang('passwords.resetPasswordTitle')</h5></div>
                        {{-- Body --}}
                        <form method="POST" action="{{ route('password.request') }}">
                            @csrf
                        <div class="card-body">
                            <input type="hidden" name="token" value="{{ $token }}">
                            {{-- Email --}}
                            <div class="form-group row">
                                <label for="email" class="col-md-3 col-form-label text-md-right">@lang('passwords.emailLabel')</label>
                                <div class="col-md-9">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>
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
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
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
                        <div class="card-footer">
                            <div class="form-group row mb-0">
                                <div class="col-md-9 offset-md-3 text-right">
                                    <button type="submit" class="btn btn-primary">@lang('messages.button.resetPassword')</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>





