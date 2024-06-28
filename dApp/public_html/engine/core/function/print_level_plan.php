<?php

function print_level_plan($level_id) {
    $query = 'SELECT * FROM `nodes_vr_level` WHERE `id` = "'.$level_id.'"';
    $res = engine::mysql($query);
    $level = mysqli_fetch_array($res);
    $fout = '<div id="level_plan_container">
        <img src="'.$level["image"].'" id="level_plan_img" style="
            -webkit-transform : rotate('.$level["rotation"].'deg) scale('.$level["scale"].'); 
            -ms-transform     : rotate('.$level["rotation"].'deg) scale('.$level["scale"].'); 
            transform         : rotate('.$level["rotation"].'deg) scale('.$level["scale"].');
        " />';
    $query = 'SELECT * FROM `nodes_vr_scene` WHERE `level_id` = "'.$level_id.'"';
    $res = engine::mysql($query);
    $scenes = array();
    $top = null;
    $left = null;
    $right = null;
    $bottom = null;
    while ($data = mysqli_fetch_array($res)) {
        array_push($scenes, $data);
        if ($left == null || $data["lat"] < $left) $left = $data["lat"];
        if ($right == null || $data["lat"] > $right) $right = $data["lat"];
        if ($top == null || $data["lng"] < $top) $top = $data["lng"];
        if ($bottom == null || $data["lng"] > $bottom) $bottom = $data["lng"];
    }
    $bt = 550/($bottom-$top != 0 ? $bottom-$top : 1);
    $rl = 550/($right-$left != 0 ? $right-$left : 1);
    if ($bt > $rl) {
        $rl *= ($rl/$bt);
    } else {
        $bt *= ($bt/$rl);
    }
    foreach ($scenes as $scene) {
        $t = (5+($scene["lng"]-$top)*($bt));
        $l = (5+($right-$scene["lat"])*($rl));
        $fout .= '
            <img id="camera_icon_'.$scene["id"].'"
                src="'.$_SERVER["DIR"].'/img/hotpoint.png"
                width=30
                style="
                    position:absolute;
                    top:'.($t+$scene["top"]).'px;
                    left:'.($l+$scene["left"]).'px;
                    cursor:pointer;
                "
                title="'.$scene["name"].'" 
                onClick=\'
                    parent.document.panorama.hideMap();
                    parent.$id("panorama").src="'.$_SERVER["DIR"].'/panorama.php?id='.$scene["id"].'";
                \'
            />
        ';
    }
    $fout .= '</div>';
    return $fout;
}

