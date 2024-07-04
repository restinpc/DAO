<?php
/**
* Framework autoloader.
* @path /engine/nodes/autoload.php
*
* @name    DAO Mansion    @version 1.0.3
* @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*/

error_reporting(0);
date_default_timezone_set('UTC');
$GLOBALS["time"] = floatval(microtime(1));
$_SERVER["PROTOCOL"] = "https";
$_SESSION["display"] = 0;
if (!isset($_SERVER["SCRIPT_URI"])) {
    $_SERVER["SCRIPT_URI"] = '';
}
if (!isset($_SERVER["HTTP_REFERER"])) {
    $_SERVER["HTTP_REFERER"] = '';
}
if (!is_array($_GET)) {
    $_GET = array();
}
if (!isset($_GET[0])) {
    $_GET[0] = '';
}
$_SERVER["SCRIPT_URI"] = str_replace("http://", "https://", $_SERVER["SCRIPT_URI"]);
$_SERVER["PROTOCOL"] = "https";
$_SERVER["CONSOLE"] = array();
$_SERVER["DIR"] = str_replace("/cron.php", "",
    str_replace("index.php", "", str_replace("/index.php", "",
    str_replace($_SERVER["DOCUMENT_ROOT"], "", $_SERVER["SCRIPT_FILENAME"])))
);
$_SERVER["PUBLIC_URL"] = $_SERVER["PROTOCOL"]."://".$_SERVER["HTTP_HOST"].$_SERVER["DIR"];
ini_set('include_path', $_SERVER["DOCUMENT_ROOT"].$_SERVER["DIR"]);
require_once('engine/core/engine.php');
if (!file_exists($_SERVER["DOCUMENT_ROOT"].$_SERVER["DIR"]."/engine/nodes/config.php")
    && !file_exists("engine/nodes/config.php")
) {
    die(require_once("engine/code/install.php"));
}
$request = str_replace("index.php", "", 
    mb_substr($_SERVER["REQUEST_URI"],
        strpos($_SERVER["SCRIPT_NAME"], "index.php"),
        strlen($_SERVER["REQUEST_URI"])
    )
);
if (strpos($request, "?") !== FALSE) {
    $args = mb_substr($request, strpos($request, "?"));
    $request = mb_substr($request, 0, strpos($request, "?"));
} else {
    $args = '';
}
$get = explode("/", $request);
$_GET = array();
for ($i = 0; $i < count($get); $i++) {
    if (!empty($get[$i])) {
        $_GET[count($_GET)] = $get[$i];
    }
}
preg_match_all('/[\?|\&]?([^=]+)=([^\&]+)\&?/six', $args, $m);
for ($i = 0; $i < count($m[1]); $i++) {
    $_GET[$m[1][$i]] = $m[2][$i];
}
$_REQUEST = array_merge($_GET, $_POST);
if (empty($_SERVER["SCRIPT_URI"])) {
    $_SERVER["SCRIPT_URI"] = $_SERVER["REQUEST_URI"];
}
if (strpos($_SERVER["SCRIPT_URI"], $_SERVER["PROTOCOL"]."://") === FALSE) {
    if ($_SERVER["SCRIPT_URI"][0] == "/") {
        $_SERVER["SCRIPT_URI"] = $_SERVER["PROTOCOL"]."://".$_SERVER["HTTP_HOST"].
            $_SERVER["DIR"].$_SERVER["SCRIPT_URI"];
    } else {
        $_SERVER["SCRIPT_URI"] = $_SERVER["PROTOCOL"]."://".$_SERVER["HTTP_HOST"].
            $_SERVER["DIR"].'/'.$_SERVER["SCRIPT_URI"];
    }
    $_SERVER["SCRIPT_URI"] = str_replace($_SERVER["PROTOCOL"]."://", "\$h", $_SERVER["SCRIPT_URI"]);
}
while ($_SERVER["SCRIPT_URI"][strlen($_SERVER["SCRIPT_URI"]) - 1] == "/") {
    $_SERVER["SCRIPT_URI"] = mb_substr($_SERVER["SCRIPT_URI"], 0, strlen($_SERVER["SCRIPT_URI"]) - 1);
}
$_SERVER["SCRIPT_URI"] = str_replace("\$h", $_SERVER["PROTOCOL"]."://", $_SERVER["SCRIPT_URI"]);
if ($_SERVER["SCRIPT_URI"] == $_SERVER["PUBLIC_URL"] && !empty($_SERVER["DIR"])) {
    $_SERVER["SCRIPT_URI"] .= '/';
}
$skip = array('.', '..', 'engine.php');
$files = scandir($_SERVER["DOCUMENT_ROOT"].$_SERVER["DIR"].'/engine/core/');
foreach ($files as $file) {
    if (!in_array($file, $skip)) {
        if (is_file($_SERVER["DOCUMENT_ROOT"].$_SERVER["DIR"].'/engine/core/'.$file)) {
            require_once('engine/core/'.$file);
        }
    }
}
if (strpos($_GET[0], "robots.txt") !== FALSE) {
    $_GET[0] = str_replace("robots.txt", "robots.php", $_GET[0]);
}
if (strpos($_GET[0], "rss.xml") !== FALSE) {
    $_GET[0] = str_replace("rss.xml", "rss.php", $_GET[0]);
}
if (strpos($_GET[0], "sitemap.xml") !== FALSE) {
    $_GET[0] = str_replace("sitemap.xml", "sitemap.php", $_GET[0]);
}
if (!empty($_GET[0]) && strpos($_GET[0], ".php") && (
        file_exists($_SERVER["DOCUMENT_ROOT"].$_SERVER["DIR"]."/engine/code/".$_GET[0])
        || file_exists("engine/code/".$_GET[0])
    )
) {
    die(require_once ("engine/code/".$_GET[0]));
} else {
    require_once("engine/nodes/session.php");
    if (!isset($_POST) && !strpos($_SERVER["REQUEST_URI"], "lang=".$_SESSION["Lang"])) {
        if (!empty($_SESSION["Lang"]) && $_SESSION["Lang"] != "ru") {
            $url = $_SERVER["REQUEST_URI"];
            if (strpos($url, '?')) {
                $url .= '&lang='.$_SESSION["Lang"];
            } else {
                $url .= '?lang='.$_SESSION["Lang"];
            }
            header("Location: ".$url);
            die();
        }
    }
    require_once("engine/nodes/site.php");
    $site = new site();
    if (empty($_POST["catch"])) {
        die("<!-- ".(floatval(microtime(1) - $GLOBALS["time"]))." -->");
    }
}
