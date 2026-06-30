import Lenis from 'lenis'

//Lenis Smooth Scrolling
const lenis = new Lenis();

function raf(time) {
    lenis.raf(time);
    requestAnimationFrame(raf);
}

requestAnimationFrame(raf);

// Carousel Logic
const carouselData = [
    {
        img: 'https://images.unsplash.com/photo-1587202372634-32705e3bf49c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
        title: 'AMD RYZEN 9 5950X w/ RTX 5090',
        desc: 'Extreme 4K Gaming Performance',
        price: 'P56,000'
    },
    {
        img: 'https://images.unsplash.com/photo-1591488320449-011701bb6704?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
        title: 'INTEL CORE i9 14900K w/ RTX 4080',
        desc: 'Ultimate Content Creation Machine',
        price: 'P62,500'
    },
    {
        img: 'https://images.unsplash.com/photo-1547082299-de196ea013d6?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
        title: 'CUSTOM WATERCOOLED PC',
        desc: 'Premium custom loop cooling',
        price: 'P120,000'
    }
];

let currentIndex = 0;
const imgEl = document.getElementById('carousel-img');
const titleEl = document.getElementById('carousel-title');
const descEl = document.getElementById('carousel-desc');
const priceEl = document.getElementById('carousel-price');
const dots = document.querySelectorAll('#carousel-dots button');

if (imgEl) {
    function updateCarousel(index) {
        currentIndex = index;

        // Fade out with slight slide down
        [imgEl, titleEl, descEl, priceEl].forEach(el => {
            el.classList.add('opacity-0', 'translate-y-2');
        });

        setTimeout(() => {
            // Update data
            imgEl.src = carouselData[index].img;
            titleEl.textContent = carouselData[index].title;
            descEl.textContent = carouselData[index].desc;
            priceEl.textContent = carouselData[index].price;

            // Update dots
            dots.forEach((dot, i) => {
                if (i === index) {
                    dot.className = 'w-2.5 h-2.5 rounded-full bg-primary shadow-[0_0_12px_rgba(255,107,0,0.8)] transition-all duration-300 focus:outline-none';
                } else {
                    dot.className = 'w-2.5 h-2.5 rounded-full bg-white/20 transition-all duration-300 hover:bg-white/50 focus:outline-none';
                }
            });

            // Fade in with slight slide up
            [imgEl, titleEl, descEl, priceEl].forEach(el => {
                el.classList.remove('opacity-0', 'translate-y-2');
            });
        }, 500); // Wait for fade out to complete (matching CSS transition duration)
    }

    // Auto rotate every 3 seconds
    let interval = setInterval(() => {
        let nextIndex = (currentIndex + 1) % carouselData.length;
        updateCarousel(nextIndex);
    }, 3000);

    // Click dots to change manually
    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            clearInterval(interval); // Reset timer on manual click
            updateCarousel(index);
            interval = setInterval(() => {
                let nextIndex = (currentIndex + 1) % carouselData.length;
                updateCarousel(nextIndex);
            }, 3000);
        });
    });
}

// Search Bar Logic
const mockSearchResults = [
    { name: "RTX 5090 Graphics Card", type: "GPU", price: "₱266,250" },
    { name: "RTX 3060 Graphics Card", type: "GPU", price: "₱16,500" },
    { name: "AMD Ryzen 5 5600X", type: "CPU", price: "₱8,500" },
    { name: "AMD Ryzen 9 5950X", type: "CPU", price: "₱24,000" },
    { name: "650W Corsair Gold PSU", type: "Power Supply", price: "₱5,200" },
    { name: "850W Seasonic Focus", type: "Power Supply", price: "₱7,500" },
    { name: "B550 Aorus Elite Motherboard", type: "Motherboard", price: "₱9,200" },
    { name: "32GB Kingston Fury DDR4 RAM", type: "Memory", price: "₱4,800" },
    { name: "16GB G.Skill Trident Z DDR4 RAM", type: "Memory", price: "₱3,200" },
    { name: "Logitech G Pro X Superlight", type: "Peripheral", price: "₱6,500" },
    { name: "Razer Huntsman Mini Keyboard", type: "Peripheral", price: "₱5,800" },
    { name: "Keychron Q1 Pro Mechanical Keyboard", type: "Peripheral", price: "₱9,500" },
    { name: "Asus ROG Swift 1440p Monitor", type: "Monitor", price: "₱28,000" },
    { name: "HyperX Cloud II Gaming Headset", type: "Audio", price: "₱4,200" }
];

