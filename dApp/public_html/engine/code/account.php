<?php
/**
* User identity system script.
* @path /engine/code/account.php
*
* @name    DAO Mansion    @version 1.0.0
* @author  Aleksandr Vorkunov  <developing@nodes-tech.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*/
require_once("engine/nodes/headers.php");
require_once("engine/nodes/session.php");
if($_GET["mode"] == "remember" && !empty($_GET["email"]) && !empty($_GET["code"])){
    $email = urldecode($_GET["email"]);
    $query = 'SELECT * FROM `nodes_user` WHERE `email` = "'.$email.'"';
    $res = engine::mysql($query);
    $data = mysqli_num_rows($res);
    if($data){
        $code = substr(md5($email.date("Y-m-d")), 0, 4);
        if($code == $_GET["code"]){
            $new_pass = substr(md5($email.date("Y-m-d")), 0, 8);
            $new_pass_data = engine::encode_password($new_pass);
            $query = 'UPDATE `nodes_user` SET `pass` = "'.$new_pass_data["pass"].'", `salt` = "'.$new_pass_data["salt"].'" WHERE `email` = "'.$email.'"';
            engine::mysql($query);
            echo '<div class="center pt100">'.lang("New password activated!").'</div>
                    <script>function redirect(){parent.window.location="'.$_SERVER["DIR"].'/login";}setTimeout(redirect, 3000);</script>';
        }else{
            echo '<div class="center pt100">'.lang("Invalid confirmation code").'.</div>'
             . '<script>function redirect(){parent.window.location="'.$_SERVER["DIR"].'/login";}setTimeout(redirect, 3000);</script>';  
        }
    }else{
       echo '<div class="center pt100">Email '.lang("not found").'.</div>'
        . '<script>function redirect(){parent.window.location="'.$_SERVER["DIR"].'/login";}setTimeout(redirect, 3000);</script>';  
    }
}else if($_GET["mode"] == "social" && !empty($_GET["method"])){ 
    if($_GET["method"]=="fb"){
        require_once("engine/api/oauth/fb_auth.php");
    }else if($_GET["method"]=="vk"){
        require_once("engine/api/oauth/vk_auth.php");
    }else if($_GET["method"]=="tw"){
        require_once("engine/api/oauth/twitter_auth.php");
    }else if($_GET["method"]=="gp"){
        require_once("engine/api/oauth/google_auth.php");
    }
}else if($_GET["mode"] == "logout"){ 
    $query = 'UPDATE `nodes_user` SET `token` = "" WHERE `id` = "'.$_SESSION["user"]["id"].'"';
    engine::mysql($query);
    unset($_SESSION["user"]);
    unset($_COOKIE['token']);
    setcookie('token', null, -1, '/');
    session_destroy();
    die('<script language="JavaScript">parent.window.location = "'.$_SERVER["DIR"].'/";</script>');
}else engine::error(404);
