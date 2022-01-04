<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage Aurora
 * @since Aurora 1.0
 */

get_header(); ?>

<header class="entry-header" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/smiling-at-dentist.jpg.webp');">
	<div id="content" class="container" role="main">
		<div id="primary" class="site-content">
			<h1><?php printf( __( 'Search Results for: %s', 'aurora' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
		</div>
	</div><!-- #content -->
</header>
<div class="container breadcrumb-section" role="main">
	<div class="site-content entry-content">
		<?php if ( function_exists('yoast_breadcrumb') ) {yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?>
	</div>
</div>
<div id="content">
	<?php
		$i = 0;
		if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post();
			$i++; ?>
			<?php if($i % 2 == 0) { ?><section class="white"><?php } else { ?><section><?php } ?>
				<div class="container" role="main">
					<div class="site-content entry-content">
						<?php get_template_part( 'content', 'search' ); ?>
					</div><!-- .site-content -->
				</div><!-- .container -->
			</section>
			<?php endwhile; ?>
			<?php if(function_exists('wpbeginner_numeric_posts_nav')) { ?>
				<div class="container" role="main">
					<div class="site-content entry-content">
						<?php wpbeginner_numeric_posts_nav(); ?>
					</div>
				</div>
			<?php } else { aurora_content_nav( 'nav-below' ); } ?>
		<?php else : ?>
			<section class="full">
				<div class="container" role="main">
					<div class="site-content entry-content">
						<article id="post-0" class="post no-results not-found">
							<div class="entry-content">
								<h2 class="entry-title"><?php _e( 'Nothing Found', 'aurora' ); ?></h2>
								<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'aurora' ); ?></p>
								<?php get_search_form(); ?>
							</div><!-- .entry-content -->
						</article><!-- #post-0 -->
					</div><!-- .site-content -->
				</div><!-- .container -->
			</section>
		<?php endif; ?>
	</div>
		<div class="container sidebar-container">
			<?php get_sidebar(); ?>
		</div>
	<?php get_footer(); ?>
