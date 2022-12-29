@extends('front.partials.admin.dash-layout')

@section('title', trans('dictionary.players'))

@section('page-header')
    <div class="content-header mb-2">
        <div class="content-header-left">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">@lang('admin.players.edit')</h2>

                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>

                            <li class="breadcrumb-item">Gerenciamento</li>

                            <li class="breadcrumb-item">@lang('dictionary.players')</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <form method="post" action="{{ route('admin.players.store') }}">
        @csrf

        <input type="hidden" name="success_redirect" value="{{ route('admin.players.index') }}">

        <div class="card">
            <div class="card-header">
                <h3>Informação Principal</h3>
            </div>

            <div class="card-body">
                <div class="form-group">
                    <label>@lang('dictionary.name')</label>
                    <input type="text" name="name" class="form-control">
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3>Dados de Acesso</h3>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="form-group col-lg-4">
                        <label>@lang('dictionary.email')</label>
                        <input type="email" name="email" class="form-control" placeholder="@lang('dictionary.email')">
                    </div>

                    <div class="form-group col-lg-4">
                        <label>@lang('dictionary.password')</label>
                        <input type="password" name="password" class="form-control" placeholder="@lang('dictionary.password')">
                    </div>

                    <div class="form-group col-lg-4">
                        <label>@lang('auth.password-confirmation')</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="@lang('auth.password-confirmation')">
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-footer">
                <button type="button" class="btn btn-primary ajax-rest-post">Salvar</button>
            </div>
        </div>
    </form>
@endsection