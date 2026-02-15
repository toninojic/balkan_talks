<header id="header" >
    <div class="container">
        <div class="logo">
            <?php
            if (has_custom_logo()) {
                the_custom_logo();
            }
            echo '<a href="' . esc_url(home_url('/')) . '">' . get_bloginfo('name') . '</a>';
            ?>

        </div>
        <nav id="main-menu">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary_menu',
                'menu_class' => 'primary-menu',
            ));
            ?>

            <div class="three col">
                <div class="hamburger hamburger-menu" id="hamburger-1">
                    <span class="line"></span>
                    <span class="line"></span>
                    <span class="line"></span>
                </div>
            </div>
        </nav>
    </div>
</header>
