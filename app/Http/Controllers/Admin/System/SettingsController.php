<?php

namespace App\Http\Controllers\Admin\System;

use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\SettingsRequest;

use Illuminate\Support\Collection;

class SettingsController extends Controller
{
    /**
     * @var  array
     */
    private $settings = [
        'foo_bar',
        'bar_foo',
    ];

    /**
     * @var  array
     */
    private $environments = [];

    /**
     * Show the settings page dashboard.
     *
     * @return  Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'settings' => $this->getSettings(),
        ];

        return view('front.templates.admin.system.settings.index', $data);
    }

    /**
     * Store Settings
     *
     * @param  SettingsRequest  $request
     *
     * @return  Illuminate\Http\Response
     */
    public function store(SettingsRequest $request)
    {
        $settings = $request->input('settings', []);

        $this->storeSettings($settings);

        flash(trans('messages.success'), 'success');

        return response()->json([
            'success'  => true,
            'redirect' => route('admin.settings.index'),
        ]);
    }

    /**
     * Return settings
     *
     * @return  array
     */
    private function getSettings()
    {
        $settings = [];

        foreach ($this->settings as $key) {
            if ($key == 'dayuse_types') {
                $settings[$key] = [];

                $value = setting($key);

                if ($value) {
                    $settings[$key] = json_decode($value, true);
                }
            } else {
                $settings[$key] = setting($key);
            }
        }

        $settings = array_filter($settings);

        return new Collection($settings);
    }

    /**
     * Store settings
     *
     * @param   array  $settings
     * @return  void
     */
    private function storeSettings($settings)
    {
        if (is_array($settings)) {
            foreach ($settings as $key => $value) {
                if ($value) {
                    if (is_array($value)) {
                        setting()->set($key, json_encode($value));
                    } else {
                        setting()->set($key, $value);
                    }
                } else {
                    setting()->set($key, '');
                }
            }
        }

        setting()->save();
    }
}
