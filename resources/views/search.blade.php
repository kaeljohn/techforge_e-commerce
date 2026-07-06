<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Search Results - TechForge</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:100,200,300,400,500,600,700,800,900" rel="stylesheet" />
    
    <!-- Phosphor Icons -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

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

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #050505;
            color: #ffffff;
            overflow-x: hidden;
        }

        .ambient-light-1 {
            position: absolute;
            top: -20vh;
            left: -10vw;
            width: 50vw;
            height: 50vw;
            background: radial-gradient(circle, rgba(255,107,0,0.15) 0%, rgba(0,0,0,0) 70%);
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
        }

        .ambient-light-2 {
            position: absolute;
            top: 40vh;
            right: -20vw;
            width: 60vw;
            height: 60vw;
            background: radial-gradient(circle, rgba(255,81,0,0.1) 0%, rgba(0,0,0,0) 70%);
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
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

    <x-navbar />

    <!-- Search Hero -->
    <main class="relative pt-32 pb-8 lg:pt-40 lg:pb-12 overflow-hidden w-full">
        <div class="max-w-[1500px] mx-auto px-6 lg:px-8 relative z-10 text-center">
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-white tracking-wide mb-2">
                <span class="text-primary">{{ $totalResults }}</span> Results for "{{ $query }}"
            </h1>
        </div>
    </main>

    <!-- Wrapper for AJAX Tab/Pagination Loading -->
    <div id="search-results-container" class="transition-opacity duration-300">

    <!-- Category Tabs -->
    <div class="max-w-[1500px] mx-auto px-6 lg:px-8 relative z-10 mb-8 overflow-x-auto">
        <div class="flex items-center justify-center gap-4 border-b border-white/10 pb-4 min-w-max">
            <a href="{{ route('search', ['q' => $query, 'tab' => 'prebuilt']) }}" class="tab-link flex items-center gap-2 px-4 py-2 rounded-xl transition-all {{ $tab === 'prebuilt' ? 'bg-primary text-white font-bold' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                Prebuilt PCs
                <span class="text-xs py-0.5 px-2 rounded-md {{ $tab === 'prebuilt' ? 'bg-black/30 text-white' : 'bg-white/10 text-gray-400' }}">{{ $prebuiltCount }}</span>
            </a>
            <a href="{{ route('search', ['q' => $query, 'tab' => 'custom']) }}" class="tab-link flex items-center gap-2 px-4 py-2 rounded-xl transition-all {{ $tab === 'custom' ? 'bg-primary text-white font-bold' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                Custom PCs
                <span class="text-xs py-0.5 px-2 rounded-md {{ $tab === 'custom' ? 'bg-black/30 text-white' : 'bg-white/10 text-gray-400' }}">{{ $customCount }}</span>
            </a>
            <a href="{{ route('search', ['q' => $query, 'tab' => 'laptops']) }}" class="tab-link flex items-center gap-2 px-4 py-2 rounded-xl transition-all {{ $tab === 'laptops' ? 'bg-primary text-white font-bold' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                Gaming Laptops
                <span class="text-xs py-0.5 px-2 rounded-md {{ $tab === 'laptops' ? 'bg-black/30 text-white' : 'bg-white/10 text-gray-400' }}">{{ $laptopCount }}</span>
            </a>
            <a href="{{ route('search', ['q' => $query, 'tab' => 'parts']) }}" class="tab-link flex items-center gap-2 px-4 py-2 rounded-xl transition-all {{ $tab === 'parts' ? 'bg-primary text-white font-bold' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                Parts & Accessories
                <span class="text-xs py-0.5 px-2 rounded-md {{ $tab === 'parts' ? 'bg-black/30 text-white' : 'bg-white/10 text-gray-400' }}">{{ $partsCount }}</span>
            </a>
        </div>
    </div>

    <!-- Category Content -->
    <form id="filter-form" method="GET" action="{{ route('search') }}" class="max-w-[1500px] mx-auto px-6 lg:px-8 pb-24 relative z-10 flex flex-col lg:flex-row gap-8">
        
        <!-- Preserve Query and Tab in Form -->
        <input type="hidden" name="q" value="{{ $query }}">
        <input type="hidden" name="tab" value="{{ $tab }}">

        <!-- Product Filter Component -->
        @if($tab !== 'parts')
            <x-search-filter :counts="$counts" route="search" :globalMinPrice="$globalMinPrice" :globalMaxPrice="$globalMaxPrice" />
        @endif

        <!-- Product Grid -->
        <div id="product-grid-area" class="flex-1 w-full lg:w-auto transition-opacity duration-300">
            
            <!-- Controls / Sort -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
                <p class="text-sm text-gray-400">Showing <span class="text-white font-bold">{{ $configs->count() }}</span> products</p>
                
                <div class="flex items-center gap-3 w-full sm:w-auto">
                    <span class="text-xs text-gray-500 uppercase tracking-widest font-bold">Sort By</span>
                    <div class="relative w-full sm:w-48">
                        <select name="sort" onchange="document.getElementById('filter-form').submit()" class="w-full bg-black/40 border border-[#3a1810] rounded-xl py-2 pl-4 pr-10 text-sm text-white appearance-none cursor-pointer hover:border-[#5a2810] transition-colors focus:outline-none focus:border-primary">
                            <option {{ request('sort') == 'Recommended' ? 'selected' : '' }}>Recommended</option>
                            <option {{ request('sort') == 'Price: Low to High' ? 'selected' : '' }}>Price: Low to High</option>
                            <option {{ request('sort') == 'Price: High to Low' ? 'selected' : '' }}>Price: High to Low</option>
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
                        <img src="{{ $config->image_url ?? 'https://images.unsplash.com/photo-1587202372634-32705e3bf49c?auto=format&fit=crop&w=800&q=80' }}" alt="{{ $config->name }}" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700 opacity-90 group-hover:opacity-100">
                    </div>

                    <div class="flex flex-col flex-1">
                        <!-- Product Name -->
                        <h3 class="text-lg font-bold text-white group-hover:text-primary transition-colors line-clamp-1 mb-3">{{ $config->name }}</h3>
                        
                        <!-- Product Parts/Peripherals -->
                        @if(isset($config->is_part) && $config->is_part)
                            <!-- Part Details -->
                            <div class="space-y-1.5 mb-4 text-xs text-gray-400">
                                <p>Standalone component.</p>
                            </div>
                        @else
                            <div class="space-y-1.5 mb-4 text-xs">
                                <div class="flex items-center gap-2 text-gray-400"><i class="ph ph-cpu text-gray-500 text-sm shrink-0"></i> <span class="text-gray-300 truncate">{{ $config->cpu->name ?? 'N/A' }}</span></div>
                                <div class="flex items-center gap-2 text-gray-400"><i class="ph ph-circuitry text-gray-500 text-sm shrink-0"></i> <span class="text-gray-300 truncate">{{ $config->motherboard->name ?? 'N/A' }}</span></div>
                                <div class="flex items-center gap-2 text-gray-400"><i class="ph ph-graphics-card text-gray-500 text-sm shrink-0"></i> <span class="text-gray-300 truncate">{{ $config->gpu->name ?? 'N/A' }}</span></div>
                                <div class="flex items-center gap-2 text-gray-400"><i class="ph ph-memory text-gray-500 text-sm shrink-0"></i> <span class="text-gray-300 truncate">{{ $config->ram->name ?? 'N/A' }}</span></div>
                                <div class="flex items-center gap-2 text-gray-400"><i class="ph ph-hard-drives text-gray-500 text-sm shrink-0"></i> <span class="text-gray-300 truncate">{{ $config->storage->name ?? 'N/A' }}</span></div>
                                <div class="flex items-center gap-2 text-gray-400"><i class="ph ph-plug text-gray-500 text-sm shrink-0"></i> <span class="text-gray-300 truncate">{{ $config->powerSupply->name ?? 'N/A' }}</span></div>
                            </div>
                        @endif
                        
                        <!-- Divider -->
                        <hr class="border-white/10 my-4">
                        
                        <!-- Pricing & Action Button -->
                        <div class="mt-auto pt-2">
                            <div class="flex flex-col mb-4">
                                <span class="text-xl font-black text-white">P{{ number_format($config->price) }}</span>
                            </div>

                            <!-- Action Button -->
                            @if(isset($config->is_part) && $config->is_part)
                                <button type="button" 
                                    class="add-to-cart-btn w-full py-2 rounded-full border border-primary text-primary hover:bg-primary hover:text-white font-bold transition-all duration-300 text-center flex items-center justify-center gap-2 text-sm"
                                    data-product-id="{{ $config->id }}"
                                    data-name="{{ $config->name }}"
                                    data-price="{{ $config->price }}"
                                    data-image="{{ $config->image_url ?? '' }}">
                                    <i class="ph-bold ph-shopping-cart"></i> Add to Cart
                                </button>
                            @elseif($config instanceof \App\Models\PrebuiltConfig)
                                <button type="button" 
                                    class="add-to-cart-btn w-full py-2 rounded-full border border-primary text-primary hover:bg-primary hover:text-white font-bold transition-all duration-300 text-center flex items-center justify-center gap-2 text-sm"
                                    data-product-id="{{ $config->id }}"
                                    data-name="{{ $config->name }}"
                                    data-price="{{ $config->price }}"
                                    data-image="{{ $config->image_url ?? '' }}">
                                    <i class="ph-bold ph-shopping-cart"></i> Add to Cart
                                </button>
                            @else
                                <a href="{{ route('build-overview', ['id' => $config->id, 'type' => 'custom']) }}" class="w-full py-2 rounded-full border border-primary text-primary hover:bg-primary hover:text-white font-bold transition-all duration-300 text-center flex items-center justify-center gap-2 text-sm">
                                    <i class="ph-bold ph-wrench"></i> Customize This Build
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                    <div class="col-span-1 sm:col-span-2 xl:col-span-3 py-20 flex flex-col items-center justify-center text-center bg-black/20 rounded-[2rem] border border-white/5">
                        <i class="ph ph-magnifying-glass text-6xl text-gray-600 mb-6"></i>
                        <h3 class="text-2xl font-bold text-white mb-2">No items found</h3>
                        <p class="text-gray-400">Try adjusting your search or filters.</p>
                    </div>
                @endforelse

            </div>
            
            @if($configs->isNotEmpty() && method_exists($configs, 'links'))
            <!-- Pagination -->
            <div class="mt-12 w-full">
                {{ $configs->links('pagination::tailwind') }}
            </div>
            @endif

        </div>

    </form>
    </div>

    <x-footer />
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function bindMobileFilter() {
                const mobileFilterBtn = document.getElementById('mobile-filter-btn');
                const filterSidebar = document.getElementById('filter-sidebar');
                const closeFilterBtn = document.getElementById('close-filter-btn');
                if (mobileFilterBtn && filterSidebar && closeFilterBtn) {
                    mobileFilterBtn.addEventListener('click', () => {
                        filterSidebar.classList.remove('translate-x-full');
                        filterSidebar.classList.add('translate-x-0');
                    });
                    closeFilterBtn.addEventListener('click', () => {
                        filterSidebar.classList.remove('translate-x-0');
                        filterSidebar.classList.add('translate-x-full');
                    });
                }
            }
            bindMobileFilter();

            // Intercept form submissions for AJAX Filtering
            function bindAjaxForm() {
                const filterForm = document.getElementById('filter-form');
                if (filterForm && !filterForm.isAjaxBound) {
                    filterForm.isAjaxBound = true;
                    // Override the native submit method so inline onchange="this.form.submit()" triggers our event listener
                    const originalSubmit = HTMLFormElement.prototype.submit;
                    filterForm.submit = function() {
                        const event = new Event('submit', { bubbles: true, cancelable: true });
                        filterForm.dispatchEvent(event);
                    };

                    filterForm.addEventListener('submit', function(e) {
                        e.preventDefault();
                        
                        const url = new URL(filterForm.action);
                        const formData = new FormData(filterForm);
                        
                        const searchParams = new URLSearchParams();
                        for (const pair of formData) {
                            if (pair[1] !== '') {
                                searchParams.append(pair[0], pair[1]);
                            }
                        }
                        url.search = searchParams.toString();
                        
                        const contentArea = document.getElementById('search-results-container');
                        if (contentArea) contentArea.style.opacity = '0.5';

                        fetch(url.toString())
                            .then(response => response.text())
                            .then(html => {
                                const parser = new DOMParser();
                                const doc = parser.parseFromString(html, 'text/html');
                                const newContentArea = doc.getElementById('search-results-container');
                                
                                if (newContentArea) {
                                    contentArea.innerHTML = newContentArea.innerHTML;
                                    contentArea.style.opacity = '1';
                                }
                                
                                window.history.pushState({}, '', url.toString());
                                bindMobileFilter();
                                bindAjaxForm();
                            })
                            .catch(err => {
                                console.error('AJAX load failed:', err);
                                if (contentArea) contentArea.style.opacity = '1';
                            });
                    });
                }
            }
            bindAjaxForm();

            // AJAX Navigation for Pagination and Tabs
            document.addEventListener('click', function(e) {
                const link = e.target.closest('nav[role="navigation"] a, .tab-link');
                if (link) {
                    e.preventDefault();
                    const url = link.href;
                    const contentArea = document.getElementById('search-results-container');
                    
                    if (contentArea) contentArea.style.opacity = '0.5';

                    fetch(url)
                        .then(response => response.text())
                        .then(html => {
                            const parser = new DOMParser();
                            const doc = parser.parseFromString(html, 'text/html');
                            const newContentArea = doc.getElementById('search-results-container');
                            
                            if (newContentArea) {
                                contentArea.innerHTML = newContentArea.innerHTML;
                                contentArea.style.opacity = '1';
                            }
                            
                            window.history.pushState({}, '', url);
                            bindMobileFilter();
                            bindAjaxForm();
                        })
                        .catch(err => {
                            console.error('AJAX load failed:', err);
                            if (contentArea) contentArea.style.opacity = '1';
                        });
                }
            });
        });
    </script>

    <!-- Load our compiled JavaScript (You can remove LiquidGlass initialization from inside this file) -->
    @vite(['resources/js/HomePage/Homepage.js', 'resources/js/Category/Category.js'])
</body>
</html>
