@extends('front.partials.admin.dash-layout')

@section('title', trans('dictionary.administrators'))

@section('page-header')
    <div class="content-header mb-2">
        <div class="content-header-left">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">@lang('admin.administrators.edit')</h2>

                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>

                            <li class="breadcrumb-item">Sistema</li>

                            <li class="breadcrumb-item">@lang('dictionary.administrators')</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <form method="post" action="{{ route('admin.administrators.update', [$administrator->id]) }}">
        @method('PUT')
        @csrf

        <input type="hidden" name="success_redirect" value="{{ route('admin.administrators.index') }}">

        <div class="card">
            <div class="card-header">
                <h3>Informação Principal</h3>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 form-group">
                        <label>@lang('dictionary.name')</label>
                        <input type="text" name="name" class="form-control" value="{{ $administrator->name }}">
                    </div>

                    <div class="col-lg-6 form-group">
                        <label>@lang('dictionary.email')</label>
                        <input type="email" name="email" class="form-control" value="{{ $administrator->email }}">
                    </div>

                    <div class="col-lg-6 form-group">
                        <label>@lang('dictionary.password')</label>
                        <input type="password" name="password" class="form-control">
                    </div>

                    <div class="col-lg-6 form-group">
                        <label>@lang('auth.password-confirmation')</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3>Permissões</h3>
            </div>

            <div class="card-body">
                @foreach($permissionGroups as $group)
                    <div class="permission-entry">
                        <div class="permission-details">
                            <h4>{{ $group['name'] }}</h4>

                            <div class="row info-list">
                                @foreach($group['permissions'] as $permission)
                                    <div class="col-md-6 col-lg-4">
                                        @if($administrator->hasPermission($permission->name))
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="permissions[]" id="perm-{{ $permission->id }}" class="custom-control-input" value="{{ $permission->id }}" checked="checked">
                                                <label class="custom-control-label" for="perm-{{ $permission->id }}">{{ $permission->readable_name }}</label>
                                            </div>
                                        @else
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="permissions[]" id="perm-{{ $permission->id }}" class="custom-control-input" value="{{ $permission->id }}">
                                                <label class="custom-control-label" for="perm-{{ $permission->id }}">{{ $permission->readable_name }}</label>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="card">
            <div class="card-footer">
                <button type="button" class="btn btn-primary ajax-rest-post">Salvar</button>
            </div>
        </div>
    </form>
@endsection