<?php
/**
* Print account settings page.
* @path /engine/core/account/print_settings.php
*
* @name    DAO Mansion    @version 1.0.3
* @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*
* @var $site->title - Page title.
* @var $site->content - Page HTML data.
* @var $site->keywords - Array meta keywords.
* @var $site->description - Page meta description.
* @var $site->img - Page meta image.
* @var $site->onload - Page executable JavaScript code.
* @var $site->configs - Array MySQL configs.
*
* @param object $site Site class object.
* @return string Returns content of page on success, or die with error.
* @usage <code> engine::print_settings($site); </code>
*/

function print_settings($site) {
    if ($_GET[2] == "delete") {
        $query = 'DELETE FROM `nodes_comment` WHERE `user_id` = "'.$_SESSION["user"]["id"].'"';
        engine::mysql($query);
        $query = 'DELETE FROM `nodes_inbox` WHERE `from` = "'.$_SESSION["user"]["id"].'" OR `to` = "'.$_SESSION["user"]["id"].'"';
        engine::mysql($query);
        $query = 'UPDATE `nodes_user` SET `pass` = "" WHERE `id` = "'.$_SESSION["user"]["id"].'"';
        engine::mysql($query);
        unset($_SESSION["user"]);
        $fout = '<script language="JavaScript">window.location = "'.$_SERVER["DIR"].'/";</script>';
    } else {
        $fout = '<div style="height: 70px;"></div>
            <div class="document640">';
        if (!empty($_POST["name"])) {
            $name = strip_tags(engine::escape_string($_POST["name"]));
            $email = strip_tags(strtolower(engine::escape_string($_POST["email"])));
            $bulk_ignore = intval($_POST["bulk_ignore"]);
            $query = 'SELECT `id` FROM `nodes_user` WHERE `email` = "'.$email.'" AND `id` <> "'.$_SESSION["user"]["id"].'"';
            $res = engine::mysql($query);
            $data = mysqli_fetch_array($res);
            if (!empty($data)) {
                $site->onload .= ' alert("'.engine::lang("Sorry, this email already registered").'"); ';
            } else {
                $query = 'UPDATE `nodes_user` SET `email` = "'.$email.'" WHERE `id` = "'.$_SESSION["user"]["id"].'"';
                engine::mysql($query);
            }
            $query = 'UPDATE `nodes_user` SET `name` = "'.$name.'", `bulk_ignore` = "'.$bulk_ignore.'" WHERE `id` = "'.$_SESSION["user"]["id"].'"';
            engine::mysql($query);
            $_SESSION["user"]["name"] = $name;
            $_SESSION["user"]["email"] = $email;
            $_SESSION["user"]["bulk_ignore"] = $bulk_ignore;
            if (!empty($_POST["new_profile_picture"])) {
                image::resize_image('img/data/thumb/'.$_POST["new_profile_picture"], 'img/pic/'.$_POST["new_profile_picture"], 100, 100, 1);
                $query = 'UPDATE `nodes_user` SET `photo` = "'.$_POST["new_profile_picture"].'" WHERE `id` = "'.$_SESSION["user"]["id"].'"';
                engine::mysql($query);
                $_SESSION["user"]["photo"] = $_POST["new_profile_picture"];
            }
        }if (!empty($_POST["pass"])) {
            $password = engine::encode_password(trim(strtolower($_POST["pass"])));
            $query = 'UPDATE `nodes_user` SET `pass` = "'.$password.'" WHERE `id` = "'.$_SESSION["user"]["id"].'"';
            engine::mysql($query);
        }
        if (empty($_SESSION["user"]["email"])) {
            $fout .= '<p>'.engine::lang("Enter your email and password to continue").'</p>';
        }
        $fout .= '
        <form method="POST" id="edit_profile_form"> 
        <input type="hidden" name="new_profile_picture" id="new_profile_picture" />
        <table class="w400 m0a" align="center">
            <tr>
                <td align=left colspan=2>
                    <div class="user_photo_block"><img src="'.$_SERVER["DIR"].'/img/pic/'.$_SESSION["user"]["photo"].'" width=80 /></div>
                    <div class="ml100">
                        '.engine::lang("Profile image").'
                        <br/>
                        <br/>
                        <input id="change-picture" type="button" class="btn w280" value="'.engine::lang("Change picture").'" onClick=\'document.framework.showPhotoEditor(0, 0);\' /><br/>
                    </div>
                </td>
            </tr>
            <tr>
                <td align=right class="settings_caption">'.engine::lang("Name").'</td>
                <td class="pb10"><input id="input-name" type="text" name="name" value="'.$_SESSION["user"]["name"].'" class="input w280" /></td>
            </tr>';

        if (!empty($_SESSION["user"]["email"])) {
            $fout .= '
            <tr>
                <td align=right class="settings_caption">'.engine::lang("Email").'</td>
                <td class="pb10"><input id="input-email" type="text" name="email" value="'.$_SESSION["user"]["email"].'" class="input w280" /></td>
            </tr>
            <tr>
                <td align=right class="settings_caption">'.engine::lang("Password").'</td>
                <td class="pb10"><input id="input-password" type="password" name="pass" value="" placeHolder="'.engine::lang("New password").'" class="input w280" /></td>
            </tr>';
        } else {
            $fout .= '
            <tr>
                <td align=right class="settings_caption">'.engine::lang("Email").'</td>
                <td class="pb10"><input id="input-email" required type="text" name="email" placeHolder="'.engine::lang("Enter your email").'" class="input w280" /></td>
            </tr>
            <tr>
                <td align=right class="settings_caption">'.engine::lang("Password").'</td>
                <td class="pb10"><input id="input-password" required type="password" name="pass" value="" placeHolder="'.engine::lang("Enter your password").'" class="input w280" /></td>
            </tr>';
        }
        $fout .= '
        <tr>
            <td align=right class="settings_caption">'.engine::lang("Subscription").'</td>
            <td class="pb10">
                <select  id="select-subscription" name="bulk_ignore" class="input w280" >
                    <option id="option-enabled" value="0">'.engine::lang("Enabled").'</option>
                    <option id="option-disabled" value="1" '.($_SESSION["user"]["bulk_ignore"]?'selected':'').'>'.engine::lang("Disabled").'</option>
                </select>
            </td>
        </tr> 
        <tr>
        <td align=right  class="settings_caption">'.engine::lang("Telegram").'</td>
        <td align=left class="pl7">
            <div class="settings_url">
                <a href="https://t.me/'.str_replace('@', '', $_SESSION["user"]["url"]).'" target="_blank">'.$_SESSION["user"]["url"].'</a>
            </div>
            <br/>
            <br/>
        </td>
            </tr>
            <tr>
                <td class="pt20" colspan=2>
                    <input id="input-save-changes" type="submit" class="btn w280" value="'.engine::lang("Save changes").'" /><br/><br/>
                    <input id="input-delete-account" type="button" class="btn w280" value="'.engine::lang("Delete account").'" onClick=\'alertify.confirm("'.engine::lang("Are you sure you want to delete your account").'?", function() { window.location = "/account/settings/delete"; }, function() { alertify.confirm().destroy();} );\' />
                </td>
            </tr>
            </table>
            </form><br/>
            </div>
            ';
    }
    return $fout;
}
