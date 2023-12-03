<?php
/**
* Generate multiplayer lobby data.
* @path /engine/core/aframe/multiplayer_lobby.php
* 
* @name    DAO Mansion    @version 1.0.0
* @author  Aleksandr Vorkunov  <developing@nodes-tech.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*
* @param string $scene_id Scene ID.
* @return string Returns lobby data.
* @usage <code> engine::multiplayer_lobby(1); </code>
*/
function multiplayer_lobby($scene_id){
    $query = 'SELECT * FROM `nodes_aframe_lobby` WHERE `last` > "'.(date("U")-600).'" AND `active` = 1 AND `scene_id` = "'.$scene_id.'"';
    $res = engine::mysql($query);
    $lobby = mysqli_fetch_array($res);
    if(empty($lobby)){
        $query = 'INSERT INTO `nodes_aframe_lobby`(`scene_id`, `user_id`, `users`, `date`, `last`, `active`) '
                . 'VALUES("1", "'.$_SESSION["user"]["id"].'", "'.$_SESSION["user"]["id"].':1:'.date("U").';", "'.date("U").'", "'.date("U").'", 1)';
        engine::mysql($query);
        $query = 'SELECT * FROM `nodes_aframe_lobby` WHERE `id` = "'.mysqli_insert_id($_SERVER["sql_connection"]).'"';
        $res = engine::mysql($query);
        $lobby = mysqli_fetch_array($res);
    }else{
        $users = explode(';', $lobby["users"]);
        $query = 'SELECT * FROM `nodes_aframe_object` WHERE `scene_id` = "'.$scene_id.'" AND `type` = 1 ORDER BY `id` ASC';
        $res = engine::mysql($query);
        while($data = mysqli_fetch_array($res)){
            $flag = 1;
            for($i = 0; $i < count($users); $i++){
                if(!empty($users[$i])){
                    $user = explode(':', $users[$i]);
                    if($user[0] == $_SESSION["user"]["id"]){
                        $flag = -1;
                        break;
                    }else if($data["object_id"] == $user[1]){
                        $flag = 0;
                        break;
                    }
                }
            }
            if($flag>0){
                $query = 'UPDATE `nodes_aframe_lobby` SET `users` = "'.$lobby["users"].''.$_SESSION["user"]["id"].':'.$data["object_id"].':'.date("U").';"';
                engine::mysql($query);
                break;
            }
        }
        $query = 'SELECT * FROM `nodes_aframe_lobby` WHERE `id` = "'.$lobby["id"].'"';
        $res = engine::mysql($query);
        $lobby = mysqli_fetch_array($res);
    }
    return $lobby;
}
