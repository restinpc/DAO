<?php
/**
 * Prints under construction block.
 * @path /engine/core/function/print_under_construction.php
 *
 * @name    DAO Mansion    @version 1.0.3
 * @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 *
 * @return string Returns content of block.
 * @usage <code> engine::print_under_construction(); </code>
 */

function print_under_construction() {
    $fout = '<div class="under-construction">
        <img src="'.$_SERVER["DIR"].'/img/banner.jpg" />
    </div>';
    return $fout;
}
