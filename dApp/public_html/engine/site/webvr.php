<?php
/**
* Backend webvr page file.
* @path /engine/site/webvr.php
*
* @name    DAO Mansion    @version 1.0.3
* @author  Aleksandr Vorkunov  <developing@nodes-tech.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*
* @var $this->title - Page title.
* @var $this->content - Page HTML data.
* @var $this->keywords - Array meta keywords.
* @var $this->description - Page meta description.
* @var $this->img - Page meta image.
* @var $this->onload - Page executable JavaScript code.
* @var $this->configs - Array MySQL configs.
*/

if(!empty($_GET[2])){
    $this->content = engine::error();
    return;
}
$this->content = '<style>
    .icon {
        position: fixed;
        bottom: 15px;
        left: 10px;
        width: 50px;
        height: 50px;
        z-index:2;
        cursor: pointer;
        background: none;
        border: none;
    }
    .vr {
        position: fixed;
        bottom: 10px;
        left: auto !important;;
        right: 15px !important;
        width: 60px;
        height: 60px;
        z-index:2;
        cursor: pointer;
        background: none;
        border: none;
    }
    .map {
        position: fixed;
        bottom: 65px !important;
        left: 7px;
        width: 60px;
        height: 60px;
        z-index:2;
        cursor: pointer;
        background: none;
        border: none;
    }
    #map_frame {
        position: fixed;
        text-align: center;
        margin: 0px auto;
        width: 100%;
        top: calc(10% + 40px);
        display: none;
    }
    #map_frame iframe {
        display: block;
        margin: 0px auto;
    }
    @media (max-width: 600px) {
        #map_frame iframe {
            width: 300px;
            position: fixed;
            left: calc(50% - 150px);
        }
    }
</style>
<script>
    document.panorama = {};
    let screen_state = 0;
    document.panorama.requestFullScreen = (element) => {
        // Supports most browsers and their versions.
        var requestMethod = element.requestFullScreen || element.webkitRequestFullScreen || element.mozRequestFullScreen || element.msRequestFullScreen;
        if (requestMethod) { // Native full screen.
            requestMethod.call(element);
        } else if (typeof window.ActiveXObject !== "undefined") { // Older IE.
            var wscript = new ActiveXObject("WScript.Shell");
            if (wscript !== null) {
                wscript.SendKeys("{F11}");
            }
        }
    }
    document.panorama.fullScreen = () => {
        document.panorama.permission();
        const iframe = document.getElementsByTagName("iframe")[0];
        if (iframe) {
            iframe.style.top = "0px";
            iframe.style.height = "100%";
            iframe.style.position = "fixed";
            iframe.style.zIndex = 2;
            screen_state = 1;
            document.getElementById("fullscreen_icon").src = "/img/vr/normalscreen.png";
        }
    }
    document.panorama.hideFullScreen = () => {
        const iframe = document.getElementsByTagName("iframe")[0];
        if (iframe) {
            iframe.style.top = "40px";
            iframe.style.height = "calc(100% - 40px)";
            iframe.style.position = "fixed";
            iframe.style.zIndex = 0;
            screen_state = 0;
            document.getElementById("fullscreen_icon").src = "/img/vr/fullscreen.png";
        }
        try {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            } else if (document.webkitExitFullscreen) {
                document.webkitExitFullscreen();
            } else if (document.mozCancelFullScreen) {
                document.mozCancelFullScreen();
            } else if (document.msExitFullscreen) {
                document.msExitFullscreen();
            }
        } catch (e) {}
    }
    document.panorama.toggleScreen = () => {
        if (screen_state) {
            document.panorama.hideFullScreen();
        } else {
            document.panorama.fullScreen();
        }
    }
    document.panorama.permission = () => {
        if ( typeof( DeviceMotionEvent ) !== "undefined" && typeof( DeviceMotionEvent.requestPermission ) === "function" ) {
            // (optional) Do something before API request prompt.
            DeviceMotionEvent.requestPermission()
                .then( response => {
                // (optional) Do something after API prompt dismissed.
                if ( response == "granted" ) {
                    window.addEventListener( "devicemotion", (e) => {
                        // do something for \'e\' here.
                    })
                }
            })
                .catch( console.error )
        } else {
            console.error( "DeviceMotionEvent is not defined" );
        }
    }
    document.panorama.vrMode = () => {
        document.panorama.permission();
        document.panorama.fullScreen();
        const iframe = document.getElementsByTagName("iframe")[0];
        const innerDoc = (iframe.contentDocument) ? iframe.contentDocument : iframe.contentWindow.document;
        innerDoc.getElementsByTagName("a-scene")[0].enterVR();
        jQuery(".icon").css("display", "none");
        try {
            innerDoc.getElementById("np").style.display = "none";
        } catch(e) {}
        innerDoc.getElementsByTagName("a-scene")[0].addEventListener("exit-vr", () => {
            try {
                innerDoc.getElementById("np").style.display = "block";
            } catch(e) {}
            document.panorama.hideFullScreen();
            jQuery(".icon").css("display", "block");
        })
    }
    document.panorama.showMap = () => {
        const frame = document.getElementById("map_frame");
        frame.style.display = "block";
    }
    document.panorama.hideMap = () => {
        const frame = document.getElementById("map_frame");
        frame.style.display = "none";
    }
