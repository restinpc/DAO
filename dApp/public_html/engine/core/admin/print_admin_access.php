<?php
/**
* Print admin access page.
* @path /engine/core/admin/print_admin_access.php
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
* @usage <code> engine::print_admin_access($cms); </code>
*/

function print_admin_access($cms) {
    $query = 'SELECT `access`.`access` FROM `nodes_access` AS `access` '
            . 'LEFT JOIN `nodes_admin` AS `admin` ON `admin`.`url` = "access" '
            . 'WHERE `access`.`user_id` = "'.$_SESSION["user"]["id"].'" '
            . 'AND `access`.`admin_id` = `admin`.`id`';
    $admin_res = engine::mysql($query);
    $admin_data = mysqli_fetch_array($admin_res);
    $admin_access = intval($admin_data["access"]);
    if (!$admin_access) {
        engine::error(401);
        return;
    }
    if (!empty($_GET["user_id"])) {
        $user_id = intval($_GET["user_id"]);
        $query = 'SELECT * FROM `nodes_user` WHERE `id` = "'.$user_id.'"';
        $res = engine::mysql($query);
        $user = mysqli_fetch_array($res);
        if ($user["id"] == $_SESSION["user"]["id"]) {
            engine::error(401);
            return;
        }
        if (empty($user) || $user["id"] == 1) {
            engine::error(401);
            return;
        }
        if (!empty($_POST["flag"])) {
            if ($admin_access != 2) {
                engine::error(401);
                return;
            }
            $query = 'SELECT * FROM `nodes_admin`';
            $res = engine::mysql($query);
            while ($data = mysqli_fetch_array($res)) {
                if (isset($_POST["permission_".$data["id"]])) {
                    $access = $_POST["permission_".$data["id"]];
                    $id = $data["id"];
                    $query = 'SELECT * FROM `nodes_access` WHERE `user_id` = "'.$user["id"].'" AND `admin_id` = "'.$id.'"';
                    $r = engine::mysql($query);
                    $d = mysqli_fetch_array($r);
                    if (!empty($d)) {
                        $query = 'UPDATE `nodes_access` SET `access` = "'.$access.'" WHERE `id` = "'.$d["id"].'"';
                        engine::mysql($query);
                    } else {
                        $query = 'INSERT INTO `nodes_access`(admin_id, user_id, access) VALUES("'.$id.'", "'.$user["id"].'", "'.$access.'")';
                        engine::mysql($query);
                    }
                }
            }
            $query = 'SELECT * FROM `nodes_access` WHERE `user_id` = "'.$user["id"].'" AND `access` > 0';
            $res = engine::mysql($query);
            $data = mysqli_fetch_array($res);
            if (!empty($data)) {
                $flag = 1;
            } else {
                $flag = 0;
            }
            $query = 'UPDATE `nodes_user` SET `admin` = "'.$flag.'" WHERE `id` = "'.$user["id"].'"';
            engine::mysql($query);
        }
        $fout = '<div class="document640"><br/>
            '.engine::lang("Manage permission of").' <b>'.$user["name"].'</b> [<a href="mailto:'.$user["email"].'">'.$user["email"].'</a>]<br/>
            <br/>
            <form method="POST">
            <input type="hidden" name="flag" value="1" />
            <div class="table">
            <table width=100% id="table">';
        $query = 'SELECT * FROM `nodes_admin`';
        $res = engine::mysql($query);
        while ($data = mysqli_fetch_array($res)) {
            $query = 'SELECT `access`.`access` FROM `nodes_access` AS `access` '
                    . 'LEFT JOIN `nodes_admin` AS `admin` ON `admin`.`url` = "'.$data["url"].'" '
                    . 'WHERE `access`.`user_id` = "'.$_SESSION["user"]["id"].'" '
                    . 'AND `access`.`admin_id` = `admin`.`id`';
            $section_res = engine::mysql($query);
            $section_data = mysqli_fetch_array($section_res);
            $section_access = intval($section_data["access"]);
            $query = 'SELECT * FROM `nodes_access` WHERE `user_id` = "'.$user["id"].'" AND `admin_id` = "'.$data["id"].'"';
            $r = engine::mysql($query);
            $d = mysqli_fetch_array($r);
            $access = intval($d["access"]);
            if ($section_access >= $access && $section_access != 0) {
                $fout .= '<tr>
                    <td align=left>'.engine::lang($data["name"]).'</td>
                    <td>
                        <select id="select-permission" name="permission_'.$data["id"].'" class="input w280">
                            <option id="option-no-access" value="0" '.($access== 0?'selected':'').'>'.engine::lang("No access").'</option>
                            <option id="option-read-only" value="1" '.($access== 1?'selected':'').'>'.engine::lang("Read-only").'</option>';
                if ($section_access == 2) {
                    $fout .= '<option id="option-full-access" value="2" '.($access==2?'selected':'').'>'.engine::lang("Full access").'</option>';
                }
                $fout .= '</select>
                    </td>
                </tr>';
            }
        }
        $fout .= '</table>
            </div>
            <br/>
            <input id="input-save-changes" type="submit" value="'.engine::lang("Save changes").'" class="btn w280" /><br/>
            <a id="back-to-access" href="'.$_SERVER["DIR"].'/admin/?mode=access">
                <input type="button" class="btn w280" value="'.engine::lang("Back to access").'" />
            </a>
            </form>
        </div>';
    } else {
        if (!empty($_POST["delete"])) {
            if ($admin_access != 2) {
                engine::error(401);
                return;
            }
            $query = 'SELECT * FROM `nodes_user` WHERE `id` = "'.intval($_POST["delete"]).'"';
            $res = engine::mysql($query);
            $user = mysqli_fetch_array($res);
            if ($user["id"] == $_SESSION["user"]["id"]) {
                engine::error(401);
                return;
            }
            if (empty($user) || $user["id"] == 1) {
                engine::error(401);
                return;
            }
            $query = 'DELETE FROM `nodes_access` WHERE `user_id` = "'.$user["id"].'"';
            engine::mysql($query);
            $query = 'UPDATE `nodes_user` SET `admin` = 0 WHERE `id` = "'.$user["id"].'"';
            engine::mysql($query);
        }
        $fout = '<div class="document640">';
        if ($_SESSION["order"] == "id") {
            $_SESSION["order"] = "name";
        }
        $arr_count = 0;
        $from = ($_SESSION["page"] - 1) * $_SESSION["count"] + 1;
        $to = ($_SESSION["page"] - 1) * $_SESSION["count"] + $_SESSION["count"];
        $query = 'SELECT `user`.* FROM `nodes_access` AS `access` '
                . 'LEFT JOIN `nodes_user` AS `user` ON `user`.`id` = `access`.`user_id` '
                . 'GROUP BY `user`.`id` '
                . 'ORDER BY `user`.`'.$_SESSION["order"].'` '.$_SESSION["method"].' '
                . 'LIMIT '.($from-1).', '.$_SESSION["count"];
        $requery = 'SELECT COUNT(DISTINCT(`user`.`id`)) FROM `nodes_access` AS `access` '
                . 'LEFT JOIN `nodes_user` AS `user` ON `user`.`id` = `access`.`user_id` ';
        $table = '
            <div class="table">
            <table width=100% id="table">
            <thead>
            <tr>';
                $array = array(
                    "name" => "Name",
                    "email" => "Email",
                    "online" => "Last visit"
                );
                foreach ($array as $order => $value) {
                    $table .= '<th>';
                    if ($_SESSION["order"] == $order) {
                        if ($_SESSION["method"] == "ASC") {
                            $table .= '<a id="table-order-'.$order.'" class="link" href="#" onClick=\'$id("order").value = "'.$order.'"; $id("method").value = "DESC"; document.framework.submit_search_form();\'>'.engine::lang($value).'&nbsp;&uarr;</a>';
                        } else {
                            $table .= '<a id="table-order-'.$order.'" class="link" href="#" onClick=\'$id("order").value = "'.$order.'"; $id("method").value = "ASC"; document.framework.submit_search_form();\'>'.engine::lang($value).'&nbsp;&darr;</a>';
                        }
                    } else {
                        $table .= '<a id="table-order-'.$order.'" class="link" href="#" onClick=\'$id("order").value = "'.$order.'"; $id("method").value = "ASC"; document.framework.submit_search_form();\'>'.engine::lang($value).'</a>';
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
            if ($data["online"] > date("U") - 600) {
                $online = '<center>'.engine::lang("Online").'</center>';
            } else {
                $online = date("d/m/Y", $data["online"]);
            }
            if ($data["id"] != 1 && $admin_access == 2) {
                if ($data["id"] != $_SESSION["user"]["id"]) {
                    $select = '<select id="select-action-'.$arr_count.'" class="input" onChange=\'if (confirm("'.engine::lang("Are you sure?").'")) {
                        if (this.value == "1") {
                            window.location="'.$_SERVER["DIR"].'/admin/?mode=access&user_id='.$data["id"].'";
                        } else if (this.value == "2") {
                            $id("delete_id").value = "'.$data["id"].'";
                            $id("query_form").submit();
                        } else {
                            this.selectedIndex=0;
                        } 
                    }\'>'
                    . '<option id="option-action-0" value="0">'.engine::lang("Select an action").'</option>'
                    . '<option id="option-action-1" value="1">'.engine::lang("Edit permission").'</option>'
                    . '<option id="option-action-2" value="2">'.engine::lang("Delete from admin").'</option>'
                    . '</select>';
                } else {
                    $select = "";
                }
            } else {
                if ($data["id"] == "1") {
                    $select = "<b>".engine::lang('Primary admin')."</b>";
                } else {
                    $select = "";
                }
            }
            if ($data["confirm"]) {
                $flag = '<input type="checkbox" checked disabled />';
            } else {
                $flag = '<input id="input-checkbox-'.$data["id"].'" type="checkbox" title="'.engine::lang("Code").': '.$data["code"].'" '
                    . 'onClick=\''
                        . '$id("confirm_value").value = "'.$data["id"].'"; '
                        . '$id("confirm_form").submit();'
                    . '\'/>';
            }
            $table .= '<tr><td align=left class="nowrap">'.$flag.'&nbsp;<a id="link-user-'.$data["id"].'" href="'.$_SERVER["DIR"].'/account/inbox/'.$data["id"].'">'.$data["name"].'</a></td>'
                    . '<td align=left><a href="mailto:'.$data["email"].'">'.$data["email"].'</a></td>'
                    . '<td align=left>'.$online.'</td>'
                    . '<td width=45 align=left>'.$select.'</td></tr>';
        }
        $table .= '</table>
    </div>
    <br/>';
        if ($arr_count) {
            $fout .= $table.'
        <form method="POST" id="query_form"  onSubmit="document.framework.submit_search_form();">
        <input type="hidden" name="page" id="page_field" value="'.$_SESSION["page"].'" />
        <input type="hidden" name="count" id="count_field" value="'.$_SESSION["count"].'" />
        <input type="hidden" name="order" id="order" value="'.$_SESSION["order"].'" />
        <input type="hidden" name="method" id="method" value="'.$_SESSION["method"].'" />
        <input type="hidden" name="reset" id="query_reset" value="0" />
        <input type="hidden" name="delete" id="delete_id" value="0" />
        <div class="total-entry">';
        $res = engine::mysql($requery);
        $data = mysqli_fetch_array($res);
        $count = $data[0];
        if ($to > $count) {
            $to = $count;
        }
        if ($data[0] > 0) {
            $fout.= '<p class="p5">'.engine::lang("Showing").' '.$from.' '.engine::lang("to").' '.$to.' '.engine::lang("from").' '.$count.' '.engine::lang("entries").', 
                <nobr><select id="select-pagination" class="input" onChange=\'$id("count_field").value = this.value; document.framework.submit_search_form();\' >
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
                    $fout .= '<span id="previous_page" onClick=\'document.framework.goto_page('.($_SESSION["page"] - 1).');\'><a hreflang="'.$_SESSION["Lang"].'" href="#">'.engine::lang("Previous").'</a></span>';
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
                    $fout .= '<li id="next-page" class="next" onClick=\'document.framework.goto_page('.($_SESSION["page"] + 1).');\'><a hreflang="'.$_SESSION["Lang"].'" href="#">'.engine::lang("Next").'</a></li>';
                }
                $fout .= '
            </ul>
            </div>';
        }
        $fout .= '</form>
                <div class="clear"></div>
                </div>';
        } else {
            $fout = '<div class="clear_block">'.engine::lang("Administrators not found").'</div>';
        }
        if ($admin_access == 2) {
            $fout .= '
                <input id="input-add-admin" type="button" class="btn w280" value="'.engine::lang("Add new admin").'" onClick=\'this.style.display="none"; jQuery("#new_admin").removeClass("hidden");\' />
                <div class="document320 hidden" id="new_admin">
                <select  class="input w280" id="admin_id">';
            $query = 'SELECT * FROM `nodes_user` WHERE `ban` = 0 AND `admin` = 0';
            $res = engine::mysql($query);
            while ($user = mysqli_fetch_array($res)) {
                $fout .= '<option value="'.$user["id"].'">'.$user["name"].' ['.$user["email"].']</option>';
            }
            $fout .= '
                </select><br/>
                <input id="input-submit" type="button" class="btn w280" value="'.engine::lang("Submit").'" onClick=\'window.location = "'.$_SERVER["DIR"].'/admin/?mode=access&user_id="+ $id("admin_id").value\' />
            </div>';
        }
    }
    return $fout;
}

