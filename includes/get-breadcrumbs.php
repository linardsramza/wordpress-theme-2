<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="<?php echo pll_home_url(); ?>"><?php echo get_the_title(pll_get_post(10))?></a></li>
    <?php
        global $post;
        if ( is_page() && $post->post_parent ) : ?>
        <li class="breadcrumb-item active" aria-current="page"><?php echo the_title(); ?></li>
        
        <?php elseif (is_singular($post_types = 'events')) : ?>
            <li class="breadcrumb-item" aria-current="page"><a href="<?php echo get_permalink(pll_get_post(14)); ?>"><?php echo get_the_title(pll_get_post(14)); ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo the_title(); ?></li>
        <?php else : ?>
            <li class="breadcrumb-item active" aria-current="page"><?php echo the_title(); ?></li>
        <?php endif; ?>
</ol>