/**
* Aframe template JavaScript source file.
* @path /template/aframe/template.js
*
* @name    DAO Mansion    @version 1.0.1
* @license http://www.apache.org/licenses/LICENSE-2.0
*/
(function() {
    "use strict";
    if(window.jQuery){
        jQuery(function() {
            navScroll();
            console.error(`load_events(${load_events})`);
            if(load_events){
                jQuery(window).scroll(navScroll).resize(navScroll);
                jQuery('.navbar-toggle').click(show_menu);
                jQuery('#sectionsNav a').not('.dropdown_item').click(hide_dropdown_menu);
            }
        });
    }
}());
