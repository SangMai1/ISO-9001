const { exec } = require("child_process");
const mapSeed = {
    'cn': 'ChucnangsSeeder'
}
const command = process.argv[2]
const arg = process.argv.slice(3, process.env.length).join(' ').trim()

switch (command) {
    case 'seed':
        const seedClass = mapSeed[arg]
        if (seedClass) execCommand('php artisan db:seed --class=' + seedClass)
        else console.log('Not found seed ' + seedClass)
        break
}

function execCommand(command = '') {
    exec(command, (error, stdout, stderr) => {
        if (error) { console.log(`error: ${error.message}`); return; }
        if (stderr) { console.log(stderr); }
        console.log(stdout);
    });
}