<?php
/**
* Test script.
* @path /engine/code/test.php
*
* @name    DAO Mansion    @version 1.0.3
* @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*/

$_GET["mode"] = "a";
$_GET["action"] = "b";

echo print_r($_GET, 1);
echo '<br/>';
echo json_encode($_GET);