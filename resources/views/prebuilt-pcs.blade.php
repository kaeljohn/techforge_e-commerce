<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    <title>{{ config('app.name', 'TechForge') }} | Built for Performance</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            DEFAULT: '#ff6b00',
                            hover: '#e56000',
                            glow: 'rgba(255, 107, 0, 0.5)'
                        },
                        dark: {
                            bg: '#050505',
                            surface: '#121212'
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #050505;
            color: #ffffff;
            overflow-x: hidden;
        }

        /* Ambient Radial Light Blurs */
        .ambient-light-1 {
            position: fixed;
            top: -20%;
            left: -20%;
            width: 70vw;
            height: 70vw;
            background: radial-gradient(circle, rgba(255, 107, 0, 0.35) 0%, rgba(255, 107, 0, 0) 65%);
            z-index: -1;
            pointer-events: none;
            animation: floatPulse1 20s ease-in-out infinite;
        }

        .ambient-light-2 {
            position: fixed;
            top: 35%;
            right: -20%;
            width: 80vw;
            height: 80vw;
            background: radial-gradient(circle, rgba(153, 0, 0, 0.4) 0%, rgba(153, 0, 0, 0) 65%);
            z-index: -1;
            pointer-events: none;
            animation: floatPulse2 25s ease-in-out infinite;
        }

        @keyframes floatPulse1 {
            0% {
                opacity: 0.3;
                transform: translate(0, 0) scale(0.8);
            }
            33% {
                opacity: 0.8;
                transform: translate(25vw, 15vh) scale(1.2);
            }
            66% {
                opacity: 0.4;
                transform: translate(-10vw, 30vh) scale(0.9);
            }
            100% {
                opacity: 0.3;
                transform: translate(0, 0) scale(0.8);
            }
        }

        @keyframes floatPulse2 {
            0% {
                opacity: 0.8;
                transform: translate(0, 0) scale(1.1);
            }
            33% {
                opacity: 0.3;
                transform: translate(-25vw, -15vh) scale(0.8);
            }
            66% {
                opacity: 0.7;
                transform: translate(15vw, -25vh) scale(1.3);
            }
            100% {
                opacity: 0.8;
                transform: translate(0, 0) scale(1.1);
            }
        }

        /* Orange Gradient Text */
        .text-gradient {
            background: linear-gradient(to right, #ffffff, #ffaa66);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #050505;
        }
        ::-webkit-scrollbar-thumb {
            background: #333;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #ff6b00;
        }

        /* Preloader Animations */
        @keyframes spinFastOnce {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(720deg); }
        }
        .animate-spin-fast {
            animation: spinFastOnce 0.8s cubic-bezier(0.2, 0.8, 0.2, 1) forwards;
        }
        @keyframes slideTextOut {
            0% { max-width: 0; opacity: 0; padding-left: 0; }
            100% { max-width: 400px; opacity: 1; padding-left: 1.5rem; }
        }
        .animate-slide-text {
            animation: slideTextOut 0.6s cubic-bezier(0.2, 0.8, 0.2, 1) forwards;
            animation-delay: 0.8s;
            overflow: hidden;
            white-space: nowrap;
            opacity: 0;
            max-width: 0;
        }
    </style>

    @vite('resources/css/liquidglass.css')
