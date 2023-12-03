<?php
/**
* Print cardboard collada model.
* @path /engine/core/aframe/aframe_collada_entity.php
* 
* @name    DAO Mansion    @version 1.0.0
* @author  Aleksandr Vorkunov  <developing@nodes-tech.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*
* @param string $id Site class object.
* @param string $collada_model Scene caption.
* @param string $position Scene URL.
* @param string $rotation Scene preview image.
* @param string $scale Model scale.
* @return string Returns content of entity.
* @usage <code> engine::aframe_collada_entity(1, "/res/models/*.collada"); </code>
*/
function aframe_collada_entity(
        $id, 
        $collada_model,
        $position="0 0 0", 
        $rotation="0 0 0",
        $scale="1 1 1"
    ){
    $fout = '<a-entity 
        id="'.$id.'" 
        raycaster="objects: .collidable;"
        collada-model="'.$collada_model.'"
        rotation="'.$rotation.'"
        position="'.$position.'"
        scale="'.$scale.'"
        nodes-static>
    </a-entity>';
    return $fout;
}

