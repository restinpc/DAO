/**
* A-frame based panorama viewer JavaScript library.
* @path /script/panorama.js
* 
* @name    DAO Mansion    @version 1.0.3
* @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*/

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
document.panorama.mouse = new THREE.Vector2(), INTERSECTED;
document.panorama.ray = null;
document.panorama.mouseImg = null;
document.panorama.cubemap = null; // todo delete
document.panorama.content = null; // todo delete
document.panorama.canvas = null;
document.panorama.scene = null;
document.panorama.camera = null;
document.panorama.rig = null;
document.panorama.logo = null;
document.panorama.movePoint = null;
document.panorama.marker = null;
document.panorama.mouseControlState = 0;
document.panorama.mouseListnerFlag = 0;
document.panorama.sceneState = 0;
document.panorama.levelId = 0;

document.panorama.pcMode = () => {
    document.panorama.sceneState = 1;
    document.panorama.mouseControlState = 1;
    document.panorama.canvas.addEventListener('mousemove', document.panorama.mouseListner);
    document.panorama.camera.setAttribute("look-controls", "reverseMouseDrag", "true");
    let arr = document.getElementsByClassName("custom_object");
    for (let i = 0; i < arr.length; i++){
        arr[i].setAttribute("opacity", "1");
    }
    arr = document.getElementsByClassName("hotpoint");
    for (let i = 0; i < arr.length; i++){
        arr[i].setAttribute("opacity", "1");
    }
    document.framework.hideWindow();
    document.panorama.marker.setAttribute("scale", "0.01 0.01 0.01");
    $id("fuse").setAttribute("scale", "0.01 0.01 0.01");
    $id("vr-block").style.display = "none";
    $id("nodes_vr_scene").style.opacity = "1";
    $id("vr_logo").setAttribute("opacity", "1");
    document.panorama.canvas.addEventListener('mouseleave', (e) => {
        document.panorama.mouseImg.setAttribute("material", "opacity", "0");
    });
    document.panorama.canvas.addEventListener('mouseenter', (e) => {
        document.panorama.mouseImg.setAttribute("material", "opacity", "1");
    });
    document.panorama.canvas.addEventListener('click', (e) => {
        if (document.panorama.mouseControlState) {
            for (let i = 0; i < document.panorama.ray.components.raycaster.intersectedEls.length; i++) {
                let func = document.panorama.ray.components.raycaster.intersectedEls[i].getAttribute("action");
                if (func){
                    document.panorama.clickVR(document.panorama.ray.components.raycaster.intersectedEls[i]);
                    return;
                }
            }
        }
    });
}

document.panorama.mobileMode = () => {
    document.panorama.sceneState = 2;
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
    document.framework.hideWindow();
}

document.panorama.loadVR = (levelId) => {
    document.panorama.levelId = levelId;
    if (!document.panorama.vrLoadState) {
        try {
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
        } catch(e) { console.log("Error t"); }
        try {
            document.panorama.rotateCamera();
        } catch(e) {
            console.log("Error a");
        }
        try {
            document.panorama.resizeScene();
            document.framework.addHandler(window, "resize", document.panorama.resizeScene);
        } catch(e) {console.log("Error b");}
        try {
            document.panorama.canvas.addEventListener('dblclick',
            (e) => {
                if (document.panorama.coordinatesFrom == null) {
                    document.panorama.coordinatesFrom = document.panorama.coordinatesVR;
                    alert("Use double click to calculate distanse to this point");
                    $id("line").setAttribute("line", "start", document.panorama.coordinatesFrom.x+' '+document.panorama.coordinatesFrom.y+' '+document.panorama.coordinatesFrom.z);
                    $id("line").setAttribute("line", "opacity", "1");
                } else {
                    let distance = Math.sqrt(
                            (document.panorama.coordinatesFrom.x-document.panorama.coordinatesVR.x)*(document.panorama.coordinatesFrom.x-document.panorama.coordinatesVR.x)+
                            (document.panorama.coordinatesFrom.y-document.panorama.coordinatesVR.y)*(document.panorama.coordinatesFrom.y-document.panorama.coordinatesVR.y)+
                            (document.panorama.coordinatesFrom.z-document.panorama.coordinatesVR.z)*(document.panorama.coordinatesFrom.z-document.panorama.coordinatesVR.z)
                        )/20;
                    alert(distance.toFixed(2) + " meters between this points");
                    document.panorama.coordinatesFrom = null;
                    $id("line").setAttribute("line", "opacity", "0");
                }
            });
        } catch(e) {console.log("Error c");}
        try {
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
        } catch(e) { console.log("Error d"); }
        try {
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
        } catch(e) {}
        document.panorama.mobileMode();
    }
    document.panorama.vrLoadState = 1;
}

