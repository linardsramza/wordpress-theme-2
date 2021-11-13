<!DOCTYPE html>
<html lang="en">
	<head>
        <title></title>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <base href="<?=get_template_directory_uri()?>/" >
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.6/dist/jquery.fancybox.min.css" />
		<link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.49.0/mapbox-gl.css' rel='stylesheet' />

        <?php wp_head(); ?>
		<!-- <link rel="stylesheet" href="css/slick.min.css"> -->
        <link rel="stylesheet" href="css/style.css">
	</head>
	
	<body>

		<div class="wrapper">
        <div class="send" style="display:none">
				<div class="container">
					<div class="send__inner">
						<div class="send__holder">
							<h2><?php echo pll__('Paldies, Jūsu ziņa ir nosūtīta!'); ?></h2>
							<p><?php echo pll__('Ar Jums sazināsies tuvākā laikā, kads no mūsu darbiniekiem.'); ?></p>
							<a href="#" class="button button_primary button_primary_br" id="close_form"><?php echo pll__('Aizvērt'); ?></a>
						</div>
					</div>
				</div>
			</div>
			<header class="header">
				<div class="container">
					<nav class="navbar navbar-expand-lg">
						<a class="navbar-brand" href="<?php echo pll_home_url(); ?>"><img src="<?php echo get_field('logo', pll_get_post(10))['url']; ?>" alt="" class="img-fluid"></a>
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
							<img src="svg/menu.svg" class="close-i">
							<img src="svg/close.svg" class="open-i">
						</button>
						<div class="collapse navbar-collapse" id="navbarTogglerDemo01">
							<ul class="navbar-nav">
                            <?php
                            wp_nav_menu([
                                'menu'            => 'sub-menu',
                                'theme_location'  => 'sub-menu',
                                'container'       => 'div',
                                'container_id'    => 'bs4navbar',
                                'container_class' => 'collapse navbar-collapse',
                                'menu_id'         => false,
                                'menu_class'      => 'navbar-nav mr-auto',
                                'depth'           => 2,
                                'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
								'walker'          => new WP_Bootstrap_Navwalker(),
								'items_wrap' => '<ul id="%1$s" class="%2$s" data-in="fadeInDown" data-out="fadeOutUp">%3$s</ul>'
                            ]);
                            ?>
                            </ul>
                            <?php
                            wp_nav_menu([
                                'menu'            => 'top-menu',
                                'theme_location'  => 'top-menu',
                                'container'       => 'div',
                                'container_id'    => 'bs4navbar',
                                'container_class' => 'collapse navbar-collapse',
                                'menu_id'         => false,
                                'menu_class'      => 'navbar-nav mr-auto',
                                'depth'           => 2,
                                'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
                                'walker'          => new WP_Bootstrap_Navwalker()
                            ]);
                            ?>
                        </div>
                        <ul class="navbar-lang">
                        <?php 
                        $translations = pll_the_languages(array('raw'=>1));
                        foreach($translations AS $langs) :?>

                            <li class="<?php echo pll_current_language()==$langs['slug']?'active':''?>" ><a href="<?=$langs['url']?>"><?php echo strtoupper($langs['slug']); ?></a></li>

                        <?php endforeach; ?>

							</ul>
					</nav>
				</div>
			</header>