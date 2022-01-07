<?php
/**
 * Template Name: Front Page Template
 *
 * @package WordPress
 * @subpackage Aurora
 * @since Aurora 1.0
 */

get_header(); ?>
<div id="primary">
	<div id="content" role="main">
		<section class="slideshow">
    	<div class="bxslider">
				<?php
					$my_secondary_loop = new WP_Query('post_type=slides');
						if( $my_secondary_loop->have_posts() ):
								while( $my_secondary_loop->have_posts() ): $my_secondary_loop->the_post();
									$feat_image = wp_get_attachment_image_src( $attachment_id = get_post_thumbnail_id($post->ID),$size = 'homepage-slider' );
										?>
										<div class="slide-list">
											<div class="slide skip-lazy" style="background-image: url(<?php echo $feat_image[0]; ?>);" ></div>
											<div class="slideshow-overlay">
												<div class="slider-content">
													<div class="inner">
														<h2><?php echo the_title();?></h2>
														<?php echo the_content();?>
													</div>
												</div>
											</div>
										</div>
									<?php endwhile; ?>
								<?php endif; wp_reset_postdata(); ?>
  					</div>
		</section>
		<div id="welcome">
				<div class="container">
					<div class="half">
						<h1 class="home-title"><?php the_field('welcome_header'); ?></h1>
						<?php the_field('welcome_text'); ?>
					</div>
					<div class="one_third last">
						<div class="form-header">
							<?php the_field('welcome_form_header'); ?>
						</div>
						<div class="form-body">
							<?php the_field('welcome_form'); ?>
						</div>
					</div>
				</div>
				<div class="clearboth"></div>
			</div>
		<div id="appointments">
			<div class="container">
				<div class="half">
					<?php
						$image = get_field('emergency_image');
						if( !empty( $image ) ): ?>
    					<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
						<?php endif; ?>
				</div>
				<div class="half last">
					<?php the_field('image_text'); ?>
					<h3 class="phone orange"><a href="tel:<?php the_field('phone', 'option'); ?>"><?php the_field('phone', 'option'); ?></a></h3>
				</div>
			</div>
			<div class="clearboth"></div>
		</div>
		<div id="offers">
			<div class="container">
				<div class="half">
					<?php
						$offerimage = get_field('family_image');
						if( !empty( $offerimage ) ): ?>
    					<img src="<?php echo esc_url($offerimage['url']); ?>" alt="<?php echo esc_attr($offerimage['alt']); ?>" />
						<?php endif; ?>
						<?php the_field('family_text'); ?>
				</div>
				<div class="half last" style="background-image: url(<?php the_field('offers_image'); ?>)">
					<div class="offer-section">
						<h2 class="white-text">Special Offers</h2>
						<?php if(have_rows('offers')) : while(have_rows('offers')) : the_row(); ?>
							<div class="offer">
								<img src="/wp-content/themes/Aurora-master/images/notification-icon.png" alt="Notification" width="24" height="35" />
								<p><a href="<?php the_field('offer_link'); ?>"><?php the_sub_field('offer'); ?></a></p>
							</div>
						<?php endwhile; endif; ?>
					</div>
				</div>
			</div>
			<div class="clearboth"></div>
		</div>
	<?php
	if(have_rows('reviews', 'option')) : 
		$count = count(get_field('reviews', 'option')); ?>
		<section id="testimonials"<?php if($count == 1){ echo ' class="one-group"';} ?>>
			<div class="container textalign-center">
				<h2><?php the_field('testimonial_title'); ?></h2>
				<p class="testimonial-subtitle">Testimonials</p>
				<div class="reviews">
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
		</section>
		<?php endif; ?>
		<section id="insurance" class="textalign-center">
				<div class="container">
					<h2><?php the_field('insurance_title'); ?></h2>
					<div class="insurance-container">
						<?php $i = 0;
							if(have_rows('insurance')) : while(have_rows('insurance')) : the_row();
							$i++; ?>
							<?php if($i % 5 ==0){ echo '<div class="one_fifth last">'; } else { echo '<div class="one_fifth">'; }?>
								<img src="<?php the_sub_field('insurance_image'); ?>" alt="<?php the_sub_field('insurance_agency'); ?>" />
							</div>
						<?php endwhile; endif; ?>
					</div>
					<a class="learn-more" href="<?php the_field('insurance_link'); ?>"><?php the_field('insurance_link_text'); ?></a>
				</div>
		</section>
		<section id="contact" class="textalign-center">
				<div class="container">
					<h2><?php the_field('contact_title'); ?></h2>
					<p class="contact-subtitle"><?php the_field('contact_subtitle'); ?></p>
					<div class="contact-container">
					<div class="one_fourth">
						<div class="phone">
		          <p><a href="tel:<?php the_field('phone', 'option'); ?>"><?php the_field('phone', 'option'); ?></a></p>
		        </div>
		      </div>
					<div class="one_fourth">
						<div class="hours">
		          <p><?php the_field('hours', 'option'); ?></p>
		        </div>
					</div>
					<div class="one_fourth">
						<div class="address">
		          <p><a href="<?php the_field('address_link', 'option'); ?>"><?php the_field('address', 'option'); ?></a></p>
		        </div>
					</div>
					<div class="one_fourth last">
						<div class="email">
		          <p><a href="mailto:<?php the_field('email', 'option'); ?>"><?php the_field('email', 'option'); ?></a></p>
		        </div>
					</div>
				</div>
			</div>
		</section>
		<section id="map" style="background-image: url(<?php the_field('map'); ?>);">
		</section>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>
