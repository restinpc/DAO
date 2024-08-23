<?php
/**
* Backend profile pages file.
* @path /engine/site/profile.php
*
* @name    DAO Mansion    @version 1.0.5
* @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*
* @var $site->title - Page title.
* @var $site->content - Page HTML data.
* @var $site->keywords - Array meta keywords.
* @var $site->description - Page meta description.
* @var $site->img - Page meta image.
* @var $site->onload - Page executable JavaScript code.
*/

function profile($site) {
    engine::log('profile()');
    try {
        if (!empty($_GET[1]) || $_GET[0][0] !== "@") {
            $site->content = engine::error();
            return;
        }
        $query = 'SELECT * FROM `nodes_user` WHERE `url` LIKE "'.engine::escape_string(str_replace("@", "", $_GET[0])).'"';
        $res = engine::mysql($query);
        $user = mysqli_fetch_array($res);
        if (empty($user) || empty($user["pass"])) {
            $site->content = engine::error();
            return;
        } else {
            $site->title = $user["name"];
            $site->keywords = array(
                $user["name"],
                engine::lang("Member of") . ' Web 3.0 ' . engine::lang("community"),
                $user["email"], $user["url"]
            );
            $site->content = engine::print_header($user["id"]);
            $button = '';
            if ($_SERVER["configs"]["free_message"]) {
                if (empty($_SESSION["user"]["id"])) {
                    $button = '<a id="link-send-message" hreflang="'.$_SESSION["Lang"].'" href="'.engine::href($_SERVER["DIR"].'/login').'"><input type="button" class="btn w280" value="'.engine::lang("Login to Send message").'" /><br/><br/>';
                } else {
                    $button = '<a id="link-send-message" hreflang="'.$_SESSION["Lang"].'" href="'.engine::href($_SERVER["DIR"].'/account/inbox/'.$user["id"]).'"><input type="button" class="btn w280" value="'.engine::lang("Send message").'" /><br/><br/>';
                }
            }
            $rating = number_format(($user["rating"] / (intval($user["votes"]) > 0 ? $user["votes"] : 1)), 2);
            if (!is_nan(floatval($rating))) {
                $rating = 0;
            }
            $site->content .= '
            <div class="profile_star m10 fl">
                <div class="profile_stars">
                    <div class="baseimage" style="margin-top: -'.(160 - round($rating) * 32).'px;" ></div>
                </div>
                <div class="votes">
                   '.$rating.' / 5.00 ('.$user["votes"].' '.engine::lang("votes").')
                </div>
            </div>
            <div class="document">
                <div class="clear_block">
                    <p>'.engine::lang("Member of").' <b>Web 3.0</b> '.engine::lang("community").'</p>
                    <br/><br/>'.$button.'<br/>
                </div>
            </div>';
        }
    } catch(Exception $e) {
        engine::throw('profile()', $e);
    }
}

profile($this);