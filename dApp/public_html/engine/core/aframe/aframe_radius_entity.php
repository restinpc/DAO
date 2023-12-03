<?php
/**
* Print cardboard radius entity.
* @path /engine/core/aframe/aframe_radius_entity.php
* 
* @name    DAO Mansion    @version 1.0.0
* @author  Aleksandr Vorkunov  <developing@nodes-tech.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*
* @return string Returns content of entity.
* @usage <code> engine::aframe_radius_entity(); </code>
*/
function aframe_radius_entity(){
    $fout = '
    <a-ring id="radius" 
        scale="1 1 1" 
        rotation="-90 0 0" 
        position="0 3 0" 
        radius="0"             
        radius-inner="50" 
        radius-outer="49.8" 
        material="shader: flat; side: both; opacity:1;" 
        color="red">
    </a-ring>';
    return $fout;
}
