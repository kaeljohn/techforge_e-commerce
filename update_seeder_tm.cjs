const fs = require('fs');

const path = 'c:\\Users\\Administrator\\Documents\\techforge_e-commerce\\database\\seeders\\CustombuiltConfigsSeeder.php';
let content = fs.readFileSync(path, 'utf8');

// The Intel string is already Intel©, but let's make sure it's correct just in case
content = content.replace(/'name' => 'AMD© (.*?) Gaming PC Configurator'/g, "'name' => 'AMD Ryzen™ $1 Gaming PC Configurator'");

fs.writeFileSync(path, content, 'utf8');
console.log('Seeder updated with TM for AMD Ryzen');
