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
            // Enable scroll
            lenis.start();

            // Hide search dropdown
            searchDropdown.classList.remove('opacity-100', 'pointer-events-auto', 'translate-y-0');
            searchDropdown.classList.add('opacity-0', 'pointer-events-none', '-translate-y-2');

            // Hide overlay
            if (searchOverlay) {
                searchOverlay.classList.remove('opacity-100', 'pointer-events-auto');
                searchOverlay.classList.add('opacity-0', 'pointer-events-none');
            }
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

// Sidebar Mega Menu Logic
const megaMenuData = {
    components: [
        {
            title: "Core Components",
            items: ["CPUs / Processors", "Memory", "Motherboards", "GPUs & Video Graphics Devices", "Computer Cases", "Fans & PC Cooling", "Power Supplies", "Sound Cards", "Server Components"]
        },
        {
            title: "Storage Devices",
            items: ["Hard Drives", "SSDs", "CD / DVD / Blu-Ray Burners & Media", "USB Flash Drives & Memory Cards", "Hard Drive Enclosures"]
        },
        {
            title: "Accessories",
            items: ["Power Protection", "Cables", "Adapters & Gender Changers", "KVM Switches", "Hubs"]
        },
        {
            title: "Shopping Tools",
            items: ["Memory Finder"]
        }
    ],
    systems: [
        {
            title: "Desktop Systems",
            items: ["Desktop Computers", "Gaming Desktops", "Servers & Workstations"]
        },
        {
            title: "Portable Systems",
            items: ["Laptops / Notebooks", "Gaming Laptops", "2-in-1 Laptops", "Chromebooks"]
        },
        {
            title: "Peripherals",
            items: ["Monitors", "Keyboards & Mice", "Headsets, Speakers & Soundcards", "Power Protection", "Printers / Scanners & Supplies", "Printer Ink & Toner", "KVM Switches", "Projectors"]
        }
    ],
    peripherals: [
        {
            title: "Monitors",
            items: ["LCD / LED Monitors", "Gaming Monitors", "Touch Screen Monitors", "Monitor Accessories"]
        },
        {
            title: "Keyboards & Mice",
            items: ["Keyboards", "Gaming Keyboards", "Mice", "Gaming Mice", "KVM Switches", "Mouse Pads & Accessories"]
        },
        {
            title: "Input Devices",
            items: ["VR Headsets", "Headsets & Accessories", "PC Game Controllers", "Web Cams", "Graphics Tablets", "Video Capturing Devices", "Microphones"]
        },
        {
            title: "Printers / Scanners & Supplies",
            items: ["3D Printers", "Laser Printers", "Inkjet Printers", "Barcode & Label Printers", "Receipt Printer", "Flatbed Scanners", "Specialized Scanners"]
        },
        {
            title: "Printer Ink & Toner",
            items: ["Ink Cartridges (Genuine Brands)", "Toner Cartridges (Genuine Brands)", "Ink Cartridges (Aftermarket)", "Toner Cartridges (Aftermarket)", "Labels & Labelmakers", "Printer & Scanner Supplies", "Printer Ribbons"]
        },
        {
            title: "Power Protection",
            items: ["Power Distribution Unit", "Power Inverters", "Power Strips", "Surge Protectors", "UPS", "UPS Accessories"]
        }
    ],
    electronics: [
        {
            title: "Mobile Phones",
            items: ["Cell Phones", "Batteries, Power Banks & Chargers", "Bluetooth Headsets & Accessories", "Case & Covers", "Chargers & Cables", "Mounts & Holders"]
        },
        {
            title: "Tablets",
            items: ["Tablets", "Genuine Tablet Accessories", "iPad Accessories"]
        },
        {
            title: "TV & Home Theater",
            items: ["TV & Video", "Home Audio & Home Theater", "Home Video Accessories", "Home Theater Accessories", "Audio / Video Cables", "HDMI Cables", "TV Mounts"]
        },
        {
            title: "Shopping Tools",
            items: ["Memory Finder"]
        },
        {
            title: "Portable Electronics",
            items: ["Digital Cameras", "Portable Electronic Devices", "Headphones", "Gadgets & Wearables"]
        },
        {
            title: "Home Appliances",
            items: ["Vacuums & Floor Care", "Cooks Tools", "Coffee Makers"]
        },
        {
            title: "Specialty Electronics",
            items: ["Pro Audio & Musical Instruments", "Professional Video Devices", "Maker", "Alternative Energy"]
        }
    ],
    gaming: [
        {
            title: "Sony",
            items: ["PS4 Accessories", "PS4 Video Games"]
        },
        {
            title: "Microsoft",
            items: ["Xbox 360 Accessories", "Xbox One Accessories", "Xbox One Systems", "Xbox One Video Games"]
        },
        {
            title: "PC & VR",
            items: ["Gaming Laptops", "Gaming Mice", "Gaming Keyboards", "PC Game Controllers"]
        }
    ]
};

const sidebarWrapper = document.getElementById('sidebar-wrapper');
const mainSidebar = document.getElementById('main-sidebar');
const megaMenu = document.getElementById('mega-menu');
const sidebarItems = document.querySelectorAll('.sidebar-item');
const generalOverlay = document.getElementById('sidebar-overlay');
const hamburgerBtn = document.getElementById('hamburger-btn');
const sidebarTitle = document.getElementById('sidebar-title');
const sidebarDivider = document.getElementById('sidebar-divider');
const sidebarLabels = document.querySelectorAll('.sidebar-label');

