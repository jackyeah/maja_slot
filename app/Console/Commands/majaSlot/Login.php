<?php

namespace App\Console\Commands\majaSlot;

use Illuminate\Console\Command;
use App\Console\Commands\majaSlot\Api\Api;

class Login extends Command
{
    CONST GAME_CODE = 'meow-meow';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'maja:login {gameAccount} {gameId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $gameAccount = $this->argument('gameAccount');
        $gameId = $this->argument('gameId');
        $currency = 'THB';

        $_model_api = new Api();
        $result = $_model_api->login($gameAccount, $gameId, $currency, false);
        $resultArray = json_decode($result, true);
        //dd($resultArray);

        if(!isset($resultArray['code']) || $resultArray['code'] != '0'){
            var_dump('[10000] 呼叫遊戲商 Api 錯誤。');
            return false;
        }

        dump('登入成功，遊戲連結為： ' . $resultArray['data']['game_url']);
        return true;
    }
}
