<?php
/**
* Backend contacts page file.
* @path /engine/site/contacts.php
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

if (!empty($_GET[2])) {
    $this->content = engine::error();
    return;
}
$this->title = engine::lang("Contact us");
if ($_SESSION["Lang"] == "en") {
    $this->keywords = array(
        "Feedback",
        "Contacts",
        "Web 3.0"
    );
    $this->description = "Contact information and feedback form with the project administrator";
} else if ($_SESSION["Lang"] == "zh") {
    $this->keywords = array(
        "反饋",
        "聯繫方式",
        "Web 3.0"
    );
    $this->description = '項目管理員的聯繫信息和反饋表';
} else {
    $this->keywords = array(
        "Обратная связь",
        "Контакты",
        "Web 3.0"
    );
    $this->description = "Контактная информация и форма обратной связи с администратором проекта";
}
$this->content .= engine::print_site_navigation(engine::lang("Contact us"));
$this->content .= engine::print_under_construction();