</head>
<body class="relative antialiased selection:bg-primary selection:text-white">

    <!-- Preloader -->
    <div id="preloader" class="fixed inset-0 bg-[#050505] z-[100] flex items-center justify-center transition-opacity duration-1000 ease-in-out">
        <script>
            if (!sessionStorage.getItem('techforge_visited')) {
                document.write(`
                    <div class="relative flex items-center justify-center">
                        <div class="absolute inset-0 bg-primary/20 blur-xl rounded-full animate-pulse"></div>
                        <div class="flex items-center relative z-10">
                            <img src="{{ Vite::asset('resources/img/Techforge_Logo.png') }}" alt="TechForge Logo" class="h-20 w-auto object-contain animate-spin-fast drop-shadow-[0_0_25px_rgba(255,107,0,0.6)]">
                            <span class="text-4xl md:text-5xl font-black text-white tracking-widest animate-slide-text">TECHFORGE</span>
                        </div>
                    </div>
                `);
            } else {
                document.getElementById('preloader').style.display = 'none';
            }
        </script>
    </div>

    <!-- Background Ambient Effects -->
    <div class="ambient-light-1"></div>
    <div class="ambient-light-2"></div>



    <x-navbar />

    <!-- Category Hero -->
    <main class="relative pt-32 pb-16 lg:pt-40 lg:pb-20 overflow-hidden w-full">
        <div class="w-full relative z-10 group" style="mask-image: linear-gradient(to right, transparent, black 15%, black 85%, transparent); -webkit-mask-image: linear-gradient(to right, transparent, black 15%, black 85%, transparent);">
            <div class="absolute inset-0 w-full h-full">
                <img src="https://images.unsplash.com/photo-1547082299-de196ea013d6?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" alt="Pre-Built PCs" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700 opacity-40">
                <div class="absolute inset-0 bg-gradient-to-r from-[#050505] via-transparent to-[#050505] pointer-events-none"></div>
            </div>
            
            <div class="max-w-[1500px] mx-auto px-6 lg:px-8 relative z-10 py-16 md:py-24">
                <div class="w-full md:w-2/3">
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black text-white tracking-wide mb-4">Pre-Built PCs</h1>
                    <p class="text-gray-400 text-sm md:text-base leading-relaxed max-w-lg">Browse our full range of prebuilt gaming PCs. Ready to ship directly to your door. Experience uncompromised performance, ready to ship directly to your door.</p>
                </div>
            </div>
        </div>
    </main>

    <!-- Category Content -->
    <form id="filter-form" method="GET" action="{{ route('prebuilt-pcs') }}" class="max-w-[1500px] mx-auto px-6 lg:px-8 pb-24 relative z-10 flex flex-col lg:flex-row gap-8">
        
        <!-- Product Filter Component -->
        <x-product-filter :counts="$counts" route="prebuilt-pcs" />

        <!-- Product Grid -->
        <div id="product-grid-area" class="flex-1 w-full lg:w-auto transition-opacity duration-300">
            
            <!-- Controls / Sort -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
                <p class="text-sm text-gray-400">Showing <span class="text-white font-bold">{{ $configs->count() }}</span> products</p>
                
                <div class="flex items-center gap-3 w-full sm:w-auto">
                    <span class="text-xs text-gray-500 uppercase tracking-widest font-bold">Sort By</span>
                    <div class="relative w-full sm:w-48">
                        <select name="sort" class="w-full bg-black/40 border border-[#3a1810] rounded-xl py-2 pl-4 pr-10 text-sm text-white appearance-none cursor-pointer hover:border-[#5a2810] transition-colors focus:outline-none focus:border-primary">
                            <option {{ request('sort') == 'Recommended' ? 'selected' : '' }}>Recommended</option>
                            <option {{ request('sort') == 'Price: Low to High' ? 'selected' : '' }}>Price: Low to High</option>
                            <option {{ request('sort') == 'Price: High to Low' ? 'selected' : '' }}>Price: High to Low</option>
                            <option {{ request('sort') == 'Newest Arrivals' ? 'selected' : '' }}>Newest Arrivals</option>
                            <option {{ request('sort') == 'Customer Reviews' ? 'selected' : '' }}>Customer Reviews</option>
                        </select>
                        <i class="ph ph-caret-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                    </div>
                </div>
            </div>

            <!-- Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
                
                @forelse($configs as $config)
                <!-- Product Card -->
                <div class="bg-gradient-to-b from-[#2a110a] to-[#140502] border border-[#3a1810] rounded-[2rem] p-4 relative overflow-hidden group hover:border-primary/50 transition-all duration-500 hover:shadow-[0_10px_30px_rgba(255,107,0,0.2)] flex flex-col h-full">
                    
                    <!-- Image -->
                    <div class="relative rounded-2xl overflow-hidden aspect-[4/3] mb-5 bg-[#0a0a0a]">
                        <img src="{{ $config->image_url }}" alt="{{ $config->name }}" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700 opacity-90 group-hover:opacity-100">
                    </div>

                    <div class="flex flex-col flex-1">
                        <!-- Product Name -->
                        <h3 class="text-lg font-bold text-white group-hover:text-primary transition-colors line-clamp-1 mb-3">{{ $config->name }}</h3>
                        
                        <!-- Product Parts/Peripherals -->
                        <div class="space-y-1.5 mb-4 text-xs">
                            <div class="flex items-center gap-2 text-gray-400"><i class="ph ph-cpu text-gray-500 text-sm shrink-0"></i> <span class="text-gray-300 truncate">{{ $config->cpu->name }}</span></div>
                            <div class="flex items-center gap-2 text-gray-400"><i class="ph ph-circuitry text-gray-500 text-sm shrink-0"></i> <span class="text-gray-300 truncate">{{ $config->motherboard->name }}</span></div>
                            <div class="flex items-center gap-2 text-gray-400"><i class="ph ph-graphics-card text-gray-500 text-sm shrink-0"></i> <span class="text-gray-300 truncate">{{ $config->gpu->name }}</span></div>
                            <div class="flex items-center gap-2 text-gray-400"><i class="ph ph-memory text-gray-500 text-sm shrink-0"></i> <span class="text-gray-300 truncate">{{ $config->ram->name }}</span></div>
                            <div class="flex items-center gap-2 text-gray-400"><i class="ph ph-hard-drives text-gray-500 text-sm shrink-0"></i> <span class="text-gray-300 truncate">{{ $config->storage->name }}</span></div>
                            <div class="flex items-center gap-2 text-gray-400"><i class="ph ph-plug text-gray-500 text-sm shrink-0"></i> <span class="text-gray-300 truncate">{{ $config->powerSupply->name }}</span></div>
                        </div>
                        
                        <!-- Divider -->
                        <hr class="border-white/10 my-4">
                        
                        <!-- Pricing & Action Button -->
                        <div class="mt-auto pt-2">
                            <div class="flex flex-col mb-4">
                                <span class="text-xl font-black text-white">P{{ number_format($config->price) }}</span>
                            </div>

                            <!-- Action Button -->
                            <a href="{{ route('build-overview', $config->id) }}" class="w-full py-2 rounded-full border border-primary text-primary hover:bg-primary hover:text-white font-bold transition-all duration-300 text-center flex items-center justify-center gap-2 text-sm">
                                <i class="ph-bold ph-eye"></i> View Details
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                    <div class="col-span-1 sm:col-span-2 xl:col-span-3 py-20 flex flex-col items-center justify-center text-center bg-black/20 rounded-[2rem] border border-white/5">
                        <i class="ph ph-magnifying-glass text-6xl text-gray-600 mb-6"></i>
                        <h3 class="text-2xl font-bold text-white mb-2">No configurations found</h3>
                    </div>
                @endforelse

            </div>
            
            @if($configs->isNotEmpty())
            <!-- Pagination -->
            <div class="mt-12 w-full">
                {{ $configs->links('pagination::tailwind') }}
            </div>
            @endif

        </div>
    </form>

    
    <!-- CTA Cards -->
    <div class="max-w-[1500px] mx-auto px-6 lg:px-8 pb-24 relative z-10 grid grid-cols-1 md:grid-cols-2 gap-8">
        <a href="{{ url('/custom-pcs') }}" class="block liquid-glass rounded-2xl p-8 border border-white/10 hover:border-primary/50 transition-all group overflow-hidden relative">
            <div class="absolute -right-10 -bottom-10 opacity-10 group-hover:opacity-20 group-hover:scale-110 transition-all duration-500">
                <i class="ph-fill ph-cpu text-[200px] text-white"></i>
            </div>
            <h3 class="text-2xl font-bold text-white mb-2">Can't find what you need?</h3>
            <p class="text-gray-400 mb-6">Choose from our curated selection of customizable builds.</p>
            <span class="inline-flex items-center gap-2 text-primary font-bold">Customize a PC <i class="ph-bold ph-arrow-right group-hover:translate-x-2 transition-transform"></i></span>
        </a>
        <a href="{{ url('/build-pc') }}" class="block liquid-glass rounded-2xl p-8 border border-white/10 hover:border-primary/50 transition-all group overflow-hidden relative">
            <div class="absolute -right-10 -bottom-10 opacity-10 group-hover:opacity-20 group-hover:scale-110 transition-all duration-500">
                <i class="ph-fill ph-hammer text-[200px] text-white"></i>
            </div>
            <h3 class="text-2xl font-bold text-white mb-2">Build from Scratch</h3>
            <p class="text-gray-400 mb-6">Use PC Forge to pick every single component yourself.</p>
            <span class="inline-flex items-center gap-2 text-primary font-bold">Launch PC Forge <i class="ph-bold ph-arrow-right group-hover:translate-x-2 transition-transform"></i></span>
        </a>
    </div>

    <x-footer />


    <!-- Preloader Script -->
    <script>
        window.addEventListener('load', () => {
            const preloader = document.getElementById('preloader');
            if (preloader) {
                if (!sessionStorage.getItem('techforge_visited')) {
                    sessionStorage.setItem('techforge_visited', 'true');
                    setTimeout(() => {
                        preloader.classList.add('opacity-0');
                        setTimeout(() => preloader.style.display = 'none', 1000); 
                    }, 1800);
                } else {
                    preloader.classList.add('opacity-0');
                    setTimeout(() => preloader.style.display = 'none', 1000);
                }
            }
        });
    </script>

    <!-- Custom Slider JS -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function initSliders() {
                const minInput = document.getElementById('price-min');
                const maxInput = document.getElementById('price-max');
                const rangeMin = document.getElementById('range-min');
                const rangeMax = document.getElementById('range-max');
                const track = document.getElementById('slider-track');

                if(!minInput || !maxInput || !rangeMin || !rangeMax || !track) return;

                function updateTrack() {
                    const min = parseInt(rangeMin.value);
                    const max = parseInt(rangeMax.value);
                    const maxAllowed = parseInt(rangeMin.max);
                    
                    const leftPercent = (min / maxAllowed) * 100;
                    const rightPercent = 100 - ((max / maxAllowed) * 100);
                    
                    track.style.left = leftPercent + '%';
                    track.style.right = rightPercent + '%';
                }

                // Initial setup
                updateTrack();

                rangeMin.addEventListener('input', function() {
                    const val = parseInt(this.value);
                    const maxVal = parseInt(rangeMax.value);
                    if (val >= maxVal) {
                        this.value = maxVal - 1000;
                    }
                    minInput.value = this.value;
                    updateTrack();
                });

                rangeMax.addEventListener('input', function() {
                    const val = parseInt(this.value);
                    const minVal = parseInt(rangeMin.value);
                    if (val <= minVal) {
                        this.value = minVal + 1000;
                    }
                    maxInput.value = this.value;
                    updateTrack();
                });

                minInput.addEventListener('change', function() {
                    let val = parseInt(this.value);
                    if(isNaN(val)) val = 0;
                    const maxVal = parseInt(rangeMax.value);
                    if(val > maxVal) val = maxVal - 1000;
                    rangeMin.value = val;
                    this.value = val;
                    updateTrack();
                });

                maxInput.addEventListener('change', function() {
                    let val = parseInt(this.value);
                    if(isNaN(val)) val = parseInt(rangeMax.max);
                    const minVal = parseInt(rangeMin.value);
                    if(val < minVal) val = minVal + 1000;
                    rangeMax.value = val;
                    this.value = val;
                    updateTrack();
                });

                // Dispatch event when sliding finishes so AJAX reloads
                rangeMin.addEventListener('change', () => minInput.dispatchEvent(new Event('change', { bubbles: true })));
                rangeMax.addEventListener('change', () => maxInput.dispatchEvent(new Event('change', { bubbles: true })));
            }

            initSliders();

            const form = document.getElementById('filter-form');
            if (form) {
                form.addEventListener('change', function(e) {
                    if (e.target.id && (e.target.id.endsWith('-accordion') || e.target.id.endsWith('-toggle'))) {
                        return;
                    }

                    // Save state of open accordions
                    const openAccordions = Array.from(document.querySelectorAll('input[type="checkbox"][id$="-accordion"]:checked')).map(el => el.id);

                    const formData = new FormData(this);
                    const params = new URLSearchParams(formData);
                    const url = this.action + '?' + params.toString();
                    
                    const gridArea = document.getElementById('product-grid-area');
                    if (gridArea) gridArea.style.opacity = '0.5';

                    fetch(url)
                        .then(response => response.text())
                        .then(html => {
                            const parser = new DOMParser();
                            const doc = parser.parseFromString(html, 'text/html');
                            
                            const newSidebar = doc.getElementById('filter-sidebar');
                            const newGrid = doc.getElementById('product-grid-area');
                            
                            if (newSidebar) {
                                document.getElementById('filter-sidebar').innerHTML = newSidebar.innerHTML;
                                
                                // Restore accordion states
                                openAccordions.forEach(id => {
                                    const el = document.getElementById(id);
                                    if (el) el.checked = true;
                                });
                                
                                initSliders();
                            }
                            if (newGrid) {
                                gridArea.innerHTML = newGrid.innerHTML;
                                gridArea.style.opacity = '1';
                            }
                            
                            window.history.pushState({}, '', url);
                        })
                        .catch(err => {
                            console.error('Filtering failed:', err);
                            if (gridArea) gridArea.style.opacity = '1';
                        });
                });
                
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                });
                
                // AJAX Pagination
                document.addEventListener('click', function(e) {
                    const paginationLink = e.target.closest('nav[role="navigation"] a');
                    if (paginationLink) {
                        e.preventDefault();
                        const url = paginationLink.href;
                        const gridArea = document.getElementById('product-grid-area');
                        
                        if (gridArea) gridArea.style.opacity = '0.5';

                        fetch(url)
                            .then(response => response.text())
                            .then(html => {
                                const parser = new DOMParser();
                                const doc = parser.parseFromString(html, 'text/html');
                                const newGrid = doc.getElementById('product-grid-area');
                                
                                if (newGrid) {
                                    gridArea.innerHTML = newGrid.innerHTML;
                                    gridArea.style.opacity = '1';
                                }
                                
                                window.history.pushState({}, '', url);
                                
                                // scroll to top of grid
                                window.scrollTo({
                                    top: gridArea.getBoundingClientRect().top + window.scrollY - 100,
                                    behavior: 'smooth'
                                });
                            })
                            .catch(err => {
                                console.error('Pagination failed:', err);
                                if (gridArea) gridArea.style.opacity = '1';
                            });
                    }
                });
            }
        });
    </script>

    <!-- Script for subtle interactive effects -->
    <script>
        document.addEventListener('mousemove', (e) => {
            const x = e.clientX / window.innerWidth;
            const y = e.clientY / window.innerHeight;
            
            const light1 = document.querySelector('.ambient-light-1');
            const light2 = document.querySelector('.ambient-light-2');
            
            if (light1 && light2) {
                light1.style.transform = `translate(${x * 20}px, ${y * 20}px)`;
                light2.style.transform = `translate(${x * -30}px, ${y * -30}px)`;
            }
        });
    </script>

    <!-- Load our compiled JavaScript (You can remove LiquidGlass initialization from inside this file) -->
    @vite(['resources/js/HomePage/Homepage.js', 'resources/js/Category/Category.js'])
</body>
</html>