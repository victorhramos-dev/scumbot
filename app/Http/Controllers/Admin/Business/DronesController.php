<?php

namespace App\Http\Controllers\Admin\Business;

use \Exception;

use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\Drone\DataRequest;

use App\Models\Drone;

use App\Repositories\Contracts\DroneRepository;

use App\Services\Drone\DroneService;

use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class DronesController extends Controller
{
    /**
     * Constructor
     *
     * @param  DroneRepository  $droneRepository
     * @param  DroneService     $droneService
     */
    public function __construct(
        DroneRepository $droneRepository,
        DroneService $droneService
    )
    {
        $this->droneRepository = $droneRepository;

        $this->droneService = $droneService;
    }

    /**
     * Show the drones page.
     *
     * @param  Request  $request
     *
     * @return  Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $drones = $this->droneRepository->orderBy('id', 'desc')->paginate(50);

        if ($request->ajax()) {
            return response()->json($drones);
        }

        return view('front.templates.admin.business.drones.index', compact('drones'));
    }

    /**
     * Show the drones create page.
     *
     * @return  Illuminate\Http\Response
     */
    public function create()
    {
        return view('front.templates.admin.business.drones.create');
    }

    /**
     * Show the drones edit page.
     *
     * @param  Drone  $drone
     *
     * @return  Illuminate\Http\Response
     */
    public function edit(Drone $drone)
    {
        $data = compact('drone');

        return view('front.templates.admin.business.drones.edit', $data);
    }

    /**
     * Stores a new record.
     *
     * @param  DataRequest  $request
     *
     * @return  Illuminate\Http\Response
     */
    public function store(DataRequest $request)
    {
        try {
            $drone = $this->droneService->create($request);

            return response()->json([
                'success'  => true,
                'redirect' => route('admin.drones.index'),
            ]);

        } catch (Exception $e) {
            Log::error($e);

            flash(trans('messages.exception'), 'danger');
        }

        return response()->json([
            'success'  => false,
            'redirect' => route('admin.drones.index'),
        ]);
    }

    /**
     * Updates drone.
     *
     * @param  Drone     $drone
     * @param  DataRequest  $request
     *
     * @return  Illuminate\Http\Response
     */
    public function update(Drone $drone, DataRequest $request)
    {
        try {
            $drone = $this->droneService->update($drone, $request);

            return response()->json([
                'success'  => true,
                'redirect' => route('admin.drones.index'),
            ]);

        } catch (Exception $e) {
            Log::error($e);

            flash(trans('messages.exception'), 'danger');
        }

        return response()->json([
            'success'  => false,
            'redirect' => route('admin.drones.index'),
        ]);
    }

    /**
     * Destroy drone.
     *
     * @param  Drone  $drone
     *
     * @return  Illuminate\Http\Response
     */
    public function destroy(Drone $drone)
    {
        try {
            $this->droneRepository->delete($drone->id);

            flash(trans('messages.success'), 'success');

            return response()->json([
                'success'  => true,
                'redirect' => route('admin.drones.index'),
            ]);

        } catch (Exception $e) {
            Log::error($e);

            flash(trans('messages.exception'), 'danger');
        }

        return response()->json([
            'success'  => false,
            'redirect' => route('admin.drones.index'),
        ]);
    }
}
