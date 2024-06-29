<?php
/**
* Prints see also content block.
* @path /engine/core/content/print_more_articles.php
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
* @param string $url Page URL.
* @return string Returns Show more block.
* @usage <code> engine::print_show_more($site, "/content/test"); </code>
*/

function print_more_articles($site, $url) {
    $query = 'SELECT * FROM `nodes_content` WHERE `url` = "'.$url.'" AND `lang` = "'.$_SESSION["Lang"].'"';
    $res = engine::mysql($query);
    $data = mysqli_fetch_array($res);
    $count = 0;
    $fout = '';
    $urls = array();
    // print articles same catalog
    $query = 'SELECT * FROM `nodes_content` WHERE `id` <> "'.$data["id"].'" '
            . 'AND `cat_id` = "'.$data["cat_id"].'" '
            . 'AND `lang` = "'.$_SESSION["Lang"].'" ORDER BY RAND() DESC';
    $res = engine::mysql($query);
    while ($d = mysqli_fetch_array($res)) {
        if (!in_array($d["id"], $urls)) {
            if ($count > 11) {
                break;
            }
            $count++;
            $fout .= engine::print_preview($site, $d);
            array_push($urls, $d["id"]);
        }
    }
    // print articles other catalog if required
    if ($count < 12) {
        $query = 'SELECT * FROM `nodes_content` WHERE `id` <> "'.$data["id"].'" '
                . 'AND `cat_id` <> "'.$data["cat_id"].'" '
                . 'AND `lang` = "'.$_SESSION["Lang"].'" ORDER BY RAND() DESC';
        $res = engine::mysql($query);
        while ($d = mysqli_fetch_array($res)) {
            if (!in_array($d["id"], $urls)) {
                if ($count > 11) {
                    break;
                }
                $count++;
                $fout .= engine::print_preview($site, $d);
                array_push($urls, $d["id"]);
            }
        }
    }
    return $fout;
}
