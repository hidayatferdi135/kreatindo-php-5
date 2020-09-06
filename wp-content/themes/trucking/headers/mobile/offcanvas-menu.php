<div id="apus-mobile-menu" class="apus-offcanvas hidden-lg hidden-md"> 
    <div class="apus-offcanvas-body">
        <?php get_template_part( 'page-templates/parts/productsearchform' ); ?>
        <nav class="navbar navbar-offcanvas navbar-static" role="navigation">
            <?php
                $args = array(
                    'theme_location' => 'primary',
                    'container_class' => 'navbar-collapse navbar-offcanvas-collapse',
                    'menu_class' => 'nav navbar-nav',
                    'fallback_cb' => '',
                    'menu_id' => 'main-mobile-menu',
                    'walker' => new Trucking_Mobile_Menu()
                );
                wp_nav_menu($args);
            ?>
        </nav>
        <?php if ( has_nav_menu( 'topmenu' ) ) { ?>
            <h3 class="setting"><i class="fa fa-cog" aria-hidden="true"></i> <?php esc_html_e( 'Setting', 'trucking' ); ?></h3>
                <?php
                    $args = array(
                        'theme_location'  => 'topmenu',
                        'container_class' => '',
                        'menu_class'      => 'menu-topbar'
                    );
                    wp_nav_menu($args);
                ?>
        <?php } ?>
    </div>
</div>