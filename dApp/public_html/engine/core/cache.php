<?php
/**
* Cache library.
* @path /engine/core/cache.php
*
* @name    DAO Mansion    @version 1.0.3
* @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*
* @example <code>
*  $cache = new cache();
*  $cache_id = $cache->page_id();
* </code>
*/

class cache {
/*
* Output requested page from cache DB.
*
* @return string Returns HTML contents of requested page.
* $usage <code> $cache = new cache(); </code>
*/
public function __construct() {
    engine::log('cache.__construct()');
    $is_cache = intval($_SERVER["configs"]["cache"]);
    $fout = '';
    if (empty($_POST) || !empty($_POST["cache"])) {
        $query = 'SELECT * FROM `nodes_cache` WHERE `url` LIKE "'.$_SERVER["SCRIPT_URI"].'" AND `lang` LIKE "'.$_SESSION["Lang"].'"';
        $res = engine::mysql($query);
        $data = mysqli_fetch_array($res);
        if (!empty($data) && $data["interval"] > 0) {
            if ($data["date"] <= intval(date("U") - $data["interval"])) {
                self::addAttendance($data["id"]);
                die(self::update_cache($_SERVER["SCRIPT_URI"], 0, $data["lang"]));
            } else if (!empty($data["html"])) {
                if (!empty($data["content"])) {
                    $html = $data["html"];
                } else {
                    $html = str_replace('<content/>', $data["content"], $data["html"]);
                }
                self::addAttendance($data["id"]);
                die($html.engine::print_new_message().'
<!-- Time loading from cache: '.(floatval(microtime(1)) - $GLOBALS["time"]).' -->');
            }
            $fout .= "<!-- Cache is empty -->";
        } else if (empty($data)) {
            $fout .= "<!-- Cache is empty -->";
            $query = 'INSERT INTO `nodes_cache`(url, date, lang, `interval`, html, content, script) '
                . 'VALUES("'.$_SERVER["SCRIPT_URI"].'", "'.date("U").'", "'.$_SESSION["Lang"].'", -1, "", "", "")';
            engine::mysql($query);
        } else if ($data["interval"] == "0") {
            if ($is_cache) {
                self::addAttendance($data["id"]);
                if (empty($data["html"]) || !empty($_POST["cache"])) {
                    die(self::update_cache($_SERVER["SCRIPT_URI"], 0, $data["lang"]));
                }
                if (empty($data["content"])) {
                    $html = $data["html"];
                } else {
                    $html = str_replace('<content/>', $data["content"], $data["html"]);
                }
                die($html.engine::print_new_message()."
<!-- Time loading form cache: ".(floatval(microtime(1)) - $GLOBALS["time"])." -->");
            }
        }
    // cacheing for asinc jquery requests
    } else if (count($_POST) == 1 && isset($_POST["jQuery"])) {
        $query = 'SELECT * FROM `nodes_cache` WHERE `url` LIKE "'.$_SERVER["SCRIPT_URI"].'" AND `lang` LIKE "'.$_SESSION["Lang"].'"';
        $res = engine::mysql($query);
        $data = mysqli_fetch_array($res);
        if (!empty($data) && $data["interval"] > 0) {
            if ($data["date"] <= intval(date("U") - $data["interval"])) {
                self::addAttendance($data["id"]);
                die(self::update_cache($_SERVER["SCRIPT_URI"], 1, $data["lang"]));
            } else if (!empty($data["html"])) {
                self::addAttendance($data["id"]);
                die('<title>'.$data["title"].'</title>'
.$data["content"]
.engine::print_new_message().'
<script rel="onload">'.$data["script"].'</script>
<!-- Time loading from cache: '.(floatval(microtime(1)) - $GLOBALS["time"]).' -->');
            }
            $fout .= "<!-- Cache is empty -->";
        } else if (empty($data)) {
            $fout .= "<!-- Cache is empty -->";
            $query = 'INSERT INTO `nodes_cache`(url, date, lang, `interval`, html, content, script) '
                . 'VALUES("'.$_SERVER["SCRIPT_URI"].'", "'.date("U").'", "'.$_SESSION["Lang"].'", -1, "", "", "")';
            engine::mysql($query);
        } else if ($data["interval"] == "0") {
            if ($is_cache) {
                if (empty($data["html"]) || !empty($_POST["cache"])) {
                    self::addAttendance($data["id"]);
                    die(self::update_cache($_SERVER["SCRIPT_URI"], 1, $data["lang"]));
                }
                die('<title>'.$data["title"].'</title>'
.$data["content"]
.engine::print_new_message().'
<script rel="onload">'.$data["script"].'</script>
<!-- Time loading form cache: '.(floatval(microtime(1)) - $GLOBALS["time"]).' -->');
            }
        }
    }
    return $fout;
}
/*
* Update a cache data in DB.
*
* @param string $url Page URL.
* @param bool $jQuery jQuery mode.
* @param string $lang Request language.
* @return string Returns HTML contents of page.
* $usage <code> cache::update_cache("/", TRUE); </code>
*/
public static function update_cache($url, $jQuery = 0, $lang = "en") {
    engine::log('cache::update_cache('.$url.', '.$jQuery.', '.$lang.')');
    if (strpos($url, $_SERVER["PROTOCOL"]."://".$_SERVER["HTTP_HOST"]) === FALSE) {
        $path = $_SERVER["PROTOCOL"]."://".$_SERVER["HTTP_HOST"].$url;
    } else {
        $path = $url;
    }
    $current = floatval(microtime(1));
    $html = engine::curl_post_query($path, "nocache=1&lang=".$lang);
    $load_time = floatval(microtime(1) - $current);
    $c = explode('<!DOCTYPE', $html);
    preg_match('/<title>(.*?)<\/title>.*?itemprop="description" content="(.*?)".*?itemprop="keywords" '
        . 'content="(.*?)".*?<\!-- content -->(.*?)<\!-- \/content -->.*?'
        . '<script rel="onload">(.*?)<\/script>/sim', $html, $m);
    $title = trim($m[1]);
    $description = trim($m[2]);
    $keywords = trim($m[3]);
    $content = trim($m[4]);
    $script = trim($m[5]);
    if (!empty($content)) {
        $fout = '<!DOCTYPE'.str_replace('<content/>', $content, $c[1]);
    } else {
        $fout = '<!DOCTYPE'.$c[1];
    }
    if (!empty($content)) {
        $query = 'UPDATE `nodes_cache` SET '
            . '`html` = "'.str_replace("\\\\", "\\\\\\", str_replace('"', '\"', trim($html))).'", '
            . '`date` = "'.date("U").'", '
            . '`title` = "'.$title.'", '
            . '`description` = "'.$description.'", '
            . '`keywords` = "'.$keywords.'", '
            . '`content` = "'.str_replace("\\\\", "\\\\\\", str_replace('"', '\"', trim($content))).'", '
            . '`script` = "'.str_replace("\\\\", "\\\\\\", str_replace('"', '\"', trim($script))).'", '
            . '`time` = "'.$load_time.'" '
            . 'WHERE `url` = "'.$url.'" AND `lang` = "'.$lang.'"';
        engine::mysql($query);
    } else if (empty($html)) {
        $query = 'DELETE FROM `nodes_cache` WHERE `url` = "'.$url.'" AND `lang` = "'.$lang.'"';
        engine::mysql($query);
        return;
    }
    if (!$jQuery) {
        return($fout.'
<!-- Refreshing cache. Time loading: '.(floatval(microtime(1)) - $GLOBALS["time"]).' -->');
    } else {
        return('<title>'.$data["title"].'</title>'.$content.'
<script rel="onload">'.$data["script"].'</script>
<!-- Refreshing cache and return content. Time loading: '.(floatval(microtime(1)) - $GLOBALS["time"]).' -->');
    }
}

/*
* Gets current page ID.
*
* @return string Returns id of page in MySQL DB.
* $usage <code>
*  $cache = new cache();
*  $id = $cache->page_id();
* </code>
*/
public function page_id() {
    engine::log('cache.page_id()');
    $cache_id = 0;
    if (empty($_POST["nocache"])) {
        $query = 'SELECT `id` FROM `nodes_cache` WHERE `url` = "'.$_SERVER["SCRIPT_URI"].'" AND `lang` = "'.$_SESSION["Lang"].'"';
        $res = engine::mysql($query);
        $cache = mysqli_fetch_array($res);
        if (!empty($cache)) {
            $cache_id = $cache["id"];
        } else {
            $query = 'INSERT INTO `nodes_cache`(url, date, lang, `interval`, html, content, script) '
                . 'VALUES("'.$_SERVER["SCRIPT_URI"].'", "'.date("U").'", "'.$_SESSION["Lang"].'", -1, "", "", "")';
            engine::mysql($query);
            $cache_id = mysqli_insert_id($_SERVER["sql_connection"]);
        }
    }
    return $cache_id;
}

public function addAttendance($cache_id, $ref_id = 0) {
    engine::log('cache.addAttendance('.$cache_id.', '.$ref_id.')');
    if (!$ref_id) {
        $query = 'SELECT * FROM `nodes_referrer` WHERE `name` LIKE "'.$_SERVER["HTTP_REFERER"].'"';
        $res = engine::mysql($query);
        $data = mysqli_fetch_array($res);
        $ref_id = $data[0];
    }
    $query = 'INSERT INTO `nodes_attendance`(cache_id, user_id, token, ref_id, ip, date, display) '
        . 'VALUES("'.$cache_id.'", "'.intval($_SESSION["user"]["id"]).'", "'.session_id().'", "'.$ref_id.'", "'.$_SERVER["REMOTE_ADDR"].'", "'.date("U").'", "'.intval($_SESSION["display"]).'")';
    engine::mysql($query);
}
}
