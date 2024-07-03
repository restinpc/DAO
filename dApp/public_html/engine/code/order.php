<?php
/**
* Product purchase processor.
* @path /engine/code/order.php
*
* @name    DAO Mansion    @version 1.0.3
* @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*/

require_once("engine/nodes/headers.php");
require_once("engine/nodes/session.php");

echo '<!DOCTYPE html>
<html>
<head>
    <link href="'.$_SERVER["DIR"].'/template/nodes.css" rel="stylesheet" type="text/css" />
    <link href="'.$_SERVER["DIR"].'/template/'.$_SESSION["template"].'/template.css" rel="stylesheet" type="text/css" />
    <script rel="preload" src="'.$_SERVER["DIR"].'/script/jquery.js" type="text/javascript" as="script" crossorigin="anonymous"></script>
    <script rel="preload" src="'.$_SERVER["DIR"].'/script/script.js" type="text/javascript" as="script" crossorigin="anonymous"></script>
    <script rel="preload" src="'.$_SERVER["DIR"].'/template/'.$_SESSION["template"].'/template.js" type="text/javascript" as="script" crossorigin="anonymous"></script>
    <script>
        document.framework.loadEvents = false;
        document.framework.loadSite = () => {};
        document.framework.rootDir = "'.$_SERVER["DIR"].'";
    </script>
