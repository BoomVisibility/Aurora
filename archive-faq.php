<?php
/**
 * @package WordPress
 * @subpackage Aurora
 * @since Aurora 1.0
 */
get_header(); ?>
<header class="entry-header" style="background-image: url('<?php the_field('header_image', 'option'); ?>');">
	<div id="content" class="container" role="main">
		<div id="primary" class="site-content">
			<h1>FAQs</h1>
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
		$i =0;
				$query = new WP_Query( array ( 'post_type' => 'faq', 'posts_per_page' => -1, 'post_parent' => 0 ) );
					while ($query->have_posts()){
						$query->the_post();
						$i++; ?>
						<?php if($i == 1) { echo '<section class="full">'; } else { echo '<section class="white">'; } ?>
							<div class="container">
								<div class="full-content entry-content">
									<?php get_template_part( 'content', 'faq' ); ?>
								</div>
							</div>
						</section>
					<?php } ?>
	</div>
<?php get_footer(); ?>
