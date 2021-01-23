<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Route as FacadesRoute;

class configjs extends Command
{
    protected $name = 'configjs';
    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $requestPath = [
            'u' => [
                'nhanvien' => [
                    'query' => 'u/nhan-vien/q',
                ],
                'notification' => [
                    'readNotification' => route('u.thongbao.docthongbao', [], false),
                    'getNotificationsUnread' => route('u.thongbao.chuadoc', [], false),
                ]
            ]
        ];

        $config = [
            'keyPusher' => env('PUSHER_APP_KEY'),
            'defaultMessage'=>'lsaldflasdfl'
        ];

        $path = './resources/public/js/requestPath.js';
        $file = fopen($path, 'w+');
        fwrite($file, 'const requestPath = ' . json_encode($requestPath) . ';' . 'const config = ' . json_encode($config));
        fclose($file);
        return 0;
    }
}
