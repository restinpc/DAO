<?php
/**
* Prints Yandex payment form.
* @path /engine/core/function/print_yandex_form.php
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
* @usage <code> engine::print_yandex_form(1, 100, $_SERVER["PUBLIC_URL"]); </code>
*/

function print_yandex_form($invoice_id, $sum, $return, $autopay = 0) {
    if (empty($_SESSION["user"]["id"])) {
        return engine::error(401);
    }
    if (strpos("http", $return) !== false) {
        $return = $_SERVER["PUBLIC_URL"].$return;
    }
    $fout .= '
        <form method="POST" action="https://money.yandex.ru/quickpay/confirm.xml" id="yandex_form" target="_top">
            <input type="hidden" name="receiver" value="'.$_SERVER["configs"]["yandex_money"].'">
            <input type="hidden" name="formcomment" value="'.$_SERVER["configs"]["payment_description"].'">
            <input type="hidden" name="short-dest" value="'.$_SERVER["configs"]["payment_description"].'">
            <input type="hidden" name="label" value="'.$invoice_id.'">
            <input type="hidden" name="targets" value="'.$invoice_id.'">
            <input type="hidden" name="quickpay-form" value="shop">
            <input type="hidden" name="sum" value="'.floatval($sum).'">
            <input type="hidden" name="need-fio" value="false">
            <input type="hidden" name="need-email" value="false">
            <input type="hidden" name="need-phone" value="false">
            <input type="hidden" name="need-address" value="false"> 
            <input type="hidden" name="successURL" value="'.$return.'" />
            <button id="yandex-button-payment" type="submit" class="btn w280">'.engine::lang("Make a payment").'</button>
        </form>';
    if ($autopay) {
        $fout.= '<script> $id("yandex_form").submit();</script>';
    }
    return $fout;
}
