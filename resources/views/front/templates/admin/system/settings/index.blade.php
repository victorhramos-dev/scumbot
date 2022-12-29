@extends('front.partials.admin.dash-layout')

@section('title', trans('dictionary.settings'))

@section('page-header')
    <div class="content-header row mb-2">
        <div class="content-header-left col-md-8 col-12">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">@lang('admin.settings.index')</h2>

                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>

                            <li class="breadcrumb-item">Sistema</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <form method="post" action="{{ route('admin.settings.store') }}">
        @csrf

        <div class="card">
            <div class="card-body">
                <h6 class="heading-small mb-2">Configurações Gerais</h6><hr>
                @include('front.templates.admin.system.settings.sections.general')
            </div>
        </div>

        <div class="card">
            <div class="card-footer">
                <button type="button" class="btn btn-primary ajax-rest-post">Salvar</button>
            </div>
        </div>
    </form>
@endsection