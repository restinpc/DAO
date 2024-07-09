<?php
/**
* Prints VR panorama navigation hyperlink.
* @path /engine/core/pano/pano_print_link.php
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
*
* @param object $site Site class object.
* @param string $object Object data.
* @param bool $new Flag to add object as new.
* @return string Returns content of block.
* @usage <code> engine::pano_print_link($site, $object, $new=0); </code>
*/

function pano_print_link($site, $object, $new=0) {
    $site->content .= '<a-image
        transparent="true"
        look-at="#camera" 
        action=\' 
            setTimeout((id) => {
                if ($id("scene_editor") && $id("scene_editor").style.display == "block") {
                    if (!document.panorama.objectId) {
                        jQuery(".vr_object_window").css("display", "none");
                        $id("url_'.$object["id"].'_window").style.display = "block";
                        document.panorama.objectId = "'.$object["id"].'";
                    }
                } else {
                    window.location = "'.$object["url"].'";
                }
            }, 500, "'.$object["id"].'");
        \'
        id="url_'.$object["id"].'"
        position="'.$object["position"].'"
        scale="'.$object["scale"].'"
        rotation="0 0 0"
        class="custom_object"
        opacity="0"
        width="1"
        height="1"
        src="#google"
    ></a-image>';
    if ($_SESSION["user"]["id"] == "1") {
        $fout .= '<div id="url_'.$object["id"].'_window" class="vr_object_window">
            <div style="padding-top:10px; padding-bottom:10px; text-align:center; font-weight:bold;">'.engine::lang("Link properties").'</div><br/>
            <form method="POST" id="url_'.$object["id"].'_form">
                <input id="action_'.$object["id"].'" type="hidden" name="action" value="'.($new ? 'new_url' : 'edit_url').'" />
                <input type="hidden" name="id" value="'.$object["id"].'" />
                '.engine::lang("Position").':<br/>
                <input required id="url_'.$object["id"].'_position" name="position" type="text" class="input w100p" value="'.$object["position"].'" /><br/>
                <br/>
                '.engine::lang("Scale").':<br/>
                <input required id="url_'.$object["id"].'_scale" name="scale" type="text" class="input w100p" value="'.$object["scale"].'" /><br/>
                <br/>
                URL:<br/>
                <input required id="url_'.$object["id"].'_url" name="url" type="text" class="input w100p" value="'.$object["url"].'" /><br/>
                <br/> 
                <br/>
                <br/>
                <input type="button" class="btn w100p" value="'.engine::lang("Apply changes").'" onClick=\'document.panorama.applyChangesURL("'.$object["id"].'");\' />';
        if (!$new) {
            $fout .= '<input type="button" class="btn w100p" value="'.engine::lang("Delete Link").'" onClick=\'document.panorama.deleteURL("'.$object["id"].'")\' />';
        }
        $fout .= '<input type="submit" class="btn w100p" value="'.engine::lang("Submit").'" /><br/><br/>
            </form>
        </div>';
        return $fout;
    }
}