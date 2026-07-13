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
