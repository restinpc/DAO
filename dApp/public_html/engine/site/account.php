<?php
/**
* Backend account pages file.
* @path /engine/site/account.php
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
* @var $this->configs - Array MySQL configs.
*/

if (!empty($_GET[3])) {
    $this->content = engine::error();
    return;
}
if (!empty($_SESSION["user"]["id"])) {
    $query = 'SELECT * FROM `nodes_user` WHERE `id` = "'.$_SESSION["user"]["id"].'"';
    $res = engine::mysql($query);
    $user = mysqli_fetch_array($res);
    if (!$user["confirm"]) {
        $this->title = engine::lang("Email confirmation");
        $this->content .= engine::print_email_confirm($this);
        return;
    } else if (!empty($_GET[1])) {
        if ($_GET[1] == "settings") {
            if (!empty($_GET[3])) {
                $this->content = engine::error();
                return;
            }
            $title = engine::lang("Settings");
            $this->title = $title;
            $this->content .= engine::print_navigation($this, $title);
            $this->content .= engine::print_settings($this);
        } else if ($_GET[1] == "confirm") {
            if (!empty($_GET[3]) || empty($_GET[2])) {
                $this->content = engine::error();
                return;
            }
            $title = engine::lang("Delivery confirmation");
            $this->title = $title;
            $this->content .= engine::print_navigation($this, $title);
            $this->content .= engine::print_order_confirm($this);
        } else if ($_GET[1] == "purchases") {
            if (!empty($_GET[2])) {
                $this->content = engine::error();
                return;
            }
            $title = engine::lang("Purchases");
            $this->title = $title;
            $this->content .= engine::print_navigation($this, $title);
            $this->content .= engine::print_purchases($this);
        } else if ($_GET[1] == "inbox") {
            if (!empty($_GET[3])) {
                $this->content = engine::error();
                return;
            }
            $title = engine::lang("Messages");
            $this->title = $title;
            $this->content .= engine::print_navigation($this, $title);
            $this->content .= engine::print_inbox($this);
        } else if ($_GET[1] == "finances") {
            if (!empty($_GET[3])) {
                $this->content = engine::error();
                return;
            }
            $title = engine::lang("Finances");
            $this->title = $title;
            $this->content .= engine::print_navigation($this, $title);
            $this->content .= engine::print_finances($this);
        } else {
            $this->content = engine::error();
            return;
        }
    } else {
        $title = engine::lang("Profile");
        $this->title = $user["name"];
        $this->content = engine::print_header($this, intval($_SESSION["user"]["id"]));
        $this->content .= engine::print_navigation($this, $title);
        $this->content .= '<div class="document">'
        . '<div class="clear_block">'
        . '<p>'.engine::lang("Member of").' <b>Web 3.0 </b> '.engine::lang("community").'</p>'
        . '</div>'
        . '</div>';
    }
} else {
    $this->content = engine::error(401);
}
