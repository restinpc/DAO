/**
* A-frame based panorama viewer JavaScript library.
* @path /script/panorama.js
* 
* @name    DAO Mansion    @version 1.0.3
* @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*/

if (!jQuery) {
    throw new Error("jQuery not initialized");
}
if (!document.framework) {
    throw new Error("Framework not initialized");
}
if (!THREE) {
    throw new Error("A-frame not initialized");
}
if (!document.panorama) {
    document.panorama = {};
}
document.panorama.currentObject = null;
document.panorama.currentFunction = null;
document.panorama.popupState = 0;
document.panorama.vrLoadState = 0;
document.panorama.zoom = 1;
document.panorama.objectId = 0;
document.panorama.navigationState = 1;
document.panorama.cameraDegree = '';
document.panorama.coordinatesFrom = null;
document.panorama.coordinatesVR = null;
document.panorama.mouse = new THREE.Vector2();
document.panorama.ray = null;
document.panorama.mouseImg = null;
document.panorama.canvas = null;
document.panorama.scene = null;
document.panorama.camera = null;
document.panorama.rig = null;
document.panorama.logo = null;
document.panorama.movePoint = null;
document.panorama.marker = null;
document.panorama.mouseListnerFlag = 0;
document.panorama.sceneState = 0;
document.panorama.levelId = 0;

document.panorama.mobileMode = () => {
    document.framework.log(`document.panorama.mobileMode()`);
    try {
        document.panorama.sceneState = 2;
    } catch(e) {
        document.framework.throw(`document.panorama.mobileMode()`, e); 
    }
}

document.panorama.pcMode = () => {
    document.framework.log(`document.panorama.pcMode()`);
    try {
        document.panorama.sceneState = 1;
        let arr = document.getElementsByClassName("hotpoint");
        for (let i = 0; i < arr.length; i++) {
            arr[i].addEventListener("click", () => { document.panorama.clickVR(arr[i]) });
        }
        document.panorama.marker.setAttribute("scale", "0.01 0.01 0.01");
        $id("fuse").setAttribute("scale", "0.01 0.01 0.01");
    } catch(e) {
        document.framework.throw(`document.panorama.pcMode()`, e); 
    }
}

