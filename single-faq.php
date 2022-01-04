<?php
/**
 * The Template for displaying all single FAQ posts.
 *
 * @package WordPress
 * @subpackage Aurora
 * @since Aurora 1.0
 */
get_header(); ?>
<?php if ( has_post_thumbnail() ) : ?>
	<header class="entry-header" style="background-image: url(<?php $feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'page-header' ); echo $feat_image;  ?>);">
<?php else : ?>
	<header class="entry-header" style="background-image: url('<?php the_field('header_image', 'option'); ?>');">
<?php endif; ?>
	<div id="content" class="container" role="main">
		<div id="primary" class="site-content">
			<h2 class="single-post-title">FAQ</h2>
			<p><?php the_field( 'subtitle' ); ?></p>
		</div>
	</div><!-- #content -->
</header>
<div id="content">
	<section class="white">
	<div class="container" role="main">
		<div class="site-content entry-content">
			<h2><?php the_title(); ?></h2>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'faq' ); ?>
			<?php endwhile; // end of the loop. ?>
		</div><!-- .site-content -->
	</div><!-- .container -->
</section>
</div><!-- #content -->
<div class="container sidebar-container">
<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
