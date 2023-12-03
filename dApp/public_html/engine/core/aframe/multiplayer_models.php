<?php
/**
* Generate multiplayer models data.
* @path /engine/core/aframe/multiplayer_models.php
* 
* @name    DAO Mansion    @version 1.0.0
* @author  Aleksandr Vorkunov  <developing@nodes-tech.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*
* @param int $scene_id Scene ID.
* @param int $object_id Object ID.
* @return array Returns array with models data.
* @usage <code> engine::multiplayer_models(1, 1); </code>
*/
function multiplayer_models($scene_id, $object_id){
    $query = 'SELECT * FROM `nodes_aframe_object` WHERE `scene_id` = "'.$scene_id.'" AND `object_id` <> "'.$object_id.'"';
    $res = engine::mysql($query);
    $fout = array();
    while($data = mysqli_fetch_array($res)){
        array_push($fout, $data);
    }
    return $fout;
}
