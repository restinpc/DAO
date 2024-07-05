<?php
/**
* Framework engine class.
* @path /engine/core/engine.php
*
* @name    DAO Mansion    @version 1.0.3
* @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*
* @example <code> engine::error(); </code>
*/

class engine {
/**
* Includes a file from engine/core/../<function_name>.php and
* execute <function_name>($arguments[0], $arguments[1], ...);
*
* @param string $name <function_name>
* @param array $arguments Array of arguments.
* @return mixed Returns result of targeted function or die with error.
*
* @example <code>
*  engine::print_paypal_form($site, 10, "/account/finance");
* </code>
*/
public static function __callStatic($name, $arguments) {
    engine::log('engine::'.$name.'('.json_decode($arguments).')');
    $exec = function_exists($name);
    if (!$exec && !empty($_SERVER["CORE_PATH"])) {
        if (is_file('engine/core/'.$_SERVER["CORE_PATH"].'/'.$name.'.php')) {
            require_once('engine/core/'.$_SERVER["CORE_PATH"].'/'.$name.'.php');
            $exec = 1;
        }
    }
    if (!$exec && is_file('engine/core/function/'.$name.'.php')) {
        require_once('engine/core/function/'.$name.'.php');
        $exec = 1;
    }
    if (!$exec) {
        $skip = array('.', '..', 'function', $_SERVER["CORE_PATH"]);
        $files = scandir('engine/core/');
        foreach ($files as $file) {
            if (!in_array($file, $skip)) {
                if (is_file('engine/core/'.$file.'/'.$name.'.php')) {
                    require_once('engine/core/'.$file.'/'.$name.'.php');
                    $exec = 1;
                    break;
                }
            }
        }
    }
    if ($exec) {
        $count = count($arguments);
        if (!$count) {
            return $name();
        } else if ($count == 1) {
            return $name($arguments[0]);
        } else if ($count == 2) {
            return $name(
                $arguments[0],
                $arguments[1]
            );
        } else if ($count == 3) {
            return $name(
                $arguments[0],
                $arguments[1],
                $arguments[2]
            );
        } else if ($count == 4) {
            return $name(
                $arguments[0],
                $arguments[1],
                $arguments[2],
                $arguments[3]
            );
        } else if ($count == 5) {
            return $name(
                $arguments[0],
                $arguments[1],
                $arguments[2],
                $arguments[3],
                $arguments[4]
            );
        } else if ($count == 6) {
            return $name(
                $arguments[0],
                $arguments[1],
                $arguments[2],
                $arguments[3],
                $arguments[4],
                $arguments[5]
            );
        } else if ($count == 7) {
            return $name(
                $arguments[0],
                $arguments[1],
                $arguments[2],
                $arguments[3],
                $arguments[4],
                $arguments[5],
                $arguments[6]
            );
        }
    } else {
        self::error();
    }
}

static function log($text) {
    if (!empty($_SESSION["LOG"][date("Y-m-d H:i:s").'.000000'])) {
        $flag = 0;
        $i = 1;
        do {
            $n = substr('000000', 0, 6 - strlen($i)).$i;
            if (empty($_SESSION["LOG"][date("Y-m-d H:i:s").'.'.$n])) {
                $_SESSION["LOG"][date("Y-m-d H:i:s").'.'.$n] = $text;
                $flag = 1;
            } else {
                $i++;
            }
        } while(!$flag);
    } else {
        $_SESSION["LOG"][date("Y-m-d H:i:s").'.000000'] = $text;
    }
}

static function lang($key) {
    if ($_SESSION["Lang"] && $_SESSION["Lang"] == "en") {
        return $key;
    }
    if (!$GLOBALS["_LANG"] || !is_array($GLOBALS["_LANG"])) {
        $GLOBALS["_LANG"] = array();
        $query = 'SELECT * FROM `nodes_language` WHERE `lang` = "'.$_SESSION["Lang"].'"';
        $res = engine::mysql($query);
        while ($data = mysqli_fetch_array($res)) {
            $GLOBALS["_LANG"][$data["name"]] = $data["value"];
        }
    }
    if ($GLOBALS["_LANG"][$key]) {
        return $GLOBALS["_LANG"][$key];
    } else {
        $GLOBALS["_LANG"][$key] = $key;
        $query = 'INSERT INTO `nodes_language`(name, lang, value) VALUES("'.$key.'", "'.$_SESSION["Lang"].'", "'.$key.'")';
        engine::mysql($query);
        return $key;
    }
}

static function href($url) {
    $fout = $url;
    if ($_SESSION["Lang"] != "ru") {
        if (!strpos($url, 'lang=')) {
            if (strpos($url, "?")) {
                $fout = $url . "&lang=" . $_SESSION["Lang"];
            } else {
                $fout = $url . "?lang=" . $_SESSION["Lang"];
            }
        }
    }
    return $fout;
}

/**
* Register error in a DB and print error page.
*
* @param string $error_code HTTP code of error.
* @usage <code> engine::error(401); </code>
*/
static function error($error_code = '0') {
    engine::log('engine::error('.$error_code.')');
    $my_error = mysqli_error($_SERVER["sql_connection"]);
    $query = 'SELECT `value` FROM `nodes_config` WHERE `name` = "debug"';
    $res = self::mysql($query);
    $data = mysqli_fetch_array($res);
    if (false) {
        // todo - trace errors
        echo "PHP:"."\n";
        print_r(error_get_last());
        echo "\n"."----------------------------------------"."\n"."MySQL:"."\n";
        print_r($my_error);
        echo "\n"."----------------------------------------"."\n"."Console:"."\n";
        print_r($_SESSION["LOG"]);
        echo "\n"."----------------------------------------"."\n";
    }
    if ($error_code != 0) {
        $_GET[$error_code] = 1;
    }
    if (!isset($_GET["204"]) && !isset($_GET["504"])) {
        $_SERVER["SCRIPT_URI"] = str_replace($_SERVER["PROTOCOL"]."://", "\$h", $_SERVER["SCRIPT_URI"]);
        while ($_SERVER["SCRIPT_URI"][strlen($_SERVER["SCRIPT_URI"]) - 1] == "/") {
            $_SERVER["SCRIPT_URI"] = mb_substr($_SERVER["SCRIPT_URI"], 0, strlen($_SERVER["SCRIPT_URI"]) - 1);
        }
        $_SERVER["SCRIPT_URI"] = str_replace("\$h", $_SERVER["PROTOCOL"]."://", $_SERVER["SCRIPT_URI"]);
        if (empty($_SERVER["SCRIPT_URI"])) {
            $_SERVER["SCRIPT_URI"] = "/";
        }
        $get = $session = $post = '';
        $get = print_r($_GET, 1);
        $post = print_r($_POST, 1);
        $session = print_r($_SESSION, 1);
        $get = engine::escape_string($get);
        $post = engine::escape_string($post);
        $session = engine::escape_string($session);
        $query = 'DELETE FROM `nodes_cache` WHERE `url` = "'.$_SERVER["SCRIPT_URI"].'" '
                . 'AND `lang` = "'.$_SESSION["Lang"].'"';
        engine::mysql($query);
        $query = 'SELECT * FROM `nodes_error` WHERE '
                . '`url` = "'.$_SERVER["SCRIPT_URI"].'" AND '
                . '`lang` = "'.$_SESSION["Lang"].'" AND '
                . '`ip` = "'.$_SERVER["REMOTE_ADDR"].'" AND '
                . '`get` = "'.$get.'" AND '
                . '`post` = "'.$post.'" AND '
                . '`session` = "'.$session.'"';
        $res = engine::mysql($query);
        $data = mysqli_fetch_array($res);
        if (empty($data)) {
            $query = 'INSERT INTO `nodes_error`(`url`, `lang`, `date`, `ip`, `get`, `post`, `session`, `count`) '
            . 'VALUES("'.$_SERVER["SCRIPT_URI"].'", '
                    . '"'.$_SESSION["Lang"].'", '
                    . '"'.date("U").'", '
                    . '"'.$_SERVER["REMOTE_ADDR"].'", '
                    . '"'.$get.'", '
                    . '"'.$post.'", '
                    . '"'.$session.'", '
                    . '"1")';
        } else {
           $query = 'UPDATE `nodes_error` SET `date` = "'.date("U").'", `count` = "'.($data["count"] + 1).'" WHERE `id` = "'.$data["id"].'"';
        }
        self::mysql($query);
    }
    if (empty($_POST["jQuery"])) { 
        echo '<!DOCTYPE html>
            <html style="background: #1a1d1d; height: 100%; font-family: sans-serif;">
            <head><title>Error</title><meta charset="UTF-8" />
            <meta http-equiv="content-type" content="text/html; charset=utf-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            </head>
        <body>';
        require_once("engine/code/error.php");
        echo '</body></html>';
    } else {
        require_once("engine/code/error.php");
    }
    die();
}

/**
* Sends a query to the currently active MySQL DB.
*
* @param string $query MySQL request.
* @return mixed Returns a resource on success, or die with error.
* @usage <code>
*  $res = engine::mysql($query);
*  $data = mysqli_fetch_array($res);
* </code>
*/
static function mysql($query) {
    engine::log('engine::mysql('.str_replace('"', '\"', $query).')');
    require_once("engine/nodes/mysql.php");
    @mysqli_query($_SERVER["sql_connection"], "SET NAMES utf8");
    $res = mysqli_query($_SERVER["sql_connection"], $query) or die(engine::error(500));
    return $res;
}

static function escape_string($string) {
    engine::log("engine::escape_string(".$string.")");
    return strip_tags(mysqli_real_escape_string($_SERVER["sql_connection"], trim($string)));
}

/**
* Sends a mail.
*
* @param string $email Receiver, or receivers of the mail.
* @param string $header Sender of the mail.
* @param string $theme Subject of the email to be sent.
* @param string $message Text of the email to be sent.
* @return bool Returns TRUE on success, FALSE on failure.
* @usage <code>
*  engine::send_mail("dev@null.com", "admin@server.com", "Hello", "Text");
* </code>
*/
static function send_mail($email, $header, $theme, $message) {
    engine::log('engine::send_mail('.$email.', '.$header.', '.$theme.')');
    $text = "To: ".$email."\n";
    $text .= "Theme: ".$theme."\n";
    $text .= "Text: ".$message;
    preg_replace('/<style>.*?<\/style>/', '', $text);
    $text = engine::escape_string(strip_tags($text, '<a><br/>'));
    $header = "From: {$header}\nContent-Type: text/html; charset=utf-8";
    $theme = '=?utf-8?B?' . base64_encode($theme) . '?=';
    if (mail($email, "{$theme}\n", $message, $header)) {
        return true;
    }
    return false;
}

/**
* Convert a string to URL-compatible format.
*
* @param string $str The input string.
* @return string Returns the convetrted string.
* @usage <code> engine::url_translit("Hello world!"); </code>
*/
static function url_translit($str) {
    engine::log('engine::url_translit("'.$str.'")');
    $translit = array(
        "А"=>"A", "Б"=>"B", "В"=>"V", "Г"=>"G", "Д"=>"D", "Е"=>"E", "Ж"=>"J",
        "З"=>"Z", "И"=>"I", "Й"=>"Y", "К"=>"K", "Л"=>"L", "М"=>"M", "Н"=>"N",
        "О"=>"O", "П"=>"P", "Р"=>"R", "С"=>"S", "Т"=>"T", "У"=>"U", "Ф"=>"F",
        "Х"=>"H", "Ц"=>"TS", "Ч"=>"CH", "Ш"=>"SH", "Щ"=>"SCH", "Ъ"=>"", "Ы"=>"YI",
        "Ь"=>"", "Э"=>"E", "Ю"=>"YU", "Я"=>"YA", "а"=>"a", "б"=>"b", "в"=>"v",
        "г"=>"g", "д"=>"d", "е"=>"e", "ж"=>"j", "з"=>"z", "и"=>"i", "й"=>"y",
        "к"=>"k", "л"=>"l", "м"=>"m", "н"=>"n", "о"=>"o", "п"=>"p", "р"=>"r",
        "с"=>"s", "т"=>"t", "у"=>"u", "ф"=>"f", "х"=>"h", "ц"=>"ts", "ч"=>"ch",
        "ш"=>"sh", "щ"=>"sch", "ъ"=>"y", "ы"=>"yi", "ь"=>"", "э"=>"e", "ю"=>"yu",
        "я"=>"ya", "  "=>" ", " "=>"_"
    );
    $str = strtr($str, $translit);
    $str = preg_replace ("/[^a-zA-ZА-Яа-я0-9_\s]/", "", $str);
    return $str;
}

/**
* Send GET request using CURL Library.
*
* @param string $url Request URL.
* @param bool $format Remove all non-text chars from string if TRUE.
* @return string Returns result of request.
* @usage <code> engine::curl_get_query("http://google.com"); </code>
*/
static function curl_get_query($url, $format = 0) {
    engine::log('engine::curl_get_query('.$url.')');
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_POST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_VERBOSE, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, 'DAO Mansion <'.$_SERVER["PUBLIC_URL"].'>');
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    $html = curl_exec($ch);
    $error = curl_error($ch);
    curl_close($ch);
    if (empty($html)) {
        return $error;
    }
    if ($format) {
        $html = str_replace("\r", "", $html);
        $html = str_replace("\f", "", $html);
        $html = str_replace("\v", " ", $html);
        $html = str_replace("\n", "", $html);
        $html = str_replace("\t", "", $html);
    }
    return $html;
}

