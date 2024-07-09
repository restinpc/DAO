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
if (strpos($_SERVER["REQUEST_URI"], ".php") === false && !isset($_POST["jQuery"])) {
    $_SESSION["LOG"] = array();
} else if (!array_key_exists("LOG", $_SESSION) || !is_array($_SESSION["LOG"])) {
    $_SESSION["LOG"] = array();
}
engine::log(">> ".$_SERVER["SCRIPT_URI"]);
if (!array_key_exists("display", $_SESSION)) {
    $_SESSION["display"] = 0;
}
if (!array_key_exists("user", $_SESSION)) {
    $_SESSION["user"] = array();
    $query = 'SELECT * FROM `nodes_user` ORDER BY `id` DESC LIMIT 0, 1';
    $res = engine::mysql($query);
    $data = mysqli_fetch_array($res);
    foreach ($data as $key => $value) {
        if (is_string($key)) {
            $_SESSION["user"][$key] = '';
        }
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
    $query = 'UPDATE `nodes_user` SET `online` = '.date("U").' WHERE `id` = '.intval($_SESSION["user"]["id"]);
    engine::mysql($query);
}
if (!array_key_exists("configs", $_SERVER)) {
    $_SERVER["configs"] = array();
    $query = 'SELECT * FROM `nodes_config`';
    $res = engine::mysql($query);
    while($data = mysqli_fetch_array($res)) {
        $_SERVER["configs"][$data["name"]] = $data["value"];
    }
}
if (!empty($_POST["template"])) {
    $_SESSION["template"] = $_POST["template"];
} else if (empty($_SESSION["template"])) {
    $_SESSION["template"] = $_SERVER["configs"]["template"];
}
if (empty($_SESSION["Lang"])) {
    $_SESSION["Lang"] = $_SERVER["configs"]["language"];
}
if (!empty($_REQUEST["lang"])) {
    if (strlen($_REQUEST["lang"]) != 2) {
        engine::error();
    } else {
        $lang = substr(strtolower($_REQUEST["lang"]), 0, 2);
        if (strpos($_SERVER["configs"]["languages"], $lang) !== false) {
            $_SESSION["Lang"] = $lang;
        } else {
            engine::error();
        }
    }
}
$query = 'SELECT * FROM `nodes_attendance` WHERE `token` = "'.$_COOKIE["token"].'" ORDER BY `date` DESC LIMIT '.($_SERVER["configs"]["token_limit"]-1).', 1';
$res = engine::mysql($query);
$data = mysqli_fetch_array($res);
$date = $data["date"];
if (date("U") - $date < 60) {
    header('HTTP/ 429 Too Many Requests', true, 429);
    die("Too many requests in this session. Try again after ".(60 - (date("U") - $date))." seconds.");
} else if (!empty($_SERVER["REMOTE_ADDR"]) && !isset($_SERVER["CRON"])) {
    $query = 'SELECT * FROM `nodes_attendance` WHERE `ip` = "'.$_SERVER["REMOTE_ADDR"].'" ORDER BY `date` DESC LIMIT '.($_SERVER["configs"]["ip_limit"] - 1).', 1';
    $res = engine::mysql($query);
    $data = mysqli_fetch_array($res);
    $date = $data["date"];
    if (date("U") - $date < 60) {
        header('HTTP/ 429 Too Many Requests', true, 429);
        die("Too many requests from your IP. Try again after ".(60 - (date("U") - $date))." seconds.");
    } else {
        $ref_id = 0;
        if (!empty($_SERVER["HTTP_REFERER"])) {
            if (strpos($_SERVER["HTTP_REFERER"], $_SERVER["HTTP_HOST"]) === false) {
                $query = 'SELECT * FROM `nodes_referrer` WHERE `name` LIKE "'.$_SERVER["HTTP_REFERER"].'"';
                $res = engine::mysql($query);
                $ref = mysqli_fetch_array($res);
                if (empty($ref)) {
                    $query = 'INSERT INTO `nodes_referrer`(name) VALUES("'.$_SERVER["HTTP_REFERER"].'")';
                    engine::mysql($query);
                    $ref_id = mysqli_insert_id($_SERVER["sql_connection"]);
                } else {
                    $ref_id = $ref["id"];
                }
            } else {
                $ref_id = -1;
            }
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
            $date_now = date("U");
            $cache->addAttendance($cache_id, $ref_id);
        }
    }
}