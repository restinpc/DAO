<?php

function pano_scene_editor($data){
    $query = 'SELECT * FROM `vr_project` WHERE `id` = "'.$data["project_id"].'"';
    $res = engine::mysql($query);
    $project = mysqli_fetch_array($res);
    $query = 'SELECT * FROM `vr_level` WHERE `id` = "'.$data["level_id"].'"';
    $res = engine::mysql($query);
    $level = mysqli_fetch_array($res);
    $fout = '
    <input id="scene_show_editor" type="button" class="btn" value="Show editor" onClick=\'show_scene_editor();\' />
    <div id="scene_editor">
        <form method="POST" id="scene_form">
            <input id="act" type="hidden" name="update" value="'.$data["id"].'" />
            <div><b>'.$project["name"].'</b> / <b>'.$level["name"].'</b></div>
                <br/>
            Scene name:<br/>
            <input required name="name" type="text" class="input w100p" value="'.$data["name"].'" /><br/>
                <br/>
            Default camera position:<br/>
            <input required id="camera_position" name="position" type="text" class="input w100p" value="'.$data["position"].'" /><br/>
                <br/>
            Default camera rotation:<br/>
            <input required id="camera_rotation" name="rotation" type="text" class="input w100p" value="'.$data["rotation"].'" /><br/>
                <br/>
            DegMet:<br/>
            <input required id="degmet" name="degmet" type="number" class="input w100p" value="'.$data["degmet"].'" /><br/>
                <br/>
            Height:<br/>
            <input required id="height" name="height" type="number" class="input w100p" value="'.$data["height"].'" /><br/>
                <br/>
            Latitude:<br/>
            <input required id="scene_lat" name="lat" type="number" class="input w100p" value="'.$data["lat"].'" /><br/>
                <br/>
            Longitude:<br/>
            <input required id="scene_lng" name="lng" type="number" class="input w100p" value="'.$data["lng"].'" /><br/>
                <br/>
            Floor position:<br/>
            <input required id="floor_position" name="floor_position" type="text" class="input w100p" value="'.$data["floor_position"].'" /><br/>
                <br/>
            Floor radius:<br/>
            <input required id="floor_radius" name="floor_radius" type="number" class="input w100p" value="'.$data["floor_radius"].'" /><br/>
                <br/>
            Logo size:<br/>
            <input required id="logo_size" name="logo_size" type="number" class="input w100p" value="'.$data["logo_size"].'" /><br/>
                <br/>

            <input type="button" class="btn w100p" value="Apply changes" onClick=\'apply_scene_changes();\' />
            <input type="button" class="btn w100p" value="Load default setting" onClick=\'default_settings();\' />
            <input type="submit" class="btn w100p" value="Save scene settings" /><br/>
        </form>
    </div>
    <div style="position:absolute; top:10px; right: 10px; width: 180px; display:none;" id="add_area">        
        <input type="button" class="btn w100p" value="Add new object" onClick=\'add_object();\' />
        <input type="button" class="btn w100p" value="Add new navigation" onClick=\'add_navigation();\' />
        <input type="button" class="btn w100p" value="Add new link" onClick=\'add_url();\' />
        <input type="button" class="btn w100p" value="Reset scene objects" onClick=\'reset_scene_object('.$data["id"].');\' />
    </div>';
    return $fout;
}

