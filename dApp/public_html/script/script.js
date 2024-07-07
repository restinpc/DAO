/**
* Framework JavaScript library.
*
* @name    DAO Mansion    @version 1.0.3
* @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*/

if (!jQuery) {
    throw new Error("jQuery not initialized");
}
if (!document.framework) {
    document.framework = {};
}
if (!document.framework.preload) {
    document.framework.preload = () => {}
}
document.framework.loading_stages = 6;
document.framework.loading_state = 0;
document.framework.preloaded = 0;
document.framework.screenState = 0;
document.framework.DEBUG = true;
document.framework.ua = navigator.userAgent.toLowerCase();
document.framework.isOpera = (document.framework.ua.indexOf('opera') > -1);
document.framework.isIE = (document.framework.ua.indexOf('msie') > -1);
document.framework.arrowKeys = { 37: 1, 38: 1, 39: 1, 40: 1 }; 
document.framework.window_state = 0;
document.framework.messageInterval = null;
document.framework.traceStack = [];
document.framework.loadEvents = true;
document.framework.chatInterval = null;
document.framework.confirmed = false;
window.stateChangeIsLocal = true;
History.enabled = true;

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
* Console log function wrapper
*/
document.framework.log = (text) => {
    text = `${typeof(text) === "string" ? text : JSON.stringify(text)}`;
    let d = new Date();
    let date = d.getFullYear()
        + "-" + ("0" + (d.getMonth()+1)).slice(-2) 
        + "-"
        + ("0" + d.getDate()).slice(-2) 
        + " " 
        + ("0" + d.getHours()).slice(-2)
        + ":"
        + ("0" + d.getMinutes()).slice(-2)
        + ":"
        + ("0" + d.getSeconds()).slice(-2);
    if (document.framework.traceStack[date + '.000000']) {
        let flag = 0;
        let i = 1;
        do {
            let n = '000000';
            n = n.substr(0, 6 - (i.toString().length)) + i.toString();
            if (!document.framework.traceStack[date + '.' + n]) {
                document.framework.traceStack[date + '.' + n] = text;
                flag = 1;
            } else {
                i++;
            }
        } while(!flag);
    } else {
        document.framework.traceStack[date + '.000000'] = text;
    }
    if (document.framework.DEBUG){
        console.log(text);
    }
}

/**
* Throw exception function wrapper
*/
document.framework.throw = (text, e) => {
    document.framework.log(`${text} -> ${e.message}`);
    document.framework.log(window.location.href + " >>");
    document.framework.log(e.stack);
    document.framework.submitTraceStack();
}

/**
* Displays body after loading
*/
document.framework.display = () => {
    document.framework.log(`document.framework.display()`);
    document.body.style.display = "contents";
}

document.framework.confirmAlive = () => {
    try {
        if (!document.framework.confirmed) {
            document.framework.log(`document.framework.confirmAlive()`);
            document.framework.confirmed = true;
            setTimeout(() => {
                jQuery.ajax({
                    url: document.framework.rootDir + '/timeout.php?ref=' + encodeURI(document.referrer),
                    type: "GET",
                    success: () => {
                        document.framework.log(`document.framework.confirmAlive().success()`);
                    },
                    error: (response, exception) => {
                        document.framework.ajaxError(`document.framework.confirmAlive()`, response, exception);
                        document.framework.submitTraceStack();
                    }
                });
            }, 3000);
        }
    } catch (e) {
        document.framework.throw(`document.framework.confirmAlive()`, e);
    }
}

document.framework.getObjectName = (object) => {
    try {
        let name = '';
        if (object == window) {
            name = 'window';
        } else if (object == document) {
            name = 'document';
        } else if (object == document.body) {
            name = 'body';
        } else if (object.name) {
            name = object.name;
        } else if (object.id) {
            name = object.id;
        } else if (object.tag) {
            name = object.tag;
        } else {
            name = object.toString();
        }
        return name;
    } catch(e) {
        document.framework.throw(`document.framework.getObjectName()`, e);
    }
}

document.framework.handleUserEvents = () => {
    document.framework.log(`document.framework.handleUserEvents()`);
    try {
        if (!document.framework.confirmed) {
            document.framework.addHandler(window, "mousemove", document.framework.confirmAlive);
            document.framework.addHandler(document.body, "mousemove", document.framework.confirmAlive);
            document.framework.addHandler(window, "scroll", document.framework.confirmAlive);
            document.framework.addHandler(document.body, "scroll", document.framework.confirmAlive);
            document.framework.addHandler(window, 'DOMMouseScroll', document.framework.confirmAlive);
            document.framework.addHandler(document.body, "DOMMouseScroll", document.framework.confirmAlive);
            document.framework.addHandler(window, 'touchstart', document.framework.confirmAlive);
            document.framework.addHandler(window, 'touchmove', document.framework.confirmAlive);
            document.framework.addHandler(document.body, 'touchstart', document.framework.confirmAlive);
            document.framework.addHandler(document.body, 'touchmove', document.framework.confirmAlive);
        }
    } catch(e) {
        document.framework.throw(`document.framework.handleUserEvents()`, e);
    }
}

/**
* Loads site data and calls requered function after
*/
document.framework.loadSite = () => {
    document.framework.log(`document.framework.loadSite()`);
    try {
        document.framework.loading_state++;
        if (document.framework.loading_state != document.framework.loading_stages) {
            return;
        }
        if (!document.framework.messageInterval) {
            document.framework.loading_state = 4;
            document.framework.materialIcons();
            document.framework.preload();
            document.framework.ajaxing();
            document.framework.checkAnchors();
            setTimeout(document.framework.display, 1000);
            document.framework.messageInterval = setInterval(document.framework.checkMessage, 60000);
        }
        if (document.framework.timeout) {
            clearTimeout(document.framework.timeout);
        }
    } catch(e) {
        document.framework.throw(`document.framework.loadSite()`, e);
    }
}

/**
* Gets a document height in px.
*/
document.framework.getDocumentHeight = () => {
    document.framework.log(`document.framework.getDocumentHeight()`);
    try {
        const fout = Math.max(document.compatMode != 'CSS1Compat' ? document.body.scrollHeight:
            document.documentElement.scrollHeight,document.framework.getViewportHeight());
        return fout;
    } catch(e) {
        document.framework.throw(`document.framework.getDocumentHeight()`, e);
    }
}

/**
* Gets a document width in px.
*/
document.framework.getDocumentWidth = () => {
    document.framework.log(`document.framework.getDocumentWidth()`);
    try {
        const fout = Math.max(document.compatMode != 'CSS1Compat' ? document.body.scrollWidth:
            document.documentElement.scrollWidth,document.framework.getViewportWidth());
        return fout;
    } catch(e) {
        document.framework.throw(`document.framework.getDocumentWidth()`, e);
    }
}

/**
* Gets a viewport height in px.
*/
document.framework.getViewportHeight = () => {
    document.framework.log(`document.framework.getViewportHeight()`);
    try {
        const fout = ((document.compatMode || document.framework.isIE) && !document.framework.isOpera)
            ? (document.compatMode == 'CSS1Compat')
                ? document.documentElement.clientHeight : document.body.clientHeight
            : (document.parentWindow || document.defaultView).innerHeight;
        return fout;
    } catch(e) {
        document.framework.throw(`document.framework.getViewportHeight()`, e);
    }
}

