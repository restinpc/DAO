/**
 * Capital - Redux container.
 *
 * @version 0.0.1
 * @author Aleksandr Vorkunov
 */

import { applyMiddleware, createStore, Store } from "redux";
import { routerMiddleware } from "connected-react-router";
import { composeWithDevTools } from "redux-devtools-extension";
import { History } from 'history';
import StateHandler from "./stateHandler";
import Reducer from "./reducers/main";

const reduxStore = (history:History):Store => {
    const store = createStore(
        Reducer(history),
        composeWithDevTools(
            applyMiddleware(
                routerMiddleware(history),
                StateHandler
            )
        )
    );
    return store;
};

export default reduxStore;
