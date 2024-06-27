<?php
/**
* Print product preview page.
* @path /engine/core/product/print_product_preview.php
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
* @param array $data @mysql[nodes_product].
* @param bool $right Right floating of blocks.
* @return string Returns content of page on success, or die with error.
* @usage <code> engine::print_product_preview($site, $data); </code>
*/
function print_product_preview($site, $data, $right=0){
    $images = explode(";", $data["img"]);
    if(empty($images[0])) $image = $_SERVER["DIR"].'/img/no-image.jpg';
    else $image = $_SERVER["DIR"].'/img/data/thumb/'.$images[0];
    $fout = '<div class="product_preview ';
    if(!empty($right)){
        $fout .= 'right';
    }
    $fout .= '">
    <a id="product-'.$data["id"].'" hreflang="'.$_SESSION["Lang"].'" href="'.engine::href($_SERVER["DIR"].'/product/'.$data["id"]).'">
        <div class="title">
            <b>'.$data["title"].'</b>
        </div>
        <div class="product_preview_image">
            <img src="'.$image.'" width=100% />
        </div>
    </a>';
    if($data["status"]){
        $fout .= '<div class="clear h7"></div>
        <div  id="buy-now-'.$data["id"].'" class="buy_now"';
        if($data["user_id"]==$_SESSION["user"]["id"]){
            $fout .= ' onClick=\'alert("'.engine::lang("Unable to purchase your own product").'")\' ';
        }else{
            //TODO selector propertis and count

            $fout .= ' onClick=\'document.framework.buyNow('.$data["id"].', '
                    . '"'.engine::lang("A new item has been added to your Shopping Cart").'", '
                    . '"'.engine::lang("Continue").'", '
                    . '"'.engine::lang("Checkout").'");\' ';
        }
        $fout .= '>
            <div class="label_1">'.engine::lang("Buy Now").'&nbsp;</div> 
            <div class="label_2 cart_img">&nbsp;</div>
            <div class="label_3">&nbsp;$'.intval($data["price"]).'</div>
        </div>';
    }
    $fout .= '
</div>';
    return $fout;
}
