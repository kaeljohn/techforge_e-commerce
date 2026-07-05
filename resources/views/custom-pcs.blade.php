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
                document.write(`
                    <div class="w-16 h-16 border-4 border-white/10 border-t-primary rounded-full animate-spin shadow-[0_0_20px_rgba(255,107,0,0.3)]"></div>
                `);
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
                <img src="https://images.unsplash.com/photo-1547082299-de196ea013d6?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" alt="Custom PCs" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700 opacity-40">
                <div class="absolute inset-0 bg-gradient-to-r from-[#050505] via-transparent to-[#050505] pointer-events-none"></div>
            </div>
            
            <div class="max-w-[1500px] mx-auto px-6 lg:px-8 relative z-10 py-16 md:py-24">
                <div class="w-full md:w-2/3">
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black text-white tracking-wide mb-4">Custom PCs</h1>
                    <p class="text-gray-400 text-sm md:text-base leading-relaxed max-w-lg">Discover our meticulously curated tiers of custom-built performance machines, engineered specifically for your needs.</p>
                </div>
            </div>
        </div>
    </main>

    <!-- Category Content -->
    <main class="max-w-[1500px] mx-auto px-4 lg:px-8 pb-32 relative z-10">
        
        <!-- Platform Toggle Tabs -->
        <div class="flex justify-center mb-12">
            <div class="inline-flex bg-white/5 rounded-full p-1 border border-white/10" id="platform-tabs">
                <button onclick="switchPlatform('All')" class="tab-btn active px-8 py-2.5 rounded-full text-sm font-bold transition-all bg-primary text-white shadow-[0_0_15px_rgba(255,107,0,0.4)]">All</button>
                <button onclick="switchPlatform('AMD')" class="tab-btn px-8 py-2.5 rounded-full text-sm font-bold text-gray-400 hover:text-white transition-all">AMD</button>
                <button onclick="switchPlatform('Intel')" class="tab-btn px-8 py-2.5 rounded-full text-sm font-bold text-gray-400 hover:text-white transition-all">Intel</button>
            </div>
        </div>

        <div id="configs-container" class="grid grid-cols-1 lg:grid-cols-3 gap-6 xl:gap-10">
            @foreach($tiers as $tier)
            <div class="tier-group">
                <div class="flex items-center justify-center gap-4 mb-6">
                    <div class="h-px bg-white/10 flex-1"></div>
                    <h2 class="text-xl font-black text-white uppercase tracking-widest flex items-center gap-2">
                        <i class="ph {{ $tier == 'Enthusiast' ? 'ph-rocket text-primary' : ($tier == 'Mainstream' ? 'ph-lightning text-primary' : 'ph-game-controller text-primary') }} text-2xl"></i> 
                        {{ $tier }}
                    </h2>
                    <div class="h-px bg-white/10 flex-1"></div>
                </div>

                <div class="flex flex-col gap-4">
                    @foreach($configs->where('tier', $tier) as $config)
                    <div class="config-card w-full liquid-glass rounded-2xl p-5 border border-white/10 flex flex-col group hover:border-primary/50 transition-all duration-300" data-platform="{{ $config->platform }}">
                        <div class="mb-4 flex justify-between items-center">
                            <div>
                                <span class="text-[9px] text-primary font-bold uppercase tracking-widest">{{ $config->platform }} BUILD</span>
                                <h3 class="text-lg font-bold text-white leading-tight mt-0.5">{{ $config->name }}</h3>
                            </div>
                            <div class="w-8 h-8 rounded-full bg-white/5 flex items-center justify-center border border-white/10 shrink-0">
                                <img src="{{ Vite::asset('resources/img/'.strtolower($config->platform).'_logo.png') }}" alt="{{ $config->platform }}" class="w-4 h-4 object-contain opacity-50 group-hover:opacity-100 transition-opacity" onerror="this.style.display='none'">
                            </div>
                        </div>
                        
                        <div class="aspect-[16/9] w-full rounded-xl bg-black/40 mb-4 flex items-center justify-center p-2 border border-white/5 overflow-hidden">
                            <img src="{{ $config->image_url }}" alt="{{ $config->name }}" class="max-w-full max-h-full object-contain group-hover:scale-110 transition-transform duration-500">
                        </div>

                        <div class="space-y-2 mb-5">
                            <div class="flex items-center gap-2 text-[11px]">
                                <i class="ph ph-cpu text-gray-500 text-sm"></i>
                                <span class="text-gray-300 truncate">{{ $config->cpu->name }}</span>
                            </div>
                            <div class="flex items-center gap-2 text-[11px]">
                                <i class="ph ph-graphics-card text-gray-500 text-sm"></i>
                                <span class="text-gray-300 truncate">{{ $config->gpu->name }}</span>
                            </div>
                            <div class="flex items-center gap-2 text-[11px]">
                                <i class="ph ph-memory text-gray-500 text-sm"></i>
                                <span class="text-gray-300 truncate">{{ $config->ram->name ?? 'N/A' }}</span>
                            </div>
                            <div class="flex items-center gap-2 text-[11px]">
                                <i class="ph ph-hard-drives text-gray-500 text-sm"></i>
                                <span class="text-gray-300 truncate">{{ $config->storage->name ?? 'N/A' }}</span>
                            </div>
                        </div>

                        <div class="mt-auto pt-4 border-t border-white/10 flex items-center justify-between">
                            <div>
                                <span class="text-[9px] text-gray-500 uppercase tracking-widest block mb-0.5">Starting at</span>
                                <span class="text-xl font-black text-white">P{{ number_format($config->price) }}</span>
                            </div>
                            <a href="{{ route('build-overview', ['id' => $config->id, 'type' => 'custom']) }}" class="w-10 h-10 rounded-xl bg-primary text-white flex items-center justify-center hover:bg-white hover:text-black hover:scale-110 transition-all shadow-[0_0_10px_rgba(255,107,0,0.4)]">
                                <i class="ph-bold ph-arrow-right text-lg"></i>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </main>

    <script>
        function switchPlatform(platform) {
            // Update tabs
            document.querySelectorAll('.tab-btn').forEach(btn => {
                if (btn.innerText.trim() === platform) {
                    btn.classList.add('bg-primary', 'text-white', 'shadow-[0_0_15px_rgba(255,107,0,0.4)]');
                    btn.classList.remove('text-gray-400');
                } else {
                    btn.classList.remove('bg-primary', 'text-white', 'shadow-[0_0_15px_rgba(255,107,0,0.4)]');
                    btn.classList.add('text-gray-400');
                }
            });

            // Update cards
            document.querySelectorAll('.config-card').forEach(card => {
                if (platform === 'All' || card.dataset.platform === platform) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        }
    </script>

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