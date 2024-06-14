/**
 * TypeScript Application - Secondary view factory function.
 *
 * 1.0.1 # Aleksandr Vorkunov <developing@nodes-tech.ru>
 */

import DOMElement from "../components/element";
import App from "../app";
import {IAppState} from "../interfaces";
// @ts-ignore
const DEBUG: boolean = process.env && process.env.DEBUG && process.env.DEBUG == "true";

const Step1View = (app:App, parent:DOMElement) => {
    try {
        if (DEBUG) {
            app.handler.log("App.Step1View()");
        }
        const fout = new DOMElement(
            app,
            `div`,
            parent,
            "Step1View",
            null,
            {}
        );
        parent.addChild(fout);
        const signup = {
            "en": "Sign Up",
            "ru": "Регистрация",
            "zh": "報名"
        };
        const login = {
            "en": "Login",
            "ru": "Логин",
            "zh": "登錄"
        };  
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
            'step1',
            (state:IAppState) => ({
                innerHTML: `<li>
                        <a target="_parent" id="b1" hreflang="${app.lang}" href="${app.dir}/signup" class="btn btn-round">
                            <noindex class="material-icons">person_add</noindex> ${signup[app.lang]} 
                        </a>
                    </li>
                    <li>
                        <a target="_parent" id="b2" hreflang="${app.lang}" href="${app.dir}/login" class="btn btn-round">
                            <noindex class="material-icons">account_circle</noindex> ${login[app.lang]} 
                        </a>
                    </li>
                    ${html}`
            })
        ));
        return fout;
    } catch (e) {
        app.handler.error(`App.Step1View() -> ${ e.message }`);
    }
};

export default Step1View;
