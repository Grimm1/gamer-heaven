document.addEventListener('DOMContentLoaded', function () {
    const sidebar = document.querySelector('.sidebar');
    const container = document.querySelector('.container');

    if (!sidebar || !container) {
        console.warn('Gamer Heaven: Sidebar or container missing, skipping scrollbar detection.');
        return;
    }

    function checkSidebarScrollbar() {
        try {
            const hasScrollbar = sidebar.scrollHeight > sidebar.clientHeight;
            if (hasScrollbar) {
                sidebar.classList.add('has-scrollbar');
                container.classList.add('has-scrollbar');
            } else {
                sidebar.classList.remove('has-scrollbar');
                container.classList.remove('has-scrollbar');
            }
        } catch (e) {
            console.error('Gamer Heaven: Error in checkSidebarScrollbar:', e);
        }
    }

    // Throttle resize events
    let resizeTimeout;
    function throttledCheckSidebarScrollbar() {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(checkSidebarScrollbar, 100);
    }

    // Run on load
    checkSidebarScrollbar();

    // Run on window resize
    window.addEventListener('resize', throttledCheckSidebarScrollbar);

    // Observe sidebar changes with error handling
    try {
        const observer = new MutationObserver(throttledCheckSidebarScrollbar);
        observer.observe(sidebar, { childList: true, subtree: true });
    } catch (e) {
        console.error('Gamer Heaven: Error setting up MutationObserver:', e);
    }
});