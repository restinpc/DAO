<?php
/**
* Prints content article page.
* @path /engine/core/content/print_article.php
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
* @param int $data @mysql[nodes_content].
* @return string Returns content of page on success, or die with error.
* @usage <code> engine::print_article($site, $data); </code>
*/
function print_article($site, $data){
    if(!empty($data["img"]))
        $site->img = $_SERVER["PUBLIC_URL"]."/img/data/big/".$data["img"];
    $site->description = $data["text"];
    $query = 'SELECT * FROM `nodes_catalog` WHERE `id` = "'.$data["cat_id"].'"';
    $r = engine::mysql($query);
    $d = mysqli_fetch_array($r);
    $fout = '';
    $fout .= '<h1>'.$data["caption"].'</h1>';
    $fout .= '<div class="article">';
    preg_match_all('#<img[^>]+src="(.*?)"([^>]+alt="(.*?)")?#',$data["text"],$images);
    if(!empty($images)){
        $text = engine::print_image_viewer($site, $data["text"], $data["caption"], $images[1], $images[3]);
    }
    $fout .= '<div class="text"> '.$text.' </div>
    <div class="clear"><br/></div>
    <div class="date">'.engine::lang("Submitted on").' '.date("d/m/Y", $data["public_date"]).' '.date("H:i", $data["public_date"]).'</div><br/>';
    if($data["date"]!=$data["public_date"]){
        $fout .= '<div class="date">'.engine::lang("Last editing on").' '.date("d/m/Y", $data["date"]).' '.date("H:i", $data["date"]).'</div>';
    }
    $fout .= '
    </div>
    <div class="clear"><br/></div>
    <a id="show-comments" onClick=\'document.getElementById("comments_block").style.display="block"; this.style.display="none";\'><button class="btn w280 mt15" >'.engine::lang("Show comments").'</button><br/><br/></a>';
    $fout .= '<div id="comments_block">
        <a name="comments"></a>
        <div class="tal pl10 fs21"><b>'.engine::lang("Latest comments").'</b><br/><br/></div>
        '.engine::print_comments($_SERVER["REQUEST_URI"]).'
        </div>';
    if($_SESSION["user"]["id"]=="1"){
        $fout .= '<a id="edit-article-'.$data["id"].'" hreflang="'.$_SESSION["Lang"].'" href="'.engine::href($_SERVER["DIR"].'/admin/?mode=content&cat_id='.$data["cat_id"].'&id='.$data["id"].'&act=edit').'"><input type="button" class="btn w280" value="'.engine::lang("Edit article").'" /></a><br/><br/>';
    }
    $new_fout = '';
    $blocks = engine::print_more_articles($site, $data["url"]);
    if(!empty($blocks)){
        $new_fout .= '<div class="clear"></div><br/>'
            . '<div class="tal pl10 fs21"><b>'.engine::lang("You might also be interested in").'</b></div>
            <br/><br/>
            <div class="preview_blocks">'
            .$blocks.
            '<div class="clear"></div>
            </div>';
    }
    $fout .= $new_fout;
    $fout .= '<div class="clear"><br/></div>';
    return $fout;
}
