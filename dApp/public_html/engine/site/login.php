<?php
/**
* Backend login page file.
* @path /engine/site/login.php
*
* @name    DAO Mansion    @version 1.0.3
* @author  Alexandr Vorkunov  <devbyzero@yandex.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*
* @var $this->title - Page title.
* @var $this->content - Page HTML data.
* @var $this->keywords - Array meta keywords.
* @var $this->description - Page meta description.
* @var $this->img - Page meta image.
* @var $this->onload - Page executable JavaScript code.
* @var $this->configs - Array MySQL configs.
*/

if (!empty($_GET[4])) {
    $this->content = engine::error();
    return;
} else if (!empty($_SESSION["user"]["id"])) {
    die('<script language="JavaScript">window.location = "'.$_SERVER["DIR"].'/account";</script>');
    return;
}
$this->content .= '<div class="w320 pt20 m0a">';
if (empty($_GET[1])) {
    $flag = 0;
    $this->title = engine::lang("Login");
    if ($_SESSION["Lang"] == "en") {
        $this->keywords = Array(
            "Authorization",
            "Web 3.0",
            "Community"
        );
        $this->description = "Authorization on the site";
    } else if ($_SESSION["Lang"] == "zh") {
        $this->keywords = Array(
            "授權",
            "Web 3.0",
            "社區"
        );
        $this->description = '網站授權';
    } else {
        $this->keywords = Array(
            "Авторизация",
            "Web 3.0",
            "Сообщество"
        );
        $this->description = "Авторизация на сайте";
    }
    if (!empty($_POST["email"]) && !empty($_POST["pass"])) {
        $email = strtolower(str_replace('"', "'", $_POST["email"]));
        $query = 'SELECT * FROM `nodes_user` WHERE `email` = "'.$email.'"';
        $res = engine::mysql($query);
        $data = mysqli_fetch_array($res);
        $pass = trim(strtolower($_POST["pass"]));
        if (!empty($data) && engine::match_passwords($pass, $data["pass"])) {
            if ($data["ban"] == "1") {
                $this->onload .= 'alert("'.engine::lang("Access denied").'");';
            } else {
                $query = 'INSERT INTO nodes_session(user_id, token, ip, create_at, expire_at) '
                        . 'VALUES("'.$data["id"].'", "'.session_id().'", "'.$_SERVER["REMOTE_ADDR"].'", NOW(), (NOW() + INTERVAL 30 DAY))';
                engine::mysql($query);
                $query = 'SELECT id FROM nodes_session WHERE token LIKE "'.session_id().'" '
                        . 'AND user_id = "'.$_SESSION["user"]["id"].'" ORDER BY id DESC LIMIT 0, 1';
                $r = engine::mysql($query);
                $d = mysqli_fetch_array($r);
                $_SESSION["user"] = $data;
                $_SESSION["user"]["session_id"] = $d["id"];
                if (!empty($_SESSION["redirect"])) {
                    $this->content .= '<script language="JavaScript">setTimeout(function() { window.location = "'.($_SESSION["redirect"]).'"; }, 1);</script>';
                    unset($_SESSION["redirect"]);
                } else {
                    $this->content .= '<script language="JavaScript">setTimeout(function() { window.location = "'.$_SERVER["DIR"].'/account"; }, 1);</script>';
                }
                $flag = 1;
            }
        } else {
            $this->onload .= 'alert("'.engine::lang("Incorrect email of password").'");';
        }
    }
    if (!$flag) {
        $this->content .= '<h1>'.engine::lang("Login").'</h1>
        <form method="POST" action="'.$_SERVER["DIR"].'/login" id="login_form" class="lh2">
            <div class="input-caption">'.engine::lang("Email").'</div>
            <input id="input-login-email" type="text" required name="email" value="'.$_POST["email"].'" class="input reg_email" placeHolder="Email" />
            <br/>
            <div class="input-caption">'.engine::lang("Password").'</div>
            <input id="input-login-password" type="password" required name="pass" class="input reg_email" value="'.$_POST["pass"].'" placeHolder="'.engine::lang("Password").'" />
            <br/>
            <input id="input-login-submit" type="submit" class="btn reg_submit" value="'.engine::lang("Continue").'" />
            <br/>
            <div style="color: #0e2556; font-size: 14px; padding-top: 25px;">
                <a id="link-sign-up" hreflang="'.$_SESSION["Lang"].'" href="'.engine::href($_SERVER["DIR"].'/signup').'">'.engine::lang("Do not have an account?").'</a>
                <br/>
                <a id="link-restore-pass" hreflang="'.$_SESSION["Lang"].'" rel="nofollow" href="'.engine::href($_SERVER["DIR"].'/login/restore').'">'.engine::lang("Forgot password").'?</a>
            </div>
        </form>';
    }
} else if ($_GET[1] == "restore") {
    if ($_SESSION["Lang"] == "en") {
        $this->keywords = Array(
            "Access recovery",
            "Password reset",
            "Web 3.0",
        );
        $this->description = "Account recovery form";
    } else if ($_SESSION["Lang"] == "zh") {
        $this->keywords = Array(
            "訪問恢復",
            "重設密碼",
            "Web 3.0",
        );
        $this->description = '帳戶恢復表格';
    } else {
        $this->keywords = Array(
            "Восстановление доступа",
            "Сброс пароля",
            "Web 3.0",
        );
        $this->description = "Форма восстановления доступа к учетной записи";
    }
    $flag = 0;
    if (!empty($_GET[2]) && !empty($_GET[3])) {
        $this->title = engine::lang("Setup new password");
        $email = urldecode($_GET[2]);
        $query = 'SELECT * FROM `nodes_user` WHERE `email` = "'.$email.'"';
        $res = engine::mysql($query);
        $data = mysqli_num_rows($res);
        if ($data) {
            $code = mb_substr(md5($email.date("Y-m-d")), 0, 8);
            if ($code == $_GET[3]) {
                if (!empty($_POST["pass"])) {
                    $password = engine::encode_password(trim(strtolower($_POST["pass"])));
                    $query = 'UPDATE `nodes_user` SET `pass` = "'.$password.'" WHERE `email` = "'.$email.'"';
                    engine::mysql($query);
                    $this->content .= '<div class="clear_block">'.engine::lang("Your password has been updated").'!</div>'
                    .'<script>function redirect() { window.location="'.$_SERVER["DIR"].'/login"; }setTimeout(redirect, 3000);</script>';
                } else {
                    $this->content .= '<h1>'.engine::lang("Setup new password").'</h1><br/>'
                        . '<form method="POST" class="lh2">'
                        . ' <input id="input-login-password" type="password" required name="pass" value="'.$_POST["email"].'" class="input reg_email" placeHolder="'.engine::lang("Password").'" /><br/>'
                        . ' <input id="input-login-submit" type="submit" class="btn reg_submit" value="'.engine::lang("Submit").'" />'
                        . '</form>';
                }
                $flag = 1;
            } else {
                $this->onload .= 'alert("'.engine::lang("Invalid confirmation code").'");';
            }
        } else {
            $this->onload .= 'alert("Email '.engine::lang("not found").'");';
        }
    }
    if (!empty($_POST["email"])) {
        $this->title = 'Reset password';
        $email = str_replace('"', "'", $_POST["email"]);
        $query = 'SELECT * FROM `nodes_user` WHERE `email` = "'.$email.'"';
        $res = engine::mysql($query);
        $data = mysqli_fetch_array($res);
        if (!empty($data)) {
            $code = mb_substr(md5($email.date("Y-m-d")), 0, 4);
            $new_pass = mb_substr(md5($email.date("Y-m-d")), 0, 8);
            email::restore_password($data["email"], $new_pass, $code);
            $this->content .= '<div class="clear_block">'.engine::lang("To process restore, please check your email").'.</div>'
                . '<script>'
                . ' function redirect() { this.location = "'.$_SERVER["DIR"].'/login"; } '
                . ' setTimeout(redirect, 3000);'
                . '</script>';
            $flag = 1;
        } else {
            $this->onload .= 'alert("Email '.engine::lang("not found").'");';
        }
    }
    if (!$flag) {
        $this->title = engine::lang("Reset password");
        $this->content .= '<h1>'.engine::lang("Reset password").'</h1>
        <form method="POST" class="lh2">
            <div class="input-caption">'.engine::lang("Email").'</div>
            <input id="input-login-email" type="text" required name="email" value="'.$_POST["email"].'" class="input reg_email" placeHolder="Email" /><br/>
            <input id="input-login-submit" type="submit" class="btn reg_submit" value="'.engine::lang("Submit").'" />
        </form>';
    }
} else {
    $this->content = engine::error(404);
    return;
}
$this->content .= '</div>';
