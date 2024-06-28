<?php
/**
* RSS-feed generator.
* @path /engine/code/rss.php
*
* @name    DAO Mansion    @version 1.0.2
* @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*/
require_once("engine/nodes/headers.php");
require_once("engine/nodes/session.php");
header('Content-Type: application/rss+xml; charset=utf-8');
$query = 'SELECT * FROM `nodes_config` WHERE `name` = "name"';
$res = engine::mysql($query);
$title = mysqli_fetch_array($res);
$query = 'SELECT * FROM `nodes_config` WHERE `name` = "description"';
$res = engine::mysql($query);
$description = mysqli_fetch_array($res);
echo '<?xml version="1.0" encoding="utf-8"?>
<rss xmlns:media="http://search.yahoo.com/mrss/" version="2.0">
<channel>
<title>'.$title["value"].'</title>
<link>'.$_SERVER["PUBLIC_URL"].'/</link>
<description>'.$description["value"].'</description>';
$query = 'SELECT * FROM `nodes_content` ORDER BY `date` DESC LIMIT 0, 50';
$res = engine::mysql($query);
while ($data = mysqli_fetch_array($res)) {
    echo '<item>
    <title>'.$data["caption"].'</title>
    <link>'.$_SERVER["PUBLIC_URL"].'/content/'.$data["url"].($data["lang"] === "ru" ? "": "?lang=".$data["lang"]).'</link>
    <description>'.mb_substr(strip_tags($data["text"]),0,100).'</description>
    <guid>'.$_SERVER["PUBLIC_URL"].'/content/'.$data["url"].'</guid>
    <language>'.$data["lang"].'</language>
    <pubDate>'.date(DATE_RSS, $data["date"]).'</pubDate>
</item>
';
}echo '</channel>
</rss>';