<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WP_Bootstrap_Starter
 */

?>
<?php if(!is_page_template( 'blank-page.php' ) && !is_page_template( 'blank-page-with-container.php' )): ?>
			</div><!-- .row -->
		</div><!-- .container -->
	</div><!-- #content -->
    <?php get_template_part( 'footer-widget' ); ?>
	<footer id="colophon" class="site-footer <?php echo wp_bootstrap_starter_bg_class(); ?>" role="contentinfo">
		<div class="container-fluid p-3 p-md-5 row">
						<div class="col-sm-12 col-lg-3">
							<nav>
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

						<div class="col-sm-12 col-lg-3">
							<div class="block-title">Sign up for our list</div>
							<form action="#" method="POST" class="email-form">
								<div class="email-form-group w-50">
									<input type="text" id="first_name" class="w-100" placeholder="First name">
								</div>
								<div class="email-form-group w-50">
									<input type="text" id="last_name" class="w-100" placeholder="Last name">
								</div>
								<div class="email-form-group w-100">
									<input type="email" id="e-mail" class="w-100" placeholder="E-mail address">
								</div>
								<div class="w-100">
								<button type="submit" class="w-100">Sign up</button>
								</div>
							</form>
						</div>

            <div class="col-sm-12 col-lg-4 offset-lg-2 logo-footer">
							<div class="">
								<a href="<?php echo home_url() ?>"><img src="<?php echo wp_get_attachment_url( '1668' ); ?>" alt="DC Circuit Breaker"></a> 
									&copy; <?php echo date('Y'); ?> <?php echo '<a href="'.home_url().'">'.get_bloginfo('name').'</a>'; ?>

							</div>
            </div><!-- close .site-info -->
		</div>
	</footer><!-- #colophon -->
<?php endif; ?>
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
