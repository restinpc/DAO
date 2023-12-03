<?php
/**
* Generate multiplayer player data.
* @path /engine/core/aframe/multiplayer_player.php
* 
* @name    DAO Mansion    @version 1.0.0
* @author  Aleksandr Vorkunov  <developing@nodes-tech.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*
* @param int $lobby_id @mysql->nodes_aframe_lobby.
* @return object Returns player data.
* @usage <code> engine::multiplayer_player(1); </code>
*/
function multiplayer_player($lobby_id){
    $query = 'SELECT * FROM `nodes_aframe_lobby` WHERE `id` = "'.$lobby_id.'"';
    $res = engine::mysql($query);
    $lobby = mysqli_fetch_array($res);
    $users = explode(';', $lobby["users"]);
    $id = 0;
    foreach($users as $data){
        $user = explode(':', $data);
        if($user[0] == $_SESSION["user"]["id"]){
            $id = $user[1];
            break;
        }
    }
    $query = 'SELECT * FROM `nodes_aframe_object` WHERE `object_id` = "'.$id.'"';
    $res = engine::mysql($query);
    $data = mysqli_fetch_array($res);
    $position = explode(" ", $data["position"]);
    $rotation = explode(" ", $data["rotation"]);
    $scale = explode(" ", $data["scale"]);
    $player = array(
        "user_id" => intval($_SESSION["user"]["id"]),
        "model" => $id,
        "position" => ($position[0])." ".($position[1]+10)." ".($position[2]),
        "model-position" => $data["position"],
        "rotation" => $data["rotation"],
        "scale" => "1 1 1",
        "collada-model" => $data["collada-model"]
    );
    return $player;
}
