<?php
/**
* User identity system script.
* @path /engine/code/account.php
*
* @name    DAO Mansion    @version 1.0.3
* @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*/

require_once("engine/nodes/headers.php");

function account() {
    engine::log('account('.json_encode($_GET).')');
    try {
        if (array_key_exists("mode", $_GET)
            && $_GET["mode"] == "remember"
            && array_key_exists("email", $_GET)
            && !empty($_GET["email"])
            && array_key_exists("code", $_GET)
            && !empty($_GET["code"])
        ) {
            $email = urldecode($_GET["email"]);
            $query = 'SELECT * FROM `nodes_user` WHERE `email` = "'.$email.'"';
            $res = engine::mysql($query);
            $data = mysqli_num_rows($res);
            if ($data) {
                $code = substr(md5($email.date("Y-m-d")), 0, 4);
                if ($code == $_GET["code"]) {
                    $new_pass = substr(md5($email.date("Y-m-d")), 0, 8);
                    $password = engine::encode_password($new_pass);
                    $query = 'UPDATE `nodes_user` SET `pass` = "'.$password.'" WHERE `email` = "'.$email.'"';
                    engine::mysql($query);
                    echo '<div class="center pt100">'.engine::lang("New password activated!").'</div>';
                } else {
                    echo '<div class="center pt100">'.engine::lang("Invalid confirmation code").'.</div>';
                }
            } else {
                echo '<div class="center pt100">Email '.engine::lang("not found").'.</div>';
            }
            echo '<script>setTimeout(() => { parent.window.location = "'.$_SERVER["DIR"].'/login"; }, 3000);</script>';
        } else if (array_key_exists("mode", $_GET) && $_GET["mode"] == "logout") {
            $query = 'DELETE FROM nodes_session WHERE token LIKE "'.$_COOKIE["token"].'" AND user_id = "'.$_SESSION["user"]["id"].'"';
            engine::mysql($query);
            unset($_SESSION["user"]);
            unset($_COOKIE['token']);
            setcookie('token', null, -1, '/');
            session_destroy();
            die('<script language="JavaScript">parent.window.location = "'.$_SERVER["DIR"].'/";</script>');
        } else {
            engine::error();
        }
    } catch(Exception $e) {
        engine::throw('account('.json_encode($_GET).')', $e);
    }
}

account();
