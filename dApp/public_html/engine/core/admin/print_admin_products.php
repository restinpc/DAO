<?php
/**
* Print admin products page.
* @path /engine/core/admin/print_admin_products.php
* 
* @name    Nodes Studio    @version 1.0.3
* @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*
* @var $cms->site - Site object.
* @var $cms->title - Page title.
* @var $cms->content - Page HTML data.
* @var $cms->menu - Page HTML navigaton menu.
* @var $cms->onload - Page executable JavaScript code.
* @var $cms->statistic - Array with statistics.
* 
* @param object $cms Admin class object.
* @return string Returns content of page on success, or die with error.
* @usage <code> engine::print_admin_products($cms); </code>
*/

function print_admin_products($cms) {
    $query = 'SELECT `access`.`access` FROM `nodes_access` AS `access` '
            . 'LEFT JOIN `nodes_admin` AS `admin` ON `admin`.`url` = "products" '
            . 'WHERE `access`.`user_id` = "'.$_SESSION["user"]["id"].'" '
            . 'AND `access`.`admin_id` = `admin`.`id`';
    $admin_res = engine::mysql($query);
    $admin_data = mysqli_fetch_array($admin_res);
    $admin_access = intval($admin_data["access"]);
    if (!$admin_access) {
        engine::error(401);
        return;
    }
    $cms->onload .= '; document.framework.tinymce_init(); ';
    if ($_GET["action"] == "add") {
        if ($admin_access != 2) {
            engine::error(401);
            return;
        }
        if (!empty($_POST["file1"]) && !empty($_SESSION["user"]["id"])) {
            $_SESSION["photos"] = '';
            foreach ($_POST as $key => $file) {
                if (!empty($file) && strpos(" ".$key, "file")) {
                    $_SESSION["photos"] .= trim($file).';';
                }
            }
        }
        if (!empty($_POST["product"]) && !empty($_SESSION["user"]["id"])) {
            $title = trim(htmlspecialchars($_POST["title"]));
            $text = trim(htmlspecialchars($_POST["text"]));
            $price = trim($_POST["price"]);
            $description = trim(engine::escape_string($_POST["description"]));
            $date = date("U");
            $query = 'INSERT INTO `nodes_product`(`user_id`, `title`, `text`, `description`, `img`, `price`, `date`, `status`, `views`) '
                . 'VALUES("'.$_SESSION["user"]["id"].'", "'.$title.'", "'.$text.'", "'.$description.'", "'.$_SESSION["photos"].'", "'.$price.'", "'.$date.'", "1", "0")';
            engine::mysql($query);
            $query = 'SELECT * FROM `nodes_product` WHERE `user_id` = "'.$_SESSION["user"]["id"].'" AND `date` = "'.date("U").'"';
            $res = engine::mysql($query);
            $data = mysqli_fetch_array($res);
            $_SESSION["product"] = $data["id"];
            foreach ($_POST as $key => $value) {
                if (strpos($key, 'property_') != "false") {
                    $key = str_replace('property_', '', $key);
                }
                if (intval($key) > 0) {
                    $value = intval($_POST["property_".$key]);
                    if ($value ==-1) {
                        $new_value = trim(engine::escape_string($_POST["new_value_".$key]));
                        $query = 'SELECT * FROM `nodes_product_data` WHERE `cat_id` = "'.$key.'" AND `value` = "'.$new_value.'"';
                        $res = engine::mysql($query);
                        $data = mysqli_fetch_array($res);
                        if (!empty($data)) {
                           $value = $data["id"]; 
                        } else {
                            $query = 'INSERT INTO `nodes_product_data`(cat_id, value) VALUES("'.$key.'", "'.$new_value.'")';
                            engine::mysql($query);
                            $value = mysqli_insert_id($_SERVER["sql_connection"]);
                        }
                    }
                    $query = 'SELECT * FROM `nodes_property_data` WHERE `product_id` = "'.$_SESSION["product"].'" AND `property_id` = "'.$key.'" AND `data_id` = "'.$value.'"';
                    $res = engine::mysql($query);
                    $data = mysqli_fetch_array($res);
                    if (empty($data)) {
                        $query = 'INSERT INTO `nodes_property_data`(product_id, property_id, data_id) '
                            . 'VALUES("'.$_SESSION["product"].'", "'.$key.'", "'.$value.'")';
                        engine::mysql($query);
                    }
                }
            }
            if (!empty($_POST["new_property"]) && !empty($_POST["new_value"])) {
                $value = trim(engine::escape_string($_POST["new_value"]));
                $property = trim(engine::escape_string($_POST["new_property"]));
                $query = 'INSERT INTO `nodes_product_property`(cat_id, value) VALUES(0, "'.$property.'")';
                engine::mysql($query);
                $id = mysqli_insert_id($_SERVER["sql_connection"]);
                $query = 'INSERT INTO `nodes_product_data`(cat_id, value, url) VALUES('.$id.', "'.$value.'", "")';
                engine::mysql($query);
                $data_id = mysqli_insert_id($_SERVER["sql_connection"]);
                $query = 'INSERT INTO `nodes_property_data`(product_id, property_id, data_id) '
                    . 'VALUES("'.$_SESSION["product"].'", "'.$id.'", "'.$data_id.'")';
                engine::mysql($query);
            }
        }
        if (!empty($_POST["shipping"]) && !empty($_SESSION["user"]["id"])) {
            $country = htmlspecialchars($_POST["country"]);
            $state = htmlspecialchars($_POST["state"]);
            $city = htmlspecialchars($_POST["city"]);
            $zip = htmlspecialchars($_POST["zip"]);
            $street1 = htmlspecialchars($_POST["street1"]);
            $street2 = htmlspecialchars($_POST["street2"]);
            $phone = htmlspecialchars($_POST["phone"]);
            $query = 'SELECT * FROM `nodes_shipping` WHERE '
                    . '`user_id` = "'.$_SESSION["user"]["id"].'" AND '
                    . '`country` = "'.$country.'" AND '
                    . '`state` = "'.$state.'" AND '
                    . '`city` = "'.$city.'" AND '
                    . '`zip` = "'.$zip.'" AND '
                    . '`street1` = "'.$street1.'" AND '
                    . '`street2` = "'.$street2.'" AND '
                    . '`phone` = "'.$phone.'" '
                    . 'ORDER BY `id` DESC LIMIT 0, 1';
            $res = engine::mysql($query);
            $data = mysqli_fetch_array($res);
            if (empty($data)) {
                $query = 'INSERT INTO `nodes_shipping`(user_id, country, state, city, zip, street1, street2, phone)'
                    . 'VALUES("'.$_SESSION["user"]["id"].'", "'.$country.'", "'.$state.'", "'.$city.'", "'.$zip.'", "'.$street1.'", "'.$street2.'", "'.$phone.'")';
                engine::mysql($query);
                $query = 'SELECT * FROM `nodes_shipping` WHERE `user_id` = "'.$_SESSION["user"]["id"].'" ORDER BY `id` DESC LIMIT 0, 1';
                $res = engine::mysql($query);
                $data = mysqli_fetch_array($res);
            }
            $query = 'UPDATE `nodes_product` SET `status` = "1", `shipping` = "'.$data["id"].'" WHERE `id` = "'.$_SESSION["product"].'"';
            engine::mysql($query);
            $id = $_SESSION["product"];
            unset($_SESSION["product"]);
            unset($_SESSION["photos"]);
            $fout = '<script type="text/javascript">window.location = "'.$_SERVER["DIR"].'/admin/?mode=products";</script>';
            return $fout;
        }
        if (empty($_SESSION["photos"])) {
            $fout = '<div class="add_product">
                <form method="POST">';
            for ($i = 1; $i <5; $i++) {
                $fout .= '<div class="new_photo" id="new_photo_'.$i.'" title="none">
                <input type="hidden" name="file'.$i.'" id="file'.$i.'" value="" />
                </div>';
            }
            $fout .= '<div class="clear"><br/></div>
                <input type="button" id="upload_btn" value="'.engine::lang("Upload new image").'" class="btn w280" onClick=\'document.framework.showPhotoEditor(0, 0);\' /><br/><br/><br/>
                <input type="hidden" name="product" value="1" />
                <div class="add_product_left">
                    '.engine::lang("Please, describe this item").'<br/><br/>
                    <input id="product-title" type="text" placeHolder="'.engine::lang("Title").'" class="input w280" name="title" required /><br/><br/>
                    <textarea id="textarea-description" class="input w280 h100" name="text" placeHolder="'.engine::lang("Description (e.g. Blue Nike Vapor Cleats Size 10. Very comfortable and strong ankle support.)").'" required></textarea><br/><br/>
                    <input id="product-price" type="text" class="input w280" name="price" placeHolder="$ 0.00" required /><br/><br/>';
            $query = 'SELECT * FROM `nodes_product_property` ORDER BY `id` ASC';
            $res = engine::mysql($query);
            while ($data = mysqli_fetch_array($res)) {
                $flag = 0;
                $select = '<select id="select-product-data-'.$data["id"].'" class="input w280" style="margin-bottom: 15px;" name="property_'.$data["id"].'" onChange=\'if (this.value == "-1") {$id("new_value_'.$data["id"].'").style.display="block"; jQuery("#new_value_'.$data["id"].'").removeClass("hidden"); this.style.display="none";}\'>'
                . '<option id="option-product-data-'.$data["id"].'-0" disabled selected>'.$data["value"].'</option>';
                $query = 'SELECT * FROM `nodes_product_data` WHERE `cat_id` = "'.$data["id"].'"';
                $r = engine::mysql($query);
                while ($d = mysqli_fetch_array($r)) {
                    $flag = 1;
                    $select .= '<option id="option-product-data-'.$data["id"].'-'.$d["id"].'" value="'.$d["id"].'">'.$d["value"].'</option>';
                }
                $select .= '
                    <option id="option-product-data-'.$data["id"].'-1" value="-1">'.engine::lang("New value").'</option>
                    </select><input id="product-value-'.$data["id"].'-'.$d["id"].'" type="text" class="input w280" style="display:none; margin: 0px auto;" name="new_value_'.$data["id"].'" id="new_value_'.$data["id"].'" placeHolder="'.$data["value"].'" />
                    <br/>';
                if ($flag) {
                    $fout .= $select;
                }
            }
            $fout .= '
                <div id="nodes_new_properties">
                    <input id="product-new-property" type="text" name="new_property" class="input w280" placeHolder="'.engine::lang("Property").'" /><br/><br/>
                    <input id="product-new-value" type="text" name="new_value" class="input w280" placeHolder="'.engine::lang("Value").'" /><br/>
                </div>
                <input id="product-add-property" type="button" value="'.engine::lang("Add new property").'" class="btn small w280" 
                    onClick=\'$id("nodes_new_properties").style.display="block";
                    jQuery("#nodes_new_properties").removeClass("hidden");
                    this.style.display="none";\' 
                /><br/><br/>';
            $query = 'SELECT * FROM `nodes_shipping` WHERE `user_id` = "'.$_SESSION["user"]["id"].'" ORDER BY `id` DESC LIMIT 0, 1';
            $res = engine::mysql($query);
            $data = mysqli_fetch_array($res);
            $fout .= '
                </div>
                <div class="add_product_right">
                    '.engine::lang("Please, confirm item shipping address").'<br/><br/>
                    <input type="hidden" name="shipping" value="1" />
                    <input id="product-shipping-country" type="text" class="input w280" placeHolder="'.engine::lang("Country").'" id="country_selector" name="country" required value="'.$data["country"].'" /><br/><br/>
                    <input id="product-shipping-state" type="text" class="input w280" placeHolder="'.engine::lang("State").'" name="state" required value="'.$data["state"].'" /><br/><br/>
                    <input id="product-shipping-city" type="text" class="input w280" placeHolder="'.engine::lang("City").'" name="city" required value="'.$data["city"].'" /><br/><br/>
                    <input id="product-shipping-zip" type="text" class="input w280" placeHolder="'.engine::lang("Zip code").'" name="zip" required value="'.$data["zip"].'" /><br/><br/>
                    <input id="product-shipping-street1" type="text" class="input w280" placeHolder="'.engine::lang("Street").' 1" name="street1" required value="'.$data["street1"].'" /><br/><br/>
                    <input id="product-shipping-street2" type="text" class="input w280" placeHolder="'.engine::lang("Street").' 2" name="street2" value="'.$data["street2"].'" /><br/><br/>
                    <input id="product-shipping-phone" type="text" class="input w280" placeHolder="'.engine::lang("Phone number").'" name="phone" required value="'.$data["phone"].'" /><br/><br/>
                    <br/>
                </div>
                <div class="clear"><br/></div>
                <div class="w600 m0a">
                    <textarea id="editable" name="description" placeHolder="'.engine::lang("Complete item description").'"></textarea>
                    <br/><br/>
                </div>
                <input id="product-shipping-submit" type="submit" class="btn w280" value="'.engine::lang("Submit").'" /><br/>
            </form>
            </div>
            <style>.country-select{ width: 280px; }</style>';
            $cms->onload .= '; jQuery("#country_selector").countrySelect({ defaultCountry: "us" }); ';
        }
    } else if ($_GET["action"] == "edit") {
        if ($admin_access != 2) {
            engine::error(401);
            return;
        }
        if (!empty($_GET["id"])) {
            if (!empty($_POST["title"])) {
                $query = 'DELETE FROM `nodes_property_data` WHERE `product_id` = "'.$_GET["id"].'"';
                engine::mysql($query);
                foreach ($_POST as $key => $value) {
                    if (strpos(' '.$key, 'property_')) {
                        $key = str_replace('property_', '', $key);
                    }if (intval($key) > 0) {
                        $value = intval($_POST["property_".$key]);
                        $new_value = trim(engine::escape_string($_POST["new_value_".$key]));
                        if (!empty($new_value) && $value == "-1") {
                            $query = 'SELECT * FROM `nodes_product_data` WHERE `value` = "'.$new_value.'"';
                            $r = engine::mysql($query);
                            $d = mysqli_fetch_array($r);
                            if (!empty($d)) {
                                $query = 'INSERT INTO `nodes_property_data`(product_id, property_id, data_id) '
                                    . 'VALUES("'.$_GET["id"].'", "'.$key.'", "'.$d["id"].'")';
                                engine::mysql($query);
                            } else {
                                $query = 'INSERT INTO `nodes_product_data`(cat_id, value) VALUES("'.$key.'", "'.$new_value.'")';
                                $rr = engine::mysql($query);
                                $dd = mysqli_fetch_array($rr);
                                $id = mysqli_insert_id($_SERVER["sql_connection"]);
                                $query = 'INSERT INTO `nodes_property_data`(product_id, property_id, data_id) '
                                    . 'VALUES("'.$_GET["id"].'", "'.$key.'", "'.$id.'")';
                                engine::mysql($query);
                            }
                        } else {
                            $query = 'INSERT INTO `nodes_property_data`(product_id, property_id, data_id) '
                                . 'VALUES("'.$_GET["id"].'", "'.$key.'", "'.$value.'")';
                            engine::mysql($query);
                        }
                    }
                }
                if (!empty($_POST["new_property"]) && !empty($_POST["new_value"])) {
                    $value = trim(engine::escape_string($_POST["new_value"]));
                    $property = trim(engine::escape_string($_POST["new_property"]));
                    $query = 'INSERT INTO `nodes_product_property`(cat_id, value) VALUES(0, "'.$property.'")';
                    engine::mysql($query);
                    $id = mysqli_insert_id($_SERVER["sql_connection"]);
                    $query = 'INSERT INTO `nodes_product_data`(cat_id, value, url) VALUES('.$id.', "'.$value.'", "")';
                    engine::mysql($query);
                    $data_id = mysqli_insert_id($_SERVER["sql_connection"]);
                    $query = 'INSERT INTO `nodes_property_data`(product_id, property_id, data_id) '
                        . 'VALUES("'.$_GET["id"].'", "'.$id.'", "'.$data_id.'")';
                    engine::mysql($query);
                }
                $title = trim(htmlspecialchars($_POST["title"]));
                $text = trim(htmlspecialchars($_POST["text"]));
                $price = trim($_POST["price"]);
                $description = engine::escape_string($_POST["description"]);
                $query = 'UPDATE `nodes_product` SET '
                    . '`title` = "'.$title.'", '
                    . '`text` = "'.$text.'", '
                    . '`price` = "'.$price.'", '
                    . '`description` = "'.$description.'" '
                    . 'WHERE `id` = "'.intval($_GET["id"]).'"';
                engine::mysql($query);
                $country = htmlspecialchars($_POST["country"]);
                $state = htmlspecialchars($_POST["state"]);
                $city = htmlspecialchars($_POST["city"]);
                $zip = htmlspecialchars($_POST["zip"]);
                $street1 = htmlspecialchars($_POST["street1"]);
                $street2 = htmlspecialchars($_POST["street2"]);
                $phone = htmlspecialchars($_POST["phone"]);
                $query = 'SELECT * FROM `nodes_shipping` WHERE '
                    . '`user_id` = "'.$_SESSION["user"]["id"].'" AND '
                    . '`country` = "'.$country.'" AND '
                    . '`state` = "'.$state.'" AND '
                    . '`city` = "'.$city.'" AND '
                    . '`zip` = "'.$zip.'" AND '
                    . '`street1` = "'.$street1.'" AND '
                    . '`street2` = "'.$street2.'" AND '
                    . '`phone` = "'.$phone.'" '
                    . 'ORDER BY `id` DESC LIMIT 0, 1';
                $res = engine::mysql($query);
                $data = mysqli_fetch_array($res);
                if (empty($data)) {
                    $query = 'INSERT INTO `nodes_shipping`(user_id, country, state, city, zip, street1, street2, phone)'
                        . 'VALUES("'.$_SESSION["user"]["id"].'", "'.$country.'", "'.$state.'", "'.$city.'", "'.$zip.'", "'.$street1.'", "'.$street2.'", "'.$phone.'")';
                    engine::mysql($query);
                    $query = 'SELECT * FROM `nodes_shipping` WHERE `user_id` = "'.$_SESSION["user"]["id"].'" ORDER BY `id` DESC LIMIT 0, 1';
                    $res = engine::mysql($query);
                    $data = mysqli_fetch_array($res);
                }
                $query = 'UPDATE `nodes_product` SET `status` = "1", `shipping` = "'.$data["id"].'" WHERE `id` = "'.intval($_GET["id"]).'"';
                engine::mysql($query);
            }  
            $query = 'SELECT * FROM `nodes_product` WHERE `id` = "'.intval($_GET["id"]).'"';
            $res = engine::mysql($query);
            $product = mysqli_fetch_array($res);
            $fout = '<div class="document edit_product">
                <form method="POST" id="edit_product_form">
                <section class="one_column_block">';
            $images = explode(";", $product["img"]);
            $fout .= '<table align=center><tr>';
            $i = 0;
            foreach ($images as $img) {
                $img = trim($img);
                if (!empty($img)) {
                    $i++;
                    if ($i > 5) {
                        break;
                    }
                    $fout .= '<td id="block_'.$i.'" class="product_preview_image_small">'
                        . '<img id="img-product-'.$i.'" class="img" src="'.$_SERVER["DIR"].'/img/data/thumb/'.$img.'" onClick=\'select_image("'.$i.'", "'.$img.'");\'/><br/>
                        <div id="div-product-'.$i.'" class="new_small_photo" onClick=\'document.framework.showPhotoEditor('.$product["id"].', '.$i.');\' > </div>';
                    if ($i > 1) {
                        $fout .= '<input id="product-delete-'.$product["id"].'" class="btn small del_button" type="button" value="'.engine::lang("Delete").'" onClick=\'document.framework.admin.deleteImage("'.$product["id"].'", "'.$i.'");\' />';
                    }
                    $fout .= '</td>';
                }
            }
            if ($i < 4) {
                $fout .= '<td class="add_td">'
                    . '<div id="div-add-photo-'.$i.'" class="new_add_photo" onClick=\'document.framework.showPhotoEditor('.$product["id"].', '.(++$i).');\' > </div>
                    </td>';
            }
            $fout .= '</tr>
                    </table>
                </section>
                <div class="double_column">
                    <section class="double_column_block">
                        <input type="hidden" name="product" value="1" />
                        '.engine::lang("Please, describe this item").'<br/><br/>
                        <input id="product-edit-title" type="text" placeHolder="'.engine::lang("Title").'" title="'.engine::lang("Title").'"  class="input w280" name="title" required value="'.$product["title"].'" /><br/><br/>
                        <textarea id="textarea-desc" class="input w280 h100" name="text" title="'.engine::lang("Description").'" placeHolder="'.engine::lang("Description (e.g. Blue Nike Vapor Cleats Size 10. Very comfortable and strong ankle support.)").'" required>'.$product["text"].'</textarea><br/><br/>'
                        . '<input id="product-edit-price" type="text" class="input w280" name="price" title="'.engine::lang("Price").'" placeHolder="$ 0.00" required value="'.$product["price"].'" /><br/>
                        <br/>';
            $query = 'SELECT * FROM `nodes_product_property` ORDER BY `id` ASC';
            $res = engine::mysql($query);
            while ($fdata = mysqli_fetch_array($res)) {
                $flag = 0;
                $fout .= '<select id="select-product-data-'.$fdata["id"].'" class="input w280" name="property_'.$fdata["id"].'" title="'.$fdata["value"].'" onChange=\'if (this.value == "-1") {$id("new_value_'.$fdata["id"].'").style.display="block"; jQuery("#new_value_'.$fdata["id"].'").removeClass("hidden"); this.style.display="none";}\' >'
                        . '<option value="0">'.$fdata["value"].'</option>';
                $query = 'SELECT * FROM `nodes_product_data` WHERE `cat_id` = "'.$fdata["id"].'"';
                $r = engine::mysql($query);
                while ($d = mysqli_fetch_array($r)) {
                    $flag = 1;
                    $query = 'SELECT * FROM `nodes_property_data` WHERE `product_id` = "'.$product["id"].'" '
                            . 'AND `property_id` = "'.$fdata["id"].'" and `data_id` = "'.$d["id"].'"';
                    $rr = engine::mysql($query);
                    $dd = mysqli_fetch_array($rr);
                    if (!empty($dd)) {
                        $fout .= '<option id="option-product-data-'.$fdata["id"].'-'.$d["id"].'" selected value="'.$d["id"].'">'.$d["value"].'</option>'; 
                    } else {
                        $fout .= '<option id="option-product-data-'.$fdata["id"].'-'.$d["id"].'" value="'.$d["id"].'">'.$d["value"].'</option>';
                    }
                }
                $fout .= '<option id="option-product-data-'.$fdata["id"].'-0" value="-1">'.engine::lang("New value").'</option>
                    </select><input id="product-edit-'.$fdata["id"].'" type="text" class="input w280" style="display:none; margin: 0px auto;" name="new_value_'.$fdata["id"].'" id="new_value_'.$fdata["id"].'" placeHolder="'.$fdata["value"].'" />'
                    . '<br/><br/>';
            }
            $fout .= '<div id="nodes_new_properties">
                            <input id="product-add-new-property" type="text" name="new_property" class="input w280" placeHolder="'.engine::lang("Property").'" /><br/><br/>
                            <input id="product-add-new-value" type="text" name="new_value" class="input w280" placeHolder="'.engine::lang("Value").'" /><br/>
                        </div>
                        <input id="product-new-property-button" type="button" value="'.engine::lang("Add new property").'" class="btn small w280" 
                            onClick=\'$id("nodes_new_properties").style.display="block";
                            jQuery("#nodes_new_properties").removeClass("hidden");
                            this.style.display="none";\' 
                        /><br/><br/>
                    </section>
                    <section class="double_column_block">';
                        $query = 'SELECT * FROM `nodes_shipping` WHERE `id` = "'.$product["shipping"].'" ORDER BY `id` DESC LIMIT 0, 1';
                        $res = engine::mysql($query);
                        $data = mysqli_fetch_array($res);
                        $fout .= engine::lang("Please, confirm item shipping address").'<br/><br/>
                        <input type="hidden" name="shipping" value="1" />
                        <input id="product-edit-country" type="text" class="input w280" placeHolder="'.engine::lang("Country").'" id="country_selector" name="country" required value="'.$data["country"].'" /><br/><br/>
                        <input id="product-edit-state" type="text" class="input w280" placeHolder="'.engine::lang("State").'" name="state" required value="'.$data["state"].'" /><br/><br/>
                        <input id="product-edit-city" type="text" class="input w280" placeHolder="'.engine::lang("City").'" name="city" required value="'.$data["city"].'" /><br/><br/>
                        <input id="product-edit-zip" type="text" class="input w280" placeHolder="'.engine::lang("Zip code").'" name="zip" required value="'.$data["zip"].'" /><br/><br/>
                        <input id="product-edit-street1" type="text" class="input w280" placeHolder="'.engine::lang("Street").' 1" name="street1" required value="'.$data["street1"].'" /><br/><br/>
                        <input id="product-edit-street2" type="text" class="input w280" placeHolder="'.engine::lang("Street").' 2" name="street2" value="'.$data["street2"].'" /><br/><br/>
                        <input id="product-edit-phone" type="text" class="input w280" placeHolder="'.engine::lang("Phone number").'" name="phone" required value="'.$data["phone"].'" /><br/><br/>
                    </section>
                    <div class="clear"></div>
                    <div class="w600 tal">
                        <textarea class="w100p" id="editable" name="description">'.$product["description"].'</textarea>
                        <br/><br/>
                    </div>
                    <input id="product-edit-submit" type="submit" class="btn w280" value="'.engine::lang("Save changes").'" /><br/><br/>
                    <a id="back-to-products" href="'.$_SERVER["DIR"].'/admin/?mode=products"><input type="button" class="btn w280" value="'.engine::lang("Back to products").'" /></a><br/>
                </div>
                </form>
            </div>
            <style>.country-select{ width: 280px; }</style>';
            $cms->onload .= '; jQuery("#country_selector").countrySelect({ defaultCountry: "us" }); ';
        } else {
            if (!empty($_POST["new_property"])) {
                $prop = trim(engine::escape_string($_POST["new_property"]));
                $query = 'SELECT * FROM `nodes_product_property` WHERE `value` LIKE "'.$_POST["new_property"].'"';
                $res = engine::mysql($query);
                $data = mysqli_fetch_array($res);
                if (empty($data)) {
                    $query = 'INSERT INTO `nodes_product_property`(value) VALUES("'.$prop.'")';
                    engine::mysql($query);
                }
            } else if (!empty($_POST["action"]) && !empty($_POST["id"])) {
                if ($_POST["action"] == "cat_delete") {
                    $id = intval($_POST["id"]);
                    $query = 'DELETE FROM `nodes_product_data WHERE `id` = "'.$id.'"';
                    engine::mysql($query);
                } else if ($_POST["action"] == "add") {
                    $cat_id = intval($_POST["id"]);
                    $value = engine::escape_string($_POST["value"]);
                    if (!empty($_POST["url"])) {
                        $url = engine::url_translit($_POST["url"]);
                    } else {
                        $url = engine::url_translit($value);
                    }
                    $query = 'SELECT COUNT(*) FROM `nodes_product_data` WHERE `cat_id` = "'.$cat_id.'" AND `value` LIKE "'.$value.'"';
                    $res = engine::mysql($query);
                    $data = mysqli_fetch_array($res);
                    if (!$data[0]) {
                        if ($cat_id== "1") {
                            $query = 'INSERT INTO `nodes_product_data`(cat_id, value, url) '
                                . 'VALUES ("'.$cat_id.'", "'.$value.'", "'.$url.'")';
                        } else {
                            $query = 'INSERT INTO `nodes_product_data`(cat_id, value) '
                                . 'VALUES ("'.$cat_id.'", "'.$value.'")';
                        }
                        engine::mysql($query);
                    }
                } else if ($_POST["action"] == "edit_cat") {
                    $id = intval($_POST["id"]);
                    $value = engine::escape_string($_POST["value"]);
                    $url = engine::url_translit($_POST["url"]);
                    $query = 'UPDATE `nodes_product_data` SET `value` = "'.$value.'", `url` = "'.$url.'" WHERE `id` = "'.$id.'"';
                    engine::mysql($query);
                } else if ($_POST["action"] == "delete") {
                    $id = intval($_POST["id"]);
                    $query = 'DELETE FROM `nodes_product_property` WHERE `id` = "'.$id.'"';
                    engine::mysql($query);
                } else if ($_POST["action"] == "save_property") {
                    $id = intval($_POST["id"]);
                    $value = engine::escape_string($_POST["value"]);
                    $query = 'UPDATE `nodes_product_property` SET `value` = "'.$value.'" WHERE `id` = "'.$id.'"';
                    engine::mysql($query);
                }
            }
            $f = 0;
            $fout = '<div class="document">
                <div class="properties">
                ';
            $query = 'SELECT * FROM `nodes_product_property`';
            $res = engine::mysql($query);
            while ($data = mysqli_fetch_array($res)) {
                $f = 1;
                $fout .= '<form id="category_'.$data["id"].'" method="POST">'
                    . '<input type="hidden" id="category_id_'.$data["id"].'" name="id" value="" />'
                    . '<input type="hidden" id="category_action_'.$data["id"].'" name="action" value="" />'
                    . '<input type="hidden" id="category_value_'.$data["id"].'" name="value" value="" />'
                    . '<input type="hidden" id="category_url_'.$data["id"].'" name="url" value="" />'
                    . '</form>'
                    . '<span id="value_'.$data["id"].'">'.$data["value"].'</span> '
                    . '<span id="input_'.$data["id"].'" class="hidden">'
                    . ' <input type="text" class="input" id="save_value_'.$data["id"].'" value="'.$data["value"].'" />
                        <input id="button_save_value_'.$data["id"].'" type="button" class="btn small" value="'.engine::lang("Save").'" onClick=\'
                            $id("category_id_'.$data["id"].'").value = "'.$data["id"].'";
                            $id("category_action_'.$data["id"].'").value = "save_property";
                            $id("category_value_'.$data["id"].'").value = $id("save_value_'.$data["id"].'").value;
                            $id("category_'.$data["id"].'").submit();
                        \' /> 
                        </span>'
                    . '<select id="select_'.$data["id"].'" class="input" name="action" onChange=\'
                        if (this.value == "1") {
                            $id("li_'.$data["id"].'").style.display = "block"; 
                                jQuery("#li_'.$data["id"].'").removeClass("hidden");
                        } else if (this.value == "2") {
                            $id("input_'.$data["id"].'").style.display = "block";
                                jQuery("#input_'.$data["id"].'").removeClass("hidden");
                            $id("value_'.$data["id"].'").style.display = "none";
                            $id("select_'.$data["id"].'").style.display = "none";
                        } else if (this.value == "3") {
                            if (confirm("'.engine::lang("Are you sure?").'")) {
                                $id("category_id_'.$data["id"].'").value = "'.$data["id"].'";
                                $id("category_action_'.$data["id"].'").value = "delete";
                                $id("category_'.$data["id"].'").submit();
                            }
                        }
                        \'>'
                    . '<option id="option-action-'.$data["id"].'-0" selected disabled>'.engine::lang("Select option").'</option>'
                    . '<option id="option-action-'.$data["id"].'-1" value="1">'.engine::lang("Add value").'</option>'
                    . '<option id="option-action-'.$data["id"].'-2" value="2">'.engine::lang("Edit property").'</option>';
                $query = 'SELECT * FROM `nodes_product_data` WHERE `cat_id` = "'.$data["id"].'"';
                $r = engine::mysql($query);
                $flag = 0;
                while ($d = mysqli_fetch_array($r)) {
                    if (!$flag) {
                        $fout .= '</select>
                        <ul class="pl15 lh2">
                        <li class="hidden" id="li_'.$data["id"].'">'
                    . '<input type="text" id="xcv_'.$d["id"].'" name="value" class="input" placeHolder="'.engine::lang("New value").'" />';
                        if ($data["id"] == "1") {
                            $fout .= '<input type="text" id="cat_url_'.$d["id"].'" name="value" class="input" placeHolder="URL" />';
                        }
                        $fout .= '<input id="cat_btn_'.$d["id"].'" type="button" class="btn small" value="'.engine::lang("Add").'" onClick=\'
                        $id("category_id_'.$data["id"].'").value = "'.$data["id"].'";
                        $id("category_action_'.$data["id"].'").value = "add";';
                        if ($data["id"] == "1") {
                            $fout .= 'try {
                                    $id("category_url_'.$data["id"].'").value = $id("cat_url_'.$d["id"].'").value;
                                } catch(err) {};';
                        }
                        $fout .= '$id("category_value_'.$data["id"].'").value = $id("xcv_'.$d["id"].'").value;
                            $id("category_'.$data["id"].'").submit();
                            \' /></li>';
                    }
                    $flag = 1;
                    $fout .= '<li>
                            <span id="category_public_'.$d["id"].'">'.$d["value"].' '.
                            '<input id="cat_btn_edit_'.$d["id"].'" type="button" class="btn small" value="'.engine::lang("Edit").'" onClick=\'
                                $id("category_edit_'.$d["id"].'").style.display = "block";
                                jQuery("#category_edit_'.$d["id"].'").removeClass("hidden");
                                $id("category_public_'.$d["id"].'").style.display = "none";
                                \' 
                            /> 
                            <input id="cat_btn_delete_'.$d["id"].'" type="button" class="btn small" value="'.engine::lang("Delete").'" onClick=\''
                                . 'if (confirm("'.engine::lang("Are you sure?").'")) {
                                    $id("category_id_'.$data["id"].'").value = "'.$d["id"].'";
                                    $id("category_action_'.$data["id"].'").value = "cat_delete";
                                    $id("category_'.$data["id"].'").submit();
                                }\'
                            />
                            </span>
                            <span id="category_edit_'.$d["id"].'" class="hidden">
                            <input type="text" name="value" id="cat_val_'.$d["id"].'" class="input" value="'.$d["value"].'" />';
                    if ($data["id"] == "1") {
                        $fout .= '<input type="text" id="edit_cat_url_'.$d["id"].'" name="value" value="'.$d["url"].'" class="input" placeHolder="URL" />';
                    }
                    $fout .= '<input id="cat_btn_save_'.$d["id"].'" type="button" class="btn small" value="'.engine::lang("Save").'"  onClick=\'
                        $id("category_id_'.$data["id"].'").value = "'.$d["id"].'";
                        $id("category_action_'.$data["id"].'").value = "edit_cat";
                        $id("category_value_'.$data["id"].'").value = $id("cat_val_'.$d["id"].'").value;';
                    if ($data["id"] == "1") {
                        $fout .= 'try {
                            $id("category_url_'.$data["id"].'").value = $id("edit_cat_url_'.$d["id"].'").value;
                        } catch(err) {}';
                    }
                    $fout .= '$id("category_'.$data["id"].'").submit();
                            \'
                        />
                        </span>
                    </li>';
                }
                if (!$flag) {
                    if ($data["id"] != "1") {
                        $fout .= '<option value="3">'.engine::lang("Delete property").'</option>';
                    }
                    $fout .= '</select><ul class="pl15 lh2">
                        <li class="hidden" id="li_'.$data["id"].'">
                            <input type="text" id="cv_'.$data["id"].'" name="value" class="input" placeHolder="'.engine::lang("New value").'" />';
                        if ($data["id"] == "1") {
                            $fout .= '<input type="text" id="cat_urlx_'.$data["id"].'" name="value" class="input" placeHolder="URL" />';
                        }
                        $fout .= '<input id="cat_add_f_'.$data["id"].'" type="button" class="btn small" value="'.engine::lang("Add").'" onClick=\'
                                $id("category_id_'.$data["id"].'").value = "'.$data["id"].'";
                                $id("category_action_'.$data["id"].'").value = "add";
                                $id("category_value_'.$data["id"].'").value = $id("cv_'.$data["id"].'").value;
                                $id("category_'.$data["id"].'").submit();\'
                            />
                        </li>
                    </ul>';
                } else {
                    $fout .= '</ul>';
                }
            }
            $fout .= '<br/></div>
                <input  id="cat_add_new_prop" type="button" class="btn w280 mb10" value="'.engine::lang("Add new property").'" 
                    onClick=\'$id("new_prop").style.display = "block"; jQuery("#new_prop").removeClass("hidden"); this.style.display = "none";\' 
                />';
            $fout .= '
                <form method="POST" class="hidden" id="new_prop">
                    <strong>'.engine::lang("Add new property").'</strong><br/><br/>
                    <input id="input-new_property" type="text" name="new_property" placeHolder="'.engine::lang("Value").'" class="input w280" /><br/><br/>
                    <input id="input-new_value" type="submit" class="btn w280" value="'.engine::lang("Submit").'" /><br/><br/>
                </form>
            </div>
            <a id="back-to-products" href="'.$_SERVER["DIR"].'/admin/?mode=products"><input type="button" class="btn w280" value="'.engine::lang("Back to products").'" /></a><br/>';
        }
    } else {
        if ($_SESSION["order"] == "id") {
            $_SESSION["order"] = "date";
        }
        $arr_count = 0;
        $from = ($_SESSION["page"] - 1) * $_SESSION["count"] + 1;
        $to = ($_SESSION["page"] - 1) * $_SESSION["count"] + $_SESSION["count"];
        $query = 'SELECT * FROM `nodes_product` ORDER BY `'.$_SESSION["order"].'` '.$_SESSION["method"].' LIMIT '.($from-1).', '.$_SESSION["count"];
        $requery = 'SELECT COUNT(*) FROM `nodes_product`';
        $fout = '<div class="document980">';
        $table = '
            <div class="table">
            <table width=100% id="table">
            <thead>
            <tr>';
        $array = array(
            "title" => "Title",
            "price" => "Price",
            "date" => "Date",
            "status" => "Status"
        );
        foreach ($array as $order => $value) {
            $table .= '<th>';
            if ($_SESSION["order"] == $order) {
                if ($_SESSION["method"] == "ASC") {
                    $table .= '<a id="table-'.$order.'" class="link" href="#" onClick=\'$id("order").value = "'.$order.'"; $id("method").value = "DESC"; document.framework.submit_search_form();\'>'.engine::lang($value).'&nbsp;&uarr;</a>';
                } else { 
                    $table .= '<a id="table-'.$order.'" class="link" href="#" onClick=\'$id("order").value = "'.$order.'"; $id("method").value = "ASC"; document.framework.submit_search_form();\'>'.engine::lang($value).'&nbsp;&darr;</a>';
                }
            } else $table .= '<a id="table-'.$order.'" class="link" href="#" onClick=\'$id("order").value = "'.$order.'"; $id("method").value = "ASC"; document.framework.submit_search_form();\'>'.engine::lang($value).'</a>';
            $table .= '</th>';
        }
        $table .= '
            <th></th>
            </tr>
            </thead>';
        $res = engine::mysql($query);
        while ($data = mysqli_fetch_array($res)) {
            $arr_count++;
            if ($data["status"]) {
                $status = engine::lang("Enabled");
            } else { 
                $status = engine::lang("Disabled");
            }
            $imgs = explode(';', $data["img"]);
            if (empty($imgs)) {
                $imgs = array($data["imgs"]);
            }
            $table .= '<tr>
                <td align=left valign=middle class="min-w150"><a id="product-'.$data.'" href="'.$_SERVER["DIR"].'/product/'.$data["id"].'" target="_blank">'.$data["title"].'</a></td>
                <td align=left valign=middle>$'.$data["price"].'</td>
                <td align=left valign=middle>'.date("d/m/Y H:i", $data["date"]).'</td>
                <td align=left valign=middle>'.$status.'</td>
                <td width=60 align=left valign=middle>';
            if ($admin_access == 2) {
                $table .= '<form method="POST" id="edit_product_form_'.$data["id"].'" action="'.$_SERVER["DIR"].'/admin/?mode=products&action=edit&id='.$data["id"].'" >
                    <input type="hidden" name="edit" value="1" />
                    <select id="select-act-'.$id.'" name="act" class="input" onChange=\'$id("edit_product_form_'.$data["id"].'").submit();\'>
                        <option id="option-act-'.$id.'-0">'.engine::lang("Choose action").'</option>
                        <option id="option-act-'.$id.'-1" value="1">'.engine::lang("Edit item").'</option>';

                if ($data["status"]) {
                    $table .= '<option id="option-act-'.$id.'-2" value="2">'.engine::lang("Deactivate item").'</option>';
                } else {
                    $table .= '<option id="option-act-'.$id.'-3" value="3">'.engine::lang("Activate item").'</option>';
                }
                $table .= '</select>
                    </form>';
            }
            $table .= '
                </td>
            </tr>';
        }
        $table .= '</table>
            </div>
            <br/>';
        if ($arr_count) {
            $fout .= $table.'
        <form method="POST" id="query_form" onSubmit="document.framework.submit_search_form();">
        <input type="hidden" name="page" id="page_field" value="'.$_SESSION["page"].'" />
        <input type="hidden" name="count" id="count_field" value="'.$_SESSION["count"].'" />
        <input type="hidden" name="order" id="order" value="'.$_SESSION["order"].'" />
        <input type="hidden" name="method" id="method" value="'.$_SESSION["method"].'" />
        <input type="hidden" name="reset" id="query_reset" value="0" />
        <div class="total-entry">';
        $res = engine::mysql($requery);
        $data = mysqli_fetch_array($res);
        $count = $data[0];
        if ($to > $count) {
            $to = $count;
        }
        if ($data[0] > 0) {
            $fout .= '<p class="p5">'.engine::lang("Showing").' '.$from.' '.engine::lang("to").' '.$to.' '.engine::lang("from").' '.$count.' '.engine::lang("entries").', 
                <nobr><select id="select-pagination" class="input" onChange=\'$id("count_field").value = this.value; document.framework.submit_search_form();\' >
                 <option id="option-pagination-20"'; if ($_SESSION["count"] == "20") { $fout.= ' selected'; } $fout.= '>20</option>
                 <option id="option-pagination-50"'; if ($_SESSION["count"] == "50") { $fout.= ' selected'; } $fout.= '>50</option>
                 <option id="option-pagination-100"'; if ($_SESSION["count"] == "100") { $fout.= ' selected'; } $fout.= '>100</option>
                </select> '.engine::lang("per page").'.</nobr></p>';
        }
        $fout .= '
        </div><div class="cr"></div>';
        if ($count > $_SESSION["count"]) {
            $fout .= '<div class="pagination" >';
                $pages = ceil($count / $_SESSION["count"]);
                if ($_SESSION["page"] > 1) {
                    $fout .= '<span id="page-prev" onClick=\'document.framework.goto_page('.($_SESSION["page"] - 1).');\'><a hreflang="'.$_SESSION["Lang"].'" href="#">'.engine::lang("Previous").'</a></span>';
                }
                $fout .= '<ul>';
                $a = $b = $c = $d = $e = $f = 0;
                for ($i = 1; $i <= $pages; $i++) {
                    if (($a < 2 && !$b && $e < 2)
                        || ($i >= ($_SESSION["page"] - 2) && $i <= ($_SESSION["page"] + 2) && $e < 5)
                        || ($i > $pages - 2 && $e < 2)
                    ) {
                        if ($a < 2) {
                            $a++;
                        }
                        $e++;
                        $f = 0;
                        if ($i == $_SESSION["page"]) {
                            $b = 1;
                            $e = 0;
                            $fout .= '<li class="active-page">'.$i.'</li>';
                        } else {
                            $fout .= '<li id="page-'.$i.'" onClick=\'document.framework.goto_page('.($i).');\'><a hreflang="'.$_SESSION["Lang"].'" href="#">'.$i.'</a></li>';
                        }
                    } else if ((!$c || !$b) && !$f && $i < $pages) {
                        $f = 1;
                        $e = 0;
                        if (!$b) {
                            $b = 1;
                        } else if (!$c) {
                            $c = 1;
                        }
                        $fout .= '<li class="dots">. . .</li>';
                    }
                }
                if ($_SESSION["page"] < $pages) {
                    $fout .= '<li id="page-next" class="next" onClick=\'document.framework.goto_page('.($_SESSION["page"] + 1).');\'><a hreflang="'.$_SESSION["Lang"].'" href="#">'.engine::lang("Next").'</a></li>';
                }
                $fout .= '</ul>
                </div>';
            }
            $fout .= '<div class="clear"></div>
                    </form>
                </div>';
        } else {
            $fout = '<div class="clear_block">'.engine::lang("Products not found").'</div>';
        }
        if ($admin_access == 2) {
            $fout .= '<br/>
            <a id="list-new-item" href="'.$_SERVER["DIR"].'/admin/?mode=products&action=add"><input type="button" class="btn w280" value="'.engine::lang("List new Item").'" ></a><br/><br/>'
            . '<a id="edit-properties" href="'.$_SERVER["DIR"].'/admin/?mode=products&action=edit"><input type="button" class="btn w280" value="'.engine::lang("Edit Properties").'" ></a><br/>';
        }
    }
    return $fout;
}   