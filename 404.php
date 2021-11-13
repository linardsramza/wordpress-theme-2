<?php get_header(); ?>

<main class="container mt-5">
  <div class="row">
    <div class="col-sm">
		<div id="content" role="main">
			<div class="alert text-center">
				<h1>
					<i class="fas fa-exclamation-triangle"></i> <?php _e('Error', 'b4st'); ?> 404
				</h1>
				<p class="mt-4"><?php _e('Sorry, we can&rsquo;t find what you were looking for.', 'b4st'); ?></p>
				<a class="btn btn-primary" href="<?php echo  home_url(); ?>"><i class="fas fa-angle-left mr-2"></i>Back To Homepage</a>
			</div>
		</div>
    </div>
  </div>
</main>

<?php get_footer(); ?>