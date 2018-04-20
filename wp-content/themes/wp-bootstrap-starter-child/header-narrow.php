<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WP_Bootstrap_Starter
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://fonts.googleapis.com/css?family=OpenSans:300,300i,400,400i,500,500i,700,700i|Vollkorn:400,400i,600,600i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>

  <script type="text/javascript">

    jQuery(document).ready(function() {

      const logo = jQuery("#logo");

      window.onscroll = function() {
        growShrinkLogo()
      };

      function growShrinkLogo() {
        if (document.documentElement.scrollTop > 5) {
           logo.addClass('shrink-logo');
         } else {
           logo.removeClass('shrink-logo');
         }
      }

    });

  </script>

</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'wp-bootstrap-starter' ); ?></a>
    <?php if(!is_page_template( 'blank-page.php' ) && !is_page_template( 'blank-page-with-container.php' )): ?>
      <div class="w-100 pre-header">
        News and Analysis on the U.S. Court of Appeals for the D.C. Circuit
      </div>
      <header id="masthead" class="site-header narrow-header" role="banner">
        <div class="container-fluid">



          <div class="navbar-brand col-sm-12">
            <div class="row">
            <?php if ( get_theme_mod( 'wp_bootstrap_starter_logo' ) ): ?>
                <a href="<?php echo esc_url( home_url( '/' )); ?>" class="col-lg-4 col-sm-12">
                    <img src="<?php echo esc_attr(get_theme_mod( 'wp_bootstrap_starter_logo' )); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" class="branding-logo" id="logo">
                </a>
            <?php else : ?>
                <a class="site-title" href="<?php echo esc_url( home_url( '/' )); ?>"><?php esc_url(bloginfo('name')); ?></a>
            <?php endif; ?>

            <nav class="navbar navbar-expand-lg col-sm-12 col-lg-8" role="navigation" id="nav" data-spy="affix">

              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-nav" aria-controls="" aria-expanded="false" aria-label="Toggle navigation">
                  <i class="material-icons">menu</i>
              </button>

                  <?php
                  wp_nav_menu(array(
                  'theme_location'    => 'primary',
                  'container'       => 'div',
                  'container_id'    => 'main-nav',
                  'container_class' => 'collapse navbar-collapse',
                  'menu_id'         => false,
                  'menu_class'      => 'navbar-nav',
                  'depth'           => 3,
                  'fallback_cb'     => 'wp_bootstrap_navwalker::fallback',
                  'walker'          => new wp_bootstrap_navwalker()
                  ));
                  ?>

              </nav>
            </div>
          </div>
        </div>
      </header>



	</header><!-- #masthead -->
    <?php if(!is_front_page() && !get_theme_mod( 'header_banner_visibility' )): ?>
      <div id="content" class="site-content">
    		<div class="container">
    			<div class="row">
    <?php endif; ?>

                <?php endif; ?>
