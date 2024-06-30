<?php
/**
 * Backend booking page file.
 * @path /engine/site/booking.php
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
$this->title = engine::lang("Booking rooms");
if ($_SESSION["Lang"] == "en") {
    $this->keywords = array(
        "DAO Mansion",
        "Rent a house",
        "Rental Property",
        "Rent a room",
        "Guest House",
        "Web 3.0"
    );
    $this->description = "Real estate rental online";
} else if ($_SESSION["Lang"] == "zh") {
    $this->keywords = array(
        "DAO 大廈",
        "租一套公寓",
        "出租物業",
        "租一個房間",
        "招待所",
        "Web 3.0"
    );
    $this->description = '在線房地產租賃';
} else {
    $this->keywords = array(
        "DAO Особняк",
        "Снять жилье",
        "Аренда недвижимости",
        "Арендовать комнату",
        "Гостевой дом",
        "Web 3.0"
    );
    $this->description = "Аренда недвижимости онлайн";
}
$this->content .= engine::print_site_navigation(engine::lang("Booking rooms")).
$this->content .= engine::print_under_construction();
