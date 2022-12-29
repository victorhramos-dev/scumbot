@extends('front.partials.admin.dash-layout')

@section('title', trans('dictionary.players'))

@section('page-header')
    <div class="content-header row mb-2">
        <div class="content-header-left col-md-6 col-12">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">@lang('dictionary.players')</h2>

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
            <a href="#filter-modal" class="btn btn-outline-primary ml-2" data-toggle="modal">
                <i data-feather='search'></i> Filtrar resultados...
            </a>

            @shield('player.create')
                <!-- <a href="{{ route('admin.players.create') }}" class="btn btn-primary btn-round d-xs-block ml-2">
                    <i data-feather='plus-square'></i> @lang('dictionary.create')
                </a> -->
            @endshield
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
                        <th>@lang('dictionary.name')</th>
                        <th>@lang('dictionary.email')</th>
                        <th>@lang('dictionary.mobile')</th>
                        <th class="text-center">@lang('dictionary.actions')</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($players as $player)
                        <tr>
                            <td>{{ $player->id }}</td>
                            <td>{{ $player->present()->createdAt }}</td>
                            <td>{{ $player->name }}</td>
                            <td>{{ $player->email }}</td>
                            <td>{{ $player->present()->mobile }}</td>
                            <td class="text-center">
                                @shield('player.edit')
                                    <a class="btn btn-icon btn-flat-primary" href="{{ route('admin.players.edit', $player->id) }}">
                                        <i data-feather="edit-3"></i>
                                    </a>
                                @endshield

                                @shield('player.destroy')
                                    <a class="btn btn-icon btn-flat-danger ajax-rest-delete" href="{{ route('admin.players.destroy', $player->id) }}" title="Deletar registro">
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
            {{ $players->links('front.partials.global.pagination') }}
        </div>
    </div>
@endsection

@push('scripts')
    <div class="modal fade" id="filter-modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('admin.players.index') }}" method="GET">
                    <div class="modal-header">
                        <h4 class="modal-title">Filtrar resultados</h4>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label>@lang('dictionary.name')</label>
                                <input type="text" name="search_name" class="form-control" value="{{ request()->get('search_name') }}">
                            </div>

                            <div class="form-group col-lg-6">
                                <label>@lang('dictionary.email')</label>
                                <input type="text" name="search_email" class="form-control" value="{{ request()->get('search_email') }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label>@lang('dictionary.mobile')</label>
                                <input type="text" name="search_mobile" class="form-control phone" value="{{ request()->get('search_mobile') }}">
                            </div>

                            <div class="form-group col-lg-6">
                                <label>@lang('dictionary.phone')</label>
                                <input type="text" name="search_phone" class="form-control phone" value="{{ request()->get('search_phone') }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label>@lang('dictionary.created-at')</label>
                                <input type="text" name="search_created_at_min" class="form-control date_br" placeholder="@lang('dictionary.min')" value="{{ request()->get('search_created_at_min') }}">
                            </div>

                            <div class="form-group col-lg-6">
                                <label>&nbsp;</label>
                                <input type="text" name="search_created_at_max" class="form-control date_br" placeholder="@lang('dictionary.max')" value="{{ request()->get('search_created_at_max') }}">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">
                            <i data-feather='search'></i> Filtrar
                        </button>

                        <a href="{{ route('admin.players.index') }}" class="btn btn-info">
                            <i data-feather='x'></i> Limpar Filtros
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endpush