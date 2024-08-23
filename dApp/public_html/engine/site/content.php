<?php
/**
* Backend content pages file.
* @path /engine/site/content.php
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

function content($site) {
    engine::log('content()');
    try {
        if (empty($_GET[0])) {
            $site->content = engine::error();
            return;
        }
        if ($_GET[0] != "content") {
            $link = $_GET[0];
            if (!empty($_GET[1])) {
                $site->content = engine::error();
                return;
            }
        } else if (!empty($_GET[2])) {
            $site->content = engine::error();
            return;
        } 
        if (!empty($_POST["from"])) {
            $_SESSION["from"] = $_POST["from"];
        }
        if (!empty($_POST["to"])) {
            $_SESSION["to"] = $_POST["to"];
        }
        if (!empty($_POST["count"])) {
            $_SESSION["count"] = intval($_POST["count"]);
        }
        if (!empty($_POST["page"])) {
            $_SESSION["page"] = intval($_POST["page"]);
        }
        if ($_SESSION["order"] != "order") {
            $_SESSION["order"] = "order";
        }
        if ($_SESSION["method"] != "DESC") {
            $_SESSION["method"] = "DESC";
        }
        if ($_GET[0] != "content" || (!empty($_GET[1]) && $_GET[0] == "content")) {
            $link = $_GET[1];
            $query = 'SELECT * FROM `nodes_catalog` WHERE `url` = "'.$link.'" AND `lang` = "'.$_SESSION["Lang"].'"';
            $res = engine::mysql($query);
            $data = mysqli_fetch_array($res);
            if (!empty($data)) {
                $site->title = $data["caption"];
                $site->description = mb_substr(strip_tags($data["text"]), 0, 400);
                if (!empty($data["img"])) {
                    $site->img = $_SERVER["DIR"]."/img/data/big/".$data["img"];
                }
                $query = 'SELECT COUNT(*) FROM `nodes_content` WHERE `cat_id` = "'.$data["id"].'" AND `lang` = "'.$_SESSION["Lang"].'"';
                $res = engine::mysql($query);
                $d = mysqli_fetch_array($res);
                if ($data['visible']) {
                    $site->content .= engine::print_content_navigation($site, $data["caption"]);
                }
                if ($d[0]) {
                    $site->content .= '<div class="document980">';
                    $site->content .= '<div class="article pt10"><div class="text">'.$data["text"].'</div></div>';
                    $site->content .= engine::print_articles($site, $data);
                } else {
                    if ($data["url"] == "privacy_policy") {
                       $site->content .= engine::print_site_navigation(engine::lang("Privacy policy"));
                    } else if ($data["url"] == "terms_and_conditions") {
                        $site->content .= engine::print_site_navigation(engine::lang("Terms & conditions"));
                    }
                    $site->content .= '<div class="document980">';
                    $site->content .= engine::print_catalog($site, $data);
                }
                $site->content .= '</div>';
            } else {
                $query = 'SELECT * FROM `nodes_content` WHERE `url` = "'.$link.'" AND `lang` = "'.$_SESSION["Lang"].'"';
                $res = engine::mysql($query);
                $data = mysqli_fetch_array($res);
                if (empty($data)) {
                    engine::error();
                    exit();
                } else {
                    $query = 'SELECT * FROM `nodes_catalog` WHERE `id` = "'.$data["cat_id"].'"';
                    $r = engine::mysql($query);
                    $catalog = mysqli_fetch_array($r);
                    $site->title = $data["caption"];
                    $site->description = mb_substr(strip_tags($data["text"]), 198);
                    $site->content .= engine::print_content_navigation($site, $catalog["caption"]);
                    $site->content .= '<div class="document980">';
                    $site->content .= engine::print_article($site, $data);
                    $site->content .= '</div>';
                }
            }
        } else {
            $site->title = engine::lang("Content");
            if ($_SESSION["Lang"] == "en") {
                $site->keywords = array(
                    "Нейросети",
                    "dApp",
                    "VR",
                    "Виртуальная реальность",
                    "Web 3.0",
                );
                $site->description = "There is a rich selection of informational materials, articles, and other resources related to cutting-edge technologies and concepts of the future internet.
                We analyze the prospects of Web 3.0, including distributed applications (dApps) and neural networks.
                We also explore various aspects of virtual reality, including the creation and use of digital worlds, social interactions, and business opportunities.";
            } else if ($_SESSION["Lang"] == "zh") {
                $site->keywords = array(
                    "神經網絡",
                    "dApp",
                    "VR",
                    "虛擬現實",
                    "Web 3.0",
                );
                $site->description = '這裡有與未來互聯網尖端技術和概念相關的豐富信息材料、文章和其他資源。
                我們分析了 Web 3.0 的前景，包括分佈式應用程序 (dApp) 和神經網絡。
                我們還探索虛擬現實的各個方面，包括數字世界的創建和使用、社交互動和商業機會。';
            } else {
                $site->keywords = array(
                    "Нейросети",
                    "dApp",
                    "VR",
                    "Виртуальная реальность",
                    "Web 3.0",
                );
                $site->description = "Здесь вы найдете богатый выбор информационных материалов, статей, и других ресурсов, связанных с передовыми технологиями и концепциями будущего интернета.
                Мы анализируем перспективы Web 3.0, включая распределенные приложения (dApps) и нейросети.
                Также мы рассматриваем различные аспекты виртуальной реальности, включая создание и использование цифровых миров, социальные взаимодействия и возможности для бизнеса.";
            }
            $site->content .= engine::print_content_navigation($site, engine::lang("All articles"));
            $site->content .= '<div class="document980">';
            $site->content .= '<div class="article pt10"><div class="text"><p>'.$site->description.'</p></div></div>';
            $site->content .= engine::print_articles($site);
            $site->content .= '</div>';
        }
    } catch(Exception $e) {
        engine::throw('content()', $e);
    }
}

content($this);