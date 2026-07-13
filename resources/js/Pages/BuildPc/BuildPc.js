// We assume window.PageConfig is set in the view before this script is loaded.
document.addEventListener('DOMContentLoaded', () => {
    
    const allComponents = window.PageConfig.allComponents || [];
    window.engine = new ConfiguratorEngine(allComponents);

    const componentGroups = [
        {
            id: 'core',
            name: 'Core Components',
            items: [
                { id: 'Processor', name: 'Processor', icon: 'ph-cpu', essential: true, visId: 'vis-cpu', dbType: 'Processor' },
                { id: 'Motherboard', name: 'Motherboard', icon: 'ph-circuitry', essential: true, visId: 'vis-motherboard', dbType: 'Motherboard' }
            ]
        },
        {
            id: 'memory_storage',
            name: 'Memory & Storage',
            items: [
                { id: 'Memory', name: 'Memory (RAM)', icon: 'ph-memory', essential: true, visId: 'vis-memory', dbType: 'Memory' },
                { id: 'Primary Storage', name: 'Primary Storage (SSD)', icon: 'ph-hard-drives', essential: true, visId: 'vis-ssd', dbType: 'Storage' }
            ]
        },
        {
            id: 'graphics_power',
            name: 'Graphics & Power',
            items: [
                { id: 'Video Card', name: 'Graphics Card', icon: 'ph-graphics-card', essential: true, visId: 'vis-gpu', dbType: 'Video Card' },
                { id: 'Power Supply', name: 'Power Supply', icon: 'ph-plug', essential: true, visId: 'vis-psu', dbType: 'Power Supply' }
            ]
        },
        {
            id: 'chassis_cooling',
            name: 'Chassis & Cooling',
            items: [
                { id: 'Case', name: 'Case', icon: 'ph-desktop-tower', essential: true, dbType: 'Case' }
            ]
        }
    ];

    const totalEssential = 7;
    const maxBudget = 200000;
    let currentSelectingCategory = null;
    let currentSelectingDbType = null;
    let availableComponents = [];

    // --- DOM Elements ---
    const componentsListEl = document.getElementById('components-list');
    const totalPriceEl = document.getElementById('total-price');
    const powerDrawEl = document.getElementById('power-draw');
    const compCountEl = document.getElementById('comp-count');
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

    // --- Format Currency ---
    const formatPHP = (amount) => {
        return new Intl.NumberFormat('en-PH', { style: 'currency', currency: 'PHP', minimumFractionDigits: 0, maximumFractionDigits: 0 }).format(amount);
    };

    // --- Update UI from Engine ---
    window.engine.subscribe((build) => {
        renderComponents();
        updateSummary();
        updateVisualizer();
        updateSteps();
    });

    // --- Render Components List ---
    const renderComponents = () => {
        componentsListEl.innerHTML = '';
        let html = '';

        componentGroups.forEach(group => {
            html += `<div class="mb-4">
                        <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 pl-2">${group.name}</h3>
                        <div class="space-y-1.5">`;
            
            group.items.forEach(cat => {
                const selectedProduct = window.engine.getComponent(cat.id);
                html += `
                    <div class="liquid-glass rounded-xl p-2.5 flex items-center justify-between gap-3 component-slot border ${selectedProduct ? 'border-primary/30 bg-primary/5' : 'border-white/5'}">
                        <div class="flex items-center gap-3 flex-1 min-w-0">
                            <div class="w-8 h-8 rounded-lg ${selectedProduct ? 'bg-transparent' : 'bg-white/5'} flex items-center justify-center shrink-0 border border-white/10 overflow-hidden">
                                ${selectedProduct 
                                    ? `<img src="${selectedProduct.image_url || 'https://via.placeholder.com/300'}" alt="${selectedProduct.name}" class="w-full h-full object-cover">`
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
                                ? `<span class="text-sm font-black text-white">${formatPHP(selectedProduct.price)}</span>
                                   <div class="flex gap-1 mt-1">
                                       <button onclick="openModal('${cat.id}', '${cat.dbType}')" class="text-[10px] px-2 py-1 rounded bg-white/10 hover:bg-white/20 text-white font-semibold transition-colors">Change</button>
                                       <button onclick="window.engine.removeComponent('${cat.id}')" class="text-[10px] px-2 py-1 rounded bg-red-500/10 hover:bg-red-500 text-red-500 hover:text-white transition-colors"><i class="ph ph-x"></i></button>
                                   </div>`
                                : `<button onclick="openModal('${cat.id}', '${cat.dbType}')" class="px-3 py-1.5 rounded-lg bg-white/5 hover:bg-primary text-gray-300 hover:text-white text-xs font-bold transition-all border border-white/10 hover:border-transparent">
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
    };

    const updateVisualizer = () => {
        document.querySelectorAll('.visualizer-slot').forEach(el => el.classList.remove('active'));
        
        componentGroups.forEach(group => {
            group.items.forEach(cat => {
                if(window.engine.getComponent(cat.id) && cat.visId) {
                    const visEl = document.getElementById(cat.visId);
                    if(visEl) visEl.classList.add('active');
                    
                    if(cat.id === 'Memory') {
                        document.getElementById('vis-memory-2')?.classList.add('active');
                    }
                }
            });
        });
    };

    const updateSummary = () => {
        const total = window.engine.calculateTotal();
        const wattage = window.engine.getRequiredWattage();
        
        let count = 0;
        let partsHtml = '';

        let catNames = {};
        componentGroups.forEach(g => g.items.forEach(i => catNames[i.id] = i.name));

        Object.entries(window.engine.currentBuild).forEach(([catId, prod]) => {
            if (prod) {
                count++;
                const catName = catNames[catId] || catId;
                partsHtml += `<div class="flex justify-between items-center text-xs py-1 border-b border-white/5 last:border-0"><span class="text-gray-400 truncate pr-2 flex-1">${catName}</span><span class="text-white font-bold">${formatPHP(prod.price)}</span></div>`;
            }
        });
        const summaryPartsList = document.getElementById('summary-parts-list');
        if (summaryPartsList) summaryPartsList.innerHTML = partsHtml;

        if (totalPriceEl) totalPriceEl.textContent = formatPHP(total);
        if (powerDrawEl) powerDrawEl.textContent = Math.ceil(wattage);
        if (compCountEl) compCountEl.textContent = count;
        if (budgetCurrentEl) budgetCurrentEl.textContent = formatPHP(total);

        if (budgetBar) {
            budgetBar.style.width = Math.min((total / maxBudget) * 100, 100) + '%';
            if(total > maxBudget) budgetBar.classList.add('bg-red-500');
            else budgetBar.classList.remove('bg-red-500');
        }

        if (compBar) compBar.style.width = Math.min((count / 7) * 100, 100) + '%';
        if (powerBar) powerBar.style.width = Math.min((wattage / 1200) * 100, 100) + '%';
    };

    const updateSteps = () => {
        const checkStep = (stepId, conditions) => {
            const stepEl = document.getElementById(stepId);
            if (!stepEl) return;
            const dot = stepEl.querySelector('.step-dot');
            const text = stepEl.querySelector('.step-text');
            const isActive = conditions.some(c => !!window.engine.getComponent(c));
            if (isActive) {
                if (dot) dot.className = 'w-8 h-8 rounded-full border-2 border-primary bg-primary text-white flex items-center justify-center text-xs font-bold step-dot active';
                if (text) text.className = 'text-[10px] text-white font-bold uppercase tracking-wider step-text';
            } else {
                if (dot) dot.className = 'w-8 h-8 rounded-full border-2 border-white/20 bg-black text-gray-400 flex items-center justify-center text-xs font-bold step-dot';
                if (text) text.className = 'text-[10px] text-gray-500 font-bold uppercase tracking-wider step-text';
            }
        };

        checkStep('step-1', ['Processor', 'Motherboard']);
        checkStep('step-2', ['Memory']);
        checkStep('step-3', ['Primary Storage']);
        checkStep('step-4', ['Video Card']);
        checkStep('step-5', ['Power Supply']);
        checkStep('step-6', ['Case']);
    };

    // --- Modal Functions ---
    window.openModal = (categoryId, dbType) => {
        currentSelectingCategory = categoryId;
        currentSelectingDbType = dbType;
        
        let catName = categoryId;
        let catIcon = '';
        
        componentGroups.forEach(g => g.items.forEach(i => {
            if(i.id === categoryId) { catName = i.name; catIcon = i.icon; }
        }));
        
        if (modalTitleEl) modalTitleEl.innerHTML = `<i class="ph ${catIcon} text-primary"></i> Select ${catName}`;
        
        if(modalSearchEl) modalSearchEl.value = '';
        if(modalSortEl) modalSortEl.value = 'name_asc';
        if(modalPriceMinEl) modalPriceMinEl.value = '';
        if(modalPriceMaxEl) modalPriceMaxEl.value = '';

        availableComponents = allComponents.filter(c => c.type === dbType);

        renderModalProducts();
        
        if (modalEl) {
            modalEl.classList.remove('opacity-0', 'pointer-events-none');
            const box = modalEl.querySelector('.liquid-glass-heavy');
            if (box) box.classList.remove('scale-95');
        }
    };

    window.closeModal = () => {
        if (modalEl) {
            modalEl.classList.add('opacity-0', 'pointer-events-none');
            const box = modalEl.querySelector('.liquid-glass-heavy');
            if (box) box.classList.add('scale-95');
        }
    };

    const renderModalProducts = () => {
        if (!modalProductsEl) return;
        modalProductsEl.innerHTML = '';
        
        let products = availableComponents;

        if(modalSearchEl && modalSearchEl.value) {
            const q = modalSearchEl.value.toLowerCase();
            products = products.filter(p => p.name.toLowerCase().includes(q));
        }
        if(modalPriceMinEl && modalPriceMinEl.value) {
            products = products.filter(p => p.price >= parseFloat(modalPriceMinEl.value));
        }
        if(modalPriceMaxEl && modalPriceMaxEl.value) {
            products = products.filter(p => p.price <= parseFloat(modalPriceMaxEl.value));
        }

        if(modalSortEl && modalSortEl.value) {
            const sort = modalSortEl.value;
            products = [...products].sort((a, b) => {
                if(sort === 'price_asc') return a.price - b.price;
                if(sort === 'price_desc') return b.price - a.price;
                if(sort === 'name_asc') return a.name.localeCompare(b.name);
                return 0;
            });
        }

        const processed = products.map(c => {
            const compatibility = window.engine.checkCompatibility(c, currentSelectingCategory);
            return { ...c, compatible: compatibility.compatible, reason: compatibility.reason };
        });

        if(processed.length === 0) {
            modalProductsEl.innerHTML = '<div class="col-span-full text-center py-12"><p class="text-gray-500">No components found.</p></div>';
            return;
        }

        let html = '';
        processed.forEach(p => {
            const currentComp = window.engine.getComponent(currentSelectingCategory);
            const isSelected = currentComp && currentComp.id === p.id;
            const onClick = isSelected ? '' : `onclick="selectComponent(${p.id})"`;
            
            const imgUrl = p.image_url || 'https://via.placeholder.com/300x200/111/333?text=' + currentSelectingCategory;
            const opacityClass = !p.compatible ? 'opacity-50 grayscale pointer-events-none' : '';
            const borderClass = isSelected ? 'border-primary shadow-[0_0_15px_rgba(255,107,0,0.3)]' : 'border-white/5 hover:border-white/20 cursor-pointer';

            html += `
                <div class="liquid-glass p-4 rounded-2xl border ${borderClass} flex flex-col transition-all group relative ${opacityClass}" ${p.compatible ? onClick : ''}>
                    <div class="w-full h-32 mb-4 bg-white/5 rounded-xl flex items-center justify-center p-2">
                        <img src="${imgUrl}" alt="${p.name}" class="max-h-full max-w-full object-contain group-hover:scale-110 transition-transform duration-300">
                    </div>
                    <h4 class="font-bold text-white text-sm mb-2 leading-tight">${p.name}</h4>
                    <div class="mt-auto flex justify-between items-end">
                        <p class="text-primary font-black">${formatPHP(p.price)}</p>
                        ${isSelected ? '<div class="bg-primary text-white text-[10px] font-bold px-2 py-1 rounded uppercase tracking-widest">Selected</div>' : ''}
                    </div>
                    ${!p.compatible ? `<div class="absolute top-2 right-2 bg-red-500/90 text-white text-[9px] font-black uppercase tracking-wider px-2 py-1 rounded shadow-lg backdrop-blur-sm z-10">${p.reason}</div>` : ''}
                </div>
            `;
        });
        modalProductsEl.innerHTML = html;
    };

    window.selectComponent = (id) => {
        const component = availableComponents.find(c => c.id === id);
        
        const conflicts = window.engine.getConflictsIfSelected(currentSelectingCategory, component);
        
        if (conflicts.length > 0) {
            let msg = "Changing this component will require changing your " + conflicts.join(', ') + ". Proceed?";
            if(!confirm(msg)) return;
            conflicts.forEach(cat => window.engine.removeComponent(cat));
        }
        
        window.engine.setComponent(currentSelectingCategory, component);
        window.closeModal();
    };

    // Event Listeners for modal filters
    if(modalSearchEl) modalSearchEl.addEventListener('input', renderModalProducts);
    if(modalSortEl) modalSortEl.addEventListener('change', renderModalProducts);
    if(modalPriceMinEl) modalPriceMinEl.addEventListener('input', renderModalProducts);
    if(modalPriceMaxEl) modalPriceMaxEl.addEventListener('input', renderModalProducts);
    if(modalResetFiltersEl) {
        modalResetFiltersEl.addEventListener('click', () => {
            modalSearchEl.value = '';
            modalSortEl.value = 'name_asc';
            modalPriceMinEl.value = '';
            modalPriceMaxEl.value = '';
            renderModalProducts();
        });
    }
    const closeModalBtn = document.getElementById('close-modal');
    if(closeModalBtn) closeModalBtn.addEventListener('click', window.closeModal);

    // Add to Cart Logic
    const checkoutBtn = document.getElementById('add-to-cart-btn');
    if(checkoutBtn) {
        checkoutBtn.addEventListener('click', () => {
            const currentBuild = window.engine.currentBuild;
            const missing = Object.entries(currentBuild).filter(([k,v]) => v === null);
            if (missing.length > 0) {
                alert("Please select components for: " + missing.map(m => m[0]).join(', '));
                return;
            }

            const originalText = checkoutBtn.innerHTML;
            checkoutBtn.innerHTML = '<i class="ph ph-spinner animate-spin"></i> Processing...';
            checkoutBtn.disabled = true;

            const formData = new FormData();
            formData.append('product_id', 'custom_' + Date.now());
            formData.append('name', 'Custom PC Build');
            formData.append('price', window.engine.calculateTotal());
            formData.append('image_url', 'https://images.unsplash.com/photo-1587202372775-e229f172b9d7?w=500&q=80');
            formData.append('quantity', 1);
            formData.append('configuration', window.engine.getCartPayload());

            fetch(window.PageConfig.cartAddRoute, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': window.PageConfig.csrfToken
                },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if(data.success) {
                    checkoutBtn.innerHTML = '<i class="ph-bold ph-check-circle"></i> Added to Cart';
                    setTimeout(() => {
                        checkoutBtn.innerHTML = originalText;
                        checkoutBtn.disabled = false;
                        const badge = document.querySelector('#cart-btn span');
                        if (badge) {
                            badge.classList.remove('hidden');
                            badge.classList.add('flex');
                            badge.innerText = data.cart_count;
                        }
                    }, 2000);
                }
            });
        });
    }

    // Init call
    renderComponents();
    updateSummary();
    
    // Preloader
    const preloader = document.getElementById('preloader');
    if (preloader) {
        setTimeout(() => {
            preloader.style.opacity = '0';
            setTimeout(() => preloader.style.display = 'none', 1000);
        }, 500);
    }
});
