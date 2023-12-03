<?php
/**
* Backend profile pages file.
* @path /engine/site/profile.php
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

function fallback($site) {
    $query = 'SELECT * FROM `nodes_catalog` WHERE url LIKE "'.engine::escape_string($_GET[0]).'" AND lang = "'.$_SESSION["Lang"].'"';
    $res = engine::mysql($query);
    $data = mysqli_fetch_array($res);
    if (!empty($data)) {
        $site->content = '<script>window.location = "'.$_SERVER["DIR"].'/content/'.$data["url"].'";</script>';
        return;
    } else {
        $query = 'SELECT * FROM `nodes_content` WHERE url LIKE "'.engine::escape_string($_GET[0]).'" AND lang = "'.$_SESSION["Lang"].'"';
        $res = engine::mysql($query);
        $data = mysqli_fetch_array($res);
        if (!empty($data)) {
            $site->content = '<script>window.location = "'.$_SERVER["DIR"].'/content/'.$data["url"].'";</script>';
            return;
        } else {
            $site->content = engine::error();
            return;
        }
    }
}

if (!empty($_GET[1])) {
    return fallback($this);
}
$query = 'SELECT * FROM `nodes_user` WHERE `url` LIKE "'.engine::escape_string($_GET[0]).'"';
$res = engine::mysql($query);
$user = mysqli_fetch_array($res);
if (empty($user) || empty($user["pass"])) {
    return fallback($this);
} else {
    $this->title = $user["name"];
    $this->keywords = [$user["name"], lang("Member of") . ' Web 3.0 ' . lang("community"), $user["email"], $user["url"]];
    $this->content = engine::print_header($this, $user["id"]);
    if ($this->configs["free_message"]) {
        if (empty($_SESSION["user"]["id"])) {
            $button = '<a id="link-send-message" href="' . $_SERVER["DIR"] . '/login" href="' . $_SERVER["DIR"] . '/login"><input type="button" class="btn w280" value="' . lang("Login to Send message") . '" /><br/><br/>';
        } else {
            $button = '<a id="link-send-message" href="' . $_SERVER["DIR"] . '/account/inbox/' . $user["id"] . '"><input type="button" class="btn w280" value="' . lang("Send message") . '" /><br/><br/>';
        }
    }
    $rating = number_format(($user["rating"] / $user["votes"]), 2);
    $this->content .= '
    <div class="profile_star m10 fl">
        <div class="profile_stars">
            <div class="baseimage" style="margin-top: -' . (160 - round($rating) * 32) . 'px;" ></div>
        </div>
        <div class="votes">
           ' . $rating . ' / 5.00 (' . $user["votes"] . ' ' . lang("votes") . ')
        </div>
    </div>
    <div class="document">
        <div class="clear_block">
            <p>' . lang("Member of") . ' <b>Web 3.0</b> ' . lang("community") . '.</p>
            <br/><br/>' . $button . '<br/>
        </div>
    </div>';
}
