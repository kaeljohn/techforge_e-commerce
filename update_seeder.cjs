const fs = require('fs');

const path = 'c:\\Users\\Administrator\\Documents\\techforge_e-commerce\\database\\seeders\\CustombuiltConfigsSeeder.php';
let content = fs.readFileSync(path, 'utf8');

// Replace "Intel" with "Intel©" in the names, and "Build" with "Gaming PC Configurator"
content = content.replace(/'name' => 'Intel (.*?) Build'/g, "'name' => 'Intel© $1 Gaming PC Configurator'");
content = content.replace(/'name' => 'AMD (.*?) Build'/g, "'name' => 'AMD© $1 Gaming PC Configurator'");

fs.writeFileSync(path, content, 'utf8');
console.log('Seeder updated');
