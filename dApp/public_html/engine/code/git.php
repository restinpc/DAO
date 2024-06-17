<?php
/**
* Git repository.
* @path /engine/code/git.php
*
* @name    DAO Mansion    @version 1.0.3
* @author  Aleksandr Vorkunov  <developing@nodes-tech.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*/

$content = engine::curl_get_query("http://dao.nodes-tech.ru:3000/restinpc/DAO");
$content = str_replace('<link rel="shortcut icon" href="/img/favicon.png" />', '<link rel="shortcut icon" href="https://nodes-tech.ru/res/files/favicon.png" />', $content);
$content = str_replace('<link rel="stylesheet" href="/css/index.css', '<link rel="stylesheet" href="https://nodes-tech.ru/res/files/index.css', $content);
$content = str_replace('<script src="/vendor/plugins/cssrelpreload/loadCSS.min.js', '<link rel="stylesheet" href="https://nodes-tech.ru/res/files/loadCSS.min.js', $content);
$content = str_replace('<script src="/vendor/plugins/cssrelpreload/cssrelpreload.min.js', '<link rel="stylesheet" href="https://nodes-tech.ru/res/files/cssrelpreload.min.js', $content);
$content = str_replace('<link rel="stylesheet" href="/vendor/plugins/semantic/semantic.min.css', '<link rel="stylesheet" href="https://nodes-tech.ru/res/files/semantic.min.css', $content);
$content = str_replace('<link rel="stylesheet" href="/vendor/assets/octicons/octicons.min.css', '<link rel="stylesheet" href="https://nodes-tech.ru/res/files/octicons.min.css', $content);
$content = str_replace('<link rel="preload" href="/vendor/assets/font-awesome/css/font-awesome.min.css', '<link rel="stylesheet" href="https://nodes-tech.ru/res/files/font-awesome.min.css', $content);
$content = str_replace('<link rel="stylesheet" href="/vendor/plugins/highlight/github.css', '<link rel="stylesheet" href="https://nodes-tech.ru/res/files/github.css', $content);

$content = preg_replace('#href="/#', 'target="_blank" href="http://dao.nodes-tech.ru:3000/', $content);
// $content = preg_replace('#src="/#', ' src="https://nodes-tech.ru/res/files/', $content);
echo $content;
