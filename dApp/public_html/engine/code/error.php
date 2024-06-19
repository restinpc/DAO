<?php
/**
* Error file.
* @path /engine/code/error.php
*
* @name    DAO Mansion    @version 1.0.2
* @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*/
require_once("engine/nodes/session.php");
$fout = '
<style>
#div{
    text-align: center; 
    color: #2e3137;  
    width: 100%; 
    border: 0px solid; 
    padding-top: 150px;
    font-family: Sans-Serif;
    line-height: 1.0;
    color: #fff;
}  
#caption{
    z-index: 0; 
    height: 40px; 
    z-index: 0;  
    padding-top: 10px;
    min-width: 100px;
}
#robot{
    float:right;
    margin-right: 15%;
}
#redirect a{
    font-size: 16px; 
    color: #2eb8b3;
    text-decoration: none;
}
.error_code{
    font-size: 120px;
}
.error_text{
    font-size: 28px;
}
.clear{
    clear:both;
    height: 100px;
}
@media (max-width: 680px) {
    #robot{
        display: none;
    }
    #div{
        padding-top: 100px;
    }
}
</style>
<div id="div">
    <div id="robot"><img src="data:image/png;base64,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" /></div>
    <div id="caption">';
        if(isset($_GET["504"])){
            $fout .= '
        <span class="error_code">504</span><br/><br/>
        <span class="error_text">'.engine::lang("Gateway Timeout").'</span>
                ';
        }else if(isset($_GET["204"])){
            if(empty($_POST["jQuery"])){
                header("HTTP/1.0 204 No Content");
            }
            $fout .= '
        <span class="error_code">204</span><br/><br/>
        <span class="error_text">'.engine::lang("Under construction").'</span>
                ';
        }else if(isset($_GET["401"])){
            if(empty($_POST["jQuery"])){
                header("HTTP/1.0 401 No Content");
            }
            $fout .= '
        <span class="error_code">401</span><br/><br/>
        <span class="error_text">'.engine::lang("Access denied").'</span>
        <br/><br/><br/>';
            if(empty($_SESSION["user"])){
                $fout .= '<span id="redirect"><a id="error-login" hreflang="'.$_SESSION["Lang"].'" href="'.engine::href($_SERVER["DIR"].'/login').'">'.engine::lang("Login to website").'</a></span><br/>';
            }else{
                $fout .= '<span id="redirect"><a id="error-home-page" hreflang="'.$_SESSION["Lang"].'" href="'.engine::href($_SERVER["DIR"].'/').'">'.engine::lang("Back to Home Page").'</a></span><br/>';
            }
        }else if(isset($_GET["500"])){
            if(empty($_POST["jQuery"])){
                header('HTTP/1.1 500 Internal Server Error' );
            }
            $fout .= '
        <span class="error_code">500</span><br/><br/>
        <span class="error_text">'.engine::lang("Internal Server Error").'</span>
        <br/><br/><br/>
        <span id="redirect"><a id="error-home-page" hreflang="'.$_SESSION["Lang"].'" href="'.engine::href($_SERVER["DIR"].'/').'">'.engine::lang("Back to Home Page").'</a></span><br/>
<!--
MySQL -> '.mysqli_error($_SERVER["sql_connection"]).'; 
PHP -> '.print_r(error_get_last(), 1).';
-->
        ';
        }else{
            if(empty($_POST["jQuery"])){
                header("HTTP/1.0 404 Not Found");
            }
            $fout .= '
        <span class="error_code">404</span><br/><br/>
        <span class="error_text">'.engine::lang("Page not found").'</span>
        <br/><br/><br/>
        <span id="redirect"><a id="error-home-page" hreflang="'.$_SESSION["Lang"].'" href="'.engine::href($_SERVER["DIR"].'/').'">'.engine::lang("Back to Home Page").'</a></span><br/>
                ';
        }
        $fout .= '
    </div>
</div>
<div class="clear">&nbsp;</div>';
echo str_replace("  ", " ", str_replace("
", "", $fout));


