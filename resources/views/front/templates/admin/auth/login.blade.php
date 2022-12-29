@extends('front.partials.admin.auth-layout')

@section('title', trans('dictionary.login'))

@section('content')
    <form class="auth-login-form mt-3" method="post" action="{{ route('admin.login') }}">
        @csrf

        <div class="form-group">
            <label class="form-label">@lang('dictionary.email')</label>
            <input type="email" class="form-control" name="email" placeholder="fulanodetal@exemplo.com">
        </div>

        <div class="form-group">
            <label class="form-label">@lang('dictionary.password')</label>
            <input type="password" class="form-control" name="password" placeholder="******">
        </div>

        <div class="d-block block-forgot">
            <a href="{{ route('admin.password.email') }}" class="text-white">
                <small>@lang('auth.forgot')</small>
            </a>
        </div>

        <div class="clearfix text-center">
            <button type="submit" class="btn btn-success">@lang('dictionary.login')</button>
        </div>
    </form>
@endsection