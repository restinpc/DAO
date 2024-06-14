/**
 * TypeScript Application - Application primary object class.
 *
 * 1.0.1 # Aleksandr Vorkunov <developing@nodes-tech.ru>
 */

import DataSource from "./dataSource";
import DOMElement from "./components/element";
import Template from "./views/template";
import MainView from "./views/main";
import ErrorHandler from "./errorHandler";
import {
    IApp,
    IAppState,
    IAppPublicState
} from "./interfaces"; 
// @ts-ignore
const DEBUG: boolean = process.env && process.env.DEBUG && process.env.DEBUG == "true";

/**
 * @param stdout HTML root element.
 * @param stdin Virtual DOM root component.
 * @param DOMObjects Virtual DOM objects iterable array.
 * @param state Application primary state container.
 * @param renderId
 * @param preloaded
 */
class App implements IApp {
    stdout: HTMLElement;
    stdin: DOMElement;
    dataSource: DataSource;
    DOMObjects: DOMElement[];
    handler: ErrorHandler;
    state: IAppState;
    renderId: number;
    preloaded: boolean;
    token: string;
    dir: string;
    lang: string;
    isApp: boolean;
    constructor() {
        try {
            this.handler = new ErrorHandler(this);
            if (DEBUG) {
                this.handler.log("App.constructor()");
            }
            this.renderId = 0;
            this.preloaded = false;
            this.DOMObjects = [];
            // @ts-ignore
            this.stdout = document.getElementById(process.env.NAME);
            this.stdout.innerHTML = Template;
            this.stdout = this.stdout.getElementsByClassName("root")[0] as HTMLElement;
            this.dataSource = new DataSource(this);
            // @ts-ignore
            this.dir = this.stdout.parentElement.getAttribute("dir");
            this.lang = this.stdout.parentElement.getAttribute("lang");
            this.isApp = this.stdout.parentElement.getAttribute("isApp") == "true";
            this.token = document.cookie .split("; ").find((row) => row.startsWith("token="))?.split("=")[1];
            this.state = {
                step: 0,
                loaded: false,
                frameId: 0,
            };
            MainView(this);
            this.render();
            if (document.readyState === 'complete') {
                this.preloaded = true;
                this.load();
            } else {
                setTimeout(this.load, 1);
                window.addEventListener("load", () => setTimeout(this.load, 1));
            }
        } catch (e) {
            this.handler.error(`App.constructor() -> ${ e.message }`);
        }
    }
    
    load = (): void => {
        if (this.preloaded) {
            setTimeout(() => {
                this.dataSource.init(this.token).then((res) => {
                    this.setState({
                        ...this.state,
                        step: res ? 2 : 1,
                        loaded: true,
                    })
                });
            }, 1);
        } else {
            this.preloaded = true;
        }
    }

    /**
     * Method to update application state container
     * @param state Container
     */
    setState = (state: IAppState): void => {
        if (DEBUG) {
            this.handler.debug("Before dispatch >> ");
            this.handler.debug(this.state);
            this.handler.debug("Will dispatch >>");
            this.handler.debug(state);
        }
        this.state = {
            ...this.state,
            ...state
        }
        if (DEBUG) {
            this.handler.debug("After dispatch >> ");
            this.handler.debug(this.state);
        }
        const tree = (arr:DOMElement[]):DOMElement[] => {
            let flag = false;
            arr.forEach((el:DOMElement) => {
                el.getNodes().forEach((node) => {
                    if (arr.indexOf(node) < 0) {
                        flag = true;
                        arr.push(node);
                    }
                });
            });
            if (flag) {
                return tree(arr);
            } else {
                return arr;
            }
        }
        this.DOMObjects.forEach((obj:DOMElement) => {
            let before = JSON.stringify(obj.props);
            let after = JSON.stringify(obj.updateProps());
            if (before !== after) {
                let nodes = tree(this.stdin.getNodes());
                if (nodes.indexOf(obj) >= 0 || obj === this.stdin) {
                    if ((obj.parent && obj.parent.getNodes().indexOf(obj) >=0) || (obj === this.stdin)){
                        obj.render(obj.parent ? obj.parent.element : this.stdout);
                    }
                }
            }
        });
    };

    /**
     * Method to rebuild while Virtual DOM
     */
    render = (): void => {
        try {
            if (DEBUG) {
                this.handler.log(`App.render(${ this.renderId })`);
            }
            this.renderId++;
            this.stdin.updateProps();
            this.stdin.render(this.stdout);
        } catch (e) {
            this.handler.error(`App.render(${ this.renderId }) -> ${ e.message }`);
        }
    };

    /**
     * Application state container public interface.
     */
    document: IAppPublicState = {
        getState: (): IAppState => {
            return this.state;
        },
        setState: (state:IAppState): void => {
            if (DEBUG) {
                this.setState(state);
            }
        }
    };
}

export {App as default};