document.panorama.loadVR = (levelId) => {
    document.framework.log(`document.panorama.loadVR(${levelId})`);
    try {
        document.panorama.levelId = levelId;
        if (!document.panorama.vrLoadState) {
            document.panorama.ray = $id("ray");
            document.panorama.mouseImg = $id("cursor_img");
            document.panorama.cubemap = $id("cubemap");
            document.panorama.content = $id("content");
            document.panorama.canvas = document.getElementsByTagName("canvas")[0];
            document.panorama.scene = $id("nodes_scene");
            document.panorama.camera = $id("camera");
            document.panorama.rig = $id("rig");
            document.panorama.logo = $id("vr_logo");
            document.panorama.movePoint = $id("move_point");
            document.panorama.marker = $id("marker");
            document.panorama.marker.setAttribute("material", "opacity", "0");
            document.panorama.rotateCamera();
            document.panorama.resizeScene();
            document.framework.addHandler(window, "resize", document.panorama.resizeScene);
            document.panorama.scene.addEventListener('enter-vr', () => {
                if (document.panorama.sceneState == 3) {
                    try {
                        $id("sectionsNav").style.opacity="0";
                        $id("sectionsNav").style.display="none";
                    } catch(e) {}
                    try {
                        $id("scene_map").style.opacity="0";
                        $id("scene_map").style.display="none";
                    } catch(e) {}
                    try {
                        $id("scene_show_editor").style.opacity="0";
                        $id("scene_show_editor").style.display="none";
                    } catch(e) {}
                }
            });
            document.panorama.scene.addEventListener('exit-vr', function () {
                try {
                    $id("sectionsNav").style.opacity="1";
                    $id("sectionsNav").style.display="block";
                } catch(e) {}
                try {
                    $id("scene_map").style.opacity="1";
                    $id("scene_map").style.display="block";
                } catch(e) {}
                try {
                    $id("scene_show_editor").style.opacity="1";
                    $id("scene_show_editor").style.display="block";
                } catch(e) {}
            });
            if (document.body.addEventListener) {
                if ('onwheel' in document) {
                  document.body.addEventListener("wheel", document.panorama.zoomScene);
                } else if ('onmousewheel' in document) {
                  document.body.addEventListener("mousewheel", document.panorama.zoomScene);
                } else {
                  document.body.addEventListener("MozMousePixelScroll", document.panorama.zoomScene);
                }
            } else {
                document.body.attachEvent("onmousewheel", document.panorama.zoomScene);
            }
            $id("nodes_vr_scene").style.opacity = "1";
            document.panorama.logo.setAttribute("opacity", "0");
            $id("vr-block").style.display = "none";
            document.panorama.marker.setAttribute("material", "opacity", "1");
            let arr = document.getElementsByClassName("custom_object");
            for (let i = 0; i < arr.length; i++) {
                arr[i].setAttribute("opacity", "1");
            }
            arr = document.getElementsByClassName("hotpoint");
            for (let i = 0; i < arr.length; i++) {
                arr[i].setAttribute("opacity", "1");
            }
            const detectMob = () => {
                const toMatch = [
                    /Android/i,
                    /webOS/i,
                    /iPhone/i,
                    /iPad/i,
                    /iPod/i,
                    /BlackBerry/i,
                    /Windows Phone/i
                ];
                return toMatch.some((toMatchItem) => {
                    return navigator.userAgent.match(toMatchItem);
                });
            }
            if (screen.orientation.type != 'landscape-primary'
                || detectMob(navigator.userAgent)
                || navigator.userAgentData.mobile
            ) {
                document.panorama.mobileMode();
            } else {
                document.panorama.pcMode();
            }
        }
        document.panorama.vrLoadState = 1;
    } catch(e) {
        document.framework.throw(`document.panorama.loadVR(${levelId})`, e); 
    }
}

document.panorama.clickVR = (object) => {
    const name = document.framework.getObjectName(object);
    document.framework.log(`document.panorama.clickVR(${name})`);
    try {
        let func = object.getAttribute("action");
        if (func) {
            eval(func);
        }
        document.panorama.endFuse();
        document.panorama.currentObject = null;
    } catch(e) {
        document.framework.throw(`document.panorama.clickVR(${name})`, e); 
    }
}

document.panorama.showSceneEditor = () => {
    document.framework.log(`document.panorama.showSceneEditor()`);
    try {
        $id("add_area").style.display = "block";
        $id("scene_editor").style.display="block";
        $id("scene_show_editor").style.display="none";
        $id("floor").setAttribute("opacity", "0.1");
    } catch(e) {
        document.framework.throw(`document.panorama.showSceneEditor()`, e); 
    }
}

document.panorama.deleteNavigation = (id) => {
    document.framework.log(`document.panorama.deleteNavigation(${id})`);
    try {
        if (confirm("Are you sure?")) {
            $id("action_"+id).value = "delete_point";
            $id("object_"+id+"_form").submit();
        }
    } catch(e) {
        document.framework.throw(`document.panorama.deleteNavigation(${id})`, e); 
    }
}

document.panorama.deleteURL = (id) => {
    document.framework.log(`document.panorama.deleteURL(${id})`);
    try {
        if (confirm("Are you sure?")) {
            $id("action_"+id).value = "delete_url";
            $id("url_"+id+"_form").submit();
        }
    } catch(e) {
        document.framework.throw(`document.panorama.deleteURL(${id})`, e); 
    }
}

document.panorama.applyChangesURL = (id) => {
    document.framework.log(`document.panorama.applyChangesURL(${id})`);
    try {
        $id("url_" + id).setAttribute("position", $id("url_" + id + "_position").value);
        $id("url_" + id).setAttribute("scale", $id("url_" + id + "_scale").value);
    } catch(e) {
        document.framework.throw(`document.panorama.applyChangesURL(${id})`, e); 
    }
}

