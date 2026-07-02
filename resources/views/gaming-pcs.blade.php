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



    <!-- Search Overlay -->
    <div id="search-overlay" class="fixed inset-0 bg-black/80 backdrop-blur-sm z-[75] opacity-0 pointer-events-none transition-all duration-300"></div>

    <!-- Nav Overlay (for Peripherals Store dropdown) -->
    <div id="nav-overlay" class="fixed inset-0 bg-black/80 backdrop-blur-sm z-[65] opacity-0 pointer-events-none transition-all duration-300"></div>

    <!-- Navigation -->
    <nav class="fixed w-[calc(100%-2rem)] sm:w-[calc(100%-3rem)] lg:w-[calc(100%-4rem)] max-w-7xl left-1/2 -translate-x-1/2 top-4 z-[80] px-4 sm:px-6 py-3 flex items-center justify-between gap-4 sm:gap-6 transition-all duration-300">
        <!-- Background for Nav to prevent backdrop-filter nesting bug -->
        <div class="absolute inset-0 liquid-glass rounded-2xl -z-10 pointer-events-none"></div>

        <!-- Logo & Name -->
        <a href="{{ url('/') }}" class="flex items-center gap-3 shrink-0 relative z-30">
            <div class="bg-gradient-to-br from-primary to-orange-400 w-10 h-10 rounded-xl flex items-center justify-center shadow-[0_0_15px_rgba(255,107,0,0.4)]">
                <img src="{{ Vite::asset('resources/img/Techforge_Logo.png') }}" alt="TechForge Logo" class="h-6 w-auto object-contain">
            </div>
            <span class="hidden md:block text-xl font-bold tracking-wide text-white">TECHFORGE</span>
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

    <!-- Secondary Navigation -->
    <div id="secondary-nav" class="fixed w-[calc(100%-2rem)] sm:w-[calc(100%-3rem)] lg:w-[calc(100%-4rem)] max-w-7xl left-1/2 -translate-x-1/2 top-[96px] z-[70] hidden md:flex items-center px-6 py-2.5 liquid-glass border border-white/5 rounded-2xl shadow-xl transition-all duration-300">
        <div class="flex items-center gap-8 lg:gap-12 text-[10px] font-bold tracking-widest uppercase">
            <a href="#" class="text-gray-200 hover:text-primary transition-colors py-2">Deals</a>
            
            <div class="relative" id="gaming-pcs-container">
                <a href="#" id="gaming-pcs-btn" class="text-gray-200 hover:text-primary transition-colors flex items-center gap-1.5 py-2 cursor-pointer">
                    Gaming PCs <i id="gaming-pcs-icon" class="ph ph-caret-down text-[10px] text-gray-500 transition-colors"></i>
                </a>

                <!-- Dropdown Mega Menu -->
                <div id="gaming-pcs-dropdown" class="absolute top-[calc(100%+1rem)] -left-2 w-[550px] liquid-glass-heavy border border-white/10 rounded-2xl shadow-[0_20px_50px_rgba(0,0,0,0.8)] opacity-0 pointer-events-none transition-all duration-300 transform translate-y-2 overflow-hidden z-[75]">
                    <div class="grid grid-cols-2 gap-8 pt-8 pb-6 px-8">
                        <!-- Column 1: Shop -->
                        <div>
                            <h4 class="text-[10px] text-gray-500 font-bold uppercase tracking-widest mb-6">Shop</h4>
                            <div class="flex flex-col gap-4">
                                <a href="{{ url('/gaming-pcs') }}" class="block text-gray-300 hover:text-primary transition-colors">
                                    <span class="font-bold text-sm tracking-normal capitalize">All Gaming PCs</span>
                                </a>
                                <a href="#" class="block text-gray-300 hover:text-primary transition-colors">
                                    <span class="font-bold text-sm tracking-normal capitalize">Custom PC Builder</span>
                                </a>
                            </div>
                        </div>

                        <!-- Column 2: Shop By -->
                        <div>
                            <h4 class="text-[10px] text-gray-500 font-bold uppercase tracking-widest mb-6">Shop By</h4>
                            <div class="flex flex-col gap-4">
                                <a href="#" class="block text-gray-300 hover:text-blue-500 transition-colors">
                                    <span class="font-bold text-sm tracking-normal capitalize">Intel Gaming PCs</span>
                                </a>
                                <a href="#" class="block text-gray-300 hover:text-red-500 transition-colors">
                                    <span class="font-bold text-sm tracking-normal capitalize">AMD Gaming PCs</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Banner -->
                    <div class="bg-black/60 border-t border-white/10 p-6 relative overflow-hidden group/banner">
                        <div class="relative z-10 w-[70%]">
                            <p class="text-[9px] text-gray-400 uppercase tracking-widest mb-1">Build from the ground up.</p>
                            <h4 class="text-xl font-bold text-white mb-2">PC FORGE</h4>
                            <p class="text-[11px] text-gray-400 tracking-normal leading-relaxed mb-4 normal-case">Use our exclusive PC Forge tool to build your ultimate rig entirely from scratch, part by part.</p>
                            <a href="{{ route('build-pc') }}" class="inline-block px-5 py-2 border border-white/20 text-xs font-bold text-white rounded-full hover:bg-white hover:text-black transition-all">Launch PC Forge</a>
                        </div>
                        
                        <!-- Decoration -->
                        <div class="absolute -right-4 bottom-0 w-32 h-full flex items-center justify-center opacity-50 group-hover/banner:opacity-100 group-hover/banner:scale-110 transition-all duration-500">
                            <i class="ph-fill ph-cpu text-[100px] text-primary/30 blur-[2px]"></i>
                            <i class="ph-fill ph-hammer text-[70px] text-primary absolute drop-shadow-[0_0_10px_rgba(255,107,0,0.5)]"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="relative" id="gaming-laptops-container">
                <a href="#" id="gaming-laptops-btn" class="text-gray-200 hover:text-primary transition-colors flex items-center gap-1.5 py-2 cursor-pointer">
                    Gaming Laptops <i id="gaming-laptops-icon" class="ph ph-caret-down text-[10px] text-gray-500 transition-colors"></i>
                </a>

                <!-- Dropdown Mega Menu -->
                <div id="gaming-laptops-dropdown" class="absolute top-[calc(100%+1rem)] -left-2 w-[700px] liquid-glass-heavy border border-white/10 rounded-2xl shadow-[0_20px_50px_rgba(0,0,0,0.8)] opacity-0 pointer-events-none transition-all duration-300 transform translate-y-2 overflow-hidden z-[75]">
                    <div class="grid grid-cols-3 gap-8 pt-8 pb-8 px-8">
                        <!-- Column 1: Shop -->
                        <div>
                            <h4 class="text-[10px] text-gray-500 font-bold uppercase tracking-widest mb-6">Shop</h4>
                            <div class="flex flex-col gap-4">
                                <a href="#" class="block text-gray-300 hover:text-primary transition-colors">
                                    <span class="font-bold text-sm tracking-normal capitalize">All Gaming Laptops</span>
                                </a>
                                <a href="#" class="block text-gray-300 hover:text-primary transition-colors">
                                    <span class="font-bold text-sm tracking-normal capitalize">Refurbished Laptops</span>
                                </a>
                            </div>
                        </div>

                        <!-- Column 2: Shop By -->
                        <div>
                            <h4 class="text-[10px] text-gray-500 font-bold uppercase tracking-widest mb-6">Shop By</h4>
                            <div class="flex flex-col gap-4">
                                <a href="#" class="block text-gray-300 hover:text-primary transition-colors">
                                    <span class="font-bold text-sm tracking-normal capitalize">ASUS Laptops</span>
                                </a>
                                <a href="#" class="block text-gray-300 hover:text-primary transition-colors">
                                    <span class="font-bold text-sm tracking-normal capitalize">MSI Laptops</span>
                                </a>
                            </div>
                        </div>

                        <!-- Column 3: Shop By -->
                        <div>
                            <h4 class="text-[10px] text-gray-500 font-bold uppercase tracking-widest mb-6">Shop By</h4>
                            <div class="flex flex-col gap-4">
                                <a href="#" class="block text-gray-300 hover:text-blue-500 transition-colors">
                                    <span class="font-bold text-sm tracking-normal capitalize">Intel Laptops</span>
                                </a>
                                <a href="#" class="block text-gray-300 hover:text-red-500 transition-colors">
                                    <span class="font-bold text-sm tracking-normal capitalize">AMD Laptops</span>
                                </a>
                                <a href="#" class="block text-gray-300 hover:text-green-500 transition-colors">
                                    <span class="font-bold text-sm tracking-normal capitalize">NVIDIA Laptops</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a href="#" class="text-gray-200 hover:text-primary transition-colors py-2">PC Builder</a>
            <div class="relative" id="parts-container">
                <a href="#" id="parts-btn" class="text-gray-200 hover:text-primary transition-colors flex items-center gap-1.5 py-2 cursor-pointer">
                    Parts & Accessories <i id="parts-icon" class="ph ph-caret-down text-[10px] text-gray-500 transition-colors"></i>
                </a>

                <!-- Dropdown Mega Menu -->
                <div id="parts-dropdown" class="absolute top-[calc(100%+1rem)] -left-2 w-[600px] liquid-glass-heavy border border-white/10 rounded-2xl shadow-[0_20px_50px_rgba(0,0,0,0.8)] opacity-0 pointer-events-none transition-all duration-300 transform translate-y-2 overflow-hidden z-[75]">
                    <div class="grid grid-cols-2 gap-8 pt-8 pb-8 px-8">
                        <!-- Column 1: Gaming Accessories and Monitors -->
                        <div>
                            <h4 class="text-[10px] text-gray-500 font-bold uppercase tracking-widest mb-6">Gaming Accessories and Monitors</h4>
                            <div class="flex flex-col gap-4">
                                <a href="#" class="block text-gray-300 hover:text-primary transition-colors"><span class="font-bold text-sm tracking-normal capitalize">Monitors</span></a>
                                <a href="#" class="block text-gray-300 hover:text-primary transition-colors"><span class="font-bold text-sm tracking-normal capitalize">Keyboards</span></a>
                                <a href="#" class="block text-gray-300 hover:text-primary transition-colors"><span class="font-bold text-sm tracking-normal capitalize">Keyboard Accessories</span></a>
                                <a href="#" class="block text-gray-300 hover:text-primary transition-colors"><span class="font-bold text-sm tracking-normal capitalize">Headsets</span></a>
                                <a href="#" class="block text-gray-300 hover:text-primary transition-colors"><span class="font-bold text-sm tracking-normal capitalize">Mice</span></a>
                                <a href="#" class="block text-gray-300 hover:text-primary transition-colors"><span class="font-bold text-sm tracking-normal capitalize">Mouse Pad</span></a>
                                <a href="#" class="block text-gray-300 hover:text-primary transition-colors"><span class="font-bold text-sm tracking-normal capitalize">Speaker Systems</span></a>
                            </div>
                        </div>

                        <!-- Column 2: PC Parts -->
                        <div>
                            <h4 class="text-[10px] text-gray-500 font-bold uppercase tracking-widest mb-6">PC Parts</h4>
                            <div class="flex flex-col gap-4">
                                <a href="#" class="block text-gray-300 hover:text-primary transition-colors"><span class="font-bold text-sm tracking-normal capitalize">Cases</span></a>
                                <a href="#" class="block text-gray-300 hover:text-primary transition-colors"><span class="font-bold text-sm tracking-normal capitalize">Storage</span></a>
                                <a href="#" class="block text-gray-300 hover:text-primary transition-colors"><span class="font-bold text-sm tracking-normal capitalize">Video Cards</span></a>
                                <a href="#" class="block text-gray-300 hover:text-primary transition-colors"><span class="font-bold text-sm tracking-normal capitalize">PC Cooling</span></a>
                                <a href="#" class="block text-gray-300 hover:text-primary transition-colors"><span class="font-bold text-sm tracking-normal capitalize">Power Supplies</span></a>
                                <a href="#" class="block text-gray-300 hover:text-primary transition-colors"><span class="font-bold text-sm tracking-normal capitalize">Motherboards</span></a>
                                <a href="#" class="block text-gray-300 hover:text-primary transition-colors"><span class="font-bold text-sm tracking-normal capitalize">Other Accessories</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a href="#" class="text-gray-200 hover:text-primary transition-colors py-2">Brands</a>
        </div>
    </div>

    <!-- Category Hero -->
    <main class="relative pt-32 pb-16 lg:pt-40 lg:pb-20 overflow-hidden">
        <div class="max-w-[1500px] mx-auto px-6 lg:px-8 relative z-10">
            <div class="liquid-glass-heavy rounded-3xl p-10 md:p-16 border border-white/10 relative overflow-hidden group">
                <div class="absolute inset-0 w-full h-full">
                    <img src="https://images.unsplash.com/photo-1547082299-de196ea013d6?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" alt="All Gaming PCs" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700 opacity-40">
                    <div class="absolute inset-0 bg-gradient-to-r from-[#050505] via-[#050505]/80 to-transparent pointer-events-none"></div>
                </div>
                <div class="relative z-10 w-full md:w-2/3">
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black text-white tracking-wide mb-4">All Gaming PCs</h1>
                    <p class="text-gray-400 text-sm md:text-base leading-relaxed max-w-lg mb-8">Browse our full range of custom and prebuilt gaming PCs. Experience uncompromised performance, ready to ship directly to your door.</p>
                </div>
            </div>
        </div>
    </main>

    <!-- Category Content -->
    <form id="filter-form" method="GET" action="{{ route('gaming-pcs') }}" class="max-w-[1500px] mx-auto px-6 lg:px-8 pb-24 relative z-10 flex flex-col lg:flex-row gap-8">
        
        <!-- Mobile Filter Toggle (Visible on smaller screens) -->
        <button id="mobile-filter-btn" class="lg:hidden w-full liquid-glass rounded-xl p-4 flex items-center justify-between text-white border border-white/10">
            <span class="font-bold">Filters</span>
            <i class="ph ph-sliders text-xl"></i>
        </button>

        <!-- Sidebar / Filters -->
        <aside id="filter-sidebar" class="w-full lg:w-[280px] xl:w-[320px] flex-shrink-0 fixed lg:static top-0 left-0 h-full lg:h-auto z-[100] lg:z-auto bg-gradient-to-b from-[#1a0a05] to-[#0a0402] border border-[#2a110a] rounded-2xl p-6 overflow-y-auto lg:overflow-visible transition-transform duration-300 transform -translate-x-full lg:translate-x-0 shadow-2xl lg:shadow-none">
            
            <!-- Mobile Close Button -->
            <div class="flex justify-between items-center mb-8 lg:hidden">
                <h2 class="text-xl font-bold text-white">Filters</h2>
                <button id="close-filter-btn" class="text-gray-400 hover:text-white">
                    <i class="ph ph-x text-2xl"></i>
                </button>
            </div>

            <!-- Categories -->
            <div class="mb-8">
                <h3 class="text-sm font-bold text-white uppercase tracking-widest mb-4 flex items-center gap-2">
                    <i class="ph ph-list text-primary"></i> Category
                </h3>
                <div class="space-y-3">
                    <label class="flex items-center gap-3 group cursor-pointer">
                        <input type="radio" name="category" value="All PCs" class="appearance-none w-4 h-4 shrink-0 border border-[#5a2810] rounded-full bg-black/40 checked:bg-primary checked:border-primary relative after:content-[''] after:absolute after:hidden checked:after:block after:left-1/2 after:top-1/2 after:-translate-x-1/2 after:-translate-y-1/2 after:w-1.5 after:h-1.5 after:bg-white after:rounded-full transition-all cursor-pointer" {{ request('category', 'All PCs') == 'All PCs' ? 'checked' : '' }}>
                        <span class="text-sm text-gray-300 group-hover:text-white transition-colors">All PCs</span>
                        <span class="text-[10px] text-gray-500 ml-auto">{{ $counts['categories']['All PCs'] }}</span>
                    </label>
                    <label class="flex items-center gap-3 group cursor-pointer">
                        <input type="radio" name="category" value="Prebuilt Desktops" class="appearance-none w-4 h-4 shrink-0 border border-[#5a2810] rounded-full bg-black/40 checked:bg-primary checked:border-primary relative after:content-[''] after:absolute after:hidden checked:after:block after:left-1/2 after:top-1/2 after:-translate-x-1/2 after:-translate-y-1/2 after:w-1.5 after:h-1.5 after:bg-white after:rounded-full transition-all cursor-pointer" {{ request('category') == 'Prebuilt Desktops' ? 'checked' : '' }}>
                        <span class="text-sm text-gray-300 group-hover:text-white transition-colors">Prebuilt Desktops</span>
                        <span class="text-[10px] text-gray-500 ml-auto">{{ $counts['categories']['Prebuilt Desktops'] }}</span>
                    </label>
                    <label class="flex items-center gap-3 group cursor-pointer">
                        <input type="radio" name="category" value="Custom Builds" class="appearance-none w-4 h-4 shrink-0 border border-[#5a2810] rounded-full bg-black/40 checked:bg-primary checked:border-primary relative after:content-[''] after:absolute after:hidden checked:after:block after:left-1/2 after:top-1/2 after:-translate-x-1/2 after:-translate-y-1/2 after:w-1.5 after:h-1.5 after:bg-white after:rounded-full transition-all cursor-pointer" {{ request('category') == 'Custom Builds' ? 'checked' : '' }}>
                        <span class="text-sm text-gray-300 group-hover:text-white transition-colors">Custom Builds</span>
                        <span class="text-[10px] text-gray-500 ml-auto">{{ $counts['categories']['Custom Builds'] }}</span>
                    </label>
                </div>
            </div>

            <!-- Price Range -->
            <div class="mb-8 border-t border-[#3a1810] pt-8">
                <h3 class="text-sm font-bold text-white uppercase tracking-widest mb-4 flex items-center gap-2">
                    <i class="ph ph-currency-circle text-primary"></i> Price
                </h3>
                <div class="flex items-center gap-4">
                    <div class="flex-1 relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-xs">P</span>
                        <input type="number" name="price_min" value="{{ request('price_min') }}" id="price-min" placeholder="Min" class="w-full bg-black/40 border border-[#3a1810] rounded-xl py-2 pl-8 pr-3 text-sm text-white focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all">
                    </div>
                    <span class="text-gray-500">-</span>
                    <div class="flex-1 relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-xs">P</span>
                        <input type="number" name="price_max" value="{{ request('price_max') }}" id="price-max" placeholder="Max" class="w-full bg-black/40 border border-[#3a1810] rounded-xl py-2 pl-8 pr-3 text-sm text-white focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all">
                    </div>
                </div>
            </div>

            <!-- Brands -->
            <div class="mb-8 border-t border-[#3a1810] pt-8">
                <h3 class="text-sm font-bold text-white uppercase tracking-widest mb-4 flex items-center gap-2">
                    <i class="ph ph-tag text-primary"></i> Brand
                </h3>
                <div class="space-y-3">
                    <label class="flex items-center gap-3 group cursor-pointer">
                        <input type="checkbox" name="brand[]" value="TechForge Forge" class="appearance-none w-4 h-4 shrink-0 border border-[#5a2810] rounded-sm bg-black/40 checked:bg-primary checked:border-primary relative after:content-[''] after:absolute after:hidden checked:after:block after:left-1/2 after:top-1/2 after:-translate-x-1/2 after:-translate-y-1/2 after:w-1.5 after:h-1.5 after:bg-white after:rounded-sm transition-all cursor-pointer" {{ in_array('TechForge Forge', request('brand', [])) ? 'checked' : '' }}>
                        <span class="text-sm text-gray-300 group-hover:text-white transition-colors">TechForge Forge</span>
                        <span class="text-[10px] text-gray-500 ml-auto">{{ $counts['brands']['TechForge Forge'] }}</span>
                    </label>
                    <label class="flex items-center gap-3 group cursor-pointer">
                        <input type="checkbox" name="brand[]" value="ASUS ROG" class="appearance-none w-4 h-4 shrink-0 border border-[#5a2810] rounded-sm bg-black/40 checked:bg-primary checked:border-primary relative after:content-[''] after:absolute after:hidden checked:after:block after:left-1/2 after:top-1/2 after:-translate-x-1/2 after:-translate-y-1/2 after:w-1.5 after:h-1.5 after:bg-white after:rounded-sm transition-all cursor-pointer" {{ in_array('ASUS ROG', request('brand', [])) ? 'checked' : '' }}>
                        <span class="text-sm text-gray-300 group-hover:text-white transition-colors">ASUS ROG</span>
                        <span class="text-[10px] text-gray-500 ml-auto">{{ $counts['brands']['ASUS ROG'] }}</span>
                    </label>
                    <label class="flex items-center gap-3 group cursor-pointer">
                        <input type="checkbox" name="brand[]" value="MSI" class="appearance-none w-4 h-4 shrink-0 border border-[#5a2810] rounded-sm bg-black/40 checked:bg-primary checked:border-primary relative after:content-[''] after:absolute after:hidden checked:after:block after:left-1/2 after:top-1/2 after:-translate-x-1/2 after:-translate-y-1/2 after:w-1.5 after:h-1.5 after:bg-white after:rounded-sm transition-all cursor-pointer" {{ in_array('MSI', request('brand', [])) ? 'checked' : '' }}>
                        <span class="text-sm text-gray-300 group-hover:text-white transition-colors">MSI</span>
                        <span class="text-[10px] text-gray-500 ml-auto">{{ $counts['brands']['MSI'] }}</span>
                    </label>
                    <label class="flex items-center gap-3 group cursor-pointer">
                        <input type="checkbox" name="brand[]" value="Lenovo Legion" class="appearance-none w-4 h-4 shrink-0 border border-[#5a2810] rounded-sm bg-black/40 checked:bg-primary checked:border-primary relative after:content-[''] after:absolute after:hidden checked:after:block after:left-1/2 after:top-1/2 after:-translate-x-1/2 after:-translate-y-1/2 after:w-1.5 after:h-1.5 after:bg-white after:rounded-sm transition-all cursor-pointer" {{ in_array('Lenovo Legion', request('brand', [])) ? 'checked' : '' }}>
                        <span class="text-sm text-gray-300 group-hover:text-white transition-colors">Lenovo Legion</span>
                        <span class="text-[10px] text-gray-500 ml-auto">{{ $counts['brands']['Lenovo Legion'] }}</span>
                    </label>
                </div>
            </div>

            <!-- CPU Brand -->
            <div class="border-t border-[#3a1810] pt-8">
                <h3 class="text-sm font-bold text-white uppercase tracking-widest mb-4 flex items-center gap-2">
                    <i class="ph ph-cpu text-primary"></i> Processor
                </h3>
                <div class="space-y-3">
                    <label class="flex items-center gap-3 group cursor-pointer">
                        <input type="checkbox" name="processor[]" value="Intel Core i9" class="appearance-none w-4 h-4 shrink-0 border border-[#5a2810] rounded-sm bg-black/40 checked:bg-primary checked:border-primary relative after:content-[''] after:absolute after:hidden checked:after:block after:left-1/2 after:top-1/2 after:-translate-x-1/2 after:-translate-y-1/2 after:w-1.5 after:h-1.5 after:bg-white after:rounded-sm transition-all cursor-pointer" {{ in_array('Intel Core i9', request('processor', [])) ? 'checked' : '' }}>
                        <span class="text-sm text-gray-300 group-hover:text-white transition-colors">Intel Core i9</span>
                        <span class="text-[10px] text-gray-500 ml-auto">{{ $counts['processors']['Intel Core i9'] }}</span>
                    </label>
                    <label class="flex items-center gap-3 group cursor-pointer">
                        <input type="checkbox" name="processor[]" value="Intel Core i7" class="appearance-none w-4 h-4 shrink-0 border border-[#5a2810] rounded-sm bg-black/40 checked:bg-primary checked:border-primary relative after:content-[''] after:absolute after:hidden checked:after:block after:left-1/2 after:top-1/2 after:-translate-x-1/2 after:-translate-y-1/2 after:w-1.5 after:h-1.5 after:bg-white after:rounded-sm transition-all cursor-pointer" {{ in_array('Intel Core i7', request('processor', [])) ? 'checked' : '' }}>
                        <span class="text-sm text-gray-300 group-hover:text-white transition-colors">Intel Core i7</span>
                        <span class="text-[10px] text-gray-500 ml-auto">{{ $counts['processors']['Intel Core i7'] }}</span>
                    </label>
                    <label class="flex items-center gap-3 group cursor-pointer">
                        <input type="checkbox" name="processor[]" value="AMD Ryzen 9" class="appearance-none w-4 h-4 shrink-0 border border-[#5a2810] rounded-sm bg-black/40 checked:bg-primary checked:border-primary relative after:content-[''] after:absolute after:hidden checked:after:block after:left-1/2 after:top-1/2 after:-translate-x-1/2 after:-translate-y-1/2 after:w-1.5 after:h-1.5 after:bg-white after:rounded-sm transition-all cursor-pointer" {{ in_array('AMD Ryzen 9', request('processor', [])) ? 'checked' : '' }}>
                        <span class="text-sm text-gray-300 group-hover:text-white transition-colors">AMD Ryzen 9</span>
                        <span class="text-[10px] text-gray-500 ml-auto">{{ $counts['processors']['AMD Ryzen 9'] }}</span>
                    </label>
                    <label class="flex items-center gap-3 group cursor-pointer">
                        <input type="checkbox" name="processor[]" value="AMD Ryzen 7" class="appearance-none w-4 h-4 shrink-0 border border-[#5a2810] rounded-sm bg-black/40 checked:bg-primary checked:border-primary relative after:content-[''] after:absolute after:hidden checked:after:block after:left-1/2 after:top-1/2 after:-translate-x-1/2 after:-translate-y-1/2 after:w-1.5 after:h-1.5 after:bg-white after:rounded-sm transition-all cursor-pointer" {{ in_array('AMD Ryzen 7', request('processor', [])) ? 'checked' : '' }}>
                        <span class="text-sm text-gray-300 group-hover:text-white transition-colors">AMD Ryzen 7</span>
                        <span class="text-[10px] text-gray-500 ml-auto">{{ $counts['processors']['AMD Ryzen 7'] }}</span>
                    </label>
                </div>
            </div>

        </aside>

        <!-- Product Grid -->
        <div id="product-grid-area" class="flex-1 w-full lg:w-auto transition-opacity duration-300">
            
            <!-- Controls / Sort -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
                <p class="text-sm text-gray-400">Showing <span class="text-white font-bold">{{ $products->count() }}</span> products</p>
                
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
                
                @forelse($products as $product)
                <!-- Product Card -->
                <div class="bg-gradient-to-b from-[#2a110a] to-[#140502] border border-[#3a1810] rounded-[2rem] p-4 relative overflow-hidden group hover:border-primary/50 transition-all duration-500 hover:shadow-[0_10px_30px_rgba(255,107,0,0.2)] cursor-pointer">
                    <div class="relative rounded-2xl overflow-hidden aspect-[4/3] mb-5 bg-[#0a0a0a]">
                        @if($product->badge)
                            @php
                                $badgeClass = 'bg-black/80 text-white border-white/10';
                                if ($product->badge === 'BEST SELLER') {
                                    $badgeClass = 'bg-primary/20 text-primary border-primary/20';
                                } elseif ($product->badge === 'NEW ARRIVAL') {
                                    $badgeClass = 'bg-[#050505]/80 text-white border-white/10';
                                }
                            @endphp
                            <div class="absolute top-3 left-3 z-10 backdrop-blur-md px-3 py-1 rounded-full text-[10px] font-bold border {{ $badgeClass }}">
                                {{ $product->badge }}
                            </div>
                        @endif

                        @if($product->is_sold_out)
                            <div class="absolute inset-0 bg-black/60 z-10 flex items-center justify-center">
                                <span class="bg-red-600 text-white px-4 py-2 rounded-full font-black text-sm uppercase tracking-widest shadow-lg">Sold Out</span>
                            </div>
                        @endif

                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700 opacity-90 group-hover:opacity-100 {{ $product->is_sold_out ? 'grayscale opacity-50' : '' }}">
                    </div>
                    <div>
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-sm font-bold text-gray-200 group-hover:text-primary transition-colors line-clamp-1">{{ $product->name }}</h3>
                            <div class="flex items-center gap-1 text-primary text-[10px] shrink-0 ml-2">
                                <i class="ph-fill ph-star drop-shadow-[0_0_8px_rgba(255,107,0,0.8)]"></i> {{ $product->rating }}
                            </div>
                        </div>
                        <p class="text-[10px] text-gray-500 uppercase tracking-widest mb-4">{{ $product->specs }}</p>
                        <div class="flex items-center justify-between">
                            <div class="flex flex-col">
                                <span class="text-lg font-black text-white">P{{ number_format($product->price) }}</span>
                            </div>
                            @if(!$product->is_sold_out)
                                <button class="w-10 h-10 rounded-xl bg-white/5 hover:bg-primary text-white border border-white/10 hover:border-transparent flex items-center justify-center transition-all duration-300">
                                    <i class="ph ph-shopping-cart text-lg"></i>
                                </button>
                            @else
                                <button disabled class="w-10 h-10 rounded-xl bg-white/5 text-gray-500 border border-white/10 flex items-center justify-center cursor-not-allowed">
                                    <i class="ph ph-shopping-cart text-lg"></i>
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                    <div class="col-span-1 sm:col-span-2 xl:col-span-3 py-20 flex flex-col items-center justify-center text-center bg-black/20 rounded-[2rem] border border-white/5">
                        <i class="ph ph-magnifying-glass text-6xl text-gray-600 mb-6"></i>
                        <h3 class="text-2xl font-bold text-white mb-2">No products found</h3>
                        <p class="text-gray-400">Try adjusting your filters or search criteria to find what you're looking for.</p>
                    </div>
                @endforelse

            </div>
            
            @if($products->isNotEmpty())
            <!-- Pagination -->
            <div class="flex justify-center mt-12 gap-2">
                <button class="w-10 h-10 rounded-xl liquid-glass border border-white/10 flex items-center justify-center text-gray-400 hover:text-white hover:border-primary/50 transition-colors">
                    <i class="ph-bold ph-caret-left"></i>
                </button>
                <button class="w-10 h-10 rounded-xl bg-primary shadow-[0_0_15px_rgba(255,107,0,0.4)] border border-primary flex items-center justify-center text-white font-bold transition-colors">
                    1
                </button>
                <button class="w-10 h-10 rounded-xl liquid-glass border border-white/10 flex items-center justify-center text-gray-300 hover:text-white hover:border-primary/50 font-bold transition-colors">
                    2
                </button>
                <button class="w-10 h-10 rounded-xl liquid-glass border border-white/10 flex items-center justify-center text-gray-300 hover:text-white hover:border-primary/50 font-bold transition-colors">
                    3
                </button>
                <button class="w-10 h-10 rounded-xl liquid-glass border border-white/10 flex items-center justify-center text-gray-400 hover:text-white hover:border-primary/50 transition-colors">
                    <i class="ph-bold ph-caret-right"></i>
                </button>
            </div>
            @endif

        </div>
    </form>

    <!-- Footer -->
    <footer class="border-t border-white/10 pt-16 pb-8 mt-auto relative z-10">
        <div class="max-w-7xl mx-auto px-10 sm:px-12 lg:px-14">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 lg:gap-8 mb-12">
                
                <!-- Brand -->
                <div class="col-span-1 lg:pr-8">
                    <a href="#" class="flex items-center gap-3 mb-4">
                        <div class="bg-gradient-to-br from-primary to-orange-400 w-10 h-10 rounded-xl flex items-center justify-center shadow-[0_0_15px_rgba(255,107,0,0.4)]">
                            <img src="{{ Vite::asset('resources/img/Techforge_Logo.png') }}" alt="TechForge Logo" class="h-6 w-auto object-contain">
                        </div>
                        <span class="text-xl font-bold tracking-wide text-white">TECHFORGE</span>
                    </a>
                    <p class="text-gray-500 text-xs leading-relaxed mb-6">
                        Performance-driven computers and accessories for every digital journey.
                    </p>
                    <div class="flex items-center gap-3 p-3 rounded-xl bg-white/5 border border-white/10 w-max">
                        <span class="text-[10px] text-gray-500 uppercase tracking-widest font-semibold">Powered by</span>
                        <img src="{{ Vite::asset('resources/img/Nexora_Logo.png') }}" alt="Nexora Logo" class="h-5 w-auto object-contain opacity-80">
                    </div>
                </div>

                <!-- Links 1 -->
                <div>
                    <h4 class="text-primary font-semibold text-sm mb-4">Shop Categories</h4>
                    <ul class="space-y-3 text-xs text-gray-400">
                        <li><a href="#" class="hover:text-white transition-colors flex items-center gap-2"><i class="ph ph-caret-right text-[10px]"></i> PC Components</a></li>
                        <li><a href="#" class="hover:text-white transition-colors flex items-center gap-2"><i class="ph ph-caret-right text-[10px]"></i> Custom Builds</a></li>
                        <li><a href="#" class="hover:text-white transition-colors flex items-center gap-2"><i class="ph ph-caret-right text-[10px]"></i> Laptops & Notebooks</a></li>
                        <li><a href="#" class="hover:text-white transition-colors flex items-center gap-2"><i class="ph ph-caret-right text-[10px]"></i> Gaming Peripherals</a></li>
                        <li><a href="#" class="hover:text-white transition-colors flex items-center gap-2"><i class="ph ph-caret-right text-[10px]"></i> Monitors & Displays</a></li>
                        <li><a href="#" class="hover:text-white transition-colors flex items-center gap-2 text-primary"><i class="ph ph-caret-right text-[10px]"></i> Clearance & Sale</a></li>
                    </ul>
                </div>

                <!-- Links 2 -->
                <div>
                    <h4 class="text-primary font-semibold text-sm mb-4">Company</h4>
                    <ul class="space-y-3 text-xs text-gray-400">
                        <li><a href="#" class="hover:text-white transition-colors flex items-center gap-2"><i class="ph ph-caret-right text-[10px]"></i> About Us</a></li>
                        <li><a href="#" class="hover:text-white transition-colors flex items-center gap-2"><i class="ph ph-caret-right text-[10px]"></i> Careers</a></li>
                        <li><a href="#" class="hover:text-white transition-colors flex items-center gap-2"><i class="ph ph-caret-right text-[10px]"></i> Why TechForge?</a></li>
                        <li><a href="#" class="hover:text-white transition-colors flex items-center gap-2"><i class="ph ph-caret-right text-[10px]"></i> Affiliate Program</a></li>
                        <li><a href="#" class="hover:text-white transition-colors flex items-center gap-2"><i class="ph ph-caret-right text-[10px]"></i> Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-white transition-colors flex items-center gap-2"><i class="ph ph-caret-right text-[10px]"></i> Terms & Conditions</a></li>
                    </ul>
                </div>

                <!-- Links 3 -->
                <div>
                    <h4 class="text-primary font-semibold text-sm mb-4">Customer Support</h4>
                    <ul class="space-y-3 text-xs text-gray-400">
                        <li><a href="#" class="hover:text-white transition-colors flex items-center gap-2"><i class="ph ph-caret-right text-[10px]"></i> Help Center / FAQ</a></li>
                        <li><a href="#" class="hover:text-white transition-colors flex items-center gap-2"><i class="ph ph-caret-right text-[10px]"></i> Track Order</a></li>
                        <li><a href="#" class="hover:text-white transition-colors flex items-center gap-2"><i class="ph ph-caret-right text-[10px]"></i> Shipping Policy</a></li>
                        <li><a href="#" class="hover:text-white transition-colors flex items-center gap-2"><i class="ph ph-caret-right text-[10px]"></i> Returns & Refunds</a></li>
                        <li><a href="#" class="hover:text-white transition-colors flex items-center gap-2"><i class="ph ph-caret-right text-[10px]"></i> Warranty Info</a></li>
                        <li><a href="#" class="hover:text-white transition-colors flex items-center gap-2"><i class="ph ph-caret-right text-[10px]"></i> Contact Us</a></li>
                    </ul>
                </div>
            </div>

            <!-- Bottom -->
            <div class="border-t border-white/10 pt-8 flex flex-col sm:flex-row justify-between items-center gap-4">
                <p class="text-gray-600 text-xs">
                    &copy; {{ date('Y') }} TechForge. All rights reserved.
                </p>
                <div class="flex items-center gap-4 text-gray-400">
                    <a href="#" class="hover:text-primary transition-colors"><i class="ph ph-instagram-logo text-xl"></i></a>
                    <a href="#" class="hover:text-primary transition-colors"><i class="ph ph-twitter-logo text-xl"></i></a>
                    <a href="#" class="hover:text-primary transition-colors"><i class="ph ph-facebook-logo text-xl"></i></a>
                    <a href="#" class="hover:text-primary transition-colors"><i class="ph ph-youtube-logo text-xl"></i></a>
                </div>
            </div>
        </div>
    </footer>


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

    <!-- AJAX Filter Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('filter-form');
            if (form) {
                form.addEventListener('change', function(e) {
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
                            
                            if (newSidebar) document.getElementById('filter-sidebar').innerHTML = newSidebar.innerHTML;
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
                
                // Prevent actual form submission on enter for text/number fields
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