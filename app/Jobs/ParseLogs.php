<?php
namespace App\Jobs;

use App\Http\Controllers\Controller;
use App\Models\Kill;
use App\Models\Parsed;
use App\Models\Player;
use App\Models\Trader;
use App\Models\Trap;
use Carbon\Carbon;
use Illuminate\Support\Str;

class ParseLogs extends Controller
{
    private static $lines = [];

    /**
     * Get Steam id
     * @param mixed $line
     * @return mixed
     */
    private static function getSteam($line)
    {
        preg_match('/765\d{14}/', $line, $steamid);
        return $steamid[0];
    }

    /**
     * Get player's name
     * @param mixed $line
     * @return array|string
     */
    private static function getName($line)
    {
        preg_match('/:\w{1,}/', $line, $name);
        return str_replace(':', '', $name[0]);
    }

    /**
     * Get time of the event
     * @param mixed $line
     * @return string
     */
    private static function getTime($line)
    {
        $time = Str::before($line, ':');
        return Carbon::createFromFormat('Y.m.d-H.i.s', $time)->format('Y/m/d H:i:s');
    }

    /**
     * Characters have an id inside the game, this method gathers it
     * @param mixed $line
     * @return mixed
     */
    private static function getCharacterGameId($line)
    {

        preg_match('/\(([^\)]+)\)/', $line, $id);
        return $id[0];
    }

    private static function getCommand($line)
    {
        return Str::between($line, "Command: '", "'");
    }

    /**
     * Get scope of the message in world
     * @param mixed $line
     * @return string
     */
    private static function getChatArea($line)
    {
        preg_match("/(?<=[)]' ).*/", $line, $subject);
        $subject = Str::between($subject[0], "'", "'");
        return trim(Str::before($subject, ':'));
    }

    /**
     * Get player's message
     * @param mixed $line
     * @return string
     */
    private static function getChatMessage($line)
    {
        preg_match("/(?<=[)]' ).*/", $line, $subject);
        $subject = Str::between($subject[0], "'", "'");
        return trim(Str::after($subject, ':'));
    }

    /**
     * Get ip address
     * @param mixed $line
     * @return mixed
     */
    private static function getIp($line)
    {
        preg_match("/\b(?:[0-9]{1,3}\.){3}[0-9]{1,3}\b/", $line, $ip);
        return $ip[0];
    }

    /**
     * Generic method to proxy parsers
     * @param mixed $file
     * @return void
     */
    public static function parse($file)
    {
        $method = explode('_20', basename($file))[0];

        $data = self::fopen_utf8($file);

        self::$lines = preg_split("/\r\n|\n|\r/", $data);

        unset(self::$lines[0]);
        unset(self::$lines[1]);

        foreach (self::$lines as $index => $line) {
            $parsed = Parsed::where('line', utf8_encode($line))->first();
            if ($parsed) {
                unset(self::$lines[$index]);
            }
        }

        // work with lines
        self::$method();

        // after work with lines make all parsed
        foreach (self::$lines as $index => $line) {
            $parsed = Parsed::where('line', utf8_encode($line))->first();
            if (!$parsed) {
                $parsed = new Parsed();
                $parsed->line = $line;
                $parsed->save();
            }
        }
    }

    /**
     * Read unicode file
     * @param mixed $fn
     * @return string
     */
    public static function fopen_utf8($fn)
    {
        $fc = "";
        $fh = fopen($fn, "rb");
        $flen = filesize($fn);
        $bc = fread($fh, $flen);

        for ($i = 0; $i < $flen; $i++) {
            $c = substr($bc, $i, 1);
            if ((ord($c) != 0) && (ord($c) != 13))
                $fc = $fc . $c;
        }

        if ((ord(substr($fc, 0, 1)) == 255) && (ord(substr($fc, 1, 1)) == 254))
            $fc = substr($fc, 2);
        return ($fc);
    }

    /**
     * Parse Admin log
     * @return void
     */
    public static function admin()
    {
        foreach (self::$lines as $line) {
            $line = trim($line);

            if (!Str::contains($line, "Custom Zones")) {
                $player = self::checkPlayer($line);

                $player->addAdminCommand(self::getCommand($line), self::getTime($line));
            }
        }
    }

    /**
     * Parse chat log
     * @return void
     */
    public static function chat()
    {
        foreach (self::$lines as $line) {
            $line = trim($line);

            $player = self::checkPlayer($line);

            $player->addChat(self::getName($line), self::getChatArea($line), self::getChatMessage($line), self::getTime($line));

            // exemplo de comando
            if (strpos(self::getChatMessage($line), '/online') === 0){
                //manda o bot enviar no chat quantos players online
            }
        }
    }

