<?php

function pano_print_object($site, $object, $new=0){
    $site->content .= '
    <a-box class="custom_object" id="object_'.$object["id"].'" 
        position="'.$object["position"].'" 
        rotation="'.$object["rotation"].'" 
        scale="'.$object["scale"].'"
        opacity="0"
        height="1" width="1" depth="1" color="'.$object["color"].'"  
        onMouseOver=\'console.log("123");\'
        action=\'
            setTimeout(function(id){
                if($id("scene_editor") && $id("scene_editor").style.display=="block"){
                    if(!object_id){
                        jQuery(".vr_object_window").css("display", "none");
                        $id("object_'.$object["id"].'_window").style.display = "block";
                        object_id = "'.$object["id"].'";
                    }
                }else{
                    $id("object_"+id+"_text").setAttribute("opacity", "1");
                    var position = $id("fuse").object3D.getWorldPosition(new THREE.Vector3());
                    $id("object_"+id+"_text").object3D.position.set( position.x, position.y, position.z );
                }
            }, 500, "'.$object["id"].'");
            $id("object_'.$object["id"].'").emit("fused");
        \'>
        <a-animation attribute="rotation" begin="fused" dur="500" fill="backwards" to="30 30 180"></a-animation>
    </a-box>';
    if(!$new){
        $site->content .= '
        <a-image look-at="#camera" popup="true" trigger="none" class="hidden_layer" id="object_'.$object["id"].'_text"  position="0 9 -10"
            material="color: white;" src="data:image/jpeg;base64,'.$object["base64"].'" 
            height="'.($object["height"]/50).'" width="'.($object["width"]/50).'" opacity="0">
        </a-image>';
    }
    if($_SESSION["user"]["id"] == "1"){
        $fout .= '
        <div id="object_'.$object["id"].'_window"  class="vr_object_window">
            <div style="padding-top:10px; padding-bottom:10px; text-align:center; font-weight:bold;">Object properties</div><br/>
            <form method="POST" id="object_'.$object["id"].'_form">
                <input id="action_'.$object["id"].'" type="hidden" name="action" value="'.($new?'new_object':'edit_object').'" />
                <input type="hidden" name="id" value="'.$object["id"].'" />
                Text:<br/>
                <textarea required name="text"  class="input w100p">'.$object["text"].'</textarea><br/>
                    <br/>
                Color:<br/>
                <input required id="object_'.$object["id"].'_color" name="color" type="text" class="input w100p" value="'.$object["color"].'" /><br/>
                    <br/>
                Position:<br/>
                <input required id="object_'.$object["id"].'_position" name="position" type="text" class="input w100p" value="'.$object["position"].'" /><br/>
                    <br/>
                Rotation:<br/>
                <input required id="object_'.$object["id"].'_rotation" name="rotation" type="text" class="input w100p" value="'.$object["rotation"].'" /><br/>
                    <br/>
                Scale:<br/>
                <input required id="object_'.$object["id"].'_scale" name="scale" type="text" class="input w100p" value="'.$object["scale"].'" /><br/>
                    <br/>   
                <input type="button" class="btn w100p" value="Apply chages" onClick=\'apply_changes_object("'.$object["id"].'");\' />';
        if(!$new){
            $fout .= '<input type="button" class="btn w100p" value="Delete object" onClick=\'delete_object("'.$object["id"].'")\' />';
        }
        $fout .= '        
                <input type="submit" class="btn w100p" value="Submit" /><br/><br/>
            </form>
        </div>';
        return $fout;
    }
}