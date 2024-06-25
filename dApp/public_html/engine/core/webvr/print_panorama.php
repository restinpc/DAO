<?php

function print_panorama() {
    return '<iframe id="panorama" src="'.$_SERVER["DIR"].'/panorama.php?id=1#1.7188733853924727;167.87663397333137" class="app" onLoad="loading_site();"></iframe>
    <div id="map_frame">
        <div class="close_button close_wnd" style="position: fixed; top: 100px; z-index:3;" onclick=\'document.getElementById("map_frame").style.display = "none";\'>&nbsp;</div>
        <iframe sandbox="allow-same-origin allow-top-navigation allow-forms allow-scripts" src="'.$_SERVER["DIR"].'/level.php?id=1" width=500 height=500></iframe>
    </div>
    <button class="map icon" id="map">
        <img id="map_icon" src="'.$_SERVER["DIR"].'/img/vr/map.png" width="100%" onClick="document.panorama.showMap();" /> 
    </button>
    <button class="vr icon" id="vr">
        <img id="icon vr_icon" src="'.$_SERVER["DIR"].'/img/vr/vr.png" width="100%" onClick="document.panorama.vrMode();" /> 
    </button>
    <button class="icon" id="fullscreen">
        <img id="fullscreen_icon" src="'.$_SERVER["DIR"].'/img/vr/fullscreen.png" width="100%" onClick="document.panorama.toggleScreen();" /> 
    </button>';
}
