<?php
/*
Template Name: Archives
*/
get_header(); ?>
 
<div id="primary" class="site-content">
	<div id="content" role="main">
		<?php while ( have_posts() ) : the_post(); ?>
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<div class="entry-content">
			<?php the_content(); ?>
		</div>
		<?php endwhile; ?>
	</div>
</div>

<?php get_footer(); ?>