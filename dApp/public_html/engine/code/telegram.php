<?php
/**
* Telegram frame.
* @path /engine/code/telegram.php
*
* @name    DAO Mansion    @version 1.0.3
* @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*/

function telegram() {
    engine::log('telegram()');
    try {
        require_once("engine/nodes/headers.php");
        echo '<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Telegram: Contact @'.$_SERVER["configs"]["telegram_url"].'</title>
    <script>window.matchMedia&&window.matchMedia("(prefers-color-scheme: dark)").matches&&document.documentElement&&document.documentElement.classList&&document.documentElement.classList.add("theme_dark");</script>
    <link href="'.$_SERVER["PUBLIC_URL"].'/res/files/bootstrap.min.css?3" rel="stylesheet">
    <link href="'.$_SERVER["PUBLIC_URL"].'/res/files/telegram.css?236" rel="stylesheet" media="screen">
</head>
<body class="no_transition">
<div class="tgme_background_wrap">
    <canvas id="tgme_background" class="tgme_background default" width="50" height="50" data-colors="dbddbb,6ba587,d5d88d,88b884"></canvas>
    <div class="tgme_background_pattern default"></div>
</div>
<div class="tgme_page_wrap">
    <div class="tgme_body_wrap">
        <div class="tgme_page">
            <div class="tgme_page_photo">
                <a href="tg://resolve?domain='.$_SERVER["configs"]["telegram_url"].'"><img class="tgme_page_photo_image" src="'.$_SERVER["DIR"].'/img/logo.png"></a>
            </div>
            <div class="tgme_page_title" dir="auto">
                <span dir="auto">'.$_SERVER["configs"]["telegram_name"].'</span>
            </div>
            <div class="tgme_page_extra"></div>
            <div class="tgme_page_action">
                <a class="tgme_action_button_new shine" target="_blank" href="https://t.me/'.$_SERVER["configs"]["telegram_url"].'">View in Telegram</a>
            </div>
            <div class="tgme_page_action tgme_page_web_action">
                <a class="tgme_action_button_new tgme_action_web_button" href="https://web.telegram.org/z/#?tgaddr=tg%3A%2F%2Fresolve%3Fdomain%3D'.$_SERVER["configs"]["telegram_url"].'" target="_blank"><span class="tgme_action_button_label">Open in Web</span></a>
            </div>
            <div class="tgme_page_additional">
                If you have <strong>Telegram</strong>, you can view and join <br><strong>'.$_SERVER["configs"]["telegram_name"].'</strong> right away.
            </div>
        </div>
    </div>
</div>
<div id="tgme_frame_cont"></div>
<script src="'.$_SERVER["PUBLIC_URL"].'/res/files/tgwallpaper.min.js?3"></script>
<script type="text/javascript">
    var tme_bg = document.getElementById("tgme_background");
    if (tme_bg) {
        TWallpaper.init(tme_bg);
        TWallpaper.animate(true);
        window.onfocus = () => { TWallpaper.update(); };
    }
    document.body.classList.remove("no_transition");
    const toggleTheme = (dark) => {
        document.documentElement.classList.toggle("theme_dark", dark);
        window.Telegram && Telegram.setWidgetOptions({dark: dark});
    }
    if (window.matchMedia) {
        var darkMedia = window.matchMedia("(prefers-color-scheme: dark)");
        toggleTheme(darkMedia.matches);
        darkMedia.addListener((e) => {
            toggleTheme(e.matches);
        });
    }
</script>
</body>
</html>';
    } catch(Exception $e) {
        engine::throw('telegram()', $e);
    }
}

telegram();