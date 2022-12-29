<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return  Illuminate\Http\Response
     */
    public function index()
    {
        $loggedUser = Auth::guard('administrator')->user();

        if ($loggedUser->canDo('player.index')) {
            return redirect(route('admin.players.index'));
        }

        if ($loggedUser->canDo('administrator.index')) {
            return redirect(route('admin.administrators.index'));
        }

        if ($loggedUser->canDo('settings.general')) {
            return redirect(route('admin.settings.index'));
        }

        return redirect(route('admin.logout'));
    }
}
