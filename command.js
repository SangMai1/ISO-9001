const { exec } = require("child_process")
const fs = require('fs')
const { seed } = require('./cmd-config')
const path = require('path')

const command = process.argv[2]
const NOT_FOUND_COMMAND = 'Not found command'
const arg = process.argv.slice(3, process.env.length).join(' ').trim()

async function main() {
    switch (command) {
        case 'seed':
            if (arg === '--all') Object.keys(seed).forEach(async (key) => await commandAction.seedAction(key))
            else if(arg === 'bk') await execCommand('php artisan db:seed --class=' + 'BackupSeed')
            else await commandAction.seedAction(arg)
            break
        case 'clean':
            if (arg === '--all') {
                fs.rmdirSync(path.dirname(__dirname + '\\public\\js\\**'), { recursive: true })
                fs.rmdirSync(path.dirname(__dirname + '\\public\\css\\**'), { recursive: true })
                await execCommand('npm run sass -- --no-source-map ./resources/public/sass/:./public/css && npm run tsc && php artisan migrate:fresh && dev seed --all')
            } else if (arg === 'public') {
                fs.rmdirSync(path.dirname(__dirname + '\\public\\js\\**'), { recursive: true })
                fs.rmdirSync(path.dirname(__dirname + '\\public\\css\\**'), { recursive: true })
            } else {
                console.log(NOT_FOUND_COMMAND)
            }
            break

        default:
            console.log(NOT_FOUND_COMMAND)
    }
}

const commandAction = {
    async seedAction(arg) {
        const seedClass = seed[arg]
        if (seedClass) await execCommand('php artisan db:seed --class=' + seedClass)
        else console.log(`Not found seed "${arg}"`)
    }
}

function execCommand(command = '') {
    return new Promise((resolve, reject) => {
        const process = exec(command);

        process.stdout.on('data', function (data) {
            console.log(data.toString().trim());
        });

        process.stderr.on('data', function (data) {
            console.error(data.toString().trim());
        });

        process.on('exit', function (code) {
            resolve()
        });
    })

}

main()