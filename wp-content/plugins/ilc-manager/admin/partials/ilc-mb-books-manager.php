<?php
/**
 * Displays the user interface for the Ilc Manager meta box.
 *
 * This is a partial template that is included by the Ilc Manager
 * Admin class that is used to display all of the information that is related
 * to the page meta data for the given page.
 */
?>
<div id="mb-books-id">

	<?php $values = get_post_custom(get_the_ID()); ?>

	<?php
        $name = isset($values['mb_name']) ? esc_attr($values['mb_name'][0]) : '';
        $email = isset($values['mb_email']) ? esc_attr($values['mb_email'][0]) : '';
        $address = isset($values['mb_address']) ? esc_attr($values['mb_address'][0]) : '';
        $city = isset($values['mb_city']) ? esc_attr($values['mb_city'][0]) : '';
        $dni = isset($values['mb_dni']) ? esc_attr($values['mb_dni'][0]) : '';
        $phone = isset($values['mb_phone']) ? esc_attr($values['mb_phone'][0]) : '';
        $cel = isset($values['mb_cel']) ? esc_attr($values['mb_cel'][0]) : '';
        $tutor = isset($values['mb_tutor']) ? esc_attr($values['mb_tutor'][0]) : '';
        $dni_tutor = isset($values['mb_dni_tutor']) ? esc_attr($values['mb_dni_tutor'][0]) : '';
        $response = isset($values['mb_response']) ? esc_attr($values['mb_response'][0]) : '';
        $service = isset($values['mb_service']) ? esc_attr($values['mb_service'][0]) : '';
        $contrato = isset($values['mb_contrato']) ? esc_attr($values['mb_contrato'][0]) : '';
        $monto = isset($values['mb_monto']) ? esc_attr($values['mb_monto'][0]) : '';
        $asunto = isset($values['mb_asunto']) ? esc_attr($values['mb_asunto'][0]) : '';
        $obs = isset($values['mb_obs']) ? esc_attr($values['mb_obs'][0]) : '';
        $detail = isset($values['mb_detail']) ? esc_attr($values['mb_detail'][0]) : '';
        $order = isset($values['mb_order']) ? $values['mb_order'][0] : '';
        $date_response = isset($values['mb_date_response']) ? esc_attr($values['mb_date_response'][0]) : '';

        wp_nonce_field('my_meta_box_nonce', 'meta_box_nonce');

        // Obtener nombre de Ciudad o Departamento
        if (!empty($city)) {
            $city = (int) $city;
            $cityData = get_category($city);

            if (!is_null($cityData)) {
                $cityName = $cityData->name;
            }
        }
    ?>

	<fieldset>
		<legend>Identificaci&oacute;n del Cliente</legend>

		<p class="content-mb">
			<label for="mb_name">Nombre completo:</label>
			<input type="text" name="mb_name" id="mb_name" value="<?php echo $name; ?>" />
		</p>

		<p class="content-mb">
			<label for="mb_email">Email:</label>
			<input type="email" name="mb_email" id="mb_email" value="<?php echo $email; ?>" />
		</p>

		<p class="content-mb">
			<label for="mb_address">Dirección:</label>
			<input type="text" name="mb_address" id="mb_address" value="<?php echo $address; ?>" />
		</p>

		<p class="content-mb">
			<label for="mb_city">Ciudad o Departamento:</label>
			<input type="text" name="mb_city" id="mb_city" value="<?php echo $cityName; ?>" />
		</p>

		<p class="content-mb">
			<label for="mb_dni">DNI o CE:</label>
			<input type="text" name="mb_dni" id="mb_dni" value="<?php echo $dni; ?>" />
		</p>

		<p class="content-mb">
			<label for="mb_phone">Teléfono:</label>
			<input type="text" name="mb_phone" id="mb_phone" value="<?php echo $phone; ?>" />
		</p>

		<p class="content-mb">
			<label for="mb_cel">Celular:</label>
			<input type="text" name="mb_cel" id="mb_cel" value="<?php echo $cel; ?>" />
		</p>

		<p class="content-mb">
			<label for="mb_tutor">Tutor o apoderado:</label>
			<input type="text" name="mb_tutor" id="mb_tutor" value="<?php echo $tutor; ?>" />
		</p>

		<p class="content-mb">
			<label for="mb_dni_tutor">DN o CE Tutor o apoderado:</label>
			<input type="text" name="mb_dni_tutor" id="mb_dni_tutor" value="<?php echo $dni_tutor; ?>" />
		</p>

		<p class="content-mb">
		    <label for="mb_response">M&eacute;todo de respuesta</label>
		    <select name="mb_response" id="mb_response">
				<option value="1" <?php selected($response, '1'); ?>>En domicilio</option>
				<option value="2" <?php selected($response, '2'); ?>>Correo electr&oacute;nico</option>
		    </select>
		 </p>
	</fieldset>

	<fieldset>
		<legend>Identificaci&oacute;n del Producto o Servicio Contratado</legend>

		<p class="content-mb">
		    <label for="mb_service">Producto o servicio contratado</label>
		    <select name="mb_service" id="mb_service">
				<option value="1" <?php selected($service, '1'); ?>>Cr&eacute;dito con garant&iacute;a de Joyas</option>
				<option value="2" <?php selected($service, '2'); ?>>Cr&eacute;dito con garant&iacute;a de Artículos</option>
				<option value="3" <?php selected($service, '3'); ?>>Cr&eacute;dito con garant&iacute;a Vehicular</option>
		    </select>
		 </p>

		<p class="content-mb">
			<label for="mb_contrato">&#8470; de contrato:</label>
			<input type="text" name="mb_contrato" id="mb_contrato" value="<?php echo $contrato; ?>" />
		</p>

		<p class="content-mb">
			<label for="mb_monto">Monto reclamado:</label>
			<input type="text" name="mb_monto" id="mb_monto" value="<?php echo $monto; ?>" />
		</p>
	</fieldset>

	<fieldset>
		<legend>Detalles del Asunto</legend>
		<p class="content-mb">
			<input type="radio" name="mb_asunto" id="mb_asunto_1" <?php checked($asunto, '1') ?> />
			<label for="mb_asunto_1">Reclamo</label>

			<input type="radio" name="mb_asunto" id="mb_asunto_2" <?php checked($asunto, '2') ?> />
			<label for="mb_asunto_2">Pedido</label>

			<input type="radio" name="mb_asunto" id="mb_asunto_3" <?php checked($asunto, '3') ?> />
			<label for="mb_asunto_3">Consulta</label>
		</p>

		<p class="content-mb">
			<label for="mb_date_due">Fecha de respuesta:</label>
		    <input type="date" name="mb_date_response" id="mb_date_response" value="<?php echo $date_response; ?>" />
		</p>

		<p class="content-mb">
			<label class="frm__label--nbg" for="mb_obs">Observaciones</label>
			<textarea name="mb_obs" id="mb_obs"><?php echo $obs; ?></textarea>
		</p>

		<p class="content-mb">
			<label class="frm__label--nbg" for="mb_detail">Detalle</label>
			<textarea name="mb_detail" id="mb_detail"><?php echo $detail; ?></textarea>
		</p>

		<p class="content-mb">
			<label class="frm__label--nbg" for="mb_order">Pedido</label>
			<textarea name="mb_order" id="mb_order"><?php echo $order; ?></textarea>
		</p>
	</fieldset>

	<p class="text-right">
	    <button name="mb_pdf" id="js-pdf" class="button button-primary button-large" data-id="<?php echo get_the_ID(); ?>" data-nonce="<?php echo wp_create_nonce('ajax-pdf-nonce'); ?>">Generar PDF</button>
	</p>



</div><!-- #single-post-meta-manager -->