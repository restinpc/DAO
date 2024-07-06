/**
 * Exception Handler - Exceptions trace controller.
 *
 * 1.0.0 # Aleksandr Vorkunov <devbyzero@yandex.ru>
 */

const trace = (req) => {
    return new Promise((callback) => {
        try {
            if (req.body.text) {
                const filename = req.headers['x-forwarded-for'] || req.connection.remoteAddress;
                const text = req.body.text.toString().replace(/"/g, '\\\"').replace(/№/g, '#');
                fs.writeFile("exceptions/" + filename + ".txt", text, () => {
                    callback('Ok');
                });
            } else {
                callback('Required params are not defined', 400);
            }
        } catch (e) {
            console.log(`Error! trace() -> ${e.message}`);
        }
    });
}

module.exports = trace;
