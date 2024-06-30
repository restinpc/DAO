<?php
/**
* Prints navigation block.
* @path /engine/core/function/print_navigation.php
*
* @name    DAO Mansion    @version 1.0.3
* @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*
* @param string $current Page caption.
* @param string $caption Assoc array with a pages data.
* @return string Returns content of block on success, or die with error.
* @usage <code> engine::print_navigation("Whitepaper"); </code>
*/

function print_navigation($current, $arr) {
    $fout = '<div class="profile_menu" onMouseOver="document.nodes_menu_hovered = true;" onmouseout="document.nodes_menu_hovered = false;">
        <div class="container">
            <span id="profile_menu_span_nav" class="profile_menu_item show_all selected"><a>'.$current.'</a>
            <button type="button" class="navbar-toggle toggle-button nav_button">
                <span class="sr-only">'.engine::lang("Toggle navigation").'</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            </span>';
    $i = 0;
    foreach ($arr as $key => $value) {
        $i++;
        $fout .= '<span id="profile_menu_span_'.$i.'" class="profile_menu_item '.($current === $key ? "selected" : "").'" onclick=\'$id("profile_menu_link_'.$i.'").click();\'>
                <a id="profile_menu_link_'.$i.'" hreflang="'.$_SESSION["Lang"].'" href="'.engine::href($value).'">'.$key.'</a>
            </span>';
    }
    $fout .= '
        </div>
    </div>
    <div style="height: 39px;"></div>';
    return $fout;
}
