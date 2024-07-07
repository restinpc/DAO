<?php
/**
* Prints VR panorama cursor.
* @path /engine/core/pano/pano_vr_cursor.php
*
* @name    DAO Mansion    @version 1.0.3
* @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*/

function pano_vr_cursor() {
    $fout = '<a-circle id="marker" position="0 0 -10" material="color: white; shader: flat; opacity: 0;" radius="0.1"></a-circle>
        <a-circle id="fuse" position="0 0 -10"
            material="color: #20565E; shader: flat; opacity: 1;"
            geometry="primitive: ring; radiusInner: 0.1; radiusOuter: 0.15; theta-start: 0; theta-length: 0;"
        >
            <a-animation begin="cursor-fusing" end="cursor-stop-fusing" attribute="geometry.thetaLength" dur="2000" from="0" to="360"></a-animation>
            <a-animation begin="cursor-unfusing" attribute="geometry.thetaLength" dur="100" to="0"></a-animation>
        </a-circle>
        <a-entity id="vr_point" position="0 0 -100"></a-entity>
        <a-entity id="ray" position="1 0 0" raycaster="far: 500"></a-entity>';
    return $fout;
}
