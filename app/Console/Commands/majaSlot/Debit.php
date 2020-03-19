<?php

namespace App\Console\Commands\majaSlot;

use App\Console\Commands\majaSlot\Api\Api;
use Illuminate\Console\Command;

class Debit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'maja:debit {gameAccount} {balance}';

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

        $_model_api = new Api();
        $balance = $this->argument('balance');
        $result = $_model_api->debit($gameAccount, $balance);
        $resultArray = json_decode($result, true);

        if(!isset($resultArray['code']) || $resultArray['code'] != '0'){
            var_dump('[10004] 呼叫遊戲商 Api 錯誤。');
            return false;
        }

        dump('下分成功，玩家目前遊戲餘額為： ' . $resultArray['data']['balance']);
        return true;
    }
}
