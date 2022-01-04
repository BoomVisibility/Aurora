<?php
/**
 * Template Name: Reviews Page Template
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
<div id="content">
	<?php if(have_rows('reviews', 'option')) : ?>
		<section id="testimonials" class="full">
			<div class="container" role="main">
				<div class="site-content entry-content">
					<?php $title = get_field('page_title'); if($title) { ?><h2><?php echo $title; ?></h2><?php } else { ?><h2><?php echo the_title(); ?></h2><?php }?>
					<div class="reviews textalign-center">
					<?php
						function percent($number){
						return $number * 20;
						}

						while(have_rows('reviews', 'option')) : the_row();	?>
							<div class="review-container">
								<div class="rating-image">
									<a href="<?php the_sub_field('reviews_link'); ?>" target="_blank"><img src="<?php the_sub_field('logo'); ?>" alt="logo" /></a><br />
								</div>
							<div class="star-ratings-css">
									<?php
										$rating = get_sub_field('rating');
									?>
								<div class="star-ratings-css-top" style="width: <?php echo percent($rating); ?>%;"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
									<div class="star-ratings-css-bottom"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
								</div>
								<div class="rating-text"><p><?php echo $rating; ?> out of 5 stars</p></div>
								<div class="rating-link"><a href="<?php the_sub_field('reviews_link'); ?>" target="_blank"><?php the_sub_field('number_of_reviews'); ?> Reviews ></a></div>
							</div>
						<?php endwhile; ?>
					</div>
				</div>
			</div>
		</section>
		<?php endif; ?>
		<section class="white">
			<div class="container" role="main">
				<div class="site-content entry-content">
					<?php the_content(); ?>
				</div>
			</div>
		</section>
	</div>
	<div class="container sidebar-container">
		<?php get_sidebar(); ?>
	</div>
<?php get_footer(); ?>
