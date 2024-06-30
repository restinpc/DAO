/**
* Uploader JavaScript library.
* @path /script/uploader.js
*
* @name    DAO Mansion    @version 1.0.3
* @author  Alexandr Vorkunov  <devbyzero@yandex.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*/

if (!document.framework) {
    document.framework = {};
}
if (!document.uploader) {
    document.uploader = {
        width: 400,
        height: 400,
        thumbWidth: 400,
        thumbHeight: 400,
        noDragDrop: "Error! Drag-n-drop disabled on this server",
        uploading: "Uploading",
        confirmUpload: "Upload selection as thumb?",
        postNewImage: 0,
        posX: 30,
        posY: 30,
        fx: 0,
        fy: 0,
        dragMode: 0,
        scale: 1
    };
}

/**
* Gets an DOM element using id.
*
* @param {string} id Element id.
* @return {object} Returns a DOM elemnt on success, or die with error.
* @usage <code> let id = $id("content"); </code>
*/
function $id(id) {
    return document.getElementById(id);
}

/**
* Attaches an event handler to the specified element.
*
* @param {object} object DOM Element.
* @param {string} event A String that specifies the name of the event.
* @param {function} handler Callback function.
* @param {bool} useCapture Flag to execute in the capturing or in the bubbling phase.
* @usage <code> addHandler(window, "resize", resize_footer); </code>
*/
function addHandler(object, event, handler, useCapture) {
     if (object.addEventListener) {
         object.addEventListener(event, handler, useCapture ? useCapture : false);
     } else if (object.attachEvent) {
         object.attachEvent('on' + event, handler);
     } else alert("Add handler is not supported");
}

/**
* Positions a crop-frame on image.
*/
document.uploader.drag = (e) => {
    if (!e) {
        e = window.event;
    }
    if (e.pageX || e.pageY) {
        document.uploader.posX = e.pageX;
        document.uploader.posY = e.pageY;
    } else if (e.clientX || e.clientY) {
        document.uploader.posX = e.clientX + document.body.scrollLeft + document.documentElement.scrollLeft;
        document.uploader.posY = e.clientY + document.body.scrollTop + document.documentElement.scrollTop;
    }
    try {
        var touchobj = e.changedTouches[0] ;
        document.uploader.posX = parseInt(touchobj.clientX);
        document.uploader.posY = parseInt(touchobj.clientY);
    } catch(e){}
    if (document.uploader.dragMode == 1) {
        if (document.uploader.fx == 0) {
            document.uploader.fx = document.uploader.posX - parseInt($id("frame").style.left);
        }
        if (document.uploader.fy == 0) {
            document.uploader.fy = document.uploader.posY - parseInt($id("frame").style.top);
        }
        document.uploader.posX -= document.uploader.fx;
        document.uploader.posY -= document.uploader.fy;
        if (document.uploader.posX > $id("img").clientWidth - $id("frame").clientWidth + 34)
            document.uploader.posX = $id("img").clientWidth - $id("frame").clientWidth + 34;
        if (document.uploader.posY > $id("img").clientHeight - $id("frame").clientHeight + 34) {
            document.uploader.posY = $id("img").clientHeight - $id("frame").clientHeight + 34;
        }
        if (document.uploader.posY < 34) {
            document.uploader.posY = 34;
        }
        if (document.uploader.posX < 34) {
            document.uploader.posX = 34;
        }
        $id("frame").style.left = (document.uploader.posX-6)+"px";
        $id("frame").style.top = (document.uploader.posY-6)+"px";
        $id("t").value = document.uploader.posY-32;
        $id("l").value = document.uploader.posX-32;
    } else if (document.uploader.dragMode == 2) {
        var width1 = document.uploader.posX - parseInt($id("frame").style.left);
        var height1 = width1 * (document.uploader.thumbWidth / document.uploader.thumbHeight);
        if ((width1-26 <= $id("img").clientWidth - parseInt($id("frame").style.left))
            && (height1-26 <= $id("img").clientHeight - parseInt($id("frame").style.top))
            && height1 >= document.uploader.thumbHeight / document.uploader.scale
            && width1 >= document.uploader.thumbWidth / document.uploader.scale
        ) {
            document.uploader.width = width1 + 4;
            document.uploader.height = height1 + 4;
            $id("frame").style.width = document.uploader.width + "px";
            $id("frame").style.height = document.uploader.height + "px";
            $id("w").value = document.uploader.width * document.uploader.scale;
            $id("h").value = document.uploader.height * document.uploader.scale;
        }
    } else {
        document.uploader.fx = 0;
        document.uploader.fy = 0;
    }
}