/**
* Gets a viewport width in px.
*/
document.framework.getViewportWidth = () => {
    document.framework.log(`document.framework.getViewportWidth()`);
    try {
        const fout = ((document.compatMode || document.framework.isIE) && !document.framework.isOpera)
            ? (document.compatMode == 'CSS1Compat')
                ? document.documentElement.clientWidth : document.body.clientWidth
            : (document.parentWindow || document.defaultView).innerWidth;
        return fout;
    } catch(e) {
        document.framework.throw(`document.framework.getViewportWidth()`, e);
    }
}

/**
* Attaches an event handler to the specified element.
*
* @param {object} object DOM Element.
* @param {string} event A String that specifies the name of the event.
* @param {function} handler Callback function.
* @param {bool} useCapture Flag to execute in the capturing or in the bubbling phase.
* @usage <code> document.framework.addHandler(window, "resize", resize_footer); </code>
*/
document.framework.addHandler = (object, event, handler, useCapture) => {
    let name = document.framework.getObjectName(object);
    document.framework.log(`document.framework.addHandler(${name}, ${event})`);
    try {
        if (object.addEventListener) {
            object.addEventListener(event, handler, useCapture ? useCapture : false);
        } else if (object.attachEvent) {
            object.attachEvent('on' + event, handler);
        } else {
            alert("Add handler is not supported");
        }
    } catch(e) {
        document.framework.throw(`document.framework.addHandler(${name}, ${event})`, e);
    }
}

document.framework.insertAfter = (node, referenceNode) => {
    let name = document.framework.getObjectName(node);
    let reference = document.framework.getObjectName(referenceNode);
    document.framework.log(`document.framework.insertAfter(${name}, ${reference})`);
    try {
        if (!node || !referenceNode) {
            return;
        }
        let parent = referenceNode.parentNode, nextSibling = referenceNode.nextSibling;
        if (nextSibling && parent) {
            parent.insertBefore(node, referenceNode.nextSibling);
        } else if (parent) {
            parent.appendChild(node);
        }
    } catch(e) {
        document.framework.throw(`document.framework.insertAfter(${name}, ${reference})`, e);
    }
}

/**
* Positions any popup windows.
*/
document.framework.positionWindow = () => {
    document.framework.log(`document.framework.positionWindow()`);
    try {
        if ($id("nodes_login")) {
            let wnd_height = $id("nodes_login").clientHeight;
            let top = ((document.framework.getViewportHeight() - wnd_height) / 3);
            if (top < 0) {
                top = 0;
            }
            $id("nodes_login").style.top = top + "px";
        }
        if ($id("nodes_popup")) {
            let wnd_height = $id("nodes_popup").clientHeight;
            let wnd_width = $id("nodes_popup").clientWidth;
            if (document.framework.getViewportWidth() > 600) {
                $id("nodes_popup").style.marginLeft = "-" + (wnd_width / 2) + "px";
            } else {
                $id("nodes_popup").style.marginLeft = "0px";
            }
            let top = ((document.framework.getViewportHeight()-wnd_height)/3);
            if (top < 90) {
                top = 90;
            }
            $id("nodes_popup").style.top = top+"px";
        }
    } catch(e) {
        document.framework.throw(`document.framework.positionWindow()`, e);
    }
}

/**
* Hides any popup windows.
*/
document.framework.hideWindow = () => {
    document.framework.log(`document.framework.hideWindow()`);
    try {
        document.framework.enableScroll();
        document.body.style.overflow = "auto";
        if ($id("nodes_window")) {
            document.body.removeChild($id("nodes_window"));
        }
        if ($id("nodes_popup")) {
            document.body.removeChild($id("nodes_popup"));
        }
        if ($id("nodes_login")) {
            document.body.removeChild($id("nodes_login"));
        }
        document.framework.removeSiteFade();
    } catch(e) {
        document.framework.throw(`document.framework.hideWindow()`, e);
    }
}

/**
* Displays a fullscreen window with specified content.
*/
document.framework.showWindow = (content) => {
    document.framework.log(`document.framework.showWindow(${content})`);
    try {
        if (content && content != "undefined") {
            window.scrollTo(0,0);
            document.framework.disableScroll();
            document.body.style.overflow = "hidden";
            let a = document.createElement("div");
            a.id = "nodes_window";
            a.innerHTML = '<div class="close_button close_wnd" onClick=\'document.framework.hideWindow();\'>&nbsp;</div>'+content;
            document.body.appendChild(a);
            document.framework.addSiteFade();
        } else {
            document.framework.hideWindow();
        }
    } catch(e) {
        document.framework.throw(`document.framework.showWindow(${content})`, e);
    }
}

document.framework.changeHeight = () => {
    document.framework.log(`document.framework.changeHeight()`);
    try {
        const val = $id('height').value;
        const cam = window.frames[0].$id('camera');
        const pos = cam.getAttribute('position');
        cam.setAttribute('position', pos.x + ' ' + (parseFloat(val)) + ' ' + pos.z);
    } catch(e) {
        document.framework.throw(`document.framework.changeHeight()`, e);
    }
}

/**
* Displays a popup window with specified content.
*/
document.framework.showPopup = (content, showCloseBtn = true) => {
    document.framework.log(`document.framework.showPopup(${content}, ${showCloseBtn})`);
    try {
        if (content && content != "undefined") {
            document.framework.disableScroll();
            document.body.style.overflow = "hidden";
            let a = document.createElement("div");
            a.id = "nodes_popup";
            if (showCloseBtn) {
                a.innerHTML = '<div class="close_button close_wnd" onClick=\'document.framework.hideWindow();\'>&nbsp;</div>';
            }
            a.innerHTML += content;
            document.body.appendChild(a);
            document.framework.addSiteFade();
            document.framework.positionWindow();
            document.framework.addHandler(window, "resize", document.framework.positionWindow);
        } else {
            document.framework.hideWindow();
        }
    } catch(e) {
        document.framework.throw(`document.framework.showPopup(${content}, ${showCloseBtn})`, e);
    }
}

/**
* Displays file source code viewer.
*/
document.framework.showEditor = (file) => {
    document.framework.log(`document.framework.showEditor(${file})`);
    try {
        document.framework.showWindow('<div class="fl m5"><b>'+file+'</b></div>'
            + '<div class="clear"><br/></div>'
            + '<img src="' + document.framework.rootDir + '/img/load.gif" id="loader" class="mt18p">'
            + '<iframe width=100% height=95% frameborder=0 src="' + document.framework.rootDir + '/edit.php?file='+file+'" onLoad=\'$id("loader").style.display="none";\' />'
        );
    } catch(e) {
        document.framework.throw(`document.framework.showEditor(${file})`, e);
    }
}

/**
* Displays new comment form.
*
* @param {string} caption Header of form.
* @param {string} submit Button text.
* @param {int} reply @mysql[nodes_comment]->id.
*/
document.framework.addComment = (caption, submit, reply) => {
    document.framework.log(`document.framework.addComment(${caption})`);
    try {
        document.framework.showPopup('<form method="POST">'+
                '<div id="new_comment">'+
                    '<input type="hidden" name="reply" value="'+reply+'" />'+
                    '<strong>'+caption+'</strong><br/><br/>'+
                    '<textarea id="comment_textarea" name="comment" cols=50 class="comment_textarea"></textarea><br/><br/>'+
                    '<center><input id="submit-comment" type="submit" class="btn w280" value="'+submit+'" /></center><br/>'+
                '</div>'+
            '</form>'
        );
    } catch(e) {
        document.framework.throw(`document.framework.addComment(${caption})`, e);
    }
}

