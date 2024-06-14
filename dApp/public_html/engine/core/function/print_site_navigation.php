<?php
/**
* Prints mansion navigation block.
* @path /engine/core/function/print_site_navigation.php
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
* @usage <code> engine::print_site_navigation("Whitepaper"); </code>
*/

function print_site_navigation($current){
    $arr = Array(
        engine::lang("Developed by") => $_SERVER["DIR"]."/developer",
        engine::lang("Terms & conditions") => $_SERVER["DIR"]."/content/terms_and_conditions",
        engine::lang("Privacy policy") => $_SERVER["DIR"]."/content/privacy_policy",
        engine::lang("Contact us") => $_SERVER["DIR"]."/contacts",
        engine::lang("Booking rooms") => $_SERVER["DIR"]."/booking",
    );
    return engine::print_navigation($current, $arr);
}
