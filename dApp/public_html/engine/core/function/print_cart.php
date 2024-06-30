<?php
/**
* Prints cart block.
* @path /engine/core/function/print_cart.php
*
* @name    DAO Mansion    @version 1.0.3
* @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*
* @param int $count Number of items in cart.
* @return string Returns content of block on success, or die with error.
* @usage <code> engine::print_cart(1); </code>
*/

require_once("engine/nodes/session.php");

function print_cart($count) {
    $fout = '<div class="buy_cart">
        <div id="nodes_cart" class="'.($count > 0 ? '' : 'hidden').'" onClick=\'document.framework.showOrder();\'>
            <div class="cart_labels">
                <div class="label_1"><a id="cart_link">'.engine::lang("Your Shopping Cart").'</a></div> 
                <div class="label_2 cart_img">&nbsp;</div> 
                <div class="label_3"> <span class="purcases_count">'.$count.'</span> '.engine::lang("item(s)").'</div>
            </div>
        </div>
        <div id="nodes_cart_wrapper" class="'.($count > 0 ? '' : 'hidden').'"> </div>
    </div>';
    return $fout;
}
