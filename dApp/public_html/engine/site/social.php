<?php
/**
* Backend social page file.
* @path /engine/site/social.php
*
* @name    DAO Mansion    @version 1.0.3
* @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*
* @var $this->title - Page title.
* @var $this->content - Page HTML data.
* @var $this->keywords - Array meta keywords.
* @var $this->description - Page meta description.
* @var $this->img - Page meta image.
* @var $this->onload - Page executable JavaScript code.
*/

if (!empty($_GET[2])) {
    $this->content = engine::error();
    return;
} else if (!empty($_GET[1]) && $_GET[1] == "telegram") {
    $this->title = engine::lang("Telegram group");
    if ($_SESSION["Lang"] == "en") {
        $this->description = "Web 3.0 Community in Telegram";
        $this->keywords = array("Social", "Telegram", "Web 3.0", "Community");
    } else if ($_SESSION["Lang"] == "zh") {
        $this->description = 'Telegram 中的 Web 3.0 社區';
        $this->keywords = array("社交", "Telegram", "Web 3.0", "社區");
    } else {
        $this->description = "Web 3.0 сообщество в Telegram";
        $this->keywords = array("Общество", "Telegram", "Web 3.0", "Сообщество");
    }
    $this->content .= engine::print_social_navigation(engine::lang("Telegram group"));
    $this->content .= '<iframe src="'.$_SERVER["DIR"].'/telegram.php" width="100%" class="app"></iframe>';
} else if (!empty($_GET[1]) && $_GET[1] == "constitution") {
    $this->title = engine::lang("Digital constitution");
    if ($_SESSION["Lang"] == "en") {
        $this->description = "Public inner constitution with principles and rules of community";
        $this->keywords = array("Social", "Constitution", "Rules", "Web 3.0", "Community");
    } else if ($_SESSION["Lang"] == "zh") {
        $this->description = '具有社區原則和規則的公共內部憲法';
        $this->keywords = array("社會", "憲法", "規則", "Web 3.0", "社區");
    } else {
        $this->description = "Публичная внутренняя конституция с принципами и правилами сообщества";
        $this->keywords = array("Общество", "Конституция", "Web 3.0", "Сообщество");
    }
    $url = parse_url($_SERVER["configs"]["git"]);
    $link = $url["scheme"].'://'.$url["host"].':'.$url["port"].'/restinpc/DAO/raw/branch/master/Rules/'.$_SESSION["Lang"].'.md';
    $content = engine::curl_get_query($link);
    $content = str_replace("  ", "<br/>", $content);
    $content = str_replace("# ".engine::lang("Community rules"), "<h1>".engine::lang("Community rules")."</h1>", $content);
    $this->content .= engine::print_social_navigation(engine::lang("Digital constitution")).'
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
    $this->title = engine::lang("Crypto democracy");
    if ($_SESSION["Lang"] == "en") {
        $this->description = "Public tokenized elections";
        $this->keywords = array("Social", "Blockchain", "Elections", "Web 3.0", "Community");
    } else if ($_SESSION["Lang"] == "zh") {
        $this->description = '公開代幣化選舉';
        $this->keywords = array("社交", "區塊鏈", "選舉", "Web 3.0", "社區");
    } else {
        $this->description = "Публичные токенизированные голосования";
        $this->keywords = array("Общество", "Голосования", "Выборы", "Web 3.0", "Сообщество");
    }
    $this->content .= engine::print_social_navigation(engine::lang("Crypto democracy")).
    $this->content .= engine::print_under_construction();
} else if (!empty($_GET[1]) && $_GET[1] == "crowdfunding") {
    $this->title = engine::lang("Crowdfunding");
    if ($_SESSION["Lang"] == "en") {
        $this->description = "Crowdfunding platform for inner initiatives";
        $this->keywords = array("Social", "Crowdfunding", "Web 3.0", "Community");
    } else if ($_SESSION["Lang"] == "zh") {
        $this->description = '內部倡議眾籌平台';
        $this->keywords = array("社交", "眾籌", "Web 3.0", "社區");
    } else {
        $this->description = "Краудфандинговая платформа для внутренних инициатив";
        $this->keywords = array("Общество", "Краудфандинг", "Web 3.0", "Сообщество");
    }
    $this->content .= engine::print_social_navigation(engine::lang("Crowdfunding")).
    $this->content .= engine::print_under_construction();
} else if (!empty($_GET[1]) && $_GET[1] == "graph") {
    $this->title = engine::lang("Social graph");
    if ($_SESSION["Lang"] == "en") {
        $this->description = 'Web 3.0 Community Social Graph Viewer App';
        $this->keywords = array("Social", "Web 3.0", "Community");
    } else if ($_SESSION["Lang"] == "zh") {
        $this->description = '社區社交圖譜查看器應用程序';
        $this->keywords = array("社交", "Web 3.0", "社區");
    } else {
        $this->description = 'Приложение для просмотра социального графа сообщества';
        $this->keywords = array("Общество", "Web 3.0", "Сообщество");
    }
    $this->content .= engine::print_social_navigation(engine::lang("Social graph"));
    $this->content .= '<iframe src="'.$_SERVER["DIR"].'/apps/graph/index.html" width="100%" class="app"></iframe>';
} else {
    $this->content = engine::error();
    return;
}
