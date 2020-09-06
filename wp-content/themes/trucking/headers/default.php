<header id="apus-header" class="site-header apus-header header-default hidden-sm hidden-xs" role="banner">
    <div class="<?php echo (trucking_get_config('keep_header') ? 'main-sticky-header-wrapper' : ''); ?>">
    <div class="<?php echo (trucking_get_config('keep_header') ? 'main-sticky-header' : ''); ?>">
    <div class="header-main clearfix">
        <div class="container">
            <div class="header-inner p-relative">
                    <div class="row">
                    <!-- LOGO -->
                        <div class="col-md-2">
                            <div class="logo-in-theme pull-left">
                                <?php get_template_part( 'page-templates/parts/logo' ); ?>
                            </div>
                        </div>
                        <div class="col-md-10 p-static">
                            <div class="pull-right">
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
                                <div class="heading-right pull-right hidden-sm hidden-xs">
                                    <div class="pull-right  header-setting">
                                        <?php if ( has_nav_menu( 'topmenu' ) ) { ?>
                                            <div class="setting-popup pull-right">
                                                <div class="dropdown">
                                                    <button class="dropdown-toggle button-setting" type="button" data-toggle="dropdown"><span class="fa fa-bars"></span></button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <div class="pull-left">
                                                            <?php
                                                                $args = array(
                                                                    'theme_location'  => 'topmenu',
                                                                    'container_class' => '',
                                                                    'menu_class'      => 'menu-topbar'
                                                                );
                                                                wp_nav_menu($args);
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                         
                                        <?php if ( trucking_get_config('show_searchform') ): ?>
                                            <div class="dropdown dropdown-search pull-right">
                                                <button type="button" class="button-show-search button-setting" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fa fa-search"></i></button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                    <?php get_search_form(); ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</header>