const searchContainer = document.getElementById('search-container');
const searchInput = document.getElementById('search-input');
const searchDropdown = document.getElementById('search-dropdown');
const cartDropdown = document.getElementById('cart-dropdown');
const searchClear = document.getElementById('search-clear');
const searchOverlay = document.getElementById('search-overlay');

if (searchInput && searchDropdown) {
    const ul = searchDropdown.querySelector('ul');

    searchInput.addEventListener('focus', () => {
        // Disable scroll
        lenis.stop();
        
        // Close Cart if open
        if (cartDropdown && !cartDropdown.classList.contains('opacity-0')) {
            cartDropdown.classList.remove('opacity-100', 'pointer-events-auto', 'translate-y-0');
            cartDropdown.classList.add('opacity-0', 'pointer-events-none', '-translate-y-2');
        }

        // Show search dropdown only if there is text
        if (searchInput.value.trim().length > 0) {
            searchDropdown.classList.remove('opacity-0', 'pointer-events-none', '-translate-y-2');
            searchDropdown.classList.add('opacity-100', 'pointer-events-auto', 'translate-y-0');
        }

        // Show overlay
        if (searchOverlay) {
            searchOverlay.classList.remove('opacity-0', 'pointer-events-none');
            searchOverlay.classList.add('opacity-100', 'pointer-events-auto');
        }
    });

    searchInput.addEventListener('input', () => {
        const query = searchInput.value.toLowerCase().trim();
        
        if (query.length > 0) {
            searchClear.classList.remove('opacity-0', 'pointer-events-none');
            searchClear.classList.add('opacity-100', 'pointer-events-auto');
            
            const filteredResults = mockSearchResults.filter(item => 
                item.name.toLowerCase().includes(query) || item.type.toLowerCase().includes(query)
            );
            
            if (filteredResults.length > 0) {
                ul.innerHTML = filteredResults.slice(0, 6).map(item => `
                    <li>
                        <a href="#" class="flex items-center justify-between px-4 py-2 hover:bg-white/5 transition-colors group">
                            <div class="flex items-center gap-3">
                                <i class="ph ph-magnifying-glass text-primary text-lg group-hover:scale-110 transition-transform"></i>
                                <div class="flex flex-col">
                                    <span class="text-gray-200 font-medium text-sm">${item.name}</span>
                                    <span class="text-gray-500 font-light text-[10px] uppercase">${item.type}</span>
                                </div>
                            </div>
                            <span class="text-primary font-bold text-xs">${item.price}</span>
                        </a>
                    </li>
                `).join('');
            } else {
                ul.innerHTML = `
                    <li class="px-4 py-4 text-gray-500 text-sm text-center">No products found for "${query}"</li>
                `;
            }
            
            // Show search dropdown
            searchDropdown.classList.remove('opacity-0', 'pointer-events-none', '-translate-y-2');
            searchDropdown.classList.add('opacity-100', 'pointer-events-auto', 'translate-y-0');
        } else {
            searchClear.classList.remove('opacity-100', 'pointer-events-auto');
            searchClear.classList.add('opacity-0', 'pointer-events-none');
            
            // Hide search dropdown
            searchDropdown.classList.remove('opacity-100', 'pointer-events-auto', 'translate-y-0');
            searchDropdown.classList.add('opacity-0', 'pointer-events-none', '-translate-y-2');
        }
    });

    if (searchClear) {
        searchClear.addEventListener('click', (e) => {
            e.preventDefault();
            searchInput.value = '';
            searchClear.classList.remove('opacity-100', 'pointer-events-auto');
            searchClear.classList.add('opacity-0', 'pointer-events-none');
            
            // Hide search dropdown
            searchDropdown.classList.remove('opacity-100', 'pointer-events-auto', 'translate-y-0');
            searchDropdown.classList.add('opacity-0', 'pointer-events-none', '-translate-y-2');
            
            searchInput.focus();
        });
    }

    document.addEventListener('click', (e) => {
        if (!searchContainer.contains(e.target)) {
            // Hide search dropdown
            searchDropdown.classList.remove('opacity-100', 'pointer-events-auto', 'translate-y-0');
            searchDropdown.classList.add('opacity-0', 'pointer-events-none', '-translate-y-2');

            // Hide overlay
            if (searchOverlay) {
                searchOverlay.classList.remove('opacity-100', 'pointer-events-auto');
                searchOverlay.classList.add('opacity-0', 'pointer-events-none');
            }

            // Enable scroll
            lenis.start();
        }
    });
}

