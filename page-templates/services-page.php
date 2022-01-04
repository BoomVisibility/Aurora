<?php
/**
 * Template Name: Services Page
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
<div id="content">
<?php
$i = 0;
$title = get_field('page_title');
if(have_rows('sections')) : while(have_rows('sections')) : the_row();
$i++;
$image = get_sub_field('image');
$size = 'service-image';
$thumb = $image['sizes'][ $size ];
$width = $image['sizes'][ $size . '-width' ];
$height = $image['sizes'][ $size . '-height' ]; ?>
<?php if($i == 1) { echo '<section class="full">'; } else { echo '<section class="white">'; } ?>
		<div class="container" role="main">
			<div class="site-content entry-content blog">
				<?php if($i==1) { if($title) { ?><h2><?php echo $title; ?></h2><?php } else { ?><h2><?php echo the_title(); ?></h2><?php } } ?>
				<?php if ($image) : ?>
					<div class="one_third">
						<img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($image['alt']); ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" />
					</div>
					<div class="two_thirds last">
				<?php else : ?>
					<div>
				<?php endif; ?>
				<?php if($i == 1) { ?>
					<h2><?php the_sub_field( 'title' ); ?></h2>
				<?php } else { ?>
						<h3 class="service-title"><a href="<?php the_sub_field( 'link' ); ?>"><?php the_sub_field( 'title' ); ?></a></h3>
				<?php } ?>
						<?php the_sub_field( 'section' ); ?>
						<?php if(get_sub_field('link')) : ?>
							<a href="<?php the_sub_field( 'link' ); ?>" class="button">Learn More</a>
						<?php endif; ?>
					</div>
			</div>
		</div><!-- #content -->
	</section>
<?php endwhile; endif; ?>
</div>
	<div class="container sidebar-container">
		<?php get_sidebar(); ?>
	</div>
<?php get_footer(); ?>
