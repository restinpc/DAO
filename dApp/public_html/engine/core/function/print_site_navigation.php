<?php
/**
* Prints mansion navigation block.
* @path /engine/core/function/print_site_navigation.php
*
* @name    DAO Mansion    @version 1.0.3
* @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*
* @param string $current Page caption.
* @return string Returns content of block on success, or die with error.
* @usage <code> engine::print_site_navigation("Whitepaper"); </code>
*/

function print_site_navigation($current) {
    $arr = array(
        engine::lang("Booking rooms") => $_SERVER["DIR"]."/booking",
        engine::lang("Developed by") => $_SERVER["DIR"]."/developer",
        engine::lang("Terms & conditions") => $_SERVER["DIR"]."/content/terms_and_conditions",
        engine::lang("Privacy policy") => $_SERVER["DIR"]."/content/privacy_policy",
        engine::lang("Contact us") => $_SERVER["DIR"]."/contacts",
    );
    return engine::print_navigation($current, $arr);
}
