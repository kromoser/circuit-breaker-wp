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
							<form action="https://dccircuitbreaker.us18.list-manage.com/subscribe/post" method="POST" class="email-form">

								<input type="hidden" name="u" value="dc86b249040dc18466c405e49">
								<input type="hidden" name="id" value="f9c6edc91d">

								<!-- people should not fill these in and expect good things -->
						    <div class="field-shift" aria-label="Please leave the following three fields empty">
						        <label for="b_name">Name: </label>
						        <input type="text" name="b_name" tabindex="-1" value="" placeholder="Freddie" id="b_name">

						        <label for="b_email">Email: </label>
						        <input type="email" name="b_email" tabindex="-1" value="" placeholder="youremail@gmail.com" id="b_email">

						        <label for="b_comment">Comment: </label>
						        <textarea name="b_comment" tabindex="-1" placeholder="Please comment" id="b_comment"></textarea>
						    </div>

								<div class="email-form-group w-50">
									<input type="text" id="MERGE1" name="MERGE1" class="w-100" placeholder="First name">
								</div>
								<div class="email-form-group w-50">
									<input type="text" id="MERGE2" name="MERGE2" class="w-100" placeholder="Last name">
								</div>
								<div class="email-form-group w-100">
									<input type="email" id="MERGE0" name="MERGE0" class="w-100" placeholder="E-mail address">
								</div>
								<div class="w-100">
								<button type="submit" class="w-100">Sign up</button>
								</div>
							</form>
						</div>

            <div class="col-sm-12 col-lg-4 offset-lg-2 logo-footer">
							<div class="">
								<a href="<?php echo home_url() ?>"><img src="//dccircuitbreaker.org/wp-content/uploads/2018/06/logo-inverse-1.png" alt="DC Circuit Breaker"></a>
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
