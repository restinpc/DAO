<?php
/**
* Print products page.
* @path /engine/core/product/print_products.php
*
* @name    DAO Mansion    @version 1.0.3
* @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*
* @var $site->title - Page title.
* @var $site->content - Page HTML data.
* @var $site->keywords - Array meta keywords.
* @var $site->description - Page meta description.
* @var $site->img - Page meta image.
* @var $site->onload - Page executable JavaScript code.
* @var $site->configs - Array MySQL configs.
*
* @param object $site Site class object.
* @return string Returns content of page on success, or die with error.
* @usage <code> engine::print_products($site); </code>
*/

function print_products($site) {
    if (!empty($_POST["from"])) {
        $_SESSION["from"] = $_POST["from"];
    }
    if (!empty($_POST["to"])) {
        $_SESSION["to"] = $_POST["to"];
    }
    if (!empty($_POST["count"])) {
        $_SESSION["count"] = intval($_POST["count"]);
    }
    if (!empty($_POST["page"])) {
        $_SESSION["page"] = intval($_POST["page"]);
    }
    if (!empty($_POST["method"])) {
        $_SESSION["method"] = $_POST["method"];
    }
    if (!empty($_POST["details"])) {
        foreach ($_POST as $key => $value) {
            $_SESSION["details"][$key] = $value;
        }
    }
    $_SESSION["order"] = "product`.`id";
    $from = ($_SESSION["page"] - 1) * $_SESSION["count"] + 1;
    $to = ($_SESSION["page"] - 1) * $_SESSION["count"] + $_SESSION["count"];
    $fout .= engine::print_product_filter($site);
    $fout .= '<div class="document980 products">';
    $query = 'SELECT `product`.* FROM `nodes_product` AS `product`';
    if (!empty($_POST["request"])) {
        $query .= ' AND (`product`.`title` LIKE "%'.engine::escape_string($_POST["request"]).'%"'
            . ' OR `product`.`text` LIKE "%'.engine::escape_string($_POST["request"]).'%")';
    }
    $i = 0;
    if (!empty($_SESSION["details"])) {
        foreach ($_SESSION["details"] as $key => $value) {
            if ($key != "details" && $key != "category") {
                $requery = 'SELECT * FROM `nodes_product_property` WHERE `id` = "'.$key.'"';
                $r = engine::mysql($requery);
                $d = mysqli_fetch_array($r);
                if ($value > 0) {
                    $i++;
                    $query .= ' INNER JOIN `nodes_property_data` AS `pd_'.$i.'` '
                        . 'ON ('
                            . '`pd_'.$i.'`.`product_id` = `product`.`id` '
                            . 'AND `pd_'.$i.'`.`property_id` = "'.$key.'" '
                            . 'AND `pd_'.$i.'`.`data_id` = "'.$value.'"'
                        . ')';
                }
            }
        }
    }
    if (!empty($_GET[1])) {
        $requery = 'SELECT * FROM `nodes_product_data` WHERE `url` LIKE "'. engine::escape_string(strtolower($_GET[1])).'"';
        $r = engine::mysql($requery);
        $d = mysqli_fetch_array($r);
        if (!empty($d)) {
            $i++;
            $site->title = $d["value"].' - '.$site->title;
            $title = $d["value"];
            $query .= ' INNER JOIN `nodes_property_data` AS `pd_'.$i.'` '
                . 'ON ('
                    . '`pd_'.$i.'`.`product_id` = `product`.`id` '
                    . 'AND `pd_'.$i.'`.`property_id` = "1" '
                    . 'AND `pd_'.$i.'`.`data_id` = "'.$d["id"].'"'
                . ')';
        } else {
            $fout = engine::error();
            return;
        }
    } else {
        if (!empty($_POST["request"])) {
            $title = engine::lang("Search").' “'.$_POST["request"];
        } else {
            $title = engine::lang("All Items");
        }
    }
    $requery = str_replace('`product`.*', 'COUNT(`product`.`id`)', $query);
    $query .= ' GROUP BY `product`.`id` ORDER BY `order` DESC LIMIT '.($from-1).', '.$_SESSION["count"];
    $res = engine::mysql($query);
    $r = engine::mysql($requery);
    $d = mysqli_fetch_array($r);
    $count = $d[0];
    $from = ($_SESSION["page"] - 1) * $_SESSION["count"] + 1;
    $to = ($_SESSION["page"] - 1) * $_SESSION["count"] + $_SESSION["count"];
    $arr_count = 0;
    $table = '<div class="preview_blocks">';
    while ($data = mysqli_fetch_array($res)) {
        $arr_count++;
        $table .= engine::print_product_preview($site, $data);
    }
    $table .= '<div class="clear"></div><br/></div>';
    if ($arr_count) {
        $fout .= $table.' <div class="clear"></div>
        <form method="POST" id="query_form" onSubmit="document.framework.submit_search_form();">
        <input type="hidden" name="page" id="page_field" value="'.$_SESSION["page"].'" />
        <input type="hidden" name="count" id="count_field" value="'.$_SESSION["count"].'" />
        <input type="hidden" name="order" id="order" value="'.$_SESSION["order"].'" />
        <input type="hidden" name="method" id="method" value="'.$_SESSION["method"].'" />
        <div class="total-entry">';
        if ($to > $count) {
            $to = $count;
        }
        if ($count > 0) {
            $fout.= '<p class="p5">'.engine::lang("Showing").' '.$from.' '.engine::lang("to").' '.$to.' '.engine::lang("from").' '.$count.' '.engine::lang("entries").', 
                <nobr><select id="select-pagination" class="input" onChange=\'$id("count_field").value = this.value; document.framework.submit_search_form();\' >
                 <option id="option-pagination-20"'; if ($_SESSION["count"] == "20") { $fout.= ' selected'; } $fout.= '>20</option>
                 <option id="option-pagination-50"'; if ($_SESSION["count"] == "50") { $fout.= ' selected'; } $fout.= '>50</option>
                 <option id="option-pagination-100"'; if ($_SESSION["count"] == "100") { $fout.= ' selected'; } $fout.= '>100</option>
                </select> '.engine::lang("per page").'.</nobr></p>';
        }
        $fout .= '</div>
            <div class="cr"></div>';
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
        $fout .= '</form>'
        . '<div class="clear"></div>';
    } else {
        $fout .= '<div class="clear_block">'.engine::lang("Products not found").'</div>';
    }
    $fout .= '<br/></div>';
    return $fout;
}
