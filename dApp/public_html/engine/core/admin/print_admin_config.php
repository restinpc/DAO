<?php
/**
* Print admin config page.
* @path /engine/core/admin/print_admin_config.php
*
* @name    DAO Mansion    @version 1.0.2
* @author  Aleksandr Vorkunov  <developing@nodes-tech.ru>
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
* @usage <code> engine::print_admin_config($cms); </code>
*/
function print_admin_config($cms){
    $query = 'SELECT `access`.`access` FROM `nodes_access` AS `access` '
        . 'LEFT JOIN `nodes_admin` AS `admin` ON `admin`.`url` = "config" '
        . 'WHERE `access`.`user_id` = "'.$_SESSION["user"]["id"].'" '
        . 'AND `access`.`admin_id` = `admin`.`id`';
    $admin_res = engine::mysql($query);
    $admin_data = mysqli_fetch_array($admin_res);
    $admin_access = intval($admin_data["access"]);
    if(!$admin_access){
        engine::error(401);
        return;
    }
    if(!empty($_POST)){
        if($admin_access != 2){
            engine::error(401);
            return;
        }
        foreach($_POST as $arr=>$value){
            $query = 'UPDATE `nodes_config` SET `value` = "'.engine::escape_string($value).'" WHERE `name` = "'.$arr.'"';
            engine::mysql($query);
        }
    }
    $query = 'SELECT * FROM `nodes_config` WHERE `text` <> "System" ORDER BY `id`';
    $res = engine::mysql($query);
    $fout = '<div class="document640">
            <form method="POST"><div class="table">
        <table width=100% id="table">';
    $i = 0;
    while($data = mysqli_fetch_array($res)){
        $i++;
        if($data["type"]=="bool"){
            $fout .= '
                <tr>
                    <td width=100 align=left class="p5">'.$data["text"].'</td>
                    <td class="p5" align=left >
                    <select  id="select-config-'.$i.'" '.($admin_access != 2?'disabled':'').' class="input w100p" name="'.$data["name"].'">';
            if($data["value"]){
                $fout .= '<option id="option-no-'.$i.'" value="0">'.engine::lang("No").'</option>'
                        . '<option id="option-yes-'.$i.'" value="1" selected>'.engine::lang("Yes").'</option>';
            }else{
                $fout .= '<option id="option-no-'.$i.'" value="0" selected>'.engine::lang("No").'</option>'
                        . '<option id="option-yes-'.$i.'" value="1">'.engine::lang("Yes").'</option>';
            }
            $fout .= '        
                    </select>
                    </td>
                </tr>';
        }else{
            $fout .= '
                <tr>
                    <td width=100 align=left class="p5">'.$data["text"].'</td>
                    <td class="p5" align=left >
                    <input id="input-config-'.$i.'" '.($admin_access != 2?'disabled':'').' class="input w100p" type="text" name="'.$data["name"].'" value="'.$data["value"].'" />
                    </td>
                </tr>';
        }
    }
    $fout .= '</table>'
            . '</div>';
    if($admin_access == 2){
        $fout .= '<br/>'
            . '<input id="input-save-settings" type="submit" class="btn w280" value="'.engine::lang("Save settings").'" />';
    }
    $fout .= '</form>'
            . '</div>';
    return $fout;
}
