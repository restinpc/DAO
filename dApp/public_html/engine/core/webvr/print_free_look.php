<?php

function print_free_look() {
    return '<iframe id="free-look" src="'.$_SERVER["DIR"].'/apps/free-look/" class="app" onLoad="document.framework.loading_site();" width="100%"></iframe>
    <button class="vr icon" id="vr">
        <img id="icon vr_icon" src="'.$_SERVER["DIR"].'/img/vr/vr.png" width="100%" onClick="document.panorama.vrMode();" /> 
    </button>
    <button class="icon" id="fullscreen">
        <img id="fullscreen_icon" src="'.$_SERVER["DIR"].'/img/vr/fullscreen.png" width="100%" onClick="document.panorama.toggleScreen();" /> 
    </button>
    <input id="height" type="range" value="1.5" class="height" min="-10" max="30" step="0.1" onChange="chane_height()" oninput="document.panorama.chane_height()"/>
    ';
}
