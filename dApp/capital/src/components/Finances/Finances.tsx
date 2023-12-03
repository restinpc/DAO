/**
 * Capital - Finances chart component
 *
 * @version 1.2.8
 * @author Aleksandr Vorkunov
 */

import React from "react";
import { Action } from "redux";
import { connect } from "react-redux";
import { Line } from 'react-chartjs-2';
import {
    Chart as ChartJS,
    CategoryScale,
    LinearScale,
    PointElement,
    LineElement,
    Title,
    Tooltip,
    Legend,
} from 'chart.js';
import { Button } from '@material-ui/core';
import DialogTitle from '@material-ui/core/DialogTitle';
import DialogContent from '@material-ui/core/DialogContent';
import DialogActions from '@material-ui/core/DialogActions';
import Dialog from '@material-ui/core/Dialog';
import TextField from "@material-ui/core/TextField";
import NumberFormat from '../NumberFormat/NumberFormat';
import { loadFinanceData } from "../../actions/index";
import { ISummaryAppState } from "../../reducers/main";
// @ts-ignore
import load from "../../images/load.gif";

ChartJS.register(
    CategoryScale,
    LinearScale,
    PointElement,
    LineElement,
    Title,
    Tooltip,
    Legend
);

export interface IFinData {
    total_rub: string,
    total_usd: string,
    total_eur: string,
    debit_rub: string,
    debit_usd: string,
    debit_eur: string,
    btcLocal: number,
    bchLocal: number,
    date: string,
}

interface IFinancesProps {
    load: () => void,
    financeData: IFinData[],
}

interface IFincancesState {
    frameId: number,
    popup: boolean,
    currency: string,
    loaded: boolean
}

interface ISimpleDialogProps {
    onClose: (selectedValue?:string) => void,
    selectedValue?:string,
    open:boolean,
    // eslint-disable-next-line
    data: any[],
    userId: number
}

const mapStateToProps = (state:ISummaryAppState) => ({
    financeData: state.main.financeData,
});

const mapDispatchToProps = (dispatch: (action:Action) => void) => ({
    load: () => {
        // @ts-ignore
        document["dataSource"].getData((data) => {
            dispatch(loadFinanceData(data));
        });
    },
});

class Finances extends React.Component<IFinancesProps, IFincancesState> {
    private onResize: (e: any) => void;
    private timeout: number;
    private userId: number;
    constructor(props:IFinancesProps) {
        super(props);
        this.state = {
            loaded: false,
            frameId: 0,
            popup: false,
            currency: 'RUB'
        };
        this.timeout = 0;
        this.onResize = (e:any) => {
            // @ts-ignore
            clearTimeout(this.timeout);
        };
        this.userId = 0;
    }

