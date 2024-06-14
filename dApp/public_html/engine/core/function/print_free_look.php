<?php

function print_free_look() {
    return '<iframe id="free-look" src="'.$_SERVER["DIR"].'/apps/free-look/" class="frame" onLoad="loading_site();" width="100%"></iframe>
    <button class="vr icon" id="vr">
        <img id="icon vr_icon" src="/img/vr/vr.png" width="100%" onClick="document.panorama.vrMode();" /> 
    </button>
    <button class="icon" id="fullscreen">
        <img id="fullscreen_icon" src="/img/vr/fullscreen.png" width="100%" onClick="document.panorama.toggleScreen();" /> 
    </button>
    ';
}