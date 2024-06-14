<?php
/**
* RSS-feed generator.
* @path /engine/code/rss.php
*
* @name    DAO Mansion    @version 1.0.2
* @author  Aleksandr Vorkunov  <developing@nodes-tech.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*/

require_once("engine/nodes/headers.php");
require_once("engine/nodes/session.php");
header('Content-Type: application/json; charset=utf-8');
$query = 'SELECT * FROM nodes_relations';
$res = engine::mysql($query);
$users = Array();
$relations = Array();
$types = Array(
    "1" => "Partner",
    "2" => "Sexual"
);
while($data = mysqli_fetch_array($res)) {
    array_push($relations, $data);
    if (!in_array($data["user1"], $users)) {
        array_push($users, $data["user1"]);
    }
    if (!in_array($data["user2"], $users)) {
        array_push($users, $data["user2"]);
    }
}
$query = 'SELECT * FROM nodes_user WHERE id = 0';
for($i = 0; $i < count($users); $i++) {
    $query .= ' OR id = '.$users[$i];
}
$res = engine::mysql($query);
$fout = '{
    "results": [{
        "columns": ["user", "entity"],
        "data": [{
            "graph": {
                "nodes": [';
$flag = 0;
while($data = mysqli_fetch_array($res)) {
    if ($flag) {
        $fout .= ',';
    } else {
        $flag = 1;
    }
    $fout .= '{
                    "id": "'.$data["id"].'",
                    "labels": ["User"],
                    "properties": {
                        "name": "'.$data["name"].'",
                        "url": "https://nodes-tech.ru/'.$data["url"].'"
                    }
                }';
}
$fout .= '],
                "relationships": [';
$flag = 0;
foreach($relations as $rel) {
    if ($flag) {
        $fout .= ',';
    } else {
        $flag = 1;
    }
    $fout .= '{
                    "id": "'.$rel["id"].'",
                    "type": "'.$types[$rel["type"]].'",
                    "startNode": "'.$rel["user1"].'",
                    "endNode": "'.$rel["user2"].'",
                    "properties": {
                        "from": '.$rel["date"].'
                    }
                }';
}
$fout .= ']
            }
        }]
    }],
    "errors": []
}
';
echo $fout;