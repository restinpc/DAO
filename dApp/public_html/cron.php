#!/usr/bin/php7.0
<?php
/**
* Executable crontab file.
* Should be configured on autoexec every 1 minute.
*
* @name    DAO Mansion    @version 1.0.3
* @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*/

if(!isset($argv[1])) {
    die("DOCUMENT_ROOT is not defined (should be 1st argument)");
}
if(!isset($argv[2])) {
    die("HTTP_HOST is not defined (should be 2nd argument)");
}
$_SERVER["DOCUMENT_ROOT"] = $argv[1];
$_SERVER["HTTP_HOST"] = $argv[2];
$_SERVER["REQUEST_URI"] = "/cron.php";
ini_set('include_path', $_SERVER["DOCUMENT_ROOT"]);
require_once("engine/nodes/autoload.php");