document.panorama.clickVR = (object) => {
    try {
        let func = object.getAttribute("action");
        try {
            eval(func);
        } catch(e) {}
        document.panorama.endFuse();
    } catch(e) {}
}

document.panorama.showSceneEditor = () => {
    $id("add_area").style.display = "block";
    $id("scene_editor").style.display="block";
    $id("scene_show_editor").style.display="none";
    $id("floor").setAttribute("opacity", "0.1");
    // $id("scene_map").style.display = "none";
}

document.panorama.deleteNavigation = (id) => {
    if (confirm("Are you sure?")) {
        $id("action_"+id).value = "delete_point";
        $id("object_"+id+"_form").submit();
    }
}

document.panorama.deleteURL = (id) => {
    if (confirm("Are you sure?")) {
        $id("action_"+id).value = "delete_url";
        $id("url_"+id+"_form").submit();
    }
}

document.panorama.applyChangesURL = (id) => {
    $id("url_"+id).setAttribute("position", $id("url_"+id+"_position").value);
    $id("url_"+id).setAttribute("scale", $id("url_"+id+"_scale").value);
}

document.panorama.applyChangesNavigation = (id) => {
    $id("point_"+id).setAttribute("position", $id("point_"+id+"_position").value);
    $id("point_"+id).setAttribute("scale", $id("point_"+id+"_scale").value);
}

document.panorama.deleteObject = (id) => {
    if (confirm("Are you sure?")) {
        $id("action_"+id).value = "delete_object";
        $id("object_"+id+"_form").submit();
    }
}

document.panorama.applyChangesObject = (id) => {
    $id("object_"+id).setAttribute("color", $id("object_"+id+"_color").value);
    $id("object_"+id).setAttribute("position", $id("object_"+id+"_position").value);
    $id("object_"+id).setAttribute("rotation", $id("object_"+id+"_rotation").value);
    $id("object_"+id).setAttribute("scale", $id("object_"+id+"_scale").value);
}

document.panorama.resizeScene = () => {
    try {
        $id("nodes_vr_scene").style.height = (document.framework.getViewportHeight() - parseInt($id("sectionsNav").clientHeight)) + "px";
    } catch(e) {}
}

document.panorama.applySceneChanges = () => {
    try {
        document.panorama.rig.setAttribute("position", $id("camera_position").value);
        document.panorama.rig.setAttribute("rotation", $id("camera_rotation").value);
        $id("floor").setAttribute("position", $id("floor_position").value);
        $id("floor").setAttribute("radius", $id("floor_radius").value);
        $id("vr_logo").setAttribute("width", $id("logo_size").value);
        $id("vr_logo").setAttribute("height", $id("logo_size").value);
    } catch(e) {
        console.log("error f");
    }
}

document.panorama.defaultSettings = () => {
    if (confirm("Are you sure you want to restore default scene configuration?")) {
        $id("act").name = "default";
        $id("scene_form").submit();
    }
}

document.panorama.navigate = () => {
    const position = document.panorama.movePoint.object3D.getWorldPosition();
    const points = document.getElementsByClassName("hotpoint");
    let point_id = null;
    let lowest = 0;
    for (let i = 0; i < points.length; i++){
        const point = points[i].object3D.getWorldPosition();
        const distance = Math.sqrt(
            (position.x-point.x) * (position.x-point.x) +
            (position.y-point.y) * (position.y-point.y) +
            (position.z-point.z) * (position.z-point.z)
        );
        if (lowest == 0 || distance < lowest) {
            lowest = distance;
            point_id = points[i].id;
        }
    }
    if (point_id != null && point_id != "point_new_nav") {
        document.panorama.clickVR($id(point_id));
    }
}

