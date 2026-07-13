const fs = require('fs');

const path = 'resources/views/build-overview.blade.php';
let content = fs.readFileSync(path, 'utf8');

// The modal spans from <!-- Product Selection Modal --> to its closing </div>
const modalStart = content.indexOf('    <!-- Product Selection Modal -->');
let modalEnd = content.indexOf('    <script>', modalStart);

const modalCode = content.substring(modalStart, modalEnd);

// Remove modal from head
content = content.replace(modalCode, '');

// Now we need to insert the modal right after <x-navbar />
content = content.replace('<x-navbar />', '<x-navbar />\n' + modalCode);

// Now fix the scripts
// Tailwind Config
const tailwindStart = content.indexOf('    <script>\n        tailwind.config');
const tailwindEnd = content.indexOf('    </script>\n    <!-- Google Fonts -->', tailwindStart) + 14;
if (tailwindStart !== -1) {
    content = content.substring(0, tailwindStart) + "    @vite('resources/js/Common/TailwindConfig.js')\n" + content.substring(tailwindEnd);
}

// Preloader
const preloaderRegex = /    <!-- Preloader -->[\s\S]*?<\/div>\n/m;
content = content.replace(preloaderRegex, "    @vite('resources/js/Common/Preloader.js')\n");

// Ambient Effects
const ambientRegex = /    <!-- Background Ambient Effects -->[\s\S]*?<div class="ambient-light-2"><\/div>\n/m;
content = content.replace(ambientRegex, "    @vite('resources/js/Common/AmbientEffects.js')\n");

// Fix inline scripts at the bottom
const scriptStart = content.indexOf('    <script>\n        // Data injected from Controller');
const scriptEnd = content.lastIndexOf('</script>');

if (scriptStart !== -1) {
    const replacement = `    <script>
        window.PageConfig = {
            allComponents: @json($allComponents),
            initialBuild: {
                'Processor': @json($product->cpu),
                'Video Card': @json($product->gpu),
                'Memory': @json($product->ram),
                'Primary Storage': @json($product->storage),
                'Motherboard': @json($product->motherboard),
                'Power Supply': @json($product->powerSupply),
                'Case': @json($product->pcCase)
            },
            productName: '{{ $product->name }}',
            productImageUrl: '{{ $product->image_url }}',
            cartAddRoute: '{{ route("cart.add") }}',
            csrfToken: document.querySelector('meta[name="csrf-token"]').content
        };
    </script>
    @vite(['resources/js/HomePage/Homepage.js', 'resources/js/Pages/BuildOverview/BuildOverview.js'])
    
    <x-lenis />`;
    
    const endVite = content.indexOf('</body>', scriptStart);
    content = content.substring(0, scriptStart) + replacement + '\n' + content.substring(endVite);
}

fs.writeFileSync(path, content, 'utf8');
console.log('Fixed build-overview.blade.php');
