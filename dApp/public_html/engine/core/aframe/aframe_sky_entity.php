<?php
/**
* Print cardboard spherical sky entity.
* @path /engine/core/aframe/aframe_sky_entity.php
* 
* @name    DAO Mansion    @version 1.0.0
* @author  Aleksandr Vorkunov  <developing@nodes-tech.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*
* @param string $id Entity ID.
* @param string $src Image URL.
* @param int $width Image width.
* @param int $height Image height.
* @param int $radius Sphere radius.
* @param rgb $color Image color.
* @return string Returns content of entity.
* @usage <code> engine::aframe_sky_entity(1, "/img/vr/sky.jpg"); </code>
*/
function aframe_sky_entity($id, $src, $width="2048", $height="1024", $radius=150, $color=""){
    $fout = '<a-sky id="'.$id.'"
        geometry="primitive: sphere; radius: '.$radius.'; phiLength: 360; phiStart: 0; thetaLength: 180;"
        material="shader: flat; side: back; height: '.$height.'; width: '.$width.'; opacity: 1;"
        src="'.$src.'"></a-sky>';
    return $fout;
}
