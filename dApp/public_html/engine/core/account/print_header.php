<?php
/**
* Print account header block.
* @path /engine/core/account/print_header.php
*
* @name    DAO Mansion    @version 1.0.3
* @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*
* @param int $user_id @mysql[nodes_user]->id.
* @return string Returns content of page on success, or die with error.
* @usage <code> engine::print_header(1); </code>
*/

function print_header($id) {
    $query = 'SELECT * FROM `nodes_user` WHERE `id` = "'.$id.'"';
    $res = engine::mysql($query);
    $user = mysqli_fetch_array($res);
    if ($user["online"] >date("U") - 600) {
        $online = '<b>'.engine::lang("Online").'</b><br/>';
    } else {
        $date = date("d/m/Y H:i", $user["online"]);
        $online = engine::lang("Last visit").' ';
        $online .= $date;
        $online .= '<br/>';
    }
    $fout = '<div class="profile_header">
            <img src="'.$_SERVER["DIR"].'/img/pic/'.$user["photo"].'" /><br/>
            <h1>'.$user["name"].'</h1>
            '.$online.'
        </div>';
    return $fout;
}
