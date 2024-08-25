<?php
/**
* Print admin files page.
* @path /engine/core/admin/print_admin_files.php
*
* @name    DAO Mansion    @version 1.0.6
* @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*
* @var $cms->site - Site object.
* @var $cms->title - Page title.
* @var $cms->content - Page HTML data.
* @var $cms->menu - Page HTML navigaton menu.
* @var $cms->onload - Page executable JavaScript code.
* @var $cms->statistic - Array with statistics.
*
* @param object $cms Admin class object.
* @return string Returns content of page on success, or die with error.
* @usage <code> engine::print_admin_files($cms); </code>
*/

function print_admin_files($cms) {
    engine::log('admin.print_admin_files()');
    try {
        $query = 'SELECT `access`.`access` FROM `nodes_access` AS `access` '
            . 'LEFT JOIN `nodes_admin` AS `admin` ON `admin`.`url` = "files" '
            . 'WHERE `access`.`user_id` = "'.$_SESSION["user"]["id"].'" '
            . 'AND `access`.`admin_id` = `admin`.`id`';
        $admin_res = engine::mysql($query);
        $admin_data = mysqli_fetch_array($admin_res);
        $admin_access = intval($admin_data["access"]);
        if (!$admin_access) {
            engine::error(401);
            return;
        }
        $fout = '<iframe src="'.$_SERVER["PUBLIC_URL"].'/files.php" width="100%" class="app"></iframe>';
        return $fout;
    } catch(Exception $e) {
        engine::throw('admin.print_admin_files()', $e);
    }
}

