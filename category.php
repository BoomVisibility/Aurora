<?php
/**
 * The template for displaying Category pages.
 *
 * Used to display archive-type pages for posts in a category.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Aurora
 * @since Aurora 1.0
 */
get_header(); ?>
<header class="entry-header" style="background-image: url('<?php the_field('header_image', 'option'); ?>');">
	<div id="content" class="container" role="main">
		<div id="primary" class="site-content">
			<h1><?php printf( __( 'Category: %s', 'aurora' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?></h1>
		</div>
	</div><!-- #content -->
</header>
<div class="container breadcrumb-section" role="main">
	<div class="site-content entry-content">
		<?php if ( function_exists('yoast_breadcrumb') )
		{yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?>
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
					<?php get_template_part( 'content', get_post_format() ); ?>
				</div><!-- #content -->
			</div><!-- #primary -->
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
						<?php get_template_part( 'content', 'none' ); ?>
					</div><!-- #content -->
				</div><!-- #primary -->
			</section>
		<?php endif; ?>
	</div><!-- #content -->
<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
