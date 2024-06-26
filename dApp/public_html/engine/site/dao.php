<?php
/**
* Backend dao page file.
* @path /engine/site/dao.php
*
* @name    DAO Mansion    @version 1.0.2
* @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
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

if(!empty($_GET[2])){
    $this->content = engine::error();
    return;
} else if (!empty($_GET[1]) && $_GET[1] == "management") {
    $this->title = engine::lang("Decentralized management");
    if ($_SESSION["Lang"] == "en") {
        $this->description = "Public management of digital resources of a decentralized organization";
        $this->keywords = Array("DAO", "Blockchain", "Management", "Decentralized organization", "Web 3.0");
    } else if ($_SESSION["Lang"] == "zh") {
        $this->description = '去中心化組織數字資源的公共管理';
        $this->keywords = Array("DAO", "Blockchain", "區塊鏈", "管理", "分散的組織", "Web 3.0");
    } else {
        $this->description = "Общественное управление цифровыми ресурсами децентрализованной организации";
        $this->keywords = Array("DAO", "Blockchain", "Менеджмент", "Децентрализованная организация", "Web 3.0");
    }
    $this->content .= engine::print_dao_navigation(engine::lang("Decentralized management"));
    $this->content .= engine::print_under_construction();
} else if (!empty($_GET[1]) && $_GET[1] == "monitor") {
    $this->title = engine::lang("Blockchain monitor");
    if ($_SESSION["Lang"] == "en") {
        $this->description = "Public monitoring of all DAO-related blockchain transactions";
        $this->keywords = Array("DAO", "Blockchain", "Explorer", "Decentralized organization", "Web 3.0");
    } else if ($_SESSION["Lang"] == "zh") {
        $this->description = '對所有 DAO 相關區塊鏈交易的公開監控';
        $this->keywords = Array("DAO", "Blockchain", "區塊鏈", "探險家", "分散的組織", "Web 3.0");
    } else {
        $this->description = "Публичный мониторинг всех связанных с DAO blockchain транзакций";
        $this->keywords = Array("DAO", "Blockchain", "Мониторинг", "Децентрализованная организация", "Web 3.0");
    }
    $this->content .= engine::print_dao_navigation(engine::lang("Blockchain monitor"));
    $this->content .= engine::print_under_construction();
} else if (!empty($_GET[1]) && $_GET[1] == "capitalization") {
    $this->title = engine::lang("Capitalization");
    $this->keywords = Array("DAO", engine::lang("Capitalization"), engine::lang("Decentralized organization"), "Web 3.0");
    if ($_SESSION["Lang"] == "en") {
        $this->description = "Project capitalization history chart";
    } else if ($_SESSION["Lang"] == "zh") {
        $this->description = '項目資本化歷史圖表';
    } else {
        $this->description = "График истории капитализации проекта";
    }
    $this->content .= engine::print_dao_navigation(engine::lang("Capitalization"));
    $this->content .= '<iframe id="capital" src="'.$_SERVER["DIR"].'/apps/capital/" class="app" onLoad="document.framework.loading_site();"></iframe>';
} else if (!empty($_GET[1]) && $_GET[1] == "market") {
    $this->title = engine::lang("P2P marketplace");
    $this->keywords = Array("DAO", "P2P", engine::lang("Decentralized organization"), "Web 3.0");
    if ($_SESSION["Lang"] == "en") {
        $this->description = "Internal P2P platform of the project with support for digital and physical spot trading";
    } else if ($_SESSION["Lang"] == "zh") {
        $this->description = '項目內部P2P平台，支持數字和實物現貨交易';
    } else {
        $this->description = "Внутренняя P2P площадка проекта с поддержкой цифровой и физической спотовой торговли";
    }
    $this->content .= engine::print_dao_navigation(engine::lang("P2P marketplace"));
    $this->content .= engine::print_under_construction();
} else if (!empty($_GET[1]) && $_GET[1] == "git") {
    $this->title = engine::lang("Git repository");
    $this->keywords = Array("DAO", "Git", engine::lang("Decentralized organization"), "Web 3.0");
    if ($_SESSION["Lang"] == "en") {
        $this->description = "Public Git repository of the project";
    } else if ($_SESSION["Lang"] == "zh") {
        $this->description = '項目的公共 Git 存儲庫';
    } else {
        $this->description = "Публичный Git репозиторий проекта";
    }
    $this->content .= engine::print_dao_navigation(engine::lang("Git repository"));
    $this->content .= '<iframe src="'.$_SERVER["DIR"].'/git.php" onLoad="document.framework.loading_site();" width="100%" class="app"></iframe>';
} else {
    $this->content = engine::error();
    return;
}