// Cart Dropdown Logic
const cartContainer = document.getElementById('cart-container');
const cartBtn = document.getElementById('cart-btn');

if (cartContainer && cartBtn && cartDropdown) {
    cartBtn.addEventListener('click', (e) => {
        e.preventDefault();
        e.stopPropagation();
        
        // Toggle dropdown
        const isClosed = cartDropdown.classList.contains('opacity-0');
        
        if (isClosed) {
            // Close Search if open
            if (searchDropdown && !searchDropdown.classList.contains('opacity-0')) {
                searchDropdown.classList.remove('opacity-100', 'pointer-events-auto', 'translate-y-0');
                searchDropdown.classList.add('opacity-0', 'pointer-events-none', '-translate-y-2');
                
                if (searchOverlay) {
                    searchOverlay.classList.remove('opacity-100', 'pointer-events-auto');
                    searchOverlay.classList.add('opacity-0', 'pointer-events-none');
                }
            }

            // Open
            cartDropdown.classList.remove('opacity-0', 'pointer-events-none', '-translate-y-2');
            cartDropdown.classList.add('opacity-100', 'pointer-events-auto', 'translate-y-0');
        } else {
            // Close
            cartDropdown.classList.remove('opacity-100', 'pointer-events-auto', 'translate-y-0');
            cartDropdown.classList.add('opacity-0', 'pointer-events-none', '-translate-y-2');
        }
    });

    document.addEventListener('click', (e) => {
        if (!cartContainer.contains(e.target)) {
            // Close when clicking outside
            cartDropdown.classList.remove('opacity-100', 'pointer-events-auto', 'translate-y-0');
            cartDropdown.classList.add('opacity-0', 'pointer-events-none', '-translate-y-2');
        }
    });
}

// Gaming PCs Dropdown Logic
const gamingPcsContainer = document.getElementById('gaming-pcs-container');
const gamingPcsBtn = document.getElementById('gaming-pcs-btn');
const gamingPcsDropdown = document.getElementById('gaming-pcs-dropdown');
const gamingPcsIcon = document.getElementById('gaming-pcs-icon');
const navOverlay = document.getElementById('nav-overlay');

