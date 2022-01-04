<?php
/**
 * Template Name: Holding Page
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Aurora
 * @since Aurora 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?> class="no-js">
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/images/favicon-32x32.png" sizes="32x32" />
<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/images/favicon-16x16.png" sizes="16x16" />
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php wp_head(); ?>
<?php if ( is_user_logged_in() ) { ?>

<?php } else { ?>

<?php } ?>
</head>
<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<div id="main">
		<div class="container">
			<div class="half">
				<div id="content" role="main">
					<?php
						$image = get_field('logo');
						if($image): ?>
						<div class="textalign-center">
							<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
						</div><!-- #secondary -->
					<?php endif; ?>
					<?php while ( have_posts() ) : the_post(); ?>
						<?php the_content(); ?>
					<?php endwhile; // end of the loop. ?>
				</div><!-- #content -->
			</div><!-- #primary -->
			<?php if(get_field('form')) : ?>
				<div class="half last" role="complementary">
					<?php the_field('form'); ?>
				</div><!-- #secondary -->
				<div class="clearboth"></div>
			<?php endif; ?>
		</div>
	<?php wp_footer(); ?>
	</div><!-- #main .wrapper -->
</div><!-- #page -->
</body>
</html>