document.panorama.applyChangesNavigation = (id) => {
    document.framework.log(`document.panorama.applyChangesNavigation(${id})`);
    try {
        $id("point_"+id).setAttribute("position", $id("point_"+id+"_position").value);
        $id("point_"+id).setAttribute("scale", $id("point_"+id+"_scale").value);
    } catch(e) {
        document.framework.throw(`document.panorama.applyChangesNavigation(${id})`, e); 
    }
}

document.panorama.deleteObject = (id) => {
    document.framework.log(`document.panorama.deleteObject(${id})`);
    try {
        if (confirm("Are you sure?")) {
            $id("action_"+id).value = "delete_object";
            $id("object_"+id+"_form").submit();
        }
    } catch(e) {
        document.framework.throw(`document.panorama.deleteObject(${id})`, e); 
    }
}

document.panorama.applyChangesObject = (id) => {
    document.framework.log(`document.panorama.applyChangesObject(${id})`);
    try {
        $id("object_"+id).setAttribute("color", $id("object_"+id+"_color").value);
        $id("object_"+id).setAttribute("position", $id("object_"+id+"_position").value);
        $id("object_"+id).setAttribute("rotation", $id("object_"+id+"_rotation").value);
        $id("object_"+id).setAttribute("scale", $id("object_"+id+"_scale").value);
    } catch(e) {
        document.framework.throw(`document.panorama.applyChangesObject(${id})`, e); 
    }
}

document.panorama.resizeScene = () => {
    document.framework.log(`document.panorama.resizeScene()`);
    try {
        if ($id("nodes_vr_scene") && $id("sectionsNav")) {
            $id("nodes_vr_scene").style.height = (document.framework.getViewportHeight() - parseInt($id("sectionsNav").clientHeight)) + "px";
        }
    } catch(e) {
        document.framework.throw(`document.panorama.resizeScene()`, e); 
    }
}

document.panorama.applySceneChanges = () => {
    document.framework.log(`document.panorama.applySceneChanges()`);
    try {
        document.panorama.rig.setAttribute("position", $id("camera_position").value);
        document.panorama.rig.setAttribute("rotation", $id("camera_rotation").value);
        $id("floor").setAttribute("position", $id("floor_position").value);
        $id("floor").setAttribute("radius", $id("floor_radius").value);
        $id("vr_logo").setAttribute("width", $id("logo_size").value);
        $id("vr_logo").setAttribute("height", $id("logo_size").value);
    } catch(e) {
        document.framework.throw(`document.panorama.applySceneChanges()`, e); 
    }
}

document.panorama.defaultSettings = () => {
    document.framework.log(`document.panorama.defaultSettings()`);
    try {
        if (confirm("Are you sure you want to restore default scene configuration?")) {
            $id("act").name = "default";
            $id("scene_form").submit();
        }
    } catch(e) {
        document.framework.throw(`document.panorama.defaultSettings()`, e); 
    }
}

document.panorama.navigate = () => {
    document.framework.log(`document.panorama.navigate()`);
    try {
        const position = document.panorama.movePoint.object3D.getWorldPosition();
        const points = document.getElementsByClassName("hotpoint");
        let point_id = null;
        let lowest = 0;
        for (let i = 0; i < points.length; i++){
            const point = points[i].object3D.getWorldPosition();
            const distance = Math.sqrt(
                (position.x - point.x) * (position.x - point.x) +
                (position.y - point.y) * (position.y - point.y) +
                (position.z - point.z) * (position.z - point.z)
            );
            if (lowest == 0 || distance < lowest) {
                lowest = distance;
                point_id = points[i].id;
            }
        }
        if (point_id != null && point_id != "point_new_nav") {
            document.panorama.clickVR($id(point_id));
        }
    } catch(e) {
        document.framework.throw(`document.panorama.navigate()`, e); 
    }
}

