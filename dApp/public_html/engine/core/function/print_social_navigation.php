<?php
/**
* Prints social navigation block.
* @path /engine/core/function/print_social_navigation.php
*
* @name    DAO Mansion    @version 1.0.3
* @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*
* @param string $current Page caption.
* @return string Returns content of block.
* @usage <code> engine::print_social_navigation("Social graph"); </code>
*/

function print_social_navigation($current) {
    $arr = array(
        engine::lang("Social graph") => $_SERVER["DIR"]."/social/graph",
        engine::lang("Telegram group") => $_SERVER["DIR"]."/social/telegram",
        engine::lang("Digital constitution") => $_SERVER["DIR"]."/social/constitution",
        engine::lang("Crypto democracy") => $_SERVER["DIR"]."/social/democracy",
        engine::lang("Crowdfunding") => $_SERVER["DIR"]."/social/crowdfunding"
    );
    return engine::print_navigation($current, $arr);
}
