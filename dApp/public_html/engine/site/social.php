<?php
/**
* Backend social page file.
* @path /engine/site/social.php
*
* @name    DAO Mansion    @version 1.0.2
* @author  Aleksandr Vorkunov  <developing@nodes-tech.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*
* @var $this->title - Page title.
* @var $this->content - Page HTML data.
* @var $this->keywords - Array meta keywords.
* @var $this->description - Page meta description.
* @var $this->img - Page meta image.
* @var $this->onload - Page executable JavaScript code.
* @var $this->configs - Array MySQL configs.
*/

if (!empty($_GET[2])) {
    $this->content = engine::error();
    return;
} else if (!empty($_GET[1]) && $_GET[1] == "telegram") {
    $this->title = engine::lang("Telegram group");
    if ($_SESSION["Lang"] == "en") {
        $this->description = "Web 3.0 Community in Telegram";
        $this->keywords = Array("Social", "Telegram", "Web 3.0", "Community");
    } else if ($_SESSION["Lang"] == "zh") {
        $this->description = 'Telegram 中的 Web 3.0 社區';
        $this->keywords = Array("社交", "Telegram", "Web 3.0", "社區");
    } else {
        $this->description = "Web 3.0 сообщество в Telegram";
        $this->keywords = Array("Общество", "Telegram", "Web 3.0", "Сообщество");
    }
    $this->content .= engine::print_social_navigation(engine::lang("Telegram group"));
    $this->content .= '<iframe src="/telegram.php" onLoad="loading_site();" width="100%" class="app"></iframe>';
} else if (!empty($_GET[1]) && $_GET[1] == "constitution") {
    $this->title = engine::lang("Digital constitution");
    if ($_SESSION["Lang"] == "en") {
        $this->description = "Public inner constitution with principles and rules of community";
        $this->keywords = Array("Social", "Constitution", "Rules", "Web 3.0", "Community");
    } else if ($_SESSION["Lang"] == "zh") {
        $this->description = '具有社區原則和規則的公共內部憲法';
        $this->keywords = Array("社會", "憲法", "規則", "Web 3.0", "社區");
    } else {
        $this->description = "Публичная внутренняя конституция с принципами и правилами сообщества";
        $this->keywords = Array("Общество", "Конституция", "Web 3.0", "Сообщество");
    }
    $content = engine::curl_get_query("https://raw.githubusercontent.com/restinpc/DAO/main/Rules/".$_SESSION["Lang"].".md");
    $content = str_replace("  ", "<br/>", $content);
    $content = str_replace("# ".engine::lang("Community rules"), "<h1>".engine::lang("Community rules")."</h1>", $content);
    $this->content .= engine::print_social_navigation(engine::lang("Digital constitution")).'
    <div class="document980 article">
        <div class="text">
            '.$content.'
            <br/>
            '.engine::lang("The original document is in a").' 
            <a href="https://github.com/restinpc/DAO/blob/main/Rules/'.$_SESSION["Lang"].'.md" target="_blank">
                '.engine::lang("public repository").'
            </a>, '.engine::lang("and is available for editing by the community").'
            <br/>
            <br/>
        </div>
    </div>';
} else if (!empty($_GET[1]) && $_GET[1] == "democracy") {
    $this->title = engine::lang("Crypto democracy");
    if ($_SESSION["Lang"] == "en") {
        $this->description = "Public tokenized elections";
        $this->keywords = Array("Social", "Blockchain", "Elections", "Web 3.0", "Community");
    } else if ($_SESSION["Lang"] == "zh") {
        $this->description = '公開代幣化選舉';
        $this->keywords = Array("社交", "區塊鏈", "選舉", "Web 3.0", "社區");
    } else {
        $this->description = "Публичные токенизированные голосования";
        $this->keywords = Array("Общество", "Голосования", "Выборы", "Web 3.0", "Сообщество");
    }
    $this->content .= engine::print_social_navigation(engine::lang("Crypto democracy")).
    $this->content .= engine::print_under_construction();
} else if (!empty($_GET[1]) && $_GET[1] == "crowdfunding") {
    $this->title = engine::lang("Crowdfunding");
    if ($_SESSION["Lang"] == "en") {
        $this->description = "Crowdfunding platform for inner initiatives";
        $this->keywords = Array("Social", "Crowdfunding", "Web 3.0", "Community");
    } else if ($_SESSION["Lang"] == "zh") {
        $this->description = '內部倡議眾籌平台';
        $this->keywords = Array("社交", "眾籌", "Web 3.0", "社區");
    } else {
        $this->description = "Краудфандинговая платформа для внутренних инициатив";
        $this->keywords = Array("Общество", "Краудфандинг", "Web 3.0", "Сообщество");
    }
    $this->content .= engine::print_social_navigation(engine::lang("Crowdfunding")).
    $this->content .= engine::print_under_construction();
} else if (!empty($_GET[1]) && $_GET[1] == "graph") {
    $this->title = engine::lang("Social graph");
    if ($_SESSION["Lang"] == "en") {
        $this->description = 'Web 3.0 Community Social Graph Viewer App';
        $this->keywords = Array("Social", "Web 3.0", "Community");
    } else if ($_SESSION["Lang"] == "zh") {
        $this->description = '社區社交圖譜查看器應用程序';
        $this->keywords = Array("社交", "Web 3.0", "社區");
    } else {
        $this->description = 'Приложение для просмотра социального графа сообщества';
        $this->keywords = Array("Общество", "Web 3.0", "Сообщество");
    }
    $this->content .= engine::print_social_navigation(engine::lang("Social graph"));
    $this->content .= '<iframe src="/apps/graph/index.html" onLoad="loading_site();" width="100%" class="app"></iframe>';
} else {
    $this->content = engine::error();
    return;
}