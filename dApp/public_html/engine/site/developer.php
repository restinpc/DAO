<?php
/**
* Backend developed by page file.
* @path /engine/site/developer.php
*
* @name    DAO Mansion    @version 1.0.0
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
}

$this->title = lang("Developed by");
$this->keywords = ["Aleksandr V", "restinpc", "Vorkunov", "Metaverse Developer", "Full-Stack Developer", "C# (Unity, SteamVR)", "JavaScript (Node.js, React.js, A-Frame)", "Java", "SQL", "Web 3.0"];
if ($_SESSION["Lang"] == "en") {
    $this->description = "Powered by an experienced Full-Stack/Metaverse Developer with a high-level proficiency";
} else if ($_SESSION["Lang"] == "zh") {
    $this->description = '由經驗豐富、技術精湛的全棧/元宇宙開發人員創建';
} else {
    $this->description = "Создано опытным Full-Stack/Metaverse разработчиком с высоким уровнем квалификации";
}
$this->content .= engine::print_site_navigation(lang("Developed by"));
$this->content .= '<iframe src="https://cv.nodes-tech.ru" onLoad="loading_site();" width="100%" class="app"></iframe>';
