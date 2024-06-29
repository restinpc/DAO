<?php
/**
* Framework database loader.
* @path /engine/nodes/mysql.php
*
* @name    DAO Mansion    @version 1.0.3
* @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*/

require_once ("engine/nodes/config.php");

$_SERVER["sql_connection"] = mysqli_connect(
    $_SERVER["config"]["sql_server"],
    $_SERVER["config"]["sql_login"],
    $_SERVER["config"]["sql_pass"]
);
mysqli_select_db($_SERVER["sql_connection"], $_SERVER["config"]["sql_db"]);
mysqli_query($_SERVER["sql_connection"], "SET SESSION wait_timeout = 4000");
