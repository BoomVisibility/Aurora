<?php
/**
 * The main template file.
 *
 * @package WordPress
 * @subpackage Aurora
 * @since Aurora 1.0
 */
get_header(); ?>
<header class="entry-header" style="background-image: url('<?php the_field('header_image', 'option'); ?>');">
	<div id="content" class="container" role="main">
		<div id="primary" class="site-content">
			<h1><?php single_post_title(); ?></h1>
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
		<?php if($i == 1) { ?>
			<section class="full">
				<div class="container" role="main">
					<div class="site-content entry-content">
						<?php get_template_part( 'content', get_post_format() ); ?>
					</div>
				</div>
			</section>
			<section class="blog-container">
				<div class="container" role="main">
					<div class="site-content entry-content">
		<?php } else { ?>
				<?php if($i % 2 == 0) { ?><div class="flex-container"><?php } ?>
						<div class="white bio-container">

							<a href="<?php the_permalink(); ?>">
								<div class="bio-image">
									<?php if(get_the_post_thumbnail()) : ?>
										<?php the_post_thumbnail('blog-thumb'); ?>
									<?php else : ?>
										<img src="<?php echo get_template_directory_uri(); ?>/images/generic-dentist-image.jpg" alt="Aurora City Dental" />
									<?php endif; ?>
								</div>
							</a>
							<a href="<?php the_permalink(); ?>">
								<h3 class="blog-title"><?php the_title();?></h3>
							</a>
							<div class="date"><?php the_time('F j, Y');?></div>
							<?php the_excerpt(); ?>
							<a class="read-more" href="<?php the_permalink(); ?>">Read more </a>
						</div>
					<?php if($i % 2 == 0) {  } else { echo '</div>'; } ?>
		<?php } ?>
	<?php endwhile; ?>
		</div><!-- #content -->
	</div><!-- #primary -->
	<?php if(function_exists('wpbeginner_numeric_posts_nav')) { ?>
		<div class="container" role="main">
			<div class="site-content entry-content">
				<?php wpbeginner_numeric_posts_nav(); ?>
			</div>
		</div>
	<?php } else { aurora_content_nav( 'nav-below' ); } ?>
</section>
	<?php else : ?>
		<div class="container" role="main">
			<div class="site-content entry-content">
				<section class="full">
		<article id="post-0" class="post no-results not-found">
			<?php if ( current_user_can( 'edit_posts' ) ) : ?>
				<header class="entry-header">
					<h2 class="entry-title"><?php _e( 'No posts to display', 'aurora' ); ?></h2>
				</header>
				<div class="entry-content">
					<p><?php printf( __( 'Ready to publish your first post? <a href="%s">Get started here</a>.', 'aurora' ), admin_url( 'post-new.php' ) ); ?></p>
				</div><!-- .entry-content -->
			<?php else : ?>
				<header class="entry-header">
					<h2 class="entry-title"><?php _e( 'Nothing Found', 'aurora' ); ?></h2>
				</header>
				<div class="entry-content">
					<p><?php _e( 'Apologies, but no results were found. Perhaps searching will help find a related post.', 'aurora' ); ?></p>
					<?php get_search_form(); ?>
				</div><!-- .entry-content -->
			<?php endif; ?>
		</article><!-- #post-0 -->
	</section>
	</div><!-- #content -->
</div><!-- #primary -->
	<?php endif; ?>
	<div class="container sidebar-container">
		<?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer(); ?>
