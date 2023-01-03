@extends('front.partials.admin.dash-layout')

@section('title', trans('dictionary.drones'))

@section('page-header')
    <div class="content-header row mb-2">
        <div class="content-header-left col-md-6 col-12">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">@lang('dictionary.drones')</h2>

                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>

                            <li class="breadcrumb-item">Gerenciamento</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-header-right col-md-6 col-12 text-right">
            <form action="{{ route('admin.drones.index') }}" method="GET" class="form-inline form-header-search d-flex align-items-end float-right">
                <div class="form-group mb-0 d-xs-block">
                    <div class="input-group">
                        <input type="search" name="search" class="form-control" placeholder="Filtrar resultados..." value="{{ request()->get('search') }}">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary btn-icon">
                                <i data-feather="search"></i>
                            </button>
                        </div>
                    </div>
                </div>

                @shield('drone.create')
                    <a href="{{ route('admin.drones.create') }}" class="btn btn-primary btn-round d-xs-block ml-2" data-toggle="modal" data-target="#ajaxModal">
                        <i data-feather='plus-square'></i> @lang('dictionary.create')
                    </a>
                @endshield
            </form>
        </div>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>@lang('dictionary.id')</th>
                        <th>@lang('dictionary.created-at')</th>
                        <th>@lang('dictionary.identifier')</th>
                        <th>@lang('dictionary.steam-id')</th>
                        <th>@lang('dictionary.hwid')</th>
                        <th class="text-center">@lang('dictionary.actions')</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($drones as $drone)
                        <tr>
                            <td>{{ $drone->id }}</td>
                            <td>{{ $drone->present()->createdAt }}</td>
                            <td>{{ $drone->name }}</td>
                            <td>{{ $drone->steam_id }}</td>
                            <td>{{ $drone->hwid }}</td>
                            <td class="text-center">
                                @shield('drone.edit')
                                    <a class="btn btn-icon btn-flat-primary" href="{{ route('admin.drones.edit', $drone->id) }}" data-toggle="modal" data-target="#ajaxModal">
                                        <i data-feather="edit-3"></i>
                                    </a>
                                @endshield

                                @shield('drone.destroy')
                                    <a class="btn btn-icon btn-flat-danger ajax-rest-delete" href="{{ route('admin.drones.destroy', $drone->id) }}" title="Revogar acesso">
                                        <i data-feather="trash-2"></i>
                                    </a>
                                @endshield
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">@lang('messages.no-records')</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            {{ $drones->links('front.partials.global.pagination') }}
        </div>
    </div>
@endsection