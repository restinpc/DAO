<?php
/**
* Header application backend script.
* @path /engine/code/token.php
*
* @name    DAO Mansion    @version 1.0.3
* @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*/

function token() {
    engine::log('token('.json_encode($_GET).')');
    try {
        $query = 'SELECT * FROM nodes_session WHERE `token` LIKE "'.$_GET["token"].'" AND expire_at > NOW()';
        $res = engine::mysql($query);
        $data = mysqli_fetch_array($res);
        if (!empty($data)) {
            echo 'Ok';
        } else {
            echo 'Error';
        }
    } catch(Exception $e) {
        engine::throw('token('.json_encode($_GET).')', $e);
    }
}

token();