document.panorama.zoomScene = (e) => {
    try {
        e = e || window.event;
        const delta = e.deltaY || e.detail || e.wheelDelta;
        if (delta > 1 && document.panorama.zoom > 1) {
            document.panorama.zoom -= 1;
        } else if (delta < 1 && document.panorama.zoom <= 3.5) {
            document.panorama.zoom += 1;
        }
    } catch(e) {}
    document.panorama.camera.setAttribute("zoom", document.panorama.zoom);
    if (document.panorama.zoom == 1) {
        $id("cubemap_0").setAttribute("scale", '1 1 1');
        $id("cubemap_1").setAttribute("scale", '1.01 1.01 1.01');
        $id("cubemap_2").setAttribute("scale", '1.01 1.01 1.01');
        $id("cubemap_3").setAttribute("scale", '1.01 1.01 1.01');
        for (let x = 0; x < $id("cubemap_1").childNodes.length; x++) {
            let k = $id("cubemap_1").childNodes[x].id;
            try {
                $id(k).setAttribute("opacity", "0");
            } catch(e) {}
        }
        for (let x = 0; x < $id("cubemap_2").childNodes.length; x++) {
            let k = $id("cubemap_2").childNodes[x].id;
            try {
                $id(k).setAttribute("opacity", "0");
            } catch(e) {}
        }
        for (let x = 0; x < $id("cubemap_3").childNodes.length; x++) {
            let k = $id("cubemap_3").childNodes[x].id;
            try {
                $id(k).setAttribute("opacity", "0");
            } catch(e) {}
        }
    } else if (document.panorama.zoom == 2) {
        $id("cubemap_0").setAttribute("scale", '1.01 1.01 1.01');
        $id("cubemap_1").setAttribute("scale", '1 1 1');
        $id("cubemap_2").setAttribute("scale", '1.01 1.01 1.01');
        $id("cubemap_3").setAttribute("scale", '1.01 1.01 1.01');
        for (let x = 0; x < $id("cubemap_1").childNodes.length; x++){
            let k = $id("cubemap_1").childNodes[x].id;
            try {
                $id(k).setAttribute("opacity", "1");
            } catch(e) {}
        }
        for (let x = 0; x < $id("cubemap_2").childNodes.length; x++){
            let k = $id("cubemap_2").childNodes[x].id;
            try {
                $id(k).setAttribute("opacity", "0");
            } catch(e) {}
        }
        for (let x = 0; x < $id("cubemap_3").childNodes.length; x++){
            let k = $id("cubemap_3").childNodes[x].id;
            try {
                $id(k).setAttribute("opacity", "0");
            } catch(e) {}
        }
    } else if (document.panorama.zoom == 3) {
        $id("cubemap_0").setAttribute("scale", '1.01 1.01 1.01');
        $id("cubemap_1").setAttribute("scale", '1.01 1.01 1.01');
        $id("cubemap_2").setAttribute("scale", '1 1 1');
        $id("cubemap_3").setAttribute("scale", '1.01 1.01 1.01');
        for (let x = 0; x < $id("cubemap_2").childNodes.length; x++) {
            let k = $id("cubemap_2").childNodes[x].id;
            try {
                $id(k).setAttribute("opacity", "1");
            } catch(e) {}
        }
        for (let x = 0; x < $id("cubemap_3").childNodes.length; x++) {
            let k = $id("cubemap_3").childNodes[x].id;
            try {
                $id(k).setAttribute("opacity", "0");
            } catch(e) {}
        }
    } else {
        $id("cubemap_0").setAttribute("scale", '1.01 1.01 1.01');
        $id("cubemap_1").setAttribute("scale", '1.01 1.01 1.01');
        $id("cubemap_2").setAttribute("scale", '1.01 1.01 1.01');
        $id("cubemap_3").setAttribute("scale", '1 1 1');
        for (let x = 0; x < $id("cubemap_3").childNodes.length; x++) {
            let k = $id("cubemap_3").childNodes[x].id;
            try {
                $id(k).setAttribute("opacity", "1");
            } catch(e) {}
        }
    }
    try {
        e.preventDefault ? e.preventDefault() : (e.returnValue = false);
    } catch(e) {}
}

