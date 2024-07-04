<?php
/**
* Prints image uploader form.
* @path /engine/core/function/print_uploder.php
*
* @name    DAO Mansion    @version 1.0.3
* @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*
* @return string Returns content of form
* @usage <code> engine::print_uploader(); </code>
*/

require_once ("engine/nodes/session.php");

function print_uploader() {
    $fout = '<div id="new_img1" class="uploader">
        <input type="hidden" id="result_file1" name="file1" value="" />
        <div id="result1" style="overflow:hidden; overflow-x:auto;">
            <iframe id="f11" frameborder=0 src="'.$_SERVER["DIR"].'/uploader.php?id=1" class="uploader_frame" scrolling="no"></iframe>
        </div>
    </div>
    <div class="clear"></div>
    <input id="input-upload-new" type="button" class="btn w280" id="uploading_button1" value="'.engine::lang("Upload new image").'" onClick=\' 
        try{
            parent.document.getElementById("uploading_button1").style.display = "none"; 
            parent.document.getElementById("new_img1").style.display = "block"; 
        } catch(e) { }
    \'/>';
    return $fout;
}

