<?php

namespace App\Http\Controllers\Api\Drone;

use App\Http\Controllers\Controller;

use App\Http\Resources\CommandsCollection;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class CommandsController extends Controller
{
    /**
     * Return commands list
     *
     * @return  Illuminate\Http\Response
     */
    public function index()
    {
        $loggedUser = Auth::guard('api_drone')->user();

        $commands = collect([]);

        return new CommandsCollection($commands);
    }
}
