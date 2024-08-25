<?php
/**
* phpMyAdmin configuration script.
* @path /apps/pma/config.php
*
* @name    DAO Mansion    @version 1.0.5
* @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*/

require_once("../../engine/nodes/config.php");
require_once("../../engine/core/engine.php");
require_once("../../engine/nodes/mysql.php");

$query = 'SELECT * FROM nodes_session WHERE `token` LIKE "'.$_COOKIE["token"].'" AND expire_at > NOW()';
$res = engine::mysql($query);
$data = mysqli_fetch_array($res);
$session_id = $data["id"];
if (!empty($data)) {
    $query = 'SELECT * FROM nodes_user WHERE id = '.$data["user_id"];
    $res = engine::mysql($query);
    $data = mysqli_fetch_array($res);
    if (!empty($data)) {
        unset($data["pass"]);
        unset($data[5]);
        $_SESSION["user"] = $data;
        $_SESSION["user"]["session_id"] = $session_id;
    } 
}
if (!$_SESSION["user"]["id"]) {
    engine::error(401);
    return;
}
$query = 'SELECT `access`.`access` FROM `nodes_access` AS `access` '
    . 'LEFT JOIN `nodes_admin` AS `admin` ON `admin`.`url` = "database" '
    . 'WHERE `access`.`user_id` = "'.$_SESSION["user"]["id"].'" '
    . 'AND `access`.`admin_id` = `admin`.`id`';
$admin_res = engine::mysql($query);
$admin_data = mysqli_fetch_array($admin_res);
$admin_access = intval($admin_data["access"]);
if (!$admin_access) {
    engine::error(401);
    return;
}