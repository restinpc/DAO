<?php
/**
* Bootstrap template file.
* @path /template/bootstrap/template.php
*
* @name    DAO Mansion    @version 1.0.3
* @license http://www.apache.org/licenses/LICENSE-2.0 GNU Public License
*
* @var $this->title - Page title
* @var $this->content - Page HTML data
* @var $this->keywords - Array meta keywords
* @var $this->description - Page meta description
* @var $this->img - Page meta image
* @var $this->onload - Page executable JavaScript code
* @var $this->configs - Array MySQL configs
*/

if(!isset($_POST["jQuery"])){
//  Header Start
$header = '
<nav class="navbar navbar-fixed-top" id="sectionsNav">
    <div class="container">
        <div class="navbar-header">
            <noindex>
                <button type="button" class="navbar-toggle" data-toggle="collapse">
                <span class="sr-only">'.engine::lang("Toggle navigation").'</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </noindex>
            <a class="navbar-brand" '.($_SERVER["app"] == "TRUE" ? '' : ' hreflang="'.$_SESSION["Lang"].'" href="'.engine::href('/').'"').'>
                <noindex class="material-icons nav-btn">home</noindex>
                <span>Mansion</span>
            </a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li id="menu_2" class="dropdown">
                    <a onClick="dropdown_menu(2);" class="nav_link dropdown_item" title="'.engine::lang("WebVR").'">
                        <noindex class="material-icons">panorama</noindex> 
                        <span class="navigation_caption lang_caption">'.engine::lang("WebVR").'</span> 
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a hreflang="'.$_SESSION["Lang"].'" href="'.engine::href('/webvr/free-look').'" target="_parent">'.engine::lang("Free look mode") .'</a></li>
                        <li><a hreflang="'.$_SESSION["Lang"].'" href="'.engine::href('/webvr/orbital').'" target="_parent">'.engine::lang("Orbital preview") .'</a></li>
                        <li><a hreflang="'.$_SESSION["Lang"].'" href="'.engine::href('/webvr/panorama').'" target="_parent">'.engine::lang("Panorama viewer") .'</a></li>
                        <li><a hreflang="'.$_SESSION["Lang"].'" href="'.engine::href('/webvr/metaverse').'" target="_parent">'.engine::lang("Metaverse") .'</a></li>
                    </ul>
                </li>
                <li id="menu_1" class="dropdown">
                    <a onClick="dropdown_menu(1);" class="nav_link dropdown_item" title="'.engine::lang("Content").'">
                        <noindex class="material-icons">folder</noindex> 
                        <span class="navigation_caption lang_caption">'.engine::lang("Content").'</span> 
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                    ';
    $query = 'SELECT * FROM `nodes_catalog` WHERE `visible` = "1" AND `lang` = "'.$_SESSION["Lang"].'" ORDER BY `order` DESC';
    $res = engine::mysql($query);
    while($data = mysqli_fetch_array($res)){
        $header .= '<li><a hreflang="'.$_SESSION["Lang"].'" href="'.engine::href($_SERVER["PUBLIC_URL"].'/content/'.$data["url"]).'" target="_parent">'.$data["caption"].'</a></li>';
    }
    $header .= '   
                    </ul>
                </li>
                <li id="menu_3" class="dropdown">
                    <a onClick="dropdown_menu(3);" class="nav_link dropdown_item" title="'.engine::lang("DAO").'">
                        <noindex class="material-icons">public</noindex> 
                        <span class="navigation_caption lang_caption">'.engine::lang("DAO").'</span> 
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a hreflang="'.$_SESSION["Lang"].'" href="'.engine::href($_SERVER["DIR"].'/dao/git').'" target="_parent">'.engine::lang("Git repository").'</a></li>
                        <li><a hreflang="'.$_SESSION["Lang"].'" href="'.engine::href($_SERVER["DIR"].'/dao/capitalization').'" target="_parent">'.engine::lang("Capitalization").'</a></li>
                        <!--
                        <li><a hreflang="'.$_SESSION["Lang"].'" href="'.engine::href($_SERVER["DIR"].'/dao/monitor').'" target="_parent">'.engine::lang("Blockchain monitor").'</a></li>
                        <li><a hreflang="'.$_SESSION["Lang"].'" href="'.engine::href($_SERVER["DIR"].'/dao/management').'" target="_parent">'.engine::lang("Decentralized management").'</a></li>
                        <li><a hreflang="'.$_SESSION["Lang"].'" href="'.engine::href($_SERVER["DIR"].'/dao/market').'" target="_parent">'.engine::lang("P2P marketplace").'</a></li>
                        -->
                    </ul>
                </li>
                <li id="menu_4" class="dropdown">
                    <a onClick="dropdown_menu(4);" class="nav_link dropdown_item" title="'.engine::lang("Social").'">
                        <noindex class="material-icons">groups</noindex> 
                        <span class="navigation_caption lang_caption">'.engine::lang("Social").'</span> 
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a hreflang="'.$_SESSION["Lang"].'" href="' .engine::href($_SERVER["DIR"].'/social/graph'). '" target="_parent">'.engine::lang("Social graph").'</a></li>
                        <li><a hreflang="'.$_SESSION["Lang"].'" href="' .engine::href($_SERVER["DIR"].'/social/telegram'). '" target="_parent">'.engine::lang("Telegram group").'</a></li>
                        <li><a hreflang="'.$_SESSION["Lang"].'" href="' .engine::href($_SERVER["DIR"].'/social/constitution'). '" target="_parent">'.engine::lang("Digital constitution").'</a></li>
                        <!--
                        <li><a hreflang="'.$_SESSION["Lang"].'" href="' .engine::href($_SERVER["DIR"].'/social/democracy'). '" target="_parent">'.engine::lang("Crypto democracy").'</a></li>
                        <li><a hreflang="'.$_SESSION["Lang"].'" href="' .engine::href($_SERVER["DIR"].'/social/crowdfunding'). '" target="_parent">'. engine::lang("Crowdfunding").'</a></li>
                        -->
                    </ul>
                </li>
                <li id="menu_0" class="dropdown">
                    <a onClick="dropdown_menu(0);" class="nav_link dropdown_item" title="'.engine::lang("dApp").'">
                        <noindex class="material-icons">apps</noindex> 
                        <span class="navigation_caption lang_caption">'.engine::lang("dApp").'</span> 
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a hreflang="'.$_SESSION["Lang"].'" href="' .engine::href($_SERVER["DIR"].'/developer'). '" target="_parent">'.engine::lang("Developed by").'</a></li>
                        <li><a hreflang="'.$_SESSION["Lang"].'" href="' .engine::href($_SERVER["DIR"].'/content/privacy_policy'). '" target="_parent">'.engine::lang("Privacy policy").'</a></li>
                        <li><a hreflang="'.$_SESSION["Lang"].'" href="' .engine::href($_SERVER["DIR"].'/content/terms_and_conditions'). '" target="_parent">'.engine::lang("Terms & conditions").'</a></li>
                    </ul>
                </li>
                <li id="menu_5" class="dropdown">
                    <a onClick="dropdown_menu(5);" class="nav_link dropdown_item" title="'.engine::lang("Language").'">
                        <noindex class="material-icons">language</noindex> 
                        <span class="navigation_caption lang_caption">'.engine::lang("Language").'</span> 
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a hreflang="ru" href="?lang=ru" target="_parent">'.($_SESSION["Lang"]=="ru"?'<noindex class="material-icons">done</noindex>':'').' Русский </a></li>
                        <li><a hreflang="zh" href="?lang=zh" target="_parent">'.($_SESSION["Lang"]=="zh"?'<noindex class="material-icons">done</noindex>':'').' 中國人 </a></li>
                        <li><a hreflang="en" href="?lang=en" target="_parent">'.($_SESSION["Lang"]=="en"?'<noindex class="material-icons">done</noindex>':'').' English </a></li>
                    </ul>
                </li>
                <div id="header-app" lang="'.$_SESSION["Lang"].'" dir="'.$_SERVER["DIR"].'" isApp="'.($_SERVER["app"]=="TRUE").'"></div>
                <script id="header-script" src="'.$_SERVER["DIR"].'/apps/header/bundle.js"></script>
            </ul>
        </div>
    </div>
</nav>
<div class="wrapper"></div>
<div id="content">
<!-- content -->
';
//  Header End
//------------------------------------------------------------------------------
//  Footer Start
$footer = '
<!-- /content -->
</div>
<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
    setTimeout(() => {
       (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)}; m[i].l=1*new Date();
       for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
       k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
       (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");
       ym(94315933, "init", { clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true });
   }, 1000);
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/94315933" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->';
}
$this->content = $header.$this->content.$footer;
