@extends('front.partials.admin.auth-layout')

@section('title', trans('auth.reset-password'))

@section('content')
    <h2 class="card-title font-weight-bold mt-2 mb-1 text-white text-center">@lang('auth.reset-password')</h2>

    <p class="card-text mb-2 text-white text-center">Você receberá no seu email uma mensagem contendo um link para alterar sua senha.</p>

    <form class="auth-forgot-password-form mt-2" method="post" action="{{ route('admin.password.request') }}">
        @csrf

        <div class="form-group">
            <label class="form-label">@lang('dictionary.email')</label>
            <input type="email" class="form-control" name="email" placeholder="fulanodetal@exemplo.com">
        </div>

        <div class="clearfix text-center">
            <button type="submit" class="btn btn-success mt-2">
                @lang('auth.send-link')
            </button>

            <p class="text-center mt-2">
                <a href="{{ route('admin.login') }}" class="text-white">
                    < @lang('dictionary.back')
                </a>
            </p>
        </div>
    </form>
@endsection