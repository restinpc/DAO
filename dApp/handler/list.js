/**
 * Exception Handler - Exceptions list controller.
 *
 * 1.0.0 # Aleksandr Vorkunov <devbyzero@yandex.ru>
 */

const fs = require('fs');

const getFiles = (dir, files_) => {
    files_ = files_ || [];
    let files = fs.readdirSync(dir);
    for (let i in files) {
        if (files[i] != '.gitkeep') {
            let name = dir + "/" + files[i];
            if (fs.statSync(name).isDirectory()) {
                getFiles(name, files_);
            } else {
                files_.unshift(name);
            }
        }
    }
    return files_;
};

const list = () => {
    return new Promise(callback => {
        try {
            const files = getFiles("exceptions");
            const data = [];
            let skipped = 0;
            files.forEach(file => {
                let flag = true;
                if (files.length - skipped > 100) {
                    flag = false;
                    skipped++;
                }
                if (flag) {
                    fs.stat(file, (err, contents) => {
                        data.push({
                            ip: file.replace('exceptions/', '').replace('.txt', ''),
                            data: fs.readFileSync(file, 'utf8'),
                            date: contents.birthtime,
                        });
                        if (data.length === files.length) {
                            callback(data);
                        }
                    });
                }
            });
            if (!files.length) {
                callback(data);
            }
        } catch (e) {
            console.log(`Error! list() -> ${e.message}`);
        }
    });
}

module.exports = list;
