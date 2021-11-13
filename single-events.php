<?php get_header(); ?>
<div class="holder">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-3">
				<div class="holder__inner">
					<div class="title-main">
						<h2><?php echo get_the_title(pll_get_post(14)); ?></h2>
					</div>

					<div class="actual">
						<ul>
							<?php 
							$events = get_posts ( array (
								'posts_per_page' => 5,
								'post_type' => 'events',
								'order' => 'desc',
								'orderby' => 'date',
								'lang' => pll_current_language(),
							));   
							?>
							<?php foreach($events as $event) : ?>
							<li><a href="<?php echo get_permalink(pll_get_post($event->ID)); ?>"><?php echo $event->post_title; ?></a></li>
							<?php endforeach; ?>
						</ul>
						<div class="actual__more">
							<a href="<?php echo get_permalink(pll_get_post(14)); ?>" class="button button_link"><?php echo pll__('Visas aktualitātes'); ?> <svg><use xlink:href="#arrow"></use></svg></a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-md-12 col-lg-9">
				<div class="holder__text">
					<div class="title-page">
						<h1><?php echo get_the_title(); ?></h1>
						<?php get_template_part('includes/get', 'breadcrumbs'); ?>
					</div>


					<div class="textpage">
						<?php while(have_rows('content_blocks')){

	the_row();

	$type = get_sub_field('block_type');			

						?>
						<?php if($type == 'big_image'){ ?>
						<?php if(have_rows('big_image_list')){?>
						<?php while(have_rows('big_image_list')){
							the_row();?>
						<img src="<?php echo get_sub_field('big_image')['url']; ?>" alt="" class="textpage__imgbig">
						<p><?php echo get_sub_field('text'); ?></p>
						<?php } ?>
						<?php } ?>
						<?php } elseif($type == 'text') { ?>
						<?php if(have_rows('title_text_list')){?>
						<?php while(have_rows('title_text_list')){
							the_row();?>
						<h2><?php echo get_sub_field('title'); ?></h2>
						<p><?php echo get_sub_field('text'); ?></p>
						<?php } ?>
						<?php } ?>
						<?php } elseif($type == 'quote') { ?>
						<?php if(have_rows('quote_list')){?>
						<?php while(have_rows('quote_list')){
							the_row();?>
						<h2><?php echo get_sub_field('quote_title'); ?></h2>
						<?php echo get_sub_field('quote_content'); ?>
						<p><?php echo get_sub_field('quote_text'); ?></p>
						<?php } ?>
						<?php } ?>
						<?php } elseif($type == 'big_two_images') {?>
						<?php if(have_rows('big_two_image_list')){?>
						<?php while(have_rows('big_two_image_list')){
							the_row();?>
						<div class="row">
							<div class="col-sm-12 col-md-6 col-lg-6">
								<a href="<?php echo get_sub_field('first_image')['url']; ?>" data-fancybox="gallery1" class="textpage__gallery-big">
									<img src="<?php echo get_sub_field('first_image')['url']; ?>" alt="" class="img-fluid">
								</a>
							</div>
							<div class="col-sm-12 col-md-6 col-lg-6">
								<a href="<?php echo get_sub_field('second_image')['url']; ?>" data-fancybox="gallery1" class="textpage__gallery-big">
									<img src="<?php echo get_sub_field('second_image')['url']; ?>" alt="" class="img-fluid">
								</a>
							</div>
						</div>
						<?php } ?>
						<?php } ?>
						<?php } elseif($type == "gallery") { ?>
						<?php if(have_rows('gallery_list')){?>
						<?php while(have_rows('gallery_list')){
							the_row();?>
						<h2><?php echo get_sub_field('gallery_title'); ?></h2>
						<?php $images = get_sub_field('gallery'); ?>
						<?php if($images) : ?>
						<div class="textpage__gallery">
							<?php foreach( $images as $image ): ?>
							<div class="textpage__gallery-item"><a href="<?php echo esc_url($image['url']); ?>" data-fancybox="gallery2"><img src="<?php echo esc_url($image['url']); ?>" alt=""></a></div>
							<?php endforeach; ?>
							<!-- <div class="textpage__gallery-item">
<a href="images/gallery1.jpg" data-fancybox="gallery2">
<img src="images/gallery1.jpg" alt="">

<span class="textpage__gallery-text">
<img src="svg/roud.svg" alt="">
<span>Saktīt galeriju</span>
</span>
</a>
</div> -->
						</div>
						<?php endif; ?>
						<?php } ?>
						<?php } ?>
						<?php } elseif($type == 'accordion') { ?>
						<h2><?php echo get_sub_field('accordion_title'); ?></h2>
						<div class="accordion" id="accordionExample">
							<?php $lists = get_sub_field('accordion_list');?>
							<?php $count == 0; foreach($lists as $list) { ?>
							<?php if($count == 0) : ?>
							<div class="card">
								<div class="card-header" id="headingOne">
									<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
										<?php echo $list['card_title']; ?>
										<svg><use xlink:href="#arrow"></use></svg>
									</button>
								</div>

								<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
									<div class="card-body">
										<?php foreach($list['text'] as $body ) { ?>
										<?php echo $body['card_content_text']; ?>
										<?php } ?>
									</div>
								</div>
							</div>
							<?php else : ?>
							<div class="card">
								<div class="card-header" id="headingTwo">
									<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
										<?php echo $list['card_title']; ?>
										<svg><use xlink:href="#arrow"></use></svg>
									</button>
								</div>
								<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
									<div class="card-body">
										<?php foreach($list['text'] as $body ) { ?>
										<?php echo $body['card_content_text']; ?>
										<?php } ?>
									</div>
								</div>
							</div>
							<?php endif; ?>
							<?php ++$count; } ?>
						</div>
						<?php } elseif($type == 'table') { ?>
						<?php if(have_rows('table_list')){?>
						<?php while(have_rows('table_list')){
							the_row();
						?>
						<h2><?php echo get_sub_field('title'); ?></h2>
						<?php 
							if ( ! empty (  get_sub_field( 'table' ) ) ) {

								echo '<div class="table-container">';
								echo '<table>';

								if ( ! empty(  get_sub_field( 'table' )['caption'] ) ) {

									echo '<caption>' .  get_sub_field( 'table' )['caption'] . '</caption>';
								}

								if ( ! empty(  get_sub_field( 'table' )['header'] ) ) {

									echo '<thead>';

									echo '<tr>';

									foreach (  get_sub_field( 'table' )['header'] as $th ) {

										echo '<th class="text-center align-middle">';
										echo $th['c'];
										echo '</th>';
									}

									echo '</tr>';

									echo '</thead>';
								}

								echo '<tbody>';

								foreach (  get_sub_field( 'table' )['body'] as $tr ) {

									echo '<tr>';

									foreach ( $tr as $td ) {

										echo '<td>';
										echo $td['c'];
										echo '</td>';
									}

									echo '</tr>';
								}

								echo '</tbody>';

								echo '</table>';
								echo '</div>';
							}
						?>
						<?php } ?>
						<?php } ?>
						<?php } ?>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<?php get_footer(); ?>