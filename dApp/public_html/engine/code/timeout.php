<?php
/**
 * Timeout page generator.
 * @path /engine/code/timeout.php
 *
 * @name    DAO Mansion    @version 1.0.3
 * @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */

function timeout() {
    engine::log('timeout('.json_encode($_GET).')');
    try {
        $_SESSION["display"] = "1";
        $query = 'SELECT `id`, `display`, `ref_id` FROM `nodes_attendance` WHERE `token` = "'.session_id().'" ORDER BY `id` DESC LIMIT 0, 1';
        $res = engine::mysql($query);
        $data = mysqli_fetch_array($res);
        $query = 'UPDATE `nodes_attendance` SET `display` = "1" WHERE `token` = "'.session_id().'"';
        engine::mysql($query);
        if (!$data["ref_id"] && !empty($_GET["ref"])) {
            $ref = engine::escape_string(urldecode($_GET["ref"]));
            if (mb_strpos($ref, $_SERVER["HTTP_HOST"]) === FALSE) {
                $query = 'INSERT INTO `nodes_referrer`(name) VALUES("'.$ref.'")';
                engine::mysql($query);
                $refId = mysqli_insert_id($_SERVER["sql_connection"]);
                $query = 'UPDATE `nodes_attendance` SET `ref_id` = "'.$refId.'" WHERE `id` = "'.$data["id"].'"';
                engine::mysql($query);
            }
        }
    } catch(Exception $e) {
        engine::throw('timeout('.json_encode($_GET).')', $e);
    }
}

timeout();

