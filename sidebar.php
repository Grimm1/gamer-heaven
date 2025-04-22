<div class="sidebar">
    <?php if (is_active_sidebar('sidebar-1')) : ?>
        <?php dynamic_sidebar('sidebar-1'); ?>
    <?php else : ?>
        <h3>Sidebar</h3>
        <p>Add widgets to the sidebar in the WordPress admin to display site-wide content.</p>
    <?php endif; ?>
</div>