/**
* Removes a comment.
*
* @param {string} text Text of message.
* @param {int} id @mysql[nodes_order]->id.
*/
document.framework.deleteComment = (text, id) => {
    document.framework.log(`document.framework.deleteComment(${text}, ${id})`);
    try {
        if (confirm(text)) {
            jQuery.ajax({
                type: "POST",
                data: { "comment_id" : id },
                url: document.framework.rootDir + "/bin.php",
                success: () => {
                    document.framework.log(`document.framework.deleteComment(${text}, ${id}).success()`);
                    window.location.reload();
                },
                error: (response, exception) => {
                    document.framework.ajaxError(`document.framework.deleteComment(${text}, ${id})`, response, exception);
                    document.framework.submitTraceStack();
                }
            });
        }
    } catch(e) {
        document.framework.throw(`document.framework.deleteComment(${text}, ${id})`, e);
    } 
}

/**
* Displays photo uploader.
*/
document.framework.showPhotoUploader = () => {
    document.framework.log(`document.framework.showPhotoUploader()`);
    try {
        document.framework.showPopup('<iframe width=100% height=95% frameborder=0 src="'+document.framework.rootDir + '/images.php?editor=1" scrolling="yes" style="margin-top: 10px; min-height: 180px;"></iframe>');
    } catch(e) {
        document.framework.throw(`document.framework.showPhotoUploader()`, e);
    } 
}

/**
* Displays photo editor.
*/
document.framework.showPhotoEditor = (id, pos) => {
    document.framework.log(`document.framework.showPhotoEditor(${id}, ${pos})`);
    try {
        document.framework.showWindow('<iframe width=100% height=95% id="img_editor" frameborder=0 src="'+document.framework.rootDir + '/images.php?id='+id+'&pos='+pos+'" scrolling="yes" style="margin-top: 10px;" />');
    } catch(e) {
        document.framework.throw(`document.framework.showPhotoEditor(${id}, ${pos})`, e);
    } 
}

/**
* Displays order window.
*/
document.framework.showOrder = () => {
    document.framework.log(`document.framework.showOrder()`);
    try {
        document.framework.showWindow('<iframe width=100% height=95% frameborder=0 src="'+document.framework.rootDir + '/order.php" scrolling="yes" style="margin-top: 10px;" />');
    } catch(e) {
        document.framework.throw(`document.framework.showOrder()`, e);
    }
}

/**
* Destorys current user http-session and resets cookie data.
*/
document.framework.logout = () => {
    document.framework.log(`document.framework.logout()`);
    try {
        window.scrollTo(0, 0);
        const content = '<iframe frameborder=0 id="nodes_iframe" class="hidden" src="'+document.framework.rootDir + '/account.php?mode=logout"></iframe>';
        document.framework.disableScroll();
        document.body.style.overflow = "hidden";
        const a = document.createElement("div");
        a.id = "nodes_login";
        a.innerHTML = content;
        document.body.appendChild(a);
        document.framework.addSiteFade();
    } catch(e) {
        document.framework.throw(`document.framework.logout()`, e);
    }
}

/**
* Prevents default event-listener function.
*/
document.framework.preventDefault = (e) => {
    document.framework.log(`document.framework.preventDefault()`);
    try {
        const event = e || window.event;
        if (event.preventDefault) {
            event.preventDefault();
        }
        event.returnValue = false;
    } catch(e) {
        document.framework.throw(`document.framework.preventDefault()`, e);
    }
}

/**
* Prevents scrolling by keys.
*/
document.framework.preventDefaultForScrollKeys = (e) => {
    document.framework.log(`document.framework.preventDefaultForScrollKeys()`);
    try {
        if (document.framework.arrowKeys[e.keyCode]) {
            document.framework.preventDefault(e);
            return false;
        }
    } catch(e) {
        document.framework.throw(`document.framework.preventDefaultForScrollKeys()`, e);
    }
}

/**
* Disables page scrolling.
*/
document.framework.disableScroll = () => {
    document.framework.log(`document.framework.disableScroll()`);
    try {
        document.framework.addHandler(window, 'DOMMouseScroll', document.framework.preventDefault, false);
        window.onwheel = document.framework.preventDefault;
        window.onmousewheel = document.onmousewheel = document.framework.preventDefault;
        window.ontouchmove  = document.framework.preventDefault;
        document.onkeydown  = document.framework.preventDefaultForScrollKeys;
    } catch(e) {
        document.framework.throw(`document.framework.disableScroll()`, e);
    }
}

/**
* Enables page scrolling.
*/
document.framework.enableScroll = () => {
    document.framework.log(`document.framework.enableScroll()`);
    try {
        if (window.removeEventListener) {
            window.removeEventListener('DOMMouseScroll', document.framework.preventDefault, false);
        }
        window.onmousewheel = document.onmousewheel = null;
        window.onwheel = null;
        window.ontouchmove = null;
        document.onkeydown = null;
    } catch(e) {
        document.framework.throw(`document.framework.enableScroll()`, e);
    }
}

/**
* Decodes a string from base64-encode.
*/
document.framework.base64_decode = (data) => {
    document.framework.log(`document.framework.base64Decode(${data})`);
    try {
        let b64 = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
        let o1, o2, o3, h1, h2, h3, h4, bits, i=0, enc='';
        do {
            h1 = b64.indexOf(data.charAt(i++));
            h2 = b64.indexOf(data.charAt(i++));
            h3 = b64.indexOf(data.charAt(i++));
            h4 = b64.indexOf(data.charAt(i++));
            bits = h1 << 18 | h2 << 12 | h3 << 6 | h4;
            o1 = bits >> 16 & 0xff;
            o2 = bits >> 8 & 0xff;
            o3 = bits & 0xff;
            if (h3 == 64) {
                enc += String.fromCharCode(o1);
            } else if (h4 == 64) {
                enc += String.fromCharCode(o1, o2); 
            } else {
                enc += String.fromCharCode(o1, o2, o3);
            }
        } while (i < data.length);
        return enc;
    } catch(e) {
        document.framework.throw(`document.framework.base64_decode(${data})`, e);
    }
}

/**
* Updates <a> tag onclick event with async jquery page loading function.
*/
document.framework.ajaxing = () => {
    document.framework.log(`document.framework.ajaxing()`);
    try {
        document.framework.window_state = 0;
        jQuery('a').on('click', (e) => {
            const a = e.currentTarget;
            if (jQuery(e.currentTarget).attr('href')) {
                if (jQuery(a).attr('target') != "_blank" && jQuery(a).attr('target') != "_parent" && jQuery(a).attr('target') != "_top"){
                    try {
                        if (jQuery('.mdl-layout__drawer').attr('aria-hidden') == "false") {
                            jQuery('.mdl-layout__obfuscator').click();
                        }
                        jQuery('.android-content').scrollTop(0);
                        jQuery('.android-header').removeClass("is-casting-shadow");
                    } catch(err) {}
                    try{
                        hideMenu();
                        jQuery('body,html').scrollTop(0);
                    } catch(err){}
                    if (jQuery(a).attr('href').indexOf(location.hostname) !== false){
                        e.preventDefault();
                        history.pushState('', '', jQuery(a).attr('href'));
                        document.framework.goto(jQuery(a).attr('href'));
                    } else if(jQuery(a).attr('href').indexOf("http") === false) {
                        e.preventDefault();
                        history.pushState('', '', jQuery(a).attr('href'));
                        document.framework.goto(jQuery(a).attr('href'));
                    }
                }
            }
        });
    } catch(e) {
        document.framework.throw(`document.framework.ajaxing()`, e);
    }
}

