<?php
	/*
	 *	Template Name: Page Workus
	 */
?>

<?php
	$error = 'no';
	if ( isset($_POST['post_submit']) )
	{
		$error = TRUE;

		if ( isset( $_FILES['mb_cv'] ) )
		{
			$cv = $_FILES['mb_cv'];
			$types = array(
				'application/pdf',
				'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
				'application/msword',
				'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
				'application/vnd.ms-excel',
				'application/octet-stream'
			);

			$extensions = array('pdf', 'doc', 'docx', 'xls', 'xlsx');

			if ( $cv['error'] === 0)
			{
				if ( in_array( $cv['type'], $types ) )
				{
					if ( $cv['size'] <= 2097152 )
					{
						// Validate extension file
						$nameFile = $cv['name'];
						$nameFile = explode('.', $nameFile);
						$totalNameFile = count($nameFile);
						$ext = $nameFile[$totalNameFile - 1];

						if (in_array($ext, $extensions)) {
							$name      = sanitize_text_field( trim( $_POST['mb_name']) );
							$tel       = sanitize_text_field( trim( $_POST['mb_tel']) );
							$email     = is_email( sanitize_text_field( trim( $_POST['mb_email']) ) );
							$jobs      = $_POST['mb_jobs'];

							$newJobs   = array();
							foreach ($jobs as $job)
							{
								if ( $job !== 'convocatoria')
								{
									$newJobs[(int)$job] = 'on';
								}
							}
							$jobs      = $newJobs;

							$post_type   = 'postulantes';

							$title       = $email;
							$slug        = sanitize_title( $title );

							$postulante  = get_page_by_title( $title, OBJECT, $post_type );
							$post_id     = 0;

							$ext         = explode('.', $cv['name']);
							$ext         = $ext[ count($ext) - 1 ];
							$fileCv      = "resources/" . $slug . '.' . $ext;
							$fileCvNoExt = "resources/" . $slug . '.';

							if ( is_null( $postulante ) ) {
								// Creamos nuevo postulante
								$post_id = wp_insert_post(
									array(
										'post_author' => 1,
										'post_name'   => $slug,
										'post_title'  => $title,
										'post_status' => 'publish',
										'post_type'   => $post_type
									)
								);

								update_post_meta( $post_id, 'mb_name', esc_attr( $name ) );

								update_post_meta( $post_id, 'mb_tel', esc_attr( $tel ) );

								update_post_meta( $post_id, 'mb_email', esc_attr( $email ) );
							} else {
								$post_id = $postulante->ID;
								// Actualizamos datos y agregamos puesto a postular
								update_post_meta( $post_id, 'mb_name', esc_attr( $name ) );

								update_post_meta( $post_id, 'mb_tel', esc_attr( $tel ) );

			    				$values = get_post_custom( $post_id );
			    				$jobsOld = isset( $values['mb_jobs'] ) ? $values['mb_jobs'][0] : '';

			    				if ( !empty($jobsOld) && count($jobs) )
			    				{
			    					$jobsOld = unserialize( $jobsOld );
			    					foreach ($jobsOld as $key => $value)
			    					{
			    						if ( !in_array($key, $jobs) )
			    						{
			    							$jobs[$key] = 'on';
			    						}
			    					}
			    				}

								// Eliminamos cv actual
								if ( file_exists( $fileCvNoExt . 'pdf' ) || file_exists( $fileCvNoExt . 'doc' ) || file_exists( $fileCvNoExt . 'docx' ) || file_exists($fileCvNoExt . 'xls') || file_exists($fileCvNoExt . 'xlsx') ) {
									if ( file_exists( $fileCvNoExt . 'pdf' ) )
									{
										unlink( $fileCvNoExt . 'pdf' );
									}

									if ( file_exists( $fileCvNoExt . 'doc' ))
									{
										unlink( $fileCvNoExt . 'doc' );
									}

									if ( file_exists( $fileCvNoExt . 'docx' ))
									{
										unlink( $fileCvNoExt . 'docx' );
									}

									if ( file_exists( $fileCvNoExt . 'xls' ))
									{
										unlink( $fileCvNoExt . 'xls' );
									}

									if ( file_exists( $fileCvNoExt . 'xlsx' ))
									{
										unlink( $fileCvNoExt . 'xlsx' );
									}
								}
							}

							if ( count($jobs) ) {
								update_post_meta( $post_id, 'mb_jobs', $jobs );
							}

							if ( move_uploaded_file( $cv['tmp_name'], $fileCv ) ) {
								update_post_meta( $post_id, 'mb_cv', esc_attr( $fileCv ) );
								$error     = FALSE;
							}
						}
					}
				}
			}
		}
	}
