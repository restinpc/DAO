<?php
/**
* Converts text HTML elements to object.
* @path /engine/core/function/html_to_obj.php
*
* @name    DAO Mansion    @version 1.0.3
* @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*
* @param string $html HTML DOM text.
* @return string Returns DOM version of text.
* @usage <code> engine::html_to_obj('<div><br/></div>'); </code>
*/

function html_to_obj($html) {
    $dom = new DOMDocument();
    $dom->loadHTML($html);
    return engine::element_to_obj($dom->documentElement);
}