/**
* Submits a search results details form.
*/
document.framework.refreshPage = () => {
    document.framework.log(`document.framework.refreshPage()`);
    try {
        jQuery("#content").animate({ opacity: 0 }, 300);
        $id("query_form").submit();
    } catch(e) {
        document.framework.throw(`document.framework.refreshPage()`, e);
    }
}

/**
* Async page loading using AJAX.
*/
document.framework.goto = (href) => {
    document.framework.log(`document.framework.goto(${href})`);
    try {
        if (!document.framework.window_state) {
            if (href[0] != "#") {
                window.scrollTo(0, 0);
                document.documentElement.style.background = "#1a1d1d url(/img/load.gif) no-repeat center center fixed";
                document.documentElement.style.backgroundSize = "45px";
                document.framework.window_state = 1;
                jQuery("#content").animate({opacity: 0}, 100);
                let to = setTimeout(() => {
                    window.location = document.framework.rootDir + "/error.php?504=1";
                }, 30000);
                let anchor = '';
                let details = href.split('#');
                if (details[1]) {
                    href = details[0];
                    anchor = details[1];
                }
                jQuery.ajax({
                    url: href,
                    async: true,
                    type: "POST",
                    data: {'jQuery': 'true'},
                    success: (data) => {
                        document.framework.log(`document.framework.goto(${href}).success()`);
                        try {
                            let title = jQuery(data).filter('title').text();
                            document.title = title;
                            if (jQuery('.site_title')) {
                                jQuery('.site_title').text(title);
                            }
                            let url = jQuery(data).filter('link[itemprop="url"]');
                            if (url && url.length) {
                                history.replaceState({}, null, url[0].getAttribute("href"));
                            }
                            setTimeout(() => {
                                try {
                                    $id("content").innerHTML = data;
                                    jQuery("#content").animate({opacity: 1}, 300);
                                    clearTimeout(to);
                                    document.documentElement.style.background = "#1a1d1d";
                                    if (anchor != '') {
                                        document.framework.showAnchor(anchor);
                                    }
                                    document.framework.loadSite();
                                    let script = jQuery(data).filter('script').text();
                                    try {
                                        eval(script);
                                    } catch(e){
                                        document.framework.throw(`document.framework.goto(${href}).success().eval(${script})`, e);
                                    }
                                    setTimeout(document.framework.ajaxing, 1);
                                    setTimeout(document.framework.checkAnchors, 1);
                                } catch(e) {
                                    document.framework.throw(`document.framework.goto(${href}).success().timeout()`, e);
                                }
                            }, 1);
                        } catch(e) {
                            document.framework.throw(`document.framework.goto(${href}).success()`, e);
                        }
                    },
                    error: (response, exception) => {
                        document.framework.ajaxError(`document.framework.confirmAlive()`, response, exception);
                        document.framework.submitTraceStack();
                    }
                });
            } else {
                let hash = href.split("#");
                if (hash.length && hash[1]) {
                    document.framework.showAnchor(hash[1]);
                }
            }
        }
    } catch(e) {
        document.framework.throw(`document.framework.goto(${href})`, e);
    }
}

/**
* Scrolls a page to specified anchor.
*/
document.framework.showAnchor = (anchor) => {
    document.framework.log(`document.framework.showAnchor(${anchor})`);
    try {
        if (anchor) {
            if (jQuery('.android-content')) {
                jQuery('.android-content').animate({ scrollTop: parseInt(jQuery("a[name='"+anchor+"']").offset().top - 80)}, 200,'swing');
            } else {
                jQuery('html, body').animate({ scrollTop: parseInt(jQuery("a[name='"+anchor+"']").offset().top - 80)}, 200,'swing');
            }
        }
    } catch(e) {
        document.framework.throw(`document.framework.showAnchor(${anchor})`, e);
    }
}

/**
* Checking for # in URL and scroll page to anchor if exists.
*/
document.framework.checkAnchors = () => {
    document.framework.log(`document.framework.checkAnchors()`);
    try {
        let hash = window.location.href.split("#");
        if (hash.length && hash[1]) {
            document.framework.showAnchor(hash[1]);
        }
    } catch(e) {
        document.framework.throw(`document.framework.checkAnchors()`, e);
    }
}

/**
* Loading specified table's page.
*/
document.framework.goto_page = (page) => {
    document.framework.log(`document.framework.goto_page(${page})`);
    try {
        $id("page_field").value = page;
        document.framework.refreshPage();
    } catch(e) {
        document.framework.throw(`document.framework.goto_page(${page})`, e);
    }
}

/**
* Initialize admin functions.
*/
document.framework.adminInit = () => {
    document.framework.log(`document.framework.adminInit()`);
    try {
        let js = document.createElement("script");
        js.type = "text/javascript";
        js.src = document.framework.rootDir + "/script/admin.js";
        document.body.appendChild(js);
        const func = () => {
            try {
                document.getElementsByClassName("admin_content")[0].style.minHeight = (window.innerHeight - 49) + "px";
            } catch (e) {}
        }
        document.framework.addHandler(window, "resize", () => func(), true);
        func();
    } catch(e) {
        document.framework.throw(`document.framework.adminInit()`, e);
    }
}

/**
* Initialize event tinymce library.
*/
document.framework.tinymceInit = () => {
    document.framework.log(`document.framework.tinymceInit()`);
    try {
        let script = document.createElement('script');
        script.src = document.framework.rootDir + "/script/tinymce/tinymce.js"
        document.body.appendChild(script);
        script.onload = () => {
            tinymce.init({ selector:'textarea#editable,textarea#editable_2',
                plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table contextmenu paste code'
                ],
                setup: (ed) => {
                    ed.on('init', (args) => {
                        let a = document.createElement("div");
                        a.id = "mceu_91";
                        a.className = "mce-widget mce-btn";
                        a.title = "Upload photo"
                        a.innerHTML = '<button id="tiny_button_'+parseInt(Math.random()*10000)+'"  tabindex="-1" id="mceu_91-button" role="presentation" type="button" onClick="document.framework.showPhotoUploader();"><i class="mce-ico mce-i-image"></i></button>';
                        document.framework.insertAfter(a, $id("mceu_9"));
                    });
                },
              toolbar1: 'insertfile undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist link  image media preview | forecolor backcolor emoticons | codesample'
            });
        }
    } catch(e) {
        document.framework.throw(`document.framework.tinymceInit()`, e);
    }
}

/**
* Submits search form.
*/
document.framework.submitSearchForm = () => {
    document.framework.log(`document.framework.submitSearchForm()`);
    try {
        $id("page_field").value = 1;
        document.framework.refreshPage();
    } catch(e) {
        document.framework.throw(`document.framework.submitSearchForm()`, e);
    }
}

