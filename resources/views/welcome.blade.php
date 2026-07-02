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

    <!-- Hero Section -->
    <main class="relative pt-40 pb-20 lg:pt-48 lg:pb-28 overflow-hidden">
        <div class="max-w-7xl mx-auto px-10 sm:px-12 lg:px-14">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 lg:gap-8 items-center">
                
                <!-- Left Content -->
                <div class="z-10">
                    <div class="liquid-glass inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-sm font-bold text-white mb-6 border border-primary/40 bg-primary/10 shadow-[0_0_15px_rgba(255,107,0,0.3)] hover:bg-primary/20 transition-all cursor-pointer">
                        <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                        <i class="ph-fill ph-fire text-primary text-lg"></i> LIMITED TIME: <span class="text-primary">20% OFF</span> ALL CUSTOM BUILDS
                    </div>
                    
                    <h1 class="text-5xl sm:text-6xl lg:text-7xl font-bold leading-tight mb-6">
                        Unleash Your<br/>
                        <span class="text-primary">Ultimate</span><br/>
                        <span class="text-gradient">Performance.</span>
                    </h1>
                    
                    <p class="text-gray-300 text-base sm:text-lg mb-8 max-w-lg leading-relaxed font-light">
                        Level up your setup with premium components and custom-built rigs. Fast shipping, 2-year warranty, and expert support included.
                    </p>
                    
                    <div class="flex flex-wrap items-center gap-5 mb-12">
                        <button class="bg-gradient-to-r from-primary to-[#ff8c33] hover:from-[#ff8c33] hover:to-primary text-white px-9 py-4 rounded-xl font-bold flex items-center gap-3 transition-all duration-300 shadow-[0_0_25px_rgba(255,107,0,0.5)] hover:shadow-[0_0_35px_rgba(255,107,0,0.7)] hover:-translate-y-1 transform text-lg">
                            Claim 20% Off <i class="ph ph-shopping-bag text-xl"></i>
                        </button>
                        <a href="{{ route('build-pc') }}" class="liquid-glass hover:bg-white/10 text-white px-8 py-4 rounded-xl font-semibold transition-all duration-300 flex items-center gap-2 group border border-white/10 hover:border-white/20">
                            Build Your PC <i class="ph ph-caret-right text-gray-400 group-hover:text-white group-hover:translate-x-1 transition-all"></i>
                        </a>
                    </div>

                    <!-- Trust Signals / Stats -->
                    <div class="grid grid-cols-4 gap-4 text-left border-t border-white/10 pt-8">
                        <div>
                            <h4 class="text-xl font-bold text-white">100K+</h4>
                            <p class="text-[10px] text-gray-500 uppercase tracking-wider mt-1">Happy Builders</p>
                        </div>
                        <div>
                            <h4 class="text-xl font-bold text-white">500K+</h4>
                            <p class="text-[10px] text-gray-500 uppercase tracking-wider mt-1">Parts in Stock</p>
                        </div>
                        <div class="relative">
                            <h4 class="text-xl font-bold text-primary">98%</h4>
                            <p class="text-[10px] text-gray-500 uppercase tracking-wider mt-1">Satisfaction Rate</p>
                            <!-- subtle divider -->
                            <div class="absolute -right-2 top-1/2 -translate-y-1/2 w-px h-8 bg-white/5 hidden md:block"></div>
                        </div>
                        <div class="pl-0 md:pl-2">
                            <div class="flex items-center gap-1 mb-1">
                                <i class="ph-fill ph-star text-primary text-sm"></i>
                                <i class="ph-fill ph-star text-primary text-sm"></i>
                                <i class="ph-fill ph-star text-primary text-sm"></i>
                                <i class="ph-fill ph-star text-primary text-sm"></i>
                                <i class="ph-fill ph-star text-primary text-sm"></i>
                            </div>
                            <p class="text-[10px] text-gray-500 uppercase tracking-wider">Top Rated Support</p>
                        </div>
                    </div>
                </div>

                <!-- Right Content (Product Card) -->
                <div class="relative lg:ml-auto w-full max-w-md z-10 perspective-1000">
                    <!-- Floating Promo Badge -->
                    <div class="absolute -top-6 -right-6 z-20 liquid-glass-heavy rounded-2xl px-6 py-3 border border-primary/40 bg-[#050505]/80 shadow-[0_0_30px_rgba(255,107,0,0.3)] transform hover:scale-105 transition-all duration-300 backdrop-blur-md">
                        <div class="text-[10px] text-gray-300 font-bold uppercase tracking-widest mb-1 flex items-center gap-1"><i class="ph-fill ph-clock text-primary"></i> Ends Soon</div>
                        <span class="text-xl font-black text-white z-21">24 HRS LEFT</span>
                    </div>

                    <!-- Product Card -->
                    <div class="liquid-glass-heavy rounded-3xl p-4 border border-white/10 hover:border-primary/40 relative overflow-hidden group transform hover:-translate-y-2 hover:shadow-[0_20px_40px_rgba(255,107,0,0.15)] transition-all duration-500">
                        <!-- Orange ambient glow behind the PC -->
                        <div class="absolute inset-0 bg-primary/5 rounded-3xl blur-3xl group-hover:bg-primary/20 transition-all duration-700"></div>
                        
                        <img id="carousel-img" src="https://images.unsplash.com/photo-1587202372634-32705e3bf49c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="High End PC" class="w-full h-80 object-cover rounded-2xl relative z-10 mb-4 mix-blend-lighten transition-transform duration-700 group-hover:scale-[1.02]">
                        
                        <div class="relative z-10 px-3 pb-3">
                            <div class="flex justify-between items-start mb-1">
                                <h3 id="carousel-title" class="text-lg font-bold text-white transition-all duration-500 group-hover:text-primary">AMD RYZEN 9 5950X w/ RTX 5090</h3>
                            </div>
                            <p id="carousel-desc" class="text-xs text-gray-400 mb-4 transition-all duration-500">Extreme 4K Gaming Performance</p>
                            
                            <div class="flex items-center justify-between mb-5">
                                <div>
                                    <span class="text-xs text-gray-500 line-through mr-2">P70,000</span>
                                    <span id="carousel-price" class="text-2xl font-black text-white transition-all duration-500">P56,000</span>
                                </div>
                                <div class="bg-primary/20 text-primary text-[10px] font-bold px-2 py-1 rounded-md border border-primary/30">
                                    SAVE 20%
                                </div>
                            </div>
                            
                            <button class="w-full bg-white/5 hover:bg-gradient-to-r hover:from-primary hover:to-orange-400 text-white border border-white/10 hover:border-transparent py-3.5 rounded-xl font-semibold transition-all duration-300 flex items-center justify-center gap-2 group/btn">
                                Add to cart <i class="ph ph-shopping-cart text-lg group-hover/btn:animate-bounce"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Pagination Dots -->
                    <div id="carousel-dots" class="absolute top-1/2 -right-12 transform -translate-y-1/2 flex flex-col gap-3 hidden lg:flex">
                        <button class="w-2.5 h-2.5 rounded-full bg-primary shadow-[0_0_12px_rgba(255,107,0,0.8)] transition-all duration-300 focus:outline-none" aria-label="Slide 1"></button>
                        <button class="w-2.5 h-2.5 rounded-full bg-white/20 transition-all duration-300 hover:bg-white/50 focus:outline-none" aria-label="Slide 2"></button>
                        <button class="w-2.5 h-2.5 rounded-full bg-white/20 transition-all duration-300 hover:bg-white/50 focus:outline-none" aria-label="Slide 3"></button>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <!-- Features Banner -->
    <div class="max-w-7xl mx-auto px-10 sm:px-12 lg:px-14 relative z-20 mb-24">
        <div class="liquid-glass rounded-2xl p-6 sm:p-8 flex flex-col sm:flex-row justify-between items-center gap-6 sm:gap-4 divide-y sm:divide-y-0 sm:divide-x divide-white/10">
            <div class="flex items-center gap-4 px-4 w-full justify-center sm:justify-start">
                <i class="ph-fill ph-lightning text-2xl text-primary"></i>
                <div>
                    <h4 class="text-sm font-bold text-white">Fast Dispatch</h4>
                    <p class="text-[10px] text-gray-400">Ships within 24 hrs</p>
                </div>
            </div>
            <div class="flex items-center gap-4 px-4 w-full justify-center sm:justify-start pt-4 sm:pt-0">
                <i class="ph-fill ph-shield-check text-2xl text-primary"></i>
                <div>
                    <h4 class="text-sm font-bold text-white">2 Year Warranty</h4>
                    <p class="text-[10px] text-gray-400">Full Coverage</p>
                </div>
            </div>
            <div class="flex items-center gap-4 px-4 w-full justify-center sm:justify-start pt-4 sm:pt-0">
                <i class="ph-fill ph-package text-2xl text-primary"></i>
                <div>
                    <h4 class="text-sm font-bold text-white">Free Returns</h4>
                    <p class="text-[10px] text-gray-400">30-Day Window</p>
                </div>
            </div>
            <div class="flex items-center gap-4 px-4 w-full justify-center sm:justify-start pt-4 sm:pt-0">
                <i class="ph-fill ph-medal text-2xl text-primary"></i>
                <div>
                    <h4 class="text-sm font-bold text-white">Loyalty Points</h4>
                    <p class="text-[10px] text-gray-400">Earn on every buy</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Today's Best Deals -->
    <section class="max-w-7xl mx-auto px-10 sm:px-12 lg:px-14 mb-24 relative z-10">
        <div class="flex justify-between items-end mb-10 border-b border-white/10 pb-4">
            <div>
                <p class="text-primary text-xs font-bold tracking-widest uppercase mb-2 flex items-center gap-2"><i class="ph-fill ph-tag text-lg"></i> Special Offers</p>
                <h2 class="text-3xl sm:text-4xl font-black text-white">Today's Best Deals</h2>
            </div>
            <button class="hidden sm:flex items-center gap-2 text-sm font-bold text-gray-400 hover:text-white transition-colors group">
                See More <i class="ph ph-arrow-right group-hover:translate-x-1 transition-transform"></i>
            </button>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Product 1 -->
            <div class="liquid-glass rounded-[2rem] p-4 relative overflow-hidden group hover:border-primary/30 transition-all duration-500 hover:shadow-[0_10px_30px_rgba(255,107,0,0.15)] cursor-pointer">
                <div class="relative rounded-2xl overflow-hidden aspect-[4/3] mb-5 bg-[#0a0a0a]">
                    <div class="absolute top-3 left-3 z-10 bg-[#050505]/80 backdrop-blur-md px-3 py-1 rounded-full text-[10px] font-bold text-white border border-white/10">
                        SAVE 15%
                    </div>
                    <img src="https://images.unsplash.com/photo-1595225476474-87563907a212?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Keyboard" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700 opacity-90 group-hover:opacity-100">
                </div>
                <div>
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-sm font-bold text-gray-200 group-hover:text-primary transition-colors line-clamp-1">Gamakay TM680 Mechanical</h3>
                        <div class="flex items-center gap-1 text-primary text-[10px] shrink-0 ml-2">
                            <i class="ph-fill ph-star"></i> 4.9
                        </div>
                    </div>
                    <p class="text-[10px] text-gray-500 uppercase tracking-widest mb-4">Peripherals</p>
                    <div class="flex items-center justify-between">
                        <div class="flex flex-col">
                            <span class="text-xs text-gray-500 line-through">P5,700</span>
                            <span class="text-lg font-black text-white">P4,845</span>
                        </div>
                        <button class="w-10 h-10 rounded-xl bg-white/5 hover:bg-primary text-white border border-white/10 hover:border-transparent flex items-center justify-center transition-all duration-300">
                            <i class="ph ph-shopping-cart text-lg"></i>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Product 2 -->
            <div class="liquid-glass rounded-[2rem] p-4 relative overflow-hidden group hover:border-primary/30 transition-all duration-500 hover:shadow-[0_10px_30px_rgba(255,107,0,0.15)] cursor-pointer">
                <div class="relative rounded-2xl overflow-hidden aspect-[4/3] mb-5 bg-[#0a0a0a]">
                    <div class="absolute top-3 left-3 z-10 bg-[#050505]/80 backdrop-blur-md px-3 py-1 rounded-full text-[10px] font-bold text-white border border-white/10">
                        SAVE 25%
                    </div>
                    <img src="https://images.unsplash.com/photo-1758577675588-c5bbbbbf8e97?q=80&w=1074&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="RAM" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700 opacity-90 group-hover:opacity-100">
                </div>
                <div>
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-sm font-bold text-gray-200 group-hover:text-primary transition-colors line-clamp-1">T-Force Delta RGB 32GB</h3>
                        <div class="flex items-center gap-1 text-primary text-[10px] shrink-0 ml-2">
                            <i class="ph-fill ph-star"></i> 4.8
                        </div>
                    </div>
                    <p class="text-[10px] text-gray-500 uppercase tracking-widest mb-4">Memory</p>
                    <div class="flex items-center justify-between">
                        <div class="flex flex-col">
                            <span class="text-xs text-gray-500 line-through">P6,600</span>
                            <span class="text-lg font-black text-white">P4,995</span>
                        </div>
                        <button class="w-10 h-10 rounded-xl bg-white/5 hover:bg-primary text-white border border-white/10 hover:border-transparent flex items-center justify-center transition-all duration-300">
                            <i class="ph ph-shopping-cart text-lg"></i>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Product 3 -->
            <div class="liquid-glass rounded-[2rem] p-4 relative overflow-hidden group hover:border-primary/30 transition-all duration-500 hover:shadow-[0_10px_30px_rgba(255,107,0,0.15)] cursor-pointer">
                <div class="relative rounded-2xl overflow-hidden aspect-[4/3] mb-5 bg-[#0a0a0a]">
                    <div class="absolute top-3 left-3 z-10 bg-[#050505]/80 backdrop-blur-md px-3 py-1 rounded-full text-[10px] font-bold text-white border border-white/10">
                        HOT DEAL
                    </div>
                    <img src="https://images.unsplash.com/photo-1593640408182-31c70c8268f5?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Monitor" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700 opacity-90 group-hover:opacity-100">
                </div>
                <div>
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-sm font-bold text-gray-200 group-hover:text-primary transition-colors line-clamp-1">ASUS ROG Swift 144Hz</h3>
                        <div class="flex items-center gap-1 text-primary text-[10px] shrink-0 ml-2">
                            <i class="ph-fill ph-star"></i> 5.0
                        </div>
                    </div>
                    <p class="text-[10px] text-gray-500 uppercase tracking-widest mb-4">Monitors</p>
                    <div class="flex items-center justify-between">
                        <div class="flex flex-col">
                            <span class="text-xs text-gray-500 line-through">P28,000</span>
                            <span class="text-lg font-black text-white">P23,500</span>
                        </div>
                        <button class="w-10 h-10 rounded-xl bg-white/5 hover:bg-primary text-white border border-white/10 hover:border-transparent flex items-center justify-center transition-all duration-300">
                            <i class="ph ph-shopping-cart text-lg"></i>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Product 4 -->
            <div class="liquid-glass rounded-[2rem] p-4 relative overflow-hidden group hover:border-primary/30 transition-all duration-500 hover:shadow-[0_10px_30px_rgba(255,107,0,0.15)] cursor-pointer">
                <div class="relative rounded-2xl overflow-hidden aspect-[4/3] mb-5 bg-[#0a0a0a]">
                    <div class="absolute top-3 left-3 z-10 bg-[#050505]/80 backdrop-blur-md px-3 py-1 rounded-full text-[10px] font-bold text-white border border-white/10">
                        SAVE 10%
                    </div>
                    <img src="https://ecommerce.datablitz.com.ph/cdn/shop/files/GHGFVCGFDGFD.jpg?v=1705736447" alt="SSD" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700 opacity-90 group-hover:opacity-100">
                </div>
                <div>
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-sm font-bold text-gray-200 group-hover:text-primary transition-colors line-clamp-1">Samsung 980 PRO 1TB</h3>
                        <div class="flex items-center gap-1 text-primary text-[10px] shrink-0 ml-2">
                            <i class="ph-fill ph-star"></i> 4.9
                        </div>
                    </div>
                    <p class="text-[10px] text-gray-500 uppercase tracking-widest mb-4">Storage</p>
                    <div class="flex items-center justify-between">
                        <div class="flex flex-col">
                            <span class="text-xs text-gray-500 line-through">P6,500</span>
                            <span class="text-lg font-black text-white">P5,850</span>
                        </div>
                        <button class="w-10 h-10 rounded-xl bg-white/5 hover:bg-primary text-white border border-white/10 hover:border-transparent flex items-center justify-center transition-all duration-300">
                            <i class="ph ph-shopping-cart text-lg"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <button class="w-full sm:hidden mt-6 bg-white/5 hover:bg-white/10 py-4 rounded-xl text-sm font-bold border border-white/10 flex items-center justify-center gap-2 transition-colors">
            See More <i class="ph ph-arrow-right"></i>
        </button>
    </section>

    <!-- Featured Products -->
    <section class="max-w-7xl mx-auto px-10 sm:px-12 lg:px-14 mb-24 relative z-10">
        <div class="flex justify-between items-end mb-10 border-b border-white/10 pb-4">
            <div>
                <p class="text-primary text-xs font-bold tracking-widest uppercase mb-2 flex items-center gap-2"><i class="ph-fill ph-star text-lg"></i> Top Picks</p>
                <h2 class="text-3xl sm:text-4xl font-black text-white">Featured Products</h2>
            </div>
            <button class="hidden sm:flex items-center gap-2 text-sm font-bold text-gray-400 hover:text-white transition-colors group">
                Browse All <i class="ph ph-arrow-right group-hover:translate-x-1 transition-transform"></i>
            </button>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Product 1 -->
            <div class="liquid-glass rounded-[2rem] p-4 relative overflow-hidden group hover:border-primary/30 transition-all duration-500 hover:shadow-[0_10px_30px_rgba(255,107,0,0.15)] cursor-pointer">
                <div class="relative rounded-2xl overflow-hidden aspect-[4/3] mb-5 bg-[#0a0a0a]">
                    <img src="https://images.unsplash.com/photo-1591488320449-011701bb6704?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="GPU" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700 opacity-90 group-hover:opacity-100">
                </div>
                <div>
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-sm font-bold text-gray-200 group-hover:text-primary transition-colors line-clamp-1">GIGABYTE RTX 5090</h3>
                        <div class="flex items-center gap-1 text-primary text-[10px] shrink-0 ml-2">
                            <i class="ph-fill ph-star"></i> 5.0
                        </div>
                    </div>
                    <p class="text-[10px] text-gray-500 uppercase tracking-widest mb-4">Graphics Cards</p>
                    <div class="flex items-center justify-between">
                        <div class="flex flex-col">
                            <span class="text-lg font-black text-white">P266,250</span>
                        </div>
                        <button class="w-10 h-10 rounded-xl bg-white/5 hover:bg-primary text-white border border-white/10 hover:border-transparent flex items-center justify-center transition-all duration-300">
                            <i class="ph ph-shopping-cart text-lg"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Product 2 -->
            <div class="liquid-glass rounded-[2rem] p-4 relative overflow-hidden group hover:border-primary/30 transition-all duration-500 hover:shadow-[0_10px_30px_rgba(255,107,0,0.15)] cursor-pointer">
                <div class="relative rounded-2xl overflow-hidden aspect-[4/3] mb-5 bg-[#0a0a0a]">
                    <img src="https://dlcdnwebimgs.asus.com/files/media/0CBC145C-59B8-4B51-BF1A-DA0749FA1522/v1/img/kv/pd.png" alt="Motherboard" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700 opacity-90 group-hover:opacity-100">
                </div>
                <div>
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-sm font-bold text-gray-200 group-hover:text-primary transition-colors line-clamp-1">ASUS ROG Crosshair X670E</h3>
                        <div class="flex items-center gap-1 text-primary text-[10px] shrink-0 ml-2">
                            <i class="ph-fill ph-star"></i> 4.9
                        </div>
                    </div>
                    <p class="text-[10px] text-gray-500 uppercase tracking-widest mb-4">Motherboards</p>
                    <div class="flex items-center justify-between">
                        <div class="flex flex-col">
                            <span class="text-lg font-black text-white">P35,000</span>
                        </div>
                        <button class="w-10 h-10 rounded-xl bg-white/5 hover:bg-primary text-white border border-white/10 hover:border-transparent flex items-center justify-center transition-all duration-300">
                            <i class="ph ph-shopping-cart text-lg"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Product 3 -->
            <div class="liquid-glass rounded-[2rem] p-4 relative overflow-hidden group hover:border-primary/30 transition-all duration-500 hover:shadow-[0_10px_30px_rgba(255,107,0,0.15)] cursor-pointer">
                <div class="relative rounded-2xl overflow-hidden aspect-[4/3] mb-5 bg-[#0a0a0a]">
                    <img src="https://m.media-amazon.com/images/I/61aQ0AzVAML._AC_SL1500_.jpg" alt="CPU" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700 opacity-90 group-hover:opacity-100">
                </div>
                <div>
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-sm font-bold text-gray-200 group-hover:text-primary transition-colors line-clamp-1">Intel Core i9-14900K</h3>
                        <div class="flex items-center gap-1 text-primary text-[10px] shrink-0 ml-2">
                            <i class="ph-fill ph-star"></i> 4.8
                        </div>
                    </div>
                    <p class="text-[10px] text-gray-500 uppercase tracking-widest mb-4">Processors</p>
                    <div class="flex items-center justify-between">
                        <div class="flex flex-col">
                            <span class="text-lg font-black text-white">P34,500</span>
                        </div>
                        <button class="w-10 h-10 rounded-xl bg-white/5 hover:bg-primary text-white border border-white/10 hover:border-transparent flex items-center justify-center transition-all duration-300">
                            <i class="ph ph-shopping-cart text-lg"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Product 4 -->
            <div class="liquid-glass rounded-[2rem] p-4 relative overflow-hidden group hover:border-primary/30 transition-all duration-500 hover:shadow-[0_10px_30px_rgba(255,107,0,0.15)] cursor-pointer">
                <div class="relative rounded-2xl overflow-hidden aspect-[4/3] mb-5 bg-[#0a0a0a]">
                    <img src="https://images.unsplash.com/photo-1660855551570-dd44e0ab800c?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Case" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700 opacity-90 group-hover:opacity-100">
                </div>
                <div>
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-sm font-bold text-gray-200 group-hover:text-primary transition-colors line-clamp-1">Lian Li O11 Dynamic EVO</h3>
                        <div class="flex items-center gap-1 text-primary text-[10px] shrink-0 ml-2">
                            <i class="ph-fill ph-star"></i> 4.9
                        </div>
                    </div>
                    <p class="text-[10px] text-gray-500 uppercase tracking-widest mb-4">Cases</p>
                    <div class="flex items-center justify-between">
                        <div class="flex flex-col">
                            <span class="text-lg font-black text-white">P9,200</span>
                        </div>
                        <button class="w-10 h-10 rounded-xl bg-white/5 hover:bg-primary text-white border border-white/10 hover:border-transparent flex items-center justify-center transition-all duration-300">
                            <i class="ph ph-shopping-cart text-lg"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <button class="w-full sm:hidden mt-6 bg-white/5 hover:bg-white/10 py-4 rounded-xl text-sm font-bold border border-white/10 flex items-center justify-center gap-2 transition-colors">
            Browse All <i class="ph ph-arrow-right"></i>
        </button>
    </section>

    <!-- Browse By Category (Bento Grid) -->
    <section id="categories" class="max-w-7xl mx-auto px-10 sm:px-12 lg:px-14 mb-24 relative z-10">
        <div class="mb-10 border-b border-white/10 pb-4">
            <p class="text-primary text-xs font-bold tracking-widest uppercase mb-2 flex items-center gap-2"><i class="ph-fill ph-squares-four text-lg"></i> Explore Categories</p>
            <h2 class="text-3xl sm:text-4xl font-black text-white">Find Your Needs</h2>
        </div>

        <div class="flex flex-col gap-6">
            <!-- Top Row: 2 Items -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- All Gaming PCs -->
                <div class="relative rounded-3xl overflow-hidden group h-[350px] lg:h-[400px] cursor-pointer border border-white/10 hover:border-primary/50 transition-all duration-500 shadow-[0_10px_30px_rgba(0,0,0,0.5)] hover:shadow-[0_10px_40px_rgba(255,107,0,0.15)] bg-[#0d0d0d]">
                    <div class="absolute right-0 top-0 bottom-0 w-full md:w-3/4">
                        <img src="https://images.unsplash.com/photo-1547082299-de196ea013d6?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" alt="All Gaming PCs" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700 opacity-60" style="mask-image: linear-gradient(to right, transparent, black 30%); -webkit-mask-image: linear-gradient(to right, transparent, black 30%);">
                        <div class="absolute inset-0 bg-gradient-to-r from-[#0d0d0d] via-[#0d0d0d]/60 to-transparent pointer-events-none"></div>
                    </div>
                    <div class="absolute inset-0 p-8 md:p-12 flex flex-col justify-center w-full md:w-[70%] z-10">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 rounded-xl bg-primary/20 flex items-center justify-center border border-primary/50">
                                <i class="ph-fill ph-desktop text-xl text-primary"></i>
                            </div>
                            <h3 class="text-3xl font-black text-white tracking-wide">All Gaming PCs</h3>
                        </div>
                        <p class="text-sm text-gray-400 mb-8 leading-relaxed max-w-sm">Browse through our full range of custom and prebuilt gaming PCs to find your perfect computer. Ready-to-ship with warranty and support.</p>
                        <a href="{{ url('/gaming-pcs') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 liquid-glass hover:bg-white/10 border border-white/10 text-white text-xs font-bold rounded-full transition-all w-max group/btn hover:shadow-lg">
                            Browse All PCs <i class="ph-bold ph-arrow-right group-hover/btn:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                </div>

                <!-- Custom PC Builder -->
                <div class="relative rounded-3xl overflow-hidden group h-[350px] lg:h-[400px] cursor-pointer border border-white/10 hover:border-primary/50 transition-all duration-500 shadow-[0_10px_30px_rgba(0,0,0,0.5)] hover:shadow-[0_10px_40px_rgba(255,107,0,0.15)] bg-[#111]">
                    <div class="absolute right-0 top-0 bottom-0 w-full md:w-3/4">
                        <img src="https://images.unsplash.com/photo-1618339220157-daa2cd9ade56?q=80&w=1935&auto=format&fit=crop" alt="Custom PC Builder" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700 opacity-50" style="mask-image: linear-gradient(to right, transparent, black 30%); -webkit-mask-image: linear-gradient(to right, transparent, black 30%);">
                        <div class="absolute inset-0 bg-gradient-to-r from-[#111] via-[#111]/60 to-transparent pointer-events-none"></div>
                    </div>
                    <div class="absolute inset-0 p-8 md:p-12 flex flex-col justify-center w-full md:w-[70%] z-10">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center border border-white/20">
                                <i class="ph-fill ph-wrench text-xl text-white"></i>
                            </div>
                            <h3 class="text-3xl font-black text-white tracking-wide">Custom Gaming PCs</h3>
                        </div>
                        <p class="text-sm text-gray-400 mb-8 leading-relaxed max-w-sm">Customize your PC with top brands like Intel, AMD, and ASUS, with no compatibility worries. What's best is that we'll build it for you!</p>
                        <a href="#" class="inline-flex items-center justify-center gap-2 px-6 py-3 liquid-glass hover:bg-white/10 border border-white/10 text-white text-xs font-bold rounded-full transition-all w-max group/btn hover:shadow-lg">
                            Start Building Your Own <i class="ph-bold ph-arrow-right group-hover/btn:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Bottom Row: 3 Items -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- PC Forge -->
                <div class="relative rounded-3xl overflow-hidden group h-[320px] cursor-pointer border border-white/10 hover:border-primary/50 transition-all duration-500 shadow-[0_10px_30px_rgba(0,0,0,0.5)] bg-[#050505]">
                    <img src="https://images.unsplash.com/photo-1587202372775-e229f172b9d7?q=80&w=800&auto=format&fit=crop" alt="PC Forge" class="absolute bottom-0 left-0 w-full h-[70%] object-cover transform group-hover:scale-105 transition-transform duration-700 opacity-60">
                    <div class="absolute bottom-0 left-0 w-full h-full bg-gradient-to-t from-[#050505] via-[#050505]/40 to-[#050505]"></div>
                    <div class="absolute inset-0 pt-10 px-8 flex flex-col items-center text-center z-10">
                        <h3 class="text-2xl font-black text-white tracking-wide mb-2">PC Forge</h3>
                        <p class="text-[13px] text-gray-400 mb-6 max-w-[220px] h-[60px]">Customize your ideal PC from scratch, and we'll ship it out in about 5 business days.</p>
                        <a href="#" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 liquid-glass hover:bg-white/10 border border-white/10 text-primary text-[13px] font-bold rounded-full transition-all group/link shadow-lg">
                            Build Now <i class="ph-bold ph-arrow-right group-hover/link:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                </div>

                <!-- Gaming Laptops -->
                <div class="relative rounded-3xl overflow-hidden group h-[320px] cursor-pointer border border-white/10 hover:border-primary/50 transition-all duration-500 shadow-[0_10px_30px_rgba(0,0,0,0.5)] bg-[#050505]">
                    <img src="https://images.unsplash.com/photo-1603302576837-37561b2e2302?q=80&w=800&auto=format&fit=crop" alt="Gaming Laptops" class="absolute bottom-0 left-1/2 -translate-x-1/2 w-[85%] h-auto object-contain transform group-hover:scale-105 group-hover:-translate-y-2 transition-transform duration-700 opacity-80 drop-shadow-[0_10px_15px_rgba(0,0,0,0.8)]">
                    <div class="absolute bottom-0 left-0 w-full h-[50%] bg-gradient-to-t from-[#050505] to-transparent"></div>
                    <div class="absolute inset-0 pt-10 px-8 flex flex-col items-center text-center z-10">
                        <h3 class="text-2xl font-black text-white tracking-wide mb-2">Gaming Laptops</h3>
                        <p class="text-[13px] text-gray-400 mb-6 max-w-[220px] h-[60px]">Immerse yourself in the ultimate gaming experience on the go.</p>
                        <a href="#" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 liquid-glass hover:bg-white/10 border border-white/10 text-blue-500 text-[13px] font-bold rounded-full transition-all group/link shadow-lg">
                            Browse More <i class="ph-bold ph-arrow-right group-hover/link:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                </div>

                <!-- Parts & Accessories -->
                <div class="relative rounded-3xl overflow-hidden group h-[320px] cursor-pointer border border-white/10 hover:border-primary/50 transition-all duration-500 shadow-[0_10px_30px_rgba(0,0,0,0.5)] bg-[#050505]">
                    <img src="https://images.unsplash.com/photo-1595225476474-87563907a212?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Parts" class="absolute bottom-0 left-0 w-full h-[60%] object-cover transform group-hover:scale-105 transition-transform duration-700 opacity-50">
                    <div class="absolute bottom-0 left-0 w-full h-[80%] bg-gradient-to-t from-[#050505] via-[#050505]/60 to-transparent"></div>
                    <div class="absolute inset-0 pt-10 px-8 flex flex-col items-center text-center z-10">
                        <h3 class="text-2xl font-black text-white tracking-wide mb-2">Parts & Accessories</h3>
                        <p class="text-[13px] text-gray-400 mb-6 max-w-[220px] h-[60px]">Gear up and be game ready with your favorite gaming accessories, monitors, PC parts, and more!</p>
                        <a href="#" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 liquid-glass hover:bg-white/10 border border-white/10 text-green-500 text-[13px] font-bold rounded-full transition-all group/link shadow-lg">
                            Gear Up <i class="ph-bold ph-arrow-right group-hover/link:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
    @vite('resources/js/HomePage/Homepage.js')
</body>
</html>