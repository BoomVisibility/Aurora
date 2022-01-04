<?php
/**
 * Template Name: Team Page
 *
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
$i++; ?>
<?php if($i % 2 == 0) { ?>
		<section class="white">
	<?php } else { ?>
		<section>
	<?php } ?>
		<div class="container" role="main">
			<div class="site-content entry-content">
				<?php if($i==1) { if($title) { ?><h2><?php echo $title; ?></h2><?php } else { ?><h2><?php echo the_title(); ?></h2><?php } } ?>
				<?php the_sub_field('top_text'); ?>
				<?php if(have_rows('bio_block')) : while(have_rows('bio_block')) : the_row();
					$image = get_sub_field('image');
					if( $image ) {

    				$url = $image['url'];
    				$title = $image['title'];
    				$alt = $image['alt'];
    				$caption = $image['caption'];

    				$size = 'bio';
    				$thumb = $image['sizes'][ $size ];
    				$width = $image['sizes'][ $size . '-width' ];
    				$height = $image['sizes'][ $size . '-height' ]; } ?>
				<div class="white bio-container">
					<img class="bio-image" src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($alt); ?>" />
					<h3><?php the_sub_field( 'name' ); ?></h3>
					<h4><?php the_sub_field( 'title' ); ?></h4>
					<?php the_sub_field( 'bio' ); ?>
				</div>
				<?php endwhile; endif; ?>
			</div>
		</div><!-- #content -->
	</section>
<?php endwhile; endif; ?>
</div>
	<div class="container sidebar-container">
		<?php get_sidebar(); ?>
	</div>
<?php get_footer(); ?>
