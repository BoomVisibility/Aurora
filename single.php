<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Aurora
 * @since Aurora 1.0
 */
get_header(); ?>
<header class="entry-header" style="background-image: url('<?php the_field('header_image', 'option'); ?>');">
	<div id="content" class="container" role="main">
		<div id="primary" class="site-content">
			<h2 class="single-post-title"><?php $our_title = get_the_title( get_option('page_for_posts', true) ); echo $our_title; ?></h2>
			<p><?php the_field( 'subtitle' ); ?></p>
		</div>
	</div><!-- #content -->
</header>
<div class="container breadcrumb-section" role="main">
	<div class="site-content entry-content intro">
		<?php if ( function_exists('yoast_breadcrumb') )
		{yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?>
		<h1 class="post-title"><?php the_title(); ?></h1>
		<small><?php the_date(); ?></small>
		<ul class="social">
				<li>Share: </li>
				<li class="facebook"><a href="https://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>" target="_blank" rel="noopener"><span class="dashicons dashicons-facebook"></span></a></li>
				<li class="twitter"><a href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>" target="_blank" rel="noopener"><span class="dashicons dashicons-twitter"></span></a></li>
				<li class="pinterest"><a href="https://pinterest.com/pin/create/link/?url=<?php the_permalink(); ?>" target="_blank" rel="noopener"><span class="dashicons dashicons-pinterest"></span></a></li>
			</ul>
	</div>
</div>
<div id="content">
	<section class="white">
	<div class="container" role="main">
		<div class="site-content entry-content">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'content', get_post_format() ); ?>
					<hr />
					<div class="category"><strong><?php _e('Posted In:', 'wplook'); ?></strong> <?php the_category(', ') ?><div class="end"></div></div>
					<?php
					if(get_the_tag_list()) {?>
						<div class="tags"><strong><?php _e('Tagged In:', 'wplook'); ?></strong>
							<?php echo get_the_tag_list('<span>',', ','</span>'); ?>
							<div class="end"></div>
						</div>
						<?php } ?>
						<?php comments_template( '', true ); ?>
					<?php endwhile; // end of the loop. ?>
				</div><!-- .site-content -->
			</div><!-- .container -->
		</section>
	</div><!-- #content -->
	<div class="container sidebar-container">
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
