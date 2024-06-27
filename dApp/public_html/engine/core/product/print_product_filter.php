<?php
/**
* Print product filter page.
* @path /engine/core/product/print_product_filter.php
*
* @name    DAO Mansion    @version 1.0.2
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
* @usage <code> engine::print_product_filter($site); </code>
*/
function print_product_filter($site){
    $filter = '<div class="product_filter">
    <form method="POST" id="filer_form">
    <input type="hidden" name="details" value="1" />
    <input type="hidden" name="reset" value="0" id="reset" />
    <b>'.engine::lang("FILTER RESULTS").'</b> &nbsp; ';
    $query = 'SELECT * FROM `nodes_product_property` WHERE `id` > 1 ORDER BY `id` ASC';
    $res = engine::mysql($query);
    $flag = 0;
    while($data = mysqli_fetch_array($res)){
        $filter .= '<select  id="select-product-filter" class="input" name="'.$data["id"].'" onChange=\'$id("filer_form").submit();\'>
        <option value="0">'.engine::lang("Any").' '.engine::lang($data["value"]).'</option>';
        $query = 'SELECT * FROM `nodes_product_data` WHERE `cat_id` = "'.$data["id"].'"';
        $r = engine::mysql($query);
        while($cat = mysqli_fetch_array($r)){
            $flag=1;
            if($_SESSION["details"][$data["id"]]==$cat["id"]){
                $filter .= '<option id="option-filter-'.$cat["id"].'" value="'.$cat["id"].'" selected>'.engine::lang($cat["value"]).'</option>';
            }else{
                $filter .= '<option id="option-filter-'.$cat["id"].'" value="'.$cat["id"].'">'.engine::lang($cat["value"]).'</option>';
            }
        }$filter .= '
            </select> &nbsp; ';
    }$filter .= '
        </form>
    </div>';
    if($flag) return $filter;
}
