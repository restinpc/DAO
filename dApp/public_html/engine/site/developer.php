<?php
/**
* Backend developed by page file.
* @path /engine/site/developer.php
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

function developer($site) {
    engine::log('developer()');
    try {
        if (!empty($_GET[2])) {
            $site->content = engine::error();
            return;
        }
        $site->title = engine::lang("Developed by");
        $site->keywords = array(
            "Aleksandr V", 
            "restinpc", 
            "Vorkunov", 
            "Web 3.0 Developer", 
            "Metaverse Developer", 
            "Full-Stack Developer", 
            "C# (Unity, SteamVR)", 
            "JavaScript (Node.js, React.js, A-Frame)", 
            "PHP",
            "Java", 
            "SQL"
        );
        if ($_SESSION["Lang"] == "en") {
            $site->description = "Powered by an experienced Developer with a high-level proficiency";
        } else if ($_SESSION["Lang"] == "zh") {
            $site->description = '由經驗豐富、技術精湛的全棧/元宇宙開發人員創建';
        } else {
            $site->description = "Создано опытным разработчиком с высоким уровнем квалификации";
        }
        $site->content .= engine::print_site_navigation(engine::lang("Developed by"));
        $site->content .= '<iframe src="https://cv.nodes-tech.ru/'.$_SESSION["Lang"].'.html" width="100%" class="app"></iframe>';
    } catch(Exception $e) {
        engine::throw('developer()', $e);
    }
}

developer($this);