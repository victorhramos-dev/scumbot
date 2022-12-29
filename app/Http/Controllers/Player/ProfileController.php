<?php

namespace App\Http\Controllers\Player;

use \Exception;
use \CountryState;

use App\Http\Controllers\Controller;

use App\Http\Requests\Player\ProfileRequest;

use App\Services\Player\PlayerService;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    /**
     * Constructor
     *
     * @param  PlayerService  $playerService
     */
    public function __construct(PlayerService $playerService)
    {
        $this->playerService = $playerService;
    }

    /**
     * Show the user profile.
     *
     * @return  Illuminate\Http\Response
     */
    public function index()
    {
        $player = Auth::guard('player')->user();

        $countries = CountryState::getCountries();
        
        try {
            $states = CountryState::getStates(strtoupper($player->address_country));

        } catch(Exception $e) {
            $states = CountryState::getStates('BR');
        }

        $data = compact('player', 'countries', 'states');

        return view('front.templates.player.profile', $data);
    }

    /**
     * Updates the user profile
     *
     * @param  ProfileRequest  $request
     *
     * @return  Response
     */
    public function update(ProfileRequest $request)
    {
        try {
            $request->sanitize();

            $player = auth('player')->user();

            $result = $this->playerService->update($player, $request);

            $player->setMeta('data_confirmed', date('Y-m-d H:i:s'));

            flash(trans('messages.success'))->success();

            $redirectTo = session()->pull('profile-redirect');

            if ($redirectTo) {
                return response()->json([
                    'success'  => true,
                    'redirect' => $redirectTo,
                ]);
            }

            return response()->json([
                'success'  => true,
                'redirect' => route('player.profile'),
            ]);

        } catch (Exception $e) {
            Log::error($e);
        }

        return response()->json([
            'success'  => false,
            'redirect' => route('player.profile'),
        ]);
    }
}
