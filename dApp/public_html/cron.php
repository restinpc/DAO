#!/usr/bin/php7.0
<?php
/**
* Executable crontab file.
* Should be configured on autoexec every 1 minute.
*
* @name    DAO Mansion    @version 1.0.2
* @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*/

if(isset($argv[1])) $_SERVER["HTTP_HOST"] = $argv[1];
else $_SERVER["HTTP_HOST"] = "dao-mansion.ru";
$_SERVER["DOCUMENT_ROOT"] = "/home/n/nodestecru/DAO/dApp/public_html";
$_SERVER["REQUEST_URI"] = "/cron.php";
ini_set('include_path', $_SERVER["DOCUMENT_ROOT"]);
require_once("engine/nodes/autoload.php");