</head>
<body class="nodes">';
if (empty($_SESSION["user"]["id"])) {
    $_SESSION["redirect"] = $_SERVER["DIR"]."/order.php";
    require_once("engine/nodes/site.php");
    echo '<div class="fs21 tal"><b>'.engine::lang("Step").' 1 \ 5</b></div><br/>';
    $_GET[0] = "register";
    $_POST["jQuery"] = 1;
    $site = new site(1);
} else if (!empty($_POST["order_confirm"]) && !empty($_SESSION["user"]["id"])) {
    $query = 'INSERT INTO `nodes_order`(user_id, date, status) '
        . 'VALUES("'.$_SESSION["user"]["id"].'", "'.date("U").'", "0")';
    engine::mysql($query);
    $query = 'SELECT * FROM `nodes_order` WHERE `user_id` = "'.$_SESSION["user"]["id"].'" ORDER BY `id` DESC LIMIT 0, 1';
    $res = engine::mysql($query);
    $data = mysqli_fetch_array($res);
    foreach ($_SESSION["products"] as $key => $value) {
        if ($value > 0) {
            $query = 'SELECT * FROM `nodes_product` WHERE `id` = "'.$key.'"';
            $r = engine::mysql($query);
            $d = mysqli_fetch_array($r);
            $query = 'INSERT INTO `nodes_product_order`(product_id, order_id, price, count, status, date) '
                . 'VALUES("'.$key.'", "'.$data["id"].'", "'.$d["price"].'", "'.$value.'", "0", "'.date("U").'")';
            engine::mysql($query);
        }
    }
    $_SESSION["order_confirm"] = $data["id"];
} else if (!empty($_POST["shipping_confirm"]) && !empty($_SESSION["user"]["id"])) {
    $fname = htmlspecialchars($_POST["fname"]);
    $lname = htmlspecialchars($_POST["lname"]);
    $country = htmlspecialchars($_POST["country"]);
    $state = htmlspecialchars($_POST["state"]);
    $city = htmlspecialchars($_POST["city"]);
    $zip = htmlspecialchars($_POST["zip"]);
    $street1 = htmlspecialchars($_POST["street1"]);
    $street2 = htmlspecialchars($_POST["street2"]);
    $phone = htmlspecialchars($_POST["phone"]);
    $query = 'SELECT * FROM `nodes_shipping` WHERE'
        . ' `user_id` = "'.$_SESSION["user"]["id"].'" AND'
        . ' `fname` = "'.$fname.'" AND'
        . ' `lname` = "'.$lname.'" AND'
        . ' `country` = "'.$country.'" AND'
        . ' `state` = "'.$state.'" AND'
        . ' `city` = "'.$city.'" AND'
        . ' `zip` = "'.$zip.'" AND'
        . ' `street1` = "'.$street1.'" AND'
        . ' `street2` = "'.$street2.'" AND'
        . ' `phone` = "'.$phone.'"';
    $res = engine::mysql($query);
    $data = mysqli_fetch_array($res);
    if (!empty($data)) {
        $shipment = intval($data["id"]);
    } else {
        $query = 'INSERT INTO `nodes_shipping`(user_id, fname, lname, country, state, city, zip, street1, street2, phone) '
            . 'VALUES("'.$_SESSION["user"]["id"].'", "'.$fname.'", "'.$lname.'", "'.$country.'", "'.$state.'", "'.$city.'", "'.$zip.'", "'.$street1.'", "'.$street2.'", "'.$phone.'")';
        engine::mysql($query);
        $query = 'SELECT * FROM `nodes_shipping` WHERE `user_id` = "'.$_SESSION["user"]["id"].'" ORDER BY `id` DESC LIMIT 0, 1';
        $res = engine::mysql($query);
        $data = mysqli_fetch_array($res);
        $shipment = $data["id"];
    }
    $query = 'UPDATE `nodes_order` SET `shipping` = "'.$shipment.'" WHERE `id` = "'.$_SESSION["order_confirm"].'"';
    engine::mysql($query);
    $_SESSION["shipping_confirm"] = $data["id"];
} else if (!empty($_SESSION["order_confirm"]) && !empty($_SESSION["user"]["id"])) {
    $query = 'SELECT * FROM `nodes_order` WHERE `id` = "'.intval($_SESSION["order_confirm"]).'"';
    $res = engine::mysql($query);
    $data = mysqli_fetch_array($res);
    if ($data["status"]) {
        unset($_SESSION["order_confirm"]);
        unset($_SESSION["shipping_confirm"]);
        unset($_SESSION["products"]);
    }
}
if (empty($_SESSION["order_confirm"]) && !empty($_SESSION["user"]["id"])) {
    echo '<div class="fs21 tal"><b>'.engine::lang("Step").' 2 \ 5</b></div><br/>';
    $fout .= '<h1>'.engine::lang("Confirmation").'</h1><br/><br/>
        <div class="document">
        <form method="POST">
            <input type="hidden" name="order_confirm" value="1" />';
    $price = 0;
    foreach ($_SESSION["products"] as $key => $value) {
        if ($value > 0) {
            $query = 'SELECT * FROM `nodes_product` WHERE `id` = "'.$key.'"';
            $res = engine::mysql($query);
            $product = mysqli_fetch_array($res);
            $price += $product["price"];
            $query = 'SELECT * FROM `nodes_shipping` WHERE `id` = "'.$product["shipping"].'"';
            $res = engine::mysql($query);
            $shipping = mysqli_fetch_array($res);
            $images = explode(";", $product["img"]);
            $addr = $shipping["country"].', '.$shipping["state"].', '.$shipping["city"].', '.$shipping["street1"].', '.$shipping["street2"].'");\' title="'.$shipping["country"].', '.$shipping["state"].', '.$shipping["city"].', '.$shipping["street1"].', '.$shipping["street2"];
            $fout .= '<div class="order_detail">
                    <div class="order_detail_image" style="background-image: url('.$_SERVER["DIR"].'/img/data/thumb/'.$images[0].');">&nbsp;</div>
                        <b class="fs18">'.$product["title"].'</b><br/><br/>
                        <font class="fs18">$ '.$product["price"].'</font><br/><br/>
                        '.engine::lang("Shipping from").': <a id="link-shipping" onClick=\'alert("'.$addr.'">'.$shipping["country"].'</a><br/>
                        <div class="order_detail_button">
                            <input id="remove-product-'.$key.'" type="button" class="btn small w150" name="remove" value="'.engine::lang("Remove product").'" onClick=\'if (confirm("'.engine::lang("Are you sure?").'")) { document.framework.removeFromCart("'.$key.'"); }\' />
                        </div>
                    <div class="clear"></div>
                </div>';
        }
    }
    if (!$price) {
        $fout .= '<br/>'.engine::lang("Your cart is empty").'<br/><br/><br/>';
    } else {
        $fout .= '<br/>'
            . '<div class="tar"><b class="fs21">'.engine::lang("Total price").': $'.$price.'</b></div>'
            . '<br/><br/>'
            . '<input id="button-next" type="submit" class="btn w280" value="'.engine::lang("Next").'" />';
    }
    $fout .= '
        </form>
        </div>
        <br/><br/>';
} else if (empty($_SESSION["shipping_confirm"]) && !empty($_SESSION["user"]["id"])) {
    echo '<div class="fs21 tal"><b>'.engine::lang("Step").' 3 \ 5</b></div><br/>';
    $query = 'SELECT * FROM `nodes_shipping` WHERE `user_id` = "'.$_SESSION["user"]["id"].'" ORDER BY `id` DESC LIMIT 0, 1';
    $res = engine::mysql($query);
    $data = mysqli_fetch_array($res);
    $fout .= '<h1>'.engine::lang("Shipping").'</h1><br/><br/>
        <style>
        .country-select{
            width: 280px !important;
        }
        </style>
        <form method="POST">
            <input type="hidden" name="shipping_confirm" value="1" />
            <input id="input-fname" type="text" class="input w280" placeHolder="'.engine::lang("First name").'" name="fname" required value="'.$data["fname"].'" /><br/><br/>
            <input id="input-lname" type="text" class="input w280" placeHolder="'.engine::lang("Last name").'" name="lname" required value="'.$data["lname"].'" /><br/><br/>
            <input id="input-country" type="text" placeHolder="'.engine::lang("Country").'" id="country_selector" name="country" required value="'.$data["country"].'" class="input w280" /><br/><br/>
            <input id="input-state" type="text" class="input w280" placeHolder="'.engine::lang("State").'" name="state" value="'.$data["state"].'" required /><br/><br/>
            <input id="input-city" type="text" class="input w280" placeHolder="'.engine::lang("City").'" name="city" required value="'.$data["city"].'" /><br/><br/>
            <input id="input-zip" type="text" class="input w280" placeHolder="'.engine::lang("Zip code").'" name="zip" required value="'.$data["zip"].'" /><br/><br/>
            <input id="input-s1" type="text" class="input w280" placeHolder="'.engine::lang("Street").' 1" name="street1" required value="'.$data["street1"].'" /><br/><br/>
            <input id="input-s2" type="text" class="input w280" placeHolder="'.engine::lang("Street").' 2" name="street2" value="'.$data["street2"].'" /><br/><br/>
            <input id="input-phone" type="text" class="input w280" placeHolder="'.engine::lang("Phone number").'" name="phone" required value="'.$data["phone"].'" /><br/><br/>
            <input id="input-next" type="submit" class="btn w280" value="'.engine::lang("Next").'" />
        </form><br/><br/>';
} else if (!empty($_SESSION["user"]["id"])) {
    if (!empty($_POST["checkout"])) {
        unset($_SESSION["products"]);
        $query = 'INSERT INTO `nodes_invoice`(`user_id`, `order_id`, `amount`, `date`) '
                . 'VALUES("'.$_SESSION["user"]["id"].'", "'.$_SESSION["order_confirm"].'", "'.floatval($_POST["checkout"]).'", "'.date("Y-m-d H:i:s").'")';
        engine::mysql($query);
        die('<script>window.location = "'.$_SERVER["DIR"].'/invoice.php?id='. mysqli_insert_id($_SERVER["sql_connection"]).'";</script>');
    }
    echo '<div class="fs21 tal"><b>'.engine::lang("Step").' 4 \ 5</b></div><br/>';
    $fout .= '<div class="document">
        <h1>'.engine::lang("Checkout").'</h1><br/>';
    $query = 'SELECT * FROM `nodes_product_order` WHERE `order_id` = "'.$_SESSION["order_confirm"].'"';
    $res = engine::mysql($query);
    $price = 0;
    $products = '<div class="order_detail_left">
        <b>'.engine::lang("Order").'</b><br/><br/>';
    while ($data = mysqli_fetch_array($res)) {
        if ($data["count"] > 0) {
            $query = 'SELECT * FROM `nodes_product` WHERE `id` = "'.$data["product_id"].'"';
            $r = engine::mysql($query);
            $product = mysqli_fetch_array($r);
            $query = 'SELECT * FROM `nodes_shipping` WHERE `id` = "'.$product["shipping"].'"';
            $r = engine::mysql($query);
            $shipping = mysqli_fetch_array($r);
            $images = explode(";", $product["img"]);
            $products .= '<div class="order_detail">
                <div class="order_detail_preview" style="background-image: url('.$_SERVER["DIR"].'/img/data/thumb/'.$images[0].');">&nbsp;</div>
                    <b class="fs18">'.$product["title"].'</b><br/><br/>
                    <font class="fs18">$ '.$product["price"].'</font><br/>
                <div class="clear"></div>
                </div>';
            $price += $data["price"];
        }
    }
    $products .= '</div>';
    $query = 'SELECT * FROM `nodes_shipping` WHERE `user_id` = "'.$_SESSION["user"]["id"].'" ORDER BY `id` DESC LIMIT 0, 1';
    $res = engine::mysql($query);
    $data = mysqli_fetch_array($res);
    $shipping = '<div class="order_detail_shipping">
        <b>'.engine::lang("Shipping").'</b><br/><br/>
        '.engine::lang("First name").': '.$data["fname"].'<br/><br/>
        '.engine::lang("Last name").': '.$data["lname"].'<br/><br/>
        '.engine::lang("Country").': '.$data["country"].'<br/><br/>
        '.engine::lang("State").': '.$data["state"].'<br/><br/>
        '.engine::lang("City").': '.$data["city"].'<br/><br/>
        '.engine::lang("Zip code").': '.$data["zip"].'<br/><br/>
        '.engine::lang("Street").': '.$data["street1"].'<br/>'
        .$data["street2"].'<br/><br/>
        </div>';
    $fout .= $shipping.$products;
    $fout .= '<div class="clear"><br/></div>
        <h6>'.engine::lang("Total price").': $'.$price.'</h6><br/><br/>
        <form method="POST">
            <input type="hidden" name="checkout" value="'.$price.'" />
            <input id="input-checkout" type="submit" class="btn w280" value="'.engine::lang("Checkout").'" />
        </form>';
    $fout .= '</div>';
}
$fout .= '<script>jQuery("#country_selector").countrySelect({ defaultCountry: "ru" })</script>
</body>
<script>document.body.style.opacity = "1";</script>
</html>';
echo $fout;
