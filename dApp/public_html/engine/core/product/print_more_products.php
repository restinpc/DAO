<?php
/**
* Prints see also product block.
* @path /engine/core/product/print_more_products.php
*
* @name    DAO Mansion    @version 1.0.2
* @author  Aleksandr Vorkunov  <developing@nodes-tech.ru>
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
* @param string $url Page URL.
* @return string Returns Show more block on article or product page.
* @usage <code> engine::print_more_products($site, 1); </code>
*/

function print_more_products($site, $id){
    $query = 'SELECT * FROM `nodes_product` WHERE `id` = "'.$id.'"';
    $res = engine::mysql($query);
    $product = mysqli_fetch_array($res);
    $urls = Array();
    $count = 0;
    $fout = '';
    do {
        $query = 'SELECT * FROM `nodes_product` WHERE `id` <> "'.$product["id"].'" ORDER BY RAND() DESC';
        $res = engine::mysql($query);
        while($d = mysqli_fetch_array($res)){
            if(!in_array($d["id"], $urls)){
                if($count>5) break;
                $count++;
                $fout .= engine::print_product_preview($site, $d);
                array_push($urls, $d["id"]);
            }
        }
    } while ($count < 6);
    return $fout;
}
