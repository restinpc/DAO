<?php
/**
* Capital application backend script.
* @path /engine/code/capitalization.php
*
* @name    DAO Mansion    @version 1.0.3
* @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*/

function capitalization() {
    engine::log('capitalization()');
    try {
        header('Content-Type: application/json; charset=utf-8');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Request-Method: GET, OPTIONS");
        header("Access-Control-Allow-Headers: *");
        require_once("engine/nodes/config2.php");
        $_SERVER["sql_connection"] = mysqli_connect($_SERVER["config"]["sql_server"], $_SERVER["config"]["sql_login"], $_SERVER["config"]["sql_pass"], $_SERVER["config"]["sql_db"],3306);
        mysqli_select_db($_SERVER["sql_connection"], $_SERVER["config"]["sql_db"]);
        mysqli_query($_SERVER["sql_connection"], "SET SESSION wait_timeout = 4000");
        $query = 'SELECT 
            data.*,
            (rate.usd * data.usd) as cap_usd,
            (rate.eur * data.eur) as cap_eur,
            (rate.btc * data.btc) as cap_btc,
            (rate.btc * data.`btc-local`) as cap_btc_local,
            (rate.bch * data.bch) as cap_bch,
            (rate.bch * data.`bch-local`) as cap_bch_local,
            (rate.eth * data.eth) as cap_eth,
            (rate.usd * data.usdt) as cap_usdt,
            (
                (rate.usd * data.usd) +
                (rate.eur * data.eur) +
                (rate.btc * data.btc) +
                (rate.btc * data.`btc-local`) +
                (rate.bch * data.bch) +
                (rate.bch * data.`bch-local`) +
                (rate.eth * data.eth) +
                (rate.usd * data.usdt) + 
                data.rub +
                data.stock +
                data.credit
            ) as total_rub,
            ((
                (rate.usd * data.usd) +
                (rate.eur * data.eur) +
                (rate.btc * data.btc) +
                (rate.btc * data.`btc-local`) +
                (rate.bch * data.bch) +
                (rate.bch * data.`bch-local`) +
                (rate.usd * data.usdt) + 
                data.rub +
                data.stock +
                data.credit
            ) / rate.usd) as total_usd,
            ((
                (rate.usd * data.usd) +
                (rate.eur * data.eur) +
                (rate.btc * data.btc) +
                (rate.btc * data.`btc-local`) +
                (rate.bch * data.bch) +
                (rate.bch * data.`bch-local`) +
                (rate.usd * data.usdt) + 
                data.rub +
                data.stock +
                data.credit
            ) / rate.eur) as total_eur,
            data.`btc-local` as btcLocal,
            data.`bch-local` as bchLocal,
            (
                (rate.usd * data.usd) +
                (rate.eur * data.eur) +
                (rate.btc * data.btc) +
                (rate.btc * data.`btc-local`) +
                (rate.bch * data.bch) +
                (rate.bch * data.`bch-local`) +
                (rate.usd * data.usdt) + 
                data.rub +
                data.stock
            ) as debit_rub,
            ((
                (rate.usd * data.usd) +
                (rate.eur * data.eur) +
                (rate.btc * data.btc) +
                (rate.btc * data.`btc-local`) +
                (rate.bch * data.bch) +
                (rate.bch * data.`bch-local`) +
                (rate.usd * data.usdt) + 
                data.rub +
                data.stock
            ) / rate.usd) as debit_usd,
            ((
                (rate.usd * data.usd) +
                (rate.eur * data.eur) +
                (rate.btc * data.btc) +
                (rate.btc * data.`btc-local`) +
                (rate.bch * data.bch) +
                (rate.bch * data.`bch-local`) +
                (rate.usd * data.usdt) + 
                data.rub +
                data.stock
            ) / rate.eur) as debit_eur
        FROM ewall_data as data
            LEFT JOIN ewall_rate as rate 
            ON rate.id = (
                SELECT MAX(id) 
                FROM ewall_rate 
                WHERE date < data.date
            )
        WHERE data.user_id = 1
        ORDER BY data.id ASC';
        @mysqli_query($_SERVER["sql_connection"], "SET NAMES utf8");
        $res = mysqli_query($_SERVER["sql_connection"], $query) or die(engine::error(500));
        $fout = array();
        while ($data = mysqli_fetch_array($res)) {
            array_push($fout, $data);
        }
        $json = json_encode($fout);
        echo $json;
    } catch(Exception $e) {
        engine::throw('capitalization()', $e);
    }
}

capitalization();
