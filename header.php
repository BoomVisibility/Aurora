<?php
/**
 * The Header for our theme.
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
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;900&family=Montserrat:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600;1,700&display=swap" rel="stylesheet">
<?php if(is_front_page()) { ?>
  <?php
  $my_secondary_loop = new WP_Query('post_type=slides&posts_per_page=1');;
  if( $my_secondary_loop->have_posts() ):
      while( $my_secondary_loop->have_posts() ): $my_secondary_loop->the_post();
      $feat_image = wp_get_attachment_image_src( $attachment_id = get_post_thumbnail_id($post->ID),$size = 'homepage-slider' );
      ?>
      <link rel="preload" as="image" href="<?php echo $feat_image[0];  ?>" />
    <?php endwhile; endif; ?>
<?php } else { ?>
  <?php if(get_the_post_thumbnail()) :
    $feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID)); ?>
    <link rel="preload" as="image" href="<?php echo $feat_image; ?>" />
  <?php else : ?>
    <link rel="preload" as="image" href="<?php echo get_template_directory_uri(); ?>/images/smiling-at-dentist.jpg.webp" />
  <?php endif; ?>
<?php } ?>
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php wp_head(); ?>
<?php if ( is_user_logged_in() ) { ?>
<!--the analytics code is hidden because you are logged in-->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'xx', 'auto');
  ga('send', 'pageview');
</script>

<?php } else { ?>

<?php } ?>
</head>
<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<header id="sitehead" class="global larger">
    <div class="top-bar desktop-info">
      <div class="mobile-menu"></div>
      <div class="container">
        <div class="phone">
          <p><a href="tel:<?php the_field('phone', 'option'); ?>"><?php the_field('phone', 'option'); ?></a></p>
        </div>
        <div class="hours">
          <p><?php the_field('hours', 'option'); ?></p>
        </div>
        <div class="address">
          <p><a href="<?php the_field('address_link', 'option'); ?>"><?php the_field('address', 'option'); ?></a></p>
        </div>
      </div>
    </div>
		<div class="container">
			<div id="masthead">
				<div class="logo">
					<a href="<? echo site_url(); ?>"></a>
				</div>
			</div> <!-- #masthead -->
      <div class="navigation-container" role="navigation">
				<nav id="site-navigation" class="navigation-primary" role="navigation">
					<ul id="menu-primary-menu" class="nav-menu">
						<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu', 'container' => '', 'items_wrap' => '%3$s' ) ); ?>
					</ul>
				</nav>
			</div>	<!-- .navigation-container -->
		</div> <!-- .container -->
    <div class="top-bar mobile-info">
      <div class="phone">
        <p><a href="tel:<?php the_field('phone', 'option'); ?>"><?php the_field('phone', 'option'); ?></a></p>
      </div>
      <div class="address">
        <p><a href="<?php the_field('address_link', 'option'); ?>"><?php the_field('address', 'option'); ?></a></p>
      </div>
    </div>
	</header>
  <div class="offer-bar">
    <div class="container">
      <div class="offer-cta">
        <p><strong><a href="<?php the_field('link', 'option'); ?>">
          <span><?php the_field('initial_text', 'option'); ?></span><span class="break"></span>
          <span class="amount"><?php the_field('amount', 'option'); ?></span>
          <span><?php the_field('services', 'option'); ?></span></a>
        </strong></p>
      </div>
    </div>
  </div>
	<div id="main">
