<?php
/**
* Backend login page file.
* @path /engine/site/login.php
*
* @name    DAO Mansion    @version 1.0.0
* @author  Alexandr Vorkunov  <developing@nodes-tech.ru>
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

if(!empty($_GET[4])){
    $this->content = engine::error();
    return;
}
$this->content .= '<div class="w320 pt20 m0a">';
if(empty($_GET[1])){
    $flag = 0;
    $this->title = lang("Login");
    if ($_SESSION["Lang"] == "en") {
        $this->keywords = [
            "Authorization",
            "Web 3.0",
            "Community"
        ];
        $this->description = "Authorization on the site";
    } else if ($_SESSION["Lang"] == "zh") {
        $this->keywords = [
            "授權",
            "Web 3.0",
            "社區"
        ];
        $this->description = '網站授權';
    } else {
        $this->keywords = [
            "Авторизация",
            "Web 3.0",
            "Сообщество"
        ];
        $this->description = "Авторизация на сайте";
    }
    if (!empty($_POST["email"]) && !empty($_POST["pass"])) {
        $email = strtolower(str_replace('"', "'", $_POST["email"]));
        $query = 'SELECT * FROM `nodes_user` WHERE `email` = "'.$email.'"';
        $res = engine::mysql($query);
        $data = mysqli_fetch_array($res);
        $pass = trim(strtolower($_POST["pass"]));
        if (!empty($data) && engine::match_passwords($pass, $data["pass"], $data["salt"])) {
            if ($data["ban"] == "1") {
                $this->onload .= 'alert("'.lang("Access denied").'");';
            } else {
                $_SESSION["user"] = $data;
                $query = 'UPDATE `nodes_user` SET `token` = "'.session_id().'", '
                    . '`ip` = "'.$_SERVER["REMOTE_ADDR"].'" WHERE `id` = "'.$_SESSION["user"]["id"].'"';
                engine::mysql($query);
                if ($_SESSION["user"]["id"] == "1") {
                    $this->content .= '<script language="JavaScript">setTimeout(function(){ window.location = "'.$_SERVER["DIR"].'/admin"; }, 1);</script>';
                } else if(!empty($_SESSION["redirect"])) {
                    $this->content .= '<script language="JavaScript">setTimeout(function(){ window.location = "'.($_SESSION["redirect"]).'"; }, 1);</script>';
                    unset($_SESSION["redirect"]);
                } else {
                    $this->content .= '<script language="JavaScript">setTimeout(function(){ window.location = "'.$_SERVER["DIR"].'/account"; }, 1);</script>';
                }
                $flag = 1;
            }
        }else{
            $this->onload .= 'alert("'.lang("Incorrect email of password").'");';
        }
    }
    if(!$flag){
        $this->content .= '<h1>'.lang("Login").'</h1>
        <form method="POST" action="'.$_SERVER["DIR"].'/login" id="login_form" class="lh2">
            <div class="input-caption">'.lang("Email").'</div>
            <input id="input-login-email" type="text" required name="email" value="'.$_POST["email"].'" class="input reg_email" placeHolder="Email" />
            <br/>
            <div class="input-caption">'.lang("Password").'</div>
            <input id="input-login-password" type="password" required name="pass" class="input reg_email" value="'.$_POST["pass"].'" placeHolder="'.lang("Password").'" />
            <br/>
            <input id="input-login-submit" type="submit" class="btn reg_submit" value="'.lang("Continue").'" />
            <br/>
            <div style="color: #0e2556; font-size: 14px; padding-top: 25px;">
                <a id="link-sign-up" href="'.$_SERVER["DIR"].'/signup">'.lang("Do not have an account?").'</a>
                <br/>
                <a id="link-restore-pass" rel="nofollow" href="'.$_SERVER["DIR"].'/login/restore">'.lang("Forgot password").'?</a>
            </div>
        </form>';
    }
} else if($_GET[1] == "restore") {
    if ($_SESSION["Lang"] == "en") {
        $this->keywords = [
            "Access recovery",
            "Password reset",
            "Web 3.0",
        ];
        $this->description = "Account recovery form";
    } else if ($_SESSION["Lang"] == "zh") {
        $this->keywords = [
            "訪問恢復",
            "重設密碼",
            "Web 3.0",
        ];
        $this->description = '帳戶恢復表格';
    } else {
        $this->keywords = [
            "Восстановление доступа",
            "Сброс пароля",
            "Web 3.0",
        ];
        $this->description = "Форма восстановления доступа к учетной записи";
    }
    $flag = 0;
    if (!empty($_GET[2]) && !empty($_GET[3])) {
        $this->title = lang("Setup new password");
        $email = urldecode($_GET[2]);
        $query = 'SELECT * FROM `nodes_user` WHERE `email` = "'.$email.'"';
        $res = engine::mysql($query);
        $data = mysqli_num_rows($res);
        if($data){
            $code = mb_substr(md5($email.date("Y-m-d")), 0, 8);
            if($code == $_GET[3]){
                if(!empty($_POST["pass"])){
                    $password = engine::encode_password(trim(strtolower($_POST["pass"])));
                    $pass = $password["pass"];
                    $salt = $password["salt"];
                    $query = 'UPDATE `nodes_user` SET `pass` = "'.$pass.'", `salt` = "'.$salt.'" WHERE `email` = "'.$email.'"';
                    engine::mysql($query);
                    $this->content .= '<div class="clear_block">'.lang("Your password has been updated").'!</div>'
                    . '<script>function redirect(){window.location="'.$_SERVER["DIR"].'/login";}setTimeout(redirect, 3000);</script>';
                }else{
                    $this->content .= ''
                    . '<h1>'.lang("Setup new password").'</h1><br/>'
                    . '<form method="POST" class="lh2">'
                    . '<input id="input-login-password" type="password" required name="pass" value="'.$_POST["email"].'" class="input reg_email" placeHolder="'.lang("Password").'" /><br/>'
                    . '<input id="input-login-submit" type="submit" class="btn reg_submit" value="'.lang("Submit").'" />
                    </form>';
                }
                $flag = 1;
            }else{
                $this->onload .= 'alert("'.lang("Invalid confirmation code").'");';
            }
        }else{
            $this->onload .= 'alert("Email '.lang("not found").'");';
        }
    }
    if(!empty($_POST["email"])){
        $this->title = 'Reset password';
        $email = str_replace('"', "'", $_POST["email"]);
        $query = 'SELECT * FROM `nodes_user` WHERE `email` = "'.$email.'"';
        $res = engine::mysql($query);
        $data = mysqli_fetch_array($res);
        if(!empty($data)){
            $code = mb_substr(md5($email.date("Y-m-d")), 0, 4);
            $new_pass = mb_substr(md5($email.date("Y-m-d")), 0, 8);
            email::restore_password($data["email"], $new_pass, $code);
            $this->content .= '<div class="clear_block">'.lang("To process restore, please check your email").'.</div>'
                    . '<script>'
                    . 'function redirect(){this.location = "'.$_SERVER["DIR"].'/login";}setTimeout(redirect, 3000); </script>';
            $flag = 1;
        }else{
            $this->onload .= 'alert("Email '.lang("not found").'");';
        }
    }
    if (!$flag) {
        $this->title = lang("Reset password");
        $this->content .= '<h1>'.lang("Reset password").'</h1>
        <form method="POST" class="lh2">
            <div class="input-caption">'.lang("Email").'</div>
            <input id="input-login-email" type="text" required name="email" value="'.$_POST["email"].'" class="input reg_email" placeHolder="Email" /><br/>
            <input id="input-login-submit" type="submit" class="btn reg_submit" value="'.lang("Submit").'" />
        </form>';
    }
} else {
    $this->content = engine::error(404);
    return;
}
$this->content .= '</div>';