/**
* Displays screen fade.
*/
document.framework.addSiteFade = () => {
    document.framework.log(`document.framework.addSiteFade()`);
    try {
        if (jQuery('#nodes_fade').length == 0) {
            return jQuery("<div id='nodes_fade'></div>").appendTo('body').fadeIn(500);
        }
    } catch(e) {
        document.framework.throw(`document.framework.addSiteFade()`, e);
    }
}

/**
* Removes screen fade.
*/
document.framework.removeSiteFade = () => {
    document.framework.log(`document.framework.removeSiteFade()`);
    try {
        jQuery('#nodes_fade').fadeOut(() => {
            jQuery(this).remove()
        });
    } catch(e) {
        document.framework.throw(`document.framework.removeSiteFade()`, e);
    }
}

/**
* Converts dates in Unixtime format to current Local time format.
*/
document.framework.browserTime = () => {
    document.framework.log(`document.framework.browserTime()`);
    try {
        jQuery('.utc_date').each(() => {
            let utc = new Date(jQuery(this).attr("alt") * 1000);
            jQuery(this).html(utc.toLocaleString());
        });
    } catch(e) {
        document.framework.throw(`document.framework.browserTime()`, e);
    }
}

/**
* Removes a product from cart.
*/
document.framework.removeFromCart = (id) => {
    document.framework.log(`document.framework.removeFromCart(${id})`);
    try {
        jQuery.ajax({
            type: "POST",
            data: {	"remove" : id },
            url: document.framework.rootDir + "/bin.php",
            success: () => {
                document.framework.log(`document.framework.removeFromCart(${id}).success()`)
                window.location = document.framework.rootDir + "/order.php";
            },
            error: (response, exception) => {
                document.framework.ajaxError(`document.framework.removeFromCart(${id})`, response, exception);
                document.framework.submitTraceStack();
            }
        });
    } catch(e) {
        document.framework.throw(`document.framework.removeFromCart(${id})`, e);
    }
}

/**
* Displays Add-To-Cart message.
*/
document.framework.buyNow = (id, t0, t1, t2) => {
    document.framework.log(`document.framework.buyNow(${id})`);
    try {
        jQuery.ajax({
            type: "POST",
            data: {	"id" : id },
            url: document.framework.rootDir + "/bin.php",
            success: () => {
                document.framework.log(`document.framework.buyNow(${id}).success()`);
            },
            error: (response, exception) => {
                document.framework.ajaxError(`document.framework.buyNow(${id})`, response, exception);
                document.framework.submitTraceStack();
            }
        });
        document.framework.showPopup('<br/><p>'+t0+'</p><br/><br/><input id="input-card-1" type="button" value="'+t1+'" onClick=\'document.framework.hideWindow();\' class="btn w130" /> &nbsp; <input id="input-card-2" value="'+t2+'" class="btn w130" type="button" onClick=\'document.framework.hideWindow(); setTimeout(document.framework.showOrder, 500);\' /><br/><br/>');
    } catch(e) {
        document.framework.throw(`document.framework.buyNow(${id})`, e);
    }
}

/**
* Displays money withdrawal form.
*/
document.framework.withdrawal = (text) => {
    document.framework.log(`document.framework.withdrawal(${text})`);
    try {
        alertify.prompt('', '<h3>'+text+'</h3><br/>', '',
            (evt, value) => {
                jQuery.ajax({
                    type: "POST",
                    data: {"paypal" : value },
                    url: document.framework.rootDir + "/bin.php",
                    success: (data) => {
                        document.framework.log(`document.framework.withdrawal(${text}).success()`);
                        jQuery('.alertify').remove();
                        alert(data);
                    },
                    error: (response, exception) => {
                        document.framework.ajaxError(`document.framework.withdrawal(${text})`, response, exception);
                        document.framework.submitTraceStack();
                    }
                });
            },
            () => { jQuery('.alertify').remove(); }
        ).set('closable', true);
    } catch(e) {
        document.framework.throw(`document.framework.withdrawal(${text})`, e);
    }
}

/**
* Displays money deposit form.
*/
document.framework.deposit = (text) => {
    document.framework.log(`document.framework.deposit(${text})`);
    try {
        alertify.prompt('', '<h3>'+text+'</h3><br/>', '',
            (evt, value) => {
                if ($id("paypal_price")) {
                    $id("paypal_price").value = value;
                }
                $id("pay_button").click();
            },
            () => { jQuery('.alertify').remove(); }
        );
    } catch(e) {
        document.framework.throw(`document.framework.deposit(${text})`, e);
    }
}

/**
* Redirects to PayPal payment page.
*/
document.framework.processPayment = (id, price) => {
    document.framework.log(`document.framework.processPayment(${id}, ${price})`);
    try {
        jQuery.ajax({
            type: "POST",
            data: {	"price" : price },
            url: document.framework.rootDir + "/paypal.php?order_id=" + id,
            success: () => {
                document.framework.log(`document.framework.processPayment(${id}, ${price}).success()`);
                window.location = document.framework.rootDir + "/account/purchases";
            },
            error: (response, exception) => {
                document.framework.ajaxError(`document.framework.processPayment(${id}, ${price})`, response, exception);
                document.framework.submitTraceStack();
            }
        });
    } catch(e) {
        document.framework.throw(`document.framework.processPayment(${id}, ${price})`, e);
    }
}

/**
* Submits a new message to chat.
*/
document.framework.postMessage = (id) => {
    document.framework.log(`document.framework.postMessage(${id})`);
    try {
        let txt = jQuery("#nodes_message_text").val();
        jQuery("#nodes_message_text").val("");
        jQuery("#nodes_chat").html($id("nodes_chat").innerHTML +
            '<br/><div class="chat_loader"><img src="' + document.framework.rootDir + '/img/white_load.gif" /></div>');
        jQuery("#nodes_chat").scrollTop(jQuery("#nodes_chat")[0].scrollHeight);
        jQuery.ajax({
            type: "POST",
            data: { "text" : txt },
            url: document.framework.rootDir + '/bin.php?message=' + id,
            success: (data) => {
                document.framework.log(`document.framework.postMessage(${id}).success()`);
                jQuery("#nodes_chat").html(data);
                jQuery("#nodes_chat").scrollTop(jQuery("#nodes_chat")[0].scrollHeight);
            },
            error: (response, exception) => {
                document.framework.ajaxError(`document.framework.postMessage(${id})`, response, exception);
                document.framework.submitTraceStack();
            }
        });
    } catch(e) {
        document.framework.throw(`document.framework.postMessage(${id})`, e);
    }
}

/**
* Refreshes chat window.
*/
document.framework.refreshChat = (id) => {
    document.framework.log(`document.framework.refreshChat(${id})`);
    try {
        let chat = $id("nodes_chat");
        if (chat) {
            if (chat.getAttribute("target") == id) {
                jQuery.ajax({
                    type: "GET",
                    url: document.framework.rootDir + '/bin.php?message=' + id,
                    success: (data) => {
                        document.framework.log(`document.framework.refreshChat(${id}).success()`);
                        let height = chat.scrollHeight;
                        let flag = chat.innerHTML.length == 0;
                        if (height - chat.scrollTop - chat.clientHeight < 2) {
                            flag = true;
                        }
                        chat.innerHTML = data;
                        if (flag || (!flag && chat.scrollHeight > height)) {
                            chat.scrollTop = chat.scrollHeight;
                        }
                    },
                    error: (response, exception) => {
                        document.framework.ajaxError(`document.framework.refreshChat(${id})`, response, exception);
                        document.framework.submitTraceStack();
                    }
                });
            }
        } else {
            clearInterval(document.framework.chatInterval);
        }
    } catch(e) {
        document.framework.throw(`document.framework.refreshChat(${id})`, e);
    }
}

