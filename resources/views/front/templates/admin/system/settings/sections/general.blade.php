<div class="row">
    <div class="form-group col-md-6">
        <label>Foo Bar</label>
        <input type="text" name="settings[foo_bar]" class="form-control" value="{{ $settings->get('foo_bar') }}">
    </div>

    <div class="form-group col-md-6">
        <label>Bar Foo</label>
        <input type="text" name="settings[bar_foo]" class="form-control" value="{{ $settings->get('bar_foo') }}">
    </div>
</div>