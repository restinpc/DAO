<?php
require_once("engine/nodes/headers.php");
require_once("engine/nodes/session.php");

class site { public $content; }
$_SESSION["redirect"] = $_SERVER["SCRIPT_URI"];
if(!empty($_GET["id"])){
    $id = intval($_GET["id"]);
    $query = 'SELECT * FROM `vr_scene` WHERE `id` = "'.$id.'"';
    $res = engine::mysql($query);
    $data = mysqli_fetch_array($res);
    if(empty($data)) engine::error();
    if(!empty($_POST["update"]) && $_SESSION["user"]["id"] == 1){
        $id = intval($_POST["update"]);
        $name = engine::escape_string($_POST["name"]);
        $position = engine::escape_string($_POST["position"]);
        $rotation = engine::escape_string($_POST["rotation"]);
        $lat = floatval($_POST["lat"]);
        $lng = floatval($_POST["lng"]);
        $degmet = floatval($_POST["degmet"]);
        $height = floatval($_POST["height"]);
        $floor_position = engine::escape_string($_POST["floor_position"]);
        $floor_radius = floatval($_POST["floor_radius"]);
        $logo_size = floatval($_POST["logo_size"]);
        $query = 'UPDATE `vr_scene` SET '
            . '`name` = "'.$name.'", '
            . '`position` = "'.$position.'", '
            . '`rotation` = "'.$rotation.'", '
            . '`height` = "'.$height.'", '
            . '`degmet` = "'.$degmet.'", '
            . '`lat` = "'.$lat.'", '
            . '`lng` = "'.$lng.'", '
            . '`floor_position` = "'.$floor_position.'", '
            . '`floor_radius` = "'.$floor_radius.'", '
            . '`logo_size` = "'.$logo_size.'" '
            . 'WHERE `id` = "'.$id.'"';
        engine::mysql($query);
        $query = 'SELECT * FROM `vr_scene` WHERE `id` = "'.$id.'"';
        $res = engine::mysql($query);
        $data = mysqli_fetch_array($res);
    }else if(!empty($_POST["default"]) && $_SESSION["user"]["id"] == 1){
        $id = intval($_POST["default"]);
        $query = 'UPDATE `vr_scene` SET '
            . '`position` = "0 3 0", '
            . '`rotation` = "0 0 0", '
            . '`degmet` = "1", '
            . '`floor_position` = "0 -2 0", '
            . '`floor_radius` = "20", '
            . '`logo_size` = "3" '
            . 'WHERE `id` = "'.$id.'"';
        engine::mysql($query);
        $query = 'SELECT * FROM `vr_scene` WHERE `id` = "'.$id.'"';
        $res = engine::mysql($query);
        $data = mysqli_fetch_array($res);
    }else if(!empty($_POST["action"]) && !empty($_POST["id"]) && $_POST["action"] == "edit_object"){
        $id = intval($_POST["id"]);
        $text = $_POST["text"];
        $color = engine::escape_string($_POST["color"]);
        $position = engine::escape_string($_POST["position"]);
        $rotation = engine::escape_string($_POST["rotation"]);
        $scale = engine::escape_string($_POST["scale"]);
        $request = $_SERVER["PUBLIC_URL"].'/text.php?text='.urlencode($text);
        $img = file_get_contents($request);
        $image = getimagesizefromstring($img);
        $width = $image[0];
        $height = $image[1];
        $base64 = base64_encode($img);
        $query = 'UPDATE `vr_object` SET'
            . '`text` = "'.$text.'", '
            . '`color` = "'.$color.'", '
            . '`position` = "'.$position.'", '
            . '`rotation` = "'.$rotation.'", '
            . '`scale` = "'.$scale.'", '
            . '`width` = "'.$width.'", '
            . '`height` = "'.$height.'", '
            . '`base64` = "'.$base64.'" '
            . 'WHERE `id` = "'.$id.'"';
        engine::mysql($query);
    }else if(!empty($_POST["action"]) && !empty($_POST["id"]) && $_POST["action"] == "delete_object"){
        $id = intval($_POST["id"]);
        $query = 'DELETE FROM `vr_object` WHERE `id` = "'.$id.'"';
        engine::mysql($query);
    }else if(!empty($_POST["action"]) && $_POST["action"] == "new_object"){
        $text = $_POST["text"];
        $color = engine::escape_string($_POST["color"]);
        $position = engine::escape_string($_POST["position"]);
        $rotation = engine::escape_string($_POST["rotation"]);
        $scale = engine::escape_string($_POST["scale"]);
        $request = $_SERVER["PUBLIC_URL"].'/text.php?text='.urlencode($text);
        $img = file_get_contents($request);
        $image = getimagesizefromstring($img);
        $width = $image[0];
        $height = $image[1];
        $base64 = base64_encode($img);
        $query = 'INSERT INTO `vr_object`(`project_id`, `level_id`, `scene_id`, `text`, `width`, `height`, `color`, `base64`, `position`, `rotation`, `scale`) '
            . 'VALUES("'.$data["project_id"].'", "'.$data["level_id"].'", "'.$data["id"].'", "'.$text.'", "'.$width.'", "'.$height.'", "'.$color.'", "'.$base64.'", "'.$position.'", "'.$rotation.'", "'.$scale.'")';
        engine::mysql($query);
    }else if(!empty($_POST["action"]) && $_POST["action"] == "new_point"){
        $position = engine::escape_string($_POST["position"]);
        $scale = engine::escape_string($_POST["scale"]);
        $target = intval($_POST["target"]);
        $query = 'INSERT INTO `vr_navigation`(`project_id`, `level_id`, `scene_id`, `target`, `position`, `scale`) '
            . 'VALUES("'.$data["project_id"].'", "'.$data["level_id"].'", "'.$data["id"].'", "'.$target.'", "'.$position.'", "'.$scale.'")';
        engine::mysql($query);
    }else if(!empty($_POST["action"]) && $_POST["action"] == "edit_point" && !empty($_POST["id"])){
        $id = intval($_POST["id"]);
        $position = engine::escape_string($_POST["position"]);
        $scale = engine::escape_string($_POST["scale"]);
        $target = intval($_POST["target"]);
        $query = 'UPDATE `vr_navigation` SET '
            . '`position` = "'.$position.'", '
            . '`scale` = "'.$scale.'", '
            . '`target` = "'.$target.'" '
            . 'WHERE `id` = "'.$id.'"';
        engine::mysql($query);
    }else if(!empty($_POST["action"]) && !empty($_POST["id"]) && $_POST["action"] == "delete_point"){
        $id = intval($_POST["id"]);
        $query = 'DELETE FROM `vr_navigation` WHERE `id` = "'.$id.'"';
        engine::mysql($query);
    }else if(!empty($_POST["action"]) && $_POST["action"] == "new_url"){
        $position = engine::escape_string($_POST["position"]);
        $scale = engine::escape_string($_POST["scale"]);
        $url = engine::escape_string($_POST["url"]);
        $query = 'INSERT INTO `vr_link`(`project_id`, `level_id`, `scene_id`, `url`, `position`, `scale`) '
            . 'VALUES("'.$data["project_id"].'", "'.$data["level_id"].'", "'.$data["id"].'", "'.$url.'", "'.$position.'", "'.$scale.'")';
        engine::mysql($query);
    }else if(!empty($_POST["action"]) && $_POST["action"] == "edit_url" && !empty($_POST["id"])){
        $id = intval($_POST["id"]);
        $position = engine::escape_string($_POST["position"]);
        $scale = engine::escape_string($_POST["scale"]);
        $url = engine::escape_string($_POST["url"]);
        $query = 'UPDATE `vr_link` SET '
            . '`position` = "'.$position.'", '
            . '`scale` = "'.$scale.'", '
            . '`url` = "'.$url.'" '
            . 'WHERE `id` = "'.$id.'"';
        engine::mysql($query);
    }else if(!empty($_POST["action"]) && !empty($_POST["id"]) && $_POST["action"] == "delete_url"){
        $id = intval($_POST["id"]);
        $query = 'DELETE FROM `vr_link` WHERE `id` = "'.$id.'"';
        engine::mysql($query);
    }
    $onload = '';
    $fout = '<script src="'.$_SERVER["DIR"].'/script/aframe/panorama.js" type="text/javascript"></script>
    <div id="nodes_vr_scene">
    <a-scene id="nodes_scene" scene-id="'.$data["id"].'" vr-mode-ui="enabled: true;" device-orientation-permission-ui background="color: #fff;" >
        <a-assets>
            <img id="logo" src="'.$_SERVER["PUBLIC_URL"].'/img/vr_logo.png" crossorigin="anonymous" />
            <img id="hotspot" src="'.$_SERVER["PUBLIC_URL"].'/img/hotpoint.png" crossorigin="anonymous" />
            <img id="google" src="'.$_SERVER["PUBLIC_URL"].'/img/gsv.png" crossorigin="anonymous" />
            <img id="pixel" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII=" />';
    $query = 'SELECT * FROM `vr_scene` WHERE `id` = "'.$data["id"].'"';
    $r = engine::mysql($query);

    while($dd = mysqli_fetch_array($r)){
        $json = json_decode($dd["cubemap"]);
        foreach($json as $key=>$value){
            $id = str_replace($data["id"].'x', '', $value);
            $img = $data["id"].'/'.str_replace($data["id"].'x', '', $value);
            $id = str_replace('.png', '', $value);
        }
    }
    $sides = Array("pz", "nz", "px", "nx", "py", "ny");
    $rotations = Array("0 0 0", "0 -180 0", "0 -90 0", "0 90 0", "90 0 0", "-90 0 0");
    $json = json_decode($data["cubemap"]);

    $fout .= '
        </a-assets>
        <a-entity id="rig" 
            position="'.$data["position"].'" 
            rotation="'.$data["rotation"].'">
            <a-camera id="camera" 
                look-controls
                mouse-cursor
                nodes-camera   
                wasd-controls-enabled="false">
                '.engine::pano_vr_cursor().'
            </a-camera>
        </a-entity>
        <a-sky id="sky_back" position="0 0 0" rotation="0 0 0" radius="500" opacity="1"></a-sky>
        <a-entity id="cubemap_0" position="0 0 0" scale="1.03 1.03 1.03">';
    $q = 1;
    $s = 512;
    $t = 1;
    $w = $s/2;
    $x = $q*$s/2;
    for($l = 0; $l< count($sides); $l++){
        $side = $sides[$l];
        $rotation_img = $rotations[$l];
        for($i = 0; $i < $q; $i++){
            for($j = 0; $j < $q; $j++){
                $id = ($i*$q+$j);
                if($side == "pz"){
                    $i_1 = (-$x+$i*$s+$w);
                    $j_1 = ($x-$j*$s-$w);
                }else if($side == "nz"){
                    $i_1 = ($x-$i*$s-$w);
                    $j_1 = ($x-$j*$s-$w);
                }else if($side == "px"){
                    $i_1 = ($x-$j*$s-$w);
                    $j_1 = (-$x+$i*$s+$w);
                }else if($side == "nx"){
                    $i_1 = ($x-$j*$s-$w);
                    $j_1 = ($x-$i*$s-$w);
                }else if($side == "py"){
                    $i_1 = (-$x+$i*$s+$w);
                    $j_1 = ($x-$j*$s-$w);
                }else if($side == "ny"){
                    $i_1 = (-$x+$i*$s+$w);
                    $j_1 = (-$x+$j*$s+$w);
                }
                $positions = Array(
                    $i_1.' '.$j_1.' -'.$x,
                    $i_1.' '.$j_1.' '.$x,
                    ''.$x.' '.$i_1.' '.$j_1,
                    '-'.$x.' '.$i_1.' '.$j_1,
                    $i_1.' '.$x.' '.$j_1,
                    $i_1.' -'.$x.' '.$j_1
                );
                $position_img = $positions[$l];
                $fout .= '<a-image zoom="1" class="mesh"  side="'.$side.'"  id="cubemap_'.$side.'_'.$t.'_'.$id.'" position="'.$position_img.'" rotation="'.$rotation_img.'" width="'.$s.'" height="'.$s.'" side="front" src="/img/scenes/'.$_GET["id"].'/f_'.$t.'_'.$side.'_'.$id.'.png"></a-image>';
            }
        }
    }
    $fout .= '</a-entity> 
    <a-entity id="cubemap_1" position="0 0 0" scale="1.02 1.02 1.02">';
    $q = 2;
    $s = 256;
    $t = 2;
    $w = $s/2;
    $x = $q*$s/2;
    for($l = 0; $l< count($sides); $l++){
        $side = $sides[$l];
        $rotation_img = $rotations[$l];
        for($i = 0; $i < $q; $i++){
            for($j = 0; $j < $q; $j++){
                $id = ($i*$q+$j);
                if($side == "pz"){
                    $i_1 = (-$x+$i*$s+$w);
                    $j_1 = ($x-$j*$s-$w);
                }else if($side == "nz"){
                    $i_1 = ($x-$i*$s-$w);
                    $j_1 = ($x-$j*$s-$w);
                }else if($side == "px"){
                    $i_1 = ($x-$j*$s-$w);
                    $j_1 = (-$x+$i*$s+$w);
                }else if($side == "nx"){
                    $i_1 = ($x-$j*$s-$w);
                    $j_1 = ($x-$i*$s-$w);
                }else if($side == "py"){
                    $i_1 = (-$x+$i*$s+$w);
                    $j_1 = ($x-$j*$s-$w);
                }else if($side == "ny"){
                    $i_1 = (-$x+$i*$s+$w);
                    $j_1 = (-$x+$j*$s+$w);
                }
                $positions = Array(
                    $i_1.' '.$j_1.' -'.$x,
                    $i_1.' '.$j_1.' '.$x,
                    ''.$x.' '.$i_1.' '.$j_1,
                    '-'.$x.' '.$i_1.' '.$j_1,
                    $i_1.' '.$x.' '.$j_1,
                    $i_1.' -'.$x.' '.$j_1
                );
                $position_img = $positions[$l];
                $fout .= '<a-image zoom="2" class="mesh load_later" side="'.$side.'"  id="cubemap_'.$side.'_'.$t.'_'.$id.'" position="'.$position_img.'" rotation="'.$rotation_img.'" width="'.$s.'" height="'.$s.'" side="front" src="#pixel" xsrc="/img/scenes/'.$_GET["id"].'/f_'.$t.'_'.$side.'_'.$id.'.png"></a-image>';
            }
        }
    }

    $fout .= '</a-entity>  '
        . '<a-entity id="cubemap_2" position="0 0 0"  scale="1.01 1.01 1.01">';

    $q = 4;
    $s = 128;
    $t = 3;
    $w = $s/2;
    $x = $q*$s/2;
    for($l = 0; $l< count($sides); $l++){
        $side = $sides[$l];
        $rotation_img = $rotations[$l];
        for($i = 0; $i < $q; $i++){
            for($j = 0; $j < $q; $j++){
                $id = ($i*$q+$j);
                if($side == "pz"){
                    $i_1 = (-$x+$i*$s+$w);
                    $j_1 = ($x-$j*$s-$w);
                }else if($side == "nz"){
                    $i_1 = ($x-$i*$s-$w);
                    $j_1 = ($x-$j*$s-$w);
                }else if($side == "px"){
                    $i_1 = ($x-$j*$s-$w);
                    $j_1 = (-$x+$i*$s+$w);
                }else if($side == "nx"){
                    $i_1 = ($x-$j*$s-$w);
                    $j_1 = ($x-$i*$s-$w);
                }else if($side == "py"){
                    $i_1 = (-$x+$i*$s+$w);
                    $j_1 = ($x-$j*$s-$w);
                }else if($side == "ny"){
                    $i_1 = (-$x+$i*$s+$w);
                    $j_1 = (-$x+$j*$s+$w);
                }
                $positions = Array(
                    $i_1.' '.$j_1.' -'.$x,
                    $i_1.' '.$j_1.' '.$x,
                    ''.$x.' '.$i_1.' '.$j_1,
                    '-'.$x.' '.$i_1.' '.$j_1,
                    $i_1.' '.$x.' '.$j_1,
                    $i_1.' -'.$x.' '.$j_1
                );
                $position_img = $positions[$l];
                $fout .= '<a-image zoom="3"  class="mesh load_later" side="'.$side.'"  id="cubemap_'.$side.'_'.$t.'_'.$id.'" position="'.$position_img.'" rotation="'.$rotation_img.'" width="'.$s.'" height="'.$s.'" side="front" src="#pixel" xsrc="/img/scenes/'.$_GET["id"].'/f_'.$t.'_'.$side.'_'.$id.'.png"></a-image>';
            }
        }
    }

    $fout .= '</a-entity>'
        . '<a-entity id="cubemap_3" position="0 0 0" scale="1.0 1.0 1.0">';

    $q = 8;
    $s = 64;
    $t = 4;
    $w = $s/2;
    $x = $q*$s/2;
    for($l = 0; $l< count($sides); $l++){
        $side = $sides[$l];
        $rotation_img = $rotations[$l];
        for($i = 0; $i < $q; $i++){
            for($j = 0; $j < $q; $j++){
                $id = ($i*$q+$j);
                if($side == "pz"){
                    $i_1 = (-$x+$i*$s+$w);
                    $j_1 = ($x-$j*$s-$w);
                }else if($side == "nz"){
                    $i_1 = ($x-$i*$s-$w);
                    $j_1 = ($x-$j*$s-$w);
                }else if($side == "px"){
                    $i_1 = ($x-$j*$s-$w);
                    $j_1 = (-$x+$i*$s+$w);
                }else if($side == "nx"){
                    $i_1 = ($x-$j*$s-$w);
                    $j_1 = ($x-$i*$s-$w);
                }else if($side == "py"){
                    $i_1 = (-$x+$i*$s+$w);
                    $j_1 = ($x-$j*$s-$w);
                }else if($side == "ny"){
                    $i_1 = (-$x+$i*$s+$w);
                    $j_1 = (-$x+$j*$s+$w);
                }
                $positions = Array(
                    $i_1.' '.$j_1.' -'.$x,
                    $i_1.' '.$j_1.' '.$x,
                    ''.$x.' '.$i_1.' '.$j_1,
                    '-'.$x.' '.$i_1.' '.$j_1,
                    $i_1.' '.$x.' '.$j_1,
                    $i_1.' -'.$x.' '.$j_1
                );
                $position_img = $positions[$l];
                $fout .= '<a-image zoom="4"  class="mesh load_later" side="'.$side.'"  id="cubemap_'.$side.'_'.$t.'_'.$id.'" position="'.$position_img.'" rotation="'.$rotation_img.'" width="'.$s.'" height="'.$s.'" side="front" src="#pixel" xsrc="/img/scenes/'.$_GET["id"].'/f_'.$t.'_'.$side.'_'.$id.'.png"></a-image>';
            }
        }
    }
    $fout .= '
        </a-entity> 
        <a-entity id="virtual_scene">
            ';
    $objects = '';
    $navigation = '';
    $gsv = '';
    $query = 'SELECT * FROM `vr_object` WHERE `scene_id` = "'.$data["id"].'"';
    $res = engine::mysql($query);
    while($d = mysqli_fetch_array($res)){
        $objects .= engine::pano_print_object($this, $d);
    }
    $new_obj = array();
    $new_obj["id"] = "new_obj";
    $new_obj["level_id"] = $data["level_id"];
    $new_obj["position"] = "0 -100 0";
    $new_obj["rotation"] = "30 30 0";
    $new_obj["color"] = "white";
    $new_obj["scale"] = "10 10 10";
    $new_obj["text"] = "";
    $objects .= engine::pano_print_object($this, $new_obj, 1);
    //---------------
    $query = 'SELECT * FROM `vr_navigation` WHERE `scene_id` = "'.$data["id"].'"';
    $res = engine::mysql($query);
    while($d = mysqli_fetch_array($res)){
        $site = new site();
        $navigation .= engine::pano_navigation($site, $d);
        $fout .= $site->content;
    }
    $new_nav = array();
    $new_nav["id"] = "new_nav";
    $new_nav["position"] = "0 -100 0";
    $new_nav["level_id"] = $data["level_id"];
    $new_nav["scale"] = "10 10 10";
    $navigation .= engine::pano_navigation($this, $new_nav, 1);
    //---------------
    $query = 'SELECT * FROM `vr_link` WHERE `scene_id` = "'.$data["id"].'"';
    $res = engine::mysql($query);
    while($d = mysqli_fetch_array($res)){
        $gsv .= engine::pano_link($this, $d);
    }
    $new_nav = array();
    $new_nav["id"] = "new_google";
    $new_nav["position"] = "0 -100 0";
    $new_nav["level_id"] = $data["level_id"];
    $new_nav["scale"] = "10 10 10";
    $gsv .= engine::pano_link($this, $new_nav, 1);
    //---------------
    $fout .= '
        </a-entity>
        <a-entity id="line" trigger="none" line="color: white; opacity:0;"></a-entity>
        <a-circle id="floor" position="'.$data["floor_position"].'" rotation="-90 0 0" color="white" radius="'.$data["floor_radius"].'" opacity="0"></a-circle>
        <a-circle id="move_point" action=\'navigate();\' position="0 0.01 0" rotation="-90 0 0" color="white" radius="1" opacity="0" ></a-circle>
        <a-image id="cursor_img" transparent="true" position="0 0 0"  look-at="#camera" scale="0.2 0.2 0.2" width="14" height="25"  src="#arrow"></a-image>
        <a-image class="vr_hidden" opacity="0" transparent="true" id="vr_logo" position="0 0.02 0" rotation="-90 0 0"  width="'.$data["logo_size"].'" height="'.$data["logo_size"].'" <!-- src="#logo" --> src=""></a-image>
    </a-scene>
    <audio id="vr-sound" preload autoplay><source src="/res/sounds/vr-load.wav" type="audio/wav"></audio>
        ';
    if($_SESSION["user"]["id"] == "1"){
        $fout .= engine::pano_scene_editor($data);
    }
    $fout .= '</div>'
        . '<div id="temp_data">';
    $fout .= $objects;
    $fout .= $navigation;
    $fout .= $gsv;
    $fout .= '</div>'
        . '<div id="vr-block"></div>';
    $onload .= 'vr_load('.$data["level_id"].');';
}else engine::error();

