<?php
/**
* Print email confirmation page.
* @path /engine/core/account/print_email_confirm.php
*
* @name    DAO Mansion    @version 1.0.2
* @author  Aleksandr Vorkunov  <developing@nodes-tech.ru>
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
* @param object $site Site class object.
* @return string Returns content of page on success, or die with error.
* @usage <code> engine::print_email_confirm($site); </code>
*/
function print_email_confirm($site){
    $code = '';
    if(!empty($_POST["code"])){
        $code = $_POST["code"];
    }else if(!empty($_GET[1])){
        $code = $_GET[1];
    }
    if(!empty($code)){
        if($code==$_SESSION["user"]["code"]){
            $query = 'UPDATE `nodes_user` SET `confirm` = 1 WHERE `id` = "'.$_SESSION["user"]["id"].'"';
            engine::mysql($query);
            die('<script>window.location = "'.$_SERVER["DIR"].'/account";</script>');
        }else{
            $site->onload .= ' alert("'.engine::lang("Error").'. '.engine::lang("Invalid confirmation code").'"); ';
        }
    }
    $fout = '<div class="document640">
            <h3>'.engine::lang("Account confirmation").'</h3><br/><br/>'
            . '<form method="POST">'
            . '<input id="confirmation-code" type="text" class="input w280" required name="code" placeHolder="'.engine::lang("Confirmation code").'" />'
            . '<br/><br/>'
            . '<input id="input-submit" type="submit" class="btn w280" value="'.engine::lang("Submit").'" />'
            . '</form>'
        . '</div>';
    return $fout;
}
