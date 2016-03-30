<?php
	/*
	 *	Template Name: Page Book
	 */

	date_default_timezone_set('America/Lima');

	if ( isset($_POST['post_submit']) && isset($_POST['rec_terminos']) )
	{
		$name = '';
		$email = '';
		$address = '';
		$dni = '';
		$phone = '';
		$city = '';
		$cel = '';
		$response = '';
		$service = '';
		$contrato = '';
		$monto = '';
		$detail = '';
		$order = '';
		$error = TRUE;
		$errorName = TRUE;
		$errorEmail = TRUE;
		$errorAddress = TRUE;
		$errorDni = TRUE;
		$errorPhone = TRUE;
		$errorCity = TRUE;
		$errorResponse = TRUE;
		$errorService = TRUE;
		$errorContrato = TRUE;
		$errorMonto = TRUE;
		$errorDetail = TRUE;
		$errorOrder = TRUE;

		// Full Name
		if ( !empty( $_POST['rec_name'] ) )
		{
			$name = sanitize_text_field( trim( $_POST['rec_name']) );
			$errorName = FALSE;
		}

		// Email
		if ( !empty( $_POST['rec_email'] ) && is_email( $_POST['rec_email'] ) )
		{
			$email = sanitize_text_field( trim( $_POST['rec_email']) );
			$errorEmail = FALSE;
		}

		// Address
		if ( !empty( $_POST['rec_address'] ) )
		{
			$address = sanitize_text_field( trim( $_POST['rec_address']) );
			$errorAddress = FALSE;
		}

		// Dni
		if ( !empty( $_POST['rec_dni'] ) && (strlen( $_POST['rec_dni']) >= 8 || strlen( $_POST['rec_dni'] ) <= 12 ) )
		{
			$dni = sanitize_text_field( trim( $_POST['rec_dni']) );
			$errorDni = FALSE;
		}

		// Phone
		if ( !empty( $_POST['rec_phone'] ) )
		{
			$phone = sanitize_text_field( trim( $_POST['rec_phone']) );
			$errorPhone = FALSE;
		}

		// City
		if ( !empty( $_POST['rec_city'] ) )
		{
			$city = (int) sanitize_text_field( trim( $_POST['rec_city']) );
			$errorCity = FALSE;
		}

		// Celular
		$cel = trim( sanitize_text_field( $_POST['rec_cel'] ) );

		$tutor = trim( sanitize_text_field($_POST['rec_tutor']) );
		$dniTutor = trim( sanitize_text_field($_POST['rec_dni_tutor']) );

		// Respuesta
		if ( !empty( $_POST['rec_response'] ) && $_POST['rec_response'] !== '' )
		{
			$response = sanitize_text_field( trim( $_POST['rec_response']) );
			$errorResponse = FALSE;
		}

		// Servicio
		if ( !empty( $_POST['rec_service'] ) && $_POST['rec_service'] !== '' )
		{
			$service = sanitize_text_field( trim( $_POST['rec_service']) );
			$errorService = FALSE;
		}

		// Contrato
		if ( !empty( $_POST['rec_contrato'] ) )
		{
			$contrato = sanitize_text_field( trim( $_POST['rec_contrato']) );
			$errorContrato = FALSE;
		}

		// Monto
		if ( !empty( $_POST['rec_monto'] ) )
		{
			$monto = sanitize_text_field( trim( $_POST['rec_monto']) );
			$errorMonto = FALSE;
		}

		$asunto = sanitize_text_field( $_POST['rec_asunto'] );

		// Detail
		if ( !empty( $_POST['rec_detail'] ) )
		{
			$detail = sanitize_text_field( trim( $_POST['rec_detail']) );
			$errorDetail = FALSE;
		}

		// Pedido
		if ( !empty( $_POST['rec_order'] ) )
		{
			$order = sanitize_text_field( trim( $_POST['rec_order']) );
			$errorOrder = FALSE;
		}

		if ( !$errorName && !$errorEmail && !$errorAddress && !$errorDni && !$errorPhone && !$errorCity && !$errorResponse && !$errorService && !$errorContrato && !$errorMonto && !$errorDetail && !$errorOrder )
		{
			$post_type   = 'books';
			$correlativo = get_option( 'correlativo_libro' );
			$title = str_pad($correlativo, 9,'0', STR_PAD_LEFT);
			$title .= '-' . date('Y');
			$slug = sanitize_title( $title );

			// Add Libro de reclamacion
			$post_id = wp_insert_post(
				array(
					'post_author' => 1,
					'post_name'   => $slug,
					'post_title'  => $title,
					'post_status' => 'publish',
					'post_type'   => $post_type,
				)
			);

			update_post_meta( $post_id, 'mb_name', esc_attr( $name ) );
			update_post_meta( $post_id, 'mb_email', esc_attr( $email ) );
			update_post_meta( $post_id, 'mb_address', esc_attr( $address ) );
			update_post_meta( $post_id, 'mb_city', esc_attr( $city ) );
			update_post_meta( $post_id, 'mb_dni', esc_attr( $dni ) );
			update_post_meta( $post_id, 'mb_phone', esc_attr( $phone ) );
			update_post_meta( $post_id, 'mb_cel', esc_attr( $cel ) );
			update_post_meta( $post_id, 'mb_tutor', esc_attr( $tutor ) );
			update_post_meta( $post_id, 'mb_dni_tutor', esc_attr( $dniTutor ) );
			update_post_meta( $post_id, 'mb_response', esc_attr( $response ) );
			update_post_meta( $post_id, 'mb_service', esc_attr( $service ) );
			update_post_meta( $post_id, 'mb_contrato', esc_attr( $contrato ) );
			update_post_meta( $post_id, 'mb_monto', esc_attr( $monto ) );
			update_post_meta( $post_id, 'mb_asunto', esc_attr( $asunto ) );
			update_post_meta( $post_id, 'mb_detail', esc_attr( $detail ) );
			update_post_meta( $post_id, 'mb_order', esc_attr( $order ) );

			$error = FALSE;

			// Update correlativo
			$newCorrelativo = (int)$correlativo + 1;
			update_option( 'correlativo_libro', $newCorrelativo );
		}
	}
