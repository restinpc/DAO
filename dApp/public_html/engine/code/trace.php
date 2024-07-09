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
            $query = 'SELECT id FROM `nodes_exceptions` WHERE name LIKE "'.$_SERVER["REMOTE_ADDR"].'"';
            $res = engine::mysql($query);
            $data = mysqli_fetch_array($res);
            if (!empty($data)) {
                $query = 'UPDATE `nodes_exceptions` SET data = "'.$logs.'", date = NOW() WHERE id = '.$data["id"];
                engine::mysql($query);
            } else {
                $query = 'INSERT INTO `nodes_exceptions`(name, data, date) '
                    . 'VALUES("'.$_SERVER["REMOTE_ADDR"].'", "'.$logs.'", NOW())';
                engine::mysql($query);
            }
        }
    } catch(Exception $e) {
        engine::throw('trace()', $e);
    }
}

trace();