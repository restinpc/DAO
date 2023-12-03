<?php
/**
* Print multiplayer user entity.
* @path /engine/core/aframe/multiplayer_user.php
* 
* @name    DAO Mansion    @version 1.0.0
* @author  Aleksandr Vorkunov  <developing@nodes-tech.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*
* @param object $player @mysql->nodes_aframe_object.
* @return string Returns content of entity.
* @usage <code> engine::multiplayer_user({player}); </code>
*/
function multiplayer_user($player){
    $fout = '<a-entity id="rig" 
        position="'.$player["position"].'"  
        rotation="'.$player["rotation"].'" 
        scale="'.$player["scale"].'">
        '.engine::aframe_default_camera().'
        <a-entity 
            raycaster
            class="collidable"
            id="user_model" 
            collada-model="'.$player["collada-model"].'" 
            position="0 -10 0"  
            rotation="0 0 0">
        </a-entity> 
    </a-entity>';
    return $fout;
}

