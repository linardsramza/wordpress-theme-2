<?php
/*
Template Name: Partners
*/
?>
<div class="partners">
    <div class="container">
        <div class="partners__inner js-partners-slider">
            <?php $partners = get_field('partners_repeater', pll_get_post(10)); ?>
            <?php foreach($partners[0]['partners_icons'] as $partner) : ?>
                <div class="partners__item"><img src="<?php echo $partner['url']; ?>" alt="" class="img-fluid"></div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<div class="info">
    <div class="container">
        <div class="info__inner">
            <img src="<?php echo get_field('icon', pll_get_post(10))['url']; ?>" alt="" class="img-fluid">
            <p><?php echo get_field('info_description', pll_get_post(10)); ?></p>
        </div>
    </div>
</div>