<?php
/**
* Test script.
* @path /engine/code/test.php
*
* @name    DAO Mansion    @version 1.0.3
* @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*/

function test() {
    engine::log('test('.json_encode($_GET).')');
    try {
        throw new Exception('Test');
    } catch(Exception $e) {
        engine::throw('test('.json_encode($_GET).')', $e);
    }
}

test();