/**
 * Capital - TypeScript notations.
 *
 * @version 0.0.1
 * @author Aleksandr Vorkunov
 */
 
import { History } from "history";

declare module "*.scss" {
  const content: { [className: string]: string };
  export = content;
}

declare module "*.less" {
  const content: { [className: string]: string };
  export = content;
}

declare module "*.svg" {
  // @ts-ignore
  import React = require("react");
  const ReactComponent: React.FunctionComponent<React.SVGProps<SVGSVGElement>>;
  export default ReactComponent;
}

declare const IS_PROD: boolean;
declare const IS_DEV: boolean;
declare const IS_DEV_SERVER: boolean;



declare global {
    // @ts-ignore
    interface Document extends Node, NonElementParentNode, DocumentOrShadowRoot, ParentNode, GlobalEventHandlers, DocumentAndElementEventHandlers {

        /**
         * Sets or gets the URL for the current document.
         */
        traceStack: string[];
        handler: import("../errorHandler").default;
        // @ts-ignore
        reduxStore: import("../reduxStore");
        // @ts-ignore
        appLoader: import("../appLoader");
        // @ts-ignore
        dataSource: import("../dataSource");

        history: History;
    }
}