if (sidebarWrapper && megaMenu && generalOverlay && hamburgerBtn) {
    let isSidebarExpanded = false;

    hamburgerBtn.addEventListener('click', () => {
        isSidebarExpanded = !isSidebarExpanded;
        
        if (isSidebarExpanded) {
            // Expand sidebar
            mainSidebar.classList.remove('w-[72px]');
            mainSidebar.classList.add('w-[280px]');

            // Fade in text
            sidebarTitle.classList.remove('opacity-0');
            sidebarTitle.classList.add('opacity-100');
            sidebarDivider.classList.remove('w-8');
            sidebarDivider.classList.add('w-[240px]', 'opacity-20');
            
            sidebarLabels.forEach(label => {
                label.classList.remove('opacity-0');
                label.classList.add('opacity-100');
            });
            
            // Allow pointer events on wrapper so hovering mega menu doesn't close
            sidebarWrapper.classList.remove('pointer-events-none');
            sidebarWrapper.classList.add('pointer-events-auto');
        } else {
            // Collapse sidebar
            mainSidebar.classList.remove('w-[280px]');
            mainSidebar.classList.add('w-[72px]');

            // Fade out text
            sidebarTitle.classList.remove('opacity-100');
            sidebarTitle.classList.add('opacity-0');
            sidebarDivider.classList.remove('w-[240px]', 'opacity-20');
            sidebarDivider.classList.add('w-8');
            
            sidebarLabels.forEach(label => {
                label.classList.remove('opacity-100');
                label.classList.add('opacity-0');
            });
        }
    });

    sidebarWrapper.addEventListener('mouseleave', () => {
        // Undim background and unlock scroll
        generalOverlay.classList.remove('opacity-100', 'pointer-events-auto');
        generalOverlay.classList.add('opacity-0', 'pointer-events-none');
        lenis.start();

        // Hide mega menu
        megaMenu.classList.remove('opacity-100', 'pointer-events-auto', 'translate-x-0');
        megaMenu.classList.add('opacity-0', 'pointer-events-none', '-translate-x-8');
        
        // Remove active state from items
        sidebarItems.forEach(i => {
            i.classList.remove('bg-white/5');
            i.querySelector('.ph-caret-right').classList.add('opacity-0');
            i.querySelector('.ph-caret-right').classList.remove('opacity-100');
        });

        // Restore wrapper pointer events
        sidebarWrapper.classList.remove('pointer-events-auto');
        sidebarWrapper.classList.add('pointer-events-none');
    });

    sidebarItems.forEach(item => {
        item.addEventListener('mouseenter', () => {
            const category = item.getAttribute('data-category');
            const data = megaMenuData[category];
            
            // Highlight item
            sidebarItems.forEach(i => {
                i.classList.remove('bg-white/5');
                i.querySelector('.ph-caret-right').classList.add('opacity-0');
                i.querySelector('.ph-caret-right').classList.remove('opacity-100');
            });
            item.classList.add('bg-white/5');
            item.querySelector('.ph-caret-right').classList.remove('opacity-0');
            item.querySelector('.ph-caret-right').classList.add('opacity-100');

            if (data) {
                // Dim background and lock scroll
                generalOverlay.classList.remove('opacity-0', 'pointer-events-none');
                generalOverlay.classList.add('opacity-100', 'pointer-events-auto');
                lenis.stop();
                
                sidebarWrapper.classList.remove('pointer-events-none');
                sidebarWrapper.classList.add('pointer-events-auto');

                // Populate mega menu
                let html = '<div class="columns-2 lg:columns-3 gap-x-16 gap-y-4 w-full">';
                data.forEach(group => {
                    html += `
                        <div class="flex flex-col gap-2 break-inside-avoid mb-8">
                            <h3 class="text-white font-bold text-[13px] italic mb-2 tracking-wide">${group.title}</h3>
                            <ul class="flex flex-col gap-2.5">
                                ${group.items.map(link => `
                                    <li>
                                        <a href="#" class="text-gray-300 hover:text-white text-[12px] font-light transition-colors flex items-center justify-between group">
                                            <span>${link}</span>
                                            <i class="ph ph-caret-right text-[10px] opacity-0 group-hover:opacity-100 transition-opacity"></i>
                                        </a>
                                    </li>
                                `).join('')}
                            </ul>
                        </div>
                    `;
                });
                html += '</div>';
                megaMenu.innerHTML = html;

                // Show mega menu
                megaMenu.classList.remove('opacity-0', 'pointer-events-none', '-translate-x-8');
                megaMenu.classList.add('opacity-100', 'pointer-events-auto', 'translate-x-0');
            } else {
                // Undim background and unlock scroll
                generalOverlay.classList.remove('opacity-100', 'pointer-events-auto');
                generalOverlay.classList.add('opacity-0', 'pointer-events-none');
                lenis.start();

                sidebarWrapper.classList.remove('pointer-events-auto');
                sidebarWrapper.classList.add('pointer-events-none');

                megaMenu.classList.remove('opacity-100', 'pointer-events-auto', 'translate-x-0');
                megaMenu.classList.add('opacity-0', 'pointer-events-none', '-translate-x-8');
            }
        });
    });
}