?>

<?php get_header(); ?>

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

		<figure class="main__page-full__img">
			<?php
				if ( has_post_thumbnail() )
				{
					$attr = array('class' => 'img-responsive');
					the_post_thumbnail('full', $attr);
				}
				else
				{
			?>
			<img class="img-responsive" src="http://lorempixel.com/1920/246" alt="" />
			<?php
				}
			?>
		</figure><!-- end main__page-full__img -->

		<main class="main">
	        <div class="container">
	          	<section class="main__page">

	            	<div class="row">

	              		<div class="col-sm-12">

							<h2 class="main__title main__title--blue main__title--book text-uppercase"><span class="main__title__nopl"><?php the_title(); ?></span></h2>
                			<?php the_content(); ?>

                			<?php echo $error; ?>

							<?php if ( isset( $error ) && $error === FALSE ) : ?>

								<div class="alert alert-success" role="alert">
									<p>GRACIAS, por comunicarse con EDPYME Inversiones La Cruz S.A., estaremos dando respuesta en el breve plazo (máximo a 30 días calendario). De requerir mayor información, nos estaremos comunicando con Usted.</p>
								</div>

							<?php endif; ?>

							<?php if ( isset( $error ) && $error === TRUE ) : ?>

								<div class="alert alert-danger" role="alert">
									<p>No pudimos registrar su reclamo, por favor verifique que ha ingresado todos los datos solicitados correctamen.</p>
								</div>

							<?php endif; ?>

							<?php
								$args = array(
									'parent' => 14,
									// 'parent' => 26,
									'hide_empty' => 0
								);

								$cities = get_categories($args);
							?>

	                		<div class="frm-ilc__web hidden-sm hidden-xs">

		                		<form class="frm-ilc" id="js-frm-reclamo" method="post" action="">

		                			<input type="hidden" name="post_submit" value="true" />

		                			<h4 class="main__page__subtitle">Indentificación del Cliente</h4>

									<div class="main__page__wrapper-input">
										<!-- Name -->
										<div class="form-group">
											<label for="rec_name" class="sr-only"><?php _e('Nombre completo', THEMEDOMAIN); ?></label>
											<input type="text" class="frm-ilc__input form-control" name="rec_name" id="rec_name" placeholder="<?php _e('Nombre completo', THEMEDOMAIN); ?>" />
										</div><!-- end form-group -->

										<!-- Email -->
										<div class="form-group">
											<label for="rec_email" class="sr-only"><?php _e('Correo electrónico', THEMEDOMAIN); ?></label>
											<input type="email" class="frm-ilc__input form-control" name="rec_email" id="rec_email" placeholder="<?php _e('Correo electrónico', THEMEDOMAIN); ?>" />
										</div><!-- end form-group -->
									</div><!-- end main__page__wrapper-input -->

									<div class="main__page__wrapper-input">
										<!-- Address -->
										<div class="form-group">
											<label for="rec_address" class="sr-only"><?php _e('Domicilio', THEMEDOMAIN); ?></label>
											<input type="text" class="frm-ilc__input form-control" name="rec_address" id="rec_address" placeholder="<?php _e('Domicilio', THEMEDOMAIN); ?>" />
										</div><!-- end form-group -->

										<div class="row">
											<div class="col-xs-6">
												<!-- DNI -->
												<div class="form-group form-group--medium">
													<label for="rec_dni" class="sr-only"><?php _e('DNI o CE', THEMEDOMAIN); ?></label>
													<input type="text" class="frm-ilc__input form-control" name="rec_dni" id="rec_dni" placeholder="<?php _e('DNI o CE', THEMEDOMAIN); ?>" />
												</div><!-- end form-group -->
											</div>

											<div class="col-xs-6">
												<!-- Phone -->
												<div class="form-group form-group--medium">
													<label for="rec_phone" class="sr-only"><?php _e('Teléfono', THEMEDOMAIN); ?></label>
													<input type="text" class="frm-ilc__input form-control" name="rec_phone" id="rec_phone" placeholder="<?php _e('Teléfono', THEMEDOMAIN); ?>" />
												</div><!-- end form-group -->
											</div>
										</div>
									</div><!-- end main__page__wrapper-input -->

									<div class="main__page__wrapper-input main__page__wrapper-input--medium">

									<?php if ( count( $cities ) ) : ?>

										<!-- City -->
										<div class="form-group">
											<label for="rec_city" class="sr-only"><?php _e('Ciudad o Departamento', THEMEDOMAIN); ?></label>

											<select class="frm-ilc__input form-control" name="rec_city" id="rec_city">
												<option value=""><?php _e('-- Ciudad o Departamento --', THEMEDOMAIN); ?></option>

											<?php foreach ( $cities as $city ) : ?>
												<option value="<?php echo $city->cat_ID; ?>"><?php echo $city->name; ?></option>
											<?php endforeach; ?>

											</select>

										</div><!-- end form-group -->

									<?php endif; ?>

										<!-- Celular -->
										<div class="form-group">
											<label for="rec_cel" class="sr-only"><?php _e('Celular', THEMEDOMAIN); ?></label>
											<input type="text" class="frm-ilc__input form-control" name="rec_cel" id="rec_cel" placeholder="<?php _e('Celular', THEMEDOMAIN); ?>" />
										</div><!-- end form-group -->
									</div><!-- end main__page__wrapper-input -->

									<div class="main__page__wrapper-input">
										<!-- Tutor -->
										<div class="form-group">
											<label for="rec_tutor" class="sr-only"><?php _e('Padre, Madre o Tutor, en caso seas menor de edad', THEMEDOMAIN); ?></label>
											<input type="text" class="frm-ilc__input form-control" name="rec_tutor" id="rec_tutor" placeholder="<?php _e('Padre, Madre o Tutor, en caso seas menor de edad', THEMEDOMAIN); ?>" />
										</div><!-- end form-group -->
									</div><!-- end main__page__wrapper-input -->

									<div class="main__page__wrapper-input main__page__wrapper-input--medium">
										<!-- DNI Tutor -->
										<div class="form-group">
											<label for="rec_dni_tutor" class="sr-only"><?php _e('DNI o CE', THEMEDOMAIN); ?></label>
											<input type="text" class="frm-ilc__input form-control" name="rec_dni_tutor" id="rec_dni_tutor" placeholder="<?php _e('DNI o CE', THEMEDOMAIN); ?>" />
										</div><!-- end form-group -->
									</div><!-- end main__page__wrapper-input -->

									<div class="main__page__wrapper-input">
										<!-- Respuesta -->
										<div class="form-group">
											<label for="rec_response" class="sr-only"><?php _e('-- Seleccione el método de respuesta --', THEMEDOMAIN); ?></label>
											<select class="frm-ilc__input form-control" name="rec_response" id="rec_response">
												<!-- <option value=""><?php //_e('-- Seleccione el método de respuesta --', THEMEDOMAIN); ?></option> -->
												<!-- <option value="1"><?php //_e('En domicilio', THEMEDOMAIN); ?></option> -->
												<option value="2" selected><?php _e('Correo electr&oacute;nico', THEMEDOMAIN); ?></option>
											</select>
										</div><!-- end form-group -->
									</div><!-- end main__page__wrapper-input -->

		                			<h4 class="main__page__subtitle">Indentificación del Producto o Servicio Contratado</h4>

									<div class="main__page__wrapper-input">
										<!-- Service-->
										<div class="form-group">
											<label for="rec_service" class="sr-only"><?php _e('-- Seleccione el producto o servicio contratado --', THEMEDOMAIN); ?></label>
											<select class="frm-ilc__input form-control" name="rec_service" id="rec_service">
												<option value=""><?php _e('-- Seleccione el producto o servicio contratado --', THEMEDOMAIN); ?></option>
												<option value="1"><?php _e('Cr&eacute;dito con garant&iacute;a de Joyas', THEMEDOMAIN); ?></option>
												<option value="2"><?php _e('Cr&eacute;dito con garant&iacute;a de Artículos', THEMEDOMAIN); ?></option>
												<option value="3"><?php _e('Cr&eacute;dito con garant&iacute;a Vehicular', THEMEDOMAIN); ?></option>
											</select>
										</div><!-- end form-group -->
									</div><!-- end main__page__wrapper-input -->

									<div class="main__page__wrapper-input main__page__wrapper-input--medium">
										<!-- Contrato -->
										<div class="form-group">
											<label for="rec_contrato" class="sr-only"><?php _e('&#8470; de contrato', THEMEDOMAIN); ?></label>
											<input type="text" class="frm-ilc__input form-control" name="rec_contrato" id="rec_contrato" placeholder="<?php _e('&#8470; de contrato', THEMEDOMAIN); ?>" />
										</div><!-- end form-group -->
									</div><!-- end main__page__wrapper-input -->

									<div class="main__page__wrapper-input main__page__wrapper-input--medium">
										<!-- Monto -->
										<div class="form-group">
											<label for="rec_monto" class="sr-only"><?php _e('Monto reclamado', THEMEDOMAIN); ?></label>
											<input type="text" class="frm-ilc__input form-control" name="rec_monto" id="rec_monto" placeholder="<?php _e('Monto reclamado', THEMEDOMAIN); ?>" />
										</div><!-- end form-group -->
									</div><!-- end main__page__wrapper-input -->

									<h4 class="main__page__subtitle">Detalles del Asunto</h4>

									<div class="row">
										<div class="col-xs-2">
											<div class="form-group">
												<div class="radio">
												    <label>
												      	<input type="radio" name="rec_asunto" value="1" checked> Reclamo
												    </label>
												</div>
											</div>
										</div>

										<div class="col-xs-2">
											<div class="radio">
											    <label>
											      	<input type="radio" name="rec_asunto" value="2"> Pedido
											    </label>
											</div>
										</div>

										<div class="col-xs-2">
											<div class="radio">
											    <label>
											      	<input type="radio" name="rec_asunto" value="3"> Consulta
											    </label>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-xs-6">
											<!-- Detail -->
											<div class="form-group">
												<label for="rec_detail" class="sr-only"><?php _e('Detalle', THEMEDOMAIN); ?></label>
												<textarea class="frm-ilc__input form-control" rows="6" name="rec_detail" id="rec_detail" placeholder="<?php _e('Detalle', THEMEDOMAIN); ?>"></textarea>
											</div><!-- end form-group -->
										</div>
										<div class="col-xs-6">
											<!-- Order -->
											<div class="form-group">
												<label for="rec_order" class="sr-only"><?php _e('Pedido', THEMEDOMAIN); ?></label>
												<textarea class="frm-ilc__input form-control" rows="6" name="rec_order" id="rec_order" placeholder="<?php _e('Pedido', THEMEDOMAIN); ?>"></textarea>
											</div><!-- end form-group -->
										</div>
									</div>

									<div class="form-group frm-ilc__group--short">
										<div class="checkbox">
											<label>
												<input type="checkbox" name="rec_terminos" id="rec_terminos" class="rec_terminos" />He leido y acepto todos los Términos y Condiciones
											</label>
										</div>
									</div>

	                  				<p class="text-center">
	                  					<button type="submit" class="button button--default"><?php _e('Enviar', THEMEDOMAIN); ?></button>
	                  				</p>

	                			</form>
	                		</div><!-- end frm-ilc__web -->

							<div class="frm-ilc__movil visible-xs-block visible-sm-block">

		                		<form class="frm-ilc" id="js-frm-reclamo-movil" method="post" action="">

		                			<input type="hidden" name="post_submit" value="true" />

									<div class="carousel slide car-book" data-ride="carousel" id="js-car-book">

										<div class="carousel-inner" role="listbox">

											<div class="item active">

												<h4 class="main__page__subtitle text-center">Indentificación del Cliente</h4>

												<!-- Name -->
												<div class="form-group">
													<label for="rec_name" class="sr-only"><?php _e('Nombre completo *', THEMEDOMAIN); ?></label>
													<input type="text" class="frm-ilc__input form-control" name="rec_name" id="rec_name" placeholder="<?php _e('Nombre completo *', THEMEDOMAIN); ?>" />
												</div><!-- end form-group -->

												<!-- Email -->
												<div class="form-group">
													<label for="rec_email" class="sr-only"><?php _e('Correo electrónico *', THEMEDOMAIN); ?></label>
													<input type="email" class="frm-ilc__input form-control" name="rec_email" id="rec_email" placeholder="<?php _e('Correo electrónico *', THEMEDOMAIN); ?>" />
												</div><!-- end form-group -->

												<!-- Address -->
												<div class="form-group">
													<label for="rec_address" class="sr-only"><?php _e('Domicilio *', THEMEDOMAIN); ?></label>
													<input type="text" class="frm-ilc__input form-control" name="rec_address" id="rec_address" placeholder="<?php _e('Domicilio *', THEMEDOMAIN); ?>" />
												</div><!-- end form-group -->

											<?php if ( count( $cities ) ) : ?>

												<!-- City -->
												<div class="form-group">
													<label for="rec_city" class="sr-only"><?php _e('Ciudad o Departamento', THEMEDOMAIN); ?></label>

													<select class="frm-ilc__input form-control" name="rec_city" id="rec_city">
														<option value=""><?php _e('-- Ciudad o Departamento --', THEMEDOMAIN); ?></option>

													<?php foreach ( $cities as $city ) : ?>
														<option value="<?php echo $city->cat_ID; ?>"><?php echo $city->name; ?></option>
													<?php endforeach; ?>

													</select>

												</div><!-- end form-group -->

											<?php endif; ?>

												<!-- DNI -->
												<div class="form-group">
													<label for="rec_dni" class="sr-only"><?php _e('DNI o CE *', THEMEDOMAIN); ?></label>
													<input type="text" class="frm-ilc__input form-control" name="rec_dni" id="rec_dni" placeholder="<?php _e('DNI o CE *', THEMEDOMAIN); ?>" />
												</div><!-- end form-group -->

												<!-- Phone -->
												<div class="form-group">
													<label for="rec_phone" class="sr-only"><?php _e('Teléfono *', THEMEDOMAIN); ?></label>
													<input type="text" class="frm-ilc__input form-control" name="rec_phone" id="rec_phone" placeholder="<?php _e('Teléfono *', THEMEDOMAIN); ?>" />
												</div><!-- end form-group -->

												<!-- Celular -->
												<div class="form-group">
													<label for="rec_cel" class="sr-only"><?php _e('Celular', THEMEDOMAIN); ?></label>
													<input type="text" class="frm-ilc__input form-control" name="rec_cel" id="rec_cel" placeholder="<?php _e('Celular', THEMEDOMAIN); ?>" />
												</div><!-- end form-group -->

												<!-- Tutor -->
												<div class="form-group">
													<label for="rec_tutor" class="sr-only"><?php _e('Padre, Madre o Tutor, en caso seas menor de edad', THEMEDOMAIN); ?></label>
													<input type="text" class="frm-ilc__input form-control" name="rec_tutor" id="rec_tutor" placeholder="<?php _e('Padre, Madre o Tutor, en caso seas menor de edad', THEMEDOMAIN); ?>" />
												</div><!-- end form-group -->

												<!-- DNI Tutor -->
												<div class="form-group">
													<label for="rec_dni_tutor" class="sr-only"><?php _e('DNI o CE', THEMEDOMAIN); ?></label>
													<input type="text" class="frm-ilc__input form-control" name="rec_dni_tutor" id="rec_dni_tutor" placeholder="<?php _e('DNI o CE', THEMEDOMAIN); ?>" />
												</div><!-- end form-group -->

												<!-- Respuesta -->
												<div class="form-group">
													<label for="rec_response" class="sr-only"><?php _e('-- Seleccione el método de respuesta --', THEMEDOMAIN); ?></label>
													<select class="frm-ilc__input form-control" name="rec_response" id="rec_response">
														<!-- <option value=""><?php //_e('-- Seleccione el método de respuesta --', THEMEDOMAIN); ?></option> -->
														<!-- <option value="1"><?php //_e('En domicilio', THEMEDOMAIN); ?></option> -->
														<option value="2" selected><?php _e('Correo electr&oacute;nico', THEMEDOMAIN); ?></option>
													</select>
												</div><!-- end form-group -->

												<p class="text-center">
				                  					<button type="button" class="button button--default" id="js-next-book"><?php _e('Siguiente', THEMEDOMAIN); ?></button>
				                  				</p>

											</div><!-- end item -->

											<div class="item">

												<h4 class="main__page__subtitle text-center">Indentificación del Producto o Servicio Contratado</h4>

												<!-- Service-->
												<div class="form-group">
													<label for="rec_service" class="sr-only"><?php _e('-- Seleccione el producto o servicio contratado --', THEMEDOMAIN); ?></label>
													<select class="frm-ilc__input form-control" name="rec_service" id="rec_service">
														<option value=""><?php _e('-- Seleccione el producto o servicio contratado --', THEMEDOMAIN); ?></option>
														<option value="1"><?php _e('Cr&eacute;dito con garant&iacute;a de Joyas', THEMEDOMAIN); ?></option>
														<option value="2"><?php _e('Cr&eacute;dito con garant&iacute;a de Artículos', THEMEDOMAIN); ?></option>
														<option value="3"><?php _e('Cr&eacute;dito con garant&iacute;a Vehicular', THEMEDOMAIN); ?></option>
													</select>
												</div><!-- end form-group -->

												<!-- Contrato -->
												<div class="form-group">
													<label for="rec_contrato" class="sr-only"><?php _e('&#8470; de contrato', THEMEDOMAIN); ?></label>
													<input type="text" class="frm-ilc__input form-control" name="rec_contrato" id="rec_contrato" placeholder="<?php _e('&#8470; de contrato *', THEMEDOMAIN); ?>" />
												</div><!-- end form-group -->

												<!-- Monto -->
												<div class="form-group">
													<label for="rec_monto" class="sr-only"><?php _e('Monto reclamado', THEMEDOMAIN); ?></label>
													<input type="text" class="frm-ilc__input form-control" name="rec_monto" id="rec_monto" placeholder="<?php _e('Monto reclamado *', THEMEDOMAIN); ?>" />
												</div><!-- end form-group -->

												<h4 class="main__page__subtitle text-center">Detalles del Asunto</h4>

												<div class="from-group">
													<label for="rec_asunto" class="sr-only"><?php _e('-- Seleccione el tipo de solicitud --', THEMEDOMAIN); ?></label>
													<select class="frm-ilc__input form-control" name="rec_asunto" id="rec_asunto">
														<!-- <option value=""><?php //_e('-- Seleccione el tipo de solicitud --', THEMEDOMAIN); ?></option> -->
														<option value="1"><?php _e('Reclamo', THEMEDOMAIN); ?></option>
														<option value="2"><?php _e('Pedido', THEMEDOMAIN); ?></option>
														<option value="3"><?php _e('Consulta', THEMEDOMAIN); ?></option>
													</select>
												</div>

												<!-- Detail -->
												<div class="form-group">
													<label for="rec_detail" class="sr-only"><?php _e('Detalle', THEMEDOMAIN); ?></label>
													<textarea class="frm-ilc__input form-control" rows="3" name="rec_detail" id="rec_detail" placeholder="<?php _e('Detalle *', THEMEDOMAIN); ?>"></textarea>
												</div><!-- end form-group -->

												<!-- Order -->
												<div class="form-group">
													<label for="rec_order" class="sr-only"><?php _e('Pedido', THEMEDOMAIN); ?></label>
													<textarea class="frm-ilc__input form-control" rows="3" name="rec_order" id="rec_order" placeholder="<?php _e('Pedido *', THEMEDOMAIN); ?>"></textarea>
												</div><!-- end form-group -->

												<div class="form-group">
													<div class="checkbox">
														<label>
															<input type="checkbox" name="rec_terminos" id="rec_terminos" class="rec_terminos" />He leido y acepto todos los Términos y Condiciones
														</label>
													</div>
												</div>

												<p class="text-center">
				                  					<button type="button" class="button button--default" id="js-prev-book"><?php _e('Anterior', THEMEDOMAIN); ?></button>

				                  					<button type="submit" class="button button--default"><?php _e('Enviar', THEMEDOMAIN); ?></button>
				                  				</p>

											</div><!-- end item -->

										</div><!-- end carousel-inner -->

									</div><!-- end car-book -->

								</form>

							</div><!-- end frm-ilc__movil -->

	              		</div><!-- end col-sm-12 -->

	            	</div><!-- end row -->

	          	</section><!-- end main__header -->

	        </div><!-- end container -->

	    </main><!-- end main -->

		<!-- MODAL TERMINOS -->
	    <div class="modal fade modal-ilc modal-ilc--width" id="js-terminos" tabindex="-1" role="dialog" aria-labelledby="md-terminos-label" aria-hidden="true">
	      <div class="modal-dialog modal-ilc__dialog">
	        <div class="modal-content modal-ilc__content">
	          	<div class="modal-header modal-ilc__header">
	            	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">[cerrar]</span></button>
	            	<h4 class="modal-title text-center text-uppercase modal-ilc__title modal-ilc__title--nbd" id="md-terminos-label">Autorización para Tratamiento de Datos Personales</h4>
	          	</div><!-- end modal-ilc__header -->

	          	<?php
	          		$values = get_post_custom( get_the_ID() );
	          		$docs = isset( $values['mb_doc'] ) ? $values['mb_doc'][0] : '';
	          	?>

	          	<div class="modal-body modal-ilc__body">
					<?php echo $docs; ?>
	          	</div><!-- end modal-ilc__body -->
	        </div><!-- end modal-ilc__content -->
	      </div><!-- end modal-ilc__dialog -->
	    </div><!-- end modal-ilc -->

    <?php endwhile; endif; ?>

<?php get_footer(); ?>