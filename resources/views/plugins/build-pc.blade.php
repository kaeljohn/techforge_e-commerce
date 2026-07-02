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



    <!-- Search Overlay -->
    <div id="search-overlay" class="fixed inset-0 bg-black/80 backdrop-blur-sm z-[65] opacity-0 pointer-events-none transition-all duration-300"></div>

    <!-- Navigation -->
    <nav class="fixed w-[calc(100%-2rem)] sm:w-[calc(100%-3rem)] lg:w-[calc(100%-4rem)] max-w-7xl left-1/2 -translate-x-1/2 top-4 z-[70] px-4 sm:px-6 py-3 flex items-center justify-between gap-4 sm:gap-6 transition-all duration-300">
        <!-- Background for Nav to prevent backdrop-filter nesting bug -->
        <div class="absolute inset-0 liquid-glass rounded-2xl -z-10 pointer-events-none"></div>

        <!-- Logo & Name -->
        <a href="{{ url('/') }}" class="flex items-center gap-3 shrink-0 relative z-30">
            <div class="bg-gradient-to-br from-primary to-orange-400 w-10 h-10 rounded-xl flex items-center justify-center shadow-[0_0_15px_rgba(255,107,0,0.4)]">
                <img src="{{ Vite::asset('resources/img/Techforge_Logo.png') }}" alt="TechForge Logo" class="h-6 w-auto object-contain">
            </div>
            <div class="hidden md:flex flex-col">
                <span class="text-xl font-bold tracking-wide text-white leading-tight">TECHFORGE</span>
                <span class="text-[10px] text-primary font-bold tracking-widest uppercase">PC Builder</span>
            </div>
        </a>

        <!-- Search Bar (Automatically Enlarged) -->
        <div id="search-container" class="flex-1 max-w-3xl relative z-50">
            <div id="search-wrapper" class="relative flex items-center w-full h-11 bg-neutral-900 border border-white/10 hover:border-white/20 hover:bg-white/5 transition-all duration-300 rounded-2xl group">
                <input type="text" id="search-input" placeholder="What are we searching?" class="w-full h-full bg-transparent outline-none pl-5 pr-20 text-sm text-white placeholder-gray-400 font-light rounded-2xl relative z-10">
                
                <!-- Clear Button -->
                <button id="search-clear" class="absolute right-12 w-7 h-7 flex items-center justify-center text-gray-400 hover:text-white transition-all opacity-0 pointer-events-none z-20">
                    <i class="ph ph-x text-sm"></i>
                </button>

                <button class="absolute right-1 w-9 h-9 flex items-center justify-center bg-primary hover:bg-primary-hover text-white rounded-xl transition-colors shadow-[0_0_10px_rgba(255,107,0,0.3)] z-20">
                    <i class="ph ph-magnifying-glass text-lg"></i>
                </button>
            </div>
            
            <!-- Search Dropdown -->
            <div id="search-dropdown" class="liquid-glass-heavy absolute top-[calc(100%+0.5rem)] left-0 w-full rounded-2xl overflow-hidden shadow-2xl py-3 opacity-0 pointer-events-none transition-all duration-300 transform -translate-y-2 origin-top">
                <ul class="text-sm text-gray-300 flex flex-col">
                </ul>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex items-center gap-4 shrink-0">
            
            <!-- Location -->
            <div class="hidden lg:flex items-center gap-2 cursor-pointer hover:text-white group">
                <i class="ph ph-map-pin text-xl text-gray-400 group-hover:text-primary transition-colors"></i>
                <div class="flex flex-col text-left">
                    <span class="text-[10px] text-gray-400 leading-tight">Deliver to</span>
                    <span class="text-sm font-bold text-white group-hover:text-primary transition-colors leading-tight">Philippines</span>
                </div>
            </div>

            <!-- Sign In -->
            @auth
            <div class="hidden lg:flex items-center gap-4 relative">
                <div id="user-dropdown-btn" class="flex items-center gap-2 cursor-pointer group">
                    <i class="ph ph-user text-xl text-primary transition-colors"></i>
                    <div class="flex flex-col text-left">
                        <span class="text-[10px] text-gray-400 leading-tight">Welcome</span>
                        <span class="text-sm font-bold text-white leading-tight">{{ Auth::user()->name }}</span>
                    </div>
                </div>
                
                <!-- Dropdown Menu -->
                <div id="user-dropdown" class="opacity-0 pointer-events-none scale-95 transition-all duration-300 origin-top-right absolute top-full right-0 mt-4 w-56 liquid-glass border border-white/10 rounded-xl shadow-2xl py-2 z-50" onclick="event.stopPropagation();">
                    <div class="px-4 py-3 border-b border-white/10 mb-2 bg-white/5 mx-2 rounded-lg">
                        <p class="text-[10px] text-gray-400 uppercase font-bold tracking-wider mb-0.5">FORGE Points</p>
                        <div class="flex items-end gap-2">
                            <p class="text-xl font-black text-transparent bg-clip-text bg-gradient-to-r from-primary to-[#ff8c33]">0</p>
                            <p class="text-[10px] font-normal text-gray-500 mb-1 pb-0.5">(For now)</p>
                        </div>
                    </div>
                    <a href="#" class="flex items-center gap-3 px-5 py-2.5 text-sm font-medium text-gray-300 hover:text-white hover:bg-white/5 transition-colors">
                        <i class="ph ph-user-circle text-lg text-gray-400"></i> My Account
                    </a>
                    <a href="#" class="flex items-center gap-3 px-5 py-2.5 text-sm font-medium text-gray-300 hover:text-white hover:bg-white/5 transition-colors">
                        <i class="ph ph-receipt text-lg text-gray-400"></i> Order History
                    </a>
                    
                    <form action="{{ route('logout') }}" method="POST" class="w-full mt-2 border-t border-white/10 pt-2">
                        @csrf
                        <button type="submit" class="flex items-center gap-3 w-full text-left px-5 py-2.5 text-sm font-bold text-red-500 hover:text-red-400 hover:bg-red-500/10 transition-colors">
                            <i class="ph ph-sign-out text-lg"></i> Sign Out
                        </button>
                    </form>
                </div>
                
                <script>
                    const btn = document.getElementById('user-dropdown-btn');
                    const dropdown = document.getElementById('user-dropdown');
                    if(btn && dropdown) {
                        btn.addEventListener('click', (e) => {
                            e.stopPropagation();
                            if(dropdown.classList.contains('opacity-0')) {
                                dropdown.classList.remove('opacity-0', 'pointer-events-none', 'scale-95');
                                dropdown.classList.add('opacity-100', 'pointer-events-auto', 'scale-100');
                            } else {
                                dropdown.classList.add('opacity-0', 'pointer-events-none', 'scale-95');
                                dropdown.classList.remove('opacity-100', 'pointer-events-auto', 'scale-100');
                            }
                        });
                        document.addEventListener('click', () => {
                            if (!dropdown.classList.contains('opacity-0')) {
                                dropdown.classList.add('opacity-0', 'pointer-events-none', 'scale-95');
                                dropdown.classList.remove('opacity-100', 'pointer-events-auto', 'scale-100');
                            }
                        });
                    }
                </script>
            </div>
            @else
            <a href="{{ route('login') }}" class="hidden lg:flex items-center gap-2 cursor-pointer group">
                <i class="ph ph-user text-xl text-gray-400 group-hover:text-primary transition-colors"></i>
                <div class="flex flex-col text-left">
                    <span class="text-[10px] text-gray-400 leading-tight">Welcome</span>
                    <span class="text-sm font-bold text-white group-hover:text-primary transition-colors leading-tight">Sign In / Register</span>
                </div>
            </a>
            @endauth

            <!-- Notification Container -->
            <div class="relative z-30 shrink-0 group">
                <!-- Notification Button -->
                <a href="{{ route('notifications') }}" class="w-11 h-11 flex items-center justify-center rounded-2xl border border-white/10 hover:border-white/20 hover:bg-white/5 transition-all text-gray-300 hover:text-white relative shrink-0">
                    <i class="ph ph-bell text-xl"></i>
                    <span class="absolute top-[10px] right-[10px] w-2 h-2 bg-primary rounded-full shadow-[0_0_8px_rgba(255,107,0,0.8)]"></span>
                </a>

                <!-- Notification Dropdown -->
                <div class="liquid-glass-heavy absolute top-[calc(100%+0.5rem)] right-0 w-80 sm:w-96 rounded-2xl overflow-hidden shadow-2xl p-5 opacity-0 pointer-events-none group-hover:opacity-100 group-hover:pointer-events-auto transition-all duration-300 transform group-hover:translate-y-0 -translate-y-2 origin-top">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold text-white">Notifications</h3>
                        <span class="bg-primary/20 text-primary text-[10px] font-bold px-2 py-1 rounded-md">1 New</span>
                    </div>
                    
                    <div class="flex flex-col gap-3 mb-4">
                        <!-- Notification Item -->
                        <a href="{{ route('login') }}" class="flex items-start gap-4 p-3 rounded-xl hover:bg-white/5 transition-colors group/item border border-transparent hover:border-white/5">
                            <div class="w-10 h-10 rounded-full bg-primary/20 flex items-center justify-center shrink-0">
                                <i class="ph-fill ph-ticket text-xl text-primary"></i>
                            </div>
                            <div class="flex-1 min-w-0 pt-0.5">
                                <h4 class="text-sm font-bold text-white mb-1 group-hover/item:text-primary transition-colors">Special Offer!</h4>
                                <p class="text-xs text-gray-400 leading-relaxed">Sign up for an account now to receive a 10% discount voucher on your first order.</p>
                                <span class="text-[10px] text-gray-500 mt-2 block">Just now</span>
                            </div>
                        </a>
                    </div>
                    
                    <div class="flex justify-center pt-3 border-t border-white/10 mt-2">
                        <a href="{{ route('notifications') }}" class="text-xs font-bold text-gray-400 hover:text-primary transition-colors">
                            View All Notifications
                        </a>
                    </div>
                </div>
            </div>

            <!-- Cart Container -->
            <div id="cart-container" class="relative z-30 shrink-0">
                <a href="{{ route('cart') }}" id="cart-btn" class="flex items-center gap-2 w-auto h-11 px-3 sm:px-4 rounded-2xl border border-white/10 hover:border-white/20 hover:bg-white/5 transition-all text-gray-300 hover:text-white relative">
                    <div class="relative">
                        <i class="ph ph-shopping-cart text-xl"></i>
                        <span class="hidden absolute -top-1 -right-1 w-3.5 h-3.5 items-center justify-center text-[8px] font-bold bg-primary text-white rounded-full">0</span>
                    </div>
                    <div class="hidden sm:flex flex-col text-left ml-1">
                        <span class="text-[10px] text-gray-400 leading-tight">Returns</span>
                        <span class="text-sm font-bold text-white leading-tight">& Cart</span>
                    </div>
                </a>


            </div>
            
        </div>
    </nav>


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
                    <div class="liquid-glass rounded-3xl p-4 lg:p-5 border border-white/10 text-center relative overflow-hidden group">
                        <div class="absolute inset-0 bg-primary/5 group-hover:bg-primary/10 transition-colors"></div>
                        <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Build Score</h4>
                        <div class="flex items-end justify-center gap-1 mb-0 relative z-10">
                            <span class="text-6xl font-black text-white leading-none" id="build-score">0</span>
                            <span class="text-gray-500 font-bold pb-2">/100</span>
                        </div>
                    </div>

                    <!-- Performance Balance Radar -->
                    <div class="liquid-glass rounded-3xl p-4 lg:p-5 border border-white/10">
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
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            
            // --- DATA ---
            const componentGroups = [
                {
                    id: 'core',
                    name: 'Core Components',
                    items: [
                        { id: 'cpu', name: 'Processor', icon: 'ph-cpu', essential: true, visId: 'vis-cpu' },
                        { id: 'motherboard', name: 'Motherboard', icon: 'ph-circuitry', essential: true, visId: 'vis-motherboard' }
                    ]
                },
                {
                    id: 'memory_storage',
                    name: 'Memory & Storage',
                    items: [
                        { id: 'memory', name: 'Memory (RAM)', icon: 'ph-memory', essential: true, visId: 'vis-memory' },
                        { id: 'ssd', name: 'SSD (NVMe)', icon: 'ph-hard-drives', essential: true, visId: 'vis-ssd' },
                        { id: 'sata', name: 'SSD (SATA)', icon: 'ph-hard-drive', essential: false },
                        { id: 'hdd', name: 'Hard Disk', icon: 'ph-database', essential: false }
                    ]
                },
                {
                    id: 'graphics_power',
                    name: 'Graphics & Power',
                    items: [
                        { id: 'gpu', name: 'Graphics Card', icon: 'ph-graphics-card', essential: true, visId: 'vis-gpu' },
                        { id: 'psu', name: 'Power Supply', icon: 'ph-plug', essential: true, visId: 'vis-psu' }
                    ]
                },
                {
                    id: 'chassis_cooling',
                    name: 'Chassis & Cooling',
                    items: [
                        { id: 'case', name: 'Case', icon: 'ph-desktop-tower', essential: true },
                        { id: 'cooler', name: 'CPU Cooler', icon: 'ph-thermometer-cold', essential: false, visId: 'vis-cooler' },
                        { id: 'fan', name: 'Case Fan', icon: 'ph-fan', essential: false, visId: 'vis-fan' }
                    ]
                }
            ];

            const totalEssential = 7;
            const maxBudget = 200000;

            const productsDB = {
                cpu: [
                    { id: 'cpu1', name: 'AMD Ryzen 9 7950X', price: 34500, wattage: 170, score: { cpu: 95, ram: 0, gpu: 0, ssd: 0, psu: 0 }, image: 'https://images.unsplash.com/photo-1591488320449-011701bb6704?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80', desc: '16 Cores, 32 Threads, 5.7 GHz Max Boost', rating: 4.9, brand: 'AMD', platform: 'AMD', socket: 'AM5' },
                    { id: 'cpu2', name: 'Intel Core i9-14900K', price: 35000, wattage: 253, score: { cpu: 98, ram: 0, gpu: 0, ssd: 0, psu: 0 }, image: 'https://images.unsplash.com/photo-1591488320449-011701bb6704?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80', desc: '24 Cores, 32 Threads, 6.0 GHz Max Turbo', rating: 4.8, brand: 'Intel', platform: 'Intel', socket: 'LGA1700' },
                    { id: 'cpu3', name: 'AMD Ryzen 5 7600X', price: 13500, wattage: 105, score: { cpu: 75, ram: 0, gpu: 0, ssd: 0, psu: 0 }, image: 'https://images.unsplash.com/photo-1591488320449-011701bb6704?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80', desc: '6 Cores, 12 Threads, 5.3 GHz Max Boost', rating: 4.6, brand: 'AMD', platform: 'AMD', socket: 'AM5' }
                ],
                motherboard: [
                    { id: 'mb1', name: 'ASUS ROG Crosshair X670E Hero', price: 39000, wattage: 35, score: { cpu: 10, ram: 10, gpu: 10, ssd: 10, psu: 0 }, image: 'https://dlcdnwebimgs.asus.com/files/media/0CBC145C-59B8-4B51-BF1A-DA0749FA1522/v1/img/kv/pd.png', desc: 'AM5, PCIe 5.0, Wi-Fi 6E', rating: 4.9, brand: 'ASUS', platform: 'AMD', socket: 'AM5' },
                    { id: 'mb2', name: 'MSI MAG B650 TOMAHAWK WIFI', price: 14000, wattage: 25, score: { cpu: 5, ram: 5, gpu: 5, ssd: 5, psu: 0 }, image: 'https://dlcdnwebimgs.asus.com/files/media/0CBC145C-59B8-4B51-BF1A-DA0749FA1522/v1/img/kv/pd.png', desc: 'AM5, DDR5, Wi-Fi 6E', rating: 4.7, brand: 'MSI', platform: 'AMD', socket: 'AM5' }
                ],
                memory: [
                    { id: 'ram1', name: 'G.Skill Trident Z5 32GB DDR5-6000', price: 8500, wattage: 15, score: { cpu: 0, ram: 90, gpu: 0, ssd: 0, psu: 0 }, image: 'https://images.unsplash.com/photo-1758577675588-c5bbbbbf8e97?w=200&q=80', desc: 'CL30, RGB', rating: 4.8, brand: 'G.Skill' },
                    { id: 'ram2', name: 'Corsair Vengeance 16GB DDR5-5600', price: 4000, wattage: 10, score: { cpu: 0, ram: 60, gpu: 0, ssd: 0, psu: 0 }, image: 'https://images.unsplash.com/photo-1758577675588-c5bbbbbf8e97?w=200&q=80', desc: 'CL36', rating: 4.5, brand: 'Corsair' }
                ],
                gpu: [
                    { id: 'gpu1', name: 'RTX 4090 24GB', price: 115000, wattage: 450, score: { cpu: 0, ram: 0, gpu: 100, ssd: 0, psu: 0 }, image: 'https://images.unsplash.com/photo-1591488320449-011701bb6704?w=200&q=80', desc: 'Founders Edition', rating: 5.0, brand: 'NVIDIA' },
                    { id: 'gpu2', name: 'RTX 4060 Ti 8GB', price: 25000, wattage: 160, score: { cpu: 0, ram: 0, gpu: 65, ssd: 0, psu: 0 }, image: 'https://images.unsplash.com/photo-1591488320449-011701bb6704?w=200&q=80', desc: 'Ventus 2X Black', rating: 4.4, brand: 'MSI' }
                ],
                ssd: [
                    { id: 'ssd1', name: 'Samsung 990 PRO 2TB', price: 11000, wattage: 8, score: { cpu: 0, ram: 0, gpu: 0, ssd: 95, psu: 0 }, image: 'https://images.unsplash.com/photo-1591488320449-011701bb6704?w=200&q=80', desc: 'PCIe 4.0 NVMe', rating: 4.9, brand: 'Samsung' },
                ],
                sata: [], hdd: [],
                case: [
                    { id: 'case1', name: 'Lian Li O11 Dynamic EVO', price: 9500, wattage: 0, score: { cpu: 0, ram: 0, gpu: 0, ssd: 0, psu: 0 }, image: 'https://images.unsplash.com/photo-1587202372634-32705e3bf49c?w=200&q=80', desc: 'Mid-Tower', rating: 4.8, brand: 'Lian Li' },
                ],
                psu: [
                    { id: 'psu1', name: 'Corsair RM1000x 1000W', price: 11500, wattage: 0, score: { cpu: 0, ram: 0, gpu: 0, ssd: 0, psu: 95 }, image: 'https://images.unsplash.com/photo-1587202372634-32705e3bf49c?w=200&q=80', desc: '80+ Gold', rating: 4.8, brand: 'Corsair' },
                    { id: 'psu2', name: 'Seasonic 650W', price: 4500, wattage: 0, score: { cpu: 0, ram: 0, gpu: 0, ssd: 0, psu: 60 }, image: 'https://images.unsplash.com/photo-1587202372634-32705e3bf49c?w=200&q=80', desc: '80+ Bronze', rating: 4.5, brand: 'Seasonic' }
                ],
                cooler: [
                    { id: 'cool1', name: 'NZXT Kraken 360', price: 16500, wattage: 15, score: { cpu: 10, ram: 0, gpu: 0, ssd: 0, psu: 0 }, image: 'https://images.unsplash.com/photo-1587202372634-32705e3bf49c?w=200&q=80', desc: '360mm AIO', rating: 4.7, brand: 'NZXT' }
                ],
                fan: []
            };

            let currentBuild = {};
            let currentSelectingCategory = null;

            // --- Radar Chart Init ---
            const ctx = document.getElementById('radarChart').getContext('2d');
            const radarChart = new Chart(ctx, {
                type: 'radar',
                data: {
                    labels: ['CPU', 'RAM', 'GPU', 'SSD', 'PSU'],
                    datasets: [{
                        label: 'Performance',
                        data: [0, 0, 0, 0, 0],
                        backgroundColor: 'rgba(255, 107, 0, 0.2)',
                        borderColor: '#ff6b00',
                        pointBackgroundColor: '#ff6b00',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: '#ff6b00',
                        borderWidth: 2,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        r: {
                            angleLines: { color: 'rgba(255, 255, 255, 0.1)' },
                            grid: { color: 'rgba(255, 255, 255, 0.1)' },
                            pointLabels: { color: '#9ca3af', font: { size: 10, family: 'Inter', weight: 'bold' } },
                            min: 0,
                            max: 100,
                            ticks: { display: false }
                        }
                    },
                    plugins: { legend: { display: false } }
                }
            });

            // --- DOM Elements ---
            const componentsListEl = document.getElementById('components-list');
            const totalPriceEl = document.getElementById('total-price');
            const powerDrawEl = document.getElementById('power-draw');
            const compCountEl = document.getElementById('comp-count');
            const buildScoreEl = document.getElementById('build-score');
            const compareCurrentEl = document.getElementById('compare-current');
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

            // --- Custom Notification System ---
            const notifModal = document.getElementById('notification-modal');
            const notifTitle = document.getElementById('notification-title');
            const notifMessage = document.getElementById('notification-message');
            const notifBtnConfirm = document.getElementById('notification-btn-confirm');
            const notifBtnCancel = document.getElementById('notification-btn-cancel');
            let confirmCallback = null;

            const showNotification = (title, message, isConfirm = false, onConfirm = null) => {
                notifTitle.innerText = title;
                notifMessage.innerText = message;
                if (isConfirm) {
                    notifBtnCancel.classList.remove('hidden');
                    confirmCallback = onConfirm;
                } else {
                    notifBtnCancel.classList.add('hidden');
                    confirmCallback = null;
                }
                notifModal.classList.remove('opacity-0', 'pointer-events-none');
                notifModal.querySelector('.liquid-glass-heavy').classList.remove('scale-95');
            };

            const closeNotification = () => {
                notifModal.classList.add('opacity-0', 'pointer-events-none');
                notifModal.querySelector('.liquid-glass-heavy').classList.add('scale-95');
            };

            notifBtnConfirm.addEventListener('click', () => {
                closeNotification();
                if (confirmCallback) confirmCallback();
            });

            notifBtnCancel.addEventListener('click', closeNotification);

            // --- Format Currency ---
            const formatPHP = (amount) => {
                return new Intl.NumberFormat('en-PH', { style: 'currency', currency: 'PHP', minimumFractionDigits: 0, maximumFractionDigits: 0 }).format(amount);
            };

            // --- Render Components List ---
            const renderComponents = () => {
                componentsListEl.innerHTML = '';
                let html = '';

                componentGroups.forEach(group => {
                    html += `<div class="mb-4">
                                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 pl-2">${group.name}</h3>
                                <div class="space-y-1.5">`;
                    
                    group.items.forEach(cat => {
                        const selectedProduct = currentBuild[cat.id];
                        html += `
                            <div class="liquid-glass rounded-xl p-2.5 flex items-center justify-between gap-3 component-slot border ${selectedProduct ? 'border-primary/30 bg-primary/5' : 'border-white/5'}">
                                <div class="flex items-center gap-3 flex-1 min-w-0">
                                    <div class="w-8 h-8 rounded-lg ${selectedProduct ? 'bg-transparent' : 'bg-white/5'} flex items-center justify-center shrink-0 border border-white/10 overflow-hidden">
                                        ${selectedProduct 
                                            ? `<img src="${selectedProduct.image}" alt="${selectedProduct.name}" class="w-full h-full object-cover">`
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
                                        ? `<span class="text-sm font-black text-white">${formatPHP(selectedProduct.price * (selectedProduct.qty || 1))}</span>
                                           ${cat.id === 'memory' ? `
                                           <div class="flex items-center gap-2 mt-1 mb-1 bg-white/5 rounded px-2 py-1 border border-white/10">
                                                <button onclick="updateQty('${cat.id}', -1)" class="w-4 h-4 flex items-center justify-center text-gray-400 hover:text-white">-</button>
                                                <span class="text-xs font-bold w-4 text-center text-white">${selectedProduct.qty || 1}</span>
                                                <button onclick="updateQty('${cat.id}', 1)" class="w-4 h-4 flex items-center justify-center text-gray-400 hover:text-white">+</button>
                                                <span class="text-[10px] text-gray-500 ml-1 whitespace-nowrap">${selectedProduct.qty || 1} of ${currentBuild['motherboard'] ? (currentBuild['motherboard'].slots || 4) : 4} DIMM slots</span>
                                           </div>
                                           ` : ''}
                                           <div class="flex gap-1">
                                               <button onclick="openModal('${cat.id}')" class="text-[10px] px-2 py-1 rounded bg-white/10 hover:bg-white/20 text-white font-semibold transition-colors">Change</button>
                                               <button onclick="removeProduct('${cat.id}')" class="text-[10px] px-2 py-1 rounded bg-red-500/10 hover:bg-red-500 text-red-500 hover:text-white transition-colors"><i class="ph ph-x"></i></button>
                                           </div>`
                                        : `<button onclick="openModal('${cat.id}')" class="px-3 py-1.5 rounded-lg bg-white/5 hover:bg-primary text-gray-300 hover:text-white text-xs font-bold transition-all border border-white/10 hover:border-transparent">
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
                updateSummary();
            };

            // --- Visualizer Logic ---
            const updateVisualizer = () => {
                // Reset all slots
                document.querySelectorAll('.visualizer-slot').forEach(el => el.classList.remove('active'));
                
                componentGroups.forEach(group => {
                    group.items.forEach(cat => {
                        if(currentBuild[cat.id] && cat.visId) {
                            const visEl = document.getElementById(cat.visId);
                            if(visEl) visEl.classList.add('active');
                            
                            // Special case for RAM (two slots)
                            if(cat.id === 'memory') {
                                document.getElementById('vis-memory-2')?.classList.add('active');
                            }
                            if(cat.id === 'fan') {
                                document.getElementById('vis-fan-2')?.classList.add('active');
                                document.getElementById('vis-fan-3')?.classList.add('active');
                            }
                        }
                    });
                });
            };

            // --- Update Summary & Charts ---
            const updateSummary = () => {
                let total = 0;
                let wattage = 0;
                let count = 0;
                let radarData = [0, 0, 0, 0, 0]; // CPU, RAM, GPU, SSD, PSU

                let partsHtml = '';

                let catNames = {};
                componentGroups.forEach(g => g.items.forEach(i => catNames[i.id] = i.name));

                Object.entries(currentBuild).forEach(([catId, prod]) => {
                    const qty = prod.qty || 1;
                    total += prod.price * qty;
                    wattage += prod.wattage * qty;
                    count++;
                    
                    const catName = catNames[catId] || 'Component';
                    
                    partsHtml += `<div class="flex justify-between items-center text-xs py-1 border-b border-white/5 last:border-0"><span class="text-gray-400 truncate pr-2 flex-1">${qty > 1 ? qty + 'x ' : ''}${catName}</span><span class="text-white font-bold">${formatPHP(prod.price * qty)}</span></div>`;

                    if(prod.score) {
                        radarData[0] += prod.score.cpu || 0;
                        radarData[1] += prod.score.ram || 0;
                        radarData[2] += prod.score.gpu || 0;
                        radarData[3] += prod.score.ssd || 0;
                        radarData[4] += prod.score.psu || 0;
                    }
                });
                document.getElementById('summary-parts-list').innerHTML = partsHtml;

                // Cap radar data to 100
                radarData = radarData.map(v => Math.min(v, 100));
                
                // Calculate total score (average of radar, roughly)
                const totalScore = Math.round(radarData.reduce((a, b) => a + b, 0) / 5);

                // Update DOM
                totalPriceEl.textContent = formatPHP(total);
                powerDrawEl.textContent = wattage;
                compCountEl.textContent = count;
                buildScoreEl.textContent = totalScore;
                compareCurrentEl.textContent = totalScore;
                budgetCurrentEl.textContent = formatPHP(total);

                // Update Bars
                budgetBar.style.width = Math.min((total / maxBudget) * 100, 100) + '%';
                if(total > maxBudget) budgetBar.classList.add('bg-red-500');
                else budgetBar.classList.remove('bg-red-500');

                compBar.style.width = Math.min((count / 11) * 100, 100) + '%';
                powerBar.style.width = Math.min((wattage / 1200) * 100, 100) + '%';

                // Update Chart
                radarChart.data.datasets[0].data = radarData;
                radarChart.update();

                updateVisualizer();
                updateSteps();
            };

            const updateSteps = () => {
                const checkStep = (stepId, conditions) => {
                    const stepEl = document.getElementById(stepId);
                    if (!stepEl) return;
                    const dot = stepEl.querySelector('.step-dot');
                    const text = stepEl.querySelector('.step-text');
                    const isActive = conditions.some(c => !!currentBuild[c]);
                    if (isActive) {
                        dot.className = 'w-8 h-8 rounded-full border-2 border-primary bg-primary text-white flex items-center justify-center text-xs font-bold step-dot active';
                        text.className = 'text-[10px] text-white font-bold uppercase tracking-wider step-text';
                    } else {
                        dot.className = 'w-8 h-8 rounded-full border-2 border-white/20 bg-black text-gray-400 flex items-center justify-center text-xs font-bold step-dot';
                        text.className = 'text-[10px] text-gray-500 font-bold uppercase tracking-wider step-text';
                    }
                };

                checkStep('step-1', ['cpu', 'motherboard']);
                checkStep('step-2', ['memory']);
                checkStep('step-3', ['ssd', 'sata', 'hdd']);
                checkStep('step-4', ['gpu']);
                checkStep('step-5', ['psu']);
                checkStep('step-6', ['case']);
                checkStep('step-7', ['cooler', 'fan']);
            };

            // --- Modal Functions ---
            window.openModal = (categoryId) => {
                currentSelectingCategory = categoryId;
                let catName = '';
                let catIcon = '';
                
                componentGroups.forEach(g => g.items.forEach(i => {
                    if(i.id === categoryId) { catName = i.name; catIcon = i.icon; }
                }));
                
                modalTitleEl.innerHTML = `<i class="ph ${catIcon} text-primary"></i> Select ${catName}`;
                
                // Reset Filters
                if(modalSearchEl) modalSearchEl.value = '';
                if(modalSortEl) modalSortEl.value = 'rating_desc';
                if(modalPriceMinEl) modalPriceMinEl.value = '';
                if(modalPriceMaxEl) modalPriceMaxEl.value = '';

                // Dynamically populate filter dropdowns
                const allProds = productsDB[categoryId] || [];
                const populateFilter = (el, key, label) => {
                    if(!el) return;
                    const uniqueVals = [...new Set(allProds.map(p => p[key]).filter(Boolean))].sort();
                    if(uniqueVals.length > 0) {
                        el.parentElement.style.display = 'flex';
                        el.innerHTML = `<option value="">All ${label}</option>` + uniqueVals.map(v => `<option value="${v}">${v}</option>`).join('');
                        el.value = '';
                    } else {
                        el.parentElement.style.display = 'none';
                        el.innerHTML = `<option value="">All ${label}</option>`;
                        el.value = '';
                    }
                };

                populateFilter(modalFilterBrandEl, 'brand', 'Brands');
                populateFilter(modalFilterSocketEl, 'socket', 'Sockets');
                populateFilter(modalFilterPlatformEl, 'platform', 'Platforms');

                renderModalProducts(categoryId);
                
                modalEl.classList.remove('opacity-0', 'pointer-events-none');
                modalEl.querySelector('.liquid-glass-heavy').classList.remove('scale-95');
            };

            const closeModal = () => {
                modalEl.classList.add('opacity-0', 'pointer-events-none');
                modalEl.querySelector('.liquid-glass-heavy').classList.add('scale-95');
            };

            const renderModalProducts = (categoryId) => {
                modalProductsEl.innerHTML = '';
                let products = productsDB[categoryId] || [];

                // Filter logic
                if(modalSearchEl && modalSearchEl.value) {
                    const q = modalSearchEl.value.toLowerCase();
                    products = products.filter(p => p.name.toLowerCase().includes(q) || (p.desc && p.desc.toLowerCase().includes(q)));
                }
                if(modalFilterBrandEl && modalFilterBrandEl.value) {
                    products = products.filter(p => p.brand === modalFilterBrandEl.value);
                }
                if(modalFilterSocketEl && modalFilterSocketEl.value) {
                    products = products.filter(p => p.socket === modalFilterSocketEl.value);
                }
                if(modalFilterPlatformEl && modalFilterPlatformEl.value) {
                    products = products.filter(p => p.platform === modalFilterPlatformEl.value);
                }
                if(modalPriceMinEl && modalPriceMinEl.value) {
                    products = products.filter(p => p.price >= parseFloat(modalPriceMinEl.value));
                }
                if(modalPriceMaxEl && modalPriceMaxEl.value) {
                    products = products.filter(p => p.price <= parseFloat(modalPriceMaxEl.value));
                }

                // Sort logic
                if(modalSortEl && modalSortEl.value) {
                    const sort = modalSortEl.value;
                    products = [...products].sort((a, b) => {
                        if(sort === 'price_asc') return a.price - b.price;
                        if(sort === 'price_desc') return b.price - a.price;
                        if(sort === 'name_asc') return a.name.localeCompare(b.name);
                        if(sort === 'rating_desc') return (b.rating || 0) - (a.rating || 0);
                        return 0;
                    });
                }

                if (products.length === 0) {
                    modalProductsEl.innerHTML = '<div class="col-span-full text-center py-10 text-gray-500">No products found matching your filters.</div>';
                    return;
                }

                products.forEach(prod => {
                    const ratingHtml = prod.rating 
                        ? `<div class="flex items-center gap-1 text-[10px] font-bold text-yellow-500 mb-1"><i class="ph-fill ph-star"></i> ${prod.rating}</div>` 
                        : '';
                        
                    const html = `
                        <div class="bg-black/40 border border-white/10 hover:border-primary/50 rounded-2xl p-4 transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_10px_20px_rgba(255,107,0,0.1)] flex flex-col cursor-pointer group" onclick="selectProduct('${categoryId}', '${prod.id}')">
                            <div class="h-32 w-full bg-white/5 rounded-xl mb-4 p-2 flex items-center justify-center overflow-hidden">
                                <img src="${prod.image}" alt="${prod.name}" class="h-full object-contain mix-blend-lighten group-hover:scale-110 transition-transform duration-500">
                            </div>
                            ${ratingHtml}
                            <h4 class="text-white font-bold mb-1 leading-tight line-clamp-2">${prod.name}</h4>
                            <p class="text-[10px] text-gray-400 mb-4 line-clamp-2">${prod.desc}</p>
                            
                            <div class="mt-auto pt-3 border-t border-white/10 flex items-center justify-between">
                                <span class="text-base font-black text-white">${formatPHP(prod.price)}</span>
                                <button class="w-7 h-7 rounded-full bg-primary/20 text-primary flex items-center justify-center border border-primary/30 group-hover:bg-primary group-hover:text-white transition-colors">
                                    <i class="ph ph-plus"></i>
                                </button>
                            </div>
                        </div>
                    `;
                    modalProductsEl.insertAdjacentHTML('beforeend', html);
                });
            };

            // --- Product Actions ---
            window.selectProduct = (categoryId, productId) => {
                const product = productsDB[categoryId].find(p => p.id === productId);
                if (product) {
                    currentBuild[categoryId] = product;
                    renderComponents();
                    closeModal();
                }
            };

            window.removeProduct = (categoryId) => {
                delete currentBuild[categoryId];
                renderComponents();
            };

            window.updateQty = (categoryId, change) => {
                const product = currentBuild[categoryId];
                if (product) {
                    let newQty = (product.qty || 1) + change;
                    if (categoryId === 'memory') {
                        const mb = currentBuild['motherboard'];
                        const maxSlots = mb ? (mb.slots || 4) : 4;
                        if (newQty < 1) newQty = 1;
                        if (newQty > maxSlots) newQty = maxSlots;
                    } else {
                        if (newQty < 1) newQty = 1;
                    }
                    product.qty = newQty;
                    renderComponents();
                }
            };

            // --- Event Listeners ---
            document.getElementById('close-modal').addEventListener('click', closeModal);
            modalEl.addEventListener('click', (e) => {
                if (e.target === modalEl) closeModal();
            });

            // Filter Event Listeners
            [modalSearchEl, modalSortEl, modalFilterBrandEl, modalFilterSocketEl, modalFilterPlatformEl, modalPriceMinEl, modalPriceMaxEl].forEach(el => {
                if(el) {
                    el.addEventListener('input', () => {
                        if(currentSelectingCategory) renderModalProducts(currentSelectingCategory);
                    });
                }
            });

            if(modalResetFiltersEl) {
                modalResetFiltersEl.addEventListener('click', () => {
                    modalSearchEl.value = '';
                    modalSortEl.value = 'rating_desc';
                    modalFilterBrandEl.value = '';
                    modalFilterSocketEl.value = '';
                    modalFilterPlatformEl.value = '';
                    modalPriceMinEl.value = '';
                    modalPriceMaxEl.value = '';
                    if(currentSelectingCategory) renderModalProducts(currentSelectingCategory);
                });
            }

            document.getElementById('reset-build').addEventListener('click', () => {
                showNotification('Clear Build', 'Are you sure you want to clear your current build?', true, () => {
                    currentBuild = {};
                    renderComponents();
                });
            });
            
            document.getElementById('add-missing-btn').addEventListener('click', () => {
                const essentialMissing = componentGroups.flatMap(g => g.items).find(i => i.essential && !currentBuild[i.id]);
                if(essentialMissing) {
                    openModal(essentialMissing.id);
                } else {
                    showNotification('All Good!', 'No essential components missing!', false);
                }
            });

            document.getElementById('save-build-btn').addEventListener('click', () => {
                if(Object.keys(currentBuild).length === 0) return showNotification('Error', 'Your build is empty!', false);
                const dataStr = "data:text/json;charset=utf-8," + encodeURIComponent(JSON.stringify(currentBuild));
                const downloadAnchorNode = document.createElement('a');
                downloadAnchorNode.setAttribute("href", dataStr);
                downloadAnchorNode.setAttribute("download", "techforge_build.json");
                document.body.appendChild(downloadAnchorNode); 
                downloadAnchorNode.click();
                downloadAnchorNode.remove();
            });

            document.getElementById('load-build-btn').addEventListener('click', () => {
                document.getElementById('load-build-input').click();
            });

            document.getElementById('load-build-input').addEventListener('change', (e) => {
                const file = e.target.files[0];
                if (!file) return;
                const reader = new FileReader();
                reader.onload = (e) => {
                    try {
                        const loadedBuild = JSON.parse(e.target.result);
                        currentBuild = loadedBuild;
                        renderComponents();
                        showNotification('Success', 'Build loaded successfully!', false);
                    } catch (err) {
                        showNotification('Error', 'Failed to parse build file!', false);
                    }
                };
                reader.readAsText(file);
                e.target.value = '';
            });

            // Initialize
            renderComponents();
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
