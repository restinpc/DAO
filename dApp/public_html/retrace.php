<?php
/**
* Standalone exceptions handler
*
* @name    DAO Mansion    @version 1.0.4
* @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*/

set_time_limit(60);
ini_set('max_execution_time', "60");
if (!empty($_POST)) {
    $payload = trim($_POST["logs"]);
    echo $payload;
    file_put_contents("exceptions/".($_GET["ip"] ? $_GET["ip"] : $_SERVER["REMOTE_ADDR"]).".txt", $payload);
}