if (gamingPcsBtn && gamingPcsDropdown && navOverlay) {
    gamingPcsBtn.addEventListener('click', (e) => {
        e.preventDefault();
        e.stopPropagation();

        const isOpen = !gamingPcsDropdown.classList.contains('opacity-0');

        if (isOpen) {
            // Close
            gamingPcsDropdown.classList.remove('opacity-100', 'pointer-events-auto', 'translate-y-0');
            gamingPcsDropdown.classList.add('opacity-0', 'pointer-events-none', 'translate-y-2');
            navOverlay.classList.remove('opacity-100', 'pointer-events-auto');
            navOverlay.classList.add('opacity-0', 'pointer-events-none');
            gamingPcsIcon.classList.remove('rotate-180', 'text-primary');
            gamingPcsBtn.classList.remove('text-primary');
            
            if (!searchDropdown || searchDropdown.classList.contains('opacity-0')) {
                lenis.start();
            }
        } else {
            // Close search dropdown if open
            if (searchDropdown && !searchDropdown.classList.contains('opacity-0')) {
                searchDropdown.classList.remove('opacity-100', 'pointer-events-auto', 'translate-y-0');
                searchDropdown.classList.add('opacity-0', 'pointer-events-none', '-translate-y-2');
                if (searchOverlay) {
                    searchOverlay.classList.remove('opacity-100', 'pointer-events-auto');
                    searchOverlay.classList.add('opacity-0', 'pointer-events-none');
                }
            }
            // Close cart if open
            if (cartDropdown && !cartDropdown.classList.contains('opacity-0')) {
                cartDropdown.classList.remove('opacity-100', 'pointer-events-auto', 'translate-y-0');
                cartDropdown.classList.add('opacity-0', 'pointer-events-none', '-translate-y-2');
            }
            // Close gaming laptops if open
            if (gamingLaptopsDropdown && !gamingLaptopsDropdown.classList.contains('opacity-0')) {
                gamingLaptopsDropdown.classList.remove('opacity-100', 'pointer-events-auto', 'translate-y-0');
                gamingLaptopsDropdown.classList.add('opacity-0', 'pointer-events-none', 'translate-y-2');
                if (gamingLaptopsIcon) gamingLaptopsIcon.classList.remove('rotate-180', 'text-primary');
                if (gamingLaptopsBtn) gamingLaptopsBtn.classList.remove('text-primary');
            }
            // Close parts if open
            if (typeof partsDropdown !== 'undefined' && partsDropdown && !partsDropdown.classList.contains('opacity-0')) {
                partsDropdown.classList.remove('opacity-100', 'pointer-events-auto', 'translate-y-0');
                partsDropdown.classList.add('opacity-0', 'pointer-events-none', 'translate-y-2');
                if (partsIcon) partsIcon.classList.remove('rotate-180', 'text-primary');
                if (partsBtn) partsBtn.classList.remove('text-primary');
            }

            // Open
            gamingPcsDropdown.classList.remove('opacity-0', 'pointer-events-none', 'translate-y-2');
            gamingPcsDropdown.classList.add('opacity-100', 'pointer-events-auto', 'translate-y-0');
            navOverlay.classList.remove('opacity-0', 'pointer-events-none');
            navOverlay.classList.add('opacity-100', 'pointer-events-auto');
            gamingPcsIcon.classList.add('rotate-180', 'text-primary');
            gamingPcsBtn.classList.add('text-primary');
            lenis.stop();
        }
    });

    document.addEventListener('click', (e) => {
        if (!gamingPcsContainer.contains(e.target)) {
            // Close if clicking outside
            if (!gamingPcsDropdown.classList.contains('opacity-0')) {
                gamingPcsDropdown.classList.remove('opacity-100', 'pointer-events-auto', 'translate-y-0');
                gamingPcsDropdown.classList.add('opacity-0', 'pointer-events-none', 'translate-y-2');
                navOverlay.classList.remove('opacity-100', 'pointer-events-auto');
                navOverlay.classList.add('opacity-0', 'pointer-events-none');
                gamingPcsIcon.classList.remove('rotate-180', 'text-primary');
                gamingPcsBtn.classList.remove('text-primary');
                
                // Only start lenis if search is not open
                if (!searchOverlay || searchOverlay.classList.contains('opacity-0')) {
                    lenis.start();
                }
            }
        }
    });
}

// Gaming Laptops Dropdown Logic
const gamingLaptopsContainer = document.getElementById('gaming-laptops-container');
const gamingLaptopsBtn = document.getElementById('gaming-laptops-btn');
const gamingLaptopsDropdown = document.getElementById('gaming-laptops-dropdown');
const gamingLaptopsIcon = document.getElementById('gaming-laptops-icon');

