<?php
/**
* Prints interactive map of level
* @path /engine/code/level.php
*
* @name    DAO Mansion    @version 1.0.3
* @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*/

require_once("engine/nodes/headers.php");
require_once("engine/nodes/session.php");

$fout = '<!DOCTYPE html>
<html>
<head>
    <link href="'.$_SERVER["DIR"].'/template/nodes.css" rel="stylesheet" type="text/css" />
    <link href="'.$_SERVER["DIR"].'/template/'.$_SESSION["template"].'/template.css" rel="stylesheet" type="text/css" />
    <script>
        if (!document.framework) {
            document.framework = {};
        }
        document.framework.loadEvents = false;
        document.framework.rootDir = "'.$_SERVER["DIR"].'";
    </script>
    <script rel="preload" src="'.$_SERVER["DIR"].'/script/jquery.js" type="text/javascript" as="script" crossorigin="anonymous"></script>
    <script rel="preload" src="'.$_SERVER["DIR"].'/script/script.js" type="text/javascript" as="script" crossorigin="anonymous"></script>
    <script rel="preload" src="'.$_SERVER["DIR"].'/template/'.$_SESSION["template"].'/template.js" type="text/javascript" as="script" crossorigin="anonymous"></script>
</head>
<body class="nodes">
    '.engine::print_level_plan($_GET["id"]).'
</body>
</html>';
echo $fout;
