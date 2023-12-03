<?php
/**
* Bootstrap template file.
* @path /template/bootstrap/template.php
*
* @name    DAO Mansion    @version 1.0.0
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
                <span class="sr-only">'.lang("Toggle navigation").'</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </noindex>
            <a class="navbar-brand" '.($_SERVER["app"]=="TRUE"?'':' href="/"').'>
                <noindex class="material-icons nav-btn">home</noindex>
                <span>Mansion</span>
            </a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
            
                <li id="menu_2" class="dropdown">
                    <a onClick="dropdown_menu(2);" class="nav_link dropdown_item" title="'.lang("WebVR").'">
                        <noindex class="material-icons">panorama</noindex> 
                        <span class="navigation_caption lang_caption">'.lang("WebVR").'</span> 
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="/webvr/free-look" target="_parent">'.lang("Free look mode") .'</a></li>
                        <li><a href="/webvr/orbital" target="_parent">'.lang("Orbital preview") .'</a></li>
                        <li><a href="/webvr/panorama" target="_parent">'.lang("Panorama viewer") .'</a></li>
                        <li><a href="/webvr/metaverse" target="_parent">'.lang("Metaverse") .'</a></li>
                        <li><a href="/webvr/multiplayer" target="_parent">'.lang("Multiplayer scene").'</a></li>
                    </ul>
                </li>
                <li id="menu_1" class="dropdown">
                    <a onClick="dropdown_menu(1);" class="nav_link dropdown_item" title="'.lang("Content").'">
                        <noindex class="material-icons">folder</noindex> 
                        <span class="navigation_caption lang_caption">'.lang("Content").'</span> 
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                    ';
    $query = 'SELECT * FROM `nodes_catalog` WHERE `visible` = "1" AND `lang` = "'.$_SESSION["Lang"].'" ORDER BY `order` DESC';
    $res = engine::mysql($query);
    while($data = mysqli_fetch_array($res)){
        $header .= '<li><a href="'.$_SERVER["PUBLIC_URL"].'/content/'.$data["url"].'" target="_parent">'.$data["caption"].'</a></li>';
    }
    $header .= '   
                    </ul>
                </li>
                <li id="menu_3" class="dropdown">
                    <a onClick="dropdown_menu(3);" class="nav_link dropdown_item" title="'.lang("DAO").'">
                        <noindex class="material-icons">public</noindex> 
                        <span class="navigation_caption lang_caption">'.lang("DAO").'</span> 
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="/dao/git" target="_parent">'.lang("Git repository").'</a></li>
                        <li><a href="/dao/capitalization" target="_parent">'.lang("Capitalization").'</a></li>
                        <!--
                        <li><a href="/dao/monitor" target="_parent">'.lang("Blockchain monitor").'</a></li>
                        <li><a href="/dao/management" target="_parent">'.lang("Decentralized management").'</a></li>
                        <li><a href="/dao/market" target="_parent">'.lang("P2P marketplace").'</a></li>
                        -->
                    </ul>
                </li>
                <li id="menu_4" class="dropdown">
                    <a onClick="dropdown_menu(4);" class="nav_link dropdown_item" title="'.lang("Social").'">
                        <noindex class="material-icons">groups</noindex> 
                        <span class="navigation_caption lang_caption">'.lang("Social").'</span> 
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="/social/graph" target="_parent">'.lang("Social graph").'</a></li>
                        <li><a href="/social/telegram" target="_parent">'.lang("Telegram group").'</a></li>
                        <li><a href="/social/constitution" target="_parent">'.lang("Digital constitution").'</a></li>
                        <!-- <li><a href="/social/democracy" target="_parent">'.lang("Crypto democracy").'</a></li>
                        <li><a href="/social/crowdfunding" target="_parent">'. lang("Crowdfunding").'</a></li> -->
                    </ul>
                </li>
                <li id="menu_0" class="dropdown">
                    <a onClick="dropdown_menu(0);" class="nav_link dropdown_item" title="'.lang("dApp").'">
                        <noindex class="material-icons">apps</noindex> 
                        <span class="navigation_caption lang_caption">'.lang("dApp").'</span> 
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="/developer" target="_parent">'.lang("Developed by").'</a></li>
                        <li><a href="/content/privacy_policy" target="_parent">'.lang("Privacy policy").'</a></li>
                        <li><a href="/content/terms_and_conditions" target="_parent">'.lang("Terms & conditions").'</a></li>
                    </ul>
                </li>
                <li id="menu_5" class="dropdown">
                    <a onClick="dropdown_menu(5);" class="nav_link dropdown_item" title="'.lang("Language").'">
                        <noindex class="material-icons">language</noindex> 
                        <span class="navigation_caption lang_caption">'.lang("Language").'</span> 
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="?lang=ru" target="_parent">'.($_SESSION["Lang"]=="ru"?'<noindex class="material-icons">done</noindex>':'').' Русский </a></li>
                        <li><a href="?lang=zh" target="_parent">'.($_SESSION["Lang"]=="zh"?'<noindex class="material-icons">done</noindex>':'').' 中國人 </a></li>
                        <li><a href="?lang=en" target="_parent">'.($_SESSION["Lang"]=="en"?'<noindex class="material-icons">done</noindex>':'').' English </a></li>
                    </ul>
                </li>
            ';
if (empty($_SESSION["user"]["id"])) {
    $header .= '<li>
                    <a target="_parent" id="b1" href="'.$_SERVER["DIR"].'/signup" class="btn btn-round">
                        <noindex class="material-icons">person_add</noindex> '.lang("Sign Up").'
                    </a>
                </li>
                <li>
                    <a target="_parent" id="b2" href="'.$_SERVER["DIR"].'/login" class="btn btn-round">
                        <noindex class="material-icons">account_circle</noindex> '.lang("Login").'
                    </a>
                </li>
                ';
} else {
    if ($_SESSION["user"]["admin"] != 1) {
        $header .= '<li>
                    <a href="'.$_SERVER["DIR"].'/account"  onClick="hide_menu();"  id="b1" class="btn btn-round">
                        <noindex class="material-icons">person</noindex> '.lang("Account").'
                    </a>
                </li>';
    } else {
        $header .= '<li>
                    <a href="'.$_SERVER["DIR"].'/admin"  onClick="hide_menu(); js_hide_wnd();"  id="b1" class="btn btn-round">
                        <noindex class="material-icons">person</noindex> '.lang("Admin").'
                    </a>
                </li>';
    }
    $header .= '
                <li>
                    <a target="_parent" id="b2"  onClick="hide_menu(); logout();" class="btn btn-round">
                        <noindex class="material-icons">directions_run</noindex> '.lang("Logout").'
                    </a>
                </li>
                ';
    if ($_SERVER["app"]=="TRUE") {
            $header .= '
                <li>
                    <a target="_top" id="b3" onClick=\'window.location = "/#close";\' class="btn btn-round">
                        <noindex class="material-icons">close</noindex> '.lang("Close Application").'
                    </a>
                </li>
                ';
    }
}
$header .= '
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
