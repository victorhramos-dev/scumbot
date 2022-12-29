<?php

namespace App\Services\Player;

use \DateTime;
use \Exception;

use App\Models\Player;

use App\Events\PlayerCreated as PlayerCreatedEvent;

use App\Repositories\Contracts\PlayerRepository;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class PlayerService
{
    /**
     * Player repository interface
     *
     * @var  App\Repositories\Contracts\PlayerRepository
     */
    protected $playerRepository;

    /**
     * Constructor
     *
     * @param  PlayerRepository  $playerRepository
     */
    public function __construct(PlayerRepository $playerRepository)
    {
        $this->playerRepository = $playerRepository;
    }

    /**
     * Create a new player.
     *
     * @param  FormRequest  $request
     *
     * @return  Player
     */
    public function create(FormRequest $request)
    {
        try {
            $attributes = [
                'name'  => $request->input('name'),

                'steam_id'     => $request->input('steam_id'),
                'steam_name'   => $request->input('steam_name'),
                'steam_avatar' => $request->input('steam_avatar'),
                'steam_since'  => $request->input('steam_since'),
                'steam_data'   => $request->input('steam_data'),

                'discord_id'     => $request->input('discord_id'),
                'discord_name'   => $request->input('discord_name'),
                'discord_avatar' => $request->input('discord_avatar'),
                'discord_data'   => $request->input('discord_data'),
            ];

            $player = $this->playerRepository->create($attributes);

            return $player;

        } catch (Exception $e) {
            Log::error($e);
        }

        return false;
    }

    /**
     *  Updates a given player.
     *
     * @param   Player     $player
     * @param   FormRequest  $request
     *
     * @return  Player
     */
    public function update(Player $player, FormRequest $request)
    {
        try {
            $attributes = [
                'name'  => $request->input('name'),

                'steam_id'     => $request->input('steam_id'),
                'steam_name'   => $request->input('steam_name'),
                'steam_avatar' => $request->input('steam_avatar'),
                'steam_since'  => $request->input('steam_since'),
                'steam_data'   => $request->input('steam_data'),

                'discord_id'     => $request->input('discord_id'),
                'discord_name'   => $request->input('discord_name'),
                'discord_avatar' => $request->input('discord_avatar'),
                'discord_data'   => $request->input('discord_data'),
            ];

            $this->playerRepository->update($attributes, $player->id);

            return $this->playerRepository->findByField('id', $player->id)->first();

        } catch (Exception $e) {
            Log::error($e);
        }

        return false;
    }
}
