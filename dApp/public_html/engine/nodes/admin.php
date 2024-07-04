<?php
/**
* Framework admin class.
* @path /engine/nodes/admin.php
*
* @name    DAO Mansion    @version 1.0.3
* @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*/

class admin {
public $site;           // Primary Site object.
public $title;          // Page title.
public $content;        // Page HTML data.
public $onload;         // Page executable JavaScript code.
public $statistic;      // Array CMS statistic.

/**
* Admin class constructor.
* @param object $site Admin Site object.
*/
function admin($site) {
    $this->site = $site;
    $_SERVER["SCRIPT_URI"] = str_replace("/admin", $_SERVER["REQUEST_URI"], $_SERVER["SCRIPT_URI"]);
    if ($_SESSION["Lang"] != 'ru' && !strpos($_SERVER["SCRIPT_URI"], '?lang=')) {
        if (strpos($_SERVER["SCRIPT_URI"], '?')) {
            $_SERVER["SCRIPT_URI"] .= '&lang='.$_SESSION["Lang"];
        } else {
            $_SERVER["SCRIPT_URI"] .= '?lang='.$_SESSION["Lang"];
        }
    }
    if (!empty($_SESSION["user"]["email"]) && $_SESSION["user"]["admin"] == "1") {
        $this->statistic = array();
        $this->statistic["version"] = $site->configs["version"];
        $query = 'SELECT COUNT(`id`) FROM `nodes_cache` WHERE `title` <> ""';
        $res = engine::mysql($query);
        $d = mysqli_fetch_array($res);
        $this->statistic["pages"] = $d[0];
        $query = 'SELECT COUNT(`id`) FROM `nodes_content`';
        $res = engine::mysql($query);
        $d = mysqli_fetch_array($res);
        $this->statistic["articles"] = $d[0];
        $query = 'SELECT COUNT(`id`) FROM `nodes_comment`';
        $res = engine::mysql($query);
        $d = mysqli_fetch_array($res);
        $this->statistic["comments"] = $d[0];
        $query = 'SELECT COUNT(`id`) FROM `nodes_user` WHERE `id` > 1';
        $res = engine::mysql($query);
        $d = mysqli_fetch_array($res);
        $this->statistic["users"] = $d[0];
        $query = 'SELECT AVG(`script_time`) FROM `nodes_perfomance` WHERE `script_time` > 0';
        $res = engine::mysql($query);
        $d = mysqli_fetch_array($res);
        $this->statistic["perfomance"] = round($d[0], 2);
        if ($site->configs["cron"]) {
            $this->statistic["cron"] = 'jQuery ';
        }
        $query = 'SELECT * FROM `nodes_config` WHERE `name` = "cron_exec"';
        $res = engine::mysql($query);
        $exec = mysqli_fetch_array($res);
        $query = 'SELECT * FROM `nodes_config` WHERE `name` = "cron_done"';
        $res = engine::mysql($query);
        $done = mysqli_fetch_array($res);
        if ($exec["value"] <date("U") - 3600) {
            $this->statistic["cron"] .= engine::lang("Disabled");
        } else if ($exec["value"] > $done["value"] + 300) {
            $this->statistic["cron"] .= engine::lang("Error");
        } else {
            $this->statistic["cron"] .= engine::lang("Ok");
        }
        if (!empty($_GET["mode"])) {
            $this->title = engine::lang(ucfirst($_GET["mode"]));
            $function = 'print_admin_'.$_GET["mode"];
            $site->content = '<div class="profile_menu fs10">
                <div class="container">'.engine::print_admin_navigation($this).'</div>
            </div>';
        } else {
            $this->title = engine::lang("Admin");
            $function = 'print_admin';
        }
        $this->content = engine::$function($this);
        $site->title = $this->title." - ".$site->title;
        $site->content .= '<div class="admin_content">
            '.$this->content.'
        </div>';
        $site->onload .= 'document.framework.admin_init(); '.$this->onload;
    } else {
        $this->content = engine::error(401);
    }
}}
