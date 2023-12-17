<?php
/**
* Prints navigation block.
* @path /engine/core/function/print_navigation.php
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
* @usage <code> engine::print_navigation("Whitepaper"); </code>
*/

function print_navigation($current, $arr){
    $fout = '<div class="profile_menu" onMouseOver="document.nodes_menu_hovered = true;" onmouseout="document.nodes_menu_hovered = false;">
        <div class="container">
            <span id="profile_menu_span_nav" class="profile_menu_item show_all selected"><a>'.$current.'</a>
            <button type="button" class="navbar-toggle toggle-button nav_button">
                <span class="sr-only">切換導航</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button> 
            <!--<div class="fr nav_button" alt="Show navigation">&nbsp;</div>-->
            </span>';
    $i = 0;
    foreach($arr as $key => $value) {
        $i++;
        $fout .= '<span id="profile_menu_span_'.$i.'" class="profile_menu_item '.($current === $key ? "selected" : "").'" onclick=\'document.getElementById("profile_menu_link_'.$i.'").click();\'>
            <a id="profile_menu_link_'.$i.'" hreflang="'.$_SESSION["Lang"].'" href="'.engine::href($value).'">'.$key.'</a>
        </span>';
    }
    $fout .= '
        </div>
    </div>
    <div style="height: 39px;"></div>';
    return $fout;
}
