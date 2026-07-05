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



    <x-navbar />

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
                <div class="lg:col-span-8 space-y-6">
                    
                    <h3 class="text-xl font-bold text-white mb-4">Your Items</h3>

                    @if(count($cart) > 0)
                        @foreach($cart as $id => $item)
                        <div class="liquid-glass rounded-2xl p-4 border border-white/10 flex items-center gap-4">
                            <!-- Product Image Placeholder -->
                            <div class="w-24 h-24 bg-[#0a0a0a] rounded-xl flex-shrink-0 border border-white/5 flex items-center justify-center overflow-hidden">
                                @if(isset($item['image_url']) && !empty($item['image_url']))
                                    <img src="{{ $item['image_url'] }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover">
                                @else
                                    <i class="ph-light ph-desktop text-3xl text-gray-600"></i>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="text-white font-bold truncate">{{ $item['name'] }}</h4>
                                <p class="text-sm text-gray-400 mt-1">Quantity: {{ $item['quantity'] }}</p>
                                <p class="text-primary font-bold mt-2">₱{{ number_format($item['price'], 2) }}</p>
                            </div>
                            <button class="text-gray-500 hover:text-red-500 transition-colors p-2">
                                <i class="ph ph-trash text-xl"></i>
                            </button>
                        </div>
                        @endforeach
                    @else
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
                    @endif

                </div>

                <!-- Order Summary & Returns (Right) -->
                <div class="lg:col-span-4 space-y-6">
                    
                    <!-- Summary Card -->
                    <div class="liquid-glass-heavy rounded-3xl p-6 border border-white/10 shadow-[0_10px_30px_rgba(0,0,0,0.8)]">
                        <h3 class="text-lg font-bold text-white mb-6">Order Summary</h3>
                        
                        <div class="space-y-4 text-sm mb-6">
                            <div class="flex justify-between text-gray-400">
                                <span>Subtotal ({{ collect($cart)->sum('quantity') }} items)</span>
                                <span class="text-white font-medium">₱{{ number_format($subtotal, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-gray-400">
                                <span>Shipping</span>
                                <span class="text-white font-medium">₱{{ number_format($shipping, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-gray-400">
                                <span>Discount</span>
                                <span class="text-white font-medium">₱{{ number_format($discount, 2) }}</span>
                            </div>
                        </div>
                        
                        <div class="border-t border-white/10 pt-4 mb-6">
                            <div class="flex justify-between items-end">
                                <span class="text-base text-gray-300">Total</span>
                                <span class="text-3xl font-black text-white">₱{{ number_format($total, 2) }}</span>
                            </div>
                            <p class="text-[10px] text-gray-500 mt-1 text-right">Including all applicable taxes</p>
                        </div>
                        
                        @if(count($cart) > 0)
                            <a href="{{ auth()->check() ? '#' : route('login') }}" class="w-full bg-gradient-to-r from-primary to-orange-400 hover:from-primary-hover hover:to-primary text-white py-4 rounded-xl font-bold transition-all shadow-[0_0_15px_rgba(255,107,0,0.3)] hover:shadow-[0_0_25px_rgba(255,107,0,0.5)] hover:-translate-y-1 flex items-center justify-center gap-2 text-lg group">
                                Proceed to Checkout <i class="ph-bold ph-arrow-right group-hover:translate-x-1 transition-transform"></i>
                            </a>
                        @else
                            <button disabled class="w-full bg-white/5 text-gray-500 py-4 rounded-xl font-bold cursor-not-allowed flex items-center justify-center gap-2 text-lg">
                                Proceed to Checkout <i class="ph-bold ph-arrow-right"></i>
                            </button>
                        @endif
                        
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

            </div>
        </div>
    </main>

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
