<?php
/**
* Print account header block.
* @path /engine/core/account/print_header.php
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
* @param int $user_id @mysql[nodes_user]->id.
* @return string Returns content of page on success, or die with error.
* @usage <code> engine::print_header($site, 1); </code>
*/
function print_header($site, $id){
    $query = 'SELECT * FROM `nodes_user` WHERE `id` = "'.$id.'"';
    $res = engine::mysql($query);
    $user = mysqli_fetch_array($res);
    if($user["online"]>date("U")-300){
        $online = '<b>'.engine::lang("Online").'</b><br/>';
    }else{
        $date = date("d/m/Y H:i", $user["online"]);
        $online = engine::lang("Last visit").' ';
        $online .= $date;
        $online .= '<br/>';
    }
    $fout = '<div class="profile_header" style="background:#1e5056;">
        <img src="'.$_SERVER["DIR"].'/img/pic/'.$user["photo"].'" /><br/>
        <h1>'.$user["name"].'</h1>
        '.$online.'
    </div>';
    return $fout;
}