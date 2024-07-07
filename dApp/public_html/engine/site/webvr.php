<?php
/**
* Backend webvr page file.
* @path /engine/site/webvr.php
*
* @name    DAO Mansion    @version 1.0.3
* @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*
* @var $this->title - Page title.
* @var $this->content - Page HTML data.
* @var $this->keywords - Array meta keywords.
* @var $this->description - Page meta description.
* @var $this->img - Page meta image.
* @var $this->onload - Page executable JavaScript code.
*/

if (!empty($_GET[2])) {
    $this->content = engine::error();
    return;
}
if (!empty($_GET[1]) && $_GET[1] == "metaverse") {
    $this->title = engine::lang("Metaverse");
    $this->keywords = array("VR", "AI", "WebVR", "3D", engine::lang("Metaverse"), "Web 3.0", "Blockchain", "NFT");
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
    $this->keywords = array("3D", engine::lang("Mansion"), "Web 3.0", "Autodesk");
    if ($_SESSION["Lang"] == "en") {
        $this->description = '3D Mansion orbital viewer application inspired by Autodesk Forge Viewer';
    } else if ($_SESSION["Lang"] == "zh") {
        $this->description = '3D Mansion 軌道查看器應用程序的靈感來自 Autodesk Forge Viewer';
    } else {
        $this->description = 'Приложение для орбитального просмотра 3D Mansion, вдохновленное Autodesk Forge Viewer';
    }
    $this->content .= engine::print_webvr_navigation(engine::lang("Orbital preview"));
    $this->content .= '<iframe src="'.$_SERVER["DIR"].'/apps/orbital/" class="app" width="100%"></iframe>';
} else if (!empty($_GET[1]) && $_GET[1] == "panorama") {
    $this->title = engine::lang("Panorama viewer");
    $this->keywords = array("WebVR", engine::lang("Panorama"), "3D", engine::lang("Mansion"), "Web 3.0", "AFrame", "VR");
    if ($_SESSION["Lang"] == "en") {
        $this->description = '3D Mansion panorama viewer application with VR support inspired by Google Maps';
    } else if ($_SESSION["Lang"] == "zh") {
        $this->description = '受到Google地图启发的具有VR支持的3D豪宅全景查看器应用程序';
    } else {
        $this->description = 'Приложение для панорамного просмотра 3D Mansion с поддержкой VR режима, вдохновленное Google Maps';
    }
    $this->content .= engine::print_webvr_navigation(engine::lang("Panorama viewer"));
    $this->content .= engine::print_panorama($this);
} else if (!empty($_GET[1]) && $_GET[1] == "free-look") {
    $this->title = engine::lang("Free look mode");
    $this->keywords = array("WebVR", "3D", engine::lang("Mansion"), "Web 3.0", "A-Frame", "VR");
    if ($_SESSION["Lang"] == "en") {
        $this->description = '3D Mansion free-look mode viewer application with VR support powered by A-Frame';
    } else if ($_SESSION["Lang"] == "zh") {
        $this->description = '应用程序基于AFrame，可在自由飞行模式下查看3D Mansion。';
    } else {
        $this->description = 'Приложение для просмотра 3D Mansion в режиме свободного полета на базе A-Frame';
    }
    $this->content .= engine::print_webvr_navigation(engine::lang("Free look mode"));
    $this->content .= engine::print_free_look();
} else {
    $this->content = engine::error();
    return;
}
