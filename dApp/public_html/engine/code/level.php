<?php
require_once("engine/nodes/headers.php");
require_once("engine/nodes/session.php");
$fout = '<!DOCTYPE html>
<html>
<head>
    <link href="'.$_SERVER["DIR"].'/template/nodes.css" rel="stylesheet" type="text/css" />
    <script>
        if (!document.framework) {
            document.framework = {};
        }
        document.framework.load_events = false;
        document.framework.loading_site = () => {};
        document.framework.root_dir = "'.$_SERVER["DIR"].'";
        // todo remove legacy 4 july
        const load_events = false;
        const loading_site = () => {};
        const root_dir = "'.$_SERVER["DIR"].'";
    </script>
</head>
<body class="nodes" style="opacity:1;">
'.engine::print_level_plan($_GET["id"]).'
<link href="'.$_SERVER["DIR"].'/template/'.$_SESSION["template"].'/template.css" rel="stylesheet" type="text/css" />
<script src="'.$_SERVER["DIR"].'/script/jquery.js" type="text/javascript"></script>
<script src="'.$_SERVER["DIR"].'/script/script.js" type="text/javascript"></script>
<script src="'.$_SERVER["DIR"].'/template/'.$_SESSION["template"].'/template.js" type="text/javascript"></script>
</body>
</html>';
echo $fout;
