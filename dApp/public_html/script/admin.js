/**
 * Admin JavaScript library.
 * @path /script/admin.js
 *
 * @name    DAO Mansion    @version 1.0.3
 * @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */

document.admin = {
    camera: null
}

/**
 * Submits page meta information from admin.
 */
document.admin.editSeo = (id) => {
    document.framework.log(`document.admin.editSeo(${id})`);
    jQuery('#button_'+id).css("opacity", "0.5");
    const title = jQuery("#page-title-" + id).val();
    const description = jQuery("#page-desc-" + id).val();
    const keywords = jQuery("#page-keywords-" + id).val();
    const mode = jQuery("#mode_" + id).val();
    jQuery.ajax({
        type:"POST",
        data: {
            "seo_id": id,
            "title": title ,
            "description": description,
            "keywords": keywords,
            "mode": mode
        },
        url: document.framework.rootDir + "/bin.php",
        success: () => {
            document.framework.log(`document.admin.editSeo(${id}).success()`);
            jQuery('#button_' + id).css("opacity","1");
            jQuery('#button_' + id).css("display","none");
        }
    });
}

/**
 * Confirms a product order shipment.
 *
 * @param {int} id @mysql[nodes_order]->id.
 * @param {string} text Text of message.
 * @param {string} shipment Text of button 1.
 * @param {string} soldout Text of button 2.
 */
document.admin.confirmOrder = (id, text, shipment, soldout) => {
    document.framework.log(`document.admin.confirmOrder(${id})`);
    alertify.prompt('<h3>' + text + '</h3><br/>', (e, str) => {
        if (e) {
            alertify.confirm('<h3>' + shipment + '</h3><br/>' + soldout + '<br/><br/>',
                (e, str1) => {
                    if (e) {
                        jQuery.ajax({
                            type: "POST",
                            data: { "order_id" : id, "status" : "0", "track" : str },
                            url: document.framework.rootDir + "/bin.php",
                            success: () => {
                                document.framework.log(`document.admin.confirmOrder(${id}).success()`);
                                window.location = document.framework.rootDir + "/admin/?mode=orders";
                            }
                        });
                    } else {
                        jQuery.ajax({
                            type: "POST",
                            data: { "order_id" : id, "status" : "1", "track" : str },
                            url: document.framework.rootDir + "/bin.php",
                            success: () => {
                                document.framework.log(`document.admin.confirmOrder(${id}).success()`);
                                window.location = document.framework.rootDir + "/admin/?mode=orders";
                            }
                        });
                    }
                },
                ""
            );
        }
    }, "");
}

/**
 * Removes an image from a product.
 *
 * @param {int} id @mysql[nodes_product]->id.
 * @param {int} pos Number of picture in product image list.
 */
document.admin.deleteImage = (id, pos) => {
    document.framework.log(`document.admin.deleteImage(${id}, ${pos})`);
    jQuery.ajax({
        type: "POST",
        data: {	"product_id" : id, "pos" : pos },
        url: document.framework.rootDir + "/bin.php",
        success: () => {
            document.framework.log(`document.admin.deleteImage(${id}, ${pos}).success()`);
            document.getElementById("edit_product_form").submit();
        }
    });
}

/**
 * Creates a new transaction.
 *
 * @param {int} id Target @mysql[nodes_user]->id.
 * @param {int} pos Text of message.
 */
document.admin.newTransaction = (id, text) => {
    document.framework.log(`document.admin.newTransaction(${id})`);
    alertify.prompt('<h3>' + text + '</h3><br/>', (e, str) => {
        if (e) {
            jQuery.ajax({
                type: "POST",
                data: {"user_id": id, "transaction" : str },
                url: document.framework.rootDir + "/bin.php",
                success: (data) => {
                    document.framework.log(`document.admin.newTransaction(${id}).success()`);
                    alert(data);
                    window.location.reload();
                }
            });
        }
    }, "");
}

/**
 * Archivates an order.
 *
 * @param {int} id @mysql[nodes_product]->id.
 * @param {string} text Text of message.
 */
document.admin.archiveOrder = (id, text) => {
    document.framework.log(`document.admin.archiveOrder(${id})`);
    alertify.confirm('<h3>' + text + '?<br/><br/>',
        (e, str1) => {
            if (e) {
                jQuery.ajax({
                    type: "POST",
                    data: { "archive_id" : id },
                    url: document.framework.rootDir + "/bin.php",
                    success: () => {
                        document.framework.log(`document.admin.archiveOrder(${id}).success()`);
                        window.location = document.framework.rootDir + "/admin/?mode=orders";
                    }
                });
            }
        },
    "");
}

document.admin.handleDragStart = (e) => {
    document.framework.log(`document.admin.handleDragStart()`);
    e.dataTransfer.effectAllowed = 'move';
    let dragIcon = new Image();
    try {
        dragIcon.src = e.srcElement.src;
        document.admin.camera = e.srcElement.id;
    } catch(x) {
        dragIcon.src = e.target.src;
        document.admin.camera = e.target.id;
    }
    $id(document.admin.camera).style.opacity = "0.1";
    dragIcon.width = 20;
    dragIcon.height = 20;
    try {
        e.dataTransfer.setDragImage(dragIcon, 10, 10);
    } catch(x){}
}

document.admin.handleDragDrop = (e) => {
    document.framework.log(`document.admin.handleDragDrop()`);
    let camera = $id(document.admin.camera);
    camera.style.opacity = "1";
    camera.style.top = parseInt(camera.style.top)+parseInt(e.layerY)+"px";
    camera.style.left = parseInt(camera.style.left)+parseInt(e.layerX)+"px";
    let elems = document.getElementsByClassName("dragable");
    let fout = '';
    for (let i = 0; i < elems.length; i++) {
        let elem = elems[i];
        if (fout != '') {
            fout += ',';
        }
        fout += '{"id":"'
            + elem.getAttribute("g")
            + '", "t":"'
            + (parseInt(elem.style.top) - elem.getAttribute("t"))
            + '", "l":"'
            + (parseInt(elem.style.left) - elem.getAttribute("l"))
            + '"}';
    }
    fout = '{"points":[' + fout + "]}";
    $id("points_json").value = fout;
}

document.admin.levelApplyChages = () => {
    document.framework.log(`document.admin.levelApplyChages()`);
    let transform = "rotate(" + parseInt($id("level_plan_rotation").value) + "deg) scale(" + $id("level_plan_scale").value + ")";
    $id("level_plan_img").style.transform = transform;
}

document.admin.showLevelPlan = () => {
    document.framework.log(`document.admin.showLevelPlan()`);
    let data = document.getElementsByClassName("dragable");
    for (let i = 0; i < data.length; i++) {
        document.framework.addHandler(data[i], 'dragstart', document.admin.handleDragStart, false);
        document.framework.addHandler(data[i], 'dragend', document.admin.handleDragDrop, false);
    }
}