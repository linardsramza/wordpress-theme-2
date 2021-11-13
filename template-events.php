<?php
/*
Template Name: News
*/
get_header();
?>

<div class="title-page">
	<div class="container">
		<div class="title-page__inner">
			<h1><?php echo get_the_title(pll_get_post(14)); ?></h1>
			<?php get_template_part('includes/get', 'breadcrumbs'); ?>
		</div>
	</div>
</div>
<div class="news news_page">
	<div class="container">
		<div class="row">
			<?php 
			$events = get_posts ( array (
				'posts_per_page' => -1,
				'post_type' => 'events',
				'order' => 'desc',
				'orderby' => 'date',
				'lang' => pll_current_language(),
			));  

			?>
			<?php foreach($events as $event) : ?>
			<div class="col-sm-12 col-md-12 col-lg-12">
				<a href="<?php echo get_permalink(get_post($event->ID)); ?>" class="news__item">
					<?php if(has_post_thumbnail($event->ID)) : ?>
					<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $event->ID ), 'full' ); ?>
					<span class="news__img" style="background-image: url('<?php echo $image[0]; ?>');"></span>
					<?php else : ?>
					<span class="news__img" style="background-image: url('images/news1.jpg');"></span>
					<?php endif; ?>
					<!-- <span class="news__img" style="background-image: url('images/news1.jpg');"></span> -->
					<span class="news__arrow"><span class="news__arrow-inner"><svg><use xlink:href="#arrow"></use></svg></span></span>
					<span class="news__title"><?php echo $event->post_title; ?></span>
					<p><?php echo $event->post_excerpt; ?></p>
				</a>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>
<div class="partners">
	<div class="container">
		<div class="partners__inner js-partners-slider">
			<div class="partners__item"><img src="images/partners1.png" alt="" class="img-fluid"></div>
			<div class="partners__item"><img src="images/partners2.png" alt="" class="img-fluid"></div>
			<div class="partners__item"><img src="images/partners3.png" alt="" class="img-fluid"></div>
			<div class="partners__item"><img src="images/partners4.png" alt="" class="img-fluid"></div>
		</div>
	</div>
</div>
<div class="info">
	<div class="container">
		<div class="info__inner">
			<img src="images/info.png" alt="" class="img-fluid">
			<p>Šis projekts tika finansēts ar Eiropas Komisijas atbalstu. Šī publikācija [paziņojums] atspoguļo vienīgi autora uzskatus, un Komisijai nevar uzlikt atbildību par tajā ietvertās informācijas jebkuru iespējamo izlietojumu.</p>
		</div>
	</div>
</div>


<?php get_footer(); ?>