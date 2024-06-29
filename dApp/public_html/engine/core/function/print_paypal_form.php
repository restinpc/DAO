<?php
/**
* Prints PayPal payment form.
* @path /engine/core/function/print_paypal_form.php
*
* @name    DAO Mansion    @version 1.0.3
* @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*
* @param int $invoice_id @mysql[nodes_invoice->id].
* @param double $sum Amount to pay via PayPal.
* @param string $return URL for redirection after payment.
* @param bool $autopay Autosubmit form flag.
* @return string Returns content of block on success, or die with error.
* @usage <code> engine::print_paypal_form(1, 100, $_SERVER["PUBLIC_URL"]); </code>
*/

function print_paypal_form($invoice_id, $sum, $return, $autopay=0) {
    if (empty($_SESSION["user"]["id"])) {
        return engine::error(401);
    }
    $query = 'SELECT * FROM `nodes_config` WHERE `name` = "paypal_test"';
    $res = engine::mysql($query);
    $data = mysqli_fetch_array($res);
    if ($data["value"]) {
        $domain = 'www.sandbox.paypal.com';
    } else { 
        $domain = 'www.paypal.com';
    }
    if (strpos("http", $return) != 0) {
        $return = $_SERVER["PROTOCOL"].'://'.$_SERVER['HTTP_HOST'].$_SERVER["DIR"].$return;
    }
    $query = 'SELECT * FROM `nodes_config` WHERE `name` = "paypal_id"';
    $res = engine::mysql($query);
    $paypal = mysqli_fetch_array($res);
    $paypal_id = $paypal["value"];
    $query = 'SELECT * FROM `nodes_config` WHERE `name` = "payment_description"';
    $res = engine::mysql($query);
    $paypal = mysqli_fetch_array($res);
    $paypal_desc = $paypal["value"];
    $fout .= '<form id="paypal_form" action="https://'.$domain.'/cgi-bin/webscr" method="post" target="_top" '.($autopay?' class="hidden"':'').'>			
        <input type="hidden" name="cmd" value="_xclick">
        <input type="hidden" name="business" value="'.$paypal_id.'">
        <input type="hidden" name="item_name" value="'.$paypal_desc.'">
        <input type="hidden" name="currency_code" value="USD">
        <input type="hidden" name="amount" value="'.floatval($sum).'">
        <input type="hidden" name="cancel_return" value="'.$return.'">
        <input type="hidden" name="return" value="'.$return.'">
        <input type="hidden" name="no_shipping" value="1">
        <input type="hidden" name="notify_url" value="'.$_SERVER["PUBLIC_URL"].'/paypal.php?invoice_id='.$invoice_id.'">
        <button id="paypal-button-payment" type="submit" class="btn w280">'.engine::lang("Make a payment").'</button>
    </form>';
    if ($autopay) {
        $fout.= '<script> $id("paypal_form").submit();</script>';
    }
    return $fout;
}
