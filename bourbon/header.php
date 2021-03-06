<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Bourbon
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'bourbon' ); ?></a>

	<header id="masthead" class="site-header">
		<nav id="site-navigation" class="main-navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'bourbon' ); ?></button>
			<?php
			wp_nav_menu( array(
				'theme_location' => 'menu-1',
				'menu_id'        => 'primary-menu',
			) );
			?>
		</nav><!-- #site-navigation -->

        <!--[jumotron start]-->
        <div class="jumbotron-ver2 jumbo img-responsive">
            <div class="jumbotron-table">
                <div class="jumbotron-center">
                    <div class="title">
                        <div class="tlt tlt-ver2">
                            <ul class="texts">
                                <?php
                                the_custom_logo();
                                if ( is_front_page() && is_home() ) :
                                    ?>
<!--                                    <h1 class="site-title"><a href="--><?php //echo esc_url( home_url( '/' ) ); ?><!--" rel="home">--><?php //bloginfo( 'name' ); ?><!--</a></h1>-->
                                    <li data-in-effect="fadeInDown" data-in-shuffle="false" data-out-effect="flipOutX" data-out-shuffle="true"><h1><?php bloginfo( 'name' ); ?></h1></li>
                                <?php
                                else :
                                    ?>
<!--                                    <p class="site-title"><a href="--><?php //echo esc_url( home_url( '/' ) ); ?><!--" rel="home">--><?php //bloginfo( 'name' ); ?><!--</a></p>-->
                                    <li data-in-effect="fadeInDown" data-in-shuffle="false" data-out-effect="flipOutX" data-out-shuffle="true"><h1><?php bloginfo( 'name' ); ?></h1></li>
                                <?php
                                endif;
                                ?>
<!--                                <li data-in-effect="fadeInDown" data-in-shuffle="false" data-out-effect="flipOutX" data-out-shuffle="true"><h1>We are  Pro<span class="span-1">builder</span></h1></li>-->
<!--                                <li data-in-effect="fadeInDown" data-in-shuffle="false" data-out-effect="flipOutX" data-out-shuffle="true"><h1>We build faster</h1></li>-->
<!--                                 <li data-in-effect="fadeInDown" data-in-shuffle="false" data-out-effect="flipOutX" data-out-shuffle="true"><h1>ProBuilder works Great</h1></li>-->
                            </ul>
                                <?php
                                $bourbon_description = get_bloginfo( 'description', 'display' );
                                if ( $bourbon_description || is_customize_preview() ) :
                                    ?>
                                    <p class="revealSubTitle site-description"><?php echo $bourbon_description; /* WPCS: xss ok. */ ?></p>
                                <?php endif; ?>
<!--                            <p>-->
<!--                                Professional & Building Company-->
<!--                            </p>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="opac"></div>
        <!--[jumotron end]-->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
