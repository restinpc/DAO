<?php
/**
* Prints webvr navigaiton block.
* @path /engine/core/function/print_webvr_navigation.php
*
* @name    DAO Mansion    @version 1.0.3
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
* @usage <code> engine::print_webvr_navigation("Panorama"); </code>
*/

function print_webvr_navigation($current){
    $arr = Array(
        engine::lang("Free look mode") => $_SERVER["DIR"]."/webvr/free-look",
        engine::lang("Orbital preview") => $_SERVER["DIR"]."/webvr/orbital",
        engine::lang("Panorama viewer") => $_SERVER["DIR"]."/webvr/panorama",
        engine::lang("Metaverse") => $_SERVER["DIR"]."/webvr/metaverse"
    );
    return engine::print_navigation($current, $arr);
}
