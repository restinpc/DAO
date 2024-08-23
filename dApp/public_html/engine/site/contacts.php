<?php
/**
* Backend contacts page file.
* @path /engine/site/contacts.php
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

function contacts($site) {
    engine::log('contacts()');
    try {
        if (!empty($_GET[2])) {
            $site->content = engine::error();
            return;
        }
        $site->title = engine::lang("Contact us");
        if ($_SESSION["Lang"] == "en") {
            $site->keywords = array(
                "Feedback",
                "Contacts",
                "Web 3.0"
            );
            $site->description = "Contact information and feedback form with the project administrator";
        } else if ($_SESSION["Lang"] == "zh") {
            $site->keywords = array(
                "反饋",
                "聯繫方式",
                "Web 3.0"
            );
            $site->description = '項目管理員的聯繫信息和反饋表';
        } else {
            $site->keywords = array(
                "Обратная связь",
                "Контакты",
                "Web 3.0"
            );
            $site->description = "Контактная информация и форма обратной связи с администратором проекта";
        }
        $site->content .= engine::print_site_navigation(engine::lang("Contact us"));
        $site->content .= engine::print_under_construction();
    } catch(Exception $e) {
        engine::throw('contacts()', $e);
    }
}

contacts($this);