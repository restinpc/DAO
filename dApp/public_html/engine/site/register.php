<?php
/**
* Backend register page file.
* @path /engine/site/register.php
*
* @name    DAO Mansion    @version 1.0.2
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
$this->title = engine::lang("Sign Up");
if ($_SESSION["Lang"] == "en") {
    $this->keywords = Array(
        "Registration",
        "Web 3.0",
        "Community"
    );
    $this->description = "Registering as a Member of the Web 3.0 Community";
} else if ($_SESSION["Lang"] == "zh") {
    $this->keywords = Array(
        "登記",
        "Web 3.0",
        "社區"
    );
    $this->description = '註冊成為 Web 3.0 社區的成員';
} else {
    $this->keywords = Array(
        "Регистрация",
        "Web 3.0",
        "Сообщество"
    );
    $this->description = "Регистрация в качестве участника Web 3.0 сообщества";
}
if (!empty($_POST["email"]) && !empty($_POST["pass"])) {
    if ($_POST["captcha"] != $_SESSION["captcha"]) {
        $this->onload .= ' alert("'.engine::lang("Error").'. '.engine::lang("Invalid conformation code").'."); ';
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
            $this->onload .= ' alert("'.engine::lang("Error").'. '.engine::lang("Email").' '.engine::lang("already exist").'."); ';
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
            $this->onload .= ' alert("'.engine::lang("Error").'. '.engine::lang("Incorrect email").strpos($email, "@").'."); ';
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
    <h1>' . engine::lang("Sign Up") . '</h1>
    <a id="link-login" hreflang="'.$_SESSION["Lang"].'" href="'.engine::href($_SERVER["DIR"] . '/login').'">' . engine::lang("Already have an account?") . '</a><br/>
    <form method="POST"  style="line-height:2.0; padding-top: 10px;" id="reg_form" onSubmit=\'event.preventDefault(); if($id("pass1").value==$id("pass2").value){$id("reg_form").submit();}else{alert("' . engine::lang("Passwords do not match") . '"); $id("pass2").value="";}\'>
        <div id="step1">
            <div class="input-caption">'.engine::lang("Email").'</div>
            <input id="input-email" autofocus required type="email" name="email" value="' . $_POST["email"] . '" class="input reg_email" placeHolder="' . engine::lang("Email") . '" title="' . engine::lang("Email") . '" /><br/>
            <div class="input-caption">'.engine::lang("Password").'</div>
            <input id="pass1" required type="password" name="pass" class="input reg_email" title="' . engine::lang("Password") . '"  value="' . $_POST["pass"] . '" /><br/>
            <div class="input-caption">'.engine::lang("Repeat password").'</div>
            <input id="pass2" required type="password" name="pass_repeat" class="input reg_email" title="' . engine::lang("Repeat password") . '"  value="' . $_POST["pass_repeat"] . '" /><br/>
            <div style="padding: 10px; padding-bottom: 5px; line-height: 1.5;">' .
            engine::lang("By registering on the site, you accept the") . '<br/> <a id="link-terms" hreflang="'.$_SESSION["Lang"].'" href="'.engine::href($_SERVER["DIR"].'/content/terms_and_conditions').'" target="_blank">' . engine::lang("Terms and Conditions") . '</a> <br/>' .
            engine::lang("and are familiar with the") . ' <a id="link-privacy" hreflang="'.$_SESSION["Lang"].'" href="'.engine::href($_SERVER["DIR"].'/content/privacy_policy').'" target="_blank">' . engine::lang("Privacy Policy") . '</a>' . '</div>
            <input id="input-next" type="button" class="btn reg_submit" value="' . engine::lang("Next") . '" onClick="next();" />
        </div>
        <div id="step2" style="display: none;">
            <div class="input-caption">'.engine::lang("Name").'</div>
            <input id="input-name" required type="text" name="name" value="' . $_POST["name"] . '" class="input reg_email" placeHolder="' . engine::lang("Name") . '" title="' . engine::lang("Name") . '"  /><br/>
            <div class="input-caption">'.engine::lang("Telegram").'</div>
            <input id="input-telegram" required type="text" name="telegram" value="' . $_POST["telegram"] . '" class="input reg_email" placeHolder="@username" title="' . engine::lang("Telegram") . '"  /><br/>
            <br/><center><img src="' . $_SERVER["DIR"] . '/captcha.php?' . md5(date("U")) . '" /></center>
            <input id="input-captcha" required type="text" name="captcha" class="input reg_captcha" placeHolder="' . engine::lang("Confirmation code") . '" title="' . engine::lang("Confirmation code") . '" />
            <input id="input-submit" type="submit" class="btn reg_submit" value="' . engine::lang("Submit") . '" />
        </div>
    </form>
    <br/>
    <br/>
    </div>';
}
