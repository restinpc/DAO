/**
* Uploader JavaScript library.
* @path /script/uploader.js
*
* @name    DAO Mansion    @version 1.0.3
* @author  Alexandr Vorkunov  <devbyzero@yandex.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*/

if (!jQuery) {
    throw new Error("jQuery not initialized");
}
if (!document.framework) {
    throw new Error("Framework not initialized");
}
if (!document.uploader) {
    throw new Error("Uploader not initialized");
}
document.uploader.posX = 30;
document.uploader.posY = 30;
document.uploader.fx = 0;
document.uploader.fy = 0;
document.uploader.dragMode = 0;
document.uploader.scale = 1;

/**
* Positions a crop-frame on image.
*/
document.uploader.drag = (e) => {
    if (document.uploader.dragMode != 0) {
        document.framework.log(`document.uploader.drag()`);
    }
    try {
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
        if (e.changedTouches && e.changedTouches.length) {
            const touchobj = e.changedTouches[0] ;
            document.uploader.posX = parseInt(touchobj.clientX);
            document.uploader.posY = parseInt(touchobj.clientY);
        }
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
            const width1 = document.uploader.posX - parseInt($id("frame").style.left);
            const height1 = width1 * (document.uploader.thumbWidth / document.uploader.thumbHeight);
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
    } catch(e) {
        document.framework.throw(`document.uploader.drag()`, e);
    }
}

/**
* Submits image and crop details.
*/
document.uploader.submitImg = () => {
    document.framework.log(`document.uploader.submitImg()`);
    try {
        if (confirm(document.uploader.confirmUpload)) {
            $id("form").submit();
        }
    } catch(e) {
        document.framework.throw(`document.uploader.submitImg()`, e);
    }
}

/**
* Positions a crop-frame on image.
*/
document.uploader.load = () => {
    document.framework.log(`document.uploader.load()`);
    try {
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
    } catch(e) {
        document.framework.throw(`document.uploader.load()`, e);
    }
}

/**
* Disables dragging mode.
*/
document.uploader.undrag = () => {
    document.framework.log(`document.uploader.undrag()`);
    document.uploader.dragMode = 0;
}

/**
* Initialize event functions.
*/
setTimeout(() => {
    try {
        if (document.uploader.postNewImage) {
            document.framework.addHandler(window, "load", document.uploader.load);
            document.framework.addHandler(window, "touchmove", document.uploader.drag);
            document.framework.addHandler(window, "mousemove", document.uploader.drag);
            document.framework.addHandler(window, "mouseup", document.uploader.undrag);
            document.framework.addHandler(top, "mouseup", document.uploader.undrag);
            document.framework.addHandler(window, "dblclick", document.uploader.submitImg);
        }
    } catch(e) {
        document.framework.throw(`document.uploader.setTimeout()`, e);
    }
}, 1);
