<?php
/**
* Converts text HTML element to object.
* @path /engine/core/function/element_to_obj.php
*
* @name    DAO Mansion    @version 1.0.3
* @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*
* @param string $element HTML text element.
* @return string Returns object version of text.
* @usage <code> engine::element_to_obj('<div/>'); </code>
*/

function element_to_obj($element) {
    $obj = array("tag" => $element->tagName);
    foreach($element->attributes as $attribute) {
        $obj[$attribute->name] = $attribute->value;
    }
    foreach($element->childNodes as $subElement) {
        if ($subElement->nodeType == XML_TEXT_NODE) {
            $obj["html"] = $subElement->wholeText;
        } else {
            $obj["children"][] = engine::element_to_obj($subElement);
        }
    }
    return $obj;
}
