<?php
/**
* Print account finance page.
* @path /engine/core/account/print_finances.php
*
* @name    DAO Mansion    @version 1.0.3
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
* @param object $site Site class object.
* @return string Returns content of page on success, or die with error.
* @usage <code> engine::print_finances($site); </code>
*/

function print_finances($site){
    $fout = '<div class="document640">';
    if ($_GET[2] == "withdrawal") {
        if (!empty($_POST["amount"])) {
            $method = engine::escape_string($_POST["method"]);
            $id = engine::escape_string($_POST["id"]);
            $query = 'SELECT * FROM `nodes_user` WHERE `id` = "'.$_SESSION["user"]["id"].'"';
            $res = engine::mysql($query);
            $user = mysqli_fetch_array($res);
            $query = 'SELECT * FROM `nodes_transaction` WHERE `user_id` = "'.$user["id"].'" AND `status` = "1"';
            $res = engine::mysql($query);
            $data = mysqli_fetch_array($res);
            if (!empty($data)) {
                die(engine::lang("Withdrawal already requested"));
            }
            $query = 'INSERT INTO `nodes_transaction`(user_id, order_id, amount, status, date, comment)'
                    . 'VALUES("'.$_SESSION["user"]["id"].'", "0", "'.$user["balance"].'", "1", "'.date("U").'", "'.$method.';'.$id.'" )';
            engine::mysql($query);
            email::new_withdrawal($user["id"], $user["balance"], $method, $id);
            $fout .= '<div class="clear_block">'.engine::lang("Withdrawal request accepted").'!</div>
                <a id="back-to-finance" href="'.engine::href($_SERVER["DIR"].'/account/finances').'">
                    <input type="button" class="btn w280" value="'.engine::lang("Back to finances").'" />
                </a>
                <br/>
                <br/>';
        } else {
            $query = 'SELECT * FROM `nodes_user` WHERE `id` = "'.$_SESSION["user"]["id"].'"';
            $res = engine::mysql($query);
            $data = mysqli_fetch_array($res);
            $fout .= '<h2>'.engine::lang("Request for withdrawal of funds").'</h2><br/>
                <p class="lh2">'.engine::lang("Your withdrawal request will be processed within a few days of submitting").'.</p><br/>
                <form method="POST">
                    <div class="withdrawal_table">
                        <div class="table_row">
                            <div class="withdrawal_left_cell">'.engine::lang("Amount").', $:</div>
                            <div class="table_cell">
                                <input id="input-amount" required type="text" class="input w100p" name="amount" value="'.$data["balance"].'" />
                                <br/><br/>
                            </div>
                        </div>
                        <div class="table_row">
                            <div class="withdrawal_left_cell">'.engine::lang("Wallet").':</div>
                            <div class="table_cell">
                                <select  id="select-payment-method" required class="input w100p" name="method">
                                    <option id="option-paypal">PayPal</option>
                                    <option id="option-yandex">Yandex Money</option>
                                    <option id="option-bitcoin">Bitcoin</option>
                                </select><br/><br/>
                            </div>
                        </div>
                        <div class="table_row">
                            <div class="withdrawal_left_cell">'.engine::lang("Wallet ID").':</div>
                            <div class="table_cell">
                                <input required type="text" class="input w100p" name="id" />
                                <br/><br/>
                            </div>
                        </div>
                    </div>
                    <input id="confirm-request" type="submit" class="btn w280" value="'.engine::lang("Confirm request").'" /><br/><br/>
                    <a id="back-to-finance" href="'.engine::href($_SERVER["DIR"].'/account/finances').'">
                        <input type="button" class="btn w280" value="'.engine::lang("Back to finances").'" />
                    </a>
                    <br/>
                    <br/>
                </form>';
        }
    } else {
        $query = 'SELECT * FROM `nodes_user` WHERE `id` = "'.$_SESSION["user"]["id"].'"';
        $res = engine::mysql($query);
        $data = mysqli_fetch_array($res);
        if (doubleval($_POST["amount"]) > 0) {
            $amount = doubleval($_POST["amount"]);
            $query = 'INSERT INTO `nodes_invoice`(user_id, order_id, amount, date) '
                    . 'VALUES("'.$_SESSION["user"]["id"].'", "-1", "'.$amount.'", "'.date("Y-m-d H:i:s").'")';
            engine::mysql($query);
            return engine::redirect("/invoice.php?id=". mysqli_insert_id($_SERVER["sql_connection"]));
        }
        $balance = $data["balance"];
        if ($balance > $_SESSION["user"]["balance"]) {
            $site->onload .= 'alert("'.engine::lang("The funds have been added to your account balance").'");';
            $_SESSION["user"]["balance"] = $balance;
        }
        $pending = 0;
        $query = 'SELECT * FROM `nodes_product` WHERE `user_id` = "'.$_SESSION["user"]["id"].'"';
        $res = engine::mysql($query);
        while ($d = mysqli_fetch_array($res)) {
            $query = 'SELECT * FROM `nodes_product_order` WHERE `product_id` = "'.$d["id"].'" AND `status` = "1"';
            $r = engine::mysql($query);
            while ($order = mysqli_fetch_array($r)) {
                $pending += $order["price"];
            }
        }
        $fout.= engine::lang('Balance').': <b>$'.$balance."</b>";
        if ($pending > 0) {
            $fout.= "  ".engine::lang("Pending").": <b>$".$pending.'</b>';
        }
        $fout.= '<br/><br/>'
            . '<form method="POST" class="hidden">'
                . '<input type="hidden" id="paypal_price" name="amount" value="0" />'
                . '<input type="submit" id="pay_button" />'
            . '</form>';
        if ($_SESSION["order"] == "id") {
            $_SESSION["order"] = "date";
        }
        $arr_count = 0;
        $from = ($_SESSION["page"]-1)*$_SESSION["count"]+1;
        $to = ($_SESSION["page"]-1)*$_SESSION["count"]+$_SESSION["count"];
        $query = 'SELECT * FROM `nodes_transaction` WHERE `status` > 0 AND `user_id` = "'.$_SESSION["user"]["id"].'"'
                . ' ORDER BY `'.$_SESSION["order"].'` '.$_SESSION["method"].' LIMIT '.($from-1).', '.$_SESSION["count"];
        $requery = 'SELECT COUNT(*) FROM `nodes_transaction` WHERE `status` > 0 AND `user_id` = "'.$_SESSION["user"]["id"].'"';
        $table = '
            <div class="table">
            <table width=100% id="table">
            <thead>
            <tr>';
                $array = array(
                    "order_id" => "Type",
                    "amount" => "Amount",
                    "status" => "Status",
                    "date" => "Date"
                );
                foreach ($array as $order=>$value) {
                    $table .= '<th>';
                    if ($_SESSION["order"] == $order) {
                        if ($_SESSION["method"] == "ASC") {
                            $table .= '<a id="table-order-'.$order.'" class="link" href="#" onClick=\'$id("order").value = "'.$order.'"; $id("method").value = "DESC"; document.framework.submit_search_form();\'>'.engine::lang($value).' &uarr;</a>';
                        } else {
                            $table .= '<a id="table-order-'.$order.'" class="link" href="#" onClick=\'$id("order").value = "'.$order.'"; $id("method").value = "ASC"; document.framework.submit_search_form();\'>'.engine::lang($value).' &darr;</a>';
                        }
                    } else {
                        $table .= '<a id="table-order-'.$order.'" class="link" href="#" onClick=\'$id("order").value = "'.$order.'"; $id("method").value = "ASC"; document.framework.submit_search_form();\'>'.engine::lang($value).'</a>';
                    }
                    $table .= '</th>';
                }
                $table .= '
                <th></th>
            </tr>
            </thead>';
        $is_withdrawal = 1;
        $res = engine::mysql($query);
        while ($data = mysqli_fetch_array($res)) {
            $arr_count++;
            if ($data["order_id"]=="0") {
                $type = engine::lang("Withdrawal request");
                $data["amount"] = -$data["amount"];
                if ($data["status"] == "1") {
                    $is_withdrawal = 0;
                }
            } else if ($data["order_id"] == "-1") {
                $type = engine::lang("Money deposit");
            } else if ($data["order_id"] == "-2") {
                $type = engine::lang("Transaction from admin");
            } else {
                $type = engine::lang("Order")." #".$data["order_id"]." payment";
            }
            if ($data["status"] == "0") {
                $status = engine::lang("New");
            } else if ($data["status"] == "1") {
                $status = engine::lang("Pending");
            } else if ($data["status"] == "2") {
                $status = engine::lang("Finished");
            }
            $button = '';
            if (intval($data["invoice_id"]) > 0) {
                $button = '<a id="view-invoice" onClick=\'window.open("/invoice.php?id='.$data["invoice_id"].'");\' class="btn small">'.engine::lang("View invoice").'</a>';
            }
            $table .= '<tr>
                <td align=left valign=middle>'.$type.'</td>
                <td align=left valign=middle>'.$data["amount"].'$</td>
                <td align=left valign=middle>'.$status.'</td>
                <td align=left valign=middle title="'.date("d.m H:i", $data["date"]).'">'.date("d.m", $data["date"]).'</td>
                <td>'.$button.'</td>
            </tr>';
        }
        $table .= '</table>
        </div>';
        if ($arr_count) {
            $fout.= $table.'
        <form method="POST"  id="query_form"  onSubmit="document.framework.submit_search_form();">
        <input type="hidden" name="page" id="page_field" value="'.$_SESSION["page"].'" />
        <input type="hidden" name="count" id="count_field" value="'.$_SESSION["count"].'" />
        <input type="hidden" name="order" id="order" value="'.$_SESSION["order"].'" />
        <input type="hidden" name="method" id="method" value="'.$_SESSION["method"].'" />
        <div class="total-entry">';
        $res = engine::mysql($requery);
        $data = mysqli_fetch_array($res);
        $count = $data[0];
        if ($to > $count) {
            $to = $count;
        }
        if ($data[0] > 0) {
            $fout .= '<p class="p5">'.engine::lang("Showing").' '.$from.' '.engine::lang("to").' '.$to.' '.engine::lang("from").' '.$count.' '.engine::lang("entries").', 
                <nobr><select  id="select-pagination" class="input" onChange=\'$id("count_field").value = this.value; document.framework.submit_search_form();\' >
                 <option id="option-pagination-20"'; if($_SESSION["count"]=="20") $fout.= ' selected'; $fout.= '>20</option>
                 <option id="option-pagination-50"'; if($_SESSION["count"]=="50") $fout.= ' selected'; $fout.= '>50</option>
                 <option id="option-pagination-100"'; if($_SESSION["count"]=="100") $fout.= ' selected'; $fout.= '>100</option>
                </select> '.engine::lang("per page").'.</nobr></p>';
        }
        $fout.= '
        </div>
        <div class="cr"></div>';
        if ($count > $_SESSION["count"]) {
            $fout.= '<div class="pagination" >';
            $pages = ceil($count/$_SESSION["count"]);
            if ($_SESSION["page"]> 1) {
                $fout.= '<span  id="list-prev" onClick=\'document.framework.goto_page('.($_SESSION["page"]-1).');\'><a hreflang="'.$_SESSION["Lang"].'" href="#">'.engine::lang("Previous").'</a></span>';
            }
            $fout.= '<ul>';
            $a = $b = $c = $d = $e = $f = 0;
            for ($i = 1; $i <= $pages; $i++) {
                if (($a<2 && !$b && $e<2)||
                ($i >=( $_SESSION["page"]-2) && $i <=( $_SESSION["page"]+2) && $e<5)||
                ($i>$pages-2 && $e<2)) {
                    if ($a<2) {
                        $a++;
                    }
                    $e++; $f = 0;
                    if ($i == $_SESSION["page"]) {
                        $b = 1; $e = 0;
                       $fout.= '<li class="active-page">'.$i.'</li>';
                    } else {
                        $fout.= '<li  id="list-page-'.$i.'" onClick=\'document.framework.goto_page('.($i).');\'><a hreflang="'.$_SESSION["Lang"].'" href="#">'.$i.'</a></li>';
                    }
                } else if((!$c||!$b) && !$f && $i<$pages) {
                    $f = 1; $e = 0;
                    if(!$b) {
                        $b = 1;
                    } else if(!$c) {
                        $c = 1;
                    }
                    $fout.= '<li class="dots">. . .</li>';
                }
            }
            if($_SESSION["page"]<$pages){
               $fout.= '<li  id="list-previous" class="next" onClick=\'document.framework.goto_page('.($_SESSION["page"]+1).');\'><a hreflang="'.$_SESSION["Lang"].'" href="#">'.engine::lang("Next").'</a></li>';
            }
            $fout.= '
            </ul>
        </div>';
             }
             $fout.= '<div class="clear"><br/></div>';
        } else {
            $fout.= '<div class="clear_block">'.engine::lang('Transactions not found').'</div>';
        }
        if ($balance>0 && $is_withdrawal) {
            $fout.= '<a id="request_withdrawal" href="'.$_SERVER["DIR"].'/account/finances/withdrawal"><input type="button" class="btn w280" value="'.engine::lang("Request withdrawal").'" /></a><br/><br/>';
        }
        $fout.=  '<input id="input-deposit" type="button" class="btn w280" value="'.engine::lang("Deposit money").'" onClick=\'document.framework.deposit("'.engine::lang("Amount to deposit").'");\' /><br/><br/>';
    }
    $fout .= '</div>';
    return $fout;
}
