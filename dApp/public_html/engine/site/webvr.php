<?php
/**
* Backend webvr page file.
* @path /engine/site/webvr.php
*
* @name    DAO Mansion    @version 1.0.5
* @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*
* @var $site->title - Page title.
* @var $site->content - Page HTML data.
* @var $site->keywords - Array meta keywords.
* @var $site->description - Page meta description.
* @var $site->img - Page meta image.
* @var $site->onload - Page executable JavaScript code.
*/

function webvr($site) {
    engine::log('webvr()');
    try {
        if (!empty($_GET[2])) {
            $site->content = engine::error();
            return;
        }
        if (!empty($_GET[1]) && $_GET[1] == "metaverse") {
            $site->title = engine::lang("Metaverse");
            $site->keywords = array("VR", "AI", "WebVR", "3D", engine::lang("Metaverse"), "Web 3.0", "Blockchain", "NFT");
            $site->content .= engine::print_webvr_navigation(engine::lang("Metaverse"));
            $site->content .= '<div class="document980 article">
            <div class="whitepaper text">';
            if ($_SESSION["Lang"] == "en") {
                $site->description = "Multiplayer VR/AI game that will use blockchain tokens as an internal currency (mana) to increase their value";
                $site->content .= engine::print_en_metaverse($site);
            } else if ($_SESSION["Lang"] == "zh") {
                $site->description = "网络VR/AI游戏，区块链代币可以作为内部货币（曼纳）使用。";
                $site->content .= engine::print_zh_metaverse($site);
            } else {
                $site->description = "Сетевая VR/AI игра, в которой блокчейн токены можно будут использоваться в качестве внутренней валюты (маны)";
                $site->content .= engine::print_ru_metaverse($site);
            }
            $site->content .= '</div>
            </div>';
        } else if (!empty($_GET[1]) && $_GET[1] == "orbital") {
            $site->title = engine::lang("Orbital preview");
            $site->keywords = array("3D", engine::lang("Mansion"), "Web 3.0", "Autodesk");
            if ($_SESSION["Lang"] == "en") {
                $site->description = '3D Mansion orbital viewer application inspired by Autodesk Forge Viewer';
            } else if ($_SESSION["Lang"] == "zh") {
                $site->description = '3D Mansion 軌道查看器應用程序的靈感來自 Autodesk Forge Viewer';
            } else {
                $site->description = 'Приложение для орбитального просмотра 3D Mansion, вдохновленное Autodesk Forge Viewer';
            }
            $site->content .= engine::print_webvr_navigation(engine::lang("Orbital preview"));
            $site->content .= '<iframe src="'.$_SERVER["DIR"].'/apps/orbital/" class="app" width="100%"></iframe>';
        } else if (!empty($_GET[1]) && $_GET[1] == "panorama") {
            $site->title = engine::lang("Panorama viewer");
            $site->keywords = array("WebVR", engine::lang("Panorama"), "3D", engine::lang("Mansion"), "Web 3.0", "AFrame", "VR");
            if ($_SESSION["Lang"] == "en") {
                $site->description = '3D Mansion panorama viewer application with VR support inspired by Google Maps';
            } else if ($_SESSION["Lang"] == "zh") {
                $site->description = '受到Google地图启发的具有VR支持的3D豪宅全景查看器应用程序';
            } else {
                $site->description = 'Приложение для панорамного просмотра 3D Mansion с поддержкой VR режима, вдохновленное Google Maps';
            }
            $site->content .= engine::print_webvr_navigation(engine::lang("Panorama viewer"));
            $site->content .= engine::print_panorama($site);
        } else if (!empty($_GET[1]) && $_GET[1] == "free-look") {
            $site->title = engine::lang("Free look mode");
            $site->keywords = array("WebVR", "3D", engine::lang("Mansion"), "Web 3.0", "A-Frame", "VR");
            if ($_SESSION["Lang"] == "en") {
                $site->description = '3D Mansion free-look mode viewer application with VR support powered by A-Frame';
            } else if ($_SESSION["Lang"] == "zh") {
                $site->description = '应用程序基于AFrame，可在自由飞行模式下查看3D Mansion。';
            } else {
                $site->description = 'Приложение для просмотра 3D Mansion в режиме свободного полета на базе A-Frame';
            }
            $site->content .= engine::print_webvr_navigation(engine::lang("Free look mode"));
            $site->content .= engine::print_free_look();
        } else {
            $site->content = engine::error();
            return;
        }
    } catch(Exception $e) {
        engine::throw('webvr()', $e);
    }
}

webvr($this);