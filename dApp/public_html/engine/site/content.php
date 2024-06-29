<?php
/**
* Backend content pages file.
* @path /engine/site/content.php
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
* @var $this->configs - Array MySQL configs.
*/

if (empty($_GET[0])) {
    $this->content = engine::error();
    return;
}
if ($_GET[0] != "content") {
    $link = $_GET[0];
    if (!empty($_GET[1])) {
        $this->content = engine::error();
        return;
    }
} else {
    $link = $_GET[1];
    if (!empty($_GET[2])) {
        $this->content = engine::error();
        return;
    }
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
    $query = 'SELECT * FROM `nodes_catalog` WHERE `url` = "'.$link.'" AND `lang` = "'.$_SESSION["Lang"].'"';
    $res = engine::mysql($query);
    $data = mysqli_fetch_array($res);
    if (!empty($data)) {
        $this->title = $data["caption"];
        $this->description = mb_substr(strip_tags($data["text"]), 0, 400);
        if (!empty($data["img"])) {
            $this->img = $_SERVER["DIR"]."/img/data/big/".$data["img"];
        }
        $query = 'SELECT COUNT(*) FROM `nodes_content` WHERE `cat_id` = "'.$data["id"].'" AND `lang` = "'.$_SESSION["Lang"].'"';
        $res = engine::mysql($query);
        $d = mysqli_fetch_array($res);
        if ($data['visible']) {
            $this->content .= engine::print_content_navigation($this, $data["caption"]);
        }
        if ($d[0]) {
            $this->content .= '<div class="document980">';
            $this->content .= '<div class="article pt10"><div class="text">'.$data["text"].'</div></div>';
            $this->content .= engine::print_articles($this, $data);
        } else {
            if ($data["url"] == "privacy_policy") {
               $this->content .= engine::print_site_navigation(engine::lang("Privacy policy"));
            } else if ($data["url"] == "terms_and_conditions") {
                $this->content .= engine::print_site_navigation(engine::lang("Terms & conditions"));
            }
            $this->content .= '<div class="document980">';
            $this->content .= engine::print_catalog($this, $data);
        }
        $this->content .= '</div>';
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
            $this->title = $data["caption"];
            $this->description = mb_substr(strip_tags($data["text"]));
            $this->content .= engine::print_content_navigation($this, $catalog["caption"]);
            $this->content .= '<div class="document980">';
            $this->content .= engine::print_article($this, $data);
            $this->content .= '</div>';
        }
    }
} else {
    $this->title = engine::lang("Content");
    if ($_SESSION["Lang"] == "en") {
        $this->keywords = Array(
            "Нейросети",
            "dApp",
            "VR",
            "Виртуальная реальность",
            "Web 3.0",
        );
        $this->description = "There is a rich selection of informational materials, articles, and other resources related to cutting-edge technologies and concepts of the future internet.
        We analyze the prospects of Web 3.0, including distributed applications (dApps) and neural networks.
        We also explore various aspects of virtual reality, including the creation and use of digital worlds, social interactions, and business opportunities.";
    } else if ($_SESSION["Lang"] == "zh") {
        $this->keywords = Array(
            "神經網絡",
            "dApp",
            "VR",
            "虛擬現實",
            "Web 3.0",
        );
        $this->description = '這裡有與未來互聯網尖端技術和概念相關的豐富信息材料、文章和其他資源。
        我們分析了 Web 3.0 的前景，包括分佈式應用程序 (dApp) 和神經網絡。
        我們還探索虛擬現實的各個方面，包括數字世界的創建和使用、社交互動和商業機會。';
    } else {
        $this->keywords = Array(
            "Нейросети",
            "dApp",
            "VR",
            "Виртуальная реальность",
            "Web 3.0",
        );
        $this->description = "Здесь вы найдете богатый выбор информационных материалов, статей, и других ресурсов, связанных с передовыми технологиями и концепциями будущего интернета.
        Мы анализируем перспективы Web 3.0, включая распределенные приложения (dApps) и нейросети.
        Также мы рассматриваем различные аспекты виртуальной реальности, включая создание и использование цифровых миров, социальные взаимодействия и возможности для бизнеса.";
    }
    $this->content .= engine::print_content_navigation($this, engine::lang("All articles"));
    $this->content .= '<div class="document980">';
    $this->content .= '<div class="article pt10"><div class="text"><p>'.$this->description.'</p></div></div>';
    $this->content .= engine::print_articles($this);
    $this->content .= '</div>';
}
