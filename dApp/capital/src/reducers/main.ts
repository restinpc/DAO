/**
 * Capital - Primary reducer.
 *
 * @version 1.1.5
 * @author Aleksandr Vorkunov
 */

import { combineReducers, Reducer } from 'redux';
import { connectRouter, RouterState } from "connected-react-router";
import { History } from 'history';
import { IModalData, MainSummaryAction } from "../actions/index";
import { MainTypes } from "../constants/actionTypes";
import dashboard, { IDashboardState } from "./dashboard";
import { IData } from "../interfaces";
import { IFinData } from "../components/Finances/Finances";

//----------------------------------------------------------------------------------------------------------------------
interface IAppState {
    modalData: IModalData[],
    financeData: IFinData[],
    ratesData: IData[];
    hash: string;
}
//----------------------------------------------------------------------------------------------------------------------
const initialState = (): IAppState => ({
    modalData: [],
    financeData: [],
    ratesData: [],
    hash: "",
});
//----------------------------------------------------------------------------------------------------------------------
const main = (state: IAppState = initialState(), action: MainSummaryAction) => {
    const { payLoad } = action;
    switch (action.type) {
    case MainTypes.ShowModalAction:
        return {
            ...state,
            modalData: [
                ...state.modalData,
                payLoad
            ],
        };
    case MainTypes.HideModalAction:
        return {
            ...state,
            modalData: state.modalData.map((data) => {
                if (data.index !== payLoad.index) {
                    return data;
                }
                return {
                    ...data,
                    display: false
                };
            }),
        };
    case MainTypes.LoadFinanceData:
        return {
            ...state,
            financeData: action.payLoad
        };
    case MainTypes.LoadRatesData:
        return {
            ...state,
            ratesData: action.payLoad
        };
    case MainTypes.LoadStatsAction:
        return {
            ...state,
            stats: action.payLoad
        };
    case MainTypes.SetHashAction:
        return {
            ...state,
            hash: action.payLoad.hash
        };
    default:
        return state;
    }
};
//----------------------------------------------------------------------------------------------------------------------
const rootReducer:(history:History) => Reducer = (history:History) => combineReducers(
    {
        router: connectRouter(history),
        main,
        dashboard,
    }
);

type ISummaryAppState = {
    main: IAppState,
    dashboard: IDashboardState,
    router?: RouterState;
    key: string
};
export {
    rootReducer as default,
    ISummaryAppState,
    IAppState,
};