/**
* Submits image and crop details.
*/
document.uploader.submitImg = () => {
    if (confirm(document.uploader.confirmUpload)) {
        $id("form").submit();
    }
}

/**
* Positions a crop-frame on image.
*/
document.uploader.load = () => {
    if ($id("img").clientHeight < document.uploader.height) {
        document.uploader.height = $id("img").clientHeight;
        document.uploader.width = parseInt(document.uploader.thumbWidth / document.uploader.thumbHeight * document.uploader.height);
    } else if ($id("img").clientWidth < document.uploader.width) {
        document.uploader.width = $id("img").clientWidth
        document.uploader.height = parseInt(document.uploader.thumbHeight / document.uploader.thumbWidth * document.uploader.width);
    }
    $id("frame").style.width = document.uploader.width;
    $id("frame").style.height = document.uploader.height;
    $id("frame").style.display = "block";
}

/**
* Disables dragging mode.
*/
document.uploader.undrag = () => {
    document.uploader.dragMode = 0;
}

/**
* Stops dragging mode.
*/
document.uploader.FileDragHover = (e) => {
    e.stopPropagation();
    e.preventDefault();
    e.target.className = (e.type == "dragover" ? "hover" : "");
}

/**
* Drag-n-drop handler.
*/
document.uploader.FileSelectHandler = (e) => {
    document.uploader.FileDragHover(e);
    var files = e.target.files || e.dataTransfer.files;
    for (let i = 0, f; f = files[i]; i++) {
        document.uploader.ParseFile(f);
    }
}

/**
* Parse file details.
*/
document.uploader.ParseFile = (file) => {
    if (file.type.indexOf("image") == 0) {
        const reader = new FileReader();
        reader.onload = (e) => {
            document.uploader.UploadFile(file);
        }
        reader.readAsDataURL(file);
    }
}

/**
* Uploads image to server.
*/
document.uploader.UploadFile = (file) => {
    if (location.host.indexOf("sitepointstatic") >= 0) {
        return;
    }
    if ($id("fileselect").value != "") {
        return;
    }
    var xhr = new XMLHttpRequest();
    if (xhr.upload && (file.type == "image/jpeg" || file.type == "image/jpg" || file.type == "image/gif" || file.type == "image/png") ) {
        var fname = file.name;
        xhr.onreadystatechange = (e) => {
            if (xhr.readyState == 4) {
                if (xhr.responseText == "error") {
                    $id("fileselect").style.display = "block";
                    $id("filedrag").style.display = "none";
                    alert(document.uploader.noDragDrop);
                } else {
                    $id("new_image").value = fname;
                    $id("new_image_form").submit();
                }
            }
        };
        console.error(file);
        xhr.open("POST", document.framework.root_dir+"/uploader.php?dragndrop=1", true);
        xhr.setRequestHeader("X-FILENAME", file.name);
        xhr.setRequestHeader("X_FILENAME", file.name);
        xhr.setRequestHeader("HTTP_X_FILENAME", file.name);
        xhr.send(file);
        $id("filedrag").innerHTML = document.uploader.uploading + "..";
    }
}

/**
* Initialize file drag-n-drop field.
*/
document.uploader.Init = () => {
    const fileselect = $id("fileselect");
    const filedrag = $id("filedrag");
    const submitbutton = $id("submitbutton");
    fileselect.addEventListener("change", document.uploader.FileSelectHandler, false);
    const xhr = new XMLHttpRequest();
    if (xhr.upload) {
        filedrag.addEventListener("dragover", document.uploader.FileDragHover, false);
        filedrag.addEventListener("dragleave", document.uploader.FileDragHover, false);
        filedrag.addEventListener("drop", document.uploader.FileSelectHandler, false);
        filedrag.style.display = "block";
        submitbutton.style.display = "none";
    }
}

/**
* Initialize event functions.
*/
if (document.uploader.postNewImage) {
    addHandler(window, "load", document.uploader.load);
    addHandler(window, "touchmove", document.uploader.drag);
    addHandler(window, "mousemove", document.uploader.drag);
    addHandler(window, "mouseup", document.uploader.undrag);
    addHandler(top, "mouseup", document.uploader.undrag);
    addHandler(window, "dblclick", document.uploader.submitImg);
}
