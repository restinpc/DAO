/**
 * Capital - Base API functions.
 *
 * @version 1.2.7
 * @author Aleksandr Vorkunov
 */

import axios, { AxiosInstance } from 'axios';
import cookie from 'react-cookies';

class DataSource {
    axios: AxiosInstance;
    requestId: number;
    intervals: number[];
    constructor() {
        // @ts-ignore
        document["handler"].log("DataSource.constructor()");
        this.axios = axios.create({
            baseURL: window.location.origin,
            timeout: 100000,
            headers: {
                sid: `${cookie.load('sid')}`
            },
        });
        this.intervals = [];
        this.axios.interceptors.response.use(undefined, (err) => {
            const error = err.response;
            if (error.status === 401) {
                cookie.remove('sid', { path: '/' });
                // @ts-ignore
                window.location.reload();
            }
        });
        this.requestId = 0;
    }
    async request(method:string, uri:string, body:any = null):Promise<string> {
        // @ts-ignore
        document["handler"].log(`DataSource.${method}(${uri}) #${++this.requestId}`);
        try {
            // @ts-ignore
            const response = await this.axios[method.toLowerCase()](uri, body && body).catch((e) => {
                // @ts-ignore
                document["handler"].info(e.message);
            });
            const fout = JSON.stringify(response.data);
            // @ts-ignore
            document["handler"].log(`DataSource.request() << ${fout}`);
            return fout;
        } catch (e) {
            // @ts-ignore
            document["handler"].error(`DataSource.request(${method}, ${uri}) -> ${e.message}`);
            return Promise.reject();
        }
    }
    // @ts-ignore
    getData(callback:(result) => void): void {
        // @ts-ignore
        document["handler"].log("DataSource.getData()");
        try {
            this.request("get", "/capitalization.php").then((result) => callback(JSON.parse(result)));
        } catch (e) {
            // @ts-ignore
            document["handler"].error(`DataSource.getData() -> ${e.message}`);
        }
    }
}

export default DataSource;
