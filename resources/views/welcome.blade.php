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
    </style>

    @vite('resources/css/liquidglass.css')
</head>
<body class="relative antialiased selection:bg-primary selection:text-white">

    <!-- Background Ambient Effects -->
    <div class="ambient-light-1"></div>
    <div class="ambient-light-2"></div>

    <!-- Sidebar Overlay -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[55] opacity-0 pointer-events-none transition-all duration-300"></div>

    <!-- Sidebar Menu Wrapper -->
    <aside id="sidebar-wrapper" class="fixed left-4 lg:left-8 top-1/2 -translate-y-1/2 z-[60] flex items-start pointer-events-none">
        
        <!-- Main Sidebar -->
        <div id="main-sidebar" class="w-[72px] bg-[#161212]/95 backdrop-blur-md border border-white/5 rounded-[2.5rem] transition-all duration-500 ease-in-out flex flex-col relative z-20 overflow-hidden pointer-events-auto py-5 shadow-2xl">
            
            <!-- Hamburger Button -->
            <div id="hamburger-btn" class="flex items-center shrink-0 w-full cursor-pointer relative h-12 mb-3">
                <div class="w-12 h-12 bg-gradient-to-br from-[#ff8c33] to-[#d65a00] rounded-[14px] flex items-center justify-center absolute left-3 shadow-[0_4px_15px_rgba(214,90,0,0.4)] transition-transform duration-300 hover:scale-105">
                    <i class="ph ph-list text-xl text-white"></i>
                </div>
                <span id="sidebar-title" class="absolute left-20 font-bold tracking-wider text-sm whitespace-nowrap opacity-0 transition-opacity duration-300 text-white pointer-events-none">ALL DEPARTMENTS</span>
            </div>

            <!-- Divider -->
            <div id="sidebar-divider" class="w-8 h-[1px] bg-white/10 mx-auto my-3 shrink-0 transition-all duration-300"></div>

            <!-- Categories -->
            <nav class="flex-1 flex flex-col gap-2 px-3 py-2 custom-scrollbar">
                
                <a href="#" class="sidebar-item flex items-center px-0 py-3 rounded-2xl transition-colors text-gray-400 hover:text-white w-[240px] relative h-12 group/item" data-category="components">
                    <div class="w-12 h-12 flex items-center justify-center shrink-0 absolute left-0">
                        <i class="ph ph-cpu text-2xl text-primary transition-transform duration-300 group-hover/item:scale-110 drop-shadow-[0_0_8px_rgba(255,107,0,0.4)]"></i>
                    </div>
                    <span class="sidebar-label text-sm font-medium whitespace-nowrap absolute left-16 opacity-0 transition-opacity duration-300 text-gray-300">Components & Storage</span>
                    <i class="ph ph-caret-right text-xs absolute right-6 opacity-0 transition-opacity duration-300"></i>
                </a>

                <a href="#" class="sidebar-item flex items-center px-0 py-3 rounded-2xl transition-colors text-gray-400 hover:text-white w-[240px] relative h-12 group/item" data-category="systems">
                    <div class="w-12 h-12 flex items-center justify-center shrink-0 absolute left-0">
                        <i class="ph ph-desktop text-2xl text-primary transition-transform duration-300 group-hover/item:scale-110 drop-shadow-[0_0_8px_rgba(255,107,0,0.4)]"></i>
                    </div>
                    <span class="sidebar-label text-sm font-medium whitespace-nowrap absolute left-16 opacity-0 transition-opacity duration-300 text-gray-300">Computer Systems</span>
                    <i class="ph ph-caret-right text-xs absolute right-6 opacity-0 transition-opacity duration-300"></i>
                </a>

                <a href="#" class="sidebar-item flex items-center px-0 py-3 rounded-2xl transition-colors text-gray-400 hover:text-white w-[240px] relative h-12 group/item" data-category="peripherals">
                    <div class="w-12 h-12 flex items-center justify-center shrink-0 absolute left-0">
                        <i class="ph ph-mouse text-2xl text-primary transition-transform duration-300 group-hover/item:scale-110 drop-shadow-[0_0_8px_rgba(255,107,0,0.4)]"></i>
                    </div>
                    <span class="sidebar-label text-sm font-medium whitespace-nowrap absolute left-16 opacity-0 transition-opacity duration-300 text-gray-300">Computer Peripherals</span>
                    <i class="ph ph-caret-right text-xs absolute right-6 opacity-0 transition-opacity duration-300"></i>
                </a>

                <a href="#" class="sidebar-item flex items-center px-0 py-3 rounded-2xl transition-colors text-gray-400 hover:text-white w-[240px] relative h-12 group/item" data-category="electronics">
                    <div class="w-12 h-12 flex items-center justify-center shrink-0 absolute left-0">
                        <i class="ph ph-headphones text-2xl text-primary transition-transform duration-300 group-hover/item:scale-110 drop-shadow-[0_0_8px_rgba(255,107,0,0.4)]"></i>
                    </div>
                    <span class="sidebar-label text-sm font-medium whitespace-nowrap absolute left-16 opacity-0 transition-opacity duration-300 text-gray-300">Electronics</span>
                    <i class="ph ph-caret-right text-xs absolute right-6 opacity-0 transition-opacity duration-300"></i>
                </a>

                <a href="#" class="sidebar-item flex items-center px-0 py-3 rounded-2xl transition-colors text-gray-400 hover:text-white w-[240px] relative h-12 group/item" data-category="gaming">
                    <div class="w-12 h-12 flex items-center justify-center shrink-0 absolute left-0">
                        <i class="ph ph-game-controller text-2xl text-primary transition-transform duration-300 group-hover/item:scale-110 drop-shadow-[0_0_8px_rgba(255,107,0,0.4)]"></i>
                    </div>
                    <span class="sidebar-label text-sm font-medium whitespace-nowrap absolute left-16 opacity-0 transition-opacity duration-300 text-gray-300">Gaming</span>
                    <i class="ph ph-caret-right text-xs absolute right-6 opacity-0 transition-opacity duration-300"></i>
                </a>

            </nav>
        </div>

        <!-- Mega Menu -->
        <div id="mega-menu" class="bg-[#120f0f]/98 backdrop-blur-xl border border-white/10 rounded-3xl opacity-0 pointer-events-none transition-all duration-500 -translate-x-8 absolute left-full top-1/2 -translate-y-1/2 z-10 shadow-2xl flex px-10 py-8 gap-16 ml-4 max-h-[80vh] overflow-y-auto custom-scrollbar w-auto min-w-[600px] max-w-[900px]">
            <!-- JS populated content -->
        </div>

    </aside>

    <!-- Navigation -->
    <nav class="fixed w-[calc(100%-2rem)] sm:w-[calc(100%-3rem)] lg:w-[calc(100%-4rem)] max-w-7xl left-1/2 -translate-x-1/2 top-4 z-50 px-4 sm:px-6 py-3 flex items-center justify-between gap-4 sm:gap-6 transition-all duration-300">
        <!-- Search Overlay inside Nav -->
        <div id="search-overlay" class="absolute bg-black/80 backdrop-blur-sm z-40 opacity-0 pointer-events-none transition-all duration-300" style="top: -1rem; left: calc(-50vw + 50%); width: 100vw; height: 100vh;"></div>

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
                    <span class="text-sm font-bold text-white leading-tight">Philippines</span>
                </div>
            </div>

            <!-- Sign In -->
            <div class="hidden lg:flex items-center gap-2 cursor-pointer group">
                <i class="ph ph-user text-xl text-gray-400 group-hover:text-primary transition-colors"></i>
                <div class="flex flex-col text-left">
                    <span class="text-[10px] text-gray-400 leading-tight">Welcome</span>
                    <span class="text-sm font-bold text-white group-hover:text-primary transition-colors leading-tight">Sign In / Register</span>
                </div>
            </div>

            <!-- Notification -->
            <button class="w-11 h-11 flex items-center justify-center rounded-2xl border border-white/10 hover:border-white/20 hover:bg-white/5 transition-all text-gray-300 hover:text-white relative shrink-0">
                <i class="ph ph-bell text-xl"></i>
                <span class="absolute top-[10px] right-[10px] w-2 h-2 bg-primary rounded-full shadow-[0_0_8px_rgba(255,107,0,0.8)]"></span>
            </button>

            <!-- Cart Container -->
            <div id="cart-container" class="relative z-30 shrink-0">
                <button id="cart-btn" class="flex items-center gap-2 w-auto h-11 px-3 sm:px-4 rounded-2xl border border-white/10 hover:border-white/20 hover:bg-white/5 transition-all text-gray-300 hover:text-white relative">
                    <div class="relative">
                        <i class="ph ph-shopping-cart text-xl"></i>
                        <span class="absolute -top-1 -right-1 w-3.5 h-3.5 flex items-center justify-center text-[8px] font-bold bg-primary text-white rounded-full">3</span>
                    </div>
                    <div class="hidden sm:flex flex-col text-left ml-1">
                        <span class="text-[10px] text-gray-400 leading-tight">Returns</span>
                        <span class="text-sm font-bold text-white leading-tight">& Cart</span>
                    </div>
                </button>

                <!-- Cart Dropdown -->
                <div id="cart-dropdown" class="liquid-glass-heavy absolute top-[calc(100%+0.5rem)] right-0 w-80 sm:w-96 rounded-2xl overflow-hidden shadow-2xl p-5 opacity-0 pointer-events-none transition-all duration-300 transform -translate-y-2 origin-top">
                    <h3 class="text-lg font-bold text-white mb-4">Recently Added Items</h3>
                    
                    <div class="flex flex-col gap-4 mb-6">
                        <!-- Cart Item 1 -->
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 rounded-xl overflow-hidden border border-white/10 shrink-0 bg-white/5">
                                <img src="https://images.unsplash.com/photo-1595225476474-87563907a212?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80" alt="Keyboard" class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="text-sm font-bold text-white truncate">Gamakay</h4>
                                <p class="text-xs text-gray-400 font-light truncate">TM680 Keyboard</p>
                            </div>
                            <div class="text-right shrink-0">
                                <p class="text-sm font-bold text-primary">₱4,845</p>
                                <p class="text-xs text-gray-400 font-light mt-1">x1</p>
                            </div>
                        </div>

                        <!-- Cart Item 2 -->
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 rounded-xl overflow-hidden border border-white/10 shrink-0 bg-white/5">
                                <img src="https://images.unsplash.com/photo-1758577675588-c5bbbbbf8e97?q=80&w=1074&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Keyboard" class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="text-sm font-bold text-white truncate">T-Force</h4>
                                <p class="text-xs text-gray-400 font-light truncate">DDR4 RGB RAM</p>
                            </div>
                            <div class="text-right shrink-0">
                                <p class="text-sm font-bold text-primary">₱4,995</p>
                                <p class="text-xs text-gray-400 font-light mt-1">x2</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex justify-end pt-2">
                        <button class="bg-gradient-to-r from-primary to-orange-400 hover:from-primary-hover hover:to-primary text-white px-6 py-2.5 rounded-xl text-sm font-bold transition-all shadow-[0_0_15px_rgba(255,107,0,0.3)]">
                            View My Cart
                        </button>
                    </div>
                </div>
            </div>
            
        </div>
    </nav>

    <!-- Hero Section -->
    <main class="relative pt-40 pb-16 lg:pt-48 lg:pb-24 overflow-hidden">
        <div class="max-w-7xl mx-auto px-10 sm:px-12 lg:px-14">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-8 items-center">
                
                <!-- Left Content -->
                <div class="z-10">
                    <div class="liquid-glass inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-medium text-primary mb-6 border border-primary/20">
                        <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                        NEW COLLECTION {{ date('Y') + 2 }}
                    </div>
                    
                    <h1 class="text-5xl sm:text-6xl lg:text-7xl font-bold leading-tight mb-6">
                        TechForge:<br/>
                        <span class="text-primary">Built for</span><br/>
                        <span class="text-gradient">Performance.</span>
                    </h1>
                    
                    <p class="text-gray-400 text-sm sm:text-base mb-8 max-w-md leading-relaxed">
                        Your trusted destination for quality computer parts, accessories, and reliable tech solutions. We provide components for upgrades, repairs, and custom PC builds at affordable prices.
                    </p>
                    
                    <div class="flex flex-wrap items-center gap-4 mb-12">
                        <button class="bg-primary hover:bg-primary-hover text-white px-8 py-3.5 rounded-xl font-semibold flex items-center gap-2 transition-all shadow-[0_0_20px_rgba(255,107,0,0.4)]">
                            Shop now <i class="ph ph-arrow-right"></i>
                        </button>
                        <button class="liquid-glass hover:bg-white/5 text-white px-8 py-3.5 rounded-xl font-semibold transition-all">
                            View Lookbook
                        </button>
                    </div>

                    <!-- Stats -->
                    <div class="grid grid-cols-4 gap-4 text-left border-t border-white/10 pt-8">
                        <div>
                            <h4 class="text-xl font-bold text-white">100K</h4>
                            <p class="text-[10px] text-gray-500 uppercase tracking-wider mt-1">Happy Builders</p>
                        </div>
                        <div>
                            <h4 class="text-xl font-bold text-white">500K</h4>
                            <p class="text-[10px] text-gray-500 uppercase tracking-wider mt-1">Parts in Stock</p>
                        </div>
                        <div>
                            <h4 class="text-xl font-bold text-primary">98%</h4>
                            <p class="text-[10px] text-gray-500 uppercase tracking-wider mt-1">Satisfaction Rate</p>
                        </div>
                        <div>
                            <h4 class="text-xl font-bold text-primary">24/7</h4>
                            <p class="text-[10px] text-gray-500 uppercase tracking-wider mt-1">Expert Support</p>
                        </div>
                    </div>
                </div>

                <!-- Right Content (Product Card) -->
                <div class="relative lg:ml-auto w-full max-w-md z-10 perspective-1000">
                    <!-- Floating Badge -->
                    <div class="absolute -top-6 -right-6 z-20 liquid-glass-heavy rounded-2xl px-6 py-3 border border-white/20">
                        <span class="text-sm font-semibold text-primary z-21">24 HRS LEFT</span>
                    </div>

                    <!-- Product Card -->
                    <div class="liquid-glass-heavy rounded-3xl p-4 border border-primary/20 relative overflow-hidden group">
                        <!-- Orange ambient glow behind the PC -->
                        <div class="absolute inset-0 bg-primary/10 rounded-3xl blur-2xl group-hover:bg-primary/20 transition-all duration-500"></div>
                        
                        <img id="carousel-img" src="https://images.unsplash.com/photo-1587202372634-32705e3bf49c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="High End PC" class="w-full h-80 object-cover rounded-2xl relative z-10 mb-4 mix-blend-lighten transition-opacity duration-300">
                        
                        <div class="relative z-10 px-2 pb-2">
                            <h3 id="carousel-title" class="text-lg font-bold text-white mb-1 transition-opacity duration-300">AMD RYZEN 9 5950X w/ RTX 5090</h3>
                            <p id="carousel-desc" class="text-xs text-gray-400 mb-4 transition-opacity duration-300">Extreme 4K Gaming Performance</p>
                            
                            <div class="flex items-center justify-between mb-4">
                                <span id="carousel-price" class="text-xl font-bold text-primary transition-opacity duration-300">P56,000</span>
                            </div>
                            
                            <button class="w-full bg-gradient-to-r from-primary to-orange-400 hover:from-primary-hover hover:to-primary text-white py-3 rounded-xl font-semibold transition-all">
                                Add to cart
                            </button>
                        </div>
                    </div>

                    <!-- Pagination Dots -->
                    <div id="carousel-dots" class="absolute top-1/2 -right-12 transform -translate-y-1/2 flex flex-col gap-2 hidden lg:flex">
                        <button class="w-2 h-2 rounded-full bg-primary shadow-[0_0_10px_rgba(255,107,0,0.8)] transition-all duration-300 focus:outline-none" aria-label="Slide 1"></button>
                        <button class="w-2 h-2 rounded-full bg-gray-600 transition-all duration-300 hover:bg-gray-400 focus:outline-none" aria-label="Slide 2"></button>
                        <button class="w-2 h-2 rounded-full bg-gray-600 transition-all duration-300 hover:bg-gray-400 focus:outline-none" aria-label="Slide 3"></button>
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

    <!-- Featured Products -->
    <section class="max-w-7xl mx-auto px-10 sm:px-12 lg:px-14 mb-24 relative z-10">
        <div class="mb-10">
            <p class="text-primary text-xs font-bold tracking-widest uppercase mb-2">- Featured Products</p>
            <h2 class="text-3xl sm:text-4xl font-bold">Built for Performance</h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Product 1 -->
            <div class="liquid-glass liquid-glass-hover rounded-2xl overflow-hidden cursor-pointer group p-3">
                <div class="relative bg-neutral-900 rounded-xl overflow-hidden aspect-[4/3] mb-4">
                    <div class="absolute top-3 left-3 z-10 liquid-glass px-2 py-1 rounded-full text-[10px] font-bold border border-white/20">
                        BEST SELLING
                    </div>
                    <img src="https://images.unsplash.com/photo-1591488320449-011701bb6704?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="GPU" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                </div>
                <div class="px-2 pb-2">
                    <div class="flex text-primary text-xs mb-2">
                        <i class="ph-fill ph-star"></i>
                        <i class="ph-fill ph-star"></i>
                        <i class="ph-fill ph-star"></i>
                        <i class="ph-fill ph-star"></i>
                        <i class="ph ph-star text-gray-500"></i>
                        <span class="text-gray-500 ml-1 text-[10px]">(219)</span>
                    </div>
                    <h3 class="text-xs font-bold text-white mb-2 uppercase">GIGABYTE GEFORCE RTX 5090</h3>
                    <p class="text-primary font-bold text-sm">P266,250</p>
                </div>
            </div>

            <!-- Product 2 -->
            <div class="liquid-glass liquid-glass-hover rounded-2xl overflow-hidden cursor-pointer group p-3">
                <div class="relative bg-neutral-900 rounded-xl overflow-hidden aspect-[4/3] mb-4">
                    <div class="absolute top-3 left-3 z-10 liquid-glass px-2 py-1 rounded-full text-[10px] font-bold border border-white/20">
                        BEST SELLING
                    </div>
                    <img src="https://images.unsplash.com/photo-1591488320449-011701bb6704?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="GPU" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700" style="filter: hue-rotate(15deg);">
                </div>
                <div class="px-2 pb-2">
                    <div class="flex text-primary text-xs mb-2">
                        <i class="ph-fill ph-star"></i>
                        <i class="ph-fill ph-star"></i>
                        <i class="ph-fill ph-star"></i>
                        <i class="ph-fill ph-star"></i>
                        <i class="ph ph-star text-gray-500"></i>
                        <span class="text-gray-500 ml-1 text-[10px]">(219)</span>
                    </div>
                    <h3 class="text-xs font-bold text-white mb-2 uppercase">GIGABYTE GEFORCE RTX 5090</h3>
                    <p class="text-primary font-bold text-sm">P266,250</p>
                </div>
            </div>

            <!-- Product 3 -->
            <div class="liquid-glass liquid-glass-hover rounded-2xl overflow-hidden cursor-pointer group p-3">
                <div class="relative bg-neutral-900 rounded-xl overflow-hidden aspect-[4/3] mb-4">
                    <div class="absolute top-3 left-3 z-10 liquid-glass px-2 py-1 rounded-full text-[10px] font-bold border border-white/20">
                        BEST SELLING
                    </div>
                    <img src="https://images.unsplash.com/photo-1591488320449-011701bb6704?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="GPU" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700" style="filter: brightness(0.9);">
                </div>
                <div class="px-2 pb-2">
                    <div class="flex text-primary text-xs mb-2">
                        <i class="ph-fill ph-star"></i>
                        <i class="ph-fill ph-star"></i>
                        <i class="ph-fill ph-star"></i>
                        <i class="ph-fill ph-star"></i>
                        <i class="ph-fill ph-star"></i>
                        <span class="text-gray-500 ml-1 text-[10px]">(219)</span>
                    </div>
                    <h3 class="text-xs font-bold text-white mb-2 uppercase">GIGABYTE GEFORCE RTX 5090</h3>
                    <p class="text-primary font-bold text-sm">P266,250</p>
                </div>
            </div>

            <!-- Product 4 -->
            <div class="liquid-glass liquid-glass-hover rounded-2xl overflow-hidden cursor-pointer group p-3">
                <div class="relative bg-neutral-900 rounded-xl overflow-hidden aspect-[4/3] mb-4">
                    <div class="absolute top-3 left-3 z-10 liquid-glass px-2 py-1 rounded-full text-[10px] font-bold border border-white/20">
                        BEST SELLING
                    </div>
                    <img src="https://images.unsplash.com/photo-1591488320449-011701bb6704?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="GPU" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700" style="filter: contrast(1.1);">
                </div>
                <div class="px-2 pb-2">
                    <div class="flex text-primary text-xs mb-2">
                        <i class="ph-fill ph-star"></i>
                        <i class="ph-fill ph-star"></i>
                        <i class="ph-fill ph-star"></i>
                        <i class="ph-fill ph-star"></i>
                        <i class="ph ph-star text-gray-500"></i>
                        <span class="text-gray-500 ml-1 text-[10px]">(219)</span>
                    </div>
                    <h3 class="text-xs font-bold text-white mb-2 uppercase">GIGABYTE GEFORCE RTX 5090</h3>
                    <p class="text-primary font-bold text-sm">P266,250</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Browse By Category (Bento Grid) -->
    <section id="categories" class="max-w-7xl mx-auto px-10 sm:px-12 lg:px-14 mb-24 relative z-10">
        <div class="mb-10">
            <p class="text-primary text-xs font-bold tracking-widest uppercase mb-2">- Browse By Category</p>
            <h2 class="text-3xl sm:text-4xl font-bold">Find Your Needs</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 h-auto md:h-[600px]">
            <!-- Pre-Built -->
            <div class="relative rounded-3xl overflow-hidden group col-span-1 md:col-span-1 h-[400px] md:h-full cursor-pointer border border-white/5">
                <img src="https://images.unsplash.com/photo-1547082299-de196ea013d6?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Pre-Built" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent pointer-events-none"></div>
                <div class="absolute bottom-6 left-6 liquid-glass px-6 py-2 rounded-xl text-sm font-semibold shadow-lg">
                    Pre-Built
                </div>
            </div>

            <!-- Customized -->
            <div class="relative rounded-3xl overflow-hidden group col-span-1 md:col-span-1 h-[400px] md:h-full cursor-pointer border border-white/5">
                <img src="https://images.unsplash.com/photo-1618339220157-daa2cd9ade56?q=80&w=1935&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Customized" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent pointer-events-none"></div>
                <div class="absolute bottom-6 left-6 liquid-glass px-6 py-2 rounded-xl text-sm font-semibold shadow-lg">
                    Customized
                </div>
            </div>

            <!-- Right Column Small Cards -->
            <div class="grid grid-rows-2 gap-6 col-span-1 md:col-span-1 h-[400px] md:h-full">
                <!-- Peripherals -->
                <div class="relative rounded-3xl overflow-hidden group cursor-pointer border border-white/5">
                    <img src="https://images.unsplash.com/photo-1595225476474-87563907a212?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Peripherals" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent pointer-events-none"></div>
                    <div class="absolute bottom-6 left-6 liquid-glass px-6 py-2 rounded-xl text-sm font-semibold shadow-lg">
                        Peripherals
                    </div>
                </div>
                
                <!-- Graphics Card -->
                <div class="relative rounded-3xl overflow-hidden group cursor-pointer border border-white/5">
                    <img src="https://images.unsplash.com/photo-1591488320449-011701bb6704?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Graphics Card" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700 filter grayscale group-hover:grayscale-0">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent pointer-events-none"></div>
                    <div class="absolute bottom-6 left-6 liquid-glass px-6 py-2 rounded-xl text-sm font-semibold shadow-lg">
                        Graphics Card
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonial -->
    <section class="max-w-7xl mx-auto px-10 sm:px-12 lg:px-14 mb-24 relative z-10">
        <div class="liquid-glass-heavy rounded-3xl p-10 sm:p-16 text-center relative overflow-hidden">
            <!-- Subtle background glow -->
            <div class="absolute inset-0 bg-primary/5 blur-3xl rounded-full"></div>
            
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-black mb-6 relative z-10 text-white">
                "Best upgrade I've made"
            </h2>
            <p class="text-gray-300 text-sm sm:text-base max-w-2xl mx-auto mb-8 relative z-10 leading-relaxed">
                The performance boost was immediate. Fast loading, smooth multitasking, and reliable hardware. Worth every peso.
            </p>
            
            <div class="flex flex-col items-center justify-center gap-3 relative z-10">
                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="User" class="w-12 h-12 rounded-full object-cover border-2 border-primary/50">
                <div>
                    <h4 class="font-bold text-sm">Aldous Manaboots</h4>
                    <div class="flex text-primary text-[10px] justify-center mt-1">
                        <i class="ph-fill ph-star"></i>
                        <i class="ph-fill ph-star"></i>
                        <i class="ph-fill ph-star"></i>
                        <i class="ph-fill ph-star"></i>
                        <i class="ph-fill ph-star"></i>
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
                <div class="col-span-1">
                    <a href="#" class="flex items-center gap-3 mb-4">
                        <div class="bg-gradient-to-br from-primary to-orange-400 w-10 h-10 rounded-xl flex items-center justify-center shadow-[0_0_15px_rgba(255,107,0,0.4)]">
                            <img src="{{ Vite::asset('resources/img/Techforge_Logo.png') }}" alt="TechForge Logo" class="h-6 w-auto object-contain">
                        </div>
                        <span class="text-xl font-bold tracking-wide text-white">TECHFORGE</span>
                    </a>
                    <p class="text-gray-500 text-xs leading-relaxed pr-4">
                        Performance-driven computers and accessories for every digital journey.
                    </p>
                </div>

                <!-- Links 1 -->
                <div>
                    <h4 class="text-primary font-semibold text-sm mb-4">Shop</h4>
                    <ul class="space-y-3 text-xs text-gray-400">
                        <li><a href="#" class="hover:text-white transition-colors">New Arrivals</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Best Selling</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Peripherals</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Sale</a></li>
                    </ul>
                </div>

                <!-- Links 2 -->
                <div>
                    <h4 class="text-primary font-semibold text-sm mb-4">Company</h4>
                    <ul class="space-y-3 text-xs text-gray-400">
                        <li><a href="#" class="hover:text-white transition-colors">About</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Careers</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Why TechForge?</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Terms & Conditions</a></li>
                    </ul>
                </div>

                <!-- Links 3 -->
                <div>
                    <h4 class="text-primary font-semibold text-sm mb-4">Support</h4>
                    <ul class="space-y-3 text-xs text-gray-400">
                        <li><a href="#" class="hover:text-white transition-colors">Help Center</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Shipping</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Returns</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Contact</a></li>
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