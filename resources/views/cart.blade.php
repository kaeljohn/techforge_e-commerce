<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    <title>{{ config('app.name', 'TechForge') }} | Cart & Returns</title>
    
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

    <!-- Cart & Returns Section -->
    <main class="relative pt-40 pb-20 lg:pt-48 lg:pb-28 overflow-hidden z-10 min-h-screen">
        <div class="max-w-7xl mx-auto px-10 sm:px-12 lg:px-14">
            
            <!-- Page Header -->
            <div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-4 border-b border-white/10 pb-6">
                <div>
                    <h1 class="text-3xl sm:text-4xl font-black text-white mb-2">Returns & Cart</h1>
                    <p class="text-sm text-gray-400">Review your items and our return policies.</p>
                </div>
                <a href="{{ url('/') }}" class="text-sm font-bold text-gray-400 hover:text-white transition-colors flex items-center gap-2 group">
                    <i class="ph-bold ph-arrow-left group-hover:-translate-x-1 transition-transform"></i> Continue Shopping
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
                
                <!-- Cart Items (Left) -->
                <div class="@auth lg:col-span-8 @else lg:col-span-12 max-w-4xl mx-auto w-full @endauth space-y-6">
                    
                    <h3 class="text-xl font-bold text-white mb-4">Your Items</h3>

                    <!-- Empty Cart State -->
                    <div class="liquid-glass rounded-3xl p-10 border border-white/10 flex flex-col items-center justify-center text-center min-h-[300px]">
                        <div class="w-20 h-20 bg-white/5 rounded-full flex items-center justify-center mb-4 border border-white/10">
                            <i class="ph-light ph-shopping-cart text-4xl text-gray-400"></i>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">Your cart is currently empty.</h3>
                        <p class="text-sm text-gray-400 mb-6">Looks like you haven't added anything yet. Discover our premium components and gear to elevate your setup.</p>
                        <div class="flex items-center gap-4">
                            @guest
                            <a href="{{ route('login') }}" class="bg-gradient-to-r from-primary to-[#ff8c33] hover:from-[#ff8c33] hover:to-primary text-white px-6 py-2.5 rounded-xl text-sm font-bold transition-all shadow-[0_0_15px_rgba(255,107,0,0.3)]">
                                Sign In
                            </a>
                            @endguest
                            <a href="{{ url('/') }}" class="bg-white/10 hover:bg-white/20 text-white px-6 py-2.5 rounded-xl text-sm font-bold transition-all border border-white/10 hover:border-white/20">
                                Browse Products
                            </a>
                        </div>
                    </div>

                </div>

                @auth
                <!-- Order Summary & Returns (Right) -->
                <div class="lg:col-span-4 space-y-6">
                    
                    <!-- Summary Card -->
                    <div class="liquid-glass-heavy rounded-3xl p-6 border border-white/10 shadow-[0_10px_30px_rgba(0,0,0,0.8)]">
                        <h3 class="text-lg font-bold text-white mb-6">Order Summary</h3>
                        
                        <div class="space-y-4 text-sm mb-6">
                            <div class="flex justify-between text-gray-400">
                                <span>Subtotal (0 items)</span>
                                <span class="text-white font-medium">₱0</span>
                            </div>
                            <div class="flex justify-between text-gray-400">
                                <span>Shipping</span>
                                <span class="text-white font-medium">₱0</span>
                            </div>
                            <div class="flex justify-between text-gray-400">
                                <span>Discount</span>
                                <span class="text-white font-medium">₱0</span>
                            </div>
                        </div>
                        
                        <div class="border-t border-white/10 pt-4 mb-6">
                            <div class="flex justify-between items-end">
                                <span class="text-base text-gray-300">Total</span>
                                <span class="text-3xl font-black text-white">₱0</span>
                            </div>
                            <p class="text-[10px] text-gray-500 mt-1 text-right">Including all applicable taxes</p>
                        </div>
                        
                        <button class="w-full bg-gradient-to-r from-primary to-orange-400 hover:from-primary-hover hover:to-primary text-white py-4 rounded-xl font-bold transition-all shadow-[0_0_15px_rgba(255,107,0,0.3)] hover:shadow-[0_0_25px_rgba(255,107,0,0.5)] hover:-translate-y-1 flex items-center justify-center gap-2 text-lg group">
                            Proceed to Checkout <i class="ph-bold ph-arrow-right group-hover:translate-x-1 transition-transform"></i>
                        </button>
                        
                        <div class="mt-5 flex items-center justify-center gap-2 text-[10px] text-gray-500 uppercase tracking-widest">
                            <i class="ph-fill ph-shield-check text-sm text-primary"></i> 256-bit Secure Checkout
                        </div>
                    </div>

                    <!-- Returns Policy Card -->
                    <div class="liquid-glass rounded-3xl p-6 border border-white/10 relative overflow-hidden group hover:border-primary/30 transition-colors">
                        <div class="absolute -right-6 -top-6 text-white/5 group-hover:text-primary/10 transition-colors">
                            <i class="ph-fill ph-arrow-counter-clockwise text-9xl"></i>
                        </div>
                        <div class="relative z-10">
                            <h3 class="text-base font-bold text-white mb-2 flex items-center gap-2">
                                <i class="ph-bold ph-arrow-counter-clockwise text-primary"></i> Hassle-Free Returns
                            </h3>
                            <p class="text-xs text-gray-400 leading-relaxed mb-4">
                                Not satisfied with your purchase? You can return most items in their original condition within <span class="text-white font-bold">30 days</span> of delivery for a full refund.
                            </p>
                            <a href="#" class="text-xs font-bold text-primary hover:text-white transition-colors flex items-center gap-1 group/link">
                                View Full Return Policy <i class="ph-bold ph-arrow-right group-hover/link:translate-x-1 transition-transform"></i>
                            </a>
                        </div>
                    </div>

                </div>
                @endauth

            </div>
        </div>
    </main>

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

    <!-- Load our compiled JavaScript -->
    @vite('resources/js/HomePage/Homepage.js')
</body>
</html>