document.panorama.startFuse = (object) => {
    if (object != document.panorama.currentObject && document.panorama.vrLoadState) {
        document.panorama.currentObject = object;
        document.panorama.currentFunction = setTimeout((object) => {
            document.panorama.clickVR(object);
        }, 2500, object);
        $id("fuse").emit('cursor-fusing');
    }
}

document.panorama.endFuse = () => {
    if (document.panorama.currentFunction) {
        $id("fuse").emit('cursor-stop-fusing');
        $id("fuse").emit('cursor-unfusing');
        clearTimeout(document.panorama.currentFunction);
        document.panorama.currentFunction = null;
    }
}

document.panorama.addObject = () => {
    $id("add_area").style.display = "none";
    jQuery(".vr_object_window").css("display", "none");
    $id("object_new_obj").setAttribute("opacity", "1");
    $id("object_new_obj_window").style.display = "block";
    document.panorama.objectId = "new_obj";
}

document.panorama.addNavigation = () => {
    $id("add_area").style.display = "none";
    $id("point_new_nav_window").style.display = "block";
    document.panorama.objectId = "new_nav";
}

document.panorama.rotateCamera = () => {
    if (window.location.hash) {
        let hash = window.location.hash.replace("#", "");
        hash = hash.split(";");
        if (parseFloat(hash[0]) != 0 && parseFloat(hash[1]) != 0) {
            const rotation = "0 " + parseFloat(hash[1]) + " 0";
            try {
                document.panorama.rig.setAttribute("rotation", rotation);
            } catch(e) { console.log("error j"); }
        }
    }
}

document.panorama.addURL = () => {
    $id("add_area").style.display = "none";
    $id("url_new_google").setAttribute("opacity", "1");
    $id("url_new_google_window").style.display = "block";
    document.panorama.objectId = "new_google";
}

document.panorama.mouseListner = (event) => {
    document.panorama.mouseListnerFlag = 1;
    const rect = document.panorama.canvas.getBoundingClientRect();
    document.panorama.mouse.x = ((event.clientX - rect.left) / rect.width ) * 2 - 1;
    document.panorama.mouse.y = - ((event.clientY - rect.top) / rect.height ) * 2 + 1;
    document.panorama.ray.setAttribute("rotation", (document.panorama.mouse.y*60)+" "+(document.panorama.mouse.x*-90)+" 0");
    let h = 0;
    for (let i = 0; i < document.panorama.ray.components.raycaster.intersectedEls.length; i++) {
        if (document.panorama.ray.components.raycaster.intersectedEls[i].id != "cursor_img" &&
            document.panorama.ray.components.raycaster.intersectedEls[i].id != "vr_logo" &&
            document.panorama.ray.components.raycaster.intersectedEls[i].getAttribute("trigger") != "none") {
            h = i;
            break;
        }
    }
    let x = 0;
    for (let i = 0; i < document.panorama.ray.components.raycaster.intersectedEls.length; i++) {
        if (document.panorama.ray.components.raycaster.intersectedEls[i].id == "vr_logo") {
            break;
        }
        if (document.panorama.ray.components.raycaster.intersectedEls[i].id == "floor") {
            let point = document.panorama.ray.components.raycaster.intersections[i].point;
            document.panorama.movePoint.object3D.position.set(point.x, point.y+0.1, point.z);
            document.panorama.movePoint.setAttribute("material", "opacity", "0.5");
            document.panorama.mouseImg.setAttribute("material", "opacity", "0");
            x = 1;
            break;
        }
    }
    if (!x && document.panorama.vrLoadState) {
        document.panorama.mouseImg.setAttribute("material", "opacity", "1");
        document.panorama.movePoint.setAttribute("material", "opacity", "0");
    }
    try {
        if (document.panorama.ray.components.raycaster.intersections[h].object.el.id != "cursor_img" &&
            document.panorama.ray.components.raycaster.intersections[h].object.el.id != "move_point") {
            let pos = document.panorama.ray.components.raycaster.intersections[h].point;
            if (document.panorama.ray.components.raycaster.intersections[h].distance > 100){
                let k = 0.9 * 100/(document.panorama.ray.components.raycaster.intersections[h].distance);
            }else{
                let k = 0.9;
            }
            pos.x = parseFloat(pos.x)*k;
            pos.y = parseFloat(pos.y)*k;
            pos.z = parseFloat(pos.z)*k;
            document.panorama.mouseImg.setAttribute("position", pos);
        }
    } catch(e) {
        try {
            pos = document.panorama.ray.components.raycaster.intersections[h].point;
            if (document.panorama.ray.components.raycaster.intersections[h].distance > 100) {
                let k = 0.9 * 100/(document.panorama.ray.components.raycaster.intersections[h].distance);
            } else {
                let k = 0.9;
            }
            pos.x = parseFloat(pos.x)*k;
            pos.y = parseFloat(pos.y)*k;
            pos.z = parseFloat(pos.z)*k;
            document.panorama.mouseImg.setAttribute("position", pos);
        } catch(e) {}
    }
}

