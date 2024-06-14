<?php

function pano_link($site, $object, $new=0){
    $site->content .= '<a-image transparent="true" look-at="#camera" 
        action=\' 
            setTimeout(function(id){
                if($id("scene_editor") && $id("scene_editor").style.display=="block"){
                    if(!object_id){
                        jQuery(".vr_object_window").css("display", "none");
                        $id("url_'.$object["id"].'_window").style.display = "block";
                        object_id = "'.$object["id"].'";
                    }
                }else{
                    window.location = "'.$object["url"].'";
                }
            }, 500, "'.$object["id"].'"); \' '
            . 'id="url_'.$object["id"].'" '
            . 'position="'.$object["position"].'" '
            . 'scale="'.$object["scale"].'" '
            . 'rotation="0 0 0"  '
            . ' class="custom_object"'
            . 'opacity="0"'
            . 'width="1" height="1" '
            . 'src="#google"></a-image>';
    if($_SESSION["user"]["id"] == "1"){
        $fout .= '
        <div id="url_'.$object["id"].'_window"  class="vr_object_window">
            <div style="padding-top:10px; padding-bottom:10px; text-align:center; font-weight:bold;">Link properties</div><br/>
            <form method="POST" id="url_'.$object["id"].'_form">
                <input id="action_'.$object["id"].'" type="hidden" name="action" value="'.($new?'new_url':'edit_url').'" />
                <input type="hidden" name="id" value="'.$object["id"].'" />
                Position:<br/>
                <input required id="url_'.$object["id"].'_position" name="position" type="text" class="input w100p" value="'.$object["position"].'" /><br/>
                    <br/>
                Scale:<br/>
                <input required id="url_'.$object["id"].'_scale" name="scale" type="text" class="input w100p" value="'.$object["scale"].'" /><br/>
                    <br/>   
                URL:<br/>
                <input required id="url_'.$object["id"].'_url" name="url" type="text" class="input w100p" value="'.$object["url"].'" /><br/>
                    <br/> 
                    <br/>
                    <br/>
                <input type="button" class="btn w100p" value="Apply chages" onClick=\'apply_changes_url("'.$object["id"].'");\' />';
        if(!$new){
            $fout .= '<input type="button" class="btn w100p" value="Delete Link" onClick=\'delete_url("'.$object["id"].'")\' />';
        }
        $fout .= '        
                <input type="submit" class="btn w100p" value="Submit" /><br/><br/>
            </form>
        </div>';
        return $fout;
    }
}