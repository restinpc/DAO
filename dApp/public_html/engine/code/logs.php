<?php
/**
* Outputs logs.
* @path /engine/code/logs.php
*
* @name    DAO Mansion    @version 1.0.3
* @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*/

function logs() {
    engine::log('logs()');
    try {
        if (array_key_exists("id", $_GET) && !empty($_GET["id"])) {
            $id = intval($_GET["id"]);
            if (array_key_exists("mode", $_GET) && $_GET["mode"] == "exceptions") {
                $query = 'SELECT data as logs FROM `nodes_exception` WHERE id = '.$id;
            } else {
                $query = 'SELECT logs FROM `nodes_error` WHERE id = '.$id;
            }
            $res = engine::mysql($query);
            $data = mysqli_fetch_array($res);
            $logs = str_replace('\"', '"', $data["logs"]);
            echo str_replace('
', '<br/>', $logs);
        } else {
            echo json_encode($_SESSION["LOG"]);
        }
    } catch(Exception $e) {
        engine::throw('logs()', $e);
    }
}

logs();