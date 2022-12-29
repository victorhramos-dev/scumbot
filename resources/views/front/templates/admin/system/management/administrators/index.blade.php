@extends('front.partials.admin.dash-layout')

@section('title', trans('dictionary.administrators'))

@section('page-header')
    <div class="content-header row mb-2">
        <div class="content-header-left col-md-7 col-12">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">@lang('dictionary.administrators')</h2>

                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>

                            <li class="breadcrumb-item">Sistema</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-header-right col-md-5 col-12">
            <form action="{{ route('admin.administrators.index') }}" method="GET" class="form-inline form-header-search d-flex align-items-end float-right">
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

                @shield('administrator.create')
                    <a href="{{ route('admin.administrators.create') }}" class="btn btn-primary btn-round d-xs-block ml-2">
                        <i data-feather='plus-square'></i> @lang('dictionary.create')
                    </a>
                @endshield
            </form>
        </div>
    </div>
@endsection

@section('content')
    <div class="card shadow">
        <div class="card-header d-none">
            <h3>@lang('dictionary.administrators')</h3>
        </div>

        <div class="table-responsive">
            <table class="table shadow">
                <thead>
                    <tr>
                        <th>@lang('dictionary.id')</th>
                        <th>@lang('dictionary.name')</th>
                        <th>@lang('dictionary.email')</th>
                        <th class="text-center">@lang('dictionary.actions')</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($administrators as $administrator)
                        <tr>
                            <td>{{ $administrator->id }}</td>
                            <td>{{ $administrator->name }}</td>
                            <td>{{ $administrator->email }}</td>
                            <td class="text-center">
                                @if($administrator->isSuperUser())
                                    @shield('administrator.edit')
                                        <a class="btn btn-sm btn-primary" href="{{ route('admin.administrators.edit', $administrator->id) }}">
                                            <i class="fa fa-edit"></i> Editar
                                        </a>
                                    @endshield

                                    <button type="button" class="btn btn-sm btn-danger" disabled="disabled">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                @else
                                    @shield('administrator.edit')
                                        <a class="btn btn-sm btn-primary" href="{{ route('admin.administrators.edit', $administrator->id) }}">
                                            <i class="fa fa-edit"></i> Editar
                                        </a>
                                    @endshield

                                    @shield('administrator.destroy')
                                        <a class="btn btn-sm btn-danger ajax-rest-delete" href="{{ route('admin.administrators.destroy', $administrator->id) }}" title="Deletar">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    @endshield
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">@lang('messages.no-records')</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            {{ $administrators->links('front.partials.global.pagination') }}
        </div>
    </div>
@endsection