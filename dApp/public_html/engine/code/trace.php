<?php
/**
* Black box trace script.
* @path /engine/code/trace.php
*
* @name    DAO Mansion    @version 1.0.3
* @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*/

function trace() {
    engine::log('trace()');
    try {
        if (!empty($_POST["logs"])) {
            $logs = engine::escape_string($_POST["logs"]);
            $query = 'SELECT id FROM `nodes_exception` WHERE name LIKE "'.$_SERVER["REMOTE_ADDR"].'"';
            $res = engine::mysql($query);
            $data = mysqli_fetch_array($res);
            if (!empty($data)) {
                $query = 'UPDATE `nodes_exception` SET data = "'.$logs.'", date = NOW() WHERE id = '.$data["id"];
                engine::mysql($query);
            } else {
                $query = 'INSERT INTO `nodes_exception`(name, data, date) '
                    . 'VALUES("'.$_SERVER["REMOTE_ADDR"].'", "'.$logs.'", NOW())';
                engine::mysql($query);
            }
            $_SESSION["LOG"] = array();
        }
    } catch(Exception $e) {
        engine::throw('trace()', $e);
    }
}

trace();