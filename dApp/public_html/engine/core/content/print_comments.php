<?php
/**
* Prints comments block.
* @path /engine/core/content/print_comments.php
*
* @name    DAO Mansion    @version 1.0.3
* @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*
* @param string $url Page URL.
* @return string Returns content of page on success, or die with error.
* @usage <code> engine::print_comments("/"); </code>
*/

function print_comment($id, $noreply = 0) {
    $fout = '';
    $fout1 = '';
    $query = 'SELECT * FROM `nodes_comment` WHERE `id` = "'.intval($id).'"';
    $rc = engine::mysql($query);
    $c = mysqli_fetch_array($rc);
    $query = 'SELECT * FROM `nodes_user` WHERE `id` = "'.$c["user_id"].'"';
    $rd = engine::mysql($query);
    $d = mysqli_fetch_array($rd);
    if (!empty($c)) {
        $fout .= '<tr><td align=left valign=top class="comment">
                <div class="comment_image">
                    <a id="comment-user-'.$id.'" hreflang="'.$_SESSION["Lang"].'" href="'.engine::href($_SERVER["DIR"].'/'.$d['url']).'"><img src="'.$_SERVER["DIR"].'/img/pic/'.$d["photo"].'" width=50 /></a>
                </div>
                <div class="comment_div">
                    <strong>'.$d["name"].'</strong> <small>'.date("d/m/Y H:i", $c["date"]).'</small>
                    <div class="comment_text">'.$c["text"].'</div>';
        if ($_SESSION["user"]["id"] == "1" && !$noreply) {
            if ($_SESSION["user"]["id"] == "1") {
                $fout .= '<a id="delete-comment-'.$id.'" class="red" onClick=\'document.framework.deleteComment("'.engine::lang("Are you sure?").'", '.$c["id"]. ')\'>'.engine::lang("Delete").'</a>';
            }
            if (!$noreply) {
                $fout .= ' <a id="reply-comment-'.$id.'" onClick=\'document.framework.addComment("'.engine::lang("Add new comment").'", "'.engine::lang("Submit comment").'", "'.$c["id"].'");\'>'.engine::lang("Reply").'</a><br/>';
            }
        }
        $fout1 .= '<table align=center class="comment_table">';
        $query = 'SELECT * FROM `nodes_comment` WHERE `reply` = "'.$c["id"].'" ORDER BY `id` ASC';
        $rf = engine::mysql($query);
        $flag = 0;
        while ($df = mysqli_fetch_array($rf)) {
            $flag = 1;
            $fout1 .= print_comment($df["id"], 1);
        }
        $fout1 .= '</table>';
        if ($flag) {
            $fout .= $fout1;
        }
        $fout .= '
            </div>
        </td></tr>';
    }
    return $fout;
}

function print_comments($url) {
    $fout = '';
    $fout1 = '';
    $url = trim(str_replace('"', "'", urldecode($url)));
    if (!empty($_POST["comment"])) {
        $text = str_replace('"', "'", htmlspecialchars(strip_tags($_POST["comment"])));
        $text = str_replace("\n", "<br/>", $text);
        $query = 'SELECT * FROM `nodes_comment` WHERE `text` LIKE "'.$text.'" AND `url` LIKE "'.$url.'" AND `user_id` = "'.$_SESSION["user"]["id"].'"';
        $res = engine::mysql($query);
        $data = mysqli_fetch_array($res);
        if (empty($data) && intval($_SESSION["user"]["id"]) > 0) {
            $query = 'INSERT INTO `nodes_comment` (`url`, `reply`, `user_id`, `text`, `date`) '
                . 'VALUES("'.$url.'", "'.intval($_POST["reply"]).'", "'.$_SESSION["user"]["id"].'", "'.$text.'", "'.date("U").'")';
            engine::mysql($query);
            $query = 'SELECT * FROM `nodes_config` WHERE `name` = "send_comments_email"';
            $r_conf = engine::mysql($query);
            $d_conf = mysqli_fetch_array($r_conf);
            if (intval($d_conf["value"])) {
                email::new_comment($_SESSION["user"]["id"], $url);
            }
            $fout .= '<script>alert("'.engine::lang("Comment submited!").'");</script>';
        }
    }
    $flag = 0;
    $fout1 .= '<table align=center class="w100p">';
    $query = 'SELECT * FROM `nodes_comment` WHERE `url` LIKE "'.$url.'" AND `reply` = 0 ORDER BY `id` ASC';
    $res = engine::mysql($query);
    while ($data = mysqli_fetch_array($res)) {
        if (intval($data["id"]) > 0) {
            $fout1 .= print_comment($data["id"]);
            $flag = 1;
        }
    }
    $fout1 .= '</table><br/>';
    if (!empty($_SESSION["user"])) {
        if (!$flag) {
            $fout .= '<br/>'.engine::lang("There is no comments").'<br/><br/>';
        } else {
            $fout .= $fout1;
        }
        $fout .= '<br/>
            <input id="add-comment-btn" type="button" class="btn w280" value="'.engine::lang("Add comment").'" onClick=\'document.framework.addComment("'.engine::lang("Add new comment").'", "'.engine::lang("Submit comment").'");\' /><br/>';
    } else {
        $fout .= '<center>'.engine::lang("To post a comment, please").' <a id="sign-in" hreflang="'.$_SESSION["Lang"].'" href="'.engine::lang($_SERVER["DIR"].'/login').'">'.strtolower(engine::lang("sign in")).'</a> '.strtolower(engine::lang("or")).' <a id="register-now" href="'.$_SERVER["DIR"].'/register" target="account">'.strtolower(engine::lang("register now")).'</a>.</center>';
    }
    return $fout;
}
