document.addEventListener('DOMContentLoaded', function () {
    const sidebar = document.querySelector('.sidebar');
    const container = document.querySelector('.container');

    function checkSidebarScrollbar() {
        // Check if sidebar content height exceeds its client height
        const hasScrollbar = sidebar.scrollHeight > sidebar.clientHeight;
        
        // Toggle .has-scrollbar class
        if (hasScrollbar) {
            sidebar.classList.add('has-scrollbar');
            container.classList.add('has-scrollbar');
        } else {
            sidebar.classList.remove('has-scrollbar');
            container.classList.remove('has-scrollbar');
        }
    }

    // Run on load
    checkSidebarScrollbar();

    // Run on window resize or content change
    window.addEventListener('resize', checkSidebarScrollbar);

    // Observe changes in sidebar content (e.g., dynamic widgets)
    const observer = new MutationObserver(checkSidebarScrollbar);
    observer.observe(sidebar, { childList: true, subtree: true });
});