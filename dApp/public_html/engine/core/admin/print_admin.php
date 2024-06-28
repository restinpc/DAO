<?php
/**
* Print admin main page.
* @path /engine/core/admin/print_admin.php
*
* @name    DAO Mansion    @version 1.0.2
* @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*
* @var $cms->site - Site class object.
* @var $cms->title - Page title.
* @var $cms->content - Page HTML data.
* @var $cms->menu - Page HTML navigaton menu.
* @var $cms->onload - Page executable JavaScript code.
* @var $cms->statistic - Array with statistics.
*
* @param object $cms Admin class object.
* @return string Returns content of page on success, or die with error.
* @usage <code> engine::print_admin($cms); </code>
*/
function print_admin($cms) {
    $fout = '
<div class="document980">
<div class="two_columns">
    <section class="top_right_column">
        <div class="right_column_block single_block admin_main_page_right">
            <div class="admin_main_page_right_block">
                <b class="utc_date" alt="'.date("U").'">'.date("d/m/Y H:i").' '.  date_default_timezone_get().'</b><br/>
                '.engine::lang("Total pages").': <b>'.$cms->statistic["pages"].'</b><br/>
                '.engine::lang("Total users").': <b>'.$cms->statistic["users"].'</b><br/>
                '.engine::lang("Total comments").': <b>'.$cms->statistic["comments"].'</b><br/>
                '.engine::lang("Perfomance").': <b>'.$cms->statistic["perfomance"].'</b><br/>
                '.engine::lang("Cron status").': <b>'.$cms->statistic["cron"].'</b><br/>
            </div>
        </div>
    </section>
    <section class="left_column b0">';
    $query = 'SELECT `admin`.*, `access`.`access` FROM `nodes_access` AS `access` LEFT JOIN `nodes_admin` AS `admin` ON `admin`.`id` = `access`.`admin_id` WHERE `access`.`user_id` = "'.$_SESSION["user"]["id"].'" ORDER BY `admin`.`id` ASC';
    $res = engine::mysql($query);
    while ($data = mysqli_fetch_array($res)) {
        if ($data["access"]) {
            $fout .= '<div class="admin_menu_icon"><a id="admin-link-'.$data["id"].'" href="'.$_SERVER["DIR"].'/admin/?mode='.$data["url"].'"><img src="'.$_SERVER["DIR"].'/img/'.$data["img"].'" /><br/>'.engine::lang($data["name"]).'</a></div>';
        }
    }
    $fout .= '</section>
    <div class="clear"></div>
</div>
</div>';
    return $fout;
}

