<?php

if( !defined( 'ABSPATH' ) ) exit;

/*
	Template Name: HomePage
*/


// Filters
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );


// Remove actions
remove_action( 'genesis_loop', 'genesis_do_loop' );


// Add actions
// add_action( 'genesis_header', 'nooove_theme_hero' );
add_action( 'genesis_after_header', 'nooovle_theme_after_header' );


// Functions
function nooove_theme_hero() {
	?>
	<?php // hero section ?>
	<section class='hero'>
	<?php
		genesis_structural_wrap('hero', 'open');
		$heroTxt = get_field('hero_text');
		$heroBtn = get_field('hero_button_label');
		$heroImg = get_field('hero_image');
		?>
		<div class="hero__text four-sixths first">
		<h4><?php echo $heroTxt; ?></h4>
		<button class="btn"><?php echo $heroBtn; ?></button>
		</div>
		<div class="hero__image two-sixths">
			<img src="<?php echo $heroImg['url']; ?>" alt="<?php echo $heroImg['alt']; ?>">
		</div>

		<?php
		genesis_structural_wrap( 'after-header', 'close');
	?>
	</section> <!-- end of .hero -->

	<?
}

function nooovle_theme_after_header() {
	?>
	<?php // hero section ?>
	<section class='hero__wrapper'>
	<?php
		genesis_structural_wrap('hero', 'open');
		$heroTxt = get_field('hero_text');
		$heroBtn = get_field('hero_button_label');
		$heroImg = get_field('hero_image');
		?>
		<div class="hero four-sixths first">
			<div class="hero__content">
				<h4 class="hero__text"><?php echo $heroTxt; ?></h4>
				<button class="button"><?php echo $heroBtn; ?></button>
			</div>
		</div>
		<div class="hero__image two-sixths">
			<img src="<?php echo $heroImg['url']; ?>" alt="<?php echo $heroImg['alt']; ?>">
		</div>

		<?php
		genesis_structural_wrap( 'after-header', 'close');
	?>
	</section> <!-- end of .hero -->

	<?php // testimonial 1 ?>
	<section class="testimonial">
	<?php
		genesis_structural_wrap( 'testimonial', 'open' );
		$clientImg = get_field('client_1_image');
		$clientName = get_field('client_1_name');
		$clientCompany = get_field('client_1_company');
		$clientPosition = get_field('client_1_position');
		$clientTestimony = get_field('client_1_testimony');
	?>
		<div class="client">
			<div class="client__content">
				<img class="client__content-img" src="<?php echo $clientImg['url']; ?>" alt="<?php echo $clientImg['alt']; ?>">
				<div class="client__content-info">
					<h4 class="client__info-name"><?php echo $clientName; ?></h4>
					<span><?php echo $clientCompany; ?>,</span>
					<span><?php echo $clientPosition; ?></span>
				</div>
			</div>
			<div class="client__testimony">
				<p><?php echo $clientTestimony; ?></p>
			</div>
		</div>
	<?php
		genesis_structural_wrap( 'testimonial', 'close' );
	?>
	</section> <!-- end of .testimonial -->

	<?php // our works ?>
	<section class="our__works">
	<?php
		genesis_structural_wrap( 'our-works', 'open' );
		if( have_rows('our_works') ) :
		?>
		<h2 class="entry-title">Our Works</h2>
		<ul class="our__works--items">
		<?php
			while( have_rows('our_works') ) : the_row();
			$worksImg = get_sub_field('image');
			?>
				<li class="our__works-item one-half">
					<img src="<?php echo $worksImg['url']; ?>" alt="<?php echo $worksImg['alt']; ?>">
				</li>
			<?php
			endwhile;
		echo '</ul>';
		else :
			echo 'no item to show';
		endif;

		wp_reset_postdata();

		genesis_structural_wrap( 'our-works', 'close' );
	?>

	</section> <!-- end of .our__works -->

	<?php // services ?>
	<section class="services">
	<?php
		genesis_structural_wrap( 'services', 'open' );
		$servicesIntro = get_field('services_intro');
		if( have_rows('services') ) :
	?>
			<h4 class="services__intro"><?php echo $servicesIntro; ?></h4>
			<h4 class="plus-more">Plus More!</h4>
			<ul class="services__items">
		<?php
			while( have_rows('services') ) : the_row();
			$servicesItem = get_sub_field('service');
			$serviceIcon = get_sub_field('icon');
		?>
				<li class="services-item"><i class="fa <?php echo $serviceIcon; ?>"></i> <?php echo $servicesItem; ?></li>
		<?php
			endwhile;

			echo '</ul>';
		else :
			echo 'no item to show';
		endif;

		wp_reset_postdata();

		genesis_structural_wrap( 'services', 'close' );
	?>

	</section> <!-- end of .services -->

	<section class="pricing-table">
	<?php genesis_structural_wrap('pricing-table', 'open'); ?>
		<?php
		if(have_rows('pricing_table') ) :
			?>

			<?php
			while(have_rows('pricing_table') ) : the_row();
			?>
			<div class="included__services one-third">
			<?php
			$price = get_sub_field('price');
				if(have_rows('included') ) :
					?>
					<ul class="included__service-list">
					<?php
					while(have_rows('included') ) : the_row();
					$service = get_sub_field('service');
						?>
						<li class="included__service-name"><?php echo $service; ?></li>
						<?php
					endwhile;
					?>
					</ul>
				<div class="included__service-price">
					<h4>Starts</h4>
					<span>at</span>
					<hr>
					<div class="price"><?php echo $price; ?></div>
				</div>
				<button class="button">Book Now</button>
				<?php
				else :
					echo 'no item to show';
				endif;
			?>
			</div> <!-- end of .included__services -->
			<?php
			endwhile;
		else :
			echo 'no item to show';

		endif;

		wp_reset_postdata();

		?>

	<?php genesis_structural_wrap('pricing-table', 'close'); ?>
	</section> <!-- end of .pricing-table -->

	<?php // our clients ?>
	<section class="our-clients">
	<?php genesis_structural_wrap('our-clients', 'open'); ?>
	<?php
	$logos = get_field('clients');

	if( $logos ) : ?>
	    <ul class="clients__list">
	        <?php foreach( $logos as $logo ): ?>
	            <li class="client-logo"><img src="<?php echo $logo['sizes']['thumbnail']; ?>" alt="<?php echo $logo['alt']; ?>" /></li>
	        <?php endforeach; ?>
	    </ul>
	<?php endif; ?>
	<?php genesis_structural_wrap('our-clients', 'close'); ?>

	</section> <!-- end of .our-clients -->

	<?php // free consulration ?>
	<section class="consultation">
		<?php
		$consultationHeading = get_field('consultation_heading');
		$consultationBtn = get_field('consultation_button');
		?>
		<h4><?php echo $consultationHeading; ?></h4>
		<button class="button"><?php echo $consultationBtn; ?></button>
	</section>

	<?php // testimonial 2 ?>
	<section class="testimonial">
	<?php
		genesis_structural_wrap( 'testimonial', 'open' );
		$clientImg = get_field('client_2_image');
		$clientName = get_field('client_2_name');
		$clientCompany = get_field('client_2_company');
		$clientPosition = get_field('client_2_position');
		$clientTestimony = get_field('client_2_testimony');
	?>
		<div class="client">
			<img class="client__img" src="<?php echo $clientImg['url']; ?>" alt="<?php echo $clientImg['alt']; ?>">
			<div class="client__info">
				<h4 class="client__info-name"><?php echo $clientName; ?></h4>
				<span><?php echo $clientCompany; ?></span>
				<span><?php echo $clientPosition; ?></span>
			</div>
			<div class="client__testimony">
				<p><?php echo $clientTestimony; ?></p>
			</div>
		</div>
	<?php
		genesis_structural_wrap( 'testimonial', 'close' );
	?>
	</section> <!-- end of .testimonial -->

	<section class="blog__posts">
		<?php genesis_structural_wrap('blog', 'open'); ?>
		<?php
			genesis_widget_area( 'blog', array(
				'before' => '<div class="blog__posts-items widget-area">',
				'after' => '</div>'
			));
		?>
		<?php genesis_structural_wrap('blog', 'close'); ?>
	</section>
	<?php
}

genesis();