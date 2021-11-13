<?php
if( $post->post_parent !== 0 ) {
    get_template_part('includes/content', 'child');
} else {
    get_template_part('includes/content');
}
?>