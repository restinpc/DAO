<?php
/**
* RSS-feed generator.
* @path /engine/code/rss.php
*
* @name    DAO Mansion    @version 1.0.3
* @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*/
function rss() {
    engine::log('rss()');
    try {
        require_once("engine/nodes/headers.php");
        header('Content-Type: application/rss+xml; charset=utf-8');
        echo '<?xml version="1.0" encoding="utf-8"?>
<rss xmlns:media="http://search.yahoo.com/mrss/" version="2.0">
    <channel>
    <title>'.$_SERVER["configs"]["name"].'</title>
    <link>'.$_SERVER["PUBLIC_URL"].'/</link>
    <description>'.$_SERVER["configs"]["description"].'</description>';
        $query = 'SELECT * FROM `nodes_content` ORDER BY `date` DESC LIMIT 0, 50';
        $res = engine::mysql($query);
        while ($data = mysqli_fetch_array($res)) {
            echo '<item>
                <title>'.$data["caption"].'</title>
                <link>'.$_SERVER["PUBLIC_URL"].'/content/'.$data["url"].($data["lang"] === "ru" ? "" : "?lang=".$data["lang"]).'</link>
                <description>'.mb_substr(strip_tags($data["text"]), 0, 100).'</description>
                <guid>'.$_SERVER["PUBLIC_URL"].'/content/'.$data["url"].'</guid>
                <language>'.$data["lang"].'</language>
                <pubDate>'.date(DATE_RSS, $data["date"]).'</pubDate>
            </item>';
        }
        echo '</channel>
</rss>';
    } catch(Exception $e) {
        engine::throw('rss()', $e);
    }
}

rss();