<?php
/*
Template Name: Contact Us
*/
get_header();
?>

<div class="contact">
	<div class="container">
		<div class="title-page">
			<h1><?php the_title(); ?></h1>
			<?php get_template_part('includes/get', 'breadcrumbs'); ?>
		</div>

		<div class="row">
			<div class="col-sm-12 col-md-6 col-lg-6">
				<div class="contact__inner">
					<h2><?php echo get_field('contact_side_block_heading', pll_get_post(2)); ?></h2>
					<p><?php echo get_field('contact_side_address', pll_get_post(2)); ?></p>
					<?php $icons = get_field('contact_repeater', pll_get_post(2)); ?>
					<div class="footer__item">
						<ul class="footer__contact">
							<?php foreach($icons as $icon) : ?>
							<li><a href="tel:+37167358235"><img src="<?php echo $icon['icon']['url']; ?>" alt=""><?php echo $icon['input']; ?></a> </li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-md-6 col-lg-6">
				<?php get_template_part('includes/contact', 'form'); ?>
			</div>
		</div>
	</div>
</div>
<div class="map map_contact"><div id="map"></div></div>
<?php get_template_part('includes/section', 'partners'); ?>


<?php get_footer(); ?>
