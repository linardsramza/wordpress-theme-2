<div class="map__inner">
	<div class="map__form">
		<span class="map__title"><?php echo pll__('Droši sazinies ar mums'); ?></span>
		<form id="contact-form" method="POST" action="<?php echo admin_url('admin-ajax.php'); ?>">
			<input type="text" id="person" name="person" placeholder="Vārds, uzvārds">
			<input type="email" id="email" name="email" placeholder="E - pasts vai tālruņa numurs">
			<textarea id="message" name="message" placeholder="Jūsu info"></textarea>
			<button type="submit" class="button button_primary button_primary_br"><img src="svg/send.svg" alt=""> Sūtīt</button>
			<input type="hidden" name="action" value="send_form">
		</form>
	</div>
</div>