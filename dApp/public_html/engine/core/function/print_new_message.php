<?php
/**
* Prints new message block.
* @path /engine/core/function/print_new_message.php
*
* @name    DAO Mansion    @version 1.0.3
* @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*
* @return string Returns content of block on success, or die with error.
* @usage <code> engine::print_new_message(); </code>
*/

function print_new_message() {
    $fout = '';
    $query = 'SELECT * FROM `nodes_inbox` WHERE `to` = "'.intval($_SESSION["user"]["id"]).'" '
        . 'AND `readed` = 0 AND `inform` = 0 ORDER BY `date` DESC LIMIT 0, 1';
    $res = engine::mysql($query);
    $data = mysqli_fetch_array($res);
    if (!empty($data)) {
        $query = 'SELECT * FROM `nodes_user` WHERE `id` = "'.$data["from"].'"';
        $res = engine::mysql($query);
        $user = mysqli_fetch_array($res);
        if (strlen($data["text"]) > 100) {
            $data["text"] = mb_substr($data["text"], 0, 100)."..";
        }
        if ($user["online"] > date("U") - 600) {
            $online = '<span class="fs11">'.engine::lang("online").'</span>';
        }
        $fout .= '
            <div id="nodes_message">
                <div id="new_msg_img" class="new_msg_img" onClick=\'window.location="'.$_SERVER["DIR"].'/account/inbox/'.$data["from"].'";\'>
                    <img src="'.$_SERVER["DIR"].'/img/pic/'.$user["photo"].'" width=50 /><br/>'.$online.'
                </div>
                <div class="new_msg_close">
                    <div id="new_msg_close" class="close_image" title="'.engine::lang("Close window").'" onClick=\'$id("nodes_message").style.display="none";\'> </div>
                </div>
                <div id="new_msg_name" class="pointer" onClick=\'window.location="'.$_SERVER["DIR"].'/account/inbox/'.$data["from"].'";\'>
                    <div class="new_msg_name">'.$user["name"].'</div>'
                    .$data["text"].'
                </div>
            </div>
            <script>jQuery(\'body\').append(\'<audio id="sound" autoplay preload><source src="'.$_SERVER["DIR"].'/res/sounds/notify.wav" type="audio/wav"></audio>\');</script>';
        $query = 'UPDATE `nodes_inbox` SET `inform` = "1" WHERE `to` = "'.intval($_SESSION["user"]["id"]).'" AND `from` = "'.$data["from"].'"';
        engine::mysql($query);
    }
    return $fout;
}

