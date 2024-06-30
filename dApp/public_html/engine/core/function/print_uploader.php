<?php
/**
* Prints image uploader form.
* @path /engine/core/function/print_uploder.php
*
* @name    DAO Mansion    @version 1.0.3
* @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*
* @param int $count Images count.
* @return string Returns content of form on success, or die with error.
* @usage <code> engine::print_uploader(1); </code>
*/

require_once ("engine/nodes/session.php");

function print_uploader($count = 1) {
    $fout = '';
    for ($i = 1; $i <= $count; $i++) {
        $fout .= '<div id="new_img'.$i.'" class="uploader">
            <input type="hidden" id="result_file'.$i.'" name="file'.$i.'" value="" />
            <div id="result'.$i.'" style="overflow:hidden; overflow-x:auto;">
                <iframe id="f1'.$i.'" frameborder=0 src="'.$_SERVER["DIR"].'/uploader.php?id='.$i.'" class="uploader_frame" scrolling="no"></iframe>
            </div>
        </div>
        <script>
            document.getElementById("f1'.$i.'").style.height = (window.innerHeight - 25) + "px";
            document.getElementById("f1'.$i.'").style.width = (window.innerWidth - 25) + "px";
        </script>';
    }
    $fout .= ' <div class="clear"></div>
    <input id="input-upload-new" type="button" class="btn w280" id="uploading_button1" value="'.engine::lang("Upload new image").'" onClick=\' 
        try{  
            parent.$id("uploading_button1").style.display="none"; 
            parent.$id("new_img1").style.display="block"; 
        }catch(e) { }
    \'/>';
    return $fout;
}

