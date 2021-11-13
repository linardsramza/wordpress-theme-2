<?php get_header(); ?>
	<div class="title-page">
		<div class="container">
			<div class="title-page__inner">
				<h1><?php the_title(); ?></h1>
				<?php get_template_part('includes/get', 'breadcrumbs'); ?>
			</div>
			<?php get_template_part('includes/section', 'blank'); ?>
		</div>
	</div>
<?php get_footer(); ?>