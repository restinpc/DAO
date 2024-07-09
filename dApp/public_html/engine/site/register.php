<?php
/**
* Backend register page file.
* @path /engine/site/register.php
*
* @name    DAO Mansion    @version 1.0.3
* @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*
* @var $this->title - Page title.
* @var $this->content - Page HTML data.
* @var $this->keywords - Array meta keywords.
* @var $this->description - Page meta description.
* @var $this->img - Page meta image.
* @var $this->onload - Page executable JavaScript code.
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
    $this->keywords = array(
        "Registration",
        "Web 3.0",
        "Community"
    );
    $this->description = "Registering as a Member of the Web 3.0 Community";
} else if ($_SESSION["Lang"] == "zh") {
    $this->keywords = array(
        "登記",
        "Web 3.0",
        "社區"
    );
    $this->description = '註冊成為 Web 3.0 社區的成員';
} else {
    $this->keywords = array(
        "Регистрация",
        "Web 3.0",
        "Сообщество"
    );
    $this->description = "Регистрация в качестве участника Web 3.0 сообщества";
}
if (!empty($_POST["email"]) && !empty($_POST["pass"]) && !empty($_POST["telegram"])) {
    if ($_POST["captcha"] != $_SESSION["captcha"]) {
        $this->onload .= ' alert("'.engine::lang("Error").'. '.engine::lang("Invalid conformation code").'."); ';
    } else {
        $name = engine::escape_string($_POST["name"]);
        $email = strtolower(engine::escape_string($_POST["email"]));
        $telegram = strtolower(engine::escape_string($_POST["telegram"]));
        $code = mb_substr(md5(date("U")), 0, 4);
        $password = engine::encode_password(trim(strtolower($_POST["pass"])));
        $confirm = !$_SERVER["configs"]["confirm_signup_email"];
        $query = 'SELECT * FROM `nodes_user` WHERE `email` = "'.$email.'"';
        $r = engine::mysql($query);
        $d = mysqli_fetch_array($r);
        if (!empty($d)) {
            $this->onload .= ' alert("'.engine::lang("Error").'. '.engine::lang("Email").' '.engine::lang("already exist").'."); ';
            unset($_POST["email"]);
        } else if (strpos($email, "@")) {
            $query = 'SELECT COUNT(*) as count FROM nodes_user';
            $res = engine::mysql($query);
            $data = mysqli_fetch_array($res);
            $admin = intval($data["count"]) == 0 ? 1 : 0;
            $query = 'INSERT INTO `nodes_user` (`name`, `admin`, `photo`, `url`, `email`, `pass`, `lang`, `online`, `confirm`, `code`) '
                    . 'VALUES ("'.$name.'", "'.$admin.'", "anon.jpg", "'.$telegram.'", "'.$email.'", "'.$password.'", "'.$_SESSION["Lang"].'", "'.date("U").'", "'.$confirm.'", "'.$code.'")';
            engine::mysql($query);
            $query = 'SELECT * FROM `nodes_user` WHERE `email` LIKE "'.$email.'"';
            $res = engine::mysql($query);
            $data = mysqli_fetch_array($res);
            unset($_SESSION["user"]);
            $query = 'INSERT INTO nodes_session(user_id, token, ip, create_at, expire_at) '
                    .'VALUES("'.$data["id"].'", "'.session_id().'", "'.$_SERVER["REMOTE_ADDR"].'", NOW(), (NOW() + INTERVAL 30 DAY))';
            engine::mysql($query);
            $query = 'SELECT id FROM nodes_session WHERE token LIKE "'.session_id().'" '
                    . 'AND user_id = "'.$_SESSION["user"]["id"].'" ORDER BY id DESC LIMIT 0, 1';
            $r = engine::mysql($query);
            $d = mysqli_fetch_array($r);
            $data["session_id"] = $d["id"];
            $_SESSION["user"] = $data;
            if ($_SERVER["configs"]["confirm_signup_email"]) {
                email::confirmation($email, $name, $code);
            } else if ($_SERVER["configs"]["send_registration_email"]) {
                email::registration($email, $name);
            }
            if (empty($_SESSION["redirect"])) {
                $this->content = '<script language="JavaScript">setTimeout(() => { window.location = "'.$_SERVER["DIR"].'/account"; }, 1);</script>';
                $this->onload .= 'window.location = "'.$_SERVER["DIR"].'/account";';
            } else {
                $this->content = '<script language="JavaScript">setTimeout(() => { window.location = "'.$_SESSION["redirect"].'"; }, 1);</script>';
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
    if (!document.framework) {
        document.framework = {};
    }
    if (!document.framework.register) {
        document.framework.register = {};
    }
    document.framework.register.next = () => {
        let flag = true;
        if (!$id("input-email").value.length) {
            window.alert("'.engine::lang("Email is required").'");
            flag = false;
        } else if (!$id("pass1").value.length) {
            window.alert("'.engine::lang("Password is required").'");
            flag = false;
        } else if (!$id("pass2").value.length) {
            window.alert("'.engine::lang("Password confirmation is required").'");
            flag = false;
        } else if ($id("pass1").value != $id("pass2").value) {
            window.alert("'.engine::lang("Passwords do not match").'");
            flag = false;
        }
        if (flag) {
            $id("step1").style.display = "none";
            $id("step2").style.display = "block";
        }
    }
    document.framework.register.submit = () => {
        if ($id("pass1").value == $id("pass2").value) {
            if (!$id("input-telegram").value.length) {
                window.alert("'.engine::lang("Telegram id is required").'");
                $id("input-telegram").focus();
            } else {
                $id("reg_form").submit();
            }
        } else {
            window.alert("'.engine::lang("Passwords do not match").'");
            $id("pass2").value = "";
            $id("pass2").focus();
        }
    }
    </script>
    <div class="w320 pt20 m0a">
        <h1>'.engine::lang("Sign Up").'</h1>
        <a id="link-login" hreflang="'.$_SESSION["Lang"].'" href="'.engine::href($_SERVER["DIR"].'/login').'">'.engine::lang("Already have an account?").'</a><br/>
        <form method="POST" style="line-height:2.0; padding-top: 10px;" id="reg_form" onSubmit=\'event.preventDefault(); document.framework.register.submit();\'>
            <div id="step1">
                <div class="input-caption">'.engine::lang("Email").'</div>
                <input id="input-email" autofocus required type="email" name="email" value="'.$_POST["email"].'" class="input reg_email" placeHolder="'.engine::lang("Email").'" title="'.engine::lang("Email").'" /><br/>
                <div class="input-caption">'.engine::lang("Password").'</div>
                <input id="pass1" required type="password" name="pass" class="input reg_email" title="'.engine::lang("Password").'" value="'.$_POST["pass"].'" /><br/>
                <div class="input-caption">'.engine::lang("Repeat password").'</div>
                <input id="pass2" required type="password" name="pass_repeat" class="input reg_email" title="'.engine::lang("Repeat password").'" value="'.$_POST["pass_repeat"].'" /><br/>
                <div style="padding: 10px; padding-bottom: 5px; line-height: 1.5;">' .
                engine::lang("By registering on the site, you accept the").'<br/> <a id="link-terms" hreflang="'.$_SESSION["Lang"].'" href="'.engine::href($_SERVER["DIR"].'/content/terms_and_conditions').'" target="_blank">'.engine::lang("Terms & conditions").'</a> <br/>' .
                engine::lang("and are familiar with the").' <a id="link-privacy" hreflang="'.$_SESSION["Lang"].'" href="'.engine::href($_SERVER["DIR"].'/content/privacy_policy').'" target="_blank">'.engine::lang("Privacy policy").'</a>'.'</div>
                <input id="input-next" type="button" class="btn reg_submit" value="'.engine::lang("Next").'" onClick="document.framework.register.next();" />
            </div>
            <div id="step2" style="display: none;">
                <div class="input-caption">'.engine::lang("Name").'</div>
                <input id="input-name" required type="text" name="name" value="'.$_POST["name"].'" class="input reg_email" placeHolder="'.engine::lang("Name").'" title="'.engine::lang("Name").'" /><br/>
                <div class="input-caption">'.engine::lang("Telegram").'</div>
                <input id="input-telegram" required type="text" name="telegram" value="'.$_POST["telegram"].'" class="input reg_email" title="'.engine::lang("Telegram").'" /><br/>
                <br/><center><img src="'.$_SERVER["DIR"].'/captcha.php?rand='.md5(date("U")).'" /></center>
                <input id="input-captcha" required type="text" name="captcha" class="input reg_captcha" placeHolder="'.engine::lang("Confirmation code").'" title="'.engine::lang("Confirmation code").'" />
                <input id="input-submit" type="submit" class="btn reg_submit" value="'.engine::lang("Submit").'" />
            </div>
        </form>
        <br/>
        <br/>
    </div>';
}
