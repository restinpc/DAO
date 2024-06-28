<?php

function pano_scene_editor($data) {
    $query = 'SELECT * FROM `nodes_vr_project` WHERE `id` = "'.$data["project_id"].'"';
    $res = engine::mysql($query);
    $project = mysqli_fetch_array($res);
    $query = 'SELECT * FROM `nodes_vr_level` WHERE `id` = "'.$data["level_id"].'"';
    $res = engine::mysql($query);
    $level = mysqli_fetch_array($res);
    $fout = '
    <input id="scene_show_editor" type="button" class="btn" value="Show editor" onClick=\'document.panorama.showSceneEditor();\' />
    <div id="scene_editor">
        <form method="POST" id="scene_form">
            <input id="act" type="hidden" name="update" value="'.$data["id"].'" />
            <div><b>'.$project["name"].'</b> / <b>'.$level["name"].'</b></div>
                <br/>
            '.engine::lang("Scene name").':<br/>
            <input required name="name" type="text" class="input w100p" value="'.$data["name"].'" /><br/>
                <br/>
            '.engine::lang("Default camera position").':<br/>
            <input required id="camera_position" name="position" type="text" class="input w100p" value="'.$data["position"].'" /><br/>
                <br/>
            '.engine::lang("Default camera rotation").':<br/>
            <input required id="camera_rotation" name="rotation" type="text" class="input w100p" value="'.$data["rotation"].'" /><br/>
                <br/>
            '.engine::lang("DegMet").':<br/>
            <input required id="degmet" name="degmet" type="number" class="input w100p" value="'.$data["degmet"].'" /><br/>
                <br/>
            '.engine::lang("Height").':<br/>
            <input required id="height" name="height" type="number" class="input w100p" value="'.$data["height"].'" /><br/>
                <br/>
            '.engine::lang("Latitude").':<br/>
            <input required id="scene_lat" name="lat" type="number" class="input w100p" value="'.$data["lat"].'" /><br/>
                <br/>
            '.engine::lang("Longitude").':<br/>
            <input required id="scene_lng" name="lng" type="number" class="input w100p" value="'.$data["lng"].'" /><br/>
                <br/>
            '.engine::lang("Floor position").':<br/>
            <input required id="floor_position" name="floor_position" type="text" class="input w100p" value="'.$data["floor_position"].'" /><br/>
                <br/>
            '.engine::lang("Floor radius").':<br/>
            <input required id="floor_radius" name="floor_radius" type="number" class="input w100p" value="'.$data["floor_radius"].'" /><br/>
                <br/>
            '.engine::lang("Logo size").':<br/>
            <input required id="logo_size" name="logo_size" type="number" class="input w100p" value="'.$data["logo_size"].'" /><br/>
                <br/>
            <input type="button" class="btn w100p" value="'.engine::lang("Apply changes").'" onClick=\'document.panorama.applySceneChanges();\' />
            <input type="button" class="btn w100p" value="'.engine::lang("Load default setting").'" onClick=\'document.panorama.defaultSettings();\' />
            <input type="submit" class="btn w100p" value="'.engine::lang("Save scene settings").'" /><br/>
        </form>
    </div>
    <div style="position:absolute; top:10px; right: 10px; width: 180px; display:none;" id="add_area">        
        <input type="button" class="btn w100p" value="'.engine::lang("Add object").'" onClick=\'document.panorama.addObject();\' />
        <input type="button" class="btn w100p" value="'.engine::lang("Add navigation").'" onClick=\'document.panorama.addNavigation();\' />
        <input type="button" class="btn w100p" value="'.engine::lang("Add link").'" onClick=\'document.panorama.addURL();\' />
        <input type="button" class="btn w100p" value="'.engine::lang("Reset scene objects").'" onClick=\'document.panorama.resetSceneObjects('.$data["id"].');\' />
    </div>';
    return $fout;
}

