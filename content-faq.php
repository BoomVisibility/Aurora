<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Aurora
 * @since Aurora 1.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( is_single() ) : // Show full content for Single page ?>
		<div class="entry-content">
			<?php the_content(); ?>
		</div><!-- .entry-content -->
	<?php else : ?>
		<div class="entry-summary">
			<div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
				<h2 itemprop="name"><?php the_title();?></h2>
				<div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
      		<div itemprop="text">
						<?php the_content(); ?>
					</div>
				</div>
		</div><!-- .entry-summary -->
	<?php endif; ?>
</article><!-- #post -->
