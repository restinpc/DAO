<?php
/**
* Prints DAO navigation block.
* @path /engine/core/function/print_dao_navigation.php
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
* @param string $url Page URL.
* @param string $caption Page caption.
* @return string Returns content of block on success, or die with error.
* @usage <code> engine::print_dao_navigation("DAO Dashboard"); </code>
*/

function print_dao_navigation($current) {
    $arr = Array(
        engine::lang("Git repository") => $_SERVER["DIR"]."/dao/git",
        engine::lang("Capitalization") => $_SERVER["DIR"]."/dao/capitalization",
        engine::lang("Blockchain monitor") => $_SERVER["DIR"]."/dao/monitor",
        engine::lang("Decentralized management") => $_SERVER["DIR"]."/dao/management",
        engine::lang("P2P marketplace") => $_SERVER["DIR"]."/dao/market"
    );
    return engine::print_navigation($current, $arr);
}
