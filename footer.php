<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-3">
                <div class="footer__item">
                    <span class="footer__title"><?php echo pll__('Ātrās saites'); ?></span>
                    <?php echo wp_nav_menu(array('theme_location' => 'footer-menu-1', 'menu_class' => '', 'container' => false)); ?>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-3">
                <div class="footer__item">
                    <span class="footer__title"><?php echo pll__('Noderīgi'); ?></span>
                    <?php echo wp_nav_menu(array('theme_location' => 'footer-menu-2', 'menu_class' => '', 'container' => false)); ?>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-3">
                <div class="footer__item">
                    <span class="footer__title"><?php echo pll__('Kontakti'); ?></span>
                    <?php $icons = get_field('contact_repeater', pll_get_post(2)); ?>
                    <ul class="footer__contact">
                        <?php foreach($icons as $icon) : ?>
                        <li><a href="<?php echo $icon['input']; ?>"><img src="<?php echo $icon['icon']['url']; ?>" alt=""><?php echo $icon['input']; ?></a> </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-3">
                <div class="footer__item">
                    <span class="footer__title"><?php echo pll__('Sekojiet mums'); ?></span>
                    <ul class="footer__soc">
                        <?php $socials = get_field('social_repeater', pll_get_post(10)); ?>
                        <?php foreach($socials as $social) : ?>
                            <li><a href="<?php echo $social['social_link']['url']; ?>"><img src="<?php echo $social['social_icon']['url']; ?>" alt=""> </a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer__copyright">
            <span>© <?php echo date('Y'); ?> <?php echo get_field('copyright', pll_get_post(10)); ?></span>
            <span><?php echo get_field('create_by', pll_get_post(10)); ?> <a href="#">LP Service</a> </span>
        </div>
    </div>
</footer>
</div>


<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.49.0/mapbox-gl.js'></script>
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.6/dist/jquery.fancybox.min.js"></script>

<?php wp_footer(); ?>
<script>
		$(document).ready(function() { 
            $('#contact-form').ajaxForm({
                beforeSubmit: validate,
				success: function(response){
                },
                resetForm: true
			});
        }); 

        function validate(formData, jqForm, options) { 
            for (var i=0; i < formData.length; i++) { 
                if (!formData[i].value) { 
                    alert('Lūdzu aizpildiet visus laukus'); 
                    return false; 
                } 
            } 
            $('.send').show();
        }
        
        $('#close_form').on('click',function(e){
            e.preventDefault();
            $('.send').hide();
        });

</script>
</body>
</html>