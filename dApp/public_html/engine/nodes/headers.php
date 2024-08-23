<?php
/**
* Framework headers file.
* @path /engine/nodes/headers.php
*
* @name    DAO Mansion    @version 1.0.5
* @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*/

function headers() {
    try {
        header("Content-type: text/html; charset=utf-8");
        header("Cache-Control: max-age=0, pre-check=0, no-cache, no-store, must-revalidate");
        header("Expires: Wed, 11 Jan 1984 05:00:00 GMT");
        header('Last-Modified: '.gmdate('D, d M Y H:i:s') . ' GMT');
        header('Pragma: no-cache');
    } catch(Exception $e) {
        engine::throw('headers()', $e);
    }
}
