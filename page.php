<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
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
			<h1><?php the_title(); ?></h1>
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
<div id="content" <?php if(get_field('reverse_on_mobile')) { ?>class="reverse"<?php } ?>>
<?php
$i = 0;
$title = get_field('page_title');
if(have_rows('sections')) : while(have_rows('sections')) : the_row();
$i++; ?>
<?php if($i % 2 == 0) {
	if(get_sub_field('color') == 'blue') : ?>
		<section class="blue">
	<?php else : ?>
		<section class="white">
	<?php endif;
} else {
	if(get_sub_field('color') == 'blue') : ?>
		<section class="blue">
	<?php else : ?>
		<section class="gray">
	<?php endif;
		} ?>
		<div class="container" role="main">
			<div class="site-content entry-content">
				<?php if($i==1) { if($title) { ?><h2><?php echo $title; ?></h2><?php } else { ?><h2><?php echo the_title(); ?></h2><?php } } ?>
				<?php the_sub_field( 'section' ); ?>
			</div>
		</div><!-- #content -->
	</section>
<?php endwhile; endif; ?>
</div>
	<div class="container sidebar-container">
		<?php get_sidebar(); ?>
	</div>
<?php get_footer(); ?>
