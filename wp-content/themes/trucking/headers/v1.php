<header id="apus-header" class="site-header apus-header header-v1 hidden-sm hidden-xs" role="banner">
    <div id="apus-topbar" class="apus-topbar">
        <div class="topbar-inner clearfix">
            <div class="container">
                <?php if ( is_active_sidebar( 'sidebar-social' ) ) : ?>
                    <div class="pull-left">
                        <?php dynamic_sidebar( 'sidebar-social' ); ?>
                    </div>
                <?php endif; ?>
                <?php if ( has_nav_menu( 'topmenu' ) ) { ?>
                    <div class="setting-popup pull-right">
                        <?php
                            $args = array(
                                'theme_location'  => 'topmenu',
                                'container_class' => '',
                                'menu_class'      => 'menu-topbar'
                            );
                            wp_nav_menu($args);
                        ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="clearfix">
        <div class="container">
            <div class="header-inner">
                <div class="header-top">
                    <div class="row">
                    <!-- LOGO -->
                        <div class="col-md-4 col-xs-12">
                            <div class="logo-in-theme pull-left">
                                <?php get_template_part( 'page-templates/parts/logodefault' ); ?>
                            </div>
                        </div>
                        <?php if ( is_active_sidebar( 'sidebar-contact' ) ) : ?>
                            <div class="col-md-8">
                                <?php dynamic_sidebar( 'sidebar-contact' ); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="<?php echo (trucking_get_config('keep_header') ? 'main-sticky-header-wrapper' : ''); ?>">
        <div class="<?php echo (trucking_get_config('keep_header') ? 'main-sticky-header' : ''); ?>">
            <div class="header-main">
                <div class="container">
                    <div class="header-menu p-relative">
                        <?php if ( has_nav_menu( 'primary' ) ) : ?>
                            <div class="main-menu  pull-left">
                                <nav 
                                 data-duration="400" class="hidden-xs hidden-sm apus-megamenu slide animate navbar" role="navigation">
                                <?php   $args = array(
                                        'theme_location' => 'primary',
                                        'container_class' => 'collapse navbar-collapse',
                                        'menu_class' => 'nav navbar-nav megamenu',
                                        'fallback_cb' => '',
                                        'menu_id' => 'primary-menu',
                                        'walker' => new Trucking_Nav_Menu()
                                    );
                                    wp_nav_menu($args);
                                ?>
                                </nav>
                            </div>
                        <?php endif; ?>
                        <?php if ( trucking_get_config('show_searchform') ): ?>
                            <div class="pull-right">
                                <?php get_search_form(); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>