echo '<!DOCTYPE html>
<html style="background-color:#fff;">
<head>
<meta charset="UTF-8" />
<script src="'.$_SERVER["DIR"].'/script/aframe/aframe-master.js"></script>
<script src="'.$_SERVER["DIR"].'/script/aframe/panorama.js"></script>
<script>
    const loading_site = () => {};
    const root_dir = "'.$_SERVER["DIR"].'";
</script>
<style>
    .a-enter-vr {
        position: fixed !important;
    }
    .a-enter-vr-button {
        display: none;
    }
</style>
<link href="/template/bootstrap/template.css" rel="stylesheet" type="text/css" />
</head>
<body class="nodes">
    '.$fout.'
    <script src="'.$_SERVER["DIR"].'/script/jquery.js" type="text/javascript"></script>
    <script src="'.$_SERVER["DIR"].'/script/script.js" type="text/javascript"></script>
    <script>window.addEventListener("load", () => {
        const scene = document.getElementById("nodes_scene");
        scene.addEventListener("enter-vr", () => {
            parent.document.panorama.permission();
            parent.document.panorama.fullScreen();
        });
        scene.addEventListener("exit-vr", () => {
            parent.document.panorama.hideFullScreen();
        });
        '.$onload.' 
    });</script>
</body>
</html>';
