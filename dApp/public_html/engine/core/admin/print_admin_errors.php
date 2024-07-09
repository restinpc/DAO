<?php
/**
* Print admin errors page.
* @path /engine/core/admin/print_admin_errors.php
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
* @usage <code> engine::print_admin_errors($cms); </code>
*/

function print_admin_errors($cms) {
    $query = 'SELECT `access`.`access` FROM `nodes_access` AS `access` '
            . 'LEFT JOIN `nodes_admin` AS `admin` ON `admin`.`url` = "errors" '
            . 'WHERE `access`.`user_id` = "'.$_SESSION["user"]["id"].'" '
            . 'AND `access`.`admin_id` = `admin`.`id`';
    $admin_res = engine::mysql($query);
    $admin_data = mysqli_fetch_array($admin_res);
    $admin_access = intval($admin_data["access"]);
    if (!$admin_access) {
        engine::error(401);
        return;
    }
    if ($_GET["act"] == "reset") {
        if ($admin_access != 2) {
            engine::error(401);
            return;
        }
        $query = 'TRUNCATE TABLE `nodes_error`';
        engine::mysql($query);
    } else if (!empty($_POST["id"])) {
        if ($admin_access != 2) {
            engine::error(401);
            return;
        }
        $query = 'DELETE FROM `nodes_error` WHERE `id` = "'.intval($_POST["id"]).'"';
        engine::mysql($query);
    }
    if ($_SESSION["order"] == "id") {
        $_SESSION["order"] = "date";
    }
    $arr_count = 0;
    $from = ($_SESSION["page"] - 1) * $_SESSION["count"] + 1;
    $to = ($_SESSION["page"] - 1) * $_SESSION["count"] + $_SESSION["count"];
    $query = 'SELECT * FROM `nodes_error` WHERE `url` NOT LIKE "%/admin%"'
        . ' ORDER BY `'.$_SESSION["order"].'` '.$_SESSION["method"].' LIMIT '.($from-1).', '.$_SESSION["count"];
    $requery = 'SELECT COUNT(*) FROM `nodes_error` WHERE `url` NOT LIKE "%/admin%"';
    $fout = '<div class="document980">';
    $table = '<div class="table">
        <table width=100% id="table" class="mw100p">
        <thead>
        <tr>';
    $array = array(
        "url" => "Link",
        "code" => "Code",
        "ip" => "IP",
        "date" => "Date",
        "lang" => "Language"
    );
    foreach ($array as $order => $value) {
        $table .= '<th>';
        if ($_SESSION["order"] == $order) {
            if ($_SESSION["method"] == "ASC") {
                $table .= '<a id="table-order-'.$order.'" class="link" href="#" onClick=\'$id("order").value = "'.$order.'"; $id("method").value = "DESC"; document.framework.submitSearchForm();\'>'.engine::lang($value).'&nbsp;&uarr;</a>';
            } else {
                $table .= '<a id="table-order-'.$order.'" class="link" href="#" onClick=\'$id("order").value = "'.$order.'"; $id("method").value = "ASC"; document.framework.submitSearchForm();\'>'.engine::lang($value).'&nbsp;&darr;</a>';
            }
        } else {
            $table .= '<a id="table-order-'.$order.'" class="link" href="#" onClick=\'$id("order").value = "'.$order.'"; $id("method").value = "ASC"; document.framework.submitSearchForm();\'>'.engine::lang($value).'</a>';
        }
        $table .= '</th>';
    }
    $table .= '
        <th></th>
        </tr>
        </thead>';
    $res = engine::mysql($query);
    while ($data = mysqli_fetch_array($res)) {
        $arr_count++;
        $url = mb_substr(str_replace($_SERVER["PUBLIC_URL"], "", $data["url"]), 0, 60);
        $table .= '<tr>
            <td id="error-details-'.$arr_count.'" align=left valign=middle onClick=\'document.framework.showLogs("'.$data["id"].'");\' class="pointer">'.$url.'</td>
            <td align=left valign=middle>'.$data["code"].'</td>
            <td align=left valign=middle>'.$data["ip"].'</td>
            <td align=left valign=middle>'.date("d/m/Y H:i", $data["date"]).'</td>
            <td align=left valign=middle>'.$data["lang"].'</td>
            <td width=20 align=left valign=middle>';
        if ($admin_access == 2) {
            $table .= '
                <form method="POST">
                    <input type="hidden" name="id" value="'.$data["id"].'" />
                    <input id="input-delete-'.$arr_count.'" type="submit" value="'.engine::lang("Delete").'" class="btn small" />
                </form>';
        }
        $table .= '
            </td>
        </tr>';
    }
    $table .= '</table>
        </div>
        <br/>';
    if ($arr_count) {
        $fout .= $table.'
        <form method="POST" id="query_form" onSubmit="document.framework.submitSearchForm();">
        <input type="hidden" name="page" id="page_field" value="'.$_SESSION["page"].'" />
        <input type="hidden" name="count" id="count_field" value="'.$_SESSION["count"].'" />
        <input type="hidden" name="order" id="order" value="'.$_SESSION["order"].'" />
        <input type="hidden" name="method" id="method" value="'.$_SESSION["method"].'" />
        <div class="total-entry">';
        $res = engine::mysql($requery);
        $data = mysqli_fetch_array($res);
        $count = $data[0];
        if ($to > $count) {
            $to = $count;
        }
        if ($data[0] > 0) {
            $fout.= '<p class="p5">'.engine::lang("Showing").' '.$from.' '.engine::lang("to").' '.$to.' '.engine::lang("from").' '.$count.' '.engine::lang("entries").', 
                <nobr><select id="select-pagination" class="input" onChange=\'$id("count_field").value = this.value; document.framework.submitSearchForm();\' >
                 <option id="option-pagination-20"'; if ($_SESSION["count"] == "20") { $fout.= ' selected'; } $fout.= '>20</option>
                 <option id="option-pagination-50"'; if ($_SESSION["count"] == "50") { $fout.= ' selected'; } $fout.= '>50</option>
                 <option id="option-pagination-100"'; if ($_SESSION["count"] == "100") { $fout.= ' selected'; } $fout.= '>100</option>
                </select> '.engine::lang("per page").'.</nobr></p>';
        }
        $fout .= '
        </div><div class="cr"></div>';
        if ($count > $_SESSION["count"]) {
            $fout .= '<div class="pagination" >';
            $pages = ceil($count / $_SESSION["count"]);
            if ($_SESSION["page"] > 1) {
                $fout .= '<span id="page-prev" onClick=\'document.framework.goto_page('.($_SESSION["page"] - 1).');\'><a hreflang="'.$_SESSION["Lang"].'" href="#">'.engine::lang("Previous").'</a></span>';
            }
            $fout .= '<ul>';
            $a = $b = $c = $d = $e = $f = 0;
            for ($i = 1; $i <= $pages; $i++) {
                if (($a < 2 && !$b && $e < 2)
                    || ($i >= ($_SESSION["page"] - 2) && $i <= ($_SESSION["page"] + 2) && $e < 5)
                    || ($i > $pages - 2 && $e < 2)
                ) {
                    if ($a < 2) {
                        $a++;
                    }
                    $e++;
                    $f = 0;
                    if ($i == $_SESSION["page"]) {
                        $b = 1;
                        $e = 0;
                        $fout .= '<li class="active-page">'.$i.'</li>';
                    } else {
                        $fout .= '<li id="page-'.$i.'" onClick=\'document.framework.goto_page('.($i).');\'><a hreflang="'.$_SESSION["Lang"].'" href="#">'.$i.'</a></li>';
                    }
                } else if ((!$c || !$b) && !$f && $i < $pages) {
                    $f = 1;
                    $e = 0;
                    if (!$b) {
                        $b = 1;
                    } else if (!$c) { 
                        $c = 1;
                    }
                    $fout .= '<li class="dots">. . .</li>';
                }
            }
            if ($_SESSION["page"] < $pages) {
                $fout .= '<li id="page-next" class="next" onClick=\'document.framework.goto_page('.($_SESSION["page"] + 1).');\'><a hreflang="'.$_SESSION["Lang"].'" href="#">'.engine::lang("Next").'</a></li>';
            }
            $fout .= '
            </ul>
           </div>';
        }
        $fout .= '<div class="clear"></div><br/>';
        if ($admin_access == 2) {
            $fout .= '<a id="clear-logs" href="'.$_SERVER["DIR"].'/admin/?mode=errors&act=reset"><input type="button" class="btn w280" value="'.engine::lang("Clear logs").'" /></a><br/>';
        }
        $fout .= '
        </form>
        </div>';
    } else {
        $fout = '<div class="clear_block">'.engine::lang("Errors not found").'</div>';
    }
    return $fout;
}

