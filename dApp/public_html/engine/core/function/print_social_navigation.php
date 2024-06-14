<?php
/**
* Prints social navigation block.
* @path /engine/core/function/print_social_navigation.php
*
* @name    DAO Mansion    @version 1.0.2
* @author  Aleksandr Vorkunov  <developing@nodes-tech.ru>
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
* @param string $url Page URL.
* @param string $caption Page caption.
* @return string Returns content of block on success, or die with error.
* @usage <code> engine::print_social_navigation("Social graph"); </code>
*/

function print_social_navigation($current){
    $arr = Array(
        engine::lang("Social graph") => $_SERVER["DIR"]."/social/graph",
        engine::lang("Telegram group") => $_SERVER["DIR"]."/social/telegram",
        engine::lang("Digital constitution") => $_SERVER["DIR"]."/social/constitution",
        engine::lang("Crypto democracy") => $_SERVER["DIR"]."/social/democracy",
        engine::lang("Crowdfunding") => $_SERVER["DIR"]."/social/crowdfunding"
    );
    return engine::print_navigation($current, $arr);
}
