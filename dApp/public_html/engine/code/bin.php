<?php
/**
* AJAX requsts processor.
* @path /engine/code/bin.php
*
* @name    DAO Mansion    @version 1.0.3
* @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*/

require_once("engine/nodes/session.php");

if (!empty($_POST["id"])) {
    if (!isset($_SESSION["products"])) {
        $_SESSION["products"] = array();
    }
    $_SESSION["products"][$_POST["id"]] = 1;
    $count = 0;
    foreach ($_SESSION["products"] as $key => $value) {
        if ($value > 0) {
            $count++;
        }
    }
    unset($_SESSION["order_confirm"]);
    unset($_SESSION["shipping_confirm"]);
    echo $count;
} else if (!empty($_POST["remove"])) {
    $_SESSION["products"][$_POST["remove"]] = 0;
} else if (!empty($_POST["show_bin"])) {
    $count = 0;
    if (!empty($_SESSION["products"])) {
        foreach ($_SESSION["products"] as $key => $value) {
            if ($value > 0) {
                $count++;
            }
        }
    }
    if ($count) {
        echo engine::print_cart($count);
    }
} else if (intval($_POST["scene"]) > 0) {
    function html_to_obj($html) {
        $dom = new DOMDocument();
        $dom->loadHTML($html);
        return element_to_obj($dom->documentElement);
    }
    function element_to_obj($element) {
        $obj = array( "tag" => $element->tagName );
        foreach ($element->attributes as $attribute) {
            $obj[$attribute->name] = $attribute->value;
        }
        foreach ($element->childNodes as $subElement) {
            if ($subElement->nodeType == XML_TEXT_NODE) {
                $obj["html"] = $subElement->wholeText;
            } else {
                $obj["children"][] = element_to_obj($subElement);
            }
        }
        return $obj;
    }
    $fout = engine::curl_get_query($_SERVER["HTTP_HOST"].'/panorama.php?id='.$_POST["scene"], 1);
    preg_match_all('#(<a-scene.*?>.*</a-scene>)#', $fout, $m);
    if (!empty($m[1][0])) {
        echo json_encode(html_to_obj($m[1][0]));
    }
    die();
} else if (intval($_POST["scene_reset"]) > 0) {
    $id = intval($_POST["scene_reset"]);
    $query = 'DELETE FROM `nodes_vr_object` WHERE `scene_id` = "'.$id.'"';
    engine::mysql($query);
    $query = 'DELETE FROM `nodes_vr_navigation` WHERE `scene_id` = "'.$id.'"';
    engine::mysql($query);
} else if (!empty($_SESSION["user"]["id"])) {
    if (!empty($_REQUEST["check_message"])) {
        $query = 'SELECT * FROM `nodes_user` WHERE `id` = '.intval($_SESSION["user"]["id"]);
        $res = engine::mysql($query);
        $user = mysqli_fetch_array($res);
        if ($user["ban"] == "1") {
            unset($_SESSION["user"]);
            die('<script type="text/javascript">
                window.alert("'.engine::lang("Your account was banned").'");
                parent.window.location = "'.$_SERVER["DIR"].'/";
            </script>');
        } else {
            die(engine::print_new_message());
        }
    } else if (!empty($_GET["message"])) {
        $query = 'SELECT * FROM `nodes_user` WHERE `id` = '.intval($_SESSION["user"]["id"]);
        $res = engine::mysql($query);
        $user = mysqli_fetch_array($res);
        if ($user["ban"] == "1") {
            unset($_SESSION["user"]);
            die('<script type="text/javascript">
                window.alert("'.engine::lang("Your account was banned").'");
                parent.window.location = "'.$_SERVER["DIR"].'/";
            </script>');
        } else {
            if (!empty($_POST["text"])) {
                $text = trim(str_replace('"', "'", htmlspecialchars(strip_tags($_POST["text"]))));
                $text = str_replace("\n", "<br/>", $text);
                $query = 'SELECT * FROM `nodes_inbox` WHERE `from` = "'.intval($_SESSION["user"]["id"]).'" AND `to` = "'.intval($_GET["message"]).'" AND `text` LIKE "'.$text.'" AND `date` > "'.(date("U") - 600).'"';
                $res = engine::mysql($query);
                $message = mysqli_fetch_array($res);
                if (empty($message)) {
                    $query = 'SELECT * FROM `nodes_user` WHERE `id` = "'.intval($_GET["message"]).'"';
                    $res = engine::mysql($query);
                    $target = mysqli_fetch_array($res);
                    $query = 'INSERT INTO `nodes_inbox`(`from`, `to`, `text`, `date`) VALUES("'.intval($_SESSION["user"]["id"]).'", "'.intval($_GET["message"]).'", "'.$text.'", "'.date("U").'")';
                    engine::mysql($query);
                    $query = 'SELECT * FROM `nodes_config` WHERE `name` = "send_message_email"';
                    $r_conf = engine::mysql($query);
                    $d_conf = mysqli_fetch_array($r_conf);
                    $query = 'SELECT * FROM `nodes_config` WHERE `name` = "email_signature"';
                    $r_sign = engine::mysql($query);
                    $d_sign = mysqli_fetch_array($r_sign);
                    if ($d_conf["value"]) {
                        if ($target["online"] < date("U") - 600) {
                            email::new_message($target["id"], $_SESSION["user"]["id"]);
                        }
                    }
                }
            }
            die(engine::print_chat($_GET["message"]));
        }
    } else if (!empty($_POST["paypal"])) {
        $paypal = engine::escape_string($_POST["paypal"]);
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
            . 'VALUES("'.$_SESSION["user"]["id"].'", "0", "'.$user["balance"].'", "1", "'.date("U").'", "'.$paypal.'" )';
        engine::mysql($query);
        email::new_withdrawal($user["id"], $user["balance"], "PayPal", $paypal);
        die(engine::lang("Withdrawal request accepted"));
    } else if (!empty($_POST["transaction"]) && !empty($_POST["user_id"]) && $_SESSION["user"]["admin"] == "1") {
        $query = 'SELECT `access`.`access` FROM `nodes_access` AS `access` '
            . 'LEFT JOIN `nodes_admin` AS `admin` ON `admin`.`url` = "users" '
            . 'WHERE `access`.`user_id` = "'.$_SESSION["user"]["id"].'" '
            . 'AND `access`.`admin_id` = `admin`.`id`';
        $admin_res = engine::mysql($query);
        $admin_data = mysqli_fetch_array($admin_res);
        $admin_access = intval($admin_data["access"]);
        if ($admin_access != 2) {
            die(engine::lang("Error"));
        }
        $query = 'SELECT * FROM `nodes_user` WHERE `id` = "'.intval($_POST["user_id"]).'"';
        $res = engine::mysql($query);
        $user = mysqli_fetch_array($res);
        $balance = $user["balance"] +floatval($_POST["transaction"]);
        $query = 'INSERT INTO `nodes_transaction`(user_id, order_id, amount, `txn_id`, `payment_date`, status, date, comment, ip) '
                . 'VALUES("'.intval($_POST["user_id"]).'", "-2", "'.floatval($_POST["transaction"]).'", "", "", "2", "'.date("U").'", "Transaction from admin", "'.$_SERVER["REMOTE_ADDR"].'")';
        engine::mysql($query);
        $query = 'UPDATE `nodes_user` SET `balance` = "'.$balance.'" WHERE `id` = "'.intval($_POST["user_id"]).'"';
        engine::mysql($query);
        die(engine::lang("Transaction completed"));
    } else if (!empty($_POST["comment_id"]) && $_SESSION["user"]["admin"] == "1") {
        $query = 'DELETE FROM `nodes_comment` WHERE `id` = "'.intval($_POST["comment_id"]).'"';
        engine::mysql($query);
    } else if (!empty($_POST["order_id"]) && isset($_POST["status"]) && $_SESSION["user"]["admin"] == "1") {
        $query = 'SELECT `access`.`access` FROM `nodes_access` AS `access` '
            . 'LEFT JOIN `nodes_admin` AS `admin` ON `admin`.`url` = "orders" '
            . 'WHERE `access`.`user_id` = "'.$_SESSION["user"]["id"].'" '
            . 'AND `access`.`admin_id` = `admin`.`id`';
        $admin_res = engine::mysql($query);
        $admin_data = mysqli_fetch_array($admin_res);
        $admin_access = intval($admin_data["access"]);
        if ($admin_access != 2) {
            die(engine::lang("Error"));
        }
        $query = 'SELECT * FROM `nodes_product_order` WHERE `id` = "'.intval($_POST["order_id"]).'"';
        $res = engine::mysql($query);
        $data = mysqli_fetch_array($res);
        if (!empty($data)) {
            $track = engine::escape_string($_POST["track"]);
            $query = 'UPDATE `nodes_product` SET `status` = "'.$_POST["status"].'" WHERE `id` = "'.$data["product_id"].'"';
            engine::mysql($query);
            $query = 'UPDATE `nodes_product_order` SET `status` = "1", `track` = "'.$track.'" WHERE `id` = "'.$data["id"].'"';
            engine::mysql($query);
            email::shipping_confirmation($data["order_id"]);
        }
    } else if (!empty($_POST["product_id"]) && !empty($_POST["pos"]) && $_SESSION["user"]["admin"] == "1") {
        $query = 'SELECT `access`.`access` FROM `nodes_access` AS `access` '
            . 'LEFT JOIN `nodes_admin` AS `admin` ON `admin`.`url` = "products" '
            . 'WHERE `access`.`user_id` = "'.$_SESSION["user"]["id"].'" '
            . 'AND `access`.`admin_id` = `admin`.`id`';
        $admin_res = engine::mysql($query);
        $admin_data = mysqli_fetch_array($admin_res);
        $admin_access = intval($admin_data["access"]);
        if ($admin_access != 2) {
            die(engine::lang("Error"));
        }
        $query = 'SELECT * FROM `nodes_product` WHERE `id` = "'.intval($_POST["product_id"]).'"';
        $res = engine::mysql($query);
        $data = mysqli_fetch_array($res);
        $images = explode(";", $data["img"]);
        if (empty($images[0])) {
            $images = array($data["img"]);
        }
        $imgs = array();
        foreach ($images as $img) {
            $img = trim($img);
            if (!empty($img)) {
                array_push($imgs, $img);
            }
        }
        $i = 0;
        $files = '';
        foreach ($imgs as $img) {
            $i++;
            if ($_POST["pos"] != $i) {
                $files .= $img.';';
            }
        }
        $query = 'UPDATE `nodes_product` SET `img` = "'.$files.'" WHERE `id` = "'.intval($_POST["product_id"]).'"';
        engine::mysql($query);
    } else if (!empty($_POST["archive_id"]) && $_SESSION["user"]["admin"] == "1") {
        $query = 'SELECT `access`.`access` FROM `nodes_access` AS `access` '
            . 'LEFT JOIN `nodes_admin` AS `admin` ON `admin`.`url` = "products" '
            . 'WHERE `access`.`user_id` = "'.$_SESSION["user"]["id"].'" '
            . 'AND `access`.`admin_id` = `admin`.`id`';
        $admin_res = engine::mysql($query);
        $admin_data = mysqli_fetch_array($admin_res);
        $admin_access = intval($admin_data["access"]);
        if ($admin_access != 2) {
            die(engine::lang("Error"));
        }
        $query = 'UPDATE `nodes_product` SET `status` = 2 WHERE `id` = "'.intval($_POST["archive_id"]).'" AND `user_id` = "'.$_SESSION["user"]["id"].'"';
        engine::mysql($query);
    } else if (!empty($_POST["seo_id"]) && $_SESSION["user"]["admin"] == "1") {
        $query = 'SELECT `access`.`access` FROM `nodes_access` AS `access` '
            . 'LEFT JOIN `nodes_admin` AS `admin` ON `admin`.`url` = "pages" '
            . 'WHERE `access`.`user_id` = "'.$_SESSION["user"]["id"].'" '
            . 'AND `access`.`admin_id` = `admin`.`id`';
        $admin_res = engine::mysql($query);
        $admin_data = mysqli_fetch_array($admin_res);
        $admin_access = intval($admin_data["access"]);
        if ($admin_access != 2) {
            die(engine::lang("Error"));
        }
        $query = 'SELECT `access`.`access` FROM `nodes_access` AS `access` '
            . 'LEFT JOIN `nodes_admin` AS `admin` ON `admin`.`url` = "Pages" '
            . 'WHERE `access`.`user_id` = "'.$_SESSION["user"]["id"].'" '
            . 'AND `access`.`admin_id` = `admin`.`id`';
        $admin_res = engine::mysql($query);
        $admin_data = mysqli_fetch_array($admin_res);
        $id = intval($_POST["seo_id"]);
        $title = $_POST["title"];
        $description = $_POST["description"];
        $keywords = $_POST["keywords"];
        $mode = $_POST["mode"];
        $query = 'SELECT * FROM `nodes_cache` WHERE `id` = "'.$id.'"';
        $res = engine::mysql($query);
        $d = mysqli_fetch_array($res);
        if (!empty($d)) {
            $query = 'SELECT * FROM `nodes_meta` WHERE `url` = "'.$d["url"].'" AND `lang` = "'.$d["lang"].'"';
            $res = engine::mysql($query);
            $data = mysqli_fetch_array($res);
            if (!empty($data)) {
                $query = 'UPDATE `nodes_meta` SET '
                    . '`title` = "'.$title.'", '
                    . '`description` = "'.$description.'", '
                    . '`keywords` = "'.$keywords.'", '
                    . '`mode` = "'.$mode.'" '
                    . ' WHERE `id` = "'.$data["id"].'"';
            } else {
                $query = 'INSERT INTO `nodes_meta`(url, lang, title, description, keywords, mode) '
                    . 'VALUES("'.$d["url"].'", "'.$d["lang"].'", "'.$title.'", "'.$description.'", "'.$keywords.'", "'.$mode.'")';
            }
            engine::mysql($query);
            $query = 'UPDATE `nodes_cache` SET `title` = "", `description` = "", `keywords` = "", `html` = "", `content` = "", `date` = 0, `time` = 0 '
                . 'WHERE `url` = "'.$d["url"].'" AND `lang` = "'.$d["lang"].'"';
            engine::mysql($query);
        }
    }
}
