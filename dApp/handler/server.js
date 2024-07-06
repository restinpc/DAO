/**
 * Exception Handler - Express Server.
 *
 * 1.0.0 # Aleksandr Vorkunov <devbyzero@yandex.ru>
 */

const fs = require('fs');
const https = require('https');
const env = require('dotenv');
const express = require('express');
const bodyParser = require('body-parser');
const timeout = require('connect-timeout');
const cors = require('cors');
env.config();
const privateKey  = fs.readFileSync('keys/privatekey.key', 'utf8');
const certificate = fs.readFileSync('keys/certificate.crt', 'utf8');
const credentials = { key: privateKey, cert: certificate };
const app = express();
const PORT = process.env.HANDLER_PORT;

(function main() {
    let server;
    try {
        app.use(cors());
        app.use(bodyParser.json({ type: "text/json" }));
        app.use(timeout('60s'));
        app.get("/", (req, res) => {
            res.status(200).send(require("./package.json"));
        }); 
        app.post("/trace", (req, res) => {
            require('./trace')(req).then((data, code = 200) => {
                res.status(code).send(data);
            });
        });
        app.get('/list', (req, res) => {
            require('./list')().then((data, code = 200) => {
                res.status(code).send(data);
            });
        })
        app.all('/*', (req, res) => res.status(404).send('Error'));
        server = https.createServer(credentials, app);
        server.listen(PORT, () => console.log(`Starting Exceptions Handler server at port ${PORT}`));
    } catch (e) {
        console.log(`Fatal error -> ${e.message}`);
        try {
            server.close();
        } catch (e) {
            console.log(`Server wasn't ever started`);
        }
        console.log(`Restarting server...`);
        setTimeout(main, 1);
        return 0;
    }
})();