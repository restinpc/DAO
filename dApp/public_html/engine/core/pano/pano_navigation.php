<?php

function pano_navigation($site, $object, $new=0){
    $site->content .= '<a-image transparent="true" class="hotpoint" look-at="#camera" 
        action=\' 
            setTimeout(function(id){
                if('.($_SESSION["user"]["id"]==1?'1':'0').' && $id("scene_editor").style.display=="block"){
                    if(!document.panorama.objectId){
                        jQuery(".vr_object_window").css("display", "none");
                        $id("point_'.$object["id"].'_window").style.display = "block";
                        document.panorama.objectId = "'.$object["id"].'";
                    }
                }else{
                    '.($object["target"]?'document.panorama.loadScene("'.$object["target"].'", "point_'.$object["id"].'")':'').'
                }
            }, 500, "'.$object["id"].'"); 
                \' '
            . 'id="point_'.$object["id"].'" '
            . 'position="'.$object["position"].'" '
            . 'scale="'.$object["scale"].'" '
            . 'rotation="0 0 0" '
            . 'opacity="0" '
            . 'width="1" height="1" '
            . 'src="#hotspot"></a-image>';
    if ($_SESSION["user"]["id"] == "1"){
        $fout .= '
        <div id="point_'.$object["id"].'_window"  class="vr_object_window">
            <div style="padding-top:10px; padding-bottom:10px; text-align:center; font-weight:bold;">Point properties</div><br/>
            <form method="POST" id="object_'.$object["id"].'_form">
                <input id="action_'.$object["id"].'" type="hidden" name="action" value="'.($new?'new_point':'edit_point').'" />
                <input type="hidden" name="id" value="'.$object["id"].'" />
                Position:<br/>
                <input required id="point_'.$object["id"].'_position" name="position" type="text" class="input w100p" value="'.$object["position"].'" /><br/>
                    <br/>
                Scale:<br/>
                <input required id="point_'.$object["id"].'_scale" name="scale" type="text" class="input w100p" value="'.$object["scale"].'" /><br/>
                    <br/>   
                Target:<br/>
                <select required id="point_'.$object["id"].'_target" name="target"  class="input w100p lh2">';
        $query = 'SELECT * FROM `nodes_vr_scene` WHERE `level_id` = "'.$object["level_id"].'" AND `id` <> "'.$object["scene_id"].'"';
        $res = engine::mysql($query);
        while($data = mysqli_fetch_array($res)){
            if($object["target"] == $data["id"]){
                $fout .= '<option value="'.$data["id"].'" selected>'.$data["name"].':'.$data["id"].'</option>';
            }else{
                $fout .= '<option value="'.$data["id"].'">'.$data["name"].':'.$data["id"].'</option>';
            }
        }
        $fout .= '</select>
                    <br/>
                    <br/>
                <input type="button" class="btn w100p" value="'.engine::lang("Apply chages").'" onClick=\'document.panorama.applyChangesNavigation("'.$object["id"].'");\' />';
        if(!$new){
            $fout .= '<input type="button" class="btn w100p" value="'.engine::lang("Delete point").'" onClick=\'document.panorama.deleteNavigation("'.$object["id"].'")\' />';
        }
        $fout .= '        
                <input type="submit" class="btn w100p" value="'.engine::lang("Submit").'" /><br/><br/>
            </form>
        </div>';
        return $fout;
    }
}
