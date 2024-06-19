<?php
/**
 * Prints under construction block.
 * @path /engine/core/function/print_under_construction.php
 *
 * @name    DAO Mansion    @version 1.0.2
 * @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 *
 * @var $site->title - Page title.
 * @var $site->content - Page HTML data.
 * @var $site->keywords - Array meta keywords.
 * @var $site->description - Page meta description.
 * @var $site->img - Page meta image.
 * @var $site->onload - Page executable JavaScript code.
 * @var $site->configs - Array MySQL configs.
 *
 * @return string Returns content of block.
 * @usage <code> engine::print_under_construction(); </code>
 */

function print_under_construction() {
    return '<div class="under-construction">
        <img src="/img/banner.jpg" />
    </div>';
}
