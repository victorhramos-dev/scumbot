<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasEvents;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasEvents;

    protected $fillable = [
        "balance"
    ];

    public function positions()
    {
        return $this->hasMany(PlayerPosition::class, 'steam_id', 'steam_id');
    }

    public function economy()
    {
        return $this->hasMany(PlayerEconomy::class, 'steam_id', 'steam_id');
    }

    public function logins()
    {
        return $this->hasMany(PlayerLogin::class, 'steam_id', 'steam_id');
    }

    public function adminCommands()
    {
        return $this->hasMany(PlayerAdminCommands::class, 'steam_id', 'steam_id');
    }

    public function chats()
    {
        return $this->hasMany(PlayerChat::class, 'steam_id', 'steam_id');
    }

    public function addLogin($type = 'in', $ip, $date, $x = 0, $y = 0, $z = 0)
    {
        if ($ip != "0.0.0.0") {
            $this->last_ip = $ip;
            $this->save();

            $action = new PlayerPosition();
            $action->steam_id = $this->steam_id;
            $action->x = $x;
            $action->y = $y;
            $action->z = $z;
            $action->date = $date;
            $action->save();
        }

        $action = new PlayerLogin();
        $action->steam_id = $this->steam_id;
        $action->type = $type;
        $action->ip = $ip;
        $action->x = $x;
        $action->y = $y;
        $action->z = $z;
        $action->date = $date;
        $action->save();
    }

    public function addChat($name, $area, $message, $date)
    {
        $action = new PlayerChat();
        $action->steam_id = $this->steam_id;
        $action->name = $name;
        $action->area = $area;
        $action->message = $message;
        $action->date = $date;
        $action->save();

        return $action;
    }

    public function addAdminCommand($command, $date)
    {
        $action = new PlayerAdminCommands();
        $action->steam_id = $this->steam_id;
        $action->command = $command;
        $action->date = $date;
        $action->save();

        return $action;
    }

    public function addEconomyAction($line, $date)
    {
        $action = new PlayerEconomy();
        $action->steam_id = $this->steam_id;
        $action->action = $line;
        $action->date = $date;
        $action->save();
    }
}
