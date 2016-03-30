<?php
/**
 * Displays the user interface for the Ilc Manager meta box.
 *
 * This is a partial template that is included by the Ilc Manager
 * Admin class that is used to display all of the information that is related
 * to the page meta data for the given page.
 */
?>
<div id="mb-agencias-id">

	<?php $values = get_post_custom(get_the_ID()); ?>

	<?php
        $latitud = isset($values['mb_latitud']) ? esc_attr($values['mb_latitud'][0]) : '';
        $longitud = isset($values['mb_longitud']) ? esc_attr($values['mb_longitud'][0]) : '';
        $address = isset($values['mb_address']) ? esc_attr($values['mb_address'][0]) : '';
        $phone = isset($values['mb_phone']) ? esc_attr($values['mb_phone'][0]) : '';
        $horario1 = isset($values['mb_horario1']) ? esc_attr($values['mb_horario1'][0]) : '';
        $horario2 = isset($values['mb_horario2']) ? esc_attr($values['mb_horario2'][0]) : '';
        $horario3 = isset($values['mb_horario3']) ? esc_attr($values['mb_horario3'][0]) : '';
        $images = isset($values['mb_images']) ? $values['mb_images'][0] : '';

        $totalImages = 4;
        $count = 0;
        wp_nonce_field('my_meta_box_nonce', 'meta_box_nonce');
    ?>

	<fieldset>
		<legend>Google Map</legend>

		<p class="content-mb">
			<label for="mb_address">Dirección: </label>
			<input type="text" name="mb_address" id="mb_address" value="<?php echo $address; ?>" />
		</p>

		<p class="content-mb">
			<label for="mb_phone">Prendafono: </label>
			<input type="text" name="mb_phone" id="mb_phone" value="<?php echo $phone; ?>" />
		</p>

		<p class="content-mb">
			<label for="mb_latitud">Latitud: </label>
			<input type="text" name="mb_latitud" id="mb_latitud" value="<?php echo $latitud; ?>" />
		</p>

		<p class="content-mb">
			<label for="mb_longitud">Longitud: </label>
			<input type="text" name="mb_longitud" id="mb_longitud" value="<?php echo $longitud; ?>" />
		</p>

	</fieldset>

	<fieldset>
		<legend>Horarios</legend>

		<p class="content-mb">
			<label for="mb_horario1">Lunes a Viernes: </label>
			<input type="text" name="mb_horario1" id="mb_horario1" value="<?php echo $horario1; ?>" />
		</p>

		<p class="content-mb">
			<label for="mb_horario2">Sábados: </label>
			<input type="text" name="mb_horario2" id="mb_horario2" value="<?php echo $horario2; ?>" />
		</p>

		<p class="content-mb">
			<label for="mb_horario3">Domingos y Feriados: </label>
			<input type="text" name="mb_horario3" id="mb_horario3" value="<?php echo $horario3; ?>" />
		</p>

	</fieldset>

	<fieldset class="GroupForm">
		<legend class="GroupForm-legend">Imágenes del Asociado</legend>

		<?php
            if (!empty($images)) :
                $images = unserialize($images);
                $count = count($images);

                foreach ($images as $img) :
        ?>

				<div class="container-upload-file GroupForm-wrapperImage">
					<p class="btn-add-file">
						<a title="Set Slider Image" href="javascript:;" class="set-file button button-primary">Añadir</a>
					</p>

					<div class="hidden media-container">
						<img src="<?php echo $img; ?>" alt="<?php //echo get_post_meta( $post->ID, 'slider-1-alt', true ); ?>" title="<?php //echo get_post_meta( $post->ID, 'slider-1-title', true ); ?>" />
					</div><!-- .media-container -->

					<p class="hidden">
						<a title="Qutar imagen" href="javascript:;" class="remove-file button button-secondary">Quitar</a>
					</p>

					<p class="media-info">
						<input class="hd-src" type="hidden" name="mb_images[]" value="<?php echo $img; ?>" />
					</p><!-- .media-info -->
				</div><!-- end container-upload-file -->

			<?php endforeach; ?>

		<?php endif; ?>

		<?php if ($count < $totalImages) : ?>

			<?php for ($i = 0; $i < ($totalImages - $count); ++$i) : ?>

				<div class="container-upload-file GroupForm-wrapperImage">
					<p class="btn-add-file">
						<a title="Set Slider Image" href="javascript:;" class="set-file button button-primary">Añadir</a>
					</p>

					<div class="hidden media-container">
						<img src="" />
					</div><!-- .media-container -->

					<p class="hidden">
						<a title="Remove Footer Image" href="javascript:;" class="remove-file button button-secondary">Quitar</a>
					</p>

					<p class="media-info">
						<input class="hd-src" type="hidden" name="mb_images[]" value="" />
					</p><!-- .media-info -->
				</div><!-- end container-upload-file -->

			<?php endfor; ?>

		<?php endif; ?>
	</fieldset><!-- end GroupFrm -->

</div><!-- #single-post-meta-manager -->