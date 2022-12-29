<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\ProfileRequest;

class ProfileController extends Controller
{
    /**
     * Show the user profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('front.templates.admin.profile');
    }

    /**
     * update the user profile
     *
     * @param ProfileRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileRequest $request)
    {
        try {
            if ($request->get('name')) {
                auth('administrator')->user()->name = $request->get('name');
            }

            if ($request->get('email')) {
                auth('administrator')->user()->email = $request->get('email');
            }

            if ($request->get('password')) {
                auth('administrator')->user()->password = bcrypt($request->get('password'));
            }

            auth('administrator')->user()->save();

            flash(trans('messages.success'), 'success');

            return response()->json([
                'success' => true,
                'redirect' => route('admin.profile'),
            ]);
        } catch (\Exception $e) {
            flash(trans('messages.exception'), 'danger');
        }

        return response()->json([
            'success' => false,
            'redirect' => route('admin.profile'),
        ]);
    }
}