document.panorama.resetSceneObjects = (id) => {
    if (confirm("Are you sure you want to remove all custom objects from this scene?")) {
        jQuery.ajax({
            type: "POST",
            data: { "scene_reset" : id },
            url: document.framework.root_dir + "/bin.php",
            success: () => {
                window.location.reload();
            }
        });
    }
}

document.panorama.loadScene = (id, object_id) => {
    if (!document.panorama.navigationState) {
        return;
    }
    document.panorama.coordinatesFrom = null;
    vr_key = 1;
    document.panorama.vrLoadState = 0;
    document.panorama.navigationState = 0;
    try {
        window.history.replaceState( {} , 'Panorama Viewer', '/panorama.php?id='+id );
    } catch(e) {}
    const nav_time = parseInt(new Date().getTime());
    if (document.panorama.movePoint.getAttribute("opacity") != '0') {
        let trigger = document.panorama.movePoint.object3D.getWorldPosition(new THREE.Vector3());
    } else {
        let trigger = document.getElementById(object_id).object3D.getWorldPosition(new THREE.Vector3());
    }
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
    /*
    let camera = document.getElementById("camera").object3D.getWorldPosition(new THREE.Vector3());
    let rig = document.getElementById("rig").object3D.position;
    try {
        $id("move_animation").id = '';
    } catch(e) {}
    let animation = document.createElement('a-animation');
    let animationData = {
        id: 'move_animation',
        class: 'rig_animation',
        attribute: 'position',
        begin: 'move_rig',
        direction: 'normal',
        dur: 900,
        repeat: 0,
        to: ((trigger.x+camera.x)/2)+" "+(rig.y)+" "+((trigger.z+camera.z)/2)
    };
    Object.keys(animationData).forEach(function (attr) {
        animation.setAttribute(attr, animationData[attr]);
    });
    // jQuery(".vr_hidden").attr("opacity", "0");
    // document.getElementById("rig").appendChild(animation);
    // document.getElementById("rig").emit('move_rig');
    setTimeout(function(){
        jQuery("#vr-sound").trigger('play');
        // window.location = '/panorama.php?id=' + id;
     }, 1000);
     */
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
        url: document.framework.root_dir + "/bin.php",
        success: (data) => {
            const json = JSON.parse(data);
            const new_scene = json.children[0].children[0];
            $id("nodes_scene").setAttribute("scene-id", new_scene["scene-id"]);
            for (let i = 0; i < new_scene.children.length; i++) {
                let el = new_scene.children[i];
                if (el.id == "cubemap_0") {
                    for (let o = 0; o < new_scene.children[i].children.length; o++) {
                         setTimeout((child) => {
                             $id(child.id).setAttribute("src", child.src);
                         }, 1000-(parseInt(new Date().getTime()) - nav_time), el.children[o]);
                    }
               } else if (el.id == "cubemap_1" || el.id == "cubemap_2" || el.id == "cubemap_3") {
                    for (let o = 0; o < new_scene.children[i].children.length; o++) {
                         setTimeout((child) => {
                             $id(child.id).setAttribute("xsrc", child.xsrc);
                             $id(child.id).setAttribute("src", child.src);
                         }, 1000 - (parseInt(new Date().getTime()) - nav_time), el.children[o]);
                    }
                } else if (el.id == "virtual_scene") {
                    let virtual_scene = $id('virtual_scene');
                    for (let j = 0; j < el.children.length; j++){
                        let obj = el.children[j];
                        let new_obj = document.createElement(obj.tag);
                        new_obj.id = obj.id;
                        $.each(obj, function(index, value) {
                              new_obj.setAttribute(index, value);
                        });
                        new_obj.className += " vr_hidden";
                        new_obj.setAttribute("opacity", "0");
                        virtual_scene.appendChild(new_obj);
                    }
                } else if (el.id == "floor"){
                    $id("floor").setAttribute("position", el.position);
                    $id("floor").setAttribute("radius", el.radius);
                }
            }
            setTimeout(() => {
                $id("rig").setAttribute("position", "0 " + $id("rig").object3D.position.y + " 0");
                setTimeout(() => {
                    document.panorama.navigationState = 1;
                    document.panorama.vrLoadState = 1;
                }, 5000);
                jQuery(".vr_hidden").attr("opacity", "1");
                jQuery(".hidden_layer").attr("opacity", "0");
            }, 1000 - (parseInt(new Date().getTime()) - nav_time));
        }
    });
}
//------------------------------------------------------------------------------
delete AFRAME.components['nodes-camera'];
AFRAME.registerComponent("nodes-camera", {
    tick: function () {
        if (!document.panorama.vrLoadState) return;
        try {
            document.panorama.logo.object3D.rotation.y = document.panorama.camera.object3D.rotation.y+document.panorama.rig.object3D.rotation.y;
            let rotation = (document.panorama.camera.getAttribute("rotation").x
                    + document.panorama.rig.getAttribute("rotation").x) + ";"
                    + (document.panorama.camera.getAttribute("rotation").y + document.panorama.rig.getAttribute("rotation").y);
            if (rotation != document.panorama.cameraDegree){
                document.panorama.cameraDegree = rotation;
                window.history.replaceState( {} , 'Panorama Viewer', '/panorama.php?id='+document.panorama.scene.getAttribute("scene-id")+"#"+rotation);
            }
        } catch(e) { console.log("error 1"); }
        //raycaster objects
        try {
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
                                    let dist =  Math.sqrt( (pos1.x-pos2.x)*(pos1.x-pos2.x) + (pos1.y-pos2.y)*(pos1.y-pos2.y) + (pos1.z-pos2.z)*(pos1.z-pos2.z) );
                                    if ( (document.panorama.zoom < 3) || (dist < 500 && document.panorama.zoom == 3) || dist < 300 ){
                                        setTimeout(function(tt){ tt.className = "mesh"; }, 1000, tt);
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
                        }else{

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
        } catch(e) {console.log("error 2");}
        let rotation = document.panorama.camera.getAttribute("rotation");
        let position = $id("vr_point").object3D.getWorldPosition(new THREE.Vector3());
        //Moving objects to cursor
        if (document.panorama.objectId != 0) {
            try {
                console.log($id("point_"+document.panorama.objectId+"_position"));
                $id("point_"+document.panorama.objectId+"_position").value = position.x+" "+position.y+" "+position.z;
                $id("point_"+document.panorama.objectId).object3D.position.set( position.x, position.y, position.z );
            } catch(e) {
                console.error(e);
            };
            try {
                $id("object_"+document.panorama.objectId+"_position").value = position.x+" "+position.y+" "+position.z;
                $id("object_"+document.panorama.objectId).object3D.position.set( position.x, position.y, position.z );
            } catch(e) {};
            try {
                $id("url_"+document.panorama.objectId+"_position").value = position.x+" "+position.y+" "+position.z;
                $id("url_"+document.panorama.objectId).object3D.position.set( position.x, position.y, position.z );
            } catch(e) {};
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
    },
    tick: function (t) {
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
    },
    beginTracking: function (targetEl) {
      this.target3D = targetEl.object3D;
    }
});
