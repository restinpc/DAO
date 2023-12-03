<?php
/**
* Backend register page file.
* @path /engine/site/register.php
*
* @name    DAO Mansion    @version 1.0.0
* @author  Aleksandr Vorkunov  <developing@nodes-tech.ru>
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

if (!empty($_GET[1])) {
    $this->content = engine::error();
    return;
} else if (!empty($_SESSION["user"]["id"])) {
    die('<script language="JavaScript">window.location = "'.$_SERVER["DIR"].'/account";</script>');
    return;
}
$this->title = lang("Sign Up");
if ($_SESSION["Lang"] == "en") {
    $this->keywords = [
        "Registration",
        "Web 3.0",
        "Community"
    ];
    $this->description = "Registering as a Member of the Web 3.0 Community";
} else if ($_SESSION["Lang"] == "zh") {
    $this->keywords = [
        "登記",
        "Web 3.0",
        "社區"
    ];
    $this->description = '註冊成為 Web 3.0 社區的成員';
} else {
    $this->keywords = [
        "Регистрация",
        "Web 3.0",
        "Сообщество"
    ];
    $this->description = "Регистрация в качестве участника Web 3.0 сообщества";
}
if (!empty($_POST["email"]) && !empty($_POST["pass"])) {
    if ($_POST["captcha"] != $_SESSION["captcha"]) {
        $this->onload .= ' alert("'.lang("Error").'. '.lang("Invalid conformation code").'."); ';
    } else {
        $name = engine::escape_string($_POST["name"]);
        $email = strtolower(engine::escape_string($_POST["email"]));
        $telegram = strtolower(engine::escape_string($_POST["telegram"]));
        $code = mb_substr(md5(date("U")), 0, 4);
        $password = engine::encode_password(trim(strtolower($_POST["pass"])));
        $pass = $password["pass"];
        $salt = $password["salt"];
        $confirm = !$this->configs["confirm_signup_email"];
        $query = 'SELECT * FROM `nodes_user` WHERE `email` = "'.$email.'"';
        $r = engine::mysql($query);
        $d = mysqli_fetch_array($r);
        if (!empty($d)) {
            $this->onload .= ' alert("'.lang("Error").'. '.lang("Email").' '.lang("already exist").'."); ';
            unset($_POST["email"]);
        } else if(strpos($email, "@")) {
            $query = 'INSERT INTO `nodes_user` (`name`, `photo`, `url`, `email`, `pass`, `salt`, `lang`, `online`, `confirm`, `code`) 
                VALUES ("'.$name.'", "anon.jpg", "'.$telegram.'", "'.$email.'", "'.$pass.'", "'.$salt.'", "'.$_SESSION["Lang"].'", "'.date("U").'", "'.$confirm.'", "'.$code.'")';
            engine::mysql($query);
            $query = 'SELECT * FROM `nodes_user` WHERE `email` = "'.$email.'"';
            $res = engine::mysql($query);
            $data = mysqli_fetch_array($res);
            unset($_SESSION["user"]);
            $_SESSION["user"] = $data;
            $query = 'UPDATE `nodes_user` SET `token` = "'.session_id().'", '
                . '`ip` = "'.$_SERVER["REMOTE_ADDR"].'" WHERE `id` = "'.$_SESSION["user"]["id"].'"';
            engine::mysql($query);
            if ($this->configs["confirm_signup_email"]) {
                email::confirmation($email, $name, $code);
            } else if($this->configs["send_registration_email"]) {
                email::registration($email, $name);
            }
            if (empty($_SESSION["redirect"])) {
                $this->content = '<script language="JavaScript">setTimeout(function(){ window.location = "'.$_SERVER["DIR"].'/account"; }, 1);</script>';
                $this->onload .= 'window.location = "'.$_SERVER["DIR"].'/account";';
            } else {
                $this->content = '<script language="JavaScript">setTimeout(function(){ window.location = "'.$_SESSION["redirect"].'"; }, 1);</script>';
            }
            return;
        } else {
            $this->onload .= ' alert("'.lang("Error").'. '.lang("Incorrect email").strpos($email, "@").'."); ';
            unset($_POST["email"]);
        }
    }
} else {
    $this->onload .= '$("input-email").focus();';
    $this->content = '<script>
    function next() {
        let flag = true;
        if (!document.getElementById("input-email").value.length) {
            window.alert("Email is required");
            flag = false;
        } else if (!document.getElementById("pass1").value.length) {
            window.alert("Password is required");
            flag = false;
        } else if (!document.getElementById("pass2").value.length) {
            window.alert("Password confirmation is required");
            flag = false;
        } else if (document.getElementById("pass1").value != document.getElementById("pass2").value) {
            window.alert("Passwords do not match");
            flag = false;
        }
        if (flag) {
            document.getElementById("step1").style.display = "none";
            document.getElementById("step2").style.display = "block";
        }
    }
    </script>
    <div class="w320 pt20 m0a">
    <h1>' . lang("Sign Up") . '</h1>
    <a vr-control id="link-login" href="' . $_SERVER["DIR"] . '/login">' . lang("Already have an account?") . '</a><br/>
    <form method="POST"  style="line-height:2.0; padding-top: 10px;" id="reg_form" onSubmit=\'event.preventDefault(); if($id("pass1").value==$id("pass2").value){$id("reg_form").submit();}else{alert("' . lang("Passwords do not match") . '"); $id("pass2").value="";}\'>
        <div id="step1">
            <div class="input-caption">'.lang("Email").'</div>
            <input vr-control id="input-email" autofocus required type="email" name="email" value="' . $_POST["email"] . '" class="input reg_email" placeHolder="' . lang("Email") . '" title="' . lang("Email") . '" /><br/>
            <div class="input-caption">'.lang("Password").'</div>
            <input vr-control id="pass1" required type="password" name="pass" class="input reg_email" title="' . lang("Password") . '"  value="' . $_POST["pass"] . '" /><br/>
            <div class="input-caption">'.lang("Repeat password").'</div>
            <input vr-control id="pass2" required type="password" name="pass_repeat" class="input reg_email" title="' . lang("Repeat password") . '"  value="' . $_POST["pass_repeat"] . '" /><br/>
            <div style="padding: 10px; padding-bottom: 5px; line-height: 1.5;">' .
            lang("By registering on the site, you accept the") . '<br/> <a vr-control id="link-terms" href="/terms_and_conditions" target="_blank">' . lang("Terms and Conditions") . '</a> <br/>' .
            lang("and are familiar with the") . ' <a vr-control id="link-privacy" href="/privacy_policy" target="_blank">' . lang("Privacy Policy") . '</a>' . '</div>
            <input vr-control id="input-next" type="button" class="btn reg_submit" value="' . lang("Next") . '" onClick="next();" />
        </div>
        <div id="step2" style="display: none;">
            <div class="input-caption">'.lang("Name").'</div>
            <input vr-control id="input-name" required type="text" name="name" value="' . $_POST["name"] . '" class="input reg_email" placeHolder="' . lang("Name") . '" title="' . lang("Name") . '"  /><br/>
            <div class="input-caption">'.lang("Telegram").'</div>
            <input vr-control id="input-telegram" required type="text" name="telegram" value="' . $_POST["telegram"] . '" class="input reg_email" placeHolder="@username" title="' . lang("Telegram") . '"  /><br/>
            <br/><center><img src="' . $_SERVER["DIR"] . '/captcha.php?' . md5(date("U")) . '" /></center>
            <input vr-control id="input-captcha" required type="text" name="captcha" class="input reg_captcha" placeHolder="' . lang("Confirmation code") . '" title="' . lang("Confirmation code") . '" />
            <input vr-control id="input-submit" type="submit" class="btn reg_submit" value="' . lang("Submit") . '" />
        </div>
    </form>
    <br/>
    <br/>
    </div>';
}
