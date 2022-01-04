<?php
/**
 * Template Name: Contact Page - Full
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
			<h1><?php the_title(); ?>
			<p><?php the_field( 'subtitle' ); ?></p>
		</div>
	</div><!-- #content -->
</header>
<div class="container breadcrumb-section" role="main">
	<div class="site-content entry-content">
		<?php if ( function_exists('yoast_breadcrumb') )
		{yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?>
	</div>
</div>
<div id="content" class="container">
	<section class="full">
		<?php while ( have_posts() ) : the_post(); ?>
			<div class="half">
				<?php get_template_part( 'content', 'page' ); ?>
			</div>
		<?php endwhile; // end of the loop. ?>
		<?php if ( get_field( 'form' ) ) : ?>
			<div class="half white form-body last" role="complementary">
				<?php the_field( 'form' ); ?>
			</div><!-- #secondary -->
		<?php endif; ?>
	</section>
</div><!-- #content -->
<?php get_footer(); ?>