    public static function economy()
    {
        foreach (self::$lines as $line) {
            $line = trim($line);

            $player = Player::where('steam_id', self::getSteam($line))->first();
            if (!$player) {
                $player = new Player();
                $player->steam_id = self::getSteam($line);
                $player->save();
            }

            /**
             * This blocks is the honeyspot for updating things like last info about trader funds
             * and player balance
             */
            if (Str::contains($line, '[Trade] After tradeable purchase')) {
                // happens after the whole selling action
                $funds = Str::between($line, 'cash, ', ' bank');
                //$player->addEconomyAction();

                $player->update([
                    'balance' => $funds
                ]);
            }

            /**
             * This blocks is the honeyspot for updating things like last info about trader funds
             * and player balance
             */
            if (Str::contains($line, '[Trade] After tradeable sale')) {
                // happens after the whole selling action
                $funds = Str::between($line, 'cash, ', ' account');
                //$player->addEconomyAction();

                $player->update([
                    'balance' => $funds
                ]);
            }

            if (Str::contains($line, "and trader has")) {
                $traderName = Str::betweenFirst($line, 'trader ', ',');
                debug($line);
                debug($traderName);

                $trader = Trader::where('name', $traderName)->first();
                $trader->funds = Str::between($line, 'and trader has ', ' funds');
                $trader->save();
            }

            if (Str::contains($line, "[Trade] Before selling")) {
                // happens before each selling
            }

            if (Str::contains($line, "[Bank]")) {
                // happens after each bank interaction

                if (Str::contains($line, "balance is")) {
                    $funds = Str::between($line, 'balance is ', ' credits');
                }

                if (Str::contains($line, 'deposited')) {
                    preg_match('/(\d+)(?=\s*was added)/', $line, $added);
                    $funds = $player->balance + $added[0];
                }

                if (Str::contains($line, 'withdrew')) {
                    preg_match('/(\d+)(?=\s*was removed)/', $line, $removed);
                    $funds = $player->balance - $removed[0];
                }

                $player->update([
                    'balance' => $funds
                ]);
            }

            $player->addEconomyAction($line, self::getTime($line));
        }
    }

    public static function event_kill()
    {
    }

    public static function famepoints()
    {
    }

    public static function gameplay()
    {
        foreach (self::$lines as $line) {
            $line = trim($line);

            if (Str::contains($line, '[LogTrap] Armed')) {
                $trap = new Trap();
                $trap->armed_by = self::getSteam($line);
                $trap->trap_name = Str::betweenFirst($line, 'Trap name: ', '.');
                $trap->armed_x = Str::between($line, 'X=', ' Y');
                $trap->armed_y = Str::between($line, 'Y=', ' Z');
                $trap->armed_z = Str::after($line, 'Z=');
                $trap->armed_at = self::getTime($line);
                $trap->save();
            }

            if(Str::contains($line, '[LogTrap] Triggered')) {
                $trap = Trap::where([
                    ['armed_x', '=', Str::between($line, 'X=', ' Y')],
                    ['armed_y', '=', Str::between($line, 'Y=', ' Z')],
                    ['armed_z', '=', Str::after($line, 'Z=')],
                ])->first();

                if ($trap) {
                    $trap->triggered_by = self::getSteam($line);
                    $trap->triggered_x = Str::between($line, 'X=', ' Y');
                    $trap->triggered_y = Str::between($line, 'Y=', ' Z');
                    $trap->triggered_z = Str::after($line, 'Z=');
                    $trap->triggered_at = self::getTime($line);
                    $trap->save();
                }
            }
        }
    }

    public static function kill()
    {
        foreach (self::$lines as $line) {
            $line = trim($line);

            if (Str::contains($line, '{"Killer":')) {
                $json = json_decode(trim(Str::after($line, ':')));

                $kill = new Kill();
                $kill->killer_steam_id = $json->Killer->UserId;
                $kill->killer_name = $json->Killer->ProfileName;
                $kill->killer_x = $json->Killer->ClientLocation->X;
                $kill->killer_y = $json->Killer->ClientLocation->Y;
                $kill->killer_z = $json->Killer->ClientLocation->Z;
                $kill->victim_steam_id = $json->Victim->UserId;
                $kill->victim_name = $json->Victim->ProfileName;
                $kill->victim_x = $json->Victim->ClientLocation->X;
                $kill->victim_y = $json->Victim->ClientLocation->Y;
                $kill->victim_z = $json->Victim->ClientLocation->Z;
                $kill->weapon = Str::beforeLast($json->Weapon, '_');
                $kill->date = self::getTime($line);
                $kill->timeofday = $json->TimeOfDay;
                $kill->save();
            }
        }
    }

    private static function checkPlayer($line)
    {
        //validate player
        $player = Player::where('steam_id', self::getSteam($line))->first();

        if (!$player) {
            $player = new Player();
            $player->steam_id = self::getSteam($line);
        }

        $player->name = self::getName($line);
        $player->save();

        return $player;
    }

    /**
     * Parse login log
     * @return void
     */
    public static function login()
    {
        foreach (self::$lines as $line) {
            $line = trim($line);

            $player = self::checkPlayer($line);

            if (Str::contains($line, 'logged in')) {
                //login
                preg_match("/(?<=[)]' ).*/", $line, $subject);
                $x = Str::of($subject[0])->between("X=", " Y");
                $y = Str::of($subject[0])->between("Y=", " Z");
                $z = Str::of($subject[0])->after("Z=");
                $type = "in";
                $ip = self::getIp($line);
            } else {
                // logout
                $ip = '0.0.0.0';
                $type = 'out';
                $x = 0;
                $y = 0;
                $z = 0;
            }

            $player->addLogin($type, $ip, self::getTime($line), $x, $y, $z);
        }
    }

    public static function violations()
    {
    }
}
