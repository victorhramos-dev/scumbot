@extends('front.partials.admin.auth-layout')

@section('title', trans('auth.reset-password'))

@section('content')
    <h2 class="card-title font-weight-bold mt-2 mb-1 text-white text-center">@lang('auth.reset-password')</h2>

    <p class="card-text mb-2 text-white text-center">Informe seu email e sua nova senha para concluir a alteração.</p>

    <form class="auth-reset-password-form mt-2" method="post" action="{{ route('admin.password.save') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-group">
            <label class="form-label">@lang('dictionary.email')</label>
            <input type="email" class="form-control" name="email" placeholder="fulanodetal@exemplo.com">
        </div>

        <div class="form-group">
            <label class="form-label">@lang('dictionary.password')</label>
            <input type="password" class="form-control" name="password" placeholder="********">
        </div>

        <div class="form-group">
            <label class="form-label">@lang('auth.password-confirmation')</label>
            <input type="password" class="form-control" name="password_confirmation" placeholder="********">
        </div>

        <div class="clearfix text-center">
            <button type="submit" class="btn btn-success mt-2">
                @lang('auth.reset-password')
            </button>
        </div>
    </form>
@endsection