if (gamingLaptopsBtn && gamingLaptopsDropdown && navOverlay) {
    gamingLaptopsBtn.addEventListener('click', (e) => {
        e.preventDefault();
        e.stopPropagation();

        const isOpen = !gamingLaptopsDropdown.classList.contains('opacity-0');

        if (isOpen) {
            // Close
            gamingLaptopsDropdown.classList.remove('opacity-100', 'pointer-events-auto', 'translate-y-0');
            gamingLaptopsDropdown.classList.add('opacity-0', 'pointer-events-none', 'translate-y-2');
            navOverlay.classList.remove('opacity-100', 'pointer-events-auto');
            navOverlay.classList.add('opacity-0', 'pointer-events-none');
            gamingLaptopsIcon.classList.remove('rotate-180', 'text-primary');
            gamingLaptopsBtn.classList.remove('text-primary');
            
            if (!searchDropdown || searchDropdown.classList.contains('opacity-0')) {
                lenis.start();
            }
        } else {
            // Close search dropdown if open
            if (searchDropdown && !searchDropdown.classList.contains('opacity-0')) {
                searchDropdown.classList.remove('opacity-100', 'pointer-events-auto', 'translate-y-0');
                searchDropdown.classList.add('opacity-0', 'pointer-events-none', '-translate-y-2');
                if (searchOverlay) {
                    searchOverlay.classList.remove('opacity-100', 'pointer-events-auto');
                    searchOverlay.classList.add('opacity-0', 'pointer-events-none');
                }
            }
            // Close cart if open
            if (cartDropdown && !cartDropdown.classList.contains('opacity-0')) {
                cartDropdown.classList.remove('opacity-100', 'pointer-events-auto', 'translate-y-0');
                cartDropdown.classList.add('opacity-0', 'pointer-events-none', '-translate-y-2');
            }
            // Close gaming PCs if open
            if (gamingPcsDropdown && !gamingPcsDropdown.classList.contains('opacity-0')) {
                gamingPcsDropdown.classList.remove('opacity-100', 'pointer-events-auto', 'translate-y-0');
                gamingPcsDropdown.classList.add('opacity-0', 'pointer-events-none', 'translate-y-2');
                if (gamingPcsIcon) gamingPcsIcon.classList.remove('rotate-180', 'text-primary');
                if (gamingPcsBtn) gamingPcsBtn.classList.remove('text-primary');
            }
            // Close parts if open
            if (typeof partsDropdown !== 'undefined' && partsDropdown && !partsDropdown.classList.contains('opacity-0')) {
                partsDropdown.classList.remove('opacity-100', 'pointer-events-auto', 'translate-y-0');
                partsDropdown.classList.add('opacity-0', 'pointer-events-none', 'translate-y-2');
                if (partsIcon) partsIcon.classList.remove('rotate-180', 'text-primary');
                if (partsBtn) partsBtn.classList.remove('text-primary');
            }

            // Open
            gamingLaptopsDropdown.classList.remove('opacity-0', 'pointer-events-none', 'translate-y-2');
            gamingLaptopsDropdown.classList.add('opacity-100', 'pointer-events-auto', 'translate-y-0');
            navOverlay.classList.remove('opacity-0', 'pointer-events-none');
            navOverlay.classList.add('opacity-100', 'pointer-events-auto');
            gamingLaptopsIcon.classList.add('rotate-180', 'text-primary');
            gamingLaptopsBtn.classList.add('text-primary');
            lenis.stop();
        }
    });

    document.addEventListener('click', (e) => {
        if (!gamingLaptopsContainer.contains(e.target)) {
            // Close if clicking outside
            if (!gamingLaptopsDropdown.classList.contains('opacity-0')) {
                gamingLaptopsDropdown.classList.remove('opacity-100', 'pointer-events-auto', 'translate-y-0');
                gamingLaptopsDropdown.classList.add('opacity-0', 'pointer-events-none', 'translate-y-2');
                navOverlay.classList.remove('opacity-100', 'pointer-events-auto');
                navOverlay.classList.add('opacity-0', 'pointer-events-none');
                gamingLaptopsIcon.classList.remove('rotate-180', 'text-primary');
                gamingLaptopsBtn.classList.remove('text-primary');
                
                // Only start lenis if search is not open
                if (!searchOverlay || searchOverlay.classList.contains('opacity-0')) {
                    lenis.start();
                }
            }
        }
    });
}

// Parts & Accessories Dropdown Logic
const partsContainer = document.getElementById('parts-container');
const partsBtn = document.getElementById('parts-btn');
const partsDropdown = document.getElementById('parts-dropdown');
const partsIcon = document.getElementById('parts-icon');

