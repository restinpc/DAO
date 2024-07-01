<?php
/**
* Print admin panoramas page.
* @path /engine/core/admin/print_admin_panoramas.php
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
* @usage <code> engine::print_admin_panoramas($cms); </code>
*/

function print_admin_panoramas($cms) {
    $arr_count = 0;
    $from = ($_SESSION["page"] - 1) * $_SESSION["count"] + 1;
    $to = ($_SESSION["page"] - 1) * $_SESSION["count"] + $_SESSION["count"];
    $fout .= '<div class="document980">';
    if (empty($_GET["project_id"])) {
        if (!empty($_POST) && $_POST["action"] == "add_project") {
            $name = trim(htmlspecialchars($_POST["name"]));
            $text = trim(engine::escape_string($_POST["text"]));
            $url = trim(htmlspecialchars($_POST["url"]));
            $query = 'INSERT INTO `nodes_vr_project`(`name`, `url`, `text`) VALUES("'.$name.'", "'.$url.'", "'.$text.'")';
            engine::mysql($query);
        } else if (!empty($_POST) && $_POST["action"] == "delete" && !empty($_POST["id"])) {
            $id = intval($_POST["id"]);
            $query = 'DELETE FROM `nodes_vr_scene` WHERE `project_id` = "'.$id.'"';
            engine::mysql($query);
            $query = 'DELETE FROM `nodes_vr_level` WHERE `project_id` = "'.$id.'"';
            engine::mysql($query);
            $query = 'DELETE FROM `nodes_vr_object` WHERE `project_id` = "'.$id.'"';
            engine::mysql($query);
            $query = 'DELETE FROM `nodes_vr_project` WHERE `id` = "'.$id.'"';
            engine::mysql($query);
        }
        $query = 'SELECT * FROM `nodes_vr_project` ORDER BY `id` DESC LIMIT '.($from-1).', '.$_SESSION["count"];
        $requery = 'SELECT COUNT(*) FROM `nodes_vr_project`';
        $fout .= '<h1>'.engine::lang("Panoramas").'</h1>';
        $table = '
            <form method="POST" id="act-form">
                <input type="hidden" id="act-id" name="id" value="" />
                <input type="hidden" id="act-val" name="action" value="" />
            </form>
            <div class="table">
            <table id="table" class="w100p" style="max-width:700px;">
            <thead>
            <tr>
                <th>'.engine::lang("Project Name").'</th>
                <th>'.engine::lang("Levels").'</th>
                <th>'.engine::lang("Scenes").'</th>
                <th>'.engine::lang("Objects").'</th>
                <th>'.engine::lang("Portals").'</th>
                <th>'.engine::lang("Links").'</th>
                <th></th>
            </tr>
            </thead>';
        $res = engine::mysql($query);
        while ($data = mysqli_fetch_array($res)) {
            $query = 'SELECT COUNT(`id`) FROM `nodes_vr_level` WHERE `project_id` = "'.$data["id"].'"';
            $r = engine::mysql($query);
            $d = mysqli_fetch_array($r);
            $levels = $d[0];
            $query = 'SELECT COUNT(`id`) FROM `nodes_vr_scene` WHERE `project_id` = "'.$data["id"].'"';
            $r = engine::mysql($query);
            $d = mysqli_fetch_array($r);
            $scenes = $d[0];
            $query = 'SELECT COUNT(`id`) FROM `nodes_vr_object` WHERE `project_id` = "'.$data["id"].'"';
            $r = engine::mysql($query);
            $d = mysqli_fetch_array($r);
            $objects = $d[0];
            $query = 'SELECT COUNT(`id`) FROM `nodes_vr_navigation` WHERE `project_id` = "'.$data["id"].'"';
            $r = engine::mysql($query);
            $d = mysqli_fetch_array($r);
            $points = $d[0];
            $query = 'SELECT COUNT(`id`) FROM `nodes_vr_link` WHERE `project_id` = "'.$data["id"].'"';
            $r = engine::mysql($query);
            $d = mysqli_fetch_array($r);
            $links = $d[0];
            $arr_count++;
            $table .= '<tr><td align=left>'.$data["name"].'</td>
                <td align=left>'.$levels.'</td>
                <td align=left>'.$scenes.'</td>
                <td align=left>'.$objects.'</td>
                <td align=left>'.$points.'</td>
                <td align=left>'.$links.'</td>
                <td align=left>
                    <a class="btn small" href="'.$_SERVER["DIR"].'/admin/?mode=panoramas&project_id='.$data["id"].'">Project details</a>
                    <input type="button" class="btn small" value="'.engine::lang("Delete").'" onClick=\'
                        if (confirm("'.engine::lang("Are you sure you want to delete a project with all levels, scenes and custom objects?").'")) {
                            $id("act-val").value = "delete";
                            $id("act-id").value = "'.$data["id"].'";
                            $id("act-form").submit();
                        }\'
                    />
                </td>
            </tr>';
        }
        $table .= '
        </table></div><br/>';
        if ($arr_count) {
            $fout .= $table.'
            <form method="POST" id="query_form" onSubmit="document.framework.submit_search_form();">
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
                    <nobr><select id="select-pagination" class="input" onChange=\'$id("count_field").value = this.value; document.framework.submit_search_form();\' >
                     <option id="option-pagination-20"'; if ($_SESSION["count"] == "20") { $fout.= ' selected'; } $fout.= '>20</option>
                     <option id="option-pagination-50"'; if ($_SESSION["count"] == "50") { $fout.= ' selected'; } $fout.= '>50</option>
                     <option id="option-pagination-100"'; if ($_SESSION["count"] == "100") { $fout.= ' selected'; } $fout.= '>100</option>
                    </select> '.engine::lang("per page").'.</nobr></p>';
            }
            $fout .= '</div><div class="cr"></div>';
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
                        if ($a<2) {
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
                $fout .= '</ul>
                </div>
                ';
            }
            $fout .= '
                </form>
                <div class="clear"></div>';
        } else {
            $fout .= '<div class="clear_block">'.engine::lang("Projects not found").'</div>';
        }
        $fout .= '
            <input type="button" class="btn w280" value="'.engine::lang("Add project").'" onClick=\'this.style.display="none"; $id("new_project").style.display="block";\' />
            <form method="POST" ENCTYPE="multipart/form-data" id="new_project" style="display:none;" >
                <input type="hidden" name="action" value="add_project" />
                <h2 class="fs21">'.engine::lang("Add project").'</h2><br/>
                <center>
                    <input id="input-article-caption" type="text" class="input w600" name="name" required placeHolder="'.engine::lang("Name").'" /><br/><br/>
                    <!-- <input id="input-article-url" type="text" class="input w600" name="url" placeHolder="URL" /><br/><br/> -->
                    <div class="w600">
                    <textarea class="input w600" id="editable" name="text" placeHolder="Text" required></textarea>
                    </div><br/><br/>
                    <input id="input-submit" type="submit" onClick=\'$id("new_project").submit();\' class="btn w280" value="'.engine::lang("Submit").'" /><br/><br/>
                    <br/>
                </center>
            </form>
        </div>';
    } else {
        $project_id = intval($_GET["project_id"]);
        $query = 'SELECT * FROM `nodes_vr_project` WHERE `id` = "'.$project_id.'"';
        $res = engine::mysql($query);
        $project = mysqli_fetch_array($res);
        if (empty($project)) {
            engine::error();
        }
        if (empty($_GET["level_id"])) {
            if ($_POST["action"] == "new_level") {
                $name = trim(htmlspecialchars($_POST["name"]));
                $text = trim(engine::escape_string($_POST["text"]));
                // $image = "/img/plans/".file::upload("image", "img/plans", 1);
                $query = 'INSERT INTO `nodes_vr_level`(`project_id`, `name`, `text`, `image`, `scale`) '
                        . 'VALUES("'.$project_id.'", "'.$name.'", "'.$text.'", "", "1")';
                engine::mysql($query);
                $ext = explode('.', $_FILES["image"]["name"]);
                $file = "img/plans/".mysqli_insert_id($_SERVER["sql_connection"]).'.'.$ext[count($ext) - 1];
                $image = image::upload_plan($_FILES["image"]["tmp_name"], $file, $ext[count($ext) - 1]);
                $query = 'UPDATE `nodes_vr_level` SET `image` = "/'.$file.'" WHERE `id` = "'.mysqli_insert_id($_SERVER["sql_connection"]).'"';
                engine::mysql($query);
            } else if ($_POST["action"] == "edit_project") {
                $name = trim(htmlspecialchars($_POST["name"]));
                $text = trim(engine::escape_string($_POST["text"]));
                $url = trim(htmlspecialchars($_POST["url"]));
                $query = 'UPDATE `nodes_vr_project` SET `name` = "'.$name.'", `text` = "'.$text.'", `url` = "'.$url.'" WHERE `id` = "'.$project_id.'"';
                engine::mysql($query);
            } else if (!empty($_POST) && $_POST["action"] == "delete" && !empty($_POST["id"])) {
                $id = intval($_POST["id"]);
                $query = 'DELETE FROM `nodes_vr_level` WHERE `id` = "'.$id.'"';
                engine::mysql($query);
                $query = 'DELETE FROM `nodes_vr_scene` WHERE `level_id` = "'.$id.'"';
                engine::mysql($query);
                $query = 'DELETE FROM `nodes_vr_object` WHERE `level_id` = "'.$id.'"';
                engine::mysql($query);
            }
            $query = 'SELECT * FROM `nodes_vr_level` WHERE `project_id` = "'.$project["id"].'" ORDER BY `id` DESC LIMIT '.($from-1).', '.$_SESSION["count"];
            $requery = 'SELECT COUNT(*) FROM `nodes_vr_level` WHERE `project_id` = "'.$project["id"].'"';
            $fout .= '<div class="tal"><a href="'.$_SERVER["DIR"].'/admin/?mode=panoramas">'.engine::lang("Panoramas").'</a> / <b>'.$project["name"].'</b> / </div>
                <h1>'.engine::lang("Project details").'</h1>';
            $table = '
                <form method="POST" id="act-form">
                    <input type="hidden" id="act-id" name="id" value="" />
                    <input type="hidden" id="act-val" name="action" value="" />
                </form>
                <div class="table">
                <table id="table" class="w100p" style="max-width:700px;">
                <thead>
                <tr>
                    <th>'.engine::lang("Level Name").'</th>
                    <th>'.engine::lang("Scenes").'</th>
                    <th>'.engine::lang("Objects").'</th>
                    <th>'.engine::lang("Portals").'</th>
                    <th>'.engine::lang("Links").'</th>
                    <th></th>
                </tr>
                </thead>';
            $res = engine::mysql($query);
            $aframe = '';
            while ($data = mysqli_fetch_array($res)) {
                $query = 'SELECT COUNT(`id`) FROM `nodes_vr_scene` WHERE `level_id` = "'.$data["id"].'"';
                $r = engine::mysql($query);
                $d = mysqli_fetch_array($r);
                $scenes = $d[0];
                $query = 'SELECT COUNT(`id`) FROM `nodes_vr_object` WHERE `level_id` = "'.$data["id"].'"';
                $r = engine::mysql($query);
                $d = mysqli_fetch_array($r);
                $objects = $d[0];
                $query = 'SELECT COUNT(`id`) FROM `nodes_vr_navigation` WHERE `level_id` = "'.$data["id"].'"';
                $r = engine::mysql($query);
                $d = mysqli_fetch_array($r);
                $points = $d[0];
                $query = 'SELECT COUNT(`id`) FROM `nodes_vr_link` WHERE `level_id` = "'.$data["id"].'"';
                $r = engine::mysql($query);
                $d = mysqli_fetch_array($r);
                $links = $d[0];
                $arr_count++;
                $table .= '<tr><td align=left>'.$data["name"].'</td>
                    <td align=left>'.$scenes.'</td>
                    <td align=left>'.$objects.'</td>
                    <td align=left>'.$points.'</td>
                    <td align=left>'.$links.'</td>
                    <td align=left>
                        <a class="btn small" href="'.$_SERVER["DIR"].'/admin/?mode=panoramas&project_id='.$data["project_id"].'&level_id='.$data["id"].'">'.engine::lang("Level details").'</a>
                        <input type="button" class="btn small" value="'.engine::lang("Delete").'" onClick=\'
                            if (confirm("'.engine::lang("Are you sure you want to delete a level with all scenes and custom objects?").'")) {
                                $id("act-val").value = "delete";
                                $id("act-id").value = "'.$data["id"].'";
                                $id("act-form").submit();
                            }
                        \' />
                    </td>
                </tr>';
            }
            $table .= '</table>
                </div><br/>';
            if ($arr_count) {
                $fout .= $table.'
                <form method="POST" id="query_form" onSubmit="document.framework.submit_search_form();">
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
                        <nobr><select id="select-pagination" class="input" onChange=\'$id("count_field").value = this.value; document.framework.submit_search_form();\' >
                         <option id="option-pagination-20"'; if ($_SESSION["count"] == "20") { $fout.= ' selected'; } $fout.= '>20</option>
                         <option id="option-pagination-50"'; if ($_SESSION["count"] == "50") { $fout.= ' selected'; } $fout.= '>50</option>
                         <option id="option-pagination-100"'; if ($_SESSION["count"] == "100") { $fout.= ' selected'; } $fout.= '>100</option>
                        </select> '.engine::lang("per page").'.</nobr></p>';
                }
                $fout .= '</div><div class="cr"></div>';
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
                            || ($i >= ($_SESSION["page"] - 2) && $i <= ($_SESSION["page"] +2) && $e < 5)
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
                    $fout .= '</ul>
                    </div>
                    ';
                 }
                 $fout .= '</form>
                    <div class="clear"></div>';
            } else {
                $fout .= '<div class="clear_block">'.engine::lang("Levels not found").'</div>';
            }
            $fout .= '
                <br/>
                <input id="add_new_level_button" type="button" class="btn w280" value="'.engine::lang("Add level").'" onClick=\'
                    this.style.display = "none";
                    $id("new_level").style.display = "block";
                    $id("edit_project_button").style.display = "none";\' 
                />
                <form method="POST" ENCTYPE="multipart/form-data" id="new_level" style="display:none;" >
                    <input type="hidden" name="action" value="new_level" />
                    <h2 class="fs21">'.engine::lang("Add level").'</h2><br/>
                    <center>
                        <input id="input-article-caption" type="text" class="input w600" name="name" required placeHolder="'.engine::lang("Name").'" /><br/><br/>
                        <input id="input-article-image" type="file" class="input w600" name="image" /><br/><br/>
                        <div class="w600">
                        <textarea class="input w600" id="editable" name="text" placeHolder="Text" required></textarea>
                        </div><br/><br/>
                        <input id="input-submit" type="submit" onClick=\'$id("new_level").submit();\' class="btn w280" value="'.engine::lang("Submit").'" /><br/><br/>
                        <br/>
                    </center>
                </form>
                <br/>
                <input id="edit_project_button" type="button" class="btn w280" value="'.engine::lang("Project properties").'" onClick=\'this.style.display="none"; $id("edit_project").style.display="block"; $id("add_new_level_button").style.display="none";\' />
                <form method="POST" ENCTYPE="multipart/form-data" id="edit_project" style="display:none;" >
                    <input type="hidden" name="action" value="edit_project" />
                    <h2 class="fs21">'.engine::lang("Project properties").'</h2><br/>
                    <center>
                    <input id="input-article-caption" type="text" class="input w600" name="name" required placeHolder="'.engine::lang("Name").'" value="'.$project["name"].'" /><br/><br/>
                    <!-- <input id="input-article-url" type="text" class="input w600" name="url" placeHolder="URL" value="'.$project["url"].'" /><br/><br/> -->
                    <div class="w600">
                    <textarea class="input w600" id="editable_2" name="text" placeHolder="Text" required>'.$project["text"].'</textarea>
                    </div><br/><br/>
                    <input id="input-submit" type="submit" class="btn w280" value="'.engine::lang("Submit").'" /><br/><br/>
                    <br/></center>
                </form>
            </div>';
        } else {
            $level_id = $_GET["level_id"];
            $query = 'SELECT * FROM `nodes_vr_level` WHERE `id` = "'.$level_id.'"';
            $res = engine::mysql($query);
            $level = mysqli_fetch_array($res);
            if (empty($level)) {
                engine::error();
            }
            $fout .= '<div class="tal"><a href="'.$_SERVER["DIR"].'/admin/?mode=panoramas">'.engine::lang("Panoramas").'</a> / <a href="/admin/?mode=panoramas&project_id='.$project_id.'">'.$project["name"].'</a> / <b>'.$level["name"].'</b></div>';
            if ($_POST["action"] == "new_scene") {
                $name = trim(htmlspecialchars($_POST["name"]));
                $cubemap = substr($cubemap, 0, count($cubemap) - 3).'}';
                $position = engine::escape_string($_POST["position"]);
                $rotation = engine::escape_string($_POST["rotation"]);
                $lat = floatval($_POST["lat"]);
                $lng = floatval($_POST["lng"]);
                $floor_position = engine::escape_string($_POST["floor_position"]);
                $floor_radius = floatval($_POST["floor_radius"]);
                $logo_size = floatval($_POST["logo_size"]);
                $query = 'INSERT INTO `nodes_vr_scene`(`project_id`, `level_id`, `name`, `image`, `cubemap`, `position`, `rotation`, `lat`, `lng`, `floor_position`, `floor_radius`, `logo_size`) '
                        . 'VALUES("'.$project_id.'", "'.$level_id.'", "'.$name.'", "", "'.str_replace('"', '\"', $cubemap).'", "'.$position.'", "'.$rotation.'", "'.$lat.'", "'.$lng.'", "'.$floor_position.'", "'.$floor_radius.'", "'.$logo_size.'")';
                engine::mysql($query);
                $scene_id = mysqli_insert_id($_SERVER["sql_connection"]);
                $cubemap = '{';
                $folderPath = "img/cubemap/";
                $sides = array("pz", "nz", "px", "nx", "py", "ny");
                foreach ($sides as $side) {
                    for ($i = 0; $i < 1; $i++) {
                        for ($j = 0; $j < 1; $j++) {
                            $id = ($i*1+ $j);
                            $cubemap .= '"'.$side.'_1_'.($id).'":"'.$scene_id.'xf_1_'.$side.'_'.$id.'.png", ';
                        }
                    }
                    for ($i = 0; $i < 2; $i++) {
                        for ($j = 0; $j < 2; $j++) {
                            $id = ($i * 2+ $j);
                            $cubemap .= '"'.$side.'_2_'.($id).'":"'.$scene_id.'xf_2_'.$side.'_'.$id.'.png", ';
                        }
                    }
                    for ($i = 0; $i < 4; $i++) {
                        for ($j = 0; $j < 4; $j++) {
                            $id = ($i * 4 + $j);
                            $cubemap .= '"'.$side.'_3_'.($id).'":"'.$scene_id.'xf_3_'.$side.'_'.$id.'.png", ';
                        }
                    }
                    for ($i = 0; $i < 8; $i++) {
                        for ($j = 0; $j < 8; $j++) {
                            $id = ($i*8+ $j);
                            $cubemap .= '"'.$side.'_4_'.($id).'":"'.$scene_id.'xf_4_'.$side.'_'.$id.'.png", ';
                        }
                    }
                }
                $cubemap = substr($cubemap, 0, count($cubemap) - 3).'}';
                $query = 'UPDATE `nodes_vr_scene` SET `cubemap` = "'.str_replace('"', '\"', $cubemap).'" WHERE `id` = "'.$scene_id.'"';
                engine::mysql($query);
                if (!empty($_FILES)) {
                    $query = 'SELECT MAX(`id`) FROM `nodes_vr_scene`';
                    $r = engine::mysql($query);
                    $d = mysqli_fetch_array($r);
                    $img_size = getimagesize($file);
                    mkdir($_SERVER["DOCUMENT_ROOT"].'/img/scenes/'.$scene_id);
                    for ($k = 0; $k < count($_FILES["images"]["name"]); $k++) {
                        if (strpos($_FILES["images"]["name"][$k], '_perspective_view_top')) {
                            $side = 'py';
                        } else if (strpos($_FILES["images"]["name"][$k], '_perspective_view_bottom')) {
                            $side = 'ny';
                        } else if (strpos($_FILES["images"]["name"][$k], '_perspective_view_back')) {
                            $side = 'nz';
                        } else if (strpos($_FILES["images"]["name"][$k], '_perspective_view_front')) {
                            $side = 'pz';
                        } else if (strpos($_FILES["images"]["name"][$k], '_perspective_view_left')) {
                            $side = 'px';
                        } else if (strpos($_FILES["images"]["name"][$k], '_perspective_view_right')) {
                            $side = 'nx';
                        } else continue;
                        $img_size = getimagesize($_FILES["images"]["tmp_name"][$k]);
                        $width = $img_size[0];
                        $height = $img_size[1];
                        $res = 32;
                        if ($height / 8 >= 64) {
                            $res = 64;
                        }
                        if ($height / 8 >= 128) {
                            $res = 128;
                        }
                        if ($height / 8 >= 256) {
                            $res = 256;
                        }
                        if ($height / 8 >= 512) {
                            $res = 512;
                        }
                        if ($height / 8 >= 1024) {
                            $res = 1024;
                        }
                        for ($i = 0; $i < 8; $i++) {
                            for ($j = 0; $j < 8; $j++) {
                                $img = new image($_FILES["images"]["tmp_name"][$k]);
                                $img->crop(
                                    intval($i * ($width / 8)),
                                    intval($j * ($height / 8)),
                                    intval(($width / 8)),
                                    intval(($height / 8))
                                );
                                $id = ($i*8+ $j);
                                $img->resize($res, $res);
                                $img->save($_SERVER["DOCUMENT_ROOT"].$_SERVER["DIR"].'/img/scenes/'.$scene_id.'/', 'f_4_'.$side.'_'.$id, 'png', true, 100);
                            }
                        }
                        $res = 32;
                        if ($height / 4 >= 64) {
                            $res = 64;
                        }
                        if ($height / 4 >= 128) {
                            $res = 128;
                        }
                        if ($height / 4 >= 256) {
                            $res = 256;
                        }
                        if ($height / 4 >= 512) {
                            $res = 512;
                        }
                        if ($height / 4 >= 1024) {
                            $res = 1024;
                        }
                        for ($i = 0; $i < 4; $i++) {
                            for ($j = 0; $j < 4; $j++) {
                                $img = new image($_FILES["images"]["tmp_name"][$k]);
                                $img->crop(
                                    intval($i * ($width/4)),
                                    intval($j * ($height / 4)),
                                    intval(($width/4)),
                                    intval(($height / 4))
                                );
                                $id = ($i * 4 + $j);
                                $img->resize($res, $res);
                                $img->save($_SERVER["DOCUMENT_ROOT"].$_SERVER["DIR"].'/img/scenes/'.$scene_id.'/', 'f_3_'.$side.'_'.$id, 'png', true, 80);
                            }
                        }
                        //--------
                        $res = 32;
                        if ($height / 2 >= 64) {
                            $res = 64;
                        }
                        if ($height / 2 >= 128) {
                            $res = 128;
                        }
                        if ($height / 2 >= 256) {
                            $res = 256;
                        }
                        if ($height / 2 >= 512) {
                            $res = 512;
                        }
                        if ($height / 2 >= 1024) {
                            $res = 1024;
                        }
                        for ($i = 0; $i < 2; $i++) {
                            for ($j = 0; $j < 2; $j++) {
                                $img = new image($_FILES["images"]["tmp_name"][$k]);
                                $img->crop(
                                    intval($i * ($width / 2)),
                                    intval($j * ($height / 2)),
                                    intval(($width / 2)),
                                    intval(($height / 2))
                                );
                                $id = ($i * 2+ $j);
                                $img->resize($res, $res);
                                $img->save($_SERVER["DOCUMENT_ROOT"].$_SERVER["DIR"].'/img/scenes/'.$scene_id.'/', 'f_2_'.$side.'_'.$id, 'png', true, 60);
                            }
                        }
                        //--------
                         $res = 32;
                        if ($height >= 64) {
                            $res = 64;
                        }
                        if ($height >= 128) {
                            $res = 128;
                        }
                        if ($height >= 256) {
                            $res = 256;
                        }
                        if ($height >= 512) {
                            $res = 512;
                        }
                        if ($height >= 1024) {
                            $res = 1024;
                        }
                        for ($i = 0; $i < 1; $i++) {
                            for ($j = 0; $j < 1; $j++) {
                                $img = new image($_FILES["images"]["tmp_name"][$k]);
                                $id = ($i * 2+ $j);
                                $img->resize($res, $res);
                                $img->save($_SERVER["DOCUMENT_ROOT"].$_SERVER["DIR"].'/img/scenes/'.$scene_id.'/', 'f_1_'.$side.'_'.$id, 'png', true, 40);
                            }
                        }
                    }
                }
            } else if ($_POST["action"] == "edit_level") {
                $name = trim(htmlspecialchars($_POST["name"]));
                $text = trim(engine::escape_string($_POST["text"]));
                $query = 'UPDATE `nodes_vr_level` SET `name` = "'.$name.'", `text` = "'.$text.'" WHERE `id` = "'.$level_id.'"';
                engine::mysql($query);
            } else if (!empty($_POST) && $_POST["action"] == "delete" && !empty($_POST["id"])) {
                $id = intval($_POST["id"]);
                $query = 'DELETE FROM `nodes_vr_scene` WHERE `id` = "'.$id.'"';
                engine::mysql($query);
                $query = 'DELETE FROM `nodes_vr_object` WHERE `scene_id` = "'.$id.'"';
                engine::mysql($query);
            } else if ($_POST["action"] == "upload_scene") {
                $json = file_get_contents($_FILES["json"]["tmp_name"]);
                $json = json_decode($json);
                $fout .= '<h1>'.engine::lang("Confirm uploading").'</h1><br/>'
                        . '<div class="table">
                <form method="POST" ENCTYPE="multipart/form-data">
                    <input type="hidden" name="action" value="confirm_uploading" />
                    <table id="table" class="w100p" style="max-width:700px;">
                    <thead>
                    <tr>
                        <th>'.engine::lang("Scene Name").'</th>
                        <th>'.engine::lang("Image").'</th>
                        <th>'.engine::lang("Coordinates").'</th>
                    </tr>';
                foreach ($json[0] ->shots as $key => $value) {
                    $name = explode('.', $key)[0];
                    $fout .= '<tr>
                        <td align=left>'.$name.'
                            <input type="hidden" name="scene[]" value="'.$name.'" />
                            <input type="hidden" name="file[]" value="'.$key.'" />
                            <input type="hidden" name="lat[]" value="'.$value->gps_position[0].'" />
                            <input type="hidden" name="lng[]" value="'.$value->gps_position[1].'" />
                            <input type="hidden" name="height[]" value="'.$value->gps_position[2].'" />
                        </td>
                        <td align=left>'.$key.'</td>
                        <td align=left>'.$value->gps_position[0].' '.$value->gps_position[1].' '.$value->gps_position[2].'</td>
                    </tr>';
                }
                $fout .= '</table>'
                        . '<br/><br/>'
                        . '<input type="submit" class="btn w280" value="'.engine::lang("Confirm").'" /><br/><br/>'
                        . '<a href="'.engine::href($_SERVER["DIR"].'/admin/?mode=panoramas&project_id='.$project_id.'&level_id='.$level_id).'" class="btn w280">'.engine::lang("Back to level").'</a>'
                    . '</form>'
                    . '</div>';
                return $fout;
            } else if ($_POST["action"] == "build_navigation") {
                $scene_id = intval($_POST["id"]);
                $query = 'SELECT * FROM `nodes_vr_scene` WHERE `id` = "'.$scene_id.'"';
                $res = engine::mysql($query);
                $data = mysqli_fetch_array($res);
                $query = 'SELECT * FROM `nodes_vr_scene` WHERE `level_id` = "'.$data["level_id"].'" AND `id` != "'.$data["id"].'"';
                $res = engine::mysql($query);
                while ($d = mysqli_fetch_array($res)) {
                    $lat = $d["lat"] - $data["lat"];
                    $lng = $d["lng"] - $data["lng"];
                    // $position = ($lat).' 5 '.($lng);
                    $position = '0 -100 0';
                    $query = 'INSERT INTO `nodes_vr_navigation`(`project_id`, `level_id`, `scene_id`, `target`, `position`, `scale`) '
                            . 'VALUES("'.$data["project_id"].'", "'.$data["level_id"].'", "'.$data["id"].'", "'.$d["id"].'", "'.$position.'", "1 1 1")';
                    engine::mysql($query);
                }
            } else if ($_POST["action"] == "confirm_uploading") {
                for ($i = 0; $i < count($_POST["scene"]); $i++) {
                    $name = $_POST["scene"][$i];
                    $lat = $_POST["lat"][$i];
                    $lng = $_POST["lng"][$i];
                    $height = $_POST["height"][$i];
                    $position = "0 3 0";
                    $rotation = "0 0 0";
                    $floor_position = "0 -2 0";
                    $floor_radius = "20";
                    $logo_size = "4";
                    $image = '';
                    $query = 'INSERT INTO `nodes_vr_scene`(`project_id`, `level_id`, `name`, `image`, `position`, `rotation`, `lat`, `lng`, `floor_position`, `floor_radius`, `logo_size`) '
                        . 'VALUES("'.$project_id.'", "'.$level_id.'", "'.$name.'", "'.$image.'", "'.$position.'", "'.$rotation.'", "'.$lat.'", "'.$lng.'", "'.$floor_position.'", "'.$floor_radius.'", "'.$logo_size.'")';
                    engine::mysql($query);
                }
                $fout = '<form method="POST" id="fx"><input type="hidden" name="action" value="upload_data" /></form>'
                    . '<script> $id("fx").submit();</script>';
                return $fout;
            } else if ($_POST["action"] == "upload_data") {
                if (!empty($_FILES) && !empty($_POST["name"])) {
                    $query = 'SELECT `id` FROM `nodes_vr_scene` WHERE `name` = "'.$_POST["name"].'"';
                    $r = engine::mysql($query);
                    $d = mysqli_fetch_array($r);
                    $img_size = getimagesize($file);
                    $scene_id = $d["id"];
                    $cubemap = '{';
                    $folderPath = "img/cubemap/";
                    $sides = array("pz", "nz", "px", "nx", "py", "ny");
                    foreach ($sides as $side) {
                        for ($i = 0; $i < 1; $i++) {
                            for ($j = 0; $j < 1; $j++) {
                                $id = ($i * 1 + $j);
                                $cubemap .= '"'.$side.'_1_'.($id).'":"'.$scene_id.'xf_1_'.$side.'_'.$id.'.png", ';
                            }
                        }
                        for ($i = 0; $i < 2; $i++) {
                            for ($j = 0; $j < 2; $j++) {
                                $id = ($i * 2+ $j);
                                $cubemap .= '"'.$side.'_2_'.($id).'":"'.$scene_id.'xf_2_'.$side.'_'.$id.'.png", ';
                            }
                        }
                        for ($i = 0; $i < 4; $i++) {
                            for ($j = 0; $j < 4; $j++) {
                                $id = ($i * 4 + $j);
                                $cubemap .= '"'.$side.'_3_'.($id).'":"'.$scene_id.'xf_3_'.$side.'_'.$id.'.png", ';
                            }
                        }
                        for ($i = 0; $i < 8; $i++) {
                            for ($j = 0; $j < 8; $j++) {
                                $id = ($i * 8 + $j);
                                $cubemap .= '"'.$side.'_4_'.($id).'":"'.$scene_id.'xf_4_'.$side.'_'.$id.'.png", ';
                            }
                        }
                    }
                    $cubemap = substr($cubemap, 0, count($cubemap) - 3).'}';
                    $query = 'UPDATE `nodes_vr_scene` SET `cubemap` = "'.str_replace('"', '\"', $cubemap).'" WHERE `id` = "'.$scene_id.'"';
                    engine::mysql($query);
                    mkdir($_SERVER["DOCUMENT_ROOT"].'/img/scenes/'.  $scene_id);
                    for ($k = 0; $k < count($_FILES["images"]["name"]); $k++) {
                        if (strpos($_FILES["images"]["name"][$k], '_perspective_view_top')) {
                            $side = 'py';
                        } else if (strpos($_FILES["images"]["name"][$k], '_perspective_view_bottom')) {
                            $side = 'ny';
                        } else if (strpos($_FILES["images"]["name"][$k], '_perspective_view_back')) {
                            $side = 'nz';
                        } else if (strpos($_FILES["images"]["name"][$k], '_perspective_view_front')) {
                            $side = 'pz';
                        } else if (strpos($_FILES["images"]["name"][$k], '_perspective_view_left')) {
                            $side = 'px';
                        } else if (strpos($_FILES["images"]["name"][$k], '_perspective_view_right')) {
                            $side = 'nx';
                        } else {
                            continue;
                        }
                        $img_size = getimagesize($_FILES["images"]["tmp_name"][$k]);
                        $width = $img_size[0];
                        $height = $img_size[1];
                        $res = 32;
                        if ($height / 8 >= 64) {
                            $res = 64;
                        }
                        if ($height / 8 >= 128) {
                            $res = 128;
                        }
                        if ($height / 8 >= 256) {
                            $res = 256;
                        }
                        if ($height / 8 >= 512) {
                            $res = 512;
                        }
                        if ($height / 8 >= 1024) {
                            $res = 1024;
                        }
                        for ($i = 0; $i < 8; $i++) {
                            for ($j = 0; $j < 8; $j++) {
                                $img = new image($_FILES["images"]["tmp_name"][$k]);
                                $img->crop(
                                    intval($i * ($width / 8)),
                                    intval($j * ($height / 8)),
                                    intval(($width / 8)),
                                    intval(($height / 8))
                                );
                                $id = ($i * 8 + $j);
                                $img->resize($res, $res);
                                $img->save($_SERVER["DOCUMENT_ROOT"].$_SERVER["DIR"].'/img/scenes/'.$scene_id.'/', 'f_4_'.$side.'_'.$id, 'png', true, 100);
                            }
                        }
                        $res = 32;
                        if ($height / 4 >= 64) {
                            $res = 64;
                        }
                        if ($height / 4 >= 128) {
                            $res = 128;
                        }
                        if ($height / 4 >= 256) {
                            $res = 256;
                        }
                        if ($height / 4 >= 512) {
                            $res = 512;
                        }
                        if ($height / 4 >= 1024) {
                            $res = 1024;
                        }
                        for ($i = 0; $i < 4; $i++) {
                            for ($j = 0; $j < 4; $j++) {
                                $img = new image($_FILES["images"]["tmp_name"][$k]);
                                $img->crop(
                                    intval($i * ($width/4)),
                                    intval($j * ($height / 4)),
                                    intval(($width/4)),
                                    intval(($height / 4))
                                );
                                $id = ($i * 4 + $j);
                                $img->resize($res, $res);
                                $img->save($_SERVER["DOCUMENT_ROOT"].$_SERVER["DIR"].'/img/scenes/'.$scene_id.'/', 'f_3_'.$side.'_'.$id, 'png', true, 80);
                            }
                        }
                        $res = 32;
                        if ($height / 2 >= 64) {
                            $res = 64;
                        }
                        if ($height / 2 >= 128) {
                            $res = 128;
                        }
                        if ($height / 2 >= 256) {
                            $res = 256;
                        }
                        if ($height / 2 >= 512) {
                            $res = 512;
                        }
                        if ($height / 2 >= 1024) {
                            $res = 1024;
                        }
                        for ($i = 0; $i < 2; $i++) {
                            for ($j = 0; $j < 2; $j++) {
                                $img = new image($_FILES["images"]["tmp_name"][$k]);
                                $img->crop(
                                    intval($i * ($width / 2)),
                                    intval($j * ($height / 2)),
                                    intval(($width / 2)),
                                    intval(($height / 2))
                                );
                                $id = ($i * 2 + $j);
                                $img->resize($res, $res);
                                $img->save($_SERVER["DOCUMENT_ROOT"].$_SERVER["DIR"].'/img/scenes/'.$scene_id.'/', 'f_2_'.$side.'_'.$id, 'png', true, 60);
                            }
                        }
                        $res = 32;
                        if ($height >= 64) {
                            $res = 64;
                        }
                        if ($height >= 128) {
                            $res = 128;
                        }
                        if ($height >= 256) {
                            $res = 256;
                        }
                        if ($height >= 512) {
                            $res = 512;
                        }
                        if ($height >= 1024) {
                            $res = 1024;
                        }
                        for ($i = 0; $i < 1; $i++) {
                            for ($j = 0; $j < 1; $j++) {
                                $img = new image($_FILES["images"]["tmp_name"][$k]);
                                $id = ($i * 2 + $j);
                                $img->resize($res, $res);
                                $img->save($_SERVER["DOCUMENT_ROOT"].$_SERVER["DIR"].'/img/scenes/'.$scene_id.'/', 'f_1_'.$side.'_'.$id, 'png', true, 40);
                            }
                        }
                    }
                }
                if (empty($_POST["id"])) {
                    $query = 'SELECT * FROM `nodes_vr_scene` WHERE `cubemap` = "" AND `level_id` = "'.$level_id.'" ORDER BY `id` DESC LIMIT 0, 1';
                } else {
                    $query = 'SELECT * FROM `nodes_vr_scene` WHERE `id` = "'.$_POST["id"].'" ORDER BY `id` DESC LIMIT 0, 1';
                }
                $r = engine::mysql($query);
                $flag = 0;
                while ($d = mysqli_fetch_array($r)) {
                    $flag = 1;
                    $fout .= '<div class="clear_block">Uploading an image of scene <b>'.$d["name"].'</b></div> 
                    <form method="POST" ENCTYPE="multipart/form-data" id="next_pano">
                        <input type="hidden" name="action" value="upload_data" />
                        <input type="hidden" name="name" value="'.$d["name"].'" />
                        '.engine::lang("Upload 6 images of cubemap").' <input type="file" multiple name="images[]" /><br/>
                        <input type="submit" class="btn w280" />
                    </form>';
                    return $fout;
                }
            }
            if ($_POST["action"] == "edit_level_plan") {
                $id = intval($_POST["id"]);
                $rotation = engine::escape_string($_POST["rotation"]);
                $scale = engine::escape_string($_POST["scale"]);
                if (!empty($_POST["json"])) {
                    $json = json_decode($_POST["json"]);
                    foreach ($json->points as $key => $value) {
                        $query = 'UPDATE `nodes_vr_scene` SET `top` = "'.intval($value->t).'", `left` = "'.intval($value->l).'" WHERE `id` = "'.intval($value->id).'"';
                        engine::mysql($query);
                    }
                }
                if (!empty($_FILES["image"]["tmp_name"])) {
                    $ext = explode('.', $_FILES["image"]["name"]);
                    $file = "img/plans/".$id.'.'.$ext[count($ext) - 1];
                    $image = image::upload_plan($_FILES["image"]["tmp_name"], $file, $ext[count($ext) - 1]);
                    if ($image) {
                        $query = 'UPDATE `nodes_vr_level` SET `rotation` = "0", `scale` = "1", `image` = "/'.$file.'" WHERE `id` = "'.$id.'"';
                        engine::mysql($query);
                    } else {
                        $query = 'UPDATE `nodes_vr_level` SET `rotation` = "'.$rotation.'", `scale` = "'.$scale.'" WHERE `id` = "'.$id.'"';
                        engine::mysql($query);
                    }
                } else {
                    $query = 'UPDATE `nodes_vr_level` SET `rotation` = "'.$rotation.'", `scale` = "'.$scale.'" WHERE `id` = "'.$id.'"';
                    engine::mysql($query);
                }
            }
            $query = 'SELECT * FROM `nodes_vr_scene` WHERE `project_id` = "'.$project["id"].'" AND `level_id` = "'.$level["id"].'" ORDER BY `id` DESC LIMIT '.($from-1).', '.$_SESSION["count"];
            $requery = 'SELECT COUNT(*) FROM `nodes_vr_scene` WHERE `project_id` = "'.$project["id"].'" AND `level_id` = "'.$level["id"].'"';
            $fout .= '<h1>'.engine::lang("Level details").'</h1>';
            $table = '<div id="listing">
                <form method="POST" id="act-form">
                    <input type="hidden" id="act-id" name="id" value="" />
                    <input type="hidden" id="act-val" name="action" value="" />
                </form>
                <div class="table">
                <table id="table" class="w100p" style="max-width:700px;">
                <thead>
                <tr>
                    <th>'.engine::lang("Scene Name").'</th>
                    <th>'.engine::lang("Objects").'</th>
                    <th>'.engine::lang("Portals").'</th>
                    <th>'.engine::lang("Links").'</th>
                    <th></th>
                </tr>
                </thead>';
            $res = engine::mysql($query);
            while ($data = mysqli_fetch_array($res)) {
                $query = 'SELECT COUNT(`id`) FROM `nodes_vr_object` WHERE `scene_id` = "'.$data["id"].'"';
                $r = engine::mysql($query);
                $d = mysqli_fetch_array($r);
                $objects = $d[0];
                $query = 'SELECT COUNT(`id`) FROM `nodes_vr_navigation` WHERE `scene_id` = "'.$data["id"].'"';
                $r = engine::mysql($query);
                $d = mysqli_fetch_array($r);
                $points = $d[0];
                $query = 'SELECT COUNT(`id`) FROM `nodes_vr_link` WHERE `level_id` = "'.$data["id"].'"';
                $r = engine::mysql($query);
                $d = mysqli_fetch_array($r);
                $links = $d[0];
                $arr_count++;
                $table .= '<tr><td align=left>'.$data["name"].'</td>
                <td align=left>'.$objects.'</td>
                <td align=left>'.$points.'</td>
                <td align=left>'.$links.'</td>
                <td align=left>
                    <a class="btn small" href="'.$_SERVER["DIR"].'/panorama.php?id='.$data["id"].'" target="_blank">'.engine::lang("View scene").'</a>
                        <input type="button" class="btn small" value="'.engine::lang("Delete").'" onClick=\'
                            if (confirm("'.engine::lang("Are you sure you want to delete a scene with all custom objects?").'")) {
                                $id("act-val").value = "delete";
                                $id("act-id").value = "'.$data["id"].'";
                                $id("act-form").submit();
                            }\'
                        />';
                $query = 'SELECT COUNT(*) FROM `nodes_vr_navigation` WHERE `scene_id` = "'.$data["id"].'"';
                $r = engine::mysql($query);
                $d = mysqli_fetch_array($r);
                if ($d[0] == 0) {
                    $table .= '<input type="button" class="btn small" value="Build navigation" onClick=\'
                        if (confirm("Are you sure you want to build navigation to neightbors scenes?")) {
                            $id("act-val").value = "build_navigation";
                            $id("act-id").value = "'.$data["id"].'";
                            $id("act-form").submit();
                        }\'
                    />';
                }
                $table .= '
                    </td>
                </tr>';
            }
            $table .= '
                </table></div><br/>';
            if ($arr_count) {
                $fout .= $table.'
                <form method="POST" id="query_form" onSubmit="document.framework.submit_search_form();">
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
                        <nobr><select id="select-pagination" class="input" onChange=\'$id("count_field").value = this.value; document.framework.submit_search_form();\' >
                         <option id="option-pagination-20"'; if ($_SESSION["count"] == "20") { $fout.= ' selected'; } $fout.= '>20</option>
                         <option id="option-pagination-50"'; if ($_SESSION["count"] == "50") { $fout.= ' selected'; } $fout.= '>50</option>
                         <option id="option-pagination-100"'; if ($_SESSION["count"] == "100") { $fout.= ' selected'; } $fout.= '>100</option>
                        </select> '.engine::lang("per page").'.</nobr></p>';
                }
                $fout .= '</div><div class="cr"></div>';
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
                                $b = 1; $e = 0;
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
                    $fout .= '</ul>
                    </div>
                    ';
                }
                $fout .= '</form>
                    <div class="clear"></div>';
            } else {
                $fout .= '<div class="clear_block">'.engine::lang("Scenes not found").'</div>';
            }
            $fout .= '
            </div>
            <div style="max-width: 640px; margin:0px auto;">
                <input id="show_level_plan" type="button" class="btn w280" value="'.engine::lang("Show level plan").'" onClick=\'
                   $id("show_level_plan").style.display="none";
                   $id("upload_scene_button").style.display="none";
                   $id("edit_scene_button").style.display="none";
                   $id("add_new_scene_button").style.display="none";
                   $id("level_plan").style.display="block";
                   try{ $id("listing").style.display="none"; }catch(e) {}
                   document.framework.admin.showLevelPlan();\'
                />
                <div id="level_plan">
                    '.engine::pano_level_plan($level_id).'
                </div>
                <br/>
                <input id="upload_scene_button" type="button" class="btn w280" value="'.engine::lang("Upload scenes").'" onClick=\'
                    $id("show_level_plan").style.display="none";
                    $id("upload_scene_button").style.display="none";
                    $id("upload_scene").style.display="block";
                    $id("edit_scene_button").style.display="none";
                    $id("add_new_scene_button").style.display="none";
                    try{ $id("listing").style.display="none"; }catch(e) {}\'
                 />
                <form method="POST" ENCTYPE="multipart/form-data" id="upload_scene" style="display:none; text-align:left;" >
                    <input type="hidden" name="action" value="upload_scene" />
                    <center><h2 class="fs21">'.engine::lang("Upload scenes").'</h2></center><br/>
                    JSON:<br/>
                    <input id="input-article-caption" type="file" class="input w600" name="json" required /><br/><br/>
                    <!--
                    Scene images:<br/>
                    <input id="input-article-images" type="file" multiple class="input w600" name="file[]" /><br/><br/>
                    -->
                    <center><input id="input-submit" type="submit" class="btn w280" value="'.engine::lang("Submit").'" /><br/>
                    <a href="/admin/?mode=panoramas&project_id='.$project_id.'&level_id='.$level_id.'"><input type="button" class="btn w280" value="Cancel" /></a></center><br/><br/>
                    <br/>
                </form>
                <br/>
                <input id="add_new_scene_button" type="button" class="btn w280" value="'.engine::lang("Add new scene").'" onClick=\'
                    $id("show_level_plan").style.display="none";
                    $id("upload_scene_button").style.display="none";
                    $id("new_scene").style.display="block";
                    $id("edit_scene_button").style.display="none";
                    $id("add_new_scene_button").style.display="none";
                    try{ $id("listing").style.display="none"; }catch(e) {}\'
                />
                <form method="POST" ENCTYPE="multipart/form-data" id="new_scene" style="display:none; text-align:left;" >
                    <input type="hidden" name="action" value="new_scene" />
                    <center><h2 class="fs21">'.engine::lang("Add new scene").'</h2></center><br/>
                    <main id="worker_wnd" class="lh2 w280 m0a">
                      <section>
                        <label>'.engine::lang("Upload a panoramic image").': <br/><br/><input id="imageInput" type="file" ></label>
                        <label>'.engine::lang("Or upload 6 images of cubemap").'</label> <input type="file" multiple name="images[]" onChange=\'$id("new_scene_details").style.display = "block"; $id("worker_wnd").style.display="none";\' />
                      </section>
                      <section class="settings">
                        <div>
                          <label>'.engine::lang("Cube Rotation").': <input id="cubeRotation" type="number" min="0" max="359" value="180">°</label>
                        </div>
                        <fieldset title="'.engine::lang("The resampling algorithm to use when generating the cubemap").'">
                          <label><input type="radio" name="interpolation" value="lanczos" checked>Lanczos (best but slower)</label><br/>
                          <label><input type="radio" name="interpolation" value="cubic">Cubic (sharper details)</label><br/>
                          <label><input type="radio" name="interpolation" value="linear">Linear (softer details)</label><br/>
                        </fieldset>
                        <fieldset style="display:none;">
                          '.engine::lang("Output format").'<br/>
                          <label><input type="radio" name="format" value="png" checked>PNG</label><br/>
                          <label><input type="radio" name="format" value="jpg">JPEG</label><br/>
                        </fieldset>
                      </section>
                      <section>
                        <div id="cubemap">
                          <b id="generating" style="visibility:hidden">'.engine::lang("Generating").'...</b>
                          <output id="faces"></output>
                        </div>
                      </section>
                    </main>
                    <script src="'.$_SERVER["DIR"].'/script/pano2cube.js"></script>
                    <div style="display:none;" id="new_scene_details">
                        '.engine::lang("Scene name").':<br/>
                        <input id="input-article-caption" type="text" class="input w600" name="name" required placeHolder="'.engine::lang("Name").'" /><br/><br/>
                        '.engine::lang("Scene position").':<br/>
                        <input id="input-article-position" type="text" class="input w600" name="position" required placeHolder="'.engine::lang("Position").'" value="0 3 0" /><br/><br/>
                        '.engine::lang("Scene rotation").':<br/>
                        <input id="input-article-rotation" type="text" class="input w600" name="rotation" required placeHolder="'.engine::lang("Rotation").'" value="0 0 0" /><br/><br/>
                        '.engine::lang("Scene latitude").':<br/>
                        <input id="input-article-latitude" type="number" class="input w600" name="lat" required placeHolder="'.engine::lang("Latitude").'" value="0" /><br/><br/>
                        '.engine::lang("Scene longitude").':<br/>
                        <input id="input-article-longitude" type="number" class="input w600" name="lng" required placeHolder="'.engine::lang("Longitude").'" value="0" /><br/><br/>
                        '.engine::lang("Floor position").':<br/>
                        <input id="input-article-floor-position" type="text" class="input w600" name="floor_position" required placeHolder="'.engine::lang("Floor position").'" value="0 -2 0" /><br/><br/>
                        '.engine::lang("Floor radius").':<br/>
                        <input id="input-article-floor-radius" type="number" class="input w600" name="floor_radius" required placeHolder="'.engine::lang("Floor radius").'" value="20" /><br/><br/>
                        '.engine::lang("Logo size").':<br/>
                        <input id="input-article-floor-radius" type="number" class="input w600" name="logo_size" required placeHolder="'.engine::lang("Logo size").'" value="4" /><br/><br/>
                        <center><input id="input-submit-new-scene" type="submit" class="btn w280" value="'.engine::lang("Submit").'" /><br/>
                            <a href="'.engine::href($_SERVER["DIR"].'/admin/?mode=panoramas&project_id='.$project_id.'&level_id='.$level_id).'"><input type="button" class="btn w280" value="'.engine::lang("Cancel").'" /></a><br/>
                            </center><br/><br/>
                        <br/>
                    </div>
                </form>
                <br/>
                <input id="edit_scene_button" type="button" class="btn w280" value="'.engine::lang("level properties").'" onClick=\'
                    $id("show_level_plan").style.display="none";
                    $id("upload_scene_button").style.display="none";
                    $id("edit_level").style.display="block";
                    $id("edit_scene_button").style.display="none";
                    $id("add_new_scene_button").style.display="none";
                    try{ $id("listing").style.display="none"; }catch(e) {}\' 
                />
                <form method="POST" ENCTYPE="multipart/form-data" id="edit_level" style="display:none;" >
                    <input type="hidden" name="action" value="edit_level" />
                    <h2 class="fs21">'.engine::lang("Level properties").'</h2><br/>
                    <center>
                    <input id="input-article-caption" type="text" class="input w600" name="name" required placeHolder="'.engine::lang("Name").'" value="'.$project["name"].'" /><br/><br/>
                    <div class="w600">
                    <textarea class="input w600" id="editable" name="text" placeHolder="'.engine::lang("Text").'" required>'.$project["text"].'</textarea>
                    </div><br/><br/>
                    <input id="input-submit" type="submit" class="btn w280" value="'.engine::lang("Submit").'" /><br/>
                    <a href="/admin/?mode=panoramas&project_id='.$project_id.'&level_id='.$level_id.'"><input type="button" class="btn w280" value="Cancel" /></a>
                    <br/>
                    <br/></center>
                </form>
            </div>';
        }
    }
    $cms->onload .= ' document.framework.tinymce_init(); ';
    return $fout;
}
