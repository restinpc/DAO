<?php
/**
* Framework session loader.
* @path /engine/nodes/session.php
*
* @name    DAO Mansion    @version 1.0.3
* @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*/

require_once("engine/nodes/mysql.php");

$session_lifetime = 2592000;
session_set_cookie_params($session_lifetime, '/', '.'.$_SERVER["HTTP_HOST"]);
session_name('token');
session_start();
$_SESSION["user"] = array();
$query = 'SELECT * FROM `nodes_user` ORDER BY `id` DESC LIMIT 0, 1';
$res = engine::mysql($query);
$data = mysqli_fetch_array($res);
foreach ($data as $key => $value) {
    if (is_string($key)) {
        $_SESSION["user"][$key] = '';
    }
}
if (empty($_COOKIE["token"])) {
    $_COOKIE["token"] = session_id();
}
if (empty($_SESSION["user"]) || !intval($_SESSION["user"]["id"])) {
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
}
if (!empty($_SESSION["user"]["id"])) {
    $query = 'UPDATE `nodes_user` SET `online`='.date("U").' WHERE `id` = '.intval($_SESSION["user"]["id"]);
    engine::mysql($query);
}
if (!empty($_POST["template"])) {
    $_SESSION["template"] = $_POST["template"];
} else if (empty($_SESSION["template"])) {
    $query = 'SELECT * FROM `nodes_config` WHERE `name` = "template"';
    $res = engine::mysql($query);
    $data = mysqli_fetch_array($res);
    $_SESSION["template"] = $template = $data["value"];
}
if (empty($_SESSION["Lang"])) {
    $query = 'SELECT * FROM `nodes_config` WHERE `name` = "language"';
    $res = engine::mysql($query);
    $data = mysqli_fetch_array($res);
    $_SESSION["Lang"] = $data["value"];
}
if (!empty($_REQUEST["lang"])) {
    if (strlen($_REQUEST["lang"]) != 2) {
        engine::error();
    } else {
        $query = 'SELECT * FROM `nodes_config` WHERE `name` = "languages"';
        $res = engine::mysql($query);
        $data = mysqli_fetch_array($res);
        $lang = substr(strtolower($_REQUEST["lang"]), 0, 2);
        if (strpos($data["value"], $lang) !== false) {
            $_SESSION["Lang"] = $lang;
        } else {
            engine::error();
        }
    }
}
$query = 'SELECT * FROM `nodes_referrer` WHERE `name` LIKE "'.$_SERVER["HTTP_REFERER"].'"';
$res = engine::mysql($query);
$ref = mysqli_fetch_array($res);
if (!empty($_SERVER["HTTP_REFERER"])) {
    if (empty($ref) && strpos($_SERVER["HTTP_REFERER"], $_SERVER["HTTP_HOST"]) === false) {
        $query = 'INSERT INTO `nodes_referrer`(name) VALUES("'.$_SERVER["HTTP_REFERER"].'")';
        engine::mysql($query);
        $ref_id = mysqli_insert_id($_SERVER["sql_connection"]);
    } else {
        $ref_id = -1;
    }
} else {
    $ref_id = 0;
}
if (strpos($_SERVER["SCRIPT_URI"], "/search") === false
    && strpos($_SERVER["SCRIPT_URI"], "/account") === false
    && strpos($_SERVER["SCRIPT_URI"], "/admin") === false
    && strpos($_SERVER["SCRIPT_URI"], ".php") === false
    && strpos($_SERVER["SCRIPT_URI"], ".xml") === false
    && strpos($_SERVER["SCRIPT_URI"], ".js") === false
    && strpos($_SERVER["SCRIPT_URI"], ".txt") === false
    && strpos($_SERVER["HTTP_HOST"], "dev.") === false
) {
    if (empty($_SERVER["SCRIPT_URI"])) {
        $_SERVER["SCRIPT_URI"] = '/';
    }
    $cache = new cache();
    $cache_id = $cache->page_id();
    engine::mysql($query);
}