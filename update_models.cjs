const fs = require('fs');
const path = require('path');

const models = {
    'Cpu.php': 'component_cpus',
    'Gpu.php': 'component_gpus',
    'Motherboard.php': 'component_motherboards',
    'Ram.php': 'component_rams',
    'Storage.php': 'component_storages',
    'PowerSupply.php': 'component_power_supplies',
    'PcCase.php': 'component_pc_cases'
};

const basePath = 'c:\\Users\\Administrator\\Documents\\techforge_e-commerce\\app\\Models';

for (const [model, table] of Object.entries(models)) {
    const fullPath = path.join(basePath, model);
    let content = fs.readFileSync(fullPath, 'utf8');
    
    // Check if table property already exists
    if (!content.includes('protected $table')) {
        // Insert protected $table after the class declaration
        const classRegex = /class\s+\w+\s+extends\s+Model\s*\{/;
        content = content.replace(classRegex, `$&
    protected $table = '${table}';`);
        
        fs.writeFileSync(fullPath, content, 'utf8');
        console.log(`Updated ${model}`);
    }
}
