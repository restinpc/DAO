<?php
/**
* Perfomance graph.
* @path /engine/code/perfomance.php
*
* @name    DAO Mansion    @version 1.0.3
* @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*/

function perfomance() {
    engine::log('perfomance('.json_encode($_GET).')');
    try {
        header("Content-Type: image/gif");
        if ($_SESSION["user"]["id"] != 1) {
            if (intval($_SERVER["configs"]["lastreport"]) >= date("U") - 26000) {
                die(engine::error(401));
            }
        }
        $W = 600;       // Width
        $H = 300;       // Height
        $MB = 20;       // Margin bottom
        $ML = 8;        // Margin left
        $MT = 20;       // Margin top
        $MR = 5;        // Margin right
        $county = 10;   // Lines count
        $DATA = array();
        for ($i = 0; $i < 10; $i++) {
            if (!empty($_GET["date"])) {
                $date = $_GET["date"];
            } else {
                $date = date("Y-m-d");
            }
            if ($_GET["interval"] == "day") {
                $from = strtotime($date." 23:59:59 - ".(10 - $i)." days");
                $to = strtotime($date." 23:59:59 - ".(9 - $i)." days");
                $DATA["x"][] = date("d.m", $to);
            } else if ($_GET["interval"] == "week") {
                $from = strtotime($date." 23:59:59 - ".((10 - $i) * 7)." days");
                $to = strtotime($date." 23:59:59 - ".((9 - $i) * 7)." days");
                $DATA["x"][] = date("d.m", $to);
            } else if ($_GET["interval"] == "month") {
                $from = strtotime($date." 23:59:59 - ".(10 - $i)." month");
                $to = strtotime($date." 23:59:59 - ".(9 - $i)." month");
                $DATA["x"][] = date("m.Y", $to);
            } else {
                $from = strtotime($date." ".date("H:i:s")." - ".((10 - $i) * 180)." minutes");
                $to = strtotime($date." ".date("H:i:s")." - ".((9 - $i) * 180)." minutes");
                $DATA["x"][] = date("H:i", $to);
            }
            $query = 'SELECT * FROM `nodes_perfomance` WHERE `date` >= "'.$from.'" AND `date` <= "'.$to.'"';
            $res = engine::mysql($query);
            $script = 0;
            $server = 0;
            $count = 0;
            while ($data = mysqli_fetch_array($res)) {
                $script += $data["script_time"];
                $server += $data["server_time"];
                $count++;
            }
            $query = 'SELECT AVG(`script_time`) FROM `nodes_perfomance` WHERE `script_time` > 0';
            $res = engine::mysql($query);
            $mid_script = mysqli_fetch_array($res);
            $query = 'SELECT AVG(`server_time`) FROM `nodes_perfomance` WHERE `server_time` > 0';
            $res = engine::mysql($query);
            $mid_server = mysqli_fetch_array($res);
            if ($script > 0) {
                $script_time = $script / $count;
            } else {
                $script_time = 0;
            }
            if ($server > 0) {
                $server_time = $server / $count;
            } else {
                $server_time = 0;
            }
            $DATA[0][] = $script_time;
            $DATA[1][] = $server_time;
        }
        $LW = imagefontwidth(2);
        $count = count($DATA[0]);
        if (count($DATA[1]) > $count) {
            $count = count($DATA[1]);
        }
        if ($count == 0) {
            $count = 1;
        }
        $max = 0;
        for ($i = 0; $i < $count; $i++) {
            $max = array_key_exists(0, $DATA) && $max < $DATA[0][$i] ? $DATA[0][$i] : $max;
            $max = array_key_exists(1, $DATA) && $max < $DATA[1][$i] ? $DATA[1][$i] : $max;
        }
        // $max = round($max + ($max / 10), 2);
        $im = imagecreate($W, $H);
        $bg[0] = imagecolorallocate($im, 255, 255, 255);
        $bg[1] = imagecolorallocate($im, 231, 231, 231);
        $bg[2] = imagecolorallocate($im, 212, 212, 212);
        $c = imagecolorallocate($im, 184, 184, 184);
        $text = imagecolorallocate($im, 136, 136, 136);
        $bar[0] = imagecolorallocate($im, 240,40,40);
        $bar[1] = imagecolorallocate($im,68, 115, 186);
        $bar[2] = imagecolorallocate($im, 20, 180, 180);
        $bar[3] = imagecolorallocate($im, 220, 0, 0);
        $text_width = 0;
        for ($i = 1; $i <= $county; $i++) {
            $strl = strlen(round(($max / $county) * $i, 2)) * $LW;
            if ($strl > $text_width) {
                $text_width = $strl;
            }
        }
        $ML += $text_width;
        $RW = $W - $ML - $MR;
        $RH = $H - $MB - $MT;
        $X0 = $ML;
        $Y0 = $H - $MB;
        $step = $RH / ($county+1);
        imagefilledrectangle($im, $X0, $Y0 - $RH, $X0 + $RW, $Y0, $bg[1]);
        imagerectangle($im, $X0, $Y0, $X0 + $RW, $Y0 - $RH, $c);
        for ($i = 1; $i <= $county; $i++) {
            $y = $Y0 - $step * $i;
            imageline($im, $X0, $y, $X0+ $RW, $y, $c);
            //imageline($im, $X0, $y, $X0 - ($ML - $text_width) / 4, $y, $text);
        }
        for ($i = 0; $i < $count; $i++) {
            imageline($im, $X0 + $i * ($RW / $count), $Y0, $X0 + $i * ($RW / $count), $Y0, $c);
            imageline($im, $X0 + $i * ($RW / $count), $Y0, $X0 + $i * ($RW / $count), $Y0 - $RH, $c);
        }
        $dx = ($RW/ $count) / 2;
        $pi = $Y0 - ($RH / $max * $DATA[0][0]);
        $po = $Y0 - ($RH / $max * $DATA[1][0]);
        $px = intval($X0 + $dx);
        for ($i = 0; $i < $count; $i++) {
            $x = intval($X0 + $i * ($RW / $count) + $dx);
            if ($DATA[0][$i] >= $DATA[1][$i]) {
                $y = $Y0 - ($RH / $max * $DATA[0][$i]);
                if ($DATA[0][$i] > 0) {
                    if ($mid_script[0] < $DATA[0][$i]) {
                        engine::draw_line($im, $x, $Y0 - 5, $x, $y + 5, $bar[0], 10);
                    } else {
                        engine::draw_line($im, $x, $Y0 - 5, $x, $y + 5, $bar[2], 10);
                    }
                }
                $y = $Y0 - ($RH / $max * $DATA[1][$i]);
                if ($DATA[1][$i] > 0) {
                    if ($mid_script[0] < $DATA[0][$i]) {
                        engine::draw_line($im, $x, $Y0 - 5, $x, $y, $bar[3], 10);
                    } else {
                        engine::draw_line($im, $x, $Y0 - 5, $x, $y, $bar[1], 10);
                    }
                }
                $str = $DATA["x"][$i];
                imagestring($im, 2, $x - (strlen($str) * $LW) / 2, $Y0 + 4, $str, $text);
                $str = round($DATA[0][$i],2);
                imagestring($im, 2, $x - (strlen($str) * $LW) / 2, 3, $str, $text);
            }
            $po = $y;
            $px = $x;
        }
        $ML -= $text_width;
        for ($i = 0; $i <= $county + 1; $i++) {
            $str = round(($max / ($county + 1)) * $i, 2);
            imagestring($im, 2, $X0 - strlen($str) * $LW - $ML / 4 - 2, $Y0 - $step * $i - imagefontheight(2) / 2, $str, $text);
        }
        imagegif($im);
        imagedestroy($im);
    } catch(Exception $e) {
        engine::throw('perfomance('.json_encode($_GET).')', $e);
    }
}

perfomance();