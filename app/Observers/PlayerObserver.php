<?php

namespace App\Observers;

use App\Models\Player;
use Carbon\Carbon;

class PlayerObserver
{
    /**
     * Handle the Player "created" event.
     *
     * @param  \App\Models\Player  $player
     * @return void
     */
    public function created(Player $player)
    {
        $url = "http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=" . env('STEAM_API_KEY') . "&steamids=" . $player->steam_id;
        $data = file_get_contents($url); // put the contents of the file into a variable
        $json = json_decode($data);

        $playerData = $json->response->players[0];

        $player->steam_data = json_encode($playerData);
        $player->steam_name = $playerData->personaname;
        $player->steam_avatar = $playerData->avatarfull;
        $player->steam_since = Carbon::createFromTimestamp($playerData->timecreated)->diffInDays(Carbon::now());
        $player->save();
    }

    /**
     * Handle the Player "updated" event.
     *
     * @param  \App\Models\Player  $player
     * @return void
     */
    public function updated(Player $player)
    {
        //
    }

    /**
     * Handle the Player "deleted" event.
     *
     * @param  \App\Models\Player  $player
     * @return void
     */
    public function deleted(Player $player)
    {
        //
    }

    /**
     * Handle the Player "restored" event.
     *
     * @param  \App\Models\Player  $player
     * @return void
     */
    public function restored(Player $player)
    {
        //
    }

    /**
     * Handle the Player "force deleted" event.
     *
     * @param  \App\Models\Player  $player
     * @return void
     */
    public function forceDeleted(Player $player)
    {
        //
    }
}