document.panorama.zoomScene = (e) => {
    document.framework.log(`document.panorama.zoomScene()`);
    try {
        e = e || window.event;
        const delta = e.deltaY || e.detail || e.wheelDelta;
        if (delta > 1 && document.panorama.zoom > 1) {
            document.panorama.zoom -= 1;
        } else if (delta < 1 && document.panorama.zoom <= 3.5) {
            document.panorama.zoom += 1;
        }
        document.panorama.camera.setAttribute("zoom", document.panorama.zoom);
        if (document.panorama.zoom == 1) {
            $id("cubemap_0").setAttribute("scale", '1 1 1');
            $id("cubemap_1").setAttribute("scale", '1.01 1.01 1.01');
            $id("cubemap_2").setAttribute("scale", '1.01 1.01 1.01');
            $id("cubemap_3").setAttribute("scale", '1.01 1.01 1.01');
            for (let x = 0; x < $id("cubemap_1").childNodes.length; x++) {
                let k = $id("cubemap_1").childNodes[x].id;
                $id(k).setAttribute("opacity", "0");
            }
            for (let x = 0; x < $id("cubemap_2").childNodes.length; x++) {
                let k = $id("cubemap_2").childNodes[x].id;
                $id(k).setAttribute("opacity", "0");
            }
            for (let x = 0; x < $id("cubemap_3").childNodes.length; x++) {
                let k = $id("cubemap_3").childNodes[x].id;
                $id(k).setAttribute("opacity", "0");
            }
        } else if (document.panorama.zoom == 2) {
            $id("cubemap_0").setAttribute("scale", '1.01 1.01 1.01');
            $id("cubemap_1").setAttribute("scale", '1 1 1');
            $id("cubemap_2").setAttribute("scale", '1.01 1.01 1.01');
            $id("cubemap_3").setAttribute("scale", '1.01 1.01 1.01');
            for (let x = 0; x < $id("cubemap_1").childNodes.length; x++){
                let k = $id("cubemap_1").childNodes[x].id;
                $id(k).setAttribute("opacity", "1");
            }
            for (let x = 0; x < $id("cubemap_2").childNodes.length; x++){
                let k = $id("cubemap_2").childNodes[x].id;
                $id(k).setAttribute("opacity", "0");
            }
            for (let x = 0; x < $id("cubemap_3").childNodes.length; x++){
                let k = $id("cubemap_3").childNodes[x].id;
                $id(k).setAttribute("opacity", "0");
            }
        } else if (document.panorama.zoom == 3) {
            $id("cubemap_0").setAttribute("scale", '1.01 1.01 1.01');
            $id("cubemap_1").setAttribute("scale", '1.01 1.01 1.01');
            $id("cubemap_2").setAttribute("scale", '1 1 1');
            $id("cubemap_3").setAttribute("scale", '1.01 1.01 1.01');
            for (let x = 0; x < $id("cubemap_2").childNodes.length; x++) {
                let k = $id("cubemap_2").childNodes[x].id;
                $id(k).setAttribute("opacity", "1");
            }
            for (let x = 0; x < $id("cubemap_3").childNodes.length; x++) {
                let k = $id("cubemap_3").childNodes[x].id;
                $id(k).setAttribute("opacity", "0");
            }
        } else {
            $id("cubemap_0").setAttribute("scale", '1.01 1.01 1.01');
            $id("cubemap_1").setAttribute("scale", '1.01 1.01 1.01');
            $id("cubemap_2").setAttribute("scale", '1.01 1.01 1.01');
            $id("cubemap_3").setAttribute("scale", '1 1 1');
            for (let x = 0; x < $id("cubemap_3").childNodes.length; x++) {
                let k = $id("cubemap_3").childNodes[x].id;
                $id(k).setAttribute("opacity", "1");
            }
        }
        e.preventDefault ? e.preventDefault() : (e.returnValue = false);
    } catch(e) {
        document.framework.throw(`document.panorama.zoomScene()`, e);
    }
}

