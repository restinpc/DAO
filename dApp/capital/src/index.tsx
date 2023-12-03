/**
 * Capital - Application index.
 *
 * @version 1.1.5
 * @author Aleksandr Vorkunov
 */

import "react-app-polyfill/ie11";
import "react-app-polyfill/stable";
import * as React from 'react';
import * as ReactDom from 'react-dom';
import { Provider } from 'react-redux';
import './styles/styles.less';
import './styles/styles.scss';
import history from "./history";
import ErrorHandler from "./errorHandler";
import AppLoader from "./appLoader";
import DataSource from "./dataSource";
import ReduxStore from "./reduxStore";
import Finances from "./components/Finances/Finances";

try {
    const rootComponent = "root";
    document["handler"] = new ErrorHandler(rootComponent);
    document["appLoader"] = new AppLoader();
    document["dataSource"] = new DataSource();
    document["reduxStore"] = ReduxStore(history);
    ReactDom.render(
        <Provider store={document["reduxStore"]}>
            <Finances />
        </Provider>,
        document.getElementById(rootComponent)
    );
    window.addEventListener("load", () => {
        setTimeout(() => {
            document["appLoader"].load("window");
        }, 300);
    });
} catch (e) {
    document["handler"].error(e.message);
}
