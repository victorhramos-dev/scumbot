<div class="form-group">
    <label>Título</label>
    <input type="text" name="settings[calendar_link_title]" class="form-control" value="{{ $settings->get('calendar_link_title') }}">
</div>

<div class="form-group">
    <label>Local</label>
    <input type="text" name="settings[calendar_link_location]" class="form-control" value="{{ $settings->get('calendar_link_location') }}">
</div>

<div class="row">
    <div class="form-group col-sm-6">
        <label>Data Inicio</label>
        <input type="text" name="settings[calendar_link_date_start]" class="form-control datetime_br" value="{{ $settings->get('calendar_link_date_start') }}">
        <small class="d-block">Ex.: 25/12/2022 15:00:00</small>
    </div>

    <div class="form-group col-sm-6">
        <label>Data Fim</label>
        <input type="text" name="settings[calendar_link_date_end]" class="form-control datetime_br" value="{{ $settings->get('calendar_link_date_end') }}">
        <small class="d-block">Ex.: 31/12/2022 18:00:00</small>
    </div>
</div>