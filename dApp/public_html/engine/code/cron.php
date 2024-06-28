<?php
/**
* Crontab system script.
* @path /engine/code/cron.php
*
* @name    DAO Mansion    @version 1.0.3
* @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*/

set_time_limit(60);
ini_set('max_execution_time', "60");
require_once("engine/nodes/headers.php");
require_once("engine/nodes/mysql.php");
require_once("engine/nodes/session.php");

$flag = 0;
$query = 'UPDATE `nodes_config` SET `value` = "'.date("U").'" WHERE `name` = "cron_exec"';
engine::mysql($query);
$server = doubleval(microtime(1)-$GLOBALS["time"]);
/*
 * Sends bulk mail messages every minute if exists.
 */
$query = 'SELECT `value` FROM `nodes_config` WHERE `name` = "outbox_limit"';
$r = engine::mysql($query);
$d = mysqli_fetch_array($r);
$limit = $d[0];
$query = 'SELECT * FROM `nodes_user_outbox` WHERE `status` > -2 AND `status` < 1 ORDER BY RAND() DESC LIMIT 0, '.$limit;
$res = engine::mysql($query);
while ($data = mysqli_fetch_array($res)) {
    email::bulk_mail($data);
}
/*
 * Clean-up temp BTC transactions.
 */
$query = 'DELETE FROM `nodes_transaction` WHERE `comment` = "Temp" AND `date` < "'.(date("U")-86400).'"';
engine::mysql($query);
/*
 * Milestones a performance once a 20 minute.
 */
$query = 'SELECT `date` FROM `nodes_perfomance` WHERE `date` > "'.(date("U")-1200).'"';
$res = engine::mysql($query);
$data = mysqli_fetch_array($res);
if (empty($data)) {
    $query = 'SELECT * FROM `nodes_cache` WHERE `interval` >= "-1" AND `url` LIKE "%'.$_SERVER["HTTP_HOST"].'%" ORDER BY RAND() DESC LIMIT 0, 1';
    $res = engine::mysql($query);
    $data = mysqli_fetch_array($res);
    if (!empty($data)) {
        $flag = 1;
        $current = doubleval(microtime(1));
        $html = engine::curl_get_query($data["url"]);
        $now = doubleval(microtime(1)-$current);
        $query = 'INSERT INTO `nodes_perfomance`(`cache_id`, `server_time`, `script_time`, `date`) '
                . 'VALUES("'.$data["id"].'", "'.$server.'", "'.$now.'", "'.date("U").'")';
        engine::mysql($query);
    }
}
/*
 * Generates site daily report to admin email once a day.
 */
if (!$flag) {
    if (date("H") >= 23) {
        $query = 'SELECT * FROM `nodes_config` WHERE `name` = "daily_report"';
        $res = engine::mysql($query);
        $data = mysqli_fetch_array($res);
        if (intval($data["value"])) {
            $query = 'SELECT * FROM `nodes_config` WHERE `name` = "lastreport"';
            $res = engine::mysql($query);
            $data = mysqli_fetch_array($res);
            if ($data["value"] < date("U")-86000) {
                $flag = 2;
                email::daily_report();
                $query = 'UPDATE `nodes_config` SET `value` = "'.date("U").'" WHERE `name` = "lastreport"';
                engine::mysql($query);
            }
        }
    }
}
/*
 * Unlinks temp images once a day.
 */
