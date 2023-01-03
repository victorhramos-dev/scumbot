<form method="post" action="{{ route('admin.drones.update', $drone->id) }}">
    @method('PUT')
    @csrf

    <input type="hidden" name="success_redirect" value="{{ route('admin.drones.index') }}">

    <div class="modal-header">
        <h4 class="modal-title">@lang('admin.drones.edit')</h4>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <div class="modal-body">
        <div class="form-group">
            <label>@lang('dictionary.identifier')</label>
            <input type="text" name="name" class="form-control" value="{{ $drone->name }}">
        </div>

        <div class="form-group">
            <label>@lang('dictionary.steam-id')</label>
            <input type="text" name="steam_id" class="form-control" value="{{ $drone->steam_id }}">
        </div>

        <div class="form-group">
            <label>@lang('dictionary.hwid')</label>
            <input type="text" class="form-control" value="{{ $drone->hwid }}" readonly="readonly">
        </div>

        <div class="form-group">
            <label>@lang('dictionary.api-token')</label>
            <input type="text" class="form-control" value="{{ $drone->api_token }}" readonly="readonly">
        </div>
    </div>

    <div class="modal-footer bg-light">
        <button type="button" class="btn btn-primary ajax-rest-post">Salvar</button>
    </div>
</form>