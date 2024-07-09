<?php
/**
* Crontab system script.
* @path /engine/code/cron.php
*
* @name    DAO Mansion    @version 1.0.3
* @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*/

function cron() {
    engine::log('cron()');
    try {
        $_SERVER["CRON"] = 1;
        $flag = 0;
        $query = 'UPDATE `nodes_config` SET `value` = "'.date("U").'" WHERE `name` = "cron_exec"';
        engine::mysql($query);
        $server = floatval(microtime(1) - $GLOBALS["time"]);
        /*
         * Sends bulk mail messages every minute if exists.
         */
        $limit = $_SERVER["configs"]["outbox_limit"];
        $query = 'SELECT * FROM `nodes_user_outbox` WHERE `status` > -2 AND `status` < 1 ORDER BY RAND() DESC LIMIT 0, '.$limit;
        $res = engine::mysql($query);
        while ($data = mysqli_fetch_array($res)) {
            email::bulk_mail($data);
        }
        /*
         * Milestones a performance once a 20 minute.
         */
        $query = 'SELECT `date` FROM `nodes_perfomance` WHERE `date` > "'.(date("U") - 1200).'"';
        $res = engine::mysql($query);
        $data = mysqli_fetch_array($res);
        if (empty($data)) {
            $query = 'SELECT * FROM `nodes_cache` WHERE `interval` >= "-1" AND `url` LIKE "%'.$_SERVER["HTTP_HOST"].'%" ORDER BY RAND() DESC LIMIT 0, 1';
            $res = engine::mysql($query);
            $data = mysqli_fetch_array($res);
            if (!empty($data)) {
                $flag = 1;
                $current = floatval(microtime(1));
                $html = engine::curl_get_query($data["url"]);
                $now = floatval(microtime(1) - $current);
                $query = 'INSERT INTO `nodes_perfomance`(`cache_id`, `server_time`, `script_time`, `date`) '
                    . 'VALUES("'.$data["id"].'", "'.round($server, 3).'", "'.round($now, 3).'", "'.date("U").'")';
                engine::mysql($query);
            }
        }
        /*
         * Generates site daily report to admin email once a day.
         */
        if (!$flag) {
            if (date("H") >= 23) {
                if (intval($_SERVER["configs"]["daily_report"])) {
                    if ($_SERVER["configs"]["lastreport"] < date("U") - 86000) {
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
            if ($_SERVER["configs"]["cron_images"] < date("U") - 86400) {
                $flag = 3;
                $images = array();
                $query = 'SELECT * FROM `nodes_product`';
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
                    if (($file_name != ".")
                        && ($file_name != "..")
                        && is_file($dir.$file_name)
                        && ($file_name != "admin.jpg")
                        && ($file_name != "anon.jpg")
                    ) {
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
         * Deletes an expired sessions and temp captcha images once a day
         */
        if (!$flag) {
            if (intval($_SERVER["configs"]["cron_sessions"]) < date("U") - 86400) {
                $flag = 4;
                $path = "temp/";
                $dir = $_SERVER["DOCUMENT_ROOT"].$_SERVER["DIR"].'/'.$path;
                $hdl = opendir($dir);
                while ($file_name = readdir($hdl)) {
                    if (($file_name != ".")
                        && ($file_name != "..")
                        && is_file($dir.$file_name)
                        && strpos($file_name, ".png") !== false
                    ) {
                        unlink($dir.$file_name);
                    }
                }
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
            $is_cache = intval($_SERVER["configs"]["cache"]);
            if ($is_cache) {
                $query = 'SELECT COUNT(`id`) FROM `nodes_cache` WHERE `interval` > 0 AND `url` NOT LIKE "cron.php" AND `url` LIKE "%'.$_SERVER["HTTP_HOST"].'%"';
                $res = engine::mysql($query);
                $data = mysqli_fetch_array($res);
                $count = round($data[0] / 1440);
                if ($count < 1) {
                    $count = 1;
                }
                $query = 'SELECT * FROM `nodes_cache` WHERE `interval` > 0 AND `url` NOT LIKE "cron.php" AND `url` LIKE "%'.$_SERVER["HTTP_HOST"].'%" ORDER BY `date` ASC LIMIT 0, '.$count;
                $res = engine::mysql($query);
                while ($data = mysqli_fetch_array($res)) {
                    if ($data["date"] <= intval(date("U") - $data["interval"])) {
                        $flag = 5;
                        $url = $data["url"];
                        cache::update_cache($url, 0, $data["lang"]);
                    }
                }
            }
        }
        /*
         * Updates a cache info for new pages.
         */
        if (!$flag) {
            $is_cache = intval($_SERVER["configs"]["cache"]);
            if ($is_cache) {
                $query = 'SELECT * FROM `nodes_cache` WHERE `title` = "" AND `url` NOT LIKE "cron.php" AND `url` LIKE "%'.$_SERVER["HTTP_HOST"].'%" ORDER BY `date` ASC LIMIT 0, 1';
                $res = engine::mysql($query);
                while ($data = mysqli_fetch_array($res)) {
                    $flag = 6;
                    $url = $data["url"];
                    $lang = $data["lang"];
                    cache::update_cache($url, 0, $lang);
                }
            }
        }
        $query = 'UPDATE `nodes_config` SET `value` = "'.date("U").'" WHERE `name` = "cron_done"';
        engine::mysql($query);
        echo $flag;
    } catch(Exception $e) {
        engine::throw('cron()', $e);
    }
}

cron();
