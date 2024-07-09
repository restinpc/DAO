<?php
/**
* Email library.
* @path /engine/core/email.php
*
* @name    DAO Mansion    @version 1.0.3
* @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*
* @example <code> email::daily_report(); </code>
*/

class email{
/**
* Generates HTML template for a message.
*
* @param string $text Text of message.
* @return string Returns generated HTML of message to email.
*/
static function email_template($text) {
    engine::log('email::email_template('.$text.')');
    $css = file_get_contents("template/email.css");
    if (empty($css)) {
        $css = file_get_contents ($_SERVER["DOCUMENT_ROOT"].$_SERVER["DIR"].'/template/email.css');
    }
    if ($_SERVER["configs"]["email_image"][0] == "/") {
        $_SERVER["configs"]["email_image"] = $_SERVER["PUBLIC_URL"].$_SERVER["configs"]["email_image"];
    }
    $fout = '<style>'.$css.'</style>
        <div class="document">';
    if (!empty($_SERVER["configs"]["email_image"])) {
        $file = engine::curl_get_query($_SERVER["configs"]["email_image"]);
        $image = base64_encode($file);
        $fout .= '<img src="data:image/png;base64,'.$image.'" alt="'.$_SERVER["configs"]["name"].'" title="'.$_SERVER["configs"]["name"].'" /><br/><br/>';
    }
    $fout .= ' <p>'.$text.'</p><hr/>
        <center>'.engine::lang("Thanks for using our service").' <a href="'.$_SERVER["PUBLIC_URL"].'/" target="_blank">'.$_SERVER["configs"]["name"]["value"].'</a></center>
        </div>';
    return $fout;
}
/**
* Sends a message to specified user.
*
* @param array $data Array, based on @mysql[nodes_user_outbox].
*/
static function bulk_mail($data) {
    engine::log('email::bulk_mail('.$data.')');
    $_SERVER["configs"]["name"] = $_SERVER["configs"]["name"];
    $language = $_SESSION["Lang"];
    $query = 'SELECT `id`,`name`,`email`, `lang` FROM `nodes_user` WHERE `id` = "'.$data["user_id"].'"';
    $res = engine::mysql($query);
    $user = mysqli_fetch_array($res);
    $_SESSION["Lang"] = $user["lang"];
    $query = 'SELECT * FROM `nodes_outbox` WHERE `id` = "'.$data["outbox_id"].'"';
    $res = engine::mysql($query);
    $outbox = mysqli_fetch_array($res);
    if ($outbox["action"] == 1) {
        $query = 'INSERT INTO `nodes_inbox`(`from`, `to`, `text`, `date`) '
            . 'VALUES("1", "'.intval($user["id"]).'", "'.$outbox["text"].'", "'.date("U").'")';
        engine::mysql($query);
        $caption = engine::lang("New message at").' '.$_SERVER["HTTP_HOST"];
        $body = engine::lang('Dear').' '.$user["name"].'!<br/><br/>
            Admin '.engine::lang("sent a message for you").'!<br/>
            '.engine::lang("For details, click").' <a href="'.$_SERVER["PUBLIC_URL"].'/account/inbox/1" target="_blank">'.engine::lang("here").'</a>.';
        if (engine::send_mail($user["email"], $_SERVER["configs"]["name"]."<no-reply@".$_SERVER["HTTP_HOST"].'>', $caption, email::email_template($body))) {
            $status = 1;
        } else {
            $status = $data["status"] -1;
        }
    } else {
        if (engine::send_mail($user["email"], $_SERVER["configs"]["name"]."<no-reply@".$_SERVER["HTTP_HOST"].'>', $outbox["caption"], email::email_template($outbox["text"]))) {
            $status = 1;
        } else {
            $status = $data["status"] -1;
        }
    }
    $query = 'UPDATE `nodes_user_outbox` SET `status` = "'.$status.'", `date` = "'.date("U").'" WHERE `id` = "'.$data["id"].'"';
    engine::mysql($query);
    $_SESSION["Lang"] = $language;
}

/**
* Sends a message with daily report to admin.
*/
static function daily_report() {
    engine::log('email::daily_report()');
    $file = engine::curl_get_query($_SERVER["PUBLIC_URL"].'/perfomance.php?interval=day&date='.date("Y-m-d"));
    $perfomance_image = base64_encode($file);
    $file = engine::curl_get_query($_SERVER["PUBLIC_URL"].'/attendance.php?interval=day&date='.date("Y-m-d"));
    $attendance_image = base64_encode($file);
    $caption = $_SERVER["HTTP_HOST"].' '.date("d/m/Y").' '.engine::lang('daily report');
    $body = '<h3>'.engine::lang("Attendance").'</h3>
        <center>
        <a href="'.$_SERVER["PUBLIC_URL"].'/admin?mode=attendance" target="_blank">
            <img src="data:image/png;base64,'.$attendance_image.'">
        </a>
        </center>
        <h3>'.engine::lang("Average response time").'</h3>
        <center>
        <a href="'.$_SERVER["PUBLIC_URL"].'/admin?mode=perfomance" target="_blank">
            <img src="data:image/png;base64,'.$perfomance_image.'">
        </a>
        </center>
        <br/>';
    engine::send_mail(
        $_SERVER["configs"]["email"],
        $_SERVER["configs"]["name"]."<no-reply@".$_SERVER["HTTP_HOST"].'>',
        $caption,
        email::email_template($body)
    );
}

/**
* Sends a message after registration.
*
* @param string $email User email.
* @param string $name User name.
*/
static function registration($email, $name) {
    engine::log('email::registration('.$email.', '.$name.')');
    $caption = engine::lang('Registration at').' '.$_SERVER["HTTP_HOST"];
    $body = engine::lang('Dear').' '.$name.'!<br/><br/>'
        .engine::lang('We are glad to confirm successful registration at').' '
        . '<a href="'.$_SERVER["PUBLIC_URL"].'/">'.$_SERVER["HTTP_HOST"].'</a>';
    engine::send_mail($email, $_SERVER["configs"]["name"]."<no-reply@".$_SERVER["HTTP_HOST"].'>', $caption, email::email_template($body));
}

/**
* Sends a message with confirmation code.
*
* @param string $email User email.
* @param string $name User name.
* @param string $code Confirmation code
*/
static function confirmation($email, $name, $code) {
    engine::log('email::confirmation('.$email.', '.$name.')');
    $caption = engine::lang('Registration at').' '.$_SERVER["HTTP_HOST"];
    $body = engine::lang('Dear').' '.$name.',<br/><br/>'
        .engine::lang('We are glad to confirm successful registration at').' '
        .'<a href="'.$_SERVER["PUBLIC_URL"].'/">'.$_SERVER["HTTP_HOST"].'</a>'
        .engine::lang("To confirm your email, please enter or click on the following code").':<br/>
        <a href="'.$_SERVER["PUBLIC_URL"].'/account/'.$code.'" target="_blank" style="font-size: 21px;"><b>'.$code.'</b></a><br/>';
    engine::send_mail($email, $_SERVER["configs"]["name"]."<no-reply".$_SERVER["HTTP_HOST"].'>', $caption, email::email_template($body));
}

/**
* Sends a message after request to restore password.
*
* @param string $email User email.
* @param string $new_pass New password.
* @param string $code Confirmation code.
*/
static function restore_password($email, $new_pass, $code) {
    engine::log('email::restore_password('.$email.')');
    $query = 'SELECT * FROM `nodes_user` WHERE `email` = "'.$email.'"';
    $res = engine::mysql($query);
    $user = mysqli_fetch_array($res);
    $body = engine::lang("Dear").' '.$user["name"].'!<br/><br/>'.
        engine::lang("New password is")." <b>".$new_pass.'</b><br/>'
        . '<br/>'.engine::lang("To confirm this password, use").
        ' <a href="'.$_SERVER["PUBLIC_URL"].'/account.php?mode=remember&email='.$email.'&code='.$code.'">'.engine::lang("this link").'</a>';
    $caption = engine::lang("New password for")." ".$_SERVER["HTTP_HOST"];
    engine::send_mail($user["email"], $_SERVER["configs"]["name"]."<no-reply@".$_SERVER["HTTP_HOST"].'>', $caption, email::email_template($body));
}

/**
* Sends a message to admin when new comment is submited.
*
* @param int $user_id @mysql[nodes_user]->id.
* @param string $url Page URL.
*/
static function new_comment($user_id, $url) {
    engine::log('email::new_comment('.$user_id.', '.$url.')');
    $query = 'SELECT * FROM `nodes_user` WHERE `id` = "'.$user_id.'"';
    $res = engine::mysql($query);
    $user = mysqli_fetch_array($res);
    $caption = engine::lang("New comment at")." ".$_SERVER["HTTP_HOST"];
    $message = engine::lang("User").' '.$_SESSION["user"]["name"].' '.engine::lang("add new comment").'!<br/>'.
        engine::lang("For details, click").' <a href="'.$_SERVER["PUBLIC_URL"].$url.'" target="_blank">'.engine::lang("here").'</a>';
    engine::send_mail($_SERVER["configs"]["email"], $_SERVER["configs"]["name"]."<no-reply@".$_SERVER["HTTP_HOST"].'>', $caption, email::email_template($message));
}

/**
* Sends a message to user when account balance updated.
*
* @param int $user_id @mysql[nodes_user]->id.
* @param double $amount Transaction sum.
*/
static function new_transaction($user_id, $amount) {
    engine::log('email::new_transaction('.$user_id.', '.$amount.')');
    $query = 'SELECT * FROM `nodes_user` WHERE `id` = "'.$user_id.'"';
    $res = engine::mysql($query);
    $user = mysqli_fetch_array($res);
    $caption = engine::lang("The funds have been added to your account balance").' '.$_SERVER["HTTP_HOST"];
    $body = engine::lang('Dear').' '.$user["name"].'!<br/><br/>
        '.engine::lang('The funds').' ( $'.$amount.' ) '.engine::lang("has beed added to your account balance").'!<br/>
        '.engine::lang("For details, click").' <a href="'.$_SERVER["PUBLIC_URL"].'/account/finance" target="_blank">'.engine::lang("here").'</a>.';
    engine::send_mail($user["email"], $_SERVER["configs"]["name"]."<no-reply@".$_SERVER["HTTP_HOST"].'>', $caption, email::email_template($body));
}

/**
* Sends a message to user when new message in chat.
*
* @param int $user_id To user ID @mysql[nodes_user]->id.
* @param int $sender_id From user ID @mysql[nodes_user]->id.
*/
static function new_message($user_id, $sender_id) {
    engine::log('email::new_message('.$user_id.', '.$sender_id.')');
    $query = 'SELECT * FROM `nodes_user` WHERE `id` = "'.$user_id.'"';
    $res = engine::mysql($query);
    $user = mysqli_fetch_array($res);
    $query = 'SELECT * FROM `nodes_user` WHERE `id` = "'.$sender_id.'"';
    $res = engine::mysql($query);
    $sender = mysqli_fetch_array($res);
    $caption = engine::lang("New message at").' '.$_SERVER["HTTP_HOST"];
    $body = engine::lang('Dear').' '.$user["name"].'!<br/><br/>
        '.engine::lang("User").' '.$sender["name"].' '.engine::lang("sent a message for you").'!<br/>
        '.engine::lang("For details, click").' <a href="'.$_SERVER["PUBLIC_URL"].'/account/inbox/'.$sender["id"].'" target="_blank">'.engine::lang("here").'</a>.';
    engine::send_mail($user["email"], $_SERVER["configs"]["name"]."<no-reply@".$_SERVER["HTTP_HOST"].'>', $caption, email::email_template($body));
}

/**
* Sends a message to user and admin when new withdrawal request is created.
*
* @param int $user_id @mysql[nodes_user]->id.
* @param double $amount Widthdrawal sum.
* @param string $paypal Receiver PayPal ID.
*/
static function new_withdrawal($user_id, $amount, $wallet, $id) {
    engine::log('email::new_withdrawal('.$user_id.', '.$amount.', '.$wallet.', '.$id.')');
    $query = 'SELECT * FROM `nodes_user` WHERE `id` = "'.$user_id.'"';
    $res = engine::mysql($query);
    $user = mysqli_fetch_array($res);
    $caption = engine::lang("Withdrawal request at")." ".$_SERVER["HTTP_HOST"];
    if ($wallet == "PayPal") {
        $wallet_string = engine::lang("on your PayPal account");
    } else if ($wallet == "Yandex") {
        $wallet_string = engine::lang("on your Yandex Money account");
    }
    $body = engine::lang('Dear').' '.$user["name"].'!<br/><br/>'
        . engine::lang("You withdrawal request is pending now").'.<br/>'
        . engine::lang("After some time you will receive").' $'.$amount.' '.$wallet_string.' <b>'.$id.'</b>.';
    engine::send_mail($user["email"], $_SERVER["configs"]["name"]."<no-reply@".$_SERVER["HTTP_HOST"].'>', $caption, email::email_template($body));
    $body = engine::lang("Dear").' Admin!<br/><br/>'
        . engine::lang("There in new withdrawal request at").' '.$_SERVER["HTTP_HOST"].'.<br/>'
        . engine::lang("Need to pay").' $'.$amount.' '.$wallet_string.' <b>'.$id.'</b> '.engine::lang("and confirm request").'.<br/>'
        . engine::lang("Details").' <a target="_blank" href="'.$_SERVER["PUBLIC_URL"].'/admin/?mode=finance">'.engine::lang("here").'</a>.';
    engine::send_mail($_SERVER["configs"]["email"], $_SERVER["configs"]["name"]."<no-reply@".$_SERVER["HTTP_HOST"].'>', $caption, email::email_template($body));
}

/**
* Sends a message to user when withdrawal is comlplete.
*
* @param int $user_id User ID @mysql[nodes_user]->id.
*/
static function finish_withdrawal($user_id) {
    engine::log('email::finish_withdrawal('.$user_id.')');
    $query = 'SELECT * FROM `nodes_user` WHERE `id` = "'.$user_id.'"';
    $res = engine::mysql($query);
    $user = mysqli_fetch_array($res);
    $caption = engine::lang("Withdrawal is complete at")." ".$_SERVER["HTTP_HOST"];
    $body = engine::lang("Dear").' '.$user["name"].'!<br/><br/>
        '.engine::lang("You withdrawal is complete").'!<br/>
        '.engine::lang("Thanks for using our service and have a nice day").'.';
    engine::send_mail($user["email"], $_SERVER["configs"]["name"]."<no-reply@".$_SERVER["HTTP_HOST"].'>', $caption, email::email_template($body));
}

/**
* Sends a message to user and admin when new order is created.
*
* @param int $id Order ID @mysql[nodes_order]->id.
*/
static function new_purchase($id) {
    engine::log('email::new_purchase('.$id.')');
    $query = 'SELECT * FROM `nodes_order` WHERE `id` = "'.$id.'"';
    $res = engine::mysql($query);
    $order = mysqli_fetch_array($res);
    $query = 'SELECT * FROM `nodes_user` WHERE `id` = "'.$order["user_id"].'"';
    $res = engine::mysql($query);
    $user = mysqli_fetch_array($res);
    $caption = engine::lang("New purchase at").' '.$_SERVER["HTTP_HOST"];
    $body = engine::lang("Dear").' '.$user["name"].'!<br/><br/>
        '.engine::lang("Congratulations on your purchase at").' '.$_SERVER["HTTP_HOST"].'.<br/>
        '.engine::lang("You can see details of your purchases").' <a target="_blank" href="'.$_SERVER["PUBLIC_URL"].'/account/purchases">'.engine::lang("here").'</a>.';
    engine::send_mail($user["email"], $_SERVER["configs"]["name"]."<no-reply@".$_SERVER["HTTP_HOST"].'>', $caption, email::email_template($body));
    $query = 'SELECT * FROM `nodes_transaction` WHERE `order_id` = "'.$order["id"].'"';
    $res = engine::mysql($query);
    $transaction = mysqli_fetch_array($res);
    $caption = engine::lang("New purchase at").' '.$_SERVER["HTTP_HOST"];
    $body = engine::lang("Dear").' Admin!<br/><br/>'
        . engine::lang("There in new purchase at").' '.$_SERVER["HTTP_HOST"].'. '
        . engine::lang("Details").' <a target="_blank" href="'.$_SERVER["PUBLIC_URL"].'/admin/?mode=orders">'.engine::lang("here").'</a>.';
    if ($transaction["txt_id"] != "test_transaction") {
        $body .= '<br/>'.$user["name"].'</a> '.engine::lang("make a payment").' $'.$transaction["amount"].' '.engine::lang("to your PayPal account").'.';
    }
    engine::send_mail($_SERVER["configs"]["email"], $_SERVER["configs"]["name"]."<no-reply@".$_SERVER["HTTP_HOST"].'>', $caption, email::email_template($body));
    $query = 'INSERT INTO `nodes_inbox`(`from`, `to`, `text`, `date`, `system`) '
            . 'VALUES("'.$user["id"].'", "1", "The user makes a purchase", "'.date("U").'", "1")';
    engine::mysql($query);
}

/**
* Sends a message to user when order is shipped.
*
* @param int $id Order ID @mysql[nodes_order]->id.
*/
static function shipping_confirmation($id) {
    engine::log('email::shipping_confirmation('.$id.')');
    $query = 'SELECT * FROM `nodes_product_order` WHERE `id` = "'.intval($id).'"';
    $res = engine::mysql($query);
    $product_order = mysqli_fetch_array($res);
    $query = 'SELECT * FROM `nodes_order` WHERE `id` = "'.$product_order["order_id"].'"';
    $res = engine::mysql($query);
    $order = mysqli_fetch_array($res);
    $query = 'SELECT * FROM `nodes_product` WHERE `id` = "'.$product_order["product_id"].'"';
    $res = engine::mysql($query);
    $product = mysqli_fetch_array($res);
    $query = 'SELECT * FROM `nodes_user` WHERE `id` = "'.$order["user_id"].'"';
    $res = engine::mysql($query);
    $user = mysqli_fetch_array($res);
    $caption = engine::lang("Your order has been shipped at").' '.$_SERVER["HTTP_HOST"];
    $body = engine::lang("Dear").' '.$user["name"].'!<br/><br/>
        '.engine::lang("Your order").' "'.$product["title"].'" '.engine::lang("has been shipped").'.<br/>
        '.engine::lang("After receiving, please update purchase status").' <a target="_blank" href="'.$_SERVER["PUBLIC_URL"].'/account/purchases">'.engine::lang("here").'</a>.';
    engine::send_mail($user["email"], $_SERVER["configs"]["name"]."<no-reply@".$_SERVER["HTTP_HOST"].'>', $caption, email::email_template($body));
    $query = 'INSERT INTO `nodes_inbox`(`from`, `to`, `text`, `date`, `system`) '
    . 'VALUES("'.$_SESSION["user"]["id"].'", "'.$user["id"].'", "Order has been shipped", "'.date("U").'", "1")';
    engine::mysql($query);
}

/**
* Sends a message to user and admin when order delivery is done.
*
* @param int $id Order ID @mysql[nodes_order]->id.
*/
static function delivery_confirmation($id) {
    engine::log('email::delivery_confirmation('.$id.')');
    $query = 'SELECT * FROM `nodes_product_order` WHERE `id` = "'.intval($id).'"';
    $res = engine::mysql($query);
    $product = mysqli_fetch_array($res);
    $query = 'SELECT * FROM `nodes_order` WHERE `id` = "'.$product["order_id"].'"';
    $res = engine::mysql($query);
    $order = mysqli_fetch_array($res);
    $query = 'SELECT * FROM `nodes_product` WHERE `id` = "'.$product["product_id"].'"';
    $res = engine::mysql($query);
    $data = mysqli_fetch_array($res);
    $query = 'SELECT * FROM `nodes_user` WHERE `id` = "'.$data["user_id"].'"';
    $res = engine::mysql($query);
    $user = mysqli_fetch_array($res);
    $caption = engine::lang("Your order has been completed at").' '.$_SERVER["HTTP_HOST"];
    $body = engine::lang("Dear").' '.$user["name"].'!<br/><br/>
        '.engine::lang("Your order has been completed").'! ';
    if ($user["id"] != "1") {
        $body .= '<br/>'.engine::lang("Funds added to your account and available for withdrawal").' '
            . '<a target="_blank" href="'.$_SERVER["PUBLIC_URL"].'/account/finances">'.engine::lang("here").'</a>.';
    }
    engine::send_mail($user["email"], $_SERVER["configs"]["name"]."<no-reply@".$_SERVER["HTTP_HOST"].'>', $caption, email::email_template($body));
    $query = 'INSERT INTO `nodes_inbox`(`from`, `to`, `text`, `date`, `system`) '
        . 'VALUES("'.$_SESSION["user"]["id"].'", "'.$user["id"].'", "The user confirmed reception", "'.date("U").'", "1")';
    engine::mysql($query);
}
}
