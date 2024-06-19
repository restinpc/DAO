<?php
/**
* Prints content catalog page.
* @path /engine/core/content/print_catalog.php
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
* @param int $data @mysql[nodes_catalog].
* @return string Returns content of page on success, or die with error.
* @usage <code> engine::print_catalog($site, $data); </code>
*/

function print_catalog($site, $data) {
    $fout = '
        <div class="article" itemscope  itemtype="http://schema.org/Article">
        <div itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
            <img class="hidden" itemprop="logo" src="'.$site->img.'" />
            <meta itemprop="name" content="'.$site->configs["name"].'" />
        </div>
        <meta itemprop="datePublished" content="'.date("Y-m-d", $data["public_date"]).'" />
        <meta itemprop="dateModified" content="'.date("Y-m-d", $data["date"]).'" />
        <meta itemprop="author" content="'.$site->configs["email"].'" />
          ';
    if (!empty($data["img"])) {
        $fout .= '<div class="article_image">
            <img itemprop="image" src="'.$_SERVER["PUBLIC_URL"].'/img/data/big/'.$data["img"].'" class="img" />
        </div>';
    } else {
        $fout .= '<img class="hidden" itemprop="image" src="'.$site->img.'" />';
    }
    $fout .= '<h1 itemprop="headline" class="'.($data["visible"]?' hidden':'').'">'.$data["caption"].'</h1>';
    preg_match_all('#<img[^>]+src="(.*?)"#',$data["text"],$images);
    if (!empty($images)) {
        $text = engine::print_image_viewer($site, $data["text"], $data["caption"], $images);
    }
    $fout .= '
        <div itemprop="articleBody" class="text">'.$text.'</div>
        <div class="clear"><br/></div>
        <div class="date">'.engine::lang("Submitted on").' '.date("d/m/Y", $data["public_date"]).' '.date("H:i", $data["public_date"]).'</div><br/>';
    if ($data["date"]!=$data["public_date"]) {
        $fout .= '<div class="date">'.engine::lang("Last editing on").' '.date("d/m/Y", $data["date"]).' '.date("H:i", $data["date"]).'</div>';
    }
    $fout .= '</div>
    <div class="clear"><br/></div>';
    if ($_SESSION["user"]["id"]=="1") {
        $fout .= '<br/><a id="add_article" hreflang="'.$_SESSION["Lang"].'" href="'.engine::href($_SERVER["DIR"].'/admin/?mode=content&cat_id='.$data["id"]).'"><input type="button" class="btn w280" value="'.engine::lang("Add article").'" /></a>'
            . '<br/><br/><a id="edit_directory" hreflang="'.$_SESSION["Lang"].'" href="'.engine::href($_SERVER["DIR"].'/admin/?mode=content&cat_id='.$data["id"].'&act=edit').'"><input type="button" class="btn w280" value="'.engine::lang("Edit directory").'" /></a><br/><br/>';
    }
    return $fout;
}
