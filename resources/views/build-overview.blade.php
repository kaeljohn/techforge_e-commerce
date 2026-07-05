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
        <!-- Product Selection Modal -->
    <div id="product-modal" class="fixed inset-0 bg-black/80 backdrop-blur-md z-[100] opacity-0 pointer-events-none transition-all duration-300 flex items-center justify-center p-4">
        <div class="liquid-glass-heavy w-full max-w-5xl max-h-[90vh] h-[800px] rounded-[2rem] border border-white/10 shadow-2xl flex flex-col transform scale-95 transition-transform duration-300 relative overflow-hidden bg-[#050505]">
            
            <!-- Modal Header -->
            <div class="px-8 py-6 border-b border-white/10 flex justify-between items-center bg-[#050505]/50 shrink-0">
                <div>
                    <h3 class="text-2xl font-black text-white" id="modal-title">Select Component</h3>
                </div>
                <button onclick="closeModal()" class="w-10 h-10 rounded-full bg-white/10 hover:bg-primary flex items-center justify-center text-white transition-all shadow-lg hover:shadow-[0_0_15px_rgba(255,107,0,0.5)]">
                    <i class="ph ph-x text-lg"></i>
                </button>
            </div>

            <!-- Modal Filters -->
            <div class="px-8 py-4 border-b border-white/10 bg-[#050505]/40 shrink-0 flex flex-col gap-4">
                <div class="flex flex-col sm:flex-row gap-4 items-center">
                    <div class="relative flex-1 w-full">
                        <i class="ph ph-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-gray-500"></i>
                        <input type="text" id="modal-search" placeholder="Search components..." class="w-full bg-white/5 border border-white/10 rounded-xl py-2 pl-10 pr-4 text-white text-sm focus:outline-none focus:border-primary transition-colors">
                    </div>
                    <div class="flex gap-2 w-full sm:w-auto">
                        <select id="modal-sort" class="bg-[#050505] border border-white/10 rounded-xl py-2 px-3 text-white text-sm focus:outline-none focus:border-primary">
                            <option value="name_asc">Name: A-Z</option>
                            <option value="price_asc">Price: Low to High</option>
                            <option value="price_desc">Price: High to Low</option>
                        </select>
                    </div>
                </div>
                <div class="flex flex-wrap gap-4 items-end" id="modal-dynamic-filters">
                    <div class="flex flex-col gap-1">
                        <label class="text-[10px] text-gray-500 uppercase font-bold tracking-wider">Price Range</label>
                        <div class="flex items-center gap-2">
                            <input type="number" id="modal-price-min" placeholder="Min" class="w-20 bg-white/5 border border-white/10 rounded-lg py-1.5 px-2 text-white text-xs focus:outline-none focus:border-primary">
                            <span class="text-gray-500">-</span>
                            <input type="number" id="modal-price-max" placeholder="Max" class="w-20 bg-white/5 border border-white/10 rounded-lg py-1.5 px-2 text-white text-xs focus:outline-none focus:border-primary">
                        </div>
                    </div>
                    <div class="ml-auto flex items-center gap-4">
                        <label class="flex items-center gap-2 cursor-pointer group">
                            <div class="relative">
                                <input type="checkbox" id="show-incompatible" class="sr-only">
                                <div class="block bg-white/10 border border-white/20 w-10 h-6 rounded-full group-hover:bg-white/20 transition-colors"></div>
                                <div class="dot absolute left-1 top-1 bg-gray-400 w-4 h-4 rounded-full transition-transform"></div>
                            </div>
                            <span class="text-xs font-bold text-gray-400 group-hover:text-white transition-colors">Show Incompatible</span>
                            <style>
                                #show-incompatible:checked ~ .dot { transform: translateX(100%); background-color: #ff6b00; }
                                    .visualizer-slot {
            transition: all 0.5s ease;
            opacity: 0.2;
            fill: #333;
            stroke: #555;
            cursor: pointer;
        }
        .visualizer-slot:hover {
            stroke: #ff6b00;
            fill: rgba(255, 107, 0, 0.2);
            opacity: 0.8;
        }
        .visualizer-slot.active {
            opacity: 1;
            fill: rgba(255, 107, 0, 0.2);
            stroke: #ff6b00;
            filter: drop-shadow(0 0 8px rgba(255, 107, 0, 0.6));
        }
    </style>
                        </label>
                        <button id="modal-reset-filters" class="text-xs text-gray-400 hover:text-white transition-colors flex items-center gap-1 py-1.5 px-2">
                            <i class="ph ph-arrow-counter-clockwise"></i> Reset
                        </button>
                    </div>
                </div>
            </div>

            <!-- Modal Content (Products List) -->
            <div class="p-8 overflow-y-auto custom-scrollbar flex-1 bg-[#050505]/30">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6" id="modal-products">
                    <!-- JavaScript will populate this -->
                </div>
            </div>
        </div>
    </div>
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
            .visualizer-slot {
            transition: all 0.5s ease;
            opacity: 0.2;
            fill: #333;
            stroke: #555;
            cursor: pointer;
        }
        .visualizer-slot:hover {
            stroke: #ff6b00;
            fill: rgba(255, 107, 0, 0.2);
            opacity: 0.8;
        }
        .visualizer-slot.active {
            opacity: 1;
            fill: rgba(255, 107, 0, 0.2);
            stroke: #ff6b00;
            filter: drop-shadow(0 0 8px rgba(255, 107, 0, 0.6));
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


    <main class="flex-grow container mx-auto px-4 pt-32 pb-16 lg:pt-40 lg:pb-20 relative z-10">
        <div class="flex flex-col lg:flex-row gap-12 max-w-6xl mx-auto">
            
            <!-- Left Column: Visuals -->
            <div class="w-full lg:w-5/12 flex flex-col items-center">
                <!-- PC Image Container -->
                <div class="relative w-full flex items-center justify-center mb-8">
                    <svg class="w-full max-w-lg h-auto font-sans" viewBox="0 0 400 500" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <!-- Case Outline -->
                        <g onclick="openModal('Case')" class="cursor-pointer group">
                            <rect id="vis-case" class="visualizer-slot" x="20" y="20" width="360" height="460" rx="20" stroke="rgba(255,255,255,0.1)" stroke-width="4" fill="rgba(255,255,255,0.02)"/>
                            <rect x="30" y="30" width="340" height="440" rx="10" stroke="rgba(255,255,255,0.05)" stroke-width="2"/>
                            <text x="200" y="470" fill="rgba(255,255,255,0.2)" text-anchor="middle" font-size="10" font-weight="bold" class="group-hover:fill-primary transition-colors">CASE</text>
                        </g>
                        
                        <!-- Motherboard Area -->
                        <g onclick="openModal('Motherboard')" class="cursor-pointer group">
                            <rect id="vis-motherboard" class="visualizer-slot" x="40" y="40" width="260" height="300" rx="4"/>
                            <text x="170" y="65" fill="rgba(255,255,255,0.2)" text-anchor="middle" font-size="12" font-weight="bold" letter-spacing="2" class="group-hover:fill-primary transition-colors pointer-events-none">MOTHERBOARD</text>
                        </g>
                        
                        <!-- CPU Area -->
                        <g onclick="openModal('Processor')" class="cursor-pointer group">
                            <rect id="vis-cpu" class="visualizer-slot" x="140" y="100" width="60" height="60" rx="4"/>
                            <circle id="vis-cooler" class="visualizer-slot" cx="170" cy="130" r="40"/>
                            <text x="170" y="134" fill="rgba(255,255,255,0.4)" text-anchor="middle" font-size="10" font-weight="bold" class="group-hover:fill-primary transition-colors pointer-events-none">CPU</text>
                        </g>
                        
                        <!-- RAM -->
                        <g onclick="openModal('Memory')" class="cursor-pointer group">
                            <rect id="vis-memory" class="visualizer-slot" x="220" y="90" width="10" height="80" rx="2"/>
                            <rect id="vis-memory-2" class="visualizer-slot" x="240" y="90" width="10" height="80" rx="2"/>
                            <text x="235" y="80" fill="rgba(255,255,255,0.4)" text-anchor="middle" font-size="10" font-weight="bold" class="group-hover:fill-primary transition-colors">RAM</text>
                        </g>
                        
                        <!-- GPU -->
                        <g onclick="openModal('Video Card')" class="cursor-pointer group">
                            <rect id="vis-gpu" class="visualizer-slot" x="40" y="220" width="240" height="50" rx="4"/>
                            <text x="160" y="249" fill="rgba(255,255,255,0.4)" text-anchor="middle" font-size="12" font-weight="bold" letter-spacing="1" class="group-hover:fill-primary transition-colors pointer-events-none">GRAPHICS CARD</text>
                        </g>
                        
                        <!-- Storage NVMe -->
                        <g onclick="openModal('Primary Storage')" class="cursor-pointer group">
                            <rect id="vis-ssd" class="visualizer-slot" x="140" y="280" width="60" height="15" rx="2"/>
                            <text x="170" y="310" fill="rgba(255,255,255,0.4)" text-anchor="middle" font-size="10" font-weight="bold" class="group-hover:fill-primary transition-colors">SSD</text>
                        </g>
                        
                        <!-- PSU -->
                        <g onclick="openModal('Power Supply')" class="cursor-pointer group">
                            <rect id="vis-psu" class="visualizer-slot" x="40" y="370" width="120" height="90" rx="4"/>
                            <text x="100" y="419" fill="rgba(255,255,255,0.4)" text-anchor="middle" font-size="12" font-weight="bold" letter-spacing="1" class="group-hover:fill-primary transition-colors pointer-events-none">POWER</text>
                        </g>
                    </svg>
                </div>

            </div>
            <!-- Right Column: Details & Specs -->
            <div class="w-full lg:w-7/12 flex flex-col">
                <!-- Header -->
                <div class="mb-8 border-b border-white/10 pb-6">
                    <h1 class="text-4xl lg:text-5xl font-black text-white mb-4">{{ $product->name }}</h1>
                    
                    <div class="flex items-center justify-between flex-wrap gap-4">
                        <!-- Rating -->
                        <div class="flex items-center gap-1 text-primary">
                            @for($i = 0; $i < 5; $i++)
                                <i class="ph-fill ph-star {{ $i < floor($product->rating) ? '' : 'text-gray-600' }}"></i>
                            @endfor
                            <span class="text-white font-bold ml-2">{{ $product->rating }}</span>
                        </div>
                        
                        <!-- Price & CTA -->
                        <div class="flex items-center gap-6">
                            <div class="text-right">
                                @if($product->original_price && $product->original_price > $product->price)
                                    <div class="text-sm text-gray-500 line-through">P{{ number_format($product->original_price) }}</div>
                                @endif
                                <div class="text-3xl font-black text-white">P{{ number_format($product->price) }}</div>
                            </div>
                            <button onclick="addToCart()" type="button" class="bg-primary hover:bg-primary-dark text-white px-8 py-3 rounded-xl font-bold uppercase tracking-widest transition-all hover:scale-105 hover:shadow-[0_0_20px_rgba(255,107,0,0.4)] flex items-center gap-2">
                                <i class="ph-bold ph-shopping-cart"></i> Add to Cart
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Specs List -->
                <div class="flex-grow">
                    <h2 class="text-lg font-bold text-white uppercase tracking-widest mb-6 flex items-center gap-2">
                        <i class="ph-bold ph-list-dashes text-primary"></i> Core Components
                    </h2>

                    @php
                        // Map specs to nice icons and labels
                        $specs = [
                            ['label' => 'Operating System', 'value' => $product->os ?? 'Windows 11 Home', 'icon' => 'ph-windows-logo'],
                            ['label' => 'Case', 'value' => $product->pcCase->name ?? 'TechForge Standard Case', 'icon' => 'ph-computer-tower'],
                            ['label' => 'Processor', 'value' => $product->cpu->name ?? 'N/A', 'icon' => 'ph-cpu'],
                            ['label' => 'Video Card', 'value' => $product->gpu->name ?? 'N/A', 'icon' => 'ph-graphics-card'],
                            ['label' => 'Memory', 'value' => $product->ram->name ?? 'N/A', 'icon' => 'ph-memory'],
                            ['label' => 'Primary Storage', 'value' => $product->storage->name ?? 'N/A', 'icon' => 'ph-hard-drives'],
                            ['label' => 'Power Supply', 'value' => $product->powerSupply->name ?? 'N/A', 'icon' => 'ph-plug'],
                            ['label' => 'Motherboard', 'value' => $product->motherboard->name ?? 'N/A', 'icon' => 'ph-circuitry'],
                            ['label' => 'Cooling', 'value' => $product->cooler ?? 'Standard Air Cooler', 'icon' => 'ph-fan'],
                            ['label' => 'Warranty', 'value' => '3 Year Standard Warranty (Labor + Parts)', 'icon' => 'ph-shield-check', 'no_edit' => true],
                        ];
                        
                        $editUrl = route('build-pc', [
                            'cpu' => $product->cpu->name ?? null, 
                            'gpu' => $product->gpu->name ?? null, 
                            'ram' => $product->ram->name ?? null, 
                            'storage' => $product->storage->name ?? null, 
                            'motherboard' => $product->motherboard->name ?? null, 
                            'psu' => $product->powerSupply->name ?? null, 
                            'case' => $product->pcCase->name ?? null, 
                            'cooler' => $product->cooler ?? null
                        ]);
                    @endphp

                    <div class="space-y-4" id="specs-list">
                        @foreach($specs as $spec)
                        <div class="group flex items-center justify-between p-5 rounded-2xl hover:bg-white/5 transition-colors border border-transparent hover:border-white/10">
                            <div class="flex items-center gap-6 w-full max-w-[70%]">
                                <div class="w-32 shrink-0 flex items-center gap-2">
                                    <i class="{{ $spec['icon'] }} text-gray-500 text-lg group-hover:text-primary transition-colors"></i>
                                    <span class="text-xs font-bold text-gray-400 uppercase">{{ $spec['label'] }}</span>
                                </div>
                                <div class="text-sm font-bold text-gray-200 truncate group-hover:text-white transition-colors">
                                    {{ $spec['value'] }}
                                </div>
                            </div>
                            
                            @if(!isset($spec['no_edit']))
                            <button onclick="openModal('{{ $spec['label'] }}')" type="button" class="text-xs font-bold text-primary opacity-0 group-hover:opacity-100 transition-opacity hover:underline">
                                Edit
                            </button>
                            @else
                            <button class="text-xs font-bold text-gray-600 cursor-not-allowed">
                                Info
                            </button>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
        
    </main>

    <x-footer />

        <script src="{{ asset('js/configurator-engine.js') }}"></script>
    <script>
        const allComponents = @json($allComponents);
        
        const initialBuild = {
            'Processor': @json($product->cpu),
            'Video Card': @json($product->gpu),
            'Memory': @json($product->ram),
            'Primary Storage': @json($product->storage),
            'Motherboard': @json($product->motherboard),
            'Power Supply': @json($product->powerSupply),
            'Case': @json($product->pcCase)
        };

        const engine = new ConfiguratorEngine(allComponents, initialBuild);
        setTimeout(() => updateVisualizer(initialBuild), 100);
        
        let currentCategory = '';
        
        const typeMapping = {
            'Processor': 'Processor',
            'Video Card': 'Video Card',
            'Memory': 'Memory',
            'Primary Storage': 'Storage',
            'Motherboard': 'Motherboard',
            'Power Supply': 'Power Supply',
            'Case': 'Case'
        };

        let availableComponents = [];

        // UI Updates
        const updateVisualizer = (build) => {
            document.querySelectorAll('.visualizer-slot').forEach(el => el.classList.remove('active'));
            
            const mapping = {
                'Processor': ['vis-cpu', 'vis-cooler'],
                'Motherboard': ['vis-motherboard'],
                'Memory': ['vis-memory', 'vis-memory-2'],
                'Video Card': ['vis-gpu'],
                'Primary Storage': ['vis-ssd'],
                'Power Supply': ['vis-psu'],
                'Case': ['vis-case']
            };

            Object.keys(build).forEach(cat => {
                if(build[cat] && mapping[cat]) {
                    mapping[cat].forEach(id => {
                        const el = document.getElementById(id);
                        if(el) el.classList.add('active');
                    });
                }
            });
        };

        engine.subscribe((build) => {
            updateVisualizer(build);
            updatePriceUI();
            
            // Sync all labels
            Object.keys(build).forEach(category => {
                const component = build[category];
                updateUIText(category, component ? component.name : 'Select ' + category);
            });
        });

        function renderModalProducts() {
            const list = document.getElementById('modal-products');
            const search = document.getElementById('modal-search').value.toLowerCase();
            const sort = document.getElementById('modal-sort').value;
            const pMin = parseFloat(document.getElementById('modal-price-min').value) || 0;
            const pMax = parseFloat(document.getElementById('modal-price-max').value) || Infinity;
            const showIncompatible = document.getElementById('show-incompatible').checked;
            
            let filtered = availableComponents.filter(c => {
                const matchName = c.name.toLowerCase().includes(search);
                const matchPrice = c.price >= pMin && c.price <= pMax;
                return matchName && matchPrice;
            });
            
            if (sort === 'name_asc') filtered.sort((a,b) => a.name.localeCompare(b.name));
            if (sort === 'price_asc') filtered.sort((a,b) => a.price - b.price);
            if (sort === 'price_desc') filtered.sort((a,b) => b.price - a.price);

            const processed = filtered.map(c => {
                const compatibility = engine.checkCompatibility(c, currentCategory);
                return { ...c, compatible: compatibility.compatible, reason: compatibility.reason };
            });

            const finalDisplay = processed.filter(c => showIncompatible || c.compatible);

            list.innerHTML = '';
            if (finalDisplay.length === 0) {
                list.innerHTML = '<div class="col-span-full text-center py-12"><i class="ph ph-magnifying-glass text-4xl text-gray-600 mb-2"></i><p class="text-gray-500">No components found.</p></div>';
            } else {
                finalDisplay.forEach(c => {
                    const currentComp = engine.getComponent(currentCategory);
                    const isSelected = currentComp && currentComp.id === c.id;
                    const onClick = isSelected ? '' : `onclick="selectComponent(${c.id})"`;
                    
                    const imgUrl = c.image_url || 'https://via.placeholder.com/300x200/111/333?text=' + c.type;
                    const opacityClass = !c.compatible ? 'opacity-50 grayscale pointer-events-none' : '';
                    const borderClass = isSelected ? 'border-primary shadow-[0_0_15px_rgba(255,107,0,0.3)]' : 'border-white/5 hover:border-white/20 cursor-pointer';

                    list.innerHTML += `
                        <div class="liquid-glass p-4 rounded-2xl border ${borderClass} ${opacityClass} flex flex-col transition-all group relative" ${c.compatible ? onClick : ''}>
                            <div class="w-full h-32 mb-4 bg-white/5 rounded-xl flex items-center justify-center p-2">
                                <img src="${imgUrl}" class="max-h-full max-w-full object-contain group-hover:scale-110 transition-transform duration-300">
                            </div>
                            <h4 class="font-bold text-white text-sm mb-2 leading-tight">${c.name}</h4>
                            <div class="mt-auto flex justify-between items-end">
                                <p class="text-primary font-black">P${parseFloat(c.price).toLocaleString()}</p>
                                ${isSelected ? '<div class="bg-primary text-white text-[10px] font-bold px-2 py-1 rounded uppercase tracking-widest">Selected</div>' : ''}
                            </div>
                            ${!c.compatible ? `<div class="absolute top-2 right-2 bg-red-500/90 text-white text-[9px] font-black uppercase tracking-wider px-2 py-1 rounded shadow-lg backdrop-blur-sm z-10">${c.reason}</div>` : ''}
                        </div>
                    `;
                });
            }
        }

        function openModal(label) {
            const dbType = typeMapping[label];
            const modal = document.getElementById('product-modal');
            const box = modal.querySelector('.liquid-glass-heavy');
            const title = document.getElementById('modal-title');
            
            if(!dbType) {
                alert('No alternative parts available for ' + label);
                return;
            }
            
            currentCategory = label;
            title.innerText = 'Select ' + label;
            
            availableComponents = allComponents.filter(c => c.type === dbType);
            
            document.getElementById('modal-search').value = '';
            document.getElementById('modal-sort').value = 'name_asc';
            document.getElementById('modal-price-min').value = '';
            document.getElementById('modal-price-max').value = '';

            renderModalProducts();
            
            modal.classList.remove('opacity-0', 'pointer-events-none');
            box.classList.remove('scale-95');
        }

        function closeModal() {
            const modal = document.getElementById('product-modal');
            const box = modal.querySelector('.liquid-glass-heavy');
            modal.classList.add('opacity-0', 'pointer-events-none');
            box.classList.add('scale-95');
        }

        document.getElementById('modal-search').addEventListener('input', renderModalProducts);
        document.getElementById('modal-sort').addEventListener('change', renderModalProducts);
        document.getElementById('modal-price-min').addEventListener('input', renderModalProducts);
        document.getElementById('modal-price-max').addEventListener('input', renderModalProducts);
        document.getElementById('show-incompatible').addEventListener('change', renderModalProducts);
        document.getElementById('modal-reset-filters').addEventListener('click', () => {
            document.getElementById('modal-search').value = '';
            document.getElementById('modal-sort').value = 'name_asc';
            document.getElementById('modal-price-min').value = '';
            document.getElementById('modal-price-max').value = '';
            document.getElementById('show-incompatible').checked = false;
            renderModalProducts();
        });

        function updatePriceUI() {
            const total = engine.calculateTotal();
            document.querySelector('.text-3xl.font-black.text-white').innerText = 'P' + total.toLocaleString();
        }

        function updateUIText(category, text) {
            const specsList = document.getElementById('specs-list');
            const rows = specsList.querySelectorAll('.group');
            rows.forEach(row => {
                const labelEl = row.querySelector('.text-xs.font-bold.text-gray-400');
                if (labelEl && labelEl.innerText.toLowerCase() === category.toLowerCase()) {
                    const valueEl = row.querySelector('.text-sm.font-bold.text-gray-200');
                    if (valueEl) valueEl.innerText = text;
                }
            });
        }

        function addToCart() {
            const currentBuild = engine.currentBuild;
            const missing = Object.entries(currentBuild).filter(([k,v]) => v === null);
            if (missing.length > 0) {
                alert("Please select components for: " + missing.map(m => m[0]).join(', '));
                return;
            }

            const btn = document.querySelector('button[onclick="addToCart()"]');
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="ph ph-spinner animate-spin"></i> Adding...';
            btn.disabled = true;

            const formData = new FormData();
            formData.append('product_id', 'custom_' + Date.now());
            formData.append('name', 'Custom ' + '{{ $product->name }}');
            formData.append('price', engine.calculateTotal());
            formData.append('image_url', '{{ $product->image_url }}');
            formData.append('quantity', 1);
            formData.append('configuration', engine.getCartPayload());

            fetch('{{ route("cart.add") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if(data.success) {
                    btn.innerHTML = '<i class="ph-bold ph-check"></i> Added';
                    setTimeout(() => {
                        btn.innerHTML = originalText;
                        btn.disabled = false;
                        const badge = document.querySelector('#cart-btn span');
                        if (badge) {
                            badge.classList.remove('hidden');
                            badge.classList.add('flex');
                            badge.innerText = data.cart_count;
                        }
                    }, 2000);
                }
            });
        }

        function selectComponent(id) {
            const component = availableComponents.find(c => c.id === id);
            
            const conflicts = engine.getConflictsIfSelected(currentCategory, component);
            
            if (conflicts.length > 0) {
                let msg = "Changing this component will require changing your " + conflicts.join(', ') + ". Proceed?";
                if(!confirm(msg)) {
                    return;
                }
                conflicts.forEach(cat => engine.removeComponent(cat));
            }
            
            engine.setComponent(currentCategory, component);
            closeModal();
        }

        window.addEventListener('load', function() {
            const preloader = document.getElementById('preloader');
            if (preloader) {
                preloader.style.opacity = '0';
                setTimeout(() => {
                    preloader.style.display = 'none';
                }, 1000);
            }
        });
    </script>
    @vite('resources/js/HomePage/Homepage.js')
    
    <!-- Lenis Smooth Scroll -->
    <script src="https://unpkg.com/@studio-freight/lenis@1.0.39/dist/lenis.min.js"></script>
    <script>
        const lenis = new Lenis({
            duration: 1.2,
            easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
            direction: 'vertical',
            gestureDirection: 'vertical',
            smooth: true,
            mouseMultiplier: 1,
            smoothTouch: false,
            touchMultiplier: 2,
            infinite: false,
        });
        function raf(time) {
            lenis.raf(time);
            requestAnimationFrame(raf);
        }
        requestAnimationFrame(raf);
    </script>
</body>
</html>