if (partsBtn && partsDropdown && navOverlay) {
    partsBtn.addEventListener('click', (e) => {
        e.preventDefault();
        e.stopPropagation();

        const isOpen = !partsDropdown.classList.contains('opacity-0');

        if (isOpen) {
            // Close
            partsDropdown.classList.remove('opacity-100', 'pointer-events-auto', 'translate-y-0');
            partsDropdown.classList.add('opacity-0', 'pointer-events-none', 'translate-y-2');
            navOverlay.classList.remove('opacity-100', 'pointer-events-auto');
            navOverlay.classList.add('opacity-0', 'pointer-events-none');
            partsIcon.classList.remove('rotate-180', 'text-primary');
            partsBtn.classList.remove('text-primary');
            
            if (!searchDropdown || searchDropdown.classList.contains('opacity-0')) {
                lenis.start();
            }
        } else {
            // Close search dropdown if open
            if (searchDropdown && !searchDropdown.classList.contains('opacity-0')) {
                searchDropdown.classList.remove('opacity-100', 'pointer-events-auto', 'translate-y-0');
                searchDropdown.classList.add('opacity-0', 'pointer-events-none', '-translate-y-2');
                if (searchOverlay) {
                    searchOverlay.classList.remove('opacity-100', 'pointer-events-auto');
                    searchOverlay.classList.add('opacity-0', 'pointer-events-none');
                }
            }
            // Close cart if open
            if (cartDropdown && !cartDropdown.classList.contains('opacity-0')) {
                cartDropdown.classList.remove('opacity-100', 'pointer-events-auto', 'translate-y-0');
                cartDropdown.classList.add('opacity-0', 'pointer-events-none', '-translate-y-2');
            }
            // Close gaming PCs if open
            if (gamingPcsDropdown && !gamingPcsDropdown.classList.contains('opacity-0')) {
                gamingPcsDropdown.classList.remove('opacity-100', 'pointer-events-auto', 'translate-y-0');
                gamingPcsDropdown.classList.add('opacity-0', 'pointer-events-none', 'translate-y-2');
                if (gamingPcsIcon) gamingPcsIcon.classList.remove('rotate-180', 'text-primary');
                if (gamingPcsBtn) gamingPcsBtn.classList.remove('text-primary');
            }
            // Close gaming laptops if open
            if (gamingLaptopsDropdown && !gamingLaptopsDropdown.classList.contains('opacity-0')) {
                gamingLaptopsDropdown.classList.remove('opacity-100', 'pointer-events-auto', 'translate-y-0');
                gamingLaptopsDropdown.classList.add('opacity-0', 'pointer-events-none', 'translate-y-2');
                if (gamingLaptopsIcon) gamingLaptopsIcon.classList.remove('rotate-180', 'text-primary');
                if (gamingLaptopsBtn) gamingLaptopsBtn.classList.remove('text-primary');
            }

            // Open
            partsDropdown.classList.remove('opacity-0', 'pointer-events-none', 'translate-y-2');
            partsDropdown.classList.add('opacity-100', 'pointer-events-auto', 'translate-y-0');
            navOverlay.classList.remove('opacity-0', 'pointer-events-none');
            navOverlay.classList.add('opacity-100', 'pointer-events-auto');
            partsIcon.classList.add('rotate-180', 'text-primary');
            partsBtn.classList.add('text-primary');
            lenis.stop();
        }
    });

    document.addEventListener('click', (e) => {
        if (!partsContainer.contains(e.target)) {
            // Close if clicking outside
            if (!partsDropdown.classList.contains('opacity-0')) {
                partsDropdown.classList.remove('opacity-100', 'pointer-events-auto', 'translate-y-0');
                partsDropdown.classList.add('opacity-0', 'pointer-events-none', 'translate-y-2');
                navOverlay.classList.remove('opacity-100', 'pointer-events-auto');
                navOverlay.classList.add('opacity-0', 'pointer-events-none');
                partsIcon.classList.remove('rotate-180', 'text-primary');
                partsBtn.classList.remove('text-primary');
                
                // Only start lenis if search is not open
                if (!searchOverlay || searchOverlay.classList.contains('opacity-0')) {
                    lenis.start();
                }
            }
        }
    });
}
