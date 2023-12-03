/**
 * Capital - Application actions.
 *
 * @version 1.1.5
 * @author Aleksandr Vorkunov
 */

import { Action } from "redux";
import { MainTypes } from "../constants/actionTypes";
import { IFinData } from "../components/Finances/Finances";
import { IData } from "../interfaces";
export * from "./dashboard";
//----------------------------------------------------------------------------------------------------------------------
/* Modal window */
interface IModalData {
    display: boolean;
    caption?: string;
    text?: string;
    index: number;
    callback?: (index:number) => void | null;
}
interface IShowModalAction extends Action {
    payLoad: IModalData
}
const showModal = (
    caption: string,
    text: string,
    index: number,
    callback: (id: number) => void
): IShowModalAction => ({
    type: MainTypes.ShowModalAction,
    payLoad: {
        display: true,
        caption: caption,
        text: text,
        callback: callback,
        index: index
    }
});
const hideModal = (index:number):IShowModalAction => ({
    type: MainTypes.HideModalAction,
    payLoad: {
        display: false,
        index: index,
    }
});
//----------------------------------------------------------------------------------------------------------------------
interface ISetHash extends Action {
    payLoad: {
        hash: string
    }
}
const setHashData = (hash:string):ISetHash => ({
    type: MainTypes.SetHashAction,
    payLoad: {
        hash
    }
});
//----------------------------------------------------------------------------------------------------------------------
interface ILoadFinanceDataAction extends Action {
    payLoad: IFinData[]
}
const loadFinanceData = (data:IFinData[]):ILoadFinanceDataAction => ({
    type: MainTypes.LoadFinanceData,
    payLoad: data
});

//----------------------------------------------------------------------------------------------------------------------
interface ILoadRatesDataAction extends Action {
    payLoad: IData[]
}
const loadRatesData = (data:IData[]):ILoadRatesDataAction => ({
    type: MainTypes.LoadRatesData,
    payLoad: data
});
//----------------------------------------------------------------------------------------------------------------------
type MainSummaryAction =
    IShowModalAction
    & ILoadFinanceDataAction
    & ILoadRatesDataAction
    & ISetHash;
export {
    IShowModalAction,
    MainSummaryAction,
    IModalData,
    showModal,
    hideModal,
    loadFinanceData,
    loadRatesData,
    setHashData
};
