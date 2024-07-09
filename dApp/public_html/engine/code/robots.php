<?php
/**
* Robots.txt generator.
* @path /engine/code/robots.php
*
* @name    DAO Mansion    @version 1.0.3
* @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*/

function robots() {
    engine::log('robots()');
    try {
        echo 'User-agent: *
Host: '.$_SERVER["HTTP_HOST"].'
Disallow: '.$_SERVER["DIR"].'/admin$
Disallow: '.$_SERVER["DIR"].'/account$
Disallow: '.$_SERVER["DIR"].'/apps/
Disallow: '.$_SERVER["DIR"].'/font/
Disallow: '.$_SERVER["DIR"].'/res/
Disallow: *.php
Allow: '.$_SERVER["DIR"].'/sitemap.php
Sitemap: '.$_SERVER["PUBLIC_URL"].'/sitemap.xml';
    } catch(Exception $e) {
        engine::throw('robots()', $e);
    }
}

robots();
