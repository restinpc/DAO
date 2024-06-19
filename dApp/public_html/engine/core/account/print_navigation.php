<?php
/**
* Print account navigation menu.
* @path /engine/core/account/print_navigation.php
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
* @param string $title Page title.
* @return string Returns content of page on success, or die with error.
* @usage <code> engine::print_navigation($site, engine::lang("Profile")); </code>
*/

function print_navigation($site, $title){
    $fout = '<div class="profile_menu">
        <div class="container">
            <span class="profile_menu_item show_all selected" ><a>'.$title.'</a>
                <div class="fr nav_button" alt="'.engine::lang("Show navigation").'">&nbsp;</div>    
            </span>';
    $query = 'SELECT COUNT(*) FROM `nodes_inbox` WHERE `to` = "'.$_SESSION["user"]["id"].'" AND `readed` = 0';
    $res = engine::mysql($query);
    $data = mysqli_fetch_array($res);
    $count = '';
    if ($data[0]>0) {
        $count = ' ('.$data[0].')';
    }
    if ($_SESSION["user"]["admin"]=="1") {
        $fout .= '<span  id="profile_menu_span_3" class="profile_menu_item" onClick=\'document.getElementById("profile_menu_link_3").click();\'>'
            . '<a id="profile_menu_link_3" hreflang="'.$_SESSION["Lang"].'" href="'.engine::href($_SERVER["DIR"].'/admin').'">'.engine::lang("Admin").'</a></span>';
    }
    $fout .= '<span  id="profile_menu_span_1" class="profile_menu_item '.($title == engine::lang("Profile")?'selected':'').'" onClick=\'document.getElementById("profile_menu_link_1").click();\'>'
        . '<a id="profile_menu_link_1" hreflang="'.$_SESSION["Lang"].'" href="'.engine::href($_SERVER["DIR"].'/account').'">'.engine::lang("Profile").'</a></span>';

    $fout .= '
        <span id="profile_menu_span_2" class="profile_menu_item '.($title == engine::lang("Finances")?'selected':'').'" onClick=\'document.getElementById("profile_menu_link_2").click();\'>'
        . '<a id="profile_menu_link_2" hreflang="'.$_SESSION["Lang"].'" href="'.engine::href($_SERVER["DIR"].'/account/finances').'">'.engine::lang("Finances").'</a></span>';


    $fout .= '
        <span id="profile_menu_span_5" class="profile_menu_item '.($title == engine::lang("Messages")?'selected':'').'" onClick=\'document.getElementById("profile_menu_link_5").click();\'>'
        . '<a id="profile_menu_link_5" hreflang="'.$_SESSION["Lang"].'" href="'.engine::href($_SERVER["DIR"].'/account/inbox').'">'.engine::lang("Messages").$count.'</a></span>';

    $fout .= '
        <span id="profile_menu_span_6" class="profile_menu_item '.($title == engine::lang("Settings")?'selected':'').'" onClick=\'document.getElementById("profile_menu_link_6").click();\'>'
        . '<a id="profile_menu_link_6" hreflang="'.$_SESSION["Lang"].'" href="'.engine::href($_SERVER["DIR"].'/account/settings').'">'.engine::lang("Settings").'</a></span>'
        . '</div>'
    . '</div>';
    return $fout;
}
