<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Aurora
 * @since Aurora 1.0
 */
?>
</div><!-- #main .wrapper -->
<?php if(is_page_template('page-templates/contact-page.php')) : ?>
	<div class="divider"></div>
<?php else : ?>
	<?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
		<?php if(is_page_template('page-templates/front-page.php')) : ?>
		<?php else : ?>
			<?php dynamic_sidebar( 'sidebar-2' ); ?>
		<?php endif; ?>
	<?php endif; ?>
	<?php if ( is_active_sidebar( 'sidebar-3' ) ) : ?>
		<?php dynamic_sidebar( 'sidebar-3' ); ?>
	<?php endif; ?>
<?php endif; ?>
<footer class="global" role="contentinfo">
	<div class="container textalign-center">
		<div class="footer-logo">
			<?php
				$image = get_field('logo', 'option');
    		$url = $image['url'];
    		$title = $image['title'];
    		$alt = $image['alt'];
    		$size = 'thumbnail';
    		$thumb = $image['sizes'][ $size ];
    		$width = $image['sizes'][ $size . '-width' ];
    		$height = $image['sizes'][ $size . '-height' ];
				if( !empty( $image ) ): ?>
    			<img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($alt); ?> width="<?php echo $width; ?>" height="<?php echo $height; ?>" />
			<?php endif; ?>
		</div>
		<div class="clearboth"></div>
		<div class="navigation-container" role="navigation">
			<nav id="site-navigation" class="navigation-primary" role="navigation">
				<ul id="menu-footer-menu" class="nav-menu">
					<?php wp_nav_menu( array( 'theme_location' => 'footer', 'menu_class' => 'nav-menu', 'container' => '', 'items_wrap' => '%3$s' ) ); ?>
					<?php if(get_field('facebook_link', 'option')) : ?>
						<li class="extra">
							<a href="<?php the_field('facebook_link', 'option'); ?>" class="facebook" target="_blank"><span class="dashicons dashicons-facebook-alt"></span></a>
						</li>
					<?php endif; ?>
				</ul>
			</nav>
		</div>
		<div class="clearboth"></div>
		<div class="copyright">
			<p>&copy;<script>document.write(new Date().getFullYear())</script> <?php bloginfo( 'title' ); ?> |
				<?php if(have_rows('copyright_links', 'option')) : while(have_rows('copyright_links', 'option')) : the_row();
				$link = get_sub_field('link');
					if( $link ):
	 					$link_url = $link['url'];
	 					$link_title = $link['title'];
	 					$link_target = $link['target'] ? $link['target'] : '_self';?>
					<span class="link"><a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a></span><span class="link-divider"> | </span>
				<?php endif; endwhile; endif; ?>
		</div>
	</div>
	</footer><!-- #colophon -->
</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>
