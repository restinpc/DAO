<?php
/**
* Output backend logs.
* @path /engine/code/logs.php
*
* @name    DAO Mansion    @version 1.0.3
* @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*/

function logs() {
    engine::log('logs()');
    try {
        echo json_encode($_SESSION["LOG"]);
    } catch(Exception $e) {
        engine::throw('logs()', $e);
    }
}

logs();