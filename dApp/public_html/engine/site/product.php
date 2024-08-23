<?php 
/**
* Backend product pages file.
* @path /engine/site/product.php
*
* @name    Nodes Studio    @version 1.0.5
* @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*
* @var $site->title - Page title.
* @var $site->content - Page HTML data.
* @var $site->keywords - Array meta keywords.
* @var $site->description - Page meta description.
* @var $site->img - Page meta image.
* @var $site->onload - Page executable JavaScript code.
*/

function product($site) {
    engine::log('product()');
    try {
        if (empty($_GET[0]) || !empty($_GET[2])) {
            $site->content = engine::error();
            return; 
        }
        if (array_key_exists(1, $_GET) && intval($_GET[1]) > 0) {
            $query = 'SELECT * FROM `nodes_product` WHERE `id` = "'.intval($_GET[1]).'"';
            $res = engine::mysql($query);
            $data = mysqli_fetch_array($res);
            if (!empty($data)) {
                $query = 'SELECT `data`.`value` AS `caption` '
                    . 'FROM `nodes_property_data` AS `property` '
                    . 'LEFT JOIN `nodes_product_data` AS `data` ON `data`.`id` = `property`.`data_id` '
                    . 'WHERE `product_id` = "'.$data["id"].'" AND `property_id` = "1"';
                $r = engine::mysql($query);
                $d = mysqli_fetch_array($r);
                $site->title = $data["title"].' - '.$site->title;
                if (strlen($site->description) > 198) {
                    $description = mb_substr($site->description, 0, 198);
                    $site->description = $description.(strcmp($description, $site->description) ? '..' : '');
                }
                $site->content .= engine::print_navigation($d["caption"]);
                $site->content .= engine::print_product($site, $data);
            } else {
                $site->content = engine::error();
                return; 
            }
        } else {
            if (!empty($_GET[1])) {
                $requery = 'SELECT * FROM `nodes_product_data` WHERE `url` LIKE "'. engine::escape_string(strtolower($_GET[1])).'"';
                $r = engine::mysql($requery);
                $d = mysqli_fetch_array($r);
                if (!empty($d)) {
                    $title = $d["value"];
                }
            } else {
                $site->title = lang("Products").' - '.$site->title;
                if (!empty($_POST["request"])) {
                    $title = lang("Search item");;
                } else {
                    $title = lang("Products");
                }
            }
            $site->content .= engine::print_navigation($title);
            $site->content .= engine::print_products($site);
        }
    } catch(Exception $e) {
        engine::throw('product()', $e);
    }
}

product($this);