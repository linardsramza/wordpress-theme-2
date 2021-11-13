<?php 
/* Template name: Home */
if (!defined('ABSPATH')) exit;
get_header();

?>

<div class="banner">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-6">
				<div class="banner__inner">
					<span class="banner__title"><?php echo get_field('banner__title', pll_get_post(10)); ?></span>
					<p><?php echo get_field('banner_description', pll_get_post(10)); ?></p>
					<a href="<?php echo get_field('banner_button_create_cv_link', pll_get_post(10)); ?>" class="button button_primary"><img src="svg/btn1.svg" alt=""> <?php echo get_field('banner_button_create_cv_text', pll_get_post(10)); ?></a>
				</div>
			</div>
			<?php $file = get_field('video', pll_get_post(10)); ?>
			<div class="col-sm-12 col-md-12 col-lg-6">
				<?php if($file) : ?>
				<a data-fancybox href="<?php echo $file['url']; ?>" class="banner__video">
					<span class="banner__video-inner" style="background-image: url('<?php echo get_field('video_image', pll_get_post(10))['url']; ?>')">
						<span class="play"><img src="svg/play.svg" alt=""></span>
						<span class="play__text"><?php echo pll__('Skatīties video'); ?></span>
					</span>
				</a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
<div class="main" style="background-image: url('<?php echo get_field('main_background_image', pll_get_post(10))['url']; ?>');">
	<div class="container">
		<div class="title-main">
			<h2><?php echo get_field('main_title', pll_get_post(10)); ?></h2>
		</div>
		<div class="row">
			<?php $blocks = get_field('main_blocks', pll_get_post(10)); ?>
			<?php foreach($blocks as $id => $block) : ?>
			<div class="col-sm-12 col-md-6 col-lg-6">
				<a href="<?php echo $block['link']; ?>" class="main__item">
					<span class="main__img"><svg><use xlink:href="#icon<?php echo $id+1; ?>"></use></svg></span>
					<div class="main__text">
						<span class="main__title"><?php echo $block['heading']; ?></span>
						<p><?php echo $block['description']; ?></p>
					</div>
				</a>
			</div>
			<?php endforeach; ?>
		</div>
		<div class="main__attention">
			<img src="svg/at.svg" alt="">
			<p><?php echo get_field('attention', pll_get_post(10)); ?></p>
		</div>
	</div>
</div>
<div class="news">
	<div class="container">
		<div class="title-main">
			<h2><?php echo get_the_title(pll_get_post(14)); ?></h2>
			<a href="<?php echo get_permalink(pll_get_post(14)); ?>" class="button button_link">Visas aktualitātes <svg><use xlink:href="#arrow"></use></svg></a>
		</div>
		<div class="row">
			<?php 
			$events = get_posts ( array (
				'posts_per_page' => 3,
				'post_type' => 'events',
				'order' => 'desc',
				'orderby' => 'date',
				'lang' => pll_current_language(),
			));  

			?>
			<?php foreach($events as $event) : ?>
			<div class="col-sm-12 col-md-6 col-lg-4">
				<a href="<?php echo get_permalink($event->ID); ?>" class="news__item">
					<?php if(has_post_thumbnail($event->ID)) : ?>
					<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $event->ID ), 'full' ); ?>
					<span class="news__img" style="background-image: url('<?php echo $image[0]; ?>');"></span>
					<?php endif; ?>
					<span class="news__arrow"><span class="news__arrow-inner"><svg><use xlink:href="#arrow"></use></svg></span></span>
					<span class="news__title"><?php echo $event->post_title; ?></span>
					<p><?php echo $event->post_excerpt; ?></p>
				</a>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>
<div class="map">
	<div id="map"></div>
	<div class="container">
		<?php get_template_part('includes/contact', 'form'); ?>
	</div>
</div>
<?php get_template_part('includes/section', 'partners'); ?>

<?php get_footer(); ?>