<?php
/**
 * Created by PhpStorm.
 * User: b2017020601
 * Date: 2020/3/16
 * Time: 4:05 PM
 */

namespace App\Console\Commands\majaSlot\Api;

use Illuminate\Support\Str;
use anlutro\cURL\Laravel\cURL;

class Api
{
    private static $header, $domain, $agentCode, $agentName;

    public function __construct()
    {
        self::$header = '0Y8sYtJi55Qeli4Z';
        self::$domain = 'https://api.integration.mj-02.com/api/MOGI';
        self::$agentCode = 'jpt';
        self::$agentName = 'jpt';
    }

    /**
     * 登入遊戲
     *
     * @param $gameAccount
     * @param $game_code
     * @param $currency
     * @param $type
     * @param string $callback_url
     * @return mixed|string
     */
    public function login($gameAccount, $game_code, $currency, $type, $callback_url = 'https://google.com')
    {
        $params = [
            'player_unique_id' => $gameAccount,
            'player_name'      => Str::random(20),
            'player_currency'  => $currency,
            'game_id'          => $game_code,
            'is_demo'          => $type,
            'callback_url'     => $callback_url,
            'agent_code'       => self::$agentCode,
            'agent_name'       => self::$agentName
        ];

        $result = cURL::newRequest('post', self::$domain . '/launch-game', $params)
            ->setHeader('Authorization', self::$header)
            ->send();

        return $result->body;
    }

    /**
     * 取得會員餘額
     *
     * @param $gameAccount
     * @return mixed
     */
    public function getPlayerBalance($gameAccount)
    {
        $params = [
            'player_unique_id'  => $gameAccount,
        ];

        $result = cURL::newRequest('post', self::$domain . '/member-details', $params)
            ->setHeader('Authorization', self::$header)
            ->send();

        return $result->body;
    }
}