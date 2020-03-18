<?php

namespace App\Console\Commands\majaSlot;

use Illuminate\Console\Command;
use App\Console\Commands\majaSlot\Api\Api;

class Credit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'maja:credit {gameAccount} {balance}';

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
        $balance = $this->argument('balance');

        $_model_api = new Api();
        $result = $_model_api->credit($gameAccount, $balance);
        $resultArray = json_decode($result, true);

        if(!isset($resultArray['code']) || $resultArray['code'] != '0'){
            dump('[10003] 呼叫遊戲商 Api 錯誤。');
            return false;
        }

        dump('上分成功，玩家目前遊戲餘額為： ' . $resultArray['data']['balance']);
        return true;
    }

}