/**
* Send POST request using CURL Library.
*
* @param string $url Request URL.
* @param string $url Formated POST data.
* @param bool $format Remove all non-text chars from string if TRUE.
* @return string Returns result of request.
* @usage <code> engine::curl_post_query("http://google.com", 'foo=1&bar=2'); </code>
*/
static function curl_post_query($url, $query, $format = 0) {
    engine::log('engine::curl_post_query('.$url.', '.$query.')');
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_POST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
    curl_setopt($ch, CURLOPT_VERBOSE, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, 'DAO Mansion <'.$_SERVER["PUBLIC_URL"].'>');
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    $html = curl_exec($ch);
    $error = curl_error($ch);
    curl_close($ch);
    if (empty($html)) {
        return $error;
    }
    if ($format) {
        $html = str_replace("\r", "", $html);
        $html = str_replace("\f", "", $html);
        $html = str_replace("\v", " ", $html);
        $html = str_replace("\n", "", $html);
        $html = str_replace("\t", "", $html);
    }
    return $html;
}

static function redirect($url) {
    engine::log('engine::redirect('.$url.')');
    header( 'Location: '.$url );
    die('<script>window.location = "'.$url.'";</script>');
}

static function encode_password($password) {
    engine::log('engine::encode_password('.$password.')');
    return password_hash($password, PASSWORD_BCRYPT, [
        'cost' => 11,
        'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
    ]);
}

static function match_passwords($password, $hashed_password) {
    engine::log('engine::match_passwords('.$password.', '.$hashed_password.')');
    return password_verify($password, $hashed_password);
}
}
