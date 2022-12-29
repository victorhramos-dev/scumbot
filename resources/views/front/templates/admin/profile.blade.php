@extends('front.partials.admin.dash-layout')

@section('title', trans('admin.profile'))

@section('page-header')
    <div class="content-header row mb-2">
        <div class="content-header-left col-md-6 col-12">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">@lang('admin.profile')</h2>

                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>

                            <li class="breadcrumb-item">@lang('admin.profile')</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <form method="post" action="{{ route('admin.profile') }}" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="success_redirect" value="{{ route('admin.dashboard') }}">

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-lg-6">
                        <label>@lang('dictionary.name')</label>
                        <input type="text" name="name" class="form-control" value="{{ $loggedUser->name }}">
                    </div>

                    <div class="form-group col-lg-6">
                        <label>@lang('dictionary.email')</label>
                        <input type="email" name="email" class="form-control" value="{{ $loggedUser->email }}">
                    </div>

                    <div class="form-group col-lg-6">
                        <label>@lang('dictionary.password')</label>
                        <input type="password" name="password" class="form-control">
                    </div>

                    <div class="form-group col-lg-6">
                        <label>@lang('auth.password-confirmation')</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <button type="button" class="btn btn-primary ajax-rest-post">Salvar</button>
            </div>
        </div>
    </form>
@endsection