<?php
/**
* Prints free-look application iframe.
* @path /engine/core/webvr/print_free_look.php
*
* @name    DAO Mansion    @version 1.0.3
* @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*/

function print_free_look() {
    return '<iframe id="free-look" src="'.$_SERVER["DIR"].'/apps/free-look/" class="app" width="100%"></iframe>
    <button class="vr icon" id="vr">
        <img id="icon vr_icon" src="'.$_SERVER["DIR"].'/img/vr/vr.png" width="100%" onClick="document.panorama.vrMode();" /> 
    </button>
    <button class="icon" id="fullscreen">
        <img id="fullscreen_icon" src="'.$_SERVER["DIR"].'/img/vr/fullscreen.png" width="100%" onClick="document.panorama.toggleScreen();" /> 
    </button>
    <input id="height" type="range" value="1.5" class="height" min="-10" max="30" step="0.1" onChange="document.framework.changeHeight();" oninput="document.framework.changeHeight();"/>
    ';
}
