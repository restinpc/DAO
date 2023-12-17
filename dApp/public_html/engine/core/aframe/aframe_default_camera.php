<?php
/**
* Print cardboard camera entity.
* @path /engine/core/aframe/aframe_default_camera.php
*
* @name    DAO Mansion    @version 1.0.2
* @author  Aleksandr Vorkunov  <developing@nodes-tech.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*
* @return string Returns content of entity.
* @usage <code> engine::aframe_default_camera(); </code>
*/
function aframe_default_camera(){
    $fout = '
    <a-camera id="camera" 
        nodes-camera 
        position="0 0 0" 
        rotation="0 0 0"
        data-aframe-default-camera        
        wasd-controls-enabled="true"
        universal-controls="movementControls: hmd; rotationControls: touch-rotation"
        animation="property: position; dur: 1000; to: 0 0 0; startEvents: respawn;">
        <a-cursor id="cursor"
            position="0 0 -3" material="color: white; shader: flat; opacity: 0.1;"
            geometry="primitive: ring; radiusInner: 0.08; radiusOuter: 0.1; theta-length: 360;">
            <a-animation id="nodes_fuse" begin="cursor-fusing" attribute="geometry.radiusInner" dur="2000" from="0.08" to="0.01"></a-animation>
            <a-animation id="nodes_unfuse" begin="cursor-unfusing" attribute="geometry.radiusInner" dur="200" to="0.08"></a-animation>
       </a-cursor>
    </a-camera>';
    return $fout;
}
// wasd-controls="acceleration: 500"
