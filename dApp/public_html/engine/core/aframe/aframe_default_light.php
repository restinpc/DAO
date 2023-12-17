<?php
/**
* Print cardboard light entity.
* @path /engine/core/aframe/aframe_default_light.php
*
* @name    DAO Mansion    @version 1.0.2
* @author  Aleksandr Vorkunov  <developing@nodes-tech.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*
* @return string Returns content of entity.
* @usage <code> engine::aframe_default_light(); </code>
*/
function aframe_default_light(){
    $fout = '<a-light color="#fff" type="ambient"></a-light>
            <a-light color="#fff" type="point" position="30 30 30" intensity="0.3"></a-light>';
    return $fout;
}
