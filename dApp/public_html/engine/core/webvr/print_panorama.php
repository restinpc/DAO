<?php
/**
 * Prints panorama application iframe.
 * @path /engine/core/webvr/print_panorama.php
 *
 * @name    DAO Mansion    @version 1.0.3
 * @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 *
 * @var $site->title - Page title.
 * @var $site->content - Page HTML data.
 * @var $site->keywords - Array meta keywords.
 * @var $site->description - Page meta description.
 * @var $site->img - Page meta image.
 * @var $site->onload - Page executable JavaScript code.
 * 
 * @param object $site Site class object.
 * @return string Returns content of panorama.
 * @usage <code>
 *   engine::print_panorama($site);
 * </code>
 */

function print_panorama($site) {
    $site->onload .= '
        window.addEventListener("resize", document.framework.scaleMap);
        document.framework.scaleMap();
    ';
    $fout = '<iframe id="panorama" src="'.$_SERVER["DIR"].'/panorama.php?id=1#1.7188733853924727;167.87663397333137" class="app"></iframe>
    <div id="map_frame">
        <div class="close_button close_wnd" style="position: fixed; top: 100px; z-index:3;" onclick=\'$id("map_frame").style.display = "none";\'>&nbsp;</div>
        <iframe id="map_iframe" sandbox="allow-same-origin allow-top-navigation allow-forms allow-scripts" src="'.$_SERVER["DIR"].'/level.php?id=1" width=600 height=600></iframe>
    </div>
    <button class="map icon" id="map">
        <img id="map_icon" src="'.$_SERVER["DIR"].'/img/vr/map.png" width="100%" onClick="document.framework.showMap();" /> 
    </button>
    <button class="vr icon" id="vr">
        <img id="icon vr_icon" src="'.$_SERVER["DIR"].'/img/vr/vr.png" width="100%" onClick="document.framework.vrMode();" /> 
    </button>
    <button class="icon" id="fullscreen">
        <img id="fullscreen_icon" src="'.$_SERVER["DIR"].'/img/vr/fullscreen.png" width="100%" onClick="document.framework.toggleScreen();" /> 
    </button>';
    return $fout;
}
