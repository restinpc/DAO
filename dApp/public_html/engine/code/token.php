<?php
/**
* Captcha generator.
* @path /engine/code/captcha.php
*
* @name    DAO Mansion    @version 1.0.2
* @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*/

require_once("engine/nodes/headers.php");
require_once("engine/nodes/session.php");
$query = 'SELECT * FROM `nodes_user` WHERE `token` = "'.$_GET["token"].'"';
$res = engine::mysql($query);
$data = mysqli_fetch_array($res);
if (!empty($data)) {
    echo 'Ok';
} else {
    echo 'Error';
}