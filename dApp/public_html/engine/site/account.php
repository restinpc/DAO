<?php
/**
* Backend account pages file.
* @path /engine/site/account.php
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

function account($site) {
    engine::log('account()');
    try {
        if (!empty($_GET[3])) {
            $site->content = engine::error();
            return;
        }
        if (!empty($_SESSION["user"]["id"])) {
            $query = 'SELECT * FROM `nodes_user` WHERE `id` = "'.$_SESSION["user"]["id"].'"';
            $res = engine::mysql($query);
            $user = mysqli_fetch_array($res);
            if (!$user["confirm"]) {
                $site->title = engine::lang("Email confirmation");
                $site->content .= engine::print_email_confirm($site);
                return;
            } else if (!empty($_GET[1])) {
                if ($_GET[1] == "settings") {
                    if (!empty($_GET[3])) {
                        $site->content = engine::error();
                        return;
                    }
                    $title = engine::lang("Settings");
                    $site->title = $title;
                    $site->content .= engine::print_navigation($title);
                    $site->content .= engine::print_settings($site);
                } else if ($_GET[1] == "confirm") {
                    if (!empty($_GET[3]) || empty($_GET[2])) {
                        $site->content = engine::error();
                        return;
                    }
                    $title = engine::lang("Delivery confirmation");
                    $site->title = $title;
                    $site->content .= engine::print_navigation($title);
                    $site->content .= engine::print_order_confirm($site);
                } else if ($_GET[1] == "purchases") {
                    if (!empty($_GET[2])) {
                        $site->content = engine::error();
                        return;
                    }
                    $title = engine::lang("Purchases");
                    $site->title = $title;
                    $site->content .= engine::print_navigation($title);
                    $site->content .= engine::print_purchases($site);
                } else if ($_GET[1] == "inbox") {
                    if (!empty($_GET[3])) {
                        $site->content = engine::error();
                        return;
                    }
                    $title = engine::lang("Messages");
                    $site->title = $title;
                    $site->content .= engine::print_navigation($title);
                    $site->content .= engine::print_inbox($site);
                } else if ($_GET[1] == "finances") {
                    if (!empty($_GET[3])) {
                        $site->content = engine::error();
                        return;
                    }
                    $title = engine::lang("Finances");
                    $site->title = $title;
                    $site->content .= engine::print_navigation($title);
                    $site->content .= engine::print_finances($site);
                } else {
                    $site->content = engine::error();
                    return;
                }
            } else {
                $title = engine::lang("Profile");
                $site->title = $user["name"];
                $site->content = engine::print_header($_SESSION["user"]["id"]);
                $site->content .= engine::print_navigation($title);
                $site->content .= '<div class="document">'
                . '<div class="clear_block">'
                . '<p>'.engine::lang("Member of").' <b>Web 3.0 </b> '.engine::lang("community").'</p>'
                . '</div>'
                . '</div>';
            }
        } else {
            $site->content = engine::error(401);
        }
    } catch(Exception $e) {
        engine::throw('account()', $e);
    }
}

account($this);