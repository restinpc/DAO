/**
 * TypeScript Application - Secondary view factory function.
 *
 * 1.0.3 # Aleksandr Vorkunov <devbyzero@yandex.ru>
 */

import DOMElement from "../components/element";
import App from "../app";
import DOMSelect from "../components/select";
import {IAppState} from "../interfaces";
// @ts-ignore
const DEBUG: boolean = process.env && process.env.DEBUG && process.env.DEBUG == "true";

const Step2View = (app:App, parent:DOMElement):DOMElement => {
    try {
        if (DEBUG) {
            app.handler.log("App.Step2View()");
        }
        const fout = new DOMElement(
            app,
            `div`,
            parent,
            "Step2View",
            null,
            {}
        );
        parent.addChild(fout);
        const account = {
            "en": "Account",
            "ru": "Аккаунт",
            "zh": "帳戶"
        };
        const logout = {
            "en": "Logout",
            "ru": "Выход",
            "zh": "登出"
        }
        const close = {
            "en": "Close application",
            "ru": "Закрыть приложение",
            "zh": "關閉申請"
        }
        let html = ``;
        if (app.isApp) {
            html = `<li>
                    <a target="_top" id="b3" onClick=\'window.location = "/#close";\' class="btn btn-round">
                        <noindex class="material-icons">close</noindex> ${close[app.lang]}
                    </a>
                </li>`;
        }
        fout.addChild(new DOMElement(
            app,
            `div`,
            fout,
            'step2',
            (state:IAppState) => ({
                innerHTML: `
                    <li>
                        <a hreflang="${app.lang}" href="${app.dir}/account" onclick="hide_menu();" id="b1" class="btn btn-round">
                            <noindex class="material-icons">person</noindex> ${account[app.lang]}
                        </a>
                    </li>
                    <li>
                        <a target="_parent" id="b2" onclick="hide_menu(); document.framework.logout();" class="btn btn-round">
                            <noindex class="material-icons">directions_run</noindex> ${logout[app.lang]}
                        </a>
                    </li>
                    ${html}`,
            })
        ));
        return fout;
    } catch (e) {
        app.handler.error(`App.Step2View() -> ${ e.message }`);
    }
};

export default Step2View;