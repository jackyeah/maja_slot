<?php

namespace App\Console\Commands\majaSlot;

use Illuminate\Console\Command;
use App\Console\Commands\majaSlot\Api\Api;

class GetBalance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'maja:getBalance {gameAccount}';

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
        $result = $_model_api->getPlayerBalance($gameAccount);
        $resultArray = json_decode($result, true);

        if(!isset($resultArray['code']) || $resultArray['code'] != '0'){
            var_dump('[10001] 呼叫遊戲商 Api 錯誤。');
            return false;
        }

        dump('建立成功，遊戲餘額為： ' . $resultArray['data']['player']['balance']);
        return true;
    }
}
