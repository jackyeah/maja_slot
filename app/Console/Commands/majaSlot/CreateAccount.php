<?php

namespace App\Console\Commands\majaSlot;

use Illuminate\Console\Command;
use App\Console\Commands\majaSlot\Api\Api;
use Illuminate\Support\Str;

class CreateAccount extends Command
{
    //CONST PROVIDER_CODE = 'MAJASLOT';
    //CONST GAME_CODE = 'cross-the-road';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'maja:createAccount';

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
     * Maja 電子沒有創建遊戲帳號的 Api，當玩家第一次登入成功，即會自動建立該組遊戲帳號，因此這邊的建立遊戲帳號，其實就是登入遊戲
     *
     * @return mixed
     */
    public function handle()
    {
        # 建立資料，由於 maja 限制遊戲帳號最大為 50 ，因此這邊使用 Laravel 的內建函式，建立一個隨機的字串，並且長度為 50
        $gameAccount = Str::random(50);

        $currency = 'USD';

        $_model_api = new Api();
        $result = $_model_api->login($gameAccount, $currency, false);
        $resultArray = json_decode($result, true);
        //dd($resultArray);

        if(!isset($resultArray['code']) || $resultArray['code'] != '0'){
            var_dump('[10001] 呼叫遊戲商 Api 錯誤。');
            return false;
        }


        dump('建立成功，遊戲帳號為： ' . $gameAccount);
        return true;
    }
}
