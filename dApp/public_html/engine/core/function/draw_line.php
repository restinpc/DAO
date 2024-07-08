<?php
/**
* Draws a wide canvas line.
* @path /engine/core/function/draw_line.php
*
* @name    DAO Mansion    @version 1.0.3
* @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*
* @param resource $image Source image.
* @param int $x1 X-coordinate for point 1.
* @param int $y1 Y-coordinate for point 1.
* @param int $x2 X-coordinate for point 2.
* @param int $y2 Y-coordinate for point 2.
* @param hex $color Line color from 0x000 to 0xfff.
* @param int $thick Line width in px.
* @return bool Returns TRUE on success or FALSE on failure.
* @usage <code> engine::draw_line($image, 0, 0, 100, 100, 0xf00, 20); </code>
*/

function draw_line($image, $x1, $y1, $x2, $y2, $color, $thick = 1){
    engine::log('engine::draw_line()');
    $t = $thick / 2 - 0.5;
    if ($x1 == $x2 || $y1 == $y2) {
        return imagefilledrectangle(
            $image, 
            round(min($x1, $x2) - $t), 
            round(min($y1, $y2) - $t), 
            round(max($x1, $x2) + $t), 
            round(max($y1, $y2) + $t), 
            $color
        );
    }
    $k = ($y2 - $y1) / ($x2 - $x1);
    $a = $t / sqrt(1 + pow($k, 2));
    $points = array(
        round($x1 - (1 + $k) * $a), round($y1 + (1 - $k) * $a),
        round($x1 - (1 - $k) * $a), round($y1 - (1 + $k) * $a),
        round($x2 + (1 + $k) * $a), round($y2 - (1 - $k) * $a),
        round($x2 + (1 - $k) * $a), round($y2 + (1 + $k) * $a),
    );
    imagefilledpolygon($image, $points, 4, $color);
    return imagepolygon($image, $points, 4, $color);
}
