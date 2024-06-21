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
require_once("engine/nodes/session.php");

if ($_GET["mode"] == "remember" && !empty($_GET["email"]) && !empty($_GET["code"])) {
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
            echo '<div class="center pt100">'.engine::lang("New password activated!").'</div>'
                . '<script>'
                    . 'function redirect(){'
                    . ' parent.window.location="'.$_SERVER["DIR"].'/login";'
                    . '}'
                    . 'setTimeout(redirect, 3000);'
                . '</script>';
        } else {
            echo '<div class="center pt100">'.engine::lang("Invalid confirmation code").'.</div>'
                . '<script>'
                    . 'function redirect() {'
                    . ' parent.window.location = "'.$_SERVER["DIR"].'/login";'
                    . '}'
                    . 'setTimeout(redirect, 3000);'
                . '</script>';
        }
    } else {
       echo '<div class="center pt100">Email '.engine::lang("not found").'.</div>'
            . '<script>'
               . 'function redirect() {'
               . '  parent.window.location = "'.$_SERVER["DIR"].'/login";'
               . '}'
               . 'setTimeout(redirect, 3000);'
            . '</script>';
    }
} else if($_GET["mode"] == "logout") {
    $query = 'DELETE FROM nodes_session WHERE token LIKE "'.$_COOKIE["token"].'" AND user_id = "'.$_SESSION["user"]["id"].'"';
    engine::mysql($query);
    unset($_SESSION["user"]);
    unset($_COOKIE['token']);
    setcookie('token', null, -1, '/');
    session_destroy();
    die('<script language="JavaScript">parent.window.location = "'.$_SERVER["DIR"].'/";</script>');
} else engine::error(404);
