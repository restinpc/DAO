<?php
/**
* Prints webvr navigaiton block.
* @path /engine/core/function/print_webvr_navigation.php
*
* @name    DAO Mansion    @version 1.0.3
* @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*
* @param string $current Page caption.
* @return string Returns content of block on success, or die with error.
* @usage <code> engine::print_webvr_navigation("Panorama"); </code>
*/

function print_webvr_navigation($current) {
    $arr = array(
        engine::lang("Free look mode") => $_SERVER["DIR"]."/webvr/free-look",
        engine::lang("Orbital preview") => $_SERVER["DIR"]."/webvr/orbital",
        engine::lang("Panorama viewer") => $_SERVER["DIR"]."/webvr/panorama",
        engine::lang("Metaverse") => $_SERVER["DIR"]."/webvr/metaverse"
    );
    return engine::print_navigation($current, $arr);
}
