<?php
/**
* Backend dao page file.
* @path /engine/site/dao.php
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

function dao($site) {
    engine::log('dao()');
    try {
        if (!empty($_GET[2])) {
            $site->content = engine::error();
            return;
        } else if (!empty($_GET[1]) && $_GET[1] == "management") {
            $site->title = engine::lang("Decentralized management");
            if ($_SESSION["Lang"] == "en") {
                $site->description = "Public management of digital resources of a decentralized organization";
                $site->keywords = array("DAO", "Blockchain", "Management", "Decentralized organization", "Web 3.0");
            } else if ($_SESSION["Lang"] == "zh") {
                $site->description = '去中心化組織數字資源的公共管理';
                $site->keywords = array("DAO", "Blockchain", "區塊鏈", "管理", "分散的組織", "Web 3.0");
            } else {
                $site->description = "Общественное управление цифровыми ресурсами децентрализованной организации";
                $site->keywords = array("DAO", "Blockchain", "Менеджмент", "Децентрализованная организация", "Web 3.0");
            }
            $site->content .= engine::print_dao_navigation(engine::lang("Decentralized management"));
            $site->content .= engine::print_under_construction();
        } else if (!empty($_GET[1]) && $_GET[1] == "monitor") {
            $site->title = engine::lang("Blockchain monitor");
            if ($_SESSION["Lang"] == "en") {
                $site->description = "Public monitoring of all DAO-related blockchain transactions";
                $site->keywords = array("DAO", "Blockchain", "Explorer", "Decentralized organization", "Web 3.0");
            } else if ($_SESSION["Lang"] == "zh") {
                $site->description = '對所有 DAO 相關區塊鏈交易的公開監控';
                $site->keywords = array("DAO", "Blockchain", "區塊鏈", "探險家", "分散的組織", "Web 3.0");
            } else {
                $site->description = "Публичный мониторинг всех связанных с DAO blockchain транзакций";
                $site->keywords = array("DAO", "Blockchain", "Мониторинг", "Децентрализованная организация", "Web 3.0");
            }
            $site->content .= engine::print_dao_navigation(engine::lang("Blockchain monitor"));
            $site->content .= engine::print_under_construction();
        } else if (!empty($_GET[1]) && $_GET[1] == "capitalization") {
            $site->title = engine::lang("Capitalization");
            $site->keywords = array("DAO", engine::lang("Capitalization"), engine::lang("Decentralized organization"), "Web 3.0");
            if ($_SESSION["Lang"] == "en") {
                $site->description = "Project capitalization history chart";
            } else if ($_SESSION["Lang"] == "zh") {
                $site->description = '項目資本化歷史圖表';
            } else {
                $site->description = "График истории капитализации проекта";
            }
            $site->content .= engine::print_dao_navigation(engine::lang("Capitalization"));
            $site->content .= '<iframe id="capital" src="'.$_SERVER["DIR"].'/apps/capital/" class="app"></iframe>';
        } else if (!empty($_GET[1]) && $_GET[1] == "market") {
            $site->title = engine::lang("P2P marketplace");
            $site->keywords = array("DAO", "P2P", engine::lang("Decentralized organization"), "Web 3.0");
            if ($_SESSION["Lang"] == "en") {
                $site->description = "Internal P2P platform of the project with support for digital and physical spot trading";
            } else if ($_SESSION["Lang"] == "zh") {
                $site->description = '項目內部P2P平台，支持數字和實物現貨交易';
            } else {
                $site->description = "Внутренняя P2P площадка проекта с поддержкой цифровой и физической спотовой торговли";
            }
            $site->content .= engine::print_dao_navigation(engine::lang("P2P marketplace"));
            $site->content .= engine::print_under_construction();
        } else if (!empty($_GET[1]) && $_GET[1] == "git") {
            $site->title = engine::lang("Git repository");
            $site->keywords = array("DAO", "Git", engine::lang("Decentralized organization"), "Web 3.0");
            if ($_SESSION["Lang"] == "en") {
                $site->description = "Public Git repository of the project";
            } else if ($_SESSION["Lang"] == "zh") {
                $site->description = '項目的公共 Git 存儲庫';
            } else {
                $site->description = "Публичный Git репозиторий проекта";
            }
            $site->content .= engine::print_dao_navigation(engine::lang("Git repository"));
            $site->content .= '<iframe src="'.$_SERVER["DIR"].'/git.php" width="100%" class="app"></iframe>';
        } else {
            $site->content = engine::error();
            return;
        }
    } catch(Exception $e) {
        engine::throw('dao()', $e);
    }
}

dao($this);