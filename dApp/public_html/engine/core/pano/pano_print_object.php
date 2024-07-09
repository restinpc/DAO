<?php
/**
* Prints VR panorama custom object.
* @path /engine/core/pano/pano_print_object.php
*
* @name    DAO Mansion    @version 1.0.3
* @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*
* @var $site->title - Page title.
* @var $site->content - Page HTML data.
* @var $site->keywords - Array meta keywords.
* @var $site->description - Page meta description.
* @var $site->img - Page meta image.
* @var $site->onload - Page executable JavaScript code.
*
* @param object $site Site class object.
* @param string $object Object data.
* @param bool $new Flag to add object as new.
* @return string Returns content of block.
* @usage <code> engine::pano_print_object($site, $object, 1); </code>
*/

function pano_print_object($site, $object, $new = 0) {
    $site->content .= '<a-box
        class="custom_object"
        id="object_'.$object["id"].'" 
        position="'.$object["position"].'" 
        rotation="'.$object["rotation"].'" 
        scale="'.$object["scale"].'"
        opacity="0"
        height="1"
        width="1"
        depth="1"
        color="'.$object["color"].'"
        action=\'
            setTimeout((id) => {
                if ($id("scene_editor") && $id("scene_editor").style.display== "block") {
                    if (!document.panorama.objectId) {
                        jQuery(".vr_object_window").css("display", "none");
                        $id("object_'.$object["id"].'_window").style.display = "block";
                        document.panorama.objectId = "'.$object["id"].'";
                    }
                } else {
                    $id("object_"+id+"_text").setAttribute("opacity", "1");
                    var position = $id("fuse").object3D.getWorldPosition(new THREE.Vector3());
                    $id("object_"+id+"_text").object3D.position.set( position.x, position.y, position.z );
                }
            }, 500, "'.$object["id"].'");
            $id("object_'.$object["id"].'").emit("fused");
        \'
    >
        <a-animation attribute="rotation" begin="fused" dur="500" fill="backwards" to="30 30 180"></a-animation>
    </a-box>';
    if (!$new) {
        $site->content .= '<a-image
            look-at="#camera"
            popup="true"
            trigger="none"
            class="hidden_layer"
            id="object_'.$object["id"].'_text" 
            position="0 9 -10"
            material="color: white;"
            src="data:image/jpeg;base64,'.$object["base64"].'" 
            height="'.($object["height"] /50).'"
            width="'.($object["width"] /50).'" 
            opacity="0"
        ></a-image>';
    }
    if ($_SESSION["user"]["id"] == "1") {
        $fout .= '<div id="object_'.$object["id"].'_window" class="vr_object_window">
            <div style="padding-top:10px; padding-bottom:10px; text-align:center; font-weight:bold;">'.engine::lang("Object properties").'</div><br/>
            <form method="POST" id="object_'.$object["id"].'_form">
                <input id="action_'.$object["id"].'" type="hidden" name="action" value="'.($new ? 'new_object' : 'edit_object').'" />
                <input type="hidden" name="id" value="'.$object["id"].'" />
                '.engine::lang("Text").':<br/>
                <textarea required name="text" class="input w100p">'.$object["text"].'</textarea><br/>
                <br/>
                '.engine::lang("Color").':<br/>
                <input required id="object_'.$object["id"].'_color" name="color" type="text" class="input w100p" value="'.$object["color"].'" /><br/>
                <br/>
                '.engine::lang("Position").':<br/>
                <input required id="object_'.$object["id"].'_position" name="position" type="text" class="input w100p" value="'.$object["position"].'" /><br/>
                <br/>
                '.engine::lang("Rotation").':<br/>
                <input required id="object_'.$object["id"].'_rotation" name="rotation" type="text" class="input w100p" value="'.$object["rotation"].'" /><br/>
                <br/>
                '.engine::lang("Scale").':<br/>
                <input required id="object_'.$object["id"].'_scale" name="scale" type="text" class="input w100p" value="'.$object["scale"].'" /><br/>
                <br/> 
                <input type="button" class="btn w100p" value="'.engine::lang("Apply changes").'" onClick=\'document.panorama.applyChangesObject("'.$object["id"].'");\' />';
        if (!$new) {
            $fout .= '<input type="button" class="btn w100p" value="'.engine::lang("Delete object").'" onClick=\'document.panorama.deleteObject("'.$object["id"].'")\' />';
        }
        $fout .= '<input type="submit" class="btn w100p" value="'.engine::lang("Submit").'" /><br/><br/>
            </form>
        </div>';
        return $fout;
    }
}
