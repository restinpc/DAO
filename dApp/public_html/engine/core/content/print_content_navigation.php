<?php
/**
* Print content navigation menu.
* @path /engine/core/content/print_navigation.php
*
* @name    DAO Mansion    @version 1.0.2
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
* @usage <code> engine::print_content_navigation($site, engine::lang("Content")); </code>
*/

function print_content_navigation($site, $title) {
    $arr = Array();
    $arr[engine::lang("All articles")] = $_SERVER["PUBLIC_URL"].'/content';
    $query = 'SELECT * FROM `nodes_catalog` WHERE `visible` = "1" AND `lang` = "'.$_SESSION["Lang"].'" ORDER BY `order` DESC';
    $res = engine::mysql($query);
    while ($data = mysqli_fetch_array($res)) {
        $arr[$data["caption"]] = $_SERVER["PUBLIC_URL"].'/content/'.$data["url"];
    }
    return engine::print_navigation($title, $arr);
}