if (!$flag) {
    $query = 'SELECT * FROM `nodes_config` WHERE `name` = "cron_images"';
    $res = engine::mysql($query);
    $data = mysqli_fetch_array($res);
    if ($data["value"] < date("U") - 86400) {
        $flag = 3;
        $images = array();
        $query = 'SELECT * FROM  `nodes_product`';
        $res = engine::mysql($query);
        while ($data = mysqli_fetch_array($res)) {
            $imgs = explode(';', $data["img"]);
            foreach ($imgs as $img) {
                $img = trim($img);
                if (!empty($img)) {
                    if (!in_array($img, $images)) {
                        array_push($images, $img);
                    }
                }
            }
        }
        $query = 'SELECT * FROM `nodes_content`';
        $res = engine::mysql($query);
        while ($data = mysqli_fetch_array($res)) {
            $img = trim($data["img"]);
            if (!empty($img)) {
                if (!in_array($img, $images)) {
                    array_push($images, $img);
                }
            }
            $imgs = explode(';', $data["imgs"]);
            foreach ($imgs as $img) {
                $img = trim($img);
                if (!empty($img)) {
                    if (!in_array($img, $images)) {
                        array_push($images, $img);
                    }
                }
            }
        }
        $query = 'SELECT * FROM `nodes_catalog`';
        $res = engine::mysql($query);
        while ($data = mysqli_fetch_array($res)) {
            $img = trim($data["img"]);
            if (!empty($img)) {
                if (!in_array($img, $images)) {
                    array_push($images, $img);
                }
            }
        }
        $path = "img/data/big/";
        $dir = $_SERVER["DOCUMENT_ROOT"].$_SERVER["DIR"].'/'.$path;
        $hdl = opendir($dir);
        while ($file_name = readdir($hdl)) {
            if (($file_name != ".") && ($file_name != "..") && is_file($dir.$file_name)) {
                if (!in_array($file_name, $images)) {
                    unlink($dir.$file_name);
                }
            }
        }
        closedir($hdl);
        $path = "img/data/thumb/";
        $dir = $_SERVER["DOCUMENT_ROOT"].$_SERVER["DIR"].'/'.$path;
        $hdl = opendir($dir);
        while ($file_name = readdir($hdl)) {
            if (($file_name != ".") && ($file_name != "..") && is_file($dir.$file_name)) {
                if (!in_array($file_name, $images)) {
                    unlink($dir.$file_name);
                }
            }
        }
        closedir($hdl);
        $images = array();
        $query = 'SELECT * FROM `nodes_user`';
        $res = engine::mysql($query);
        while ($data = mysqli_fetch_array($res)) {
            $img = trim($data["photo"]);
            if (!empty($img)) {
                if (!in_array($img, $images)) {
                    array_push($images, $img);
                }
            }
        }
        $path = "img/pic/";
        $dir = $_SERVER["DOCUMENT_ROOT"].$_SERVER["DIR"].'/'.$path;
        $hdl = opendir($dir);
        while ($file_name = readdir($hdl)) {
            if (($file_name != ".") && ($file_name != "..") && is_file($dir.$file_name)
                && ($file_name != "admin.jpg") && ($file_name != "anon.jpg")) {
                if (!in_array($file_name, $images)) {
                    unlink($dir.$file_name);
                }
            }
        }
        closedir($hdl);
        $query = 'UPDATE `nodes_config` SET `value` = "'.date("U").'" WHERE `name` = "cron_images"';
        engine::mysql($query);
    }
}
/*
 * Deletes an expired sessions once a day
 */
if (!$flag) {
    $query = 'SELECT * FROM `nodes_config` WHERE `name` = "cron_sessions"';
    $res = engine::mysql($query);
    $data = mysqli_fetch_array($res);
    if ($data["value"] < date("U") - 86400) {
        $flag = 4;
        $query = 'DELETE FROM nodes_session WHERE expire_at < NOW()';
        engine::mysql($query);
        $query = 'UPDATE `nodes_config` SET `value` = "'.date("U").'" WHERE `name` = "cron_sessions"';
        engine::mysql($query);
    }
}
/*
 * Updates a cache info for "cached" pages.
 */
if (!$flag) {
    $query = 'SELECT * FROM `nodes_config` WHERE `name` = "cache"';
    $res = engine::mysql($query);
    $data = mysqli_fetch_array($res);
    $is_cache = intval($data["value"]);
    if ($is_cache) {
        $query = 'SELECT COUNT(`id`) FROM `nodes_cache` WHERE `interval` > 0 AND `url` NOT LIKE "cron.php" AND `url` LIKE "%'.$_SERVER["HTTP_HOST"].'%"';
        $res = engine::mysql($query);
        $data = mysqli_fetch_array($res);
        $count = round($data[0]/1440);
        if ($count < 1) {
            $count = 1;
        }
        $query = 'SELECT * FROM `nodes_cache` WHERE `interval` > 0 AND `url` NOT LIKE "cron.php" AND `url` LIKE "%'.$_SERVER["HTTP_HOST"].'%" ORDER BY `date` ASC LIMIT 0, '.$count;
        $res = engine::mysql($query);
        while ($data = mysqli_fetch_array($res)) {
            if ($data["date"] <= intval(date("U") - $data["interval"])) {
                $flag = 5;
                $url = $data["url"];
                cache::update_cache($url,0,$data["lang"]);
            }
        }
    }
}
/*
 * Updates a cache info for new pages.
 */
if (!$flag) {
    $query = 'SELECT * FROM `nodes_config` WHERE `name` = "cache"';
    $res = engine::mysql($query);
    $data = mysqli_fetch_array($res);
    $is_cache = intval($data["value"]);
    if ($is_cache) {
        $query = 'SELECT * FROM `nodes_cache` WHERE `title` = "" AND `url` NOT LIKE "cron.php" AND `url` LIKE "%'.$_SERVER["HTTP_HOST"].'%" ORDER BY `date` ASC LIMIT 0, 1';
        $res = engine::mysql($query);
        while ($data = mysqli_fetch_array($res)) {
            $flag = 6;
            $url = $data["url"];
            $lang = $data["lang"];
            cache::update_cache($url,0,$lang);
        }
    }
}

$query = 'UPDATE `nodes_config` SET `value` = "'.date("U").'" WHERE `name` = "cron_done"';
engine::mysql($query);
echo $flag;
