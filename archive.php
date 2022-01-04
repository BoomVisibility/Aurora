<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, Aurora already
 * has tag.php for Tag archives, category.php for Category archives, and
 * author.php for Author archives.
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
			<h1 class="archive-title">
				<?php
					if ( is_day() ) : printf( __( 'Daily Archives: %s', 'aurora' ), '<span>' . get_the_date() . '</span>' );
					elseif ( is_month() ) :	printf( __( 'Monthly Archives: %s', 'aurora' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'aurora' ) ) . '</span>' );
					elseif ( is_year() ) : printf( __( 'Yearly Archives: %s', 'aurora' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'aurora' ) ) . '</span>' );
					else : _e( 'Archives', 'aurora' );
					endif;
					?>
			</h1>
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
			<?php if(function_exists('wpbeginner_numeric_posts_nav')) {
				wpbeginner_numeric_posts_nav();
				}
				else {
					aurora_content_nav( 'nav-below' );
				}
				?>
		<?php else : ?>
			<section class="full">
				<div class="container" role="main">
					<div class="site-content entry-content">
						<?php get_template_part( 'content', 'none' ); ?>
					</div><!-- #content -->
				</div><!-- #primary -->
			</section>
		<?php endif; ?>
	<?php get_sidebar(); ?>
</div><!-- #content -->
<?php get_footer(); ?>
