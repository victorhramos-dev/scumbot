<?php

namespace App\Http\Middleware\Drone;

use Closure;

use App\Repositories\Contracts\DroneRepository;

use Illuminate\Support\Facades\Auth;

class NeedsHardwareIdMiddleware
{
    /**
     * Constructor
     *
     * @param  DroneRepository  $droneRepository  Drone Repository Instance
     */
    public function __construct(DroneRepository $droneRepository)
    {
        $this->droneRepository = $droneRepository;
    }

	/**
	 * Handle an incoming request.
	 *
	 * @param  Illuminate\Http\Request  $request
	 * @param  Closure                  $next
	 * @param  string|null              $guard
	 *
	 * @return  mixed
	 */
	public function handle($request, Closure $next)
	{
		$hardwareId = $request->header('Hardware-Id');
		
		$bearerToken = $request->bearerToken();
		
		$recordExists = $this->droneRepository->scopeQuery(function($query) use($hardwareId, $bearerToken) {
			return $query
						->where('hwid', $hardwareId)
						->where('api_token', $bearerToken);						
		})->count() > 0;

		if ($recordExists == false) {
			return response()->json(['success' => false], 401);
		}

	    return $next($request);
	}
}