/**
* Check for new messages.
*/
document.framework.checkMessage = () => {
    document.framework.log(`document.framework.checkMessage()`);
    try {
        jQuery.ajax({
            type: "POST",
            data: { "check_message" : 1 },
            url: document.framework.rootDir + '/bin.php',
            success: (data) => {
                document.framework.log(`document.framework.checkMessage().success()`);
                if (data && data.length) {
                    if (!$id("nodes_message")) {
                        let regexp = /from="(.*?)"/su;
                        let match = data.match(regexp);
                        if (window.location.href.indexOf(`/${match[1]}`) != window.location.href.length - parseInt(`/${match[1]}`.length)) {
                            const div = document.createElement('div');
                            div.innerHTML = data;
                            document.body.appendChild(div);
                        }
                    }
                }
            },
            error: (response, exception) => {
                document.framework.ajaxError(`document.framework.checkMessage()`, response, exception);
                document.framework.submitTraceStack();
            }
        });
    } catch(e) {
        document.framework.throw(`document.framework.checkMessage()`, e);
    }
}

/**
* Displays 1-to-5 stars vote form.
*/
document.framework.starRating = (total_rating) => {
    document.framework.log(`document.framework.starRating(${total_rating})`);
    try {
        const star_widht = total_rating * 17 ;
        jQuery('.rating_votes').width(star_widht);
        jQuery('.rating_stars').hover(() => {
            jQuery('.rating_votes, .rating_hover').toggle();
          },
          () => {
            jQuery('.rating_votes, .rating_hover').toggle();
          }
        );
        const margin_doc = jQuery(".rating_stars").offset();
        jQuery(".rating_stars").mousemove((e) => {
            let widht_votes = e.pageX - margin_doc.left;
            if (widht_votes == 0) {
                widht_votes = 1;
            }
            user_votes = Math.ceil(widht_votes / 17);
            jQuery('.rating_hover').width(user_votes * 17);
        });
        jQuery('.rating_stars').click(() => {
            jQuery('.rating_votes').width((user_votes) * 17);
            $id("nodes_rating").value = user_votes;
        });
    } catch(e) {
        document.framework.throw(`document.framework.starRating(${total_rating})`, e);
    }
}

/**
* Scales an image rotator.
*/
document.framework.scaleSlider = () => {
    document.framework.log(`document.framework.scaleSlider()`);
    try {
        let refSize = document.framework.image_rotator.$Elmt.parentNode.clientWidth;
        if (refSize) {
            refSize = Math.min(refSize, 600);
            document.framework.image_rotator.$ScaleWidth(refSize);
        }else {
            window.setTimeout(document.framework.scaleSlider, 30);
        }
    } catch(e) {}
}

