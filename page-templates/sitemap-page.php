<?php
/**
 * Template Name: Sitemap Page
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
<section class="full">
<div id="content">
	<div class="container" role="main">
			<div class="entry-content">
			<div class="half">
				<h2 id="pages">Pages</h2>
				<ul>
					<?php
					wp_list_pages(
  					array(
    				'exclude' => '38,177,1093,2622,4200',
    				'title_li' => '',
  					)
					);
					?>
				</ul>
			</div>
			<div class="half last">
				<h2 id="posts">Posts</h2>
				<ul>
				<?php
				// Add categories you'd like to exclude in the exclude here
				$cats = get_categories('exclude=');
				foreach ($cats as $cat) {
						echo "<h3>".$cat->cat_name."</h3>";
						echo "<ul>";
						$the_query = new WP_Query('posts_per_page=-1&cat='.$cat->cat_ID);
						if ( $the_query->have_posts() ) {
								while ( $the_query->have_posts() ) {
									$the_query->the_post();
								$category = get_the_category();
								// Only display a post link once, even if it's in multiple categories
								if ($category[0]->cat_ID == $cat->cat_ID) {
										echo '<li><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
									}
								}
							echo "</ul>";
						}
						wp_reset_postdata();
					}
				?>
				</ul>
			</div>
			<div class="clearboth"></div>
			<h2><a href="/sitemap_index.xml">XML Sitemap</a></h2>
			</div>
		</div><!-- #content -->
	</div><!-- #primary -->
</div><!-- #wrapper -->
</section>
<?php get_footer(); ?>
