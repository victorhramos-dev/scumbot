<?php
namespace App\Jobs;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Lazzard\FtpClient\Config\FtpConfig;
use Lazzard\FtpClient\Connection\FtpConnection;
use Lazzard\FtpClient\FtpClient;
use Lazzard\FtpClient\FtpWrapper;

class FetchLogs extends Controller
{
    public static function fetch()
    {
        try {
            if (!extension_loaded('ftp')) {
                throw new \RuntimeException("FTP extension not loaded.");
            }

            $connection = new FtpConnection(env('FTP_GAMESERVER_HOSTNAME'), env('FTP_GAMESERVER_USERNAME'), env('FTP_GAMESERVER_PASS'), env('FTP_GAMESERVER_PORT'));

            $connection->open();

            $config = new FtpConfig($connection);
            $config->setPassive(true);

            $client = new FtpClient($connection);

            if(!is_dir(Storage::disk('local')->path('gamelogs'))){
                mkdir(Storage::disk('local')->path('gamelogs'));
            }

            while (True) {
                $files = $client->listDirDetails('/SCUM/Saved/SaveFiles/Logs');

                $lastFile = end($files);
                $lastTimestamp = str_replace('.log', '', explode('_', $lastFile['name'])[1]);

                foreach ($files as $file) {
                    $localFile = Storage::disk('local')->path('gamelogs') . '/' . $file['name'];

                    if (!is_file($localFile)) {
                        $client->download($file['path'], $localFile, true, FtpWrapper::ASCII);
                        ParseLogs::parse($localFile);
                    } else if (strpos($file['name'], $lastTimestamp) !== false && $file['size'] != filesize($localFile)) {
                        unlink($localFile);
                        $client->download($file['path'], $localFile, true, FtpWrapper::ASCII);

                        ParseLogs::parse($localFile);
                    }
                }
            }
        } catch (\Throwable $ex) {
            throw $ex;
        }
    }

    public static function fetchOnce()
    {
        try {
            if (!extension_loaded('ftp')) {
                throw new \RuntimeException("FTP extension not loaded.");
            }

            $connection = new FtpConnection(env('FTP_GAMESERVER_HOSTNAME'), env('FTP_GAMESERVER_USERNAME'), env('FTP_GAMESERVER_PASS'), env('FTP_GAMESERVER_PORT'));

            $connection->open();

            $config = new FtpConfig($connection);
            $config->setPassive(true);

            $client = new FtpClient($connection);


            $files = $client->listDirDetails('/SCUM/Saved/SaveFiles/Logs');

            $lastFile = end($files);
            $lastTimestamp = str_replace('.log', '', explode('_', $lastFile['name'])[1]);

            if(!is_dir(Storage::disk('local')->path('gamelogs'))){
                mkdir(Storage::disk('local')->path('gamelogs'));
            }

            foreach ($files as $file) {
                $localFile = Storage::disk('local')->path('gamelogs') . '/' . $file['name'];

                if (!is_file($localFile)) {
                    $client->download($file['path'], $localFile, true, FtpWrapper::ASCII);
                    ParseLogs::parse($localFile);
                } else if (strpos($file['name'], $lastTimestamp) !== false && $file['size'] != filesize($localFile)) {
                    unlink($localFile);
                    $client->download($file['path'], $localFile, true, FtpWrapper::ASCII);

                    ParseLogs::parse($localFile);
                }
            }

        } catch (\Throwable $ex) {
            throw $ex;
        }
    }
}