</script>';

if (!empty($_GET[1]) && $_GET[1] == "metaverse") {
    $this->title = engine::lang("Metaverse");
    $this->keywords = Array("VR", "AI", "WebVR", "3D", engine::lang("Metaverse"), "Web 3.0", "Blockchain", "NFT");
    $this->content .= engine::print_webvr_navigation(engine::lang("Metaverse"));
    $this->content .= '<div class="document980 article">
    <div class="whitepaper text">';
    if ($_SESSION["Lang"] == "en") {
        $this->description = "Multiplayer VR/AI game that will use blockchain tokens as an internal currency (mana) to increase their value";
        $this->content .= engine::print_en_metaverse($this);
    } else if ($_SESSION["Lang"] == "zh") {
        $this->description = "网络VR/AI游戏，区块链代币可以作为内部货币（曼纳）使用。";
        $this->content .= engine::print_zh_metaverse($this);
    } else {
        $this->description = "Сетевая VR/AI игра, в которой блокчейн токены можно будут использоваться в качестве внутренней валюты (маны)";
        $this->content .= engine::print_ru_metaverse($this);
    }
    $this->content .= '</div>
    </div>';
} else if (!empty($_GET[1]) && $_GET[1] == "orbital") {
    $this->title = engine::lang("Orbital preview");
    $this->keywords = Array("3D", engine::lang("Mansion"), "Web 3.0", "Autodesk");
    if ($_SESSION["Lang"] == "en") {
        $this->description = '3D Mansion orbital viewer application inspired by Autodesk Forge Viewer';
    } else if ($_SESSION["Lang"] == "zh") {
        $this->description = '3D Mansion 軌道查看器應用程序的靈感來自 Autodesk Forge Viewer';
    } else {
        $this->description = 'Приложение для орбитального просмотра 3D Mansion, вдохновленное Autodesk Forge Viewer';
    }
    $this->content .= engine::print_webvr_navigation(engine::lang("Orbital preview"));
    $this->content .= '<iframe src="'.$_SERVER["DIR"].'/apps/orbital/" onLoad="loading_site();" class="app" width="100%"></iframe>';
} else if (!empty($_GET[1]) && $_GET[1] == "panorama") {
    $this->title = engine::lang("Panorama viewer");
    $this->keywords = Array("WebVR", engine::lang("Panorama"), "3D", engine::lang("Mansion"), "Web 3.0", "AFrame", "VR");
    if ($_SESSION["Lang"] == "en") {
        $this->description = '3D Mansion panorama viewer application with VR support inspired by Google Maps';
    } else if ($_SESSION["Lang"] == "zh") {
        $this->description = '受到Google地图启发的具有VR支持的3D豪宅全景查看器应用程序';
    } else {
        $this->description = 'Приложение для панорамного просмотра 3D Mansion с поддержкой VR режима, вдохновленное Google Maps';
    }
    $this->content .= engine::print_webvr_navigation(engine::lang("Panorama viewer")).
    $this->content .= engine::print_panorama();
} else if (!empty($_GET[1]) && $_GET[1] == "free-look") {
    $this->title = engine::lang("Free look mode");
    $this->keywords = Array("WebVR", "3D", engine::lang("Mansion"), "Web 3.0", "AFrame", "VR");
    if ($_SESSION["Lang"] == "en") {
        $this->description = '3D Mansion free-look mode viewer application with VR support powered by AFrame';
    } else if ($_SESSION["Lang"] == "zh") {
        $this->description = '应用程序基于AFrame，可在自由飞行模式下查看3D Mansion。';
    } else {
        $this->description = 'Приложение для просмотра 3D Mansion в режиме свободного полета на базе AFrame';
    }
    $this->content .= engine::print_webvr_navigation(engine::lang("Free look mode"));
    $this->content .= engine::print_free_look();
} else {
    $this->content = engine::error();
    return;
}