/**
* Displays an image rotator.
*/
document.framework.showRotator = (obj) => {
    document.framework.log(`document.framework.showRotator()`);
    try {
        document.framework.image_rotator = new $JssorSlider$("jssor_1", {
            $AutoPlay: true,
            $FillMode: 5,
            $SlideshowOptions: {
                $Class: $JssorSlideshowRunner$,
                $Transitions: [
                    {$Duration:1200,$Zoom:11,$Rotate:-1,$Easing:{$Zoom:$Jease$.$InQuad,$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InQuad},$Opacity:2,$Round:{$Rotate:0.5},$Brother:{$Duration:1200,$Zoom:1,$Rotate:1,$Easing:$Jease$.$Swing,$Opacity:2,$Round:{$Rotate:0.5},$Shift:90}},
                    {$Duration:1400,x:0.25,$Zoom:1.5,$Easing:{$Left:$Jease$.$InWave,$Zoom:$Jease$.$InSine},$Opacity:2,$ZIndex:-10,$Brother:{$Duration:1400,x:-0.25,$Zoom:1.5,$Easing:{$Left:$Jease$.$InWave,$Zoom:$Jease$.$InSine},$Opacity:2,$ZIndex:-10}},
                    {$Duration:1200,$Zoom:11,$Rotate:1,$Easing:{$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InQuad},$Opacity:2,$Round:{$Rotate:1},$ZIndex:-10,$Brother:{$Duration:1200,$Zoom:11,$Rotate:-1,$Easing:{$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InQuad},$Opacity:2,$Round:{$Rotate:1},$ZIndex:-10,$Shift:600}},
                    {$Duration:1500,x:0.5,$Cols:2,$ChessMode:{$Column:3},$Easing:{$Left:$Jease$.$InOutCubic},$Opacity:2,$Brother:{$Duration:1500,$Opacity:2}},
                    {$Duration:1500,x:-0.3,y:0.5,$Zoom:1,$Rotate:0.1,$During:{$Left:[0.6,0.4],$Top:[0.6,0.4],$Rotate:[0.6,0.4],$Zoom:[0.6,0.4]},$Easing:{$Left:$Jease$.$InQuad,$Top:$Jease$.$InQuad,$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InQuad},$Opacity:2,$Brother:{$Duration:1000,$Zoom:11,$Rotate:-0.5,$Easing:{$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InQuad},$Opacity:2,$Shift:200}},
                    {$Duration:1500,$Zoom:11,$Rotate:0.5,$During:{$Left:[0.4,0.6],$Top:[0.4,0.6],$Rotate:[0.4,0.6],$Zoom:[0.4,0.6]},$Easing:{$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InQuad},$Opacity:2,$Brother:{$Duration:1000,$Zoom:1,$Rotate:-0.5,$Easing:{$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InQuad},$Opacity:2,$Shift:200}},
                    {$Duration:1500,x:0.3,$During:{$Left:[0.6,0.4]},$Easing:{$Left:$Jease$.$InQuad,$Opacity:$Jease$.$Linear},$Opacity:2,$Outside:true,$Brother:{$Duration:1000,x:-0.3,$Easing:{$Left:$Jease$.$InQuad,$Opacity:$Jease$.$Linear},$Opacity:2}},
                    {$Duration:1200,x:0.25,y:0.5,$Rotate:-0.1,$Easing:{$Left:$Jease$.$InQuad,$Top:$Jease$.$InQuad,$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InQuad},$Opacity:2,$Brother:{$Duration:1200,x:-0.1,y:-0.7,$Rotate:0.1,$Easing:{$Left:$Jease$.$InQuad,$Top:$Jease$.$InQuad,$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InQuad},$Opacity:2}},
                    {$Duration:1600,x:1,$Rows:2,$ChessMode:{$Row:3},$Easing:{$Left:$Jease$.$InOutQuart,$Opacity:$Jease$.$Linear},$Opacity:2,$Brother:{$Duration:1600,x:-1,$Rows:2,$ChessMode:{$Row:3},$Easing:{$Left:$Jease$.$InOutQuart,$Opacity:$Jease$.$Linear},$Opacity:2}},
                    {$Duration:1600,x:1,$Rows:2,$ChessMode:{$Row:3},$Easing:{$Left:$Jease$.$InOutQuart,$Opacity:$Jease$.$Linear},$Opacity:2,$Brother:{$Duration:1600,x:-1,$Rows:2,$ChessMode:{$Row:3},$Easing:{$Left:$Jease$.$InOutQuart,$Opacity:$Jease$.$Linear},$Opacity:2}},
                    {$Duration:1600,y:-1,$Cols:2,$ChessMode:{$Column:12},$Easing:{$Top:$Jease$.$InOutQuart,$Opacity:$Jease$.$Linear},$Opacity:2,$Brother:{$Duration:1600,y:1,$Cols:2,$ChessMode:{$Column:12},$Easing:{$Top:$Jease$.$InOutQuart,$Opacity:$Jease$.$Linear},$Opacity:2}},
                    {$Duration:1200,y:1,$Easing:{$Top:$Jease$.$InOutQuart,$Opacity:$Jease$.$Linear},$Opacity:2,$Brother:{$Duration:1200,y:-1,$Easing:{$Top:$Jease$.$InOutQuart,$Opacity:$Jease$.$Linear},$Opacity:2}},
                    {$Duration:1200,x:1,$Easing:{$Left:$Jease$.$InOutQuart,$Opacity:$Jease$.$Linear},$Opacity:2,$Brother:{$Duration:1200,x:-1,$Easing:{$Left:$Jease$.$InOutQuart,$Opacity:$Jease$.$Linear},$Opacity:2}},
                    {$Duration:1200,y:-1,$Easing:{$Top:$Jease$.$InOutQuart,$Opacity:$Jease$.$Linear},$Opacity:2,$ZIndex:-10,$Brother:{$Duration:1200,y:-1,$Easing:{$Top:$Jease$.$InOutQuart,$Opacity:$Jease$.$Linear},$Opacity:2,$ZIndex:-10,$Shift:-100}},
                    {$Duration:1200,x:1,$Delay:40,$Cols:6,$Formation:$JssorSlideshowFormations$.$FormationStraight,$Easing:{$Left:$Jease$.$InOutQuart,$Opacity:$Jease$.$Linear},$Opacity:2,$ZIndex:-10,$Brother:{$Duration:1200,x:1,$Delay:40,$Cols:6,$Formation:$JssorSlideshowFormations$.$FormationStraight,$Easing:{$Top:$Jease$.$InOutQuart,$Opacity:$Jease$.$Linear},$Opacity:2,$ZIndex:-10,$Shift:-100}},
                    {$Duration:1500,x:-0.1,y:-0.7,$Rotate:0.1,$During:{$Left:[0.6,0.4],$Top:[0.6,0.4],$Rotate:[0.6,0.4]},$Easing:{$Left:$Jease$.$InQuad,$Top:$Jease$.$InQuad,$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InQuad},$Opacity:2,$Brother:{$Duration:1000,x:0.2,y:0.5,$Rotate:-0.1,$Easing:{$Left:$Jease$.$InQuad,$Top:$Jease$.$InQuad,$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InQuad},$Opacity:2}},
                    {$Duration:1600,x:-0.2,$Delay:40,$Cols:12,$During:{$Left:[0.4,0.6]},$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationStraight,$Assembly:260,$Easing:{$Left:$Jease$.$InOutExpo,$Opacity:$Jease$.$InOutQuad},$Opacity:2,$Outside:true,$Round:{$Top:0.5},$Brother:{$Duration:1000,x:0.2,$Delay:40,$Cols:12,$Formation:$JssorSlideshowFormations$.$FormationStraight,$Assembly:1028,$Easing:{$Left:$Jease$.$InOutExpo,$Opacity:$Jease$.$InOutQuad},$Opacity:2,$Round:{$Top:0.5}}}
                ],
                $TransitionsOrder: 1
            },
            $BulletNavigatorOptions: {
              $Class: $JssorBulletNavigator$
            }
        });
    } catch(e) {
        console.error(e.message);
    }
    try {
        document.framework.scaleSlider();
        document.framework.addHandler(window, "load", document.framework.scaleSlider);
        document.framework.addHandler(window, "resize", document.framework.scaleSlider);
        document.framework.addHandler(window, "orientationchange", document.framework.scaleSlider);
        initPhotoSwipeFromDOM(obj);
    } catch(e) {
        document.framework.throw(`document.framework.showRotator()`, e);
    }
}

/**
* Displays an icons.
*/
document.framework.materialIcons = () => {
    document.framework.log(`document.framework.materialIcons()`);
    try {
        jQuery('.material-icons').css('display', 'inline-block');
        jQuery('.material-icons').css('visibility', 'visible');
    } catch(e){
        document.framework.throw(`document.framework.materialIcons()`, e);
    }
}

document.framework.changeLang = (lang) => {
    document.framework.log(`document.framework.changeLang(${lang})`);
    try {
        const href = window.location.href;
        if (href.indexOf("?") > 0) {
            let pos = href.indexOf("?lang=");
            if (pos > 0) {
                let replace  = href[pos + 6] + href[pos + 7];
                window.location = href.replace("?lang=" + replace, "?lang=" + lang);
            } else {
                pos = href.indexOf("&lang=");
                if (pos > 0) {
                    let replace = href[pos + 6] + href[pos + 7];
                    window.location = href.replace("&lang=" + replace, "&lang=" + lang);
                } else {
                    window.location = href + "&lang=" + lang;
                }
            }
        } else {
            window.location = href + "?lang=" + lang;
        }
    } catch(e){
        document.framework.throw(`document.framework.changeLang(${lang})`, e);
    }
}

/**
* Displays an image viewer.
*/
document.framework.nodesGallery = (src) => {
    document.framework.log(`document.framework.nodesGallery(${src})`);
    try {
        for (let i = 0; i < 20; i++) {
            let el = $id('nodes_gallery_'+i);
            if (el) {
                if (el.alt == src) {
                    el.click();
                }
            }
        }
    } catch(e){
        document.framework.throw(`document.framework.nodesGallery(${src})`, e);
    }
}

document.framework.requestFullScreen = (element) => {
    document.framework.log(`document.framework.requestFullScreen()`);
    try {
        // Supports most browsers and their versions.
        var requestMethod = element.requestFullScreen || element.webkitRequestFullScreen || element.mozRequestFullScreen || element.msRequestFullScreen;
        if (requestMethod) { // Native full screen.
            requestMethod.call(element);
        } else if (typeof window.ActiveXObject !== "undefined") { // Older IE.
            var wscript = new ActiveXObject("WScript.Shell");
            if (wscript !== null) {
                wscript.SendKeys("{F11}");
            }
        }
    } catch(e){
        document.framework.throw(`document.framework.requestFullScreen()`, e);
    }
}

document.framework.fullScreen = () => {
    document.framework.log(`document.framework.fullScreen()`);
    try {
        document.framework.permission();
        const iframe = document.getElementsByTagName("iframe")[0];
        if (iframe) {
            iframe.style.top = "0px";
            iframe.style.height = "100%";
            iframe.style.position = "fixed";
            iframe.style.zIndex = 2;
            document.framework.screenState = 1;
            $id("fullscreen_icon").setAttribute("src", "/img/vr/normalscreen.png");
        }
    } catch(e){
        document.framework.throw(`document.framework.fullScreen()`, e);
    }
}