document.panorama.startFuse = (object) => {
    try {
        const name = document.framework.getObjectName(object);
        if (object != document.panorama.currentObject && document.panorama.vrLoadState && document.panorama.sceneState > 1) {
            document.framework.log(`document.panorama.startFuse(${name})`);
            document.panorama.currentObject = object;
            document.panorama.currentFunction = setTimeout((object) => {
                document.panorama.clickVR(object);
            }, 2500, object);
            $id("fuse").emit('cursor-fusing');
        }
    } catch(e) {
        document.framework.throw(`document.panorama.startFuse(${name})`, e); 
    }
}

document.panorama.endFuse = () => {
    try {
        if (document.panorama.currentFunction && document.panorama.sceneState > 1) {
            document.framework.log(`document.panorama.endFuse()`);
            $id("fuse").emit('cursor-stop-fusing');
            $id("fuse").emit('cursor-unfusing');
            clearTimeout(document.panorama.currentFunction);
            document.panorama.currentFunction = null;
        }
    } catch(e) {
        document.framework.throw(`document.panorama.endFuse()`, e); 
    }
}

document.panorama.addObject = () => {
    document.framework.log(`document.panorama.addObject()`);
    try {
        $id("add_area").style.display = "none";
        jQuery(".vr_object_window").css("display", "none");
        $id("object_new_obj").setAttribute("opacity", "1");
        $id("object_new_obj_window").style.display = "block";
        document.panorama.objectId = "new_obj";
    } catch(e) {
        document.framework.throw(`document.panorama.addObject()`, e); 
    }
}

document.panorama.addNavigation = () => {
    document.framework.log(`document.panorama.addNavigation()`);
    try {
        $id("add_area").style.display = "none";
        $id("point_new_nav_window").style.display = "block";
        document.panorama.objectId = "new_nav";
    } catch(e) {
        document.framework.throw(`document.panorama.addNavigation()`, e); 
    }
}

document.panorama.addURL = () => {
    document.framework.log(`document.panorama.addURL()`);
    try {
        $id("add_area").style.display = "none";
        $id("url_new_google").setAttribute("opacity", "1");
        $id("url_new_google_window").style.display = "block";
        document.panorama.objectId = "new_google";
    } catch(e) {
        document.framework.throw(`document.panorama.addURL()`, e); 
    }
}

document.panorama.rotateCamera = () => {
    document.framework.log(`document.panorama.rotateCamera()`);
    try {
        if (window.location.hash) {
            let hash = window.location.hash.replace("#", "");
            hash = hash.split(";");
            if (parseFloat(hash[0]) != 0 && parseFloat(hash[1]) != 0) {
                const rotation = "0 " + parseFloat(hash[1]) + " 0";
                document.panorama.rig.setAttribute("rotation", rotation);
            }
        }
    } catch(e) {
        document.framework.throw(`document.panorama.rotateCamera()`, e); 
    }
}
       
document.panorama.resetSceneObjects = (id) => {
    document.framework.log(`document.panorama.resetSceneObjects(${id})`);
    try {
        if (confirm("Are you sure you want to remove all custom objects from this scene?")) {
            jQuery.ajax({
                type: "POST",
                data: { "scene_reset" : id },
                url: document.framework.rootDir + "/bin.php",
                success: () => {
                    document.framework.log(`document.panorama.resetSceneObjects(${id}).success()`);
                    window.location.reload();
                },
                error: (response, exception) => {
                    document.framework.ajaxError(`document.panorama.resetSceneObjects(${id})`, response, exception);
                    document.framework.submitTraceStack();
                }
            });
        }
    } catch(e) {
        document.framework.throw(`document.panorama.resetSceneObjects(${id})`, e); 
    }
}

