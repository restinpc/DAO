<?php
/**
* Backend social page file.
* @path /engine/site/social.php
*
* @name    DAO Mansion    @version 1.0.5
* @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*
* @var $site->title - Page title.
* @var $site->content - Page HTML data.
* @var $site->keywords - Array meta keywords.
* @var $site->description - Page meta description.
* @var $site->img - Page meta image.
* @var $site->onload - Page executable JavaScript code.
*/

function social($site) {
    engine::log('social()');
    try {
        if (!empty($_GET[2])) {
            $site->content = engine::error();
            return;
        } else if (!empty($_GET[1]) && $_GET[1] == "telegram") {
            $site->title = engine::lang("Telegram group");
            if ($_SESSION["Lang"] == "en") {
                $site->description = "Web 3.0 Community in Telegram";
                $site->keywords = array("Social", "Telegram", "Web 3.0", "Community");
            } else if ($_SESSION["Lang"] == "zh") {
                $site->description = 'Telegram 中的 Web 3.0 社區';
                $site->keywords = array("社交", "Telegram", "Web 3.0", "社區");
            } else {
                $site->description = "Web 3.0 сообщество в Telegram";
                $site->keywords = array("Общество", "Telegram", "Web 3.0", "Сообщество");
            }
            $site->content .= engine::print_social_navigation(engine::lang("Telegram group"));
            $site->content .= '<iframe src="'.$_SERVER["DIR"].'/telegram.php" width="100%" class="app"></iframe>';
        } else if (!empty($_GET[1]) && $_GET[1] == "constitution") {
            $site->title = engine::lang("Digital constitution");
            if ($_SESSION["Lang"] == "en") {
                $site->description = "Public inner constitution with principles and rules of community";
                $site->keywords = array("Social", "Constitution", "Rules", "Web 3.0", "Community");
            } else if ($_SESSION["Lang"] == "zh") {
                $site->description = '具有社區原則和規則的公共內部憲法';
                $site->keywords = array("社會", "憲法", "規則", "Web 3.0", "社區");
            } else {
                $site->description = "Публичная внутренняя конституция с принципами и правилами сообщества";
                $site->keywords = array("Общество", "Конституция", "Web 3.0", "Сообщество");
            }
            $url = parse_url($_SERVER["configs"]["git"]);
            $link = $url["scheme"].'://'.$url["host"].':'.$url["port"].'/restinpc/DAO/raw/branch/master/Rules/'.$_SESSION["Lang"].'.md';
            $content = engine::curl_get_query($link);
            $content = str_replace("  ", "<br/>", $content);
            $content = str_replace("# ".engine::lang("Community rules"), "<h1>".engine::lang("Community rules")."</h1>", $content);
            $site->content .= engine::print_social_navigation(engine::lang("Digital constitution")).'
            <div class="document980 article">
                <div class="text">
                    '.$content.'
                    <br/>
                    '.engine::lang("The original document is in a").' 
                    <a href="'.$link.'" target="_blank">'.engine::lang("public repository").'</a>, '
                    .engine::lang("and is available for editing by the community").'
                    <br/>
                    <br/>
                </div>
            </div>';
        } else if (!empty($_GET[1]) && $_GET[1] == "democracy") {
            $site->title = engine::lang("Crypto democracy");
            if ($_SESSION["Lang"] == "en") {
                $site->description = "Public tokenized elections";
                $site->keywords = array("Social", "Blockchain", "Elections", "Web 3.0", "Community");
            } else if ($_SESSION["Lang"] == "zh") {
                $site->description = '公開代幣化選舉';
                $site->keywords = array("社交", "區塊鏈", "選舉", "Web 3.0", "社區");
            } else {
                $site->description = "Публичные токенизированные голосования";
                $site->keywords = array("Общество", "Голосования", "Выборы", "Web 3.0", "Сообщество");
            }
            $site->content .= engine::print_social_navigation(engine::lang("Crypto democracy")).
            $site->content .= engine::print_under_construction();
        } else if (!empty($_GET[1]) && $_GET[1] == "crowdfunding") {
            $site->title = engine::lang("Crowdfunding");
            if ($_SESSION["Lang"] == "en") {
                $site->description = "Crowdfunding platform for inner initiatives";
                $site->keywords = array("Social", "Crowdfunding", "Web 3.0", "Community");
            } else if ($_SESSION["Lang"] == "zh") {
                $site->description = '內部倡議眾籌平台';
                $site->keywords = array("社交", "眾籌", "Web 3.0", "社區");
            } else {
                $site->description = "Краудфандинговая платформа для внутренних инициатив";
                $site->keywords = array("Общество", "Краудфандинг", "Web 3.0", "Сообщество");
            }
            $site->content .= engine::print_social_navigation(engine::lang("Crowdfunding")).
            $site->content .= engine::print_under_construction();
        } else if (!empty($_GET[1]) && $_GET[1] == "graph") {
            $site->title = engine::lang("Social graph");
            if ($_SESSION["Lang"] == "en") {
                $site->description = 'Web 3.0 Community Social Graph Viewer App';
                $site->keywords = array("Social", "Web 3.0", "Community");
            } else if ($_SESSION["Lang"] == "zh") {
                $site->description = '社區社交圖譜查看器應用程序';
                $site->keywords = array("社交", "Web 3.0", "社區");
            } else {
                $site->description = 'Приложение для просмотра социального графа сообщества';
                $site->keywords = array("Общество", "Web 3.0", "Сообщество");
            }
            $site->content .= engine::print_social_navigation(engine::lang("Social graph"));
            $site->content .= '<iframe src="'.$_SERVER["DIR"].'/apps/graph/index.html" width="100%" class="app"></iframe>';
        } else {
            $site->content = engine::error();
            return;
        }
    } catch(Exception $e) {
        engine::throw('social()', $e);
    }
}

social($this);