<?php
/**
* Git repository proxy page.
* @path /engine/code/git.php
*
* @name    DAO Mansion    @version 1.0.3
* @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*/

function git() {
    engine::log('git('.json_encode($_GET).')');
    try {
        $git = $_SERVER["configs"]["git"];
        $url = parse_url($git);
        if ($_SESSION["Lang"] == "en") {
            $git .= "?lang=en-US";
        } else if ($_SESSION["Lang"] == "zh") {
            $git .= "?lang=zh-CN";
        }
        $content = engine::curl_get_query($git);
        $content = str_replace('<link rel="shortcut icon" href="/img/favicon.png" />', '<link rel="shortcut icon" href="'.$_SERVER["PUBLIC_URL"].'/res/files/favicon.png" />', $content);
        $content = str_replace('<link rel="stylesheet" href="/css/index.css', '<link rel="stylesheet" href="'.$_SERVER["PUBLIC_URL"].'/res/files/index.css', $content);
        $content = str_replace('<script src="/vendor/plugins/cssrelpreload/loadCSS.min.js', '<link rel="stylesheet" href="'.$_SERVER["PUBLIC_URL"].'/res/files/loadCSS.min.js', $content);
        $content = str_replace('<script src="/vendor/plugins/cssrelpreload/cssrelpreload.min.js', '<link rel="stylesheet" href="'.$_SERVER["PUBLIC_URL"].'/res/files/cssrelpreload.min.js', $content);
        $content = str_replace('<link rel="stylesheet" href="/vendor/plugins/semantic/semantic.min.css', '<link rel="stylesheet" href="'.$_SERVER["PUBLIC_URL"].'/res/files/semantic.min.css', $content);
        $content = str_replace('<link rel="stylesheet" href="/vendor/assets/octicons/octicons.min.css', '<link rel="stylesheet" href="'.$_SERVER["PUBLIC_URL"].'/res/files/octicons.min.css', $content);
        $content = str_replace('<link rel="preload" href="/vendor/assets/font-awesome/css/font-awesome.min.css', '<link rel="stylesheet" href="'.$_SERVER["PUBLIC_URL"].'/res/files/font-awesome.min.css', $content);
        $content = str_replace('<link rel="stylesheet" href="/vendor/plugins/highlight/github.css', '<link rel="stylesheet" href="'.$_SERVER["PUBLIC_URL"].'/res/files/github.css', $content);
        $content = str_replace('src="/avatars/49a23b50620e6a1a28373d7e5a6f8770"', 'src="'.$_SERVER["PUBLIC_URL"].'/res/files/49a23b50620e6a1a28373d7e5a6f8770.png"', $content);
        $content = preg_replace('#<div class="ui top secondary stackable main menu following bar light">.*?<div class="repository file list">#su', '<div class="repository file list">', $content);
        $content = preg_replace('#href="/#', 'target="_blank" href="'.$url["scheme"].'://'.$url["host"].':'.$url["port"].'/', $content);
        echo $content;
    } catch(Exception $e) {
        engine::throw('git()', $e);
    }
}

git();