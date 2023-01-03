<form method="post" action="{{ route('admin.drones.store') }}">
    @csrf

    <input type="hidden" name="success_redirect" value="{{ route('admin.drones.index') }}">

    <div class="modal-header">
        <h4 class="modal-title">@lang('admin.drones.create')</h4>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <div class="modal-body">
        <div class="form-group">
            <label>@lang('dictionary.identifier')</label>
            <input type="text" name="name" class="form-control">
        </div>

        <div class="form-group">
            <label>@lang('dictionary.steam-id')</label>
            <input type="text" name="steam_id" class="form-control">
        </div>

        <div class="form-group">
            <label>@lang('dictionary.hwid')</label>
            <input type="text" name="hwid" class="form-control">
        </div>
    </div>

    <div class="modal-footer bg-light">
        <button type="button" class="btn btn-primary ajax-rest-post">Salvar</button>
    </div>
</form>