document.panorama.loadScene = (id, object_id) => {
    document.framework.log(`document.panorama.loadScene(${id}, ${object_id})`);
    try {
        if (!document.panorama.navigationState) {
            return;
        }
        document.panorama.coordinatesFrom = null;
        document.panorama.vrLoadState = 0;
        document.panorama.navigationState = 0;
        try {
            window.history.replaceState( {} , 'Panorama Viewer', '/panorama.php?id='+id );
        } catch(e) {}
        document.panorama.movePoint.setAttribute("material", "opacity", "0");
        document.panorama.mouseImg.setAttribute("material", "opacity", "0");
        document.panorama.zoom = 1;
        $id("camera").setAttribute("zoom", 1);
        for (let x = 0; x < $id("cubemap_1").childNodes.length; x++) {
            let k = $id("cubemap_1").childNodes[x].id;
            try {
                $id(k).setAttribute("opacity", "0");
                $id(k).setAttribute("is_load", "0");
                $id(k).setAttribute("src", "#pixel");
            } catch(e) {}
        }
        for (let x = 0; x < $id("cubemap_2").childNodes.length; x++) {
            let k = $id("cubemap_2").childNodes[x].id;
            try {
                $id(k).setAttribute("opacity", "0");
                $id(k).setAttribute("is_load", "0");
                $id(k).setAttribute("src", "#pixel");
            } catch(e) {}
        }
        for (let x = 0; x < $id("cubemap_3").childNodes.length; x++) {
            let k = $id("cubemap_3").childNodes[x].id;
            try {
                $id(k).setAttribute("opacity", "0");
                $id(k).setAttribute("is_load", "0");
                $id(k).setAttribute("src", "#pixel");
            } catch(e) {}
        }
        jQuery("#vr-sound").trigger('play');
        try {
            $id("scene_show_editor").style.display = "none";
            $id("scene_editor").style.display = "none";
            $id("add_area").style.display = "none";
            $id("temp_data").style.display = "none";
            $id("scene_map").style.display = "none";
        } catch(e) {}
        const virtual_scene = $id('virtual_scene');
        for (let i = virtual_scene.childNodes.length - 1; i >= 0; i--) {
            const node = virtual_scene.childNodes[i];
            node.parentElement.removeChild(node);
        };
        jQuery.ajax({
            type: "POST",
            data: {	"scene" : id },
            url: document.framework.rootDir + "/bin.php",
            success: (data) => {
                document.framework.log(`document.panorama.loadScene(${id}, ${object_id}).success()`);
                const json = JSON.parse(data);
                const new_scene = json.children[0].children[0];
                $id("nodes_scene").setAttribute("scene-id", new_scene["scene-id"]);
                for (let i = 0; i < new_scene.children.length; i++) {
                    let el = new_scene.children[i];
                    if (el.id == "cubemap_0") {
                        for (let o = 0; o < new_scene.children[i].children.length; o++) {
                             setTimeout((child) => {
                                 $id(child.id).setAttribute("src", child.src);
                             }, 1, el.children[o]);
                        }
                   } else if (el.id == "cubemap_1" || el.id == "cubemap_2" || el.id == "cubemap_3") {
                        for (let o = 0; o < new_scene.children[i].children.length; o++) {
                             setTimeout((child) => {
                                 $id(child.id).setAttribute("xsrc", child.xsrc);
                                 $id(child.id).setAttribute("src", child.src);
                             }, 1, el.children[o]);
                        }
                    } else if (el.id == "virtual_scene") {
                        let virtual_scene = $id('virtual_scene');
                        for (let j = 0; j < el.children.length; j++){
                            let obj = el.children[j];
                            let new_obj = document.createElement(obj.tag);
                            new_obj.id = obj.id;
                            $.each(obj, (index, value) => {
                                new_obj.setAttribute(index, value);
                            });
                            new_obj.className += " vr_hidden";
                            new_obj.setAttribute("opacity", "0");
                            virtual_scene.appendChild(new_obj);
                            if (document.panorama.sceneState == 1) {
                                if (new_obj.className.indexOf("hotpoint") !== false) {
                                    new_obj.addEventListener("click", () => { document.panorama.clickVR(new_obj); })
                                }
                            }
                        }
                    } else if (el.id == "floor"){
                        $id("floor").setAttribute("position", el.position);
                        $id("floor").setAttribute("radius", el.radius);
                    }
                }
                document.panorama.navigationState = 1;
                document.panorama.vrLoadState = 1;
                document.panorama.rig.setAttribute("position", "0 " + document.panorama.rig.object3D.position.y + " 0"); 
                jQuery(".vr_hidden").attr("opacity", "1");
                jQuery(".hidden_layer").attr("opacity", "0");
            },
            error: (response, exception) => {
                document.framework.ajaxError(`document.panorama.loadScene(${id}, ${object_id})`, response, exception);
                document.framework.submitTraceStack();
            }
        });
    } catch(e) {
        document.framework.throw(`document.panorama.loadScene(${id}, ${object_id})`, e); 
    }
}
//------------------------------------------------------------------------------
delete AFRAME.components['nodes-camera'];
AFRAME.registerComponent("nodes-camera", {
    tick: function(t) {
        try {
            if (!document.panorama.vrLoadState) {
                return;
            }
            document.panorama.logo.object3D.rotation.y = document.panorama.camera.object3D.rotation.y + document.panorama.rig.object3D.rotation.y;
            let rotation = (document.panorama.camera.getAttribute("rotation").x
                + document.panorama.rig.getAttribute("rotation").x) + ";"
                + (document.panorama.camera.getAttribute("rotation").y + document.panorama.rig.getAttribute("rotation").y);
            if (rotation != document.panorama.cameraDegree){
                document.panorama.cameraDegree = rotation;
                window.history.replaceState( {} , 'Panorama Viewer', document.framework.rootDir + '/panorama.php?id=' + document.panorama.scene.getAttribute("scene-id") + "#" + rotation);
            }
            if (document.panorama.sceneState > 0) {
                let raycaster = AFRAME.scenes[0].querySelector('[raycaster]').components.raycaster;
                let func_flag = 0;
                let hidden_flag = 0;
                let move_flag = 0;
                for (let i = 0; i < document.panorama.ray.components.raycaster.intersectedEls.length; i++) {
                    let t = document.panorama.ray.components.raycaster.intersectedEls[i];
                    if (t.className == "mesh load_later"){
                        let pos1 = t.object3D.getWorldPosition(new THREE.Vector3);
                        if (t.getAttribute("zoom") == document.panorama.zoom){
                            t.className = "mesh";
                            t.setAttribute("src", t.getAttribute("xsrc"));
                            t.setAttribute("is_load", "true");
                            let meshed = document.getElementsByClassName("mesh load_later");
                            for (let y = 0; y < meshed.length; y++){
                                let tt = meshed[y];
                                if (tt.getAttribute("zoom") == document.panorama.zoom){
                                    let pos2 = tt.object3D.getWorldPosition(new THREE.Vector3());
                                    let dist = Math.sqrt( (pos1.x-pos2.x)*(pos1.x-pos2.x) + (pos1.y-pos2.y)*(pos1.y-pos2.y) + (pos1.z-pos2.z)*(pos1.z-pos2.z) );
                                    if ((document.panorama.zoom < 3) || (dist < 500 && document.panorama.zoom == 3) || dist < 300 ){
                                        setTimeout((tt) => { tt.className = "mesh"; }, 1000, tt);
                                        tt.setAttribute("src", tt.getAttribute("xsrc"));
                                        tt.setAttribute("is_load", "true");
                                    }
                                }
                            }
                        }
                    }
                }
                for (let i = 0; i < raycaster.intersectedEls.length; i++){
                    //display popup window
                    if (raycaster.intersectedEls[i].getAttribute("popup") == "true"){
                        document.panorama.popupState = 1;
                        hidden_flag = 1;
                        break;
                    }
                    //disable fusing on logo
                    if (raycaster.intersectedEls[i].id == "vr_logo"){
                        break;
                    }
                    //display navigation at floor
                    if (raycaster.intersectedEls[i].id == "floor"){
                        if (!document.panorama.mouseListnerFlag){
                            let point = raycaster.intersections[i].point;
                            document.panorama.movePoint.object3D.position.set(point.x, point.y+0.1, point.z);
                            document.panorama.movePoint.setAttribute("material", "opacity", "0.5");
                            document.panorama.mouseImg.setAttribute("material", "opacity", "0");
                            move_flag = 1;
                        }
                    }
                    //checking to fusing
                    let func = raycaster.intersectedEls[i].getAttribute("action");
                    if (func) {
                        func_flag = 1;
                        document.panorama.startFuse(raycaster.intersectedEls[i]);
                    } else if (raycaster.intersectedEls[i].id == "sky_back"){
                        document.panorama.coordinatesVR = raycaster.intersections[i].point;
                        if (document.panorama.coordinatesFrom != null) {
                            let c = $id("marker").object3D.getWorldPosition(new THREE.Vector3());
                            $id("line").setAttribute("line", "end", c.x+' '+c.y+' '+c.z);
                            $id("line").setAttribute("line", "opacity", "1");
                        }
                    }
                }
                if (!move_flag && !document.panorama.mouseListnerFlag){
                   document.panorama.movePoint.setAttribute("material", "opacity", "0.01");
                }
                if (!func_flag){
                    document.panorama.currentObject = null;
                    document.panorama.endFuse();
                }
                if (!hidden_flag && document.panorama.popupState){
                    jQuery(".hidden_layer").attr("opacity", "0");
                    document.panorama.popupState = 0;
                }
            }
            let position = $id("vr_point").object3D.getWorldPosition(new THREE.Vector3());
            //Moving objects to cursor
            if (document.panorama.objectId != 0) {
                $id("point_"+document.panorama.objectId+"_position").value = position.x+" "+position.y+" "+position.z;
                $id("point_"+document.panorama.objectId).object3D.position.set( position.x, position.y, position.z );
                $id("object_"+document.panorama.objectId+"_position").value = position.x+" "+position.y+" "+position.z;
                $id("object_"+document.panorama.objectId).object3D.position.set( position.x, position.y, position.z );
                $id("url_"+document.panorama.objectId+"_position").value = position.x+" "+position.y+" "+position.z;
                $id("url_"+document.panorama.objectId).object3D.position.set( position.x, position.y, position.z );

            }
        } catch(e) {
            document.framework.throw(`nodes_camera.tick(${t})`, e); 
        }
    }
});
//------------------------------------------------------------------------------
delete AFRAME.components['look-at'];
AFRAME.registerComponent('look-at', {
    schema: {
      default: '',
      parse: function (value) {
        if (AFRAME.utils.coordinates.isCoordinates(value) || typeof value === 'object') {
          return AFRAME.utils.coordinates.parse(value);
        }
        return value;
      },
      stringify: function (data) {
        if (typeof data === 'object') {
          return AFRAME.utils.coordinates.stringify(data);
        }
        return data;
      }
    },
    init: function () {
      this.target3D = null;
      this.vector = new THREE.Vector3();
    },
    update: function () {
        try {
            let self = this;
            let target = self.data;
            let object3D = self.el.object3D;
            let targetEl;
            if (!target || (typeof target === 'object' && !Object.keys(target).length)) {
              return self.remove();
            }
            if (typeof target === 'object') {
              return object3D.lookAt(new THREE.Vector3(target.x, target.y, target.z));
            }
            targetEl = self.el.sceneEl.querySelector(target);
            if (!targetEl) {
              return;
            }
            if (!targetEl.hasLoaded) {
              return targetEl.addEventListener('loaded', function () {
                self.beginTracking(targetEl);
              });
            }
            return self.beginTracking(targetEl);
        } catch(e) {
            document.framework.throw(`nodes_camera.update()`, e); 
        }
    },
    tick: function (t) {
        try {
            let target;
            let target3D = this.target3D;
            let object3D = this.el.object3D;
            let vector = this.vector;
            if (target3D) {
                target = object3D.parent.worldToLocal(target3D.getWorldPosition(new THREE.Vector3()));
                target.y = object3D.position.y;
                if (this.el.getObject3D('camera')) {
                  vector.subVectors(object3D.position, target).add(object3D.position);
                } else {
                  vector = target;
                }
                object3D.lookAt(vector);
            }
        } catch(e) {
            document.framework.throw(`look-at.tick(${t})`, e); 
        }
    },
    beginTracking: function (targetEl) {
      this.target3D = targetEl.object3D;
    }
});