?>

<?php get_header(); ?>

		<main class="main">
	        <div class="container">
	          	<section class="main__header">
	            	<div class="row">

	            		<?php
	            			// Consulta trabajos activos
	            			$args = array(
								'post_type'      => 'jobs',
								'posts_per_page' => '-1',
								'orderby'        => 'menu_order',
								'order'          => 'ASC',
								'meta_query'     => array(
									array(
										'key'	  => 'mb_date_due',
										'compare' => '>=',
										'value'	  => date('Y-m-d'),
										'type'	  => 'DATE'
									)
								)
							);

							$the_query = new WP_Query($args);
	            		?>

						<?php if (have_posts()) : while(have_posts()) : the_post(); ?>

	              		<div class="col-sm-6">
	                		<div class="main__header__info">

								<h2 class="main__header__info__title text-uppercase"><?php echo separteTitle(get_the_title(get_the_ID())); ?></h2>
	                			<?php the_content(); ?>

	                			<?php if ( $error && $error !== 'no' ) : ?>
									<div class="alert alert-info">
										<p>No pudimos agregar su susripción al puesto de trabajo. Por favor verifica tus datos y que el cv adjuntado sea de tipo PDF, DOC, DOCX, XLS ó XLSX</p>
									</div>
								<?php elseif ( !$error && $error !== 'no') : ?>
									<div class="alert alert-success">
										<p>Se agregó correctamente su suscripción al o los puestos seleccionados. Nos pondremos en contacto con usted.</p>
									</div>
	                			<?php endif; ?>

	                			<?php
	                				$options = get_option('ilc_custom_settings');
	                				$format_cv = (!empty( $options[ 'format_cv' ] )) ? $options[ 'format_cv' ] : '';

	                				if(!empty($format_cv)) :
                				?>
			                			<div class="frm-ilc__fileUpload frm-ilc__fileUpload--top">
											<a href="<?php echo $format_cv; ?>" target="_blank"><span>Formato de CV</span></a>
										</div>
								<?php endif; ?>

	                			<form class="frm-ilc" id="js-frm-postulante" method="post" action="" enctype="multipart/form-data">

									<div class="row">
										<div class="col-xs-7">
											<!-- Name -->
											<div class="form-group">
												<label class="sr-only" for="mb_name"><?php _e('Nombre completo', THEMEDOMAIN); ?></label>
												<input type="text" class="form-control frm-ilc__input" name="mb_name" id="mb_name" placeholder="<?php _e('Nombre completo', THEMEDOMAIN); ?>" />
											</div>
											<!-- Tel -->
											<div class="form-group">
												<label class="sr-only" for="mb_tel"><?php _e('Teléfono o Celular', THEMEDOMAIN); ?></label>
												<input type="text" class="form-control frm-ilc__input" name="mb_tel" id="mb_tel" placeholder="<?php _e('Teléfono o Celular', THEMEDOMAIN); ?>" />
											</div>
											<!-- Email -->
											<div class="form-group">
												<label class="sr-only" for="mb_email"><?php _e('Correo electrónico', THEMEDOMAIN); ?></label>
												<input type="email" class="form-control frm-ilc__input" name="mb_email" id="mb_email" placeholder="<?php _e('Correo electrónico', THEMEDOMAIN); ?>" />
											</div>
											<!-- Jobs -->
											<div class="form-group">
												<label class="sr-only" for="mb_jobs"><?php _e('Selecciona el puesto a postular', THEMEDOMAIN); ?></label>
												<select multiple class="form-control frm-ilc__input" name="mb_jobs[]" id="mb_jobs">
													<!-- <option value="" selected="selected"><?php //_e('-- Selecciona el puesto a postular --', THEMEDOMAIN); ?></option> -->

												<?php if ($the_query->have_posts()) : ?>
													<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

														<option value="<?php echo get_the_ID(); ?>"><?php the_title(); ?></option>

													<?php endwhile; ?>

												<?php else : ?>

													<option value="convocatoria" selected="selected"><?php _e('Convocatoria General', THEMEDOMAIN); ?></option>

												<?php endif; wp_reset_postdata(); ?>

												</select>
											</div><!-- end form-group -->
										</div><!-- end col-xs-7 -->
										<div class="col-xs-5">
											<!-- Cv -->
											<div class="form-group">
												<div class="frm-ilc__fileUpload">
													<span>Adjunta aquí tu CV</span>
													<input type="file" class="frm-ilc__file" name="mb_cv" id="mb_cv" />
												</div>
											</div>

											<input type="hidden" id="post_submit" name="post_submit" value="true" />

											<p class="text-center">
												<input type="submit" class="button button--success" value="Postular">
											</p>
										</div><!-- end col-xs-5 -->
									</div><!--s end row -->
	                			</form><!-- end form -->

	                		</div><!-- end main__header__info -->
	              		</div><!-- end col-sm-6 -->
	              		<div class="col-sm-6">
	                		<figure class="main__header__figure">
	                			<?php
	                				if (has_post_thumbnail())
	                				{
	                					$attr = array('class' => 'img-responsive');
	                					the_post_thumbnail('full', $attr);
	                				}
	                				else
	                				{
	                  					echo '<img src="http://lorempixel.com/555/278" alt="" class="img-responsive">';
	                				}
	                			?>
	                		</figure><!-- end main__header__figure -->
	              		</div><!-- end col-sm-6 -->

	              		<?php endwhile; endif; ?>
	            	</div><!-- end row -->
	          	</section><!-- end main__header -->

	          	<h2 class="text-uppercase text-center main__title main__title--blue"><span>Estamos buscando</span></h2>

				<?php
					$newArgs = array(
						'posts_per_page' => '6',
						'paged'          => (get_query_var('paged')) ? get_query_var('paged') : 1,
					);
					$args = array_merge($args, $newArgs);
					$the_query = new WP_Query($args);

              		if ($the_query->have_posts()) :
				?>

				<div class="row">

					<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

						<?php
							$id             = get_the_ID();
							$values         = get_post_custom( $id );
							$vacantes       = isset( $values['mb_vacantes'] ) ? esc_attr( $values['mb_vacantes'][0] ): '';
							$disponibilidad = isset( $values['mb_date_due'] ) ? esc_attr( $values['mb_date_due'][0] ): '';
							$timeDisp       = date( 'd/m/Y', strtotime( $disponibilidad ) );
							$category       = get_the_category( $id );
						?>

						<div class="col-sm-4 main__jobs__wrapper">

							<article class="main__jobs">
								<h3 class="main__jobs__title"><?php the_title(); ?></h3><!-- end main__jobs__title -->
								<ul class="main__jobs__items">
									<li><?php _e( 'Vancantes', THEMEDOMAIN ); ?>: <?php echo $vacantes; ?></li>
									<li><?php _e( 'Localidad', THEMEDOMAIN ); ?>: <?php echo $category[0]->name; ?></li>
									<li><?php _e( 'Fecha de publicación', THEMEDOMAIN ); ?>: <?php the_time( 'd/m/Y' ); ?></li>
									<li><?php _e( 'Disponible hasta', THEMEDOMAIN ); ?>: <?php echo $timeDisp; ?></li>
								</ul><!-- end main__jobs__items -->
							</article><!-- end main__jobs -->

						</div><!-- end col-sm-4 -->

					<?php endwhile; ?>

				</div><!-- end row -->

					<?php
						//global $wp_query;
						$total = $the_query->max_num_pages;

						if ( $total > 1 ) :
					?>

		          	<!-- MAIN__PAGINATION -->
		          	<div class="row">
		            	<div class="col-sm-12">
		              		<nav class="main__pagination text-center">

							<?php
								$current_page = (get_query_var( 'paged' )) ? get_query_var( 'paged' ) : 1;
								$format = ( get_option('permalink_structure' ) == '/%postname%/') ? 'page/%#%/' : '&paged=%#%';

								echo paginate_links(array(
				                    'base'      =>    get_pagenum_link(1) . '%_%',
				                    'format'    =>    $format,
				                    'current'   =>    $current_page,
				                    'prev_next' =>    True,
				                    'prev_text' =>    __('&laquo;', THEMEDOMAIN),
				                    'next_text' =>    __('&raquo;', THEMEDOMAIN),
				                    'total'     =>    $total,
				                    'mid_size'  =>    4,
				                    'type'      =>    'list'
	                  			));
							?>

		              		</nav>
		            	</div><!-- end col-sm-12 -->
		          	</div><!-- end row -->

		          	<?php endif; ?>

	          	<?php else : ?>

	          		<p>Actualmente no contamos con puestos disponibles.</p>

	          	<?php endif; ?>

	          	<?php wp_reset_postdata(); ?>

	        </div><!-- end container -->
	    </main><!-- end main -->

<?php get_footer(); ?>