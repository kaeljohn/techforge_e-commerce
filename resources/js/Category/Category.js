import Lenis from 'lenis'

// Category Filter Logic
document.addEventListener('DOMContentLoaded', () => {
    // 1. Mobile Filter Toggle
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

    // 2. Filter Checkbox Interactions (Visual Feedback)
    const filterCheckboxes = document.querySelectorAll('input[type="checkbox"].form-checkbox');
    filterCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', (e) => {
            // Here you would typically trigger an AJAX request or form submission
            // to filter the products based on the selected categories.
            console.log(`Filter changed: ${e.target.name} - ${e.target.checked}`);
        });
    });

    // 3. Price Range Slider (Mock functionality)
    const priceMin = document.getElementById('price-min');
    const priceMax = document.getElementById('price-max');
    
    if (priceMin && priceMax) {
        [priceMin, priceMax].forEach(input => {
            input.addEventListener('change', (e) => {
                console.log(`Price range updated: Min ${priceMin.value} - Max ${priceMax.value}`);
            });
        });
    }
});
