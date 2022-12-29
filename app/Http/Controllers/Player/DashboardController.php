<?php

namespace App\Http\Controllers\Player;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return  Illuminate\Http\Response
     */
    public function index()
    {
        return redirect(route('player.enrollments.index'));
    }
}
