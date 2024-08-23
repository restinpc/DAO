<?php
/**
 * Backend booking page file.
 * @path /engine/site/booking.php
 *
 * @name    DAO Mansion    @version 1.0.3
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

function booking($site) {
    engine::log('booking()');
    try {
        if (!empty($_GET[2])) {
            $site->content = engine::error();
            return;
        }
        $site->title = engine::lang("Booking rooms");
        if ($_SESSION["Lang"] == "en") {
            $site->keywords = array(
                "DAO Mansion",
                "Rent a house",
                "Rental Property",
                "Rent a room",
                "Guest House",
                "Web 3.0"
            );
            $site->description = "Real estate rental online";
        } else if ($_SESSION["Lang"] == "zh") {
            $site->keywords = array(
                "DAO 大廈",
                "租一套公寓",
                "出租物業",
                "租一個房間",
                "招待所",
                "Web 3.0"
            );
            $site->description = '在線房地產租賃';
        } else {
            $site->keywords = array(
                "DAO Особняк",
                "Снять жилье",
                "Аренда недвижимости",
                "Арендовать комнату",
                "Гостевой дом",
                "Web 3.0"
            );
            $site->description = "Аренда недвижимости онлайн";
        }
        $site->content .= engine::print_site_navigation(engine::lang("Booking rooms")).
        $site->content .= engine::print_under_construction();
    } catch(Exception $e) {
        engine::throw('booking()', $e);
    }
}

booking($this);