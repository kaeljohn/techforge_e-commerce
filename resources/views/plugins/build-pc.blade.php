<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <title>{{ config('app.name', 'TechForge') }} | Custom PC Builder</title>
    
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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

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
            background: radial-gradient(circle, rgba(255, 107, 0, 0.25) 0%, rgba(255, 107, 0, 0) 65%);
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
            background: radial-gradient(circle, rgba(153, 0, 0, 0.3) 0%, rgba(153, 0, 0, 0) 65%);
            z-index: -1;
            pointer-events: none;
            animation: floatPulse2 25s ease-in-out infinite;
        }

        @keyframes floatPulse1 {
            0% { opacity: 0.3; transform: translate(0, 0) scale(0.8); }
            33% { opacity: 0.8; transform: translate(25vw, 15vh) scale(1.2); }
            66% { opacity: 0.4; transform: translate(-10vw, 30vh) scale(0.9); }
            100% { opacity: 0.3; transform: translate(0, 0) scale(0.8); }
        }

        @keyframes floatPulse2 {
            0% { opacity: 0.8; transform: translate(0, 0) scale(1.1); }
            33% { opacity: 0.3; transform: translate(-25vw, -15vh) scale(0.8); }
            66% { opacity: 0.7; transform: translate(15vw, -25vh) scale(1.3); }
            100% { opacity: 0.8; transform: translate(0, 0) scale(1.1); }
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #333; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #ff6b00; }

        /* PC Builder Styles */
        .component-slot {
            transition: all 0.3s ease;
        }
        .component-slot:hover {
            border-color: rgba(255, 107, 0, 0.4);
            background-color: rgba(255, 255, 255, 0.03);
            box-shadow: 0 5px 15px rgba(255, 107, 0, 0.1);
        }

        .step-dot.active {
            background-color: #ff6b00;
            border-color: #ff6b00;
            box-shadow: 0 0 10px rgba(255, 107, 0, 0.5);
            color: white;
        }
        .step-dot.completed {
            background-color: rgba(255, 107, 0, 0.2);
            border-color: #ff6b00;
            color: #ff6b00;
        }
        
        .visualizer-slot {
            transition: all 0.5s ease;
            opacity: 0.2;
            fill: #333;
            stroke: #555;
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


    <!-- Main Builder Section -->
    <main class="relative pt-24 pb-10 lg:pt-32 lg:pb-16 overflow-hidden min-h-screen z-10">
        <div class="max-w-[1600px] mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Header & Steps -->
            <div class="mb-6 liquid-glass-heavy rounded-3xl px-6 py-4 border border-white/10 shadow-xl">
                <!-- Budget -->
                <div class="w-full mb-8 max-w-4xl mx-auto">
                    <div class="flex justify-between text-xs text-gray-400 mb-2 font-bold uppercase tracking-widest">
                        <span>Budget</span>
                        <span><span id="budget-current" class="text-primary font-black">P0</span> / <span id="budget-max">P200,000</span></span>
                    </div>
                    <div class="w-full h-1.5 bg-white/10 rounded-full overflow-hidden">
                        <div id="budget-bar" class="h-full bg-primary transition-all duration-500 w-0"></div>
                    </div>
                </div>

                <!-- Steps -->
                <div class="flex items-center justify-between max-w-4xl mx-auto overflow-x-auto custom-scrollbar pb-2 relative">
                    <div class="absolute top-4 left-0 w-full h-[1px] bg-white/10 -z-10"></div>
                    
                    <div class="flex flex-col items-center gap-2 group z-10" id="step-1">
                        <div class="w-8 h-8 rounded-full border-2 border-primary bg-primary text-white flex items-center justify-center text-xs font-bold step-dot active">1</div>
                        <span class="text-[10px] text-white font-bold uppercase tracking-wider step-text">Core</span>
                    </div>
                    <div class="flex flex-col items-center gap-2 group z-10" id="step-2">
                        <div class="w-8 h-8 rounded-full border-2 border-white/20 bg-black text-gray-400 flex items-center justify-center text-xs font-bold step-dot">2</div>
                        <span class="text-[10px] text-gray-500 font-bold uppercase tracking-wider step-text">Memory</span>
                    </div>
                    <div class="flex flex-col items-center gap-2 group z-10" id="step-3">
                        <div class="w-8 h-8 rounded-full border-2 border-white/20 bg-black text-gray-400 flex items-center justify-center text-xs font-bold step-dot">3</div>
                        <span class="text-[10px] text-gray-500 font-bold uppercase tracking-wider step-text">Storage</span>
                    </div>
                    <div class="flex flex-col items-center gap-2 group z-10" id="step-4">
                        <div class="w-8 h-8 rounded-full border-2 border-white/20 bg-black text-gray-400 flex items-center justify-center text-xs font-bold step-dot">4</div>
                        <span class="text-[10px] text-gray-500 font-bold uppercase tracking-wider step-text">Graphics</span>
                    </div>
                    <div class="flex flex-col items-center gap-2 group z-10" id="step-5">
                        <div class="w-8 h-8 rounded-full border-2 border-white/20 bg-black text-gray-400 flex items-center justify-center text-xs font-bold step-dot">5</div>
                        <span class="text-[10px] text-gray-500 font-bold uppercase tracking-wider step-text">Power</span>
                    </div>
                    <div class="flex flex-col items-center gap-2 group z-10" id="step-6">
                        <div class="w-8 h-8 rounded-full border-2 border-white/20 bg-black text-gray-400 flex items-center justify-center text-xs font-bold step-dot">6</div>
                        <span class="text-[10px] text-gray-500 font-bold uppercase tracking-wider step-text">Case</span>
                    </div>
                    <div class="flex flex-col items-center gap-2 group z-10" id="step-7">
                        <div class="w-8 h-8 rounded-full border-2 border-white/20 bg-black text-gray-400 flex items-center justify-center text-xs font-bold step-dot">7</div>
                        <span class="text-[10px] text-gray-500 font-bold uppercase tracking-wider step-text">Cooling</span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 xl:grid-cols-4 gap-6 items-start">
                
                <!-- Left Column: Components List -->
                <div class="xl:col-span-1 space-y-4" id="components-list">
                    <!-- JavaScript will inject component groups here -->
                </div>

                <!-- Center Column: Visualizer -->
                <div class="xl:col-span-2 relative z-20 flex flex-col gap-6">
                    <div class="liquid-glass-heavy rounded-3xl p-4 lg:p-6 border border-white/10 shadow-2xl flex items-center justify-center min-h-[450px] lg:min-h-[500px] relative overflow-hidden bg-black/40">
                        <!-- Abstract Glassmorphic PC Case Visualizer -->
                        <svg class="w-full max-w-lg h-auto font-sans" viewBox="0 0 400 500" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <!-- Case Outline -->
                            <rect x="20" y="20" width="360" height="460" rx="20" stroke="rgba(255,255,255,0.1)" stroke-width="4" fill="rgba(255,255,255,0.02)"/>
                            <rect x="30" y="30" width="340" height="440" rx="10" stroke="rgba(255,255,255,0.05)" stroke-width="2"/>
                            
                            <!-- Motherboard Area -->
                            <rect id="vis-motherboard" class="visualizer-slot" x="40" y="40" width="260" height="300" rx="4"/>
                            <text x="170" y="65" fill="rgba(255,255,255,0.2)" text-anchor="middle" font-size="12" font-weight="bold" letter-spacing="2">MOTHERBOARD</text>
                            
                            <!-- CPU/Cooler -->
                            <rect id="vis-cpu" class="visualizer-slot" x="140" y="100" width="60" height="60" rx="4"/>
                            <circle id="vis-cooler" class="visualizer-slot" cx="170" cy="130" r="40"/>
                            <text x="170" y="134" fill="rgba(255,255,255,0.4)" text-anchor="middle" font-size="10" font-weight="bold">CPU</text>
                            
                            <!-- RAM -->
                            <rect id="vis-memory" class="visualizer-slot" x="220" y="90" width="10" height="80" rx="2"/>
                            <rect id="vis-memory-2" class="visualizer-slot" x="240" y="90" width="10" height="80" rx="2"/>
                            <text x="235" y="80" fill="rgba(255,255,255,0.4)" text-anchor="middle" font-size="10" font-weight="bold">RAM</text>
                            
                            <!-- GPU -->
                            <rect id="vis-gpu" class="visualizer-slot" x="40" y="220" width="240" height="50" rx="4"/>
                            <text x="160" y="249" fill="rgba(255,255,255,0.4)" text-anchor="middle" font-size="12" font-weight="bold" letter-spacing="1">GRAPHICS CARD</text>
                            
                            <!-- Storage NVMe -->
                            <rect id="vis-ssd" class="visualizer-slot" x="140" y="280" width="60" height="15" rx="2"/>
                            <text x="170" y="310" fill="rgba(255,255,255,0.4)" text-anchor="middle" font-size="10" font-weight="bold">SSD</text>
                            
                            <!-- PSU -->
                            <rect id="vis-psu" class="visualizer-slot" x="40" y="370" width="120" height="90" rx="4"/>
                            <text x="100" y="419" fill="rgba(255,255,255,0.4)" text-anchor="middle" font-size="12" font-weight="bold" letter-spacing="1">POWER</text>
                            
                            <!-- Case Fans -->
                            <circle id="vis-fan" class="visualizer-slot" cx="340" cy="80" r="30"/>
                            <circle id="vis-fan-2" class="visualizer-slot" cx="340" cy="160" r="30"/>
                            <circle id="vis-fan-3" class="visualizer-slot" cx="340" cy="240" r="30"/>
                            <text x="340" y="84" fill="rgba(255,255,255,0.2)" text-anchor="middle" font-size="10" font-weight="bold">FAN</text>
                            <text x="340" y="164" fill="rgba(255,255,255,0.2)" text-anchor="middle" font-size="10" font-weight="bold">FAN</text>
                            <text x="340" y="244" fill="rgba(255,255,255,0.2)" text-anchor="middle" font-size="10" font-weight="bold">FAN</text>
                        </svg>

                        <!-- Floating Component Info Overlay -->
                        <div class="absolute inset-0 pointer-events-none flex items-center justify-center opacity-0 transition-opacity duration-300" id="visualizer-overlay">
                            <div class="bg-[#050505]/80 backdrop-blur-md px-6 py-3 rounded-2xl border border-primary/30 shadow-[0_0_20px_rgba(255,107,0,0.3)] text-center">
                                <span class="text-xs text-primary font-bold tracking-widest uppercase block mb-1">Installed</span>
                                <h3 class="text-white font-bold" id="visualizer-label">Component</h3>
                            </div>
                        </div>
                    </div>

                    <!-- Progress / Power Draw -->
                    <div class="liquid-glass rounded-2xl p-4 lg:p-5 border border-white/10 flex flex-col sm:flex-row gap-4 items-center justify-between">
                        <div class="w-full">
                            <div class="flex justify-between text-xs text-gray-400 mb-2 font-bold uppercase tracking-widest">
                                <span>Components</span>
                                <span class="text-white"><span id="comp-count">0</span> / 11</span>
                            </div>
                            <div class="w-full h-1.5 bg-white/10 rounded-full overflow-hidden">
                                <div id="comp-bar" class="h-full bg-white transition-all duration-500 w-0"></div>
                            </div>
                        </div>
                        <div class="w-px h-10 bg-white/10 hidden sm:block"></div>
                        <div class="w-full">
                            <div class="flex justify-between text-xs text-gray-400 mb-2 font-bold uppercase tracking-widest">
                                <span class="text-primary flex items-center gap-1"><i class="ph-fill ph-lightning"></i> Est. Power</span>
                                <span class="text-white">~<span id="power-draw">0</span>W</span>
                            </div>
                            <div class="w-full h-1.5 bg-white/10 rounded-full overflow-hidden relative">
                                <div id="power-bar" class="h-full bg-gradient-to-r from-primary to-red-500 transition-all duration-500 w-0"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Analytics & Summary -->
                <div class="xl:col-span-1 space-y-4">
                    
                    <!-- Build Score -->
                    <div class="liquid-glass rounded-3xl p-4 lg:p-5 border border-white/10 text-center relative overflow-hidden group hidden">
                        <div class="absolute inset-0 bg-primary/5 group-hover:bg-primary/10 transition-colors"></div>
                        <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Build Score</h4>
                        <div class="flex items-end justify-center gap-1 mb-0 relative z-10">
                            <span class="text-6xl font-black text-white leading-none" id="build-score">0</span>
                            <span class="text-gray-500 font-bold pb-2">/100</span>
                        </div>
                    </div>

                    <!-- Performance Balance Radar -->
                    <div class="liquid-glass rounded-3xl p-4 lg:p-5 border border-white/10 hidden">
                        <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4 text-center">Performance Balance</h4>
                        <div class="relative w-full aspect-square">
                            <canvas id="radarChart"></canvas>
                        </div>
                    </div>

                    <!-- Build Summary -->
                    <div class="liquid-glass rounded-3xl p-4 lg:p-5 border border-white/10">
                        <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Build Summary</h4>
                        
                        <div id="summary-parts-list" class="space-y-2 mb-4 max-h-40 overflow-y-auto custom-scrollbar pr-2">
                            <!-- JS injected parts -->
                        </div>

                        <div class="border-t border-white/10 pt-4 mb-6">
                            <div class="flex justify-between items-end">
                                <span class="text-gray-400 text-sm">Total Price</span>
                                <span class="text-3xl font-black text-white" id="total-price">P0</span>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <button id="add-to-cart-btn" class="w-full bg-gradient-to-r from-primary to-[#ff8c33] hover:from-[#ff8c33] hover:to-primary text-white py-3.5 rounded-xl font-bold transition-all shadow-[0_0_15px_rgba(255,107,0,0.3)] hover:shadow-[0_0_25px_rgba(255,107,0,0.5)] hover:-translate-y-0.5 flex items-center justify-center gap-2">
                                Checkout Build <i class="ph-fill ph-check-circle text-lg"></i>
                            </button>
                            
                            <button id="add-missing-btn" class="w-full bg-white/10 hover:bg-white/20 text-white py-3 rounded-xl font-semibold transition-all border border-white/10 text-sm flex items-center justify-center gap-2">
                                <i class="ph ph-magic-wand text-primary"></i> Fill Missing Components
                            </button>
                            
                            <div class="grid grid-cols-3 gap-2">
                                <button id="save-build-btn" class="w-full bg-white/5 hover:bg-white/10 text-gray-300 hover:text-white py-2.5 rounded-xl font-semibold transition-all border border-white/10 text-xs flex items-center justify-center gap-1">
                                    <i class="ph ph-floppy-disk text-sm"></i> Save
                                </button>
                                <button id="load-build-btn" class="w-full bg-white/5 hover:bg-white/10 text-gray-300 hover:text-white py-2.5 rounded-xl font-semibold transition-all border border-white/10 text-xs flex items-center justify-center gap-1">
                                    <i class="ph ph-upload-simple text-sm"></i> Load
                                </button>
                                <button id="reset-build" class="w-full bg-white/5 hover:bg-red-500/20 text-gray-300 hover:text-red-400 py-2.5 rounded-xl font-semibold transition-all border border-white/10 hover:border-red-500/50 text-xs flex items-center justify-center gap-1">
                                    <i class="ph ph-trash text-sm"></i> Clear
                                </button>
                            </div>
                        </div>
                        <input type="file" id="load-build-input" class="hidden" accept=".json">
                    </div>

                    <!-- Compare Builds -->
                    <div class="liquid-glass rounded-3xl p-4 lg:p-5 border border-white/10">
                        <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4 text-center">Compare</h4>
                        <div class="flex items-center justify-between gap-4 mb-4">
                            <div class="text-center w-1/2 p-3 bg-white/5 rounded-xl border border-primary/30">
                                <div class="text-[10px] text-gray-400 mb-1">Current</div>
                                <div class="text-lg font-bold text-primary" id="compare-current">0</div>
                            </div>
                            <div class="text-center w-1/2 p-3 bg-white/5 rounded-xl border border-white/10">
                                <div class="text-[10px] text-gray-400 mb-1">Saved</div>
                                <div class="text-lg font-bold text-white">--</div>
                            </div>
                        </div>
                        <button class="w-full bg-white/5 hover:bg-white/10 text-gray-300 hover:text-white py-2.5 rounded-xl font-semibold transition-all border border-white/10 text-xs">
                            Compare Side by Side
                        </button>
                    </div>

                </div>

            </div>
        </div>
    </main>

    <!-- Custom Notification Modal -->
    <div id="notification-modal" class="fixed inset-0 bg-black/80 backdrop-blur-md z-[110] opacity-0 pointer-events-none transition-all duration-300 flex items-center justify-center p-4">
        <div class="liquid-glass-heavy w-full max-w-sm rounded-3xl border border-white/10 shadow-2xl flex flex-col transform scale-95 transition-transform duration-300 relative overflow-hidden">
            <div class="p-6 text-center">
                <div class="w-16 h-16 rounded-full bg-primary/20 text-primary flex items-center justify-center mx-auto mb-4 border border-primary/30" id="notification-icon">
                    <i class="ph ph-warning-circle text-3xl"></i>
                </div>
                <h3 class="text-xl font-bold text-white mb-2" id="notification-title">Notice</h3>
                <p class="text-sm text-gray-400 mb-6" id="notification-message"></p>
                <div class="flex gap-3 justify-center" id="notification-actions">
                    <button id="notification-btn-confirm" class="bg-primary hover:bg-[#ff8c33] text-white px-6 py-2.5 rounded-xl font-bold transition-all shadow-lg hover:shadow-[0_0_15px_rgba(255,107,0,0.5)] flex-1">OK</button>
                    <button id="notification-btn-cancel" class="bg-white/5 hover:bg-white/10 text-white px-6 py-2.5 rounded-xl font-bold transition-all border border-white/10 flex-1 hidden">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Product Selection Modal -->
    <div id="product-modal" class="fixed inset-0 bg-black/80 backdrop-blur-md z-[100] opacity-0 pointer-events-none transition-all duration-300 flex items-center justify-center p-4">
        <div class="liquid-glass-heavy w-full max-w-5xl max-h-[90vh] h-[800px] rounded-[2rem] border border-white/10 shadow-2xl flex flex-col transform scale-95 transition-transform duration-300 relative overflow-hidden">
            
            <!-- Modal Header -->
            <div class="px-8 py-6 border-b border-white/10 flex justify-between items-center bg-[#050505]/50 shrink-0">
                <div>
                    <h3 class="text-2xl font-black text-white" id="modal-title">Select Component</h3>
                </div>
                <button id="close-modal" class="w-10 h-10 rounded-full bg-white/10 hover:bg-primary flex items-center justify-center text-white transition-all shadow-lg hover:shadow-[0_0_15px_rgba(255,107,0,0.5)]">
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
                            <option value="rating_desc">Best Rating</option>
                            <option value="price_asc">Price: Low to High</option>
                            <option value="price_desc">Price: High to Low</option>
                            <option value="name_asc">Name: A-Z</option>
                        </select>
                    </div>
                </div>
                <div class="flex flex-wrap gap-4 items-end" id="modal-dynamic-filters">
                    <div class="flex flex-col gap-1">
                        <label class="text-[10px] text-gray-500 uppercase font-bold tracking-wider">Brand</label>
                        <select id="modal-filter-brand" class="bg-[#050505] border border-white/10 rounded-lg py-1.5 px-2 text-white text-xs focus:outline-none focus:border-primary">
                            <option value="">All Brands</option>
                        </select>
                    </div>
                    <div class="flex flex-col gap-1" id="filter-wrapper-socket">
                        <label class="text-[10px] text-gray-500 uppercase font-bold tracking-wider">Socket</label>
                        <select id="modal-filter-socket" class="bg-[#050505] border border-white/10 rounded-lg py-1.5 px-2 text-white text-xs focus:outline-none focus:border-primary">
                            <option value="">All Sockets</option>
                        </select>
                    </div>
                    <div class="flex flex-col gap-1" id="filter-wrapper-platform">
                        <label class="text-[10px] text-gray-500 uppercase font-bold tracking-wider">Platform</label>
                        <select id="modal-filter-platform" class="bg-[#050505] border border-white/10 rounded-lg py-1.5 px-2 text-white text-xs focus:outline-none focus:border-primary">
                            <option value="">All Platforms</option>
                        </select>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-[10px] text-gray-500 uppercase font-bold tracking-wider">Price Range</label>
                        <div class="flex items-center gap-2">
                            <input type="number" id="modal-price-min" placeholder="Min" class="w-20 bg-white/5 border border-white/10 rounded-lg py-1.5 px-2 text-white text-xs focus:outline-none focus:border-primary">
                            <span class="text-gray-500">-</span>
                            <input type="number" id="modal-price-max" placeholder="Max" class="w-20 bg-white/5 border border-white/10 rounded-lg py-1.5 px-2 text-white text-xs focus:outline-none focus:border-primary">
                        </div>
                    </div>
                    <div class="ml-auto">
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

    <!-- PC Builder JavaScript -->
    <script src="{{ asset('js/configurator-engine.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            
            const allComponents = @json($allComponents ?? []);
            const engine = new ConfiguratorEngine(allComponents);

            const componentGroups = [
                {
                    id: 'core',
                    name: 'Core Components',
                    items: [
                        { id: 'Processor', name: 'Processor', icon: 'ph-cpu', essential: true, visId: 'vis-cpu', dbType: 'Processor' },
                        { id: 'Motherboard', name: 'Motherboard', icon: 'ph-circuitry', essential: true, visId: 'vis-motherboard', dbType: 'Motherboard' }
                    ]
                },
                {
                    id: 'memory_storage',
                    name: 'Memory & Storage',
                    items: [
                        { id: 'Memory', name: 'Memory (RAM)', icon: 'ph-memory', essential: true, visId: 'vis-memory', dbType: 'Memory' },
                        { id: 'Primary Storage', name: 'Primary Storage (SSD)', icon: 'ph-hard-drives', essential: true, visId: 'vis-ssd', dbType: 'Storage' }
                    ]
                },
                {
                    id: 'graphics_power',
                    name: 'Graphics & Power',
                    items: [
                        { id: 'Video Card', name: 'Graphics Card', icon: 'ph-graphics-card', essential: true, visId: 'vis-gpu', dbType: 'Video Card' },
                        { id: 'Power Supply', name: 'Power Supply', icon: 'ph-plug', essential: true, visId: 'vis-psu', dbType: 'Power Supply' }
                    ]
                },
                {
                    id: 'chassis_cooling',
                    name: 'Chassis & Cooling',
                    items: [
                        { id: 'Case', name: 'Case', icon: 'ph-desktop-tower', essential: true, dbType: 'Case' }
                    ]
                }
            ];

            const totalEssential = 7;
            const maxBudget = 200000;
            let currentSelectingCategory = null;
            let currentSelectingDbType = null;
            let availableComponents = [];

            // --- DOM Elements ---
            const componentsListEl = document.getElementById('components-list');
            const totalPriceEl = document.getElementById('total-price');
            const powerDrawEl = document.getElementById('power-draw');
            const compCountEl = document.getElementById('comp-count');
            const budgetCurrentEl = document.getElementById('budget-current');
            
            const budgetBar = document.getElementById('budget-bar');
            const compBar = document.getElementById('comp-bar');
            const powerBar = document.getElementById('power-bar');

            const modalEl = document.getElementById('product-modal');
            const modalTitleEl = document.getElementById('modal-title');
            const modalProductsEl = document.getElementById('modal-products');

            // Filters DOM
            const modalSearchEl = document.getElementById('modal-search');
            const modalSortEl = document.getElementById('modal-sort');
            const modalFilterBrandEl = document.getElementById('modal-filter-brand');
            const modalFilterSocketEl = document.getElementById('modal-filter-socket');
            const modalFilterPlatformEl = document.getElementById('modal-filter-platform');
            const modalPriceMinEl = document.getElementById('modal-price-min');
            const modalPriceMaxEl = document.getElementById('modal-price-max');
            const modalResetFiltersEl = document.getElementById('modal-reset-filters');

            // --- Format Currency ---
            const formatPHP = (amount) => {
                return new Intl.NumberFormat('en-PH', { style: 'currency', currency: 'PHP', minimumFractionDigits: 0, maximumFractionDigits: 0 }).format(amount);
            };

            // --- Update UI from Engine ---
            engine.subscribe((build) => {
                renderComponents();
                updateSummary();
                updateVisualizer();
                updateSteps();
            });

            // --- Render Components List ---
            const renderComponents = () => {
                componentsListEl.innerHTML = '';
                let html = '';

                componentGroups.forEach(group => {
                    html += `<div class="mb-4">
                                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 pl-2">${group.name}</h3>
                                <div class="space-y-1.5">`;
                    
                    group.items.forEach(cat => {
                        const selectedProduct = engine.getComponent(cat.id);
                        html += `
                            <div class="liquid-glass rounded-xl p-2.5 flex items-center justify-between gap-3 component-slot border ${selectedProduct ? 'border-primary/30 bg-primary/5' : 'border-white/5'}">
                                <div class="flex items-center gap-3 flex-1 min-w-0">
                                    <div class="w-8 h-8 rounded-lg ${selectedProduct ? 'bg-transparent' : 'bg-white/5'} flex items-center justify-center shrink-0 border border-white/10 overflow-hidden">
                                        ${selectedProduct 
                                            ? `<img src="${selectedProduct.image_url || 'https://via.placeholder.com/300'}" alt="${selectedProduct.name}" class="w-full h-full object-cover">`
                                            : `<i class="ph ${cat.icon} text-lg text-gray-500"></i>`
                                        }
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h4 class="text-[9px] font-bold text-gray-500 uppercase tracking-widest leading-none mb-1">${cat.name} ${cat.essential ? '<span class="text-primary">*</span>' : ''}</h4>
                                        ${selectedProduct 
                                            ? `<h3 class="text-sm font-bold text-white leading-tight truncate">${selectedProduct.name}</h3>`
                                            : `<h3 class="text-xs font-medium text-gray-500 italic">Select component</h3>`
                                        }
                                    </div>
                                </div>
                                <div class="flex flex-col items-end shrink-0 gap-1">
                                    ${selectedProduct 
                                        ? `<span class="text-sm font-black text-white">${formatPHP(selectedProduct.price)}</span>
                                           <div class="flex gap-1 mt-1">
                                               <button onclick="openModal('${cat.id}', '${cat.dbType}')" class="text-[10px] px-2 py-1 rounded bg-white/10 hover:bg-white/20 text-white font-semibold transition-colors">Change</button>
                                               <button onclick="engine.removeComponent('${cat.id}')" class="text-[10px] px-2 py-1 rounded bg-red-500/10 hover:bg-red-500 text-red-500 hover:text-white transition-colors"><i class="ph ph-x"></i></button>
                                           </div>`
                                        : `<button onclick="openModal('${cat.id}', '${cat.dbType}')" class="px-3 py-1.5 rounded-lg bg-white/5 hover:bg-primary text-gray-300 hover:text-white text-xs font-bold transition-all border border-white/10 hover:border-transparent">
                                                Choose
                                           </button>`
                                    }
                                </div>
                            </div>
                        `;
                    });
                    html += `</div></div>`;
                });

                componentsListEl.innerHTML = html;
            };

            const updateVisualizer = () => {
                document.querySelectorAll('.visualizer-slot').forEach(el => el.classList.remove('active'));
                
                componentGroups.forEach(group => {
                    group.items.forEach(cat => {
                        if(engine.getComponent(cat.id) && cat.visId) {
                            const visEl = document.getElementById(cat.visId);
                            if(visEl) visEl.classList.add('active');
                            
                            if(cat.id === 'Memory') {
                                document.getElementById('vis-memory-2')?.classList.add('active');
                            }
                        }
                    });
                });
            };

            const updateSummary = () => {
                const total = engine.calculateTotal();
                const wattage = engine.getRequiredWattage();
                
                let count = 0;
                let partsHtml = '';

                let catNames = {};
                componentGroups.forEach(g => g.items.forEach(i => catNames[i.id] = i.name));

                Object.entries(engine.currentBuild).forEach(([catId, prod]) => {
                    if (prod) {
                        count++;
                        const catName = catNames[catId] || catId;
                        partsHtml += `<div class="flex justify-between items-center text-xs py-1 border-b border-white/5 last:border-0"><span class="text-gray-400 truncate pr-2 flex-1">${catName}</span><span class="text-white font-bold">${formatPHP(prod.price)}</span></div>`;
                    }
                });
                document.getElementById('summary-parts-list').innerHTML = partsHtml;

                totalPriceEl.textContent = formatPHP(total);
                powerDrawEl.textContent = Math.ceil(wattage);
                compCountEl.textContent = count;
                budgetCurrentEl.textContent = formatPHP(total);

                budgetBar.style.width = Math.min((total / maxBudget) * 100, 100) + '%';
                if(total > maxBudget) budgetBar.classList.add('bg-red-500');
                else budgetBar.classList.remove('bg-red-500');

                compBar.style.width = Math.min((count / 7) * 100, 100) + '%';
                powerBar.style.width = Math.min((wattage / 1200) * 100, 100) + '%';
            };

            const updateSteps = () => {
                const checkStep = (stepId, conditions) => {
                    const stepEl = document.getElementById(stepId);
                    if (!stepEl) return;
                    const dot = stepEl.querySelector('.step-dot');
                    const text = stepEl.querySelector('.step-text');
                    const isActive = conditions.some(c => !!engine.getComponent(c));
                    if (isActive) {
                        dot.className = 'w-8 h-8 rounded-full border-2 border-primary bg-primary text-white flex items-center justify-center text-xs font-bold step-dot active';
                        text.className = 'text-[10px] text-white font-bold uppercase tracking-wider step-text';
                    } else {
                        dot.className = 'w-8 h-8 rounded-full border-2 border-white/20 bg-black text-gray-400 flex items-center justify-center text-xs font-bold step-dot';
                        text.className = 'text-[10px] text-gray-500 font-bold uppercase tracking-wider step-text';
                    }
                };

                checkStep('step-1', ['Processor', 'Motherboard']);
                checkStep('step-2', ['Memory']);
                checkStep('step-3', ['Primary Storage']);
                checkStep('step-4', ['Video Card']);
                checkStep('step-5', ['Power Supply']);
                checkStep('step-6', ['Case']);
            };

            // --- Modal Functions ---
            window.openModal = (categoryId, dbType) => {
                currentSelectingCategory = categoryId;
                currentSelectingDbType = dbType;
                
                let catName = categoryId;
                let catIcon = '';
                
                componentGroups.forEach(g => g.items.forEach(i => {
                    if(i.id === categoryId) { catName = i.name; catIcon = i.icon; }
                }));
                
                modalTitleEl.innerHTML = `<i class="ph ${catIcon} text-primary"></i> Select ${catName}`;
                
                if(modalSearchEl) modalSearchEl.value = '';
                if(modalSortEl) modalSortEl.value = 'name_asc';
                if(modalPriceMinEl) modalPriceMinEl.value = '';
                if(modalPriceMaxEl) modalPriceMaxEl.value = '';

                availableComponents = allComponents.filter(c => c.type === dbType);

                renderModalProducts();
                
                modalEl.classList.remove('opacity-0', 'pointer-events-none');
                modalEl.querySelector('.liquid-glass-heavy').classList.remove('scale-95');
            };

            window.closeModal = () => {
                modalEl.classList.add('opacity-0', 'pointer-events-none');
                modalEl.querySelector('.liquid-glass-heavy').classList.add('scale-95');
            };

            const renderModalProducts = () => {
                modalProductsEl.innerHTML = '';
                
                let products = availableComponents;

                if(modalSearchEl && modalSearchEl.value) {
                    const q = modalSearchEl.value.toLowerCase();
                    products = products.filter(p => p.name.toLowerCase().includes(q));
                }
                if(modalPriceMinEl && modalPriceMinEl.value) {
                    products = products.filter(p => p.price >= parseFloat(modalPriceMinEl.value));
                }
                if(modalPriceMaxEl && modalPriceMaxEl.value) {
                    products = products.filter(p => p.price <= parseFloat(modalPriceMaxEl.value));
                }

                if(modalSortEl && modalSortEl.value) {
                    const sort = modalSortEl.value;
                    products = [...products].sort((a, b) => {
                        if(sort === 'price_asc') return a.price - b.price;
                        if(sort === 'price_desc') return b.price - a.price;
                        if(sort === 'name_asc') return a.name.localeCompare(b.name);
                        return 0;
                    });
                }

                const processed = products.map(c => {
                    const compatibility = engine.checkCompatibility(c, currentSelectingCategory);
                    return { ...c, compatible: compatibility.compatible, reason: compatibility.reason };
                });

                if(processed.length === 0) {
                    modalProductsEl.innerHTML = '<div class="col-span-full text-center py-12"><p class="text-gray-500">No components found.</p></div>';
                    return;
                }

                let html = '';
                processed.forEach(p => {
                    const currentComp = engine.getComponent(currentSelectingCategory);
                    const isSelected = currentComp && currentComp.id === p.id;
                    const onClick = isSelected ? '' : `onclick="selectComponent(${p.id})"`;
                    
                    const imgUrl = p.image_url || 'https://via.placeholder.com/300x200/111/333?text=' + currentSelectingCategory;
                    const opacityClass = !p.compatible ? 'opacity-50 grayscale pointer-events-none' : '';
                    const borderClass = isSelected ? 'border-primary shadow-[0_0_15px_rgba(255,107,0,0.3)]' : 'border-white/5 hover:border-white/20 cursor-pointer';

                    html += `
                        <div class="liquid-glass p-4 rounded-2xl border ${borderClass} flex flex-col transition-all group relative ${opacityClass}" ${p.compatible ? onClick : ''}>
                            <div class="w-full h-32 mb-4 bg-white/5 rounded-xl flex items-center justify-center p-2">
                                <img src="${imgUrl}" alt="${p.name}" class="max-h-full max-w-full object-contain group-hover:scale-110 transition-transform duration-300">
                            </div>
                            <h4 class="font-bold text-white text-sm mb-2 leading-tight">${p.name}</h4>
                            <div class="mt-auto flex justify-between items-end">
                                <p class="text-primary font-black">${formatPHP(p.price)}</p>
                                ${isSelected ? '<div class="bg-primary text-white text-[10px] font-bold px-2 py-1 rounded uppercase tracking-widest">Selected</div>' : ''}
                            </div>
                            ${!p.compatible ? `<div class="absolute top-2 right-2 bg-red-500/90 text-white text-[9px] font-black uppercase tracking-wider px-2 py-1 rounded shadow-lg backdrop-blur-sm z-10">${p.reason}</div>` : ''}
                        </div>
                    `;
                });
                modalProductsEl.innerHTML = html;
            };

            window.selectComponent = (id) => {
                const component = availableComponents.find(c => c.id === id);
                
                const conflicts = engine.getConflictsIfSelected(currentSelectingCategory, component);
                
                if (conflicts.length > 0) {
                    let msg = "Changing this component will require changing your " + conflicts.join(', ') + ". Proceed?";
                    if(!confirm(msg)) return;
                    conflicts.forEach(cat => engine.removeComponent(cat));
                }
                
                engine.setComponent(currentSelectingCategory, component);
                closeModal();
            };

            // Event Listeners for modal filters
            if(modalSearchEl) modalSearchEl.addEventListener('input', renderModalProducts);
            if(modalSortEl) modalSortEl.addEventListener('change', renderModalProducts);
            if(modalPriceMinEl) modalPriceMinEl.addEventListener('input', renderModalProducts);
            if(modalPriceMaxEl) modalPriceMaxEl.addEventListener('input', renderModalProducts);
            if(modalResetFiltersEl) {
                modalResetFiltersEl.addEventListener('click', () => {
                    modalSearchEl.value = '';
                    modalSortEl.value = 'name_asc';
                    modalPriceMinEl.value = '';
                    modalPriceMaxEl.value = '';
                    renderModalProducts();
                });
            }
            const closeModalBtn = document.getElementById('close-modal');
            if(closeModalBtn) closeModalBtn.addEventListener('click', closeModal);

            // Add to Cart Logic
            const checkoutBtn = document.getElementById('add-to-cart-btn');
            if(checkoutBtn) {
                checkoutBtn.addEventListener('click', () => {
                    const currentBuild = engine.currentBuild;
                    const missing = Object.entries(currentBuild).filter(([k,v]) => v === null);
                    if (missing.length > 0) {
                        alert("Please select components for: " + missing.map(m => m[0]).join(', '));
                        return;
                    }

                    const originalText = checkoutBtn.innerHTML;
                    checkoutBtn.innerHTML = '<i class="ph ph-spinner animate-spin"></i> Processing...';
                    checkoutBtn.disabled = true;

                    const formData = new FormData();
                    formData.append('product_id', 'custom_' + Date.now());
                    formData.append('name', 'Custom PC Build');
                    formData.append('price', engine.calculateTotal());
                    formData.append('image_url', 'https://images.unsplash.com/photo-1587202372775-e229f172b9d7?w=500&q=80');
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
                            checkoutBtn.innerHTML = '<i class="ph-bold ph-check-circle"></i> Added to Cart';
                            setTimeout(() => {
                                checkoutBtn.innerHTML = originalText;
                                checkoutBtn.disabled = false;
                                const badge = document.querySelector('#cart-btn span');
                                if (badge) {
                                    badge.classList.remove('hidden');
                                    badge.classList.add('flex');
                                    badge.innerText = data.cart_count;
                                }
                            }, 2000);
                        }
                    });
                });
            }

            // Init call
            renderComponents();
            updateSummary();
            
            // Preloader
            const preloader = document.getElementById('preloader');
            if (preloader) {
                setTimeout(() => {
                    preloader.style.opacity = '0';
                    setTimeout(() => preloader.style.display = 'none', 1000);
                }, 500);
            }
        });
    </script>

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

    @vite('resources/js/HomePage/Homepage.js')
</body>
</html>
