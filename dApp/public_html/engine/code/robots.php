<?php
/**
* Robots.txt generator.
* @path /engine/code/robots.php
*
* @name    DAO Mansion    @version 1.0.2
* @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*/

echo 'User-agent: *
Host: '.$_SERVER["HTTP_HOST"].$_SERVER["DIR"].'
Disallow: /admin$
Disallow: /account$
Disallow: /apps/
Disallow: /font/
Disallow: /res/
Disallow: *.php
Allow: /sitemap.php
Sitemap: '.$_SERVER["PUBLIC_URL"].'/sitemap.xml';
