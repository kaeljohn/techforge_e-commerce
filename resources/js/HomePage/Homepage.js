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

        // Fade out
        [imgEl, titleEl, descEl, priceEl].forEach(el => {
            el.classList.add('opacity-0');
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
                    dot.className = 'w-2 h-2 rounded-full bg-primary shadow-[0_0_10px_rgba(255,107,0,0.8)] transition-all duration-300 focus:outline-none';
                } else {
                    dot.className = 'w-2 h-2 rounded-full bg-gray-600 transition-all duration-300 hover:bg-gray-400 focus:outline-none';
                }
            });

            // Fade in
            [imgEl, titleEl, descEl, priceEl].forEach(el => {
                el.classList.remove('opacity-0');
            });
        }, 300); // Wait for fade out to complete
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
const searchContainer = document.getElementById('search-container');
const searchWrapper = document.getElementById('search-wrapper');
const searchTrigger = document.getElementById('search-trigger');
const searchInput = document.getElementById('search-input');
const searchDropdown = document.getElementById('search-dropdown');

if (searchWrapper && searchInput) {
    searchTrigger.addEventListener('click', (e) => {
        if (searchWrapper.classList.contains('w-11')) {
            e.preventDefault();
            e.stopPropagation();

            // Close Cart if open
            if (cartDropdown && !cartDropdown.classList.contains('opacity-0')) {
                cartDropdown.classList.remove('opacity-100', 'pointer-events-auto', 'translate-y-0');
                cartDropdown.classList.add('opacity-0', 'pointer-events-none', '-translate-y-2');
            }

            // Expand
            searchWrapper.classList.remove('w-11', 'hover:bg-white/5', 'cursor-pointer', 'border-white/10');
            searchWrapper.classList.add('w-72', 'sm:w-80', 'bg-neutral-900', 'border-primary/50');

            // Show input
            searchInput.classList.remove('opacity-0', 'pointer-events-none');
            searchInput.classList.add('opacity-100', 'pointer-events-auto');

            // Show dropdown
            searchDropdown.classList.remove('opacity-0', 'pointer-events-none', '-translate-y-2');
            searchDropdown.classList.add('opacity-100', 'pointer-events-auto', 'translate-y-0');

            setTimeout(() => searchInput.focus(), 300);
        }
    });

    document.addEventListener('click', (e) => {
        if (!searchContainer.contains(e.target)) {
            // Collapse
            searchWrapper.classList.remove('w-72', 'sm:w-80', 'bg-neutral-900', 'border-primary/50');
            searchWrapper.classList.add('w-11', 'hover:bg-white/5', 'cursor-pointer', 'border-white/10');

            searchInput.classList.remove('opacity-100', 'pointer-events-auto');
            searchInput.classList.add('opacity-0', 'pointer-events-none');

            searchDropdown.classList.remove('opacity-100', 'pointer-events-auto', 'translate-y-0');
            searchDropdown.classList.add('opacity-0', 'pointer-events-none', '-translate-y-2');

            searchInput.value = '';
        }
    });
}

// Cart Dropdown Logic
const cartContainer = document.getElementById('cart-container');
const cartBtn = document.getElementById('cart-btn');
const cartDropdown = document.getElementById('cart-dropdown');

if (cartContainer && cartBtn && cartDropdown) {
    cartBtn.addEventListener('click', (e) => {
        e.preventDefault();
        e.stopPropagation();
        
        // Toggle dropdown
        const isClosed = cartDropdown.classList.contains('opacity-0');
        
        if (isClosed) {
            // Close Search if open
            if (searchWrapper && searchWrapper.classList.contains('w-72')) {
                searchWrapper.classList.remove('w-72', 'sm:w-80', 'bg-neutral-900', 'border-primary/50');
                searchWrapper.classList.add('w-11', 'hover:bg-white/5', 'cursor-pointer', 'border-white/10');
                
                searchInput.classList.remove('opacity-100', 'pointer-events-auto');
                searchInput.classList.add('opacity-0', 'pointer-events-none');
                
                searchDropdown.classList.remove('opacity-100', 'pointer-events-auto', 'translate-y-0');
                searchDropdown.classList.add('opacity-0', 'pointer-events-none', '-translate-y-2');
                
                searchInput.value = '';
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