    componentDidMount(): void {
        window.onresize = (e:any) => this.onResize(e);
        if (!this.props.financeData.length) {
            this.props.load();
            setTimeout(() => this.setState({ loaded: true }), 500);
        } else {
            setTimeout(() => this.setState({ loaded: true }), 1000);
        }
    }
    componentWillUnmount(): void {
        this.onResize = (e) => {};
    }
    SimpleDialog(props:ISimpleDialogProps) {
        const {
            onClose,
            selectedValue,
            open,
            data,
            userId
        } = props;
        const handleClose = () => {
            onClose(selectedValue);
        };
        return (
            <Dialog onClose={handleClose} aria-labelledby="simple-dialog-title" open={open} >
                <DialogTitle id="simple-dialog-title">Capitalization</DialogTitle>
                <DialogContent style={{ width: window.innerWidth > 400 ? "320px" : "270px" }}>
                    <TextField
                        disabled
                        id="EUR"
                        title={data.length ? `${parseInt(data[data.length - 1].cap_eur, 10)} RUB` : ''}
                        defaultValue={data.length ? data[data.length - 1].eur : ''}
                        label="EUR"
                        style={{ width: "50%", marginTop: "10px" }}
                        InputProps={{
                            inputComponent: NumberFormat,
                        }}
                    />
                    <TextField
                        disabled
                        id="USD"
                        title={data.length ? `${parseInt(data[data.length - 1].cap_usd, 10)} RUB` : ''}
                        defaultValue={data.length ? data[data.length - 1].usd : ''}
                        label="USD"
                        style={{ width: "50%", marginTop: "10px" }}
                        InputProps={{
                            prefix: "$",
                            inputComponent: NumberFormat,
                        }}
                    />
                    <TextField
                        disabled
                        id="BTC"
                        label="BTC"
                        title={data.length ? `${parseInt(data[data.length - 1].cap_btc, 10)} RUB` : ''}
                        defaultValue={data.length ? data[data.length - 1].btc : ''}
                        style={{ width: "50%", marginTop: "10px" }}
                        InputProps={{
                            inputComponent: NumberFormat,
                        }}
                    />
                    <TextField
                        disabled
                        id="RUB"
                        label="RUB"
                        defaultValue={data.length ? data[data.length - 1].rub : ''}
                        style={{ width: "50%", marginTop: "10px" }}
                        InputProps={{
                            inputComponent: NumberFormat,
                        }}
                    />
                    <TextField
                        disabled
                        id="Stock"
                        label="Stock"
                        defaultValue={data.length ? data[data.length - 1].stock : ''}
                        style={{ width: "50%", marginTop: "10px" }}
                        InputProps={{
                            inputComponent: NumberFormat,
                        }}
                    />
                    <TextField
                        disabled
                        id="Credit"
                        label="Credit"
                        defaultValue={data.length ? data[data.length - 1].credit : ''}
                        style={{ width: "50%", marginTop: "10px" }}
                        InputProps={{
                            inputComponent: NumberFormat,
                        }}
                    />
                </DialogContent>
                <br/>
                <DialogActions>
                    <Button color="secondary" onClick={() => {
                        handleClose();
                    }}>Ok</Button>
                </DialogActions>
            </Dialog>
        );
    }
    render() {
        const labels: string[] = [];
        const rub: number[] = [];
        const usd: number[] = [];
        const eur: number[] = [];
        const rub_debit: number[] = [];
        const usd_debit: number[] = [];
        const eur_debit: number[] = [];
        // @ts-ignore
        const { currency, popup } = this.state;
        // @ts-ignore
        const setPopup = (data) => {
            this.setState({ popup: data });
        };
        const setCurrency = (value:string) => {
            this.setState({ currency: value });
        };
        if (this.props.financeData.length < 100) {
            this.props.financeData.forEach((item) => {
                rub.push(parseInt(item.total_rub, 10) / 1000);
                usd.push(parseInt(item.total_usd, 10));
                eur.push(parseInt(item.total_eur, 10));
                rub_debit.push(parseInt(item.debit_rub, 10) / 1000);
                usd_debit.push(parseInt(item.debit_usd, 10));
                eur_debit.push(parseInt(item.debit_eur, 10));
                labels.push(item.date);
            });
        } else if (this.props.financeData.length) {
            const a = 100 / this.props.financeData.length;
            let i = 0;
            let lastDate = null;
            this.props.financeData.forEach((item) => {
                if (parseInt(String(i + a), 10) !== parseInt(String(i), 10)) {
                    rub.push(parseInt(item.total_rub, 10) / 1000);
                    usd.push(parseInt(item.total_usd, 10));
                    eur.push(parseInt(item.total_eur, 10));
                    rub_debit.push(parseInt(item.debit_rub, 10) / 1000);
                    usd_debit.push(parseInt(item.debit_usd, 10));
                    eur_debit.push(parseInt(item.debit_eur, 10));
                    labels.push(item.date);
                    lastDate = item.date;
                }
                i += a;
            });
            if (lastDate !== this.props.financeData[this.props.financeData.length - 1].date) {
                const item = this.props.financeData[this.props.financeData.length - 1];
                rub.push(parseInt(item.total_rub, 10) / 1000);
                usd.push(parseInt(item.total_usd, 10));
                eur.push(parseInt(item.total_eur, 10));
                rub_debit.push(parseInt(item.debit_rub, 10) / 1000);
                usd_debit.push(parseInt(item.debit_usd, 10));
                eur_debit.push(parseInt(item.debit_eur, 10));
                labels.push(item.date);
            }
        }
        let total = 0;
        const b = currency === 'RUB' ? rub_debit : currency === 'EUR' ? eur_debit : usd_debit;
        if (b && b.length) {
            total = parseInt(b[b.length - 1].toFixed(0), 10);
        }
        const currencyMap = {
            RUB: "K ₽",
            USD: "$",
            EUR: "€"
        };
        const options = {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top' as const,
                },
                title: {
                    display: false
                },
            },
            height: 600,
            width: 1000,
            maintainAspectRatio: false,
            scales: {
                x: {
                    border: {
                        display: true
                    },
                    grid: {
                        display: true,
                        drawOnChartArea: true,
                        drawTicks: true,
                        color: '#333',
                    },
                    time: {
                        displayFormats: {
                            millisecond: 'D'
                        }
                    }
                },
                y: {
                    border: {
                        display: false
                    },
                    grid: {
                        color: '#333',
                    },
                    time: {
                        displayFormats: {
                            millisecond: 'D'
                        }
                    }
                }
            }
        };
        const data = {
            labels,
            datasets: [
                {
                    label: 'Balance',
                    data: currency === 'RUB' ? rub : currency === 'EUR' ? eur : usd,
                    borderColor: '#3bc6ca',
                    backgroundColor: '#3bc6ca',
                    borderWidth: 2,
                    pointRadius: 1,
                    pointHoverRadius: 2,
                },
                {
                    label: 'Capitalization',
                    data: currency === 'RUB' ? rub_debit : currency === 'EUR' ? eur_debit : usd_debit,
                    borderColor: 'rgb(86,144,99)',
                    backgroundColor: 'rgb(86,144,99)',
                    borderWidth: 2,
                    pointRadius: 1,
                    pointHoverRadius: 2,
                },
            ],
        };
        return (
            <div className="Finances">
                <div style={{ float: "left", padding: "10px" }}>
                    <Button color="primary" style={{ fontSize: window.innerWidth > 400 ? 14 : 11, color: "#c0c0c0", fontWeight: 300 }} onClick={() => {
                        setPopup(true);
                    }}>
                        { total }
                        {
                            // @ts-ignore
                            currencyMap[currency]
                        }
                    </Button>
                </div>
                <div style={{ float: "right", padding: "10px" }}>
                    <select
                        style={{ paddingLeft: '7px', paddingRight: '7px' }}
                        value={currency}
                        onChange={(e) => setCurrency(e.target.value)}
                    >
                        <option value={"RUB"}>₽</option>
                        <option value={"USD"}>$</option>
                        <option value={"EUR"}>€</option>
                    </select>
                </div>
                <div style={{
                    height: "550px",
                    zoom: window.innerWidth > 400 ? 1 : 0.5,
                    paddingBottom: 20,
                    overflow: "hidden",
                    width: "calc(100% - 20px)",
                    margin: "0px auto",
                    clear: "both"
                }}>
                    {
                        this.state.loaded && <Line
                            redraw={false}
                            height={550}
                            data={data}
                            options={options}
                        />
                    }
                    {
                        !this.state.loaded && <div style={{
                            clear: "both",
                            textAlign: "center",
                            paddingTop: window.innerWidth > 400 ? 270 : 230
                        }}>
                            <img src={ load } style={{ zoom: window.innerWidth > 400 ? 0.5 : 1 }} />
                        </div>
                    }
                </div>
                <this.SimpleDialog
                    userId={this.userId}
                    data={this.props.financeData}
                    open={popup}
                    onClose={() => {
                        setPopup(false);
                    }}
                />
            </div>
        );
    }
}
// @ts-ignore
export default connect(mapStateToProps, mapDispatchToProps)(Finances);
