const fs = require('fs');
const path = require('path');

const viewsDir = path.join(__dirname, 'resources', 'views');

const tailwindConfigRegex = /<script>\s*tailwind\.config\s*=\s*\{[\s\S]*?\}\s*\}\s*<\/script>/;
const preloaderScriptRegex = /<!-- Preloader Script -->\s*<script>\s*window\.addEventListener\('load'[\s\S]*?<\/script>/;
const ambientLightRegex = /<!-- Script for subtle interactive effects -->\s*<script>\s*document\.addEventListener\('mousemove'[\s\S]*?<\/script>/;

function processDirectory(directory) {
    const files = fs.readdirSync(directory);
    
    for (const file of files) {
        const fullPath = path.join(directory, file);
        if (fs.statSync(fullPath).isDirectory()) {
            processDirectory(fullPath);
        } else if (fullPath.endsWith('.blade.php')) {
            let content = fs.readFileSync(fullPath, 'utf8');
            let modified = false;

            if (tailwindConfigRegex.test(content)) {
                content = content.replace(tailwindConfigRegex, "@vite('resources/js/Common/TailwindConfig.js')");
                modified = true;
            }

            if (preloaderScriptRegex.test(content)) {
                content = content.replace(preloaderScriptRegex, '');
                modified = true;
            }

            if (ambientLightRegex.test(content)) {
                content = content.replace(ambientLightRegex, "@vite(['resources/js/Common/Preloader.js', 'resources/js/Common/AmbientEffects.js'])");
                modified = true;
            }

            if (modified) {
                fs.writeFileSync(fullPath, content, 'utf8');
                console.log(`Processed: ${fullPath}`);
            }
        }
    }
}

processDirectory(viewsDir);
console.log("Done refactoring common scripts.");
