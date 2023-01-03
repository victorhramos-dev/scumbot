<?php

namespace App\Services\Drone;

use \Exception;

use App\Models\Drone;

use App\Repositories\Contracts\DroneRepository;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class DroneService
{
    /**
     * Drone repository interface
     *
     * @var  App\Repositories\Contracts\DroneRepository
     */
    protected $droneRepository;

    /**
     * Constructor
     *
     * @param  DroneRepository  $droneRepository
     */
    public function __construct(DroneRepository $droneRepository)
    {
        $this->droneRepository = $droneRepository;
    }

    /**
     * Create a new drone.
     *
     * @param  FormRequest  $request
     *
     * @return  Drone
     */
    public function create(FormRequest $request)
    {
        try {
            $token = Str::random(60);

            $attributes = [
                'name'      => $request->input('name'),
                'hwid'      => $request->input('hwid'),
                'steam_id'  => $request->input('steam_id'),
                'api_token' => strtoupper($token),
                'password'  => bcrypt(Str::random(60)),
            ];

            $drone = $this->droneRepository->create($attributes);

            return $drone;

        } catch (Exception $e) {
            Log::error($e);
        }

        return false;
    }

    /**
     *  Updates a given drone.
     *
     * @param   Drone     $drone
     * @param   FormRequest  $request
     *
     * @return  Drone
     */
    public function update(Drone $drone, FormRequest $request)
    {
        try {
            $attributes = [
                'name'     => $request->input('name'),
                'steam_id' => $request->input('steam_id'),
            ];

            $this->droneRepository->update($attributes, $drone->id);

            return $this->droneRepository->findByField('id', $drone->id)->first();

        } catch (Exception $e) {
            Log::error($e);
        }

        return false;
    }
}
