</main>

<footer id="footer">
    <div class="container">
        <p>Copyright &copy; <?php echo date('Y'); ?>  – Balkan Talks</p>
        <?php if (is_active_sidebar('social-links')) : ?>
            <?php dynamic_sidebar('social-links'); ?>
        <?php endif; ?>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
