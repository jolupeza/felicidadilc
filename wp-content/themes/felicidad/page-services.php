<?php
	/*
	 *	Template Name: Page Service
	 */
?>

<?php get_header(); ?>

<?php $options = get_option('ilc_custom_settings'); ?>

	<main class="main">
    <nav class="mnu-products-movil">
		<?php
			wp_nav_menu(
				array(
					'theme_location' => 'services-movil-menu',
					'walker'         => new My_menu_services_movil_Walker()
				)
			);
		?>
    </nav>

    <div class="container">
      <div class="row margin-top">
        <div class="col-md-3">

          <!-- MNU-PRODUCTS -->
          <nav class="mnu-products hidden-xs hidden-sm">

			<?php
				wp_nav_menu(
					array(
						'theme_location' => 'services-menu',
						'menu_class'     => 'mnu-products__list',
						'walker'         => new My_menu_services_Walker()
					)
				);
			?>

          </nav><!-- end mnu-products -->

        </div><!-- end col-md-3 -->

        <div class="col-md-9">
          	<h2 class="main__title text-uppercase main__title--blue main__title--page main__title--byellow"><?php the_excerpt(); ?></h2>

          	<?php
				$id       = get_the_ID();
				$values   = get_post_custom( $id );
				$catSlide = isset( $values['mb_catslide'] ) ? esc_attr( $values['mb_catslide'][0] ): '';

				$args = array(
					'post_type' =>	'slides',
					'cat'       => $catSlide
				);

				$the_query = new WP_Query($args);
				if ($the_query->have_posts()) :
            ?>

          	<!-- SLIDE-PAGE -->
          	<div class="carousel slide slide-page hidden-xs" data-ride="carousel">
            	<div class="carousel-inner" role="listbox">

              <?php
  						  $i = 0;
  		    			while ($the_query->have_posts()) : $the_query->the_post();
  		    				$active = ($i == 0) ? 'active' : '';
              ?>

              		<div class="item <?php echo $active; ?>">

              		<?php
              			if (has_post_thumbnail())
              			{
              				$attr = array( 'class' => 'img-responsive' );
              				the_post_thumbnail('full', $attr);
              			}
              		?>

                  <?php /*
                		<div class="carousel-caption">
                  			<?php the_content(); ?>
                		</div><!-- end carousel-caption -->
                  */ ?>

              		</div><!-- end item -->

              	<?php $i++; endwhile; ?>

            	</div><!-- end .carousel-inner -->
          	</div><!-- end slidepage -->

          	<?php endif; wp_reset_postdata(); ?>

          <!-- TABS-INFO -->
          <div role="tabpanel" class="tabs-info hidden-xs">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist" id="js-tab-service">
              <li role="presentation" class="active"><a class="text-uppercase" href="#about" aria-controls="about" role="tab" data-toggle="tab">Sobre el servicio</a></li>
              <li role="presentation"><a class="text-uppercase" href="#need" aria-controls="need" role="tab" data-toggle="tab">¿Qué necesito?</a></li>
              <li role="presentation"><a class="text-uppercase" href="#documents" aria-controls="documents" role="tab" data-toggle="tab">Documentos</a></li>
              <li role="presentation"><a class="text-uppercase" href="#questions" aria-controls="questions" role="tab" data-toggle="tab">Preguntas</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content tabs-info__content">
              <div role="tabpanel" class="tab-pane fade in active" id="about">

                <article class="tabs-info__content__item__text">
                  <?php
                    $about = isset( $values['mb_about'] ) ? esc_attr( $values['mb_about'][0] ): '';
                    if ( !empty($about) ) :
                  ?>
                  <p><?php echo $about; ?></p>
                  <?php endif; ?>
                </article><!-- end tabs-info__content__item__text -->

                <?php
                  $imgabout = isset( $values['mb_imgabout'] ) ? esc_attr( $values['mb_imgabout'][0] ): '';
                  if ( !empty($imgabout) ) :
                ?>
                <figure class="tabs-info__content__item__figure">
                  <img src="<?php echo $imgabout; ?>" class="img-responsive" />
                </figure><!-- end tabs-info__content__item__figure -->
                <?php endif; ?>

              </div><!-- end tabs-info__content__item -->

              <div role="tabpanel" class="tab-pane fade" id="need">

                <?php
                  $need = isset( $values['mb_need'] ) ? esc_attr( $values['mb_need'][0] ): '';
                  $videodo = isset( $values['mb_videodo'] ) ? esc_attr( $values['mb_videodo'][0] ): '';
                ?>
                <article class="tabs-info__content__item__text"><?php echo $need; ?></article>

                <figure class="tabs-info__content__item__figure">
                  <div id="player"></div>

                  <script type="text/javascript">
                    // Video sección Nuestros Servicios
                    var tag = document.createElement('script');
                    tag.src = "https://www.youtube.com/iframe_api";
                    var firstScriptTag = document.getElementsByTagName('script')[0];
                    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

                    function onYouTubeIframeAPIReady() {
                      player = new YT.Player('player', {
                        height: 'auto',
                        width: '100%',
                        videoId: '<?php echo $videodo; ?>',
                      });
                    }
                  </script>

                </figure><!-- end tabs-info__content__item__figure -->

              </div><!-- end #need -->

              <div role="tabpanel" class="tab-pane fade" id="documents">

                <?php
        					/*$tarifario     = isset( $values['mb_tarifario'] ) ? esc_attr( $values['mb_tarifario'][0] ): '';
        					$filetarifario = isset( $values['mb_filetarifario'] ) ? $values['mb_filetarifario'][0] : '';
        					$ft = '';
        					if ( !empty($filetarifario) )
        					{
        						$ft = unserialize($filetarifario);
        					}*/
                  $docs = (isset($values['mb_doc'])) ? $values['mb_doc'][0] : '';
                ?>

                <?php //if ( !empty($ft) && count($ft) ) : ?>
                <?php if ( !empty($docs) ) : ?>

                  <article class="tabs-info__content__item__text-full">
                    <?php echo $docs; ?>
                  </article>

                  <?php /*
                  <p class="tabs-info__content__item__text-full"><?php echo $tarifario; ?></p>

                  <p class="text-center tabs-info__content__item__text-icon">

                    <?php foreach ( $ft as $f ) : ?>
          						<?php if ( !empty($f) ) : ?>
          							<a href="<?php echo $f; ?>" target="_blank">
          								<i class="fa fa-file-pdf-o"></i>
          							</a>
          						<?php endif; ?>
                    <?php endforeach; ?>

                  </p>
                  */ ?>

                <?php endif; ?>

              </div>

              <div role="tabpanel" class="tab-pane fade" id="questions">

                <?php
                  $questions = isset( $values['mb_questions'] ) ? $values['mb_questions'][0] : '';

                  echo $questions;
                ?>

              </div>
            </div><!-- end tabs-info__content -->
          </div><!-- end tabs-info -->

          <!-- Información móvil -->
          <div class="panel-group panel-info visible-xs-block panel-info-services" id="accordion-info" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
              <div class="panel-heading active" role="tab" id="about">
                <h4 class="panel-title text-center text-uppercase">
                  <a data-toggle="collapse" data-parent="#accordion-info" href="#collapse-about" aria-expanded="true" aria-controls="collapse-about">Sobre el servicio</a>
                </h4>
              </div>
              <div id="collapse-about" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="about">
                <div class="panel-body">
                  <p><?php echo $about; ?></p>
                </div>
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading" role="tab" id="need">
                <h4 class="panel-title text-center text-uppercase">
                  <a class="collapsed" data-toggle="collapse" data-parent="#accordion-info" href="#collapse-need" aria-expanded="false" aria-controls="collapse-need">¿Qué necesito?</a>
                </h4>
              </div>
              <div id="collapse-need" class="panel-collapse collapse" role="tabpanel" aria-labelledby="need">
                <div class="panel-body">
                  <p class="tabs-info__content__item__text-full"><?php echo $need; ?></p>
                </div>
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading" role="tab" id="tarifario">
                <h4 class="panel-title text-center text-uppercase">
                  <a data-toggle="collapse" data-parent="#accordion-info" href="#collapse-documents" aria-expanded="true" aria-controls="collapse-documents">Documentos</a>
                </h4>
              </div>
              <div id="collapse-documents" class="panel-collapse collapse" role="tabpanel" aria-labelledby="documents">
                <div class="panel-body">

                  <?php //if ( !empty($ft) && count($ft) ) : ?>
                  <?php if ( !empty($docs) ) : ?>

                    <?php echo $docs; ?>

                    <?php /*
                    <p class="tabs-info__content__item__text-full"><?php echo $tarifario; ?></p>
                    <p class="text-center tabs-info__content__item__text-icon">
        						<?php foreach ( $ft as $f ) : ?>
        							<?php if ( !empty($f) ) : ?>
        								<a href="<?php echo $f; ?>" target="_blank">
        									<i class="fa fa-file-pdf-o"></i>
        								</a>
        							<?php endif; ?>
        						<?php endforeach; ?>
                    </p>
                    */ ?>

                  <?php endif; ?>

                </div>
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading" role="tab" id="questions">
                <h4 class="panel-title text-center text-uppercase">
                  <a data-toggle="collapse" data-parent="#accordion-info" href="#collapse-questions" aria-expanded="true" aria-controls="collapse-questions">Preguntas</a>
                </h4>
              </div>
              <div id="collapse-questions" class="panel-collapse collapse" role="tabpanel" aria-labelledby="questions">
                <div class="panel-body">
                  <?php echo $questions; ?>
                </div>
              </div>
            </div>
          </div><!-- end panel-info -->

          <p class="text-center">
            <?php if ( !empty( $options['central_phone'] ) ) : ?>
              <a class="text-uppercase buttons-page buttons-page--central hidden-xs" href="javascript:;">Central telefónica <span><?php echo $options['central_phone']; ?></span></a>
            <?php endif; ?>
            <a class="text-uppercase buttons-page buttons-page--solicitar visible-xs-inline-block visible-sm-inline-block" href="<?php echo home_url('escribenos'); ?>">Solictar servicio</a>
            <a class="text-uppercase buttons-page buttons-page--solicitar hidden-xs hidden-sm" href="<?php echo home_url('centro-de-ayuda/?open=true'); ?>">Solicitar servicio</a>
          </p>

        </div><!-- end col-md-9 -->

      </div><!-- end row -->
    </div><!-- end container -->
  </main><!-- end main -->

<?php get_footer(); ?>
