<?php
/**
* Print admin attendance page.
* @path /engine/core/admin/print_admin_attendance.php
* 
* @name    DAO Mansion    @version 1.0.3
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
* @usage <code> engine::print_admin_attendance($cms); </code>
*/

function print_admin_attendance($cms) {
    $query = 'SELECT `access`.`access` FROM `nodes_access` AS `access` '
        . 'LEFT JOIN `nodes_admin` AS `admin` ON `admin`.`url` = "attendance" '
        . 'WHERE `access`.`user_id` = "'.$_SESSION["user"]["id"].'" '
        . 'AND `access`.`admin_id` = `admin`.`id`';
    $admin_res = engine::mysql($query);
    $admin_data = mysqli_fetch_array($admin_res);
    $admin_access = intval($admin_data["access"]);
    if (!$admin_access) {
        engine::error(401);
        return;
    }
    if ($_GET["action"] == "stat" || empty($_GET["action"])) {
        $stat = '<b>'.engine::lang("Statistic").'</b>';
        $pages = '<a id="attendance-pages" href="'.$_SERVER["DIR"].'/admin?mode=attendance&action=pages&interval='.$_GET["interval"].'&date='.$_GET["date"].'">'.engine::lang("Pages").'</a>';
        $users = '<a id="attendance-users" href="'.$_SERVER["DIR"].'/admin?mode=attendance&action=users&interval='.$_GET["interval"].'&date='.$_GET["date"].'">'.engine::lang("Users").'</a>';
    } else if($_GET["action"] == "pages") {
        $stat = '<a id="attendance-statistic" href="'.$_SERVER["DIR"].'/admin?mode=attendance&action=stat&interval='.$_GET["interval"].'&date='.$_GET["date"].'">'.engine::lang("Statistic").'</a>';
        $pages = '<b>'.engine::lang("Pages").'</b>';
        $users = '<a id="attendance-users" href="'.$_SERVER["DIR"].'/admin?mode=attendance&action=users&interval='.$_GET["interval"].'&date='.$_GET["date"].'">'.engine::lang("Users").'</a>';
    } else if($_GET["action"] == "users") {
        $stat = '<a id="attendance-statistic" href="'.$_SERVER["DIR"].'/admin?mode=attendance&action=stat&interval='.$_GET["interval"].'&date='.$_GET["date"].'">'.engine::lang("Statistic").'</a>';
        $pages = '<a id="attendance-pages" href="'.$_SERVER["DIR"].'/admin?mode=attendance&action=pages&interval='.$_GET["interval"].'&date='.$_GET["date"].'">'.engine::lang("Pages").'</a>';
        $referrers = '<a id="attendance-referrers" href="'.$_SERVER["DIR"].'/admin?mode=attendance&action=ref&interval='.$_GET["interval"].'&date='.$_GET["date"].'">'.engine::lang("Referrers").'</a>';
        $users = '<b>'.engine::lang("Users").'</b>';
    }
    $from = '';
    $to = '';
    if ($_GET["interval"] == "day" || empty($_GET["interval"])) {
        $by_hour = '<a id="by-hours" href="'.$_SERVER["DIR"].'/admin?mode=perfomance&action='.$_GET["action"].'&interval=hour&date='.$_GET["date"].'">'.engine::lang("By hours").'</a>';
        $by_day = '<b>'.engine::lang("By days").'</b>';
        $by_week = '<a id="by-weeks" href="'.$_SERVER["DIR"].'/admin?mode=perfomance&action='.$_GET["action"].'&interval=week&date='.$_GET["date"].'">'.engine::lang("By weeks").'</a>';
        $by_month = '<a id="by-months" href="'.$_SERVER["DIR"].'/admin?mode=perfomance&action='.$_GET["action"].'&interval=month&date='.$_GET["date"].'">'.engine::lang("By months").'</a>';
        if (empty($_GET["date"])) {
            $from = strtotime(date('Y-m-d')." 00:00:00");
            $to = strtotime(date('Y-m-d')." 23:59:59");
            $timeStamp = strtotime(date('Y-m-d')." 00:00:00 - 1 days");
            $date1 = date('d/m/Y', $timeStamp);
            $url_date1 = date("Y-m-d", $timeStamp);
            $prev = '<a id="date-'.$url_date1.'" href="'.$_SERVER["DIR"].'/admin?mode=perfomance&action='.$_GET["action"].'&interval=day&date='.$url_date1.'">&laquo; '.$date1.'</a>';
            $now = '<b>'.date("d/m/Y").'</b>';
            $next = '&nbsp;';
        } else {
            $from = strtotime($_GET["date"]." 00:00:00");
            $to = strtotime($_GET["date"]." 23:59:59");
            $timeStamp = strtotime($_GET["date"]." 00:00:00 - 1 days");
            $date1 = date('d/m/Y', $timeStamp);
            $url_date1 = date("Y-m-d", $timeStamp);
            $timeStamp = strtotime($_GET["date"]." 00:00:00 + 1 days");
            $date2 = date('d/m/Y', $timeStamp);
            $url_date2 = date("Y-m-d", $timeStamp);
            $prev = '<a id="date-'.$url_date1.'" href="'.$_SERVER["DIR"].'/admin?mode=perfomance&action='.$_GET["action"].'&interval=day&date='.$url_date1.'">&laquo; '.$date1.'</a>';
            $now = '<b>'.date("d/m/Y", strtotime($_GET["date"])).'</b>';
            if (strtotime($url_date2) <= strtotime(date("Y-m-d"))) {
                $next = '<a id="date-'.$url_date2.'" href="'.$_SERVER["DIR"].'/admin?mode=perfomance&action='.$_GET["action"].'&interval=day&date='.$url_date2.'">'.$date2.' &raquo;</a>';
            } else {
                $next = '&nbsp;';
            }
        }
    } else if ($_GET["interval"] == "week") {
        $by_hour = '<a id="by-hours" href="'.$_SERVER["DIR"].'/admin?mode=perfomance&action='.$_GET["action"].'&interval=hour&date='.$_GET["date"].'">'.engine::lang("By hours").'</a>';
        $by_day = '<a id="by-days" href="'.$_SERVER["DIR"].'/admin?mode=perfomance&action='.$_GET["action"].'&interval=day&date='.$_GET["date"].'">'.engine::lang("By days").'</a>';
        $by_week = '<b>'.engine::lang("By weeks").'</b>';
        $by_month = '<a id="by-months" href="'.$_SERVER["DIR"].'/admin?mode=perfomance&action='.$_GET["action"].'&interval=month&date='.$_GET["date"].'">'.engine::lang("By months").'</a>';
        $prev = ' - 7 days';
        $prev2 = ' - 14 days';
        $next = ' + 0 days';
        $next2 = ' + 7 days';
        if (empty($_GET["date"])) {
            $from = strtotime(date('Y-m-d')." 23:59:59 - 7 days");
            $to = date("U");
            $timeStamp = strtotime(date('Y-m-d')." 00:00:00".$prev);
            $date1 = date('d.m', $timeStamp);
            $link_date1 = date('Y-m-d', $timeStamp);
            $timeStamp = strtotime(date('Y-m-d')." 00:00:00".$prev2);
            $date11 = date('d.m', $timeStamp);
            $prev = '<a id="date-'.$link_date1.'" href="'.$_SERVER["DIR"].'/admin?mode=perfomance&action='.$_GET["action"].'&interval=week&date='.$link_date1.'">&laquo; '.$date11.' - '.$date1.'</a>';
            $now = '<b>'.$date1.' - '.date("d.m").'</b>';
            $next = '&nbsp;';
        } else {
            $from = strtotime($_GET["date"]." 23:59:59 - 7 days");
            $to = strtotime($_GET["date"]." 23:59:59");
            $date = date('d.m', strtotime($_GET["date"]));
            $timeStamp = strtotime($_GET["date"]."00:00:00".$prev);
            $date1 = date('d.m', $timeStamp);
            $link_date1 = date('Y-m-d', $timeStamp);
            $timeStamp = strtotime($_GET["date"]."00:00:00".$prev2);
            $date11 = date('d.m', $timeStamp);
            $timeStamp = strtotime($_GET["date"]."00:00:00".$next);
            $date2 = date('d.m', $timeStamp);
            $timeStamp = strtotime($_GET["date"]."00:00:00".$next2);
            $date22 = date('d.m', $timeStamp);
            $link_date2 = date('Y-m-d', $timeStamp);
            $prev = '<a id="date-'.$link_date1.'" href="'.$_SERVER["DIR"].'/admin?mode=perfomance&action='.$_GET["action"].'&interval=week&date='.$link_date1.'">&laquo; '.$date11.' - '.$date1.'</a>';
            $now = '<b>'.$date1.' - '.$date.'</b>';
            if (strtotime($_GET["date"]."00:00:00".$next2) <= strtotime(date("Y-m-d"))) {
                $next = '<a id="date-'.$link_date2.'" href="'.$_SERVER["DIR"].'/admin?mode=perfomance&action='.$_GET["action"].'&interval=week&date='.$link_date2.'">'.$date2.' - '.$date22.' &raquo;</a>';
            } else {
                $next = '&nbsp;';
            }
        }
    } else if ($_GET["interval"] == "month") {
        $by_hour = '<a id="by-hours" href="'.$_SERVER["DIR"].'/admin?mode=perfomance&action='.$_GET["action"].'&interval=hour&date='.$_GET["date"].'">'.engine::lang("By hours").'</a>';
        $by_day = '<a id="by-days" href="'.$_SERVER["DIR"].'/admin?mode=perfomance&action='.$_GET["action"].'&interval=day&date='.$_GET["date"].'">'.engine::lang("By days").'</a>';
        $by_week = '<a id="by-weeks" href="'.$_SERVER["DIR"].'/admin?mode=perfomance&action='.$_GET["action"].'&interval=week&date='.$_GET["date"].'">'.engine::lang("By weeks").'</a>';
        $by_month = '<b>'.engine::lang("By months").'</b>';
        $prev = ' - 1 month';
        $prev2 = ' - 2 month';
        $next = ' + 0 month';
        $next2 = ' + 1 month';
        if (empty($_GET["date"])) {
            $from = strtotime(date('Y-m-d')." 23:59:59 - 1 month");
            $to = date("U");
            $timeStamp = strtotime(date('Y-m-d')."00:00:00".$prev);
            $date1 = date('m.Y', $timeStamp);
            $link_date1 = date('Y-m-d', $timeStamp);
            $timeStamp = strtotime(date('Y-m-d')."00:00:00".$prev2);
            $date11 = date('m.Y', $timeStamp);
            $prev = '<a id="date-'.$link_date1.'" href="'.$_SERVER["DIR"].'/admin?mode=perfomance&action='.$_GET["action"].'&interval=month&date='.$link_date1.'">&laquo; '.$date11.' - '.$date1.'</a>';
            $now = '<b>'.$date1.' - '.date("m.Y").'</b>';
            $next = '&nbsp;';
        } else {
            $from = strtotime($_GET["date"]." 23:59:59 - 1 month");
            $to = strtotime($_GET["date"]." 23:59:59");
            $date = date('m.Y', strtotime($_GET["date"]));
            $timeStamp = strtotime($_GET["date"]."00:00:00".$prev);
            $date1 = date('m.Y', $timeStamp);
            $link_date1 = date('Y-m-d', $timeStamp);
            $timeStamp = strtotime($_GET["date"]."00:00:00".$prev2);
            $date11 = date('m.Y', $timeStamp);
            $timeStamp = strtotime($_GET["date"]."00:00:00".$next);
            $date2 = date('m.Y', $timeStamp);
            $timeStamp = strtotime($_GET["date"]."00:00:00".$next2);
            $date22 = date('m.Y', $timeStamp);
            $link_date2 = date('Y-m-d', $timeStamp);
            $prev = '<a id="date-'.$link_date1.'" href="'.$_SERVER["DIR"].'/admin?mode=perfomance&action='.$_GET["action"].'&interval=month&date='.$link_date1.'">&laquo; '.$date11.' - '.$date1.'</a>';
            $now = '<b>'.$date1.' - '.$date.'</b>';
            if (strtotime($_GET["date"]."00:00:00".$next2) <= strtotime(date("Y-m-d"))) {
                $next = '<a id="date-'.$link_date2.'" href="'.$_SERVER["DIR"].'/admin?mode=perfomance&action='.$_GET["action"].'&interval=month&date='.$link_date2.'">'.$date2.' - '.$date22.' &raquo;</a>';
            } else {
                $next = '&nbsp;';
            }
        }
    }
    $fout = '<div class="statistic">
        <div class="statistic_head">
            <table>
            <tr>
                <td align=center>'.$stat.'</td> 
                <td align=center>'.$pages.'</td>
                <td align=center>'.$users.'</td>  
            </tr>
            </table>
        </div>
        <div class="statistic_date">
            <table>
            <tr>
                <td align=center>'.$by_day.'</td>
                <td align=center>'.$by_week.'</td>
                <td align=center>'.$by_month.'</td>
            </tr>
            </table>
        </div>
        <div class="clear"></div>
        <table class="statistic_nav">
        <tr>
            <td align=center>'.$prev.'</td>
            <td align=center>'.$now.'</td>
            <td align=center>'.$next.'</td>
        </tr>
        </table><br/>';
    if ($_GET["action"] == "stat" || empty($_GET["action"])) {
        $query = 'SELECT COUNT(DISTINCT `token`, `ip`) as `a`, COUNT(`id`) as `b` FROM `nodes_attendance` WHERE `date` >= "'.$from.'" AND `date` <= "'.$to.'" AND `display` = "1"';
        $res = engine::mysql($query);
        $data = mysqli_fetch_array($res);
        $views = $data['b'];
        $visit = $data['a'];
        $fout .= '<center class="lh2"><span class="statistic_span">'.engine::lang("Visitors").": ".$visit.'</span> / ';
        $fout .= '<span class="statistic_span"  style="color: rgb(20,180,180);">'.engine::lang("Views").": ".$views.'</span> ';
        $fout .= '<img width=100% class="w600" src="'.$_SERVER["DIR"].'/attendance.php?interval='.((!empty($_GET["interval"])) ? $_GET["interval"] : "day").'&date='.$_GET["date"].'&rand='.rand(0, 100).'" /></center>';
    } else if($_GET["action"] == "pages") {
        $query = 'SELECT a.id, a.token, cache.url FROM nodes_attendance as a '
            . 'LEFT JOIN `nodes_cache` AS `cache` ON cache.id = a.`cache_id` '
            . 'WHERE a.date >= "'.$from.'" AND a.date <= "'.$to.'" AND a.display = "1"';
        $res = engine::mysql($query);
        $pages = array();
        while($data = mysqli_fetch_array($res)) {
            if ($data["url"]) {
                if (!$pages[$data["url"]]) {
                    $pages[$data["url"]] = array();
                }
                if (!$pages[$data["url"]][$data["token"]]) {
                    $pages[$data["url"]][$data["token"]] = 1;
                } else {
                    $pages[$data["url"]][$data["token"]]++;
                }
            }
        }
        $visitors = array();
        $views = array();
        foreach ($pages as $page => $data) {
            $visitors[$page] = count($data);
            $v = 0;
            foreach($data as $d) {
                $v += $d;
            }
            $views[$page] = $v;
        }
        asort($visitors);
        $visitors = array_reverse($visitors);
        $fout .= '<div class="table">
            <table width=100% id="table">
            <thead>
            <tr>
                <th>URL</th>
                <th>'.engine::lang("Visitors").'</th>
                <th>'.engine::lang("Views").'</th>
            </tr>';
        $table = '';
        foreach ($visitors as $page => $data) {
            $table .= '<tr><td align=left><a id="p-'.$page.'" href="'.$page.'" target="_blank">'.$page.'</a></td>
                    <td>'.$data.'</td>
                    <td>'.$views[$page].'</td>
                </tr>';
        }
        $fout .= $table.'</table></div>';
    } else if ($_GET["action"] == "users") {
        $tokens = array();
        $query = 'SELECT * FROM `nodes_attendance` WHERE `date` >= "'.$from.'" AND `date` <= "'.$to.'" AND `display` = "1" ORDER BY `date` ASC';
        $res = engine::mysql($query);
        $fout .= '<div class="table">
            <table width=100% id="table">
            <thead>
            <tr>
                <th>'.engine::lang("Date").'</th>
                <th>'.engine::lang("Referrer").'</th>
                <th>'.engine::lang("User").'</th>
                <th>'.engine::lang("Pages").'</th>
            </tr>';
        while ($data = mysqli_fetch_array($res)) {
            if (!in_array($data["token"], $tokens)) {
                $query = 'SELECT COUNT(*) FROM `nodes_attendance` WHERE `token` = "'.$data["token"].'"';
                $rr = engine::mysql($query);
                $dd = mysqli_fetch_array($rr);
                array_push($tokens, $data["token"]);
                $query = 'SELECT * FROM `nodes_attendance` WHERE `token` = "'.$data["token"].'" AND `user_id` <> 0';
                $kr = engine::mysql($query);
                $kd = mysqli_fetch_array($kr);
                if (empty($kd)) { 
                    $user_name = "Anonim";
                } else {
                    $query = 'SELECT * FROM `nodes_user` WHERE `id` = "'.$kd["user_id"].'"';
                    $dr = engine::mysql($query);
                    $user = mysqli_fetch_array($dr);
                    $user_name = $user["name"];
                }
                $query = 'SELECT `ref_id` FROM `nodes_attendance` WHERE `token` = "'.$data["token"].'" AND `ref_id` != 0';
                $ref = engine::mysql($query);
                $dref = mysqli_fetch_array($ref);
                if ($dref) {
                    $query = 'SELECT * FROM `nodes_referrer` WHERE `id` = "'.$dref["ref_id"].'"';
                    $ddref = engine::mysql($query);
                    $ref_data = mysqli_fetch_array($ddref);
                    $url = parse_url($ref_data["name"]);
                    $link = '<a id="ref-'.$dref["id"].'" href="'.$ref_data["name"].'" target="_blank">'.$url["host"].'</a>';
                } else {
                    $link = "Blank";
                }
                $fout .= '<tr style="text-align:left;">
                    <td>'.date("Y-m-d H:i:s", $data["date"]).'</td>
                    <td>'.$link.'</td>
                    <td>'.$user_name.'</td>
                    <td>'.$dd[0].'</td>
                </tr>';
            }
        }
        $fout .= '</table></div>';
    }
    $fout .= '</div><br/>';
    return $fout;
}