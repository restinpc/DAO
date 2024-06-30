<?php
/**
* Image croper & uploader.
* @path /engine/code/uploader.php
*
* @name    DAO Mansion    @version 1.0.3
* @author  Alexandr Vorkunov  <devbyzero@yandex.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*/

require_once("engine/nodes/headers.php");
require_once("engine/nodes/session.php");

if (empty($_SESSION["user"]["email"])) {
    die(engine::error(401));
}
define("MAX_IMG_WIDTH", 1000);
define("MAX_IMG_HEIGHT", 1000);
$THUWIDTH = 400;
$THUHEIGHT = 400;
$f1 = "f1";
$result_file = "result_file";
$result_caption = "result_caption";
$new_img = "new_img";
$result = "result";
if (!empty($_GET["width"])) {
    $THUWIDTH = $_GET["width"];
}
if (!empty($_GET["height"])) {
    $THUHEIGHT = $_GET["height"];
}
if (!empty($_GET["id"])) {
    $f1 .= $_GET["id"];
}
if (!empty($_GET["id"])) {
    $result_file .= $_GET["id"];
}
if (!empty($_GET["id"])) {
    $result_caption .= $_GET["id"];
}
if (!empty($_GET["id"])) {
    $new_img .= $_GET["id"];
}
if (!empty($_GET["id"])) {
    $result .= $_GET["id"];
}
if (!empty($_GET["dragndrop"]) || !empty($_FILES)) {
    $fn = (isset($_SERVER['HTTP_X_FILENAME']) ? $_SERVER['HTTP_X_FILENAME'] : false);
    if ($fn) {
        $ext = explode('.', $fn);
        $fn = md5($fn).'.'.$ext[count($ext) - 1];
        if (file_put_contents(
            $_SERVER["DOCUMENT_ROOT"].$_SERVER["DIR"].'/img/data/big/'.$fn,
            file_get_contents('php://input')
        )) {
            die($fn);
        } else {
            die('error');
        }
    } else if (isset($_FILES['fileselect'])) {
        $files = $_FILES['fileselect'];
        $ext = explode('.', $files['name']);
        $fn = md5($files['name']).'.'.$ext[count($ext) - 1];
        if (copy(
            $files['tmp_name'],
            $_SERVER["DOCUMENT_ROOT"].$_SERVER["DIR"].'/img/data/big/' . $fn
        )) {
            die('<form method="POST" id="new_image_form">
                <input type="hidden" name="name" value="'.engine::lang("Uploaded").' '.date("Y-m-d H:i:s").'" />
                <input type="hidden" name="new_image" value="'.$fn.'" id="new_image" />
            </form>
            <script>document.getElementById("new_image_form").submit();</script>');
        } else {
            die('error');
        }
    }
}
$query = 'SELECT * FROM `nodes_config` WHERE `name` = "template"';
$res = engine::mysql($query);
$data = mysqli_fetch_array($res);
$template = $data["value"];
echo '<!DOCTYPE html>
<html style="background-color:#fff;">
<head>
<meta charset="UTF-8" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link href="'.$_SERVER["DIR"].'/template/nodes.css" rel="stylesheet" type="text/css">
<link href="'.$_SERVER["DIR"].'/template/uploader.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
    if (!document.framework) {
        document.framework = {};
    }
    document.framework.root_dir = "'.$_SERVER["DIR"].'";
    document.uploader = {
        width: '.$THUWIDTH.',
        height: '.$THUHEIGHT.',
        thumbWidth: '.$THUWIDTH.',
        thumbHeight: '.$THUHEIGHT.',
        noDragDrop: "'.engine::lang("Error! Drag-n-drop disabled on this server").'",
        uploading: "'.engine::lang("Uploading").'",
        confirmUpload: "'.engine::lang("Upload selection as thumb?").'",
        postNewImage: '.(!empty($_POST["new_image"]) ? '1' : '0').',
        posX: 30,
        posY: 30,
        fx: 0,
        fy: 0,
        dragMode: 0,
        scale: 1
    }
</script>
<script src="'.$_SERVER["DIR"].'/script/uploader.js" type="text/javascript"></script>
</head>';
if (!empty($_POST["name"])) {
    if (!empty($_POST["url"])) {
        $ext = strtolower(array_pop(explode(".", $_POST["url"])));
        $name = md5($_POST["filename"] +date("U"));
        $img = new image($_POST["url"]);
        $img->save($_SERVER["DOCUMENT_ROOT"].$_SERVER["DIR"].'/img/data/big/', $name, $ext, true, 100);
        unlink($_POST["url"]);
        $img->crop(
            intval($_POST["l"] * $_POST["scale"]),
            intval($_POST["t"] * $_POST["scale"]),
            intval($_POST["w"]),
            intval($_POST["h"])
        );
        $img->resize($THUWIDTH, $THUHEIGHT);
        $path = $img->save($_SERVER["DOCUMENT_ROOT"].$_SERVER["DIR"].'/img/data/thumb/', $name, $ext, true, 100);
        $fout .= '<body class="nodes result_body">
            <img src="'.$_SERVER["DIR"].'/img/data/thumb/'. $name.'.'.$ext.'" />
            <script type="text/javascript">
                try {
                    parent.document.getElementById("'.$result_file.'").value="'. $name.'.'.$ext.'";
                    var df_img = document.createElement("img"); 
                    df_img.id = "d_img";
                    df_img.src = "//'.$_SERVER["HTTP_HOST"].$_SERVER["DIR"].'/img/data/thumb/'. $name.'.'.$ext.'";';

        if (!empty($_GET["id"]) && $_GET["id"] <6) {
            $fout .= '
                    var z = parent.document.getElementById("new_img'.(intval($_GET["id"]) + 1).'"); 
                    if (z) z.style.display = "block";
                    parent.document.getElementById("new_img'.(intval($_GET["id"])).'").style.width = "'.$THUWIDTH.'px";';
        }
        $fout .= '
                    parent.document.getElementById("'.$result.'").style.display = "none";
                    parent.document.getElementById("'.$new_img.'").appendChild(df_img);
                    parent.document.getElementById("'.$f1.'").style.width=('.($THUWIDTH+20).'+"px");
                    parent.document.getElementById("'.$f1.'").style.height=('.($THUHEIGHT+20).'+"px");
                } catch(e) { console.log("error 1"); }     
                try {
                    var ii = 0;
                    for (var i = 1; i < 5; i++) {
                        ii = i + 1;
                        try {
                            var el = top.document.getElementById("new_photo_" + i);
                            if (el.title == "none") {
                                el.style.background = "url('.$_SERVER["DIR"].'/img/data/thumb/'. $name.'.'.$ext.') center no-repeat";
                                el.style.backgroundSize = "cover";
                                el.style.display = "block";
                                el.title = "";
                                top.document.getElementById("file"+i).value = "'. $name.'.'.$ext.'";
                                break;
                            }
                        } catch(e) { console.log("error 2"); break; };
                    }
                    if (ii > 0) {
                        var new_photo_el = top.document.getElementById("file"+ii);
                        if (!new_photo_el) {
                            try {
                                top.document.getElementById("upload_btn").style.display = "none";
                            } catch(e) { };
                        }
                    }
                } catch(e) { console.log("error 3");  };
                try {
                    var img = parent.document.getElementById("result_file1");
                    if (img.value != "") {
                        parent.document.getElementById("edit_photos_form").submit();
                    }
                } catch(e) { console.log("error 4"); };
            </script>
        </body>
        </html>';
        die($fout);
    } else if (!empty($_POST["new_image"])) {
        $file = $_SERVER["DOCUMENT_ROOT"].$_SERVER["DIR"].'/img/data/big/'.$_POST["new_image"];
        $size = getimagesize($file);
        if ($size[0] < $THUWIDTH || $size[1] < $THUHEIGHT) {
            die('<script type="text/javascript">alert("'.engine::lang("Image is too small. Minimal size is ".$THUWIDTH.'x'.$THUHEIGHT).'."); window.location="'.$_SERVER["DIR"].'/uploader.php?id='.$_GET["id"].'";</script></html>');
        }
        $f_name = "";
        $a = md5(date('U').$file);
        $ext = strtolower(array_pop(explode(".", $file)));
        if ($ext != "jpeg" && $ext != "jpg" && $ext != "png" && $ext != "gif") {
             die(engine::lang("Error").'<script type="text/javascript">setTimeout(function() {window.location="'.$_SERVER["DIR"].'/uploader.php?id='.$_GET["id"].'";}, 1000);</script>');
        }
        if ($ext == "jpeg") {
            $ext = "jpg";
        }
        $f_name = "img/data/big/".$a.".".$ext;
        $thuname = "img/data/thumb/".$a.".".$ext;
        if (rename($file, $_SERVER["DOCUMENT_ROOT"].$_SERVER["DIR"]."/".$f_name)) {
            $size = getimagesize($_SERVER["DOCUMENT_ROOT"].$_SERVER["DIR"]."/".$f_name);
            if ($size[0] > MAX_IMG_WIDTH || $size[1] > MAX_IMG_HEIGHT) {
                if ($size[0] / MAX_IMG_WIDTH > $size[1] / MAX_IMG_HEIGHT) {
                    $width = MAX_IMG_WIDTH;
                    $height = $size[1] * (MAX_IMG_WIDTH/ $size[0]);
                    image::resize_image($_SERVER["DOCUMENT_ROOT"].$_SERVER["DIR"]."/".$f_name, $_SERVER["DOCUMENT_ROOT"].$_SERVER["DIR"]."/".$f_name, $width, $height);
                } else {
                    $height = MAX_IMG_HEIGHT;
                    $width = $size[0] * (MAX_IMG_HEIGHT/ $size[1]);
                    image::resize_image($_SERVER["DOCUMENT_ROOT"].$_SERVER["DIR"]."/".$f_name, $_SERVER["DOCUMENT_ROOT"].$_SERVER["DIR"]."/".$f_name, $width, $height);
                }
            }
            $size = getimagesize($_SERVER["DOCUMENT_ROOT"].$_SERVER["DIR"]."/".$f_name);
            $width = intval($size[0]);
            $height = intval($size[1]);
            $scale = 1;
            $fout = '<body class="nodes uploader_body" draggable="false" title="'.engine::lang("For uploading selected area use double click").'">
                <div id="image" draggable="false" onDragStart="return false;" style="background: url('.$_SERVER["DIR"].'/'.$f_name.') top left no-repeat; width: '.($width / $scale).'px; height: '.($height / $scale).'px; background-size: cover;" >
                    <img id="img" draggable="false" onDragStart="return false;" src="'.$_SERVER["DIR"].'/'.$f_name.'" style="width: '.($width / $scale).'px; height: '.($height / $scale).'px;" />
                </div>
                <div id="frame" draggable="false" onDragStart="return false;" style="width:'.($THUWIDTH / $scale).'px; height:'.($THUHEIGHT / $scale).'px;position: absolute;top: 28px;left: 28px;display:block;">
                    <table draggable="false" cellpadding=0 cellspacing=0 onDragStart="return false;" onMouseDown=\'if (document.uploader.dragMode != 3) { document.uploader.dragMode = 1; }\'>
                    <tr><td align=left valign=top></td></tr></table>
                    <div id="bottom_dot" onMouseDown=\'document.uploader.dragMode = 2;\' draggable="false" onDragStart="return false;">
                        <div class="dot" draggable="false"> </div>
                    </div>
                </div><br/>
                <form method="POST" id="form">
                    <input type="hidden" name="name" value="'.$_POST["name"].'"/>
                    <input type="hidden" name="url" value="'.$_SERVER["DOCUMENT_ROOT"].$_SERVER["DIR"].'/'.($f_name).'"/>
                    <input type="hidden" name="thumb" value="1"/>
                    <input type="hidden" name="filename" value="'.$a.'"/>
                    <input type="hidden" id="t" name="t" value="0"/>
                    <input type="hidden" id="l" name="l" value="0"/>
                    <input type="hidden" id="w" name="w" value="'.$THUWIDTH.'"/>
                    <input type="hidden" id="h" name="h" value="'.$THUHEIGHT.'"/>
                    <input type="hidden" id="scale" name="scale" value="'.$scale.'"/>
                    <input type="submit" class="btn w280" value="'.engine::lang("Crop image").'" />
                </form>
                <script type="text/javascript">
                    var s1 = '.$height.' / (parent.parent.document.getElementById("img_editor").offsetHeight - 120);
                    var s2 = '.$width.' / (parent.parent.document.getElementById("img_editor").offsetWidth - 100);
                    if (s1 > s2) {
                        if (s1 > 1) {
                            document.uploader.scale = s1;
                        }
                    } else {
                        if (s2 > 1) {
                            document.uploader.scale = s2;
                        }
                    }
                    document.getElementById("image").style.width = (('.($width).'/document.uploader.scale)) +"px";
                    document.getElementById("image").style.height = (('.($height).'/document.uploader.scale)) +"px";
                    document.getElementById("img").style.width = ('.($width).'/document.uploader.scale) +"px";
                    document.getElementById("img").style.height = ('.($height).'/document.uploader.scale) +"px";
                    document.getElementById("frame").style.width = ('.($THUWIDTH).'/document.uploader.scale) +"px";
                    document.getElementById("frame").style.height = ('.($THUHEIGHT).'/document.uploader.scale) +"px";
                    document.getElementById("scale").value = document.uploader.scale;
                    addHandler(document.getElementById("frame"), "touchstart", () => { document.uploader.dragMode = 1; });
                    addHandler(document.getElementById("frame"), "touchend", () => { document.uploader.dragMode = 0; });
                    addHandler(document.getElementById("bottom_dot"), "touchend", () => { document.uploader.dragMode = 0; });
                    addHandler(document.getElementById("bottom_dot"), "touchstart", () => { document.uploader.dragMode = 2; });
                    try{
                        window.parent.document.getElementById("'.$f1.'").style.width = ('.($width).'/document.uploader.scale+60) +"px";
                        window.parent.document.getElementById("'.$f1.'").style.height = ('.($height).'/document.uploader.scale+80) +"px";
                    }catch(e) {}
                </script>
            </body>
            </html>';
            die($fout);
        }
        die(engine::lang("Error").'<script type="text/javascript">setTimeout(function() { window.location="'.$_SERVER["DIR"].'/uploader.php?id = '.$_GET["id"].'"; }, 5000);</script></html>');
    }
} else {
    echo '<body class="nodes dragndrop_body"> 
    <form id="upload" method="POST" enctype="multipart/form-data">
        <div style="height: 100%;">
            <input type="file" id="fileselect" name="fileselect" onChange=\'document.getElementById("upload").submit();\' />
            <!-- <div id="filedrag" onClick=\'document.getElementById("fileselect").click();\'>'.engine::lang("Drop file here").'</div> -->
        </div>
        <div id="submitbutton">
            <button class="btn" type="submit" style="display:none;">'.engine::lang("Upload Files").'</button>
        </div>
        <input type="hidden" name="name" value="'.engine::lang("Uploaded").' '.date("Y-m-d H:i:s").'" />
    </form>
    <form method="POST" id="new_image_form">
        <input type="hidden" name="name" value="'.engine::lang("Uploaded").' '.date("Y-m-d H:i:s").'" />
        <input type="hidden" name="new_image" value="" id="new_image" />
    </form>
    <div id="messages"></div>
    <script>
        if (window.File && window.FileList && window.FileReader) { document.uploader.Init(); }
        document.getElementById("fileselect").click();
    </script>
</body>
</html>';
}