document.framework.hideFullScreen = () => {
    document.framework.log(`document.framework.hideFullScreen()`);
    try {
        const iframe = document.getElementsByTagName("iframe")[0];
        if (iframe) {
            iframe.style.top = "40px";
            iframe.style.height = "calc(100% - 40px)";
            iframe.style.position = "fixed";
            iframe.style.zIndex = 0;
            document.framework.screenState = 0;
            $id("fullscreen_icon").setAttribute("src","/img/vr/fullscreen.png");
        }
        if (document.exitFullscreen) {
            document.exitFullscreen();
        } else if (document.webkitExitFullscreen) {
            document.webkitExitFullscreen();
        } else if (document.mozCancelFullScreen) {
            document.mozCancelFullScreen();
        } else if (document.msExitFullscreen) {
            document.msExitFullscreen();
        }
    } catch(e){
        document.framework.throw(`document.framework.hideFullScreen()`, e);
    }
}

document.framework.toggleScreen = () => {
    document.framework.log(`document.framework.toggleScreen()`);
    try {
        if (document.framework.screenState) {
            document.framework.hideFullScreen();
        } else {
            document.framework.fullScreen();
        }
    } catch(e){
        document.framework.throw(`document.framework.toggleScreen()`, e);
    }
}

document.framework.permission = () => {
    document.framework.log(`document.framework.permission()`);
    try {
        if (typeof(DeviceMotionEvent) !== "undefined" && typeof( DeviceMotionEvent.requestPermission ) === "function" ) {
            // (optional) Do something before API request prompt.
            DeviceMotionEvent.requestPermission().then(response => {
                // (optional) Do something after API prompt dismissed.
                if (response == "granted") {
                    window.addEventListener( "devicemotion", (e) => {
                        // do something for \'e\' here.
                    })
                }
            }).catch( console.error )
        } else {
            console.error( "DeviceMotionEvent is not defined" );
        }
    } catch(e){
        document.framework.throw(`document.framework.permission()`, e);
    }
}

document.framework.vrMode = () => {
    document.framework.log(`document.framework.vrMode()`);
    try {
        document.framework.permission();
        document.framework.fullScreen();
        const iframe = document.getElementsByTagName("iframe")[0];
        const innerDoc = (iframe.contentDocument) ? iframe.contentDocument : iframe.contentWindow.document;
        innerDoc.getElementsByTagName("a-scene")[0].enterVR();
        jQuery(".icon").css("display", "none");
        try {
            innerDoc.getElementById("np").style.display = "none";
        } catch(e) {}
        innerDoc.getElementsByTagName("a-scene")[0].addEventListener("exit-vr", () => {
            try {
                innerDoc.getElementById("np").style.display = "block";
            } catch(e) {}
            document.framework.hideFullScreen();
            jQuery(".icon").css("display", "block");
        });
    } catch(e){
        document.framework.throw(`document.framework.vrMode()`, e);
    }
}

document.framework.showMap = () => {
    document.framework.log(`document.framework.showMap()`);
    try {
        const frame = $id("map_frame");
        frame.style.display = "block";
    } catch(e){
        document.framework.throw(`document.framework.showMap()`, e);
    }
}

document.framework.hideMap = () => {
    document.framework.log(`document.framework.hideMap()`);
    try {
        $id("map_frame").display = "none";
    } catch(e){
        document.framework.throw(`document.framework.hideMap()`, e);
    }
}

document.framework.scaleMap = () => {
    document.framework.log(`document.framework.scaleMap()`);
    try {
        let width = $id("panorama").clientWidth;
        let height = $id("panorama").clientHeight;
        let size = width > height ? height : width;
        let scale = size / 650;
        $id("map_iframe").style.scale = scale;
    } catch(e){
        document.framework.throw(`document.framework.scaleMap()`, e);
    }
}

document.framework.ajaxError = (method, response, exception) => {
    document.framework.log(`document.framework.ajaxError(${exception})`);
    try {
        if (response.status === 0) {
            document.framework.log(method + '.error(Not connected. Verify Network)');
        } else if (response.status == 404) {
            document.framework.log(method + '.error(Requested page not found (404))');
        } else if (response.status == 500) {
            document.framework.log(method + '.error(Internal Server Error (500))');
        } else if (exception === 'parsererror') {
            document.framework.log(method + '.error(Requested JSON parse failed)');
        } else if (exception === 'timeout') {
            document.framework.log(method + '.error(Time out error)');
        } else if (exception === 'abort') {
            document.framework.log(method + '.error(Ajax request aborted)');
        } else {
            document.framework.log(method + '.error(' + response.responseText + ')');
        }
    } catch(e){
        document.framework.throw(`document.framework.ajaxError(${exception})`, e);
    }
}

/**
* Method to get backend trace logs.
*/
document.framework.getLogs = (callback) => {
    document.framework.log(`document.framework.getLogs()`);
    try {
        jQuery.ajax({
            type: "GET",
            url: document.framework.rootDir + "/log.php",
            success: (data) => {
                document.framework.log(`document.framework.getLogs().success()`);
                let logs = {...document.framework.traceStack, ...JSON.parse(data)};
                let text = '';
                Object.keys(logs).sort().forEach((key) => {
                    text += key + ": " + logs[key] + "\n";
                });
                callback(text);
            },
            error: (response, exception) => {
                document.framework.ajaxError(`document.framework.getLogs()`, response, exception);
                document.framework.submitTraceStack();
            }
        });
    } catch(e){
        document.framework.throw(`document.framework.getLogs()`, e);
    }
}

/**
* Method to submit debug information
*/
document.framework.submitTraceStack = () => {
    document.framework.log(`document.framework.submitTraceStack()`);
    document.framework.getLogs((logs) => {
        jQuery.ajax({
            type: "POST",
            url: document.framework.rootDir + "/trace.php",
            data: { "logs": logs },
            success: () => {
                // window.location = document.framework.rootDir + "/error.php?500=1";
            },
            error: (response, exception) => {
                document.framework.ajaxError('document.framework.submitTraceStack()', response, exception);
                if (document.framework.blackBox) {
                    jQuery.ajax({
                        type: "POST",
                        url: document.framework.blackBox + "/trace",
                        data: JSON.stringify({ text: logs }),
                        contentType: "text/json; charset=UTF-8",
                        processData: false,
                        dataType: 'json',
                        success: () => {
                            // window.location = document.framework.rootDir + "/error.php?500=1";
                        },
                        error: () => {
                            // window.location = document.framework.rootDir + "/error.php?500=1";
                        }
                    });
                } else {
                    // window.location = document.framework.rootDir + "/error.php?500=1";
                }
            }
        });
    });
}

setTimeout(() => {
    try {
        if (!alertify) {
            alert = (text) => {
                document.framework.showPopup('<br/><p>'+text+'</p><br/><br/><input id="input-ok-btn" type="button" value="OK" onClick=\'document.framework.hideWindow();\' class="btn w130" /><br/><br/>');
                return false;
            };
        } else {
            alert = alertify.alert;
        }
        window.onpopstate = () => {
            document.framework.goto(window.location.href);
        }
    } catch(e) {
        document.framework.throw(`document.framework.setTimeout()`, e);
    }
}, 1);