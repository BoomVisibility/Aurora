<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Aurora
 * @since Aurora 1.0
 */

get_header(); ?>
<header class="entry-header" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/smiling-at-dentist.jpg.webp');">
	<div id="content" class="container" role="main">
		<div id="primary" class="site-content">
			<h1><?php printf( __( '404 Not Found', 'aurora' ) ); ?></h1>
		</div>
	</div><!-- #content -->
</header>
<div class="container breadcrumb-section" role="main">
	<div class="site-content entry-content">
		<?php if ( function_exists('yoast_breadcrumb') ) {yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?>
	</div>
</div>
<div id="content">
	<section class="full">
		<div class="container">
			<article id="post-0" class="post error404 no-results not-found">
				<div class="entry-content">
					<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'aurora' ); ?></p>
					<?php get_search_form(); ?>
				</div><!-- .entry-content -->
			</article><!-- #post-0 -->
		</div>
	</section>
</div><!-- #content -->
<?php get_footer(); ?>
