<?php
	/*
	 *	Template Name: Page Agencias
	 */
?>

<?php get_header(); ?>

  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <?php if ( has_post_thumbnail() ) : ?>

      <figure class="AgenciaImage hidden-xs hidden-sm">

        <?php the_post_thumbnail( 'full', array('class' => 'img-responsive') ); ?>

      </figure>

    <?php endif; ?>

  <?php endwhile; endif; ?>

	<main class="main">
    <div class="container">

      <h2 class="text-uppercase text-center main__title main__title--blue"><span>Conoce nuestras agencias</span></h2>

      <!-- MAIN__MAP -->
      <div class="row main__map">

        <div class="col-md-12">

          <div class="loader-ajax hidden text-center loader-ajax__agencias" id="js-loader-agencias">
            <img src="<?php echo IMAGES; ?>/loading.gif" />
          </div>

          <section class="main__map__filters hidden-xs hidden-sm">

            <div class="row">

              <div class="col-md-2"></div>

              <!-- Departamento -->
              <div class="col-md-4">

                <?php
                  $parent = get_category_by_slug( 'ciudades' );
                  $args = array(
                    'parent' => $parent->cat_ID
                  );

                  $cities = get_categories( $args );

                ?>

                <select class="frm-ilc__select form-control sel-map frm-ilc__select--noborder">

                  <option value="">-- Selecciona tu Departamento --</option>

                  <?php foreach ( $cities as $city ) : ?>
                    <option value="<?php echo $city->cat_ID; ?>"><?php echo $city->name; ?></option>
                  <?php endforeach; ?>

                </select>

              </div><!-- end col-md-4 -->

              <!-- Distritos -->
              <div class="col-md-4">

                <div class="wrapper-sel-dist">
                  <select class="frm-ilc__select form-control sel-distrito frm-ilc__select--noborder" data-ciudad="">
                    <option value="">-- Selecciona tu Distrito --</option>
                  </select>
                </div>

              </div><!-- end col-md-4 -->

              <!-- Tipos de Créditos -->
              <?php /*
              <div class="col-md-4">
                <?php
                  $tags = get_tags();
                ?>

                <select class="frm-ilc__select form-control sel-tipo-credito frm-ilc__select--noborder">
                  <option value="">-- Selecciona tu Tipo de Crédito --</option>

                  <?php foreach ( $tags as $tag ) : ?>

                    <option value="<?php echo $tag->term_id; ?>"><?php echo $tag->name; ?></option>

                  <?php endforeach; ?>

                </select>

              </div><!-- end col-md-4 -->
              */ ?>

            <div class="col-md-2"></div>

            </div><!-- end row -->

          </section><!-- end main__map__filters -->

          <!-- Select departamento agencia solo movil -->
          <div class="form-group visible-xs-block visible-sm-block main__map__select">

            <?php
              $parent = get_category_by_slug( 'ciudades' );

              $args = array(
                'parent'  => $parent->cat_ID
              );
              $cities = get_categories( $args );
            ?>

            <select class="frm-ilc__select form-control sel-map">
              <option value="">-- Selecciona un Departamento o Ciudad --</option>

              <?php foreach ( $cities as $city ) : ?>
                <option value="<?php echo $city->cat_ID; ?>"><?php echo $city->name; ?></option>
              <?php endforeach; ?>

            </select>
          </div><!-- end form-group select departamento -->

          <!-- <section class="main__map__info"> -->
          <section class="main__map__info--no-info">
            <!-- Esto se mostrará cuando aún no se hayan seleccionado un departamento del mapa -->
            <p class="main__map__info__text text-center">Estamos ubicados estrategicamente en varias ciudades a nivel nacional, con la finalidad de estar cerca cuando nos necesites, contando así con más de 80 agencias y puntos de atención.</p>
            <p class="text-center main__map__info__text">En el siguiente mapa podrás ver nuestras agencias dando clic en cualquiera de los  departanmentos donde nos encontramos.</p>

          </section><!-- end main__map__info -->

          <section class="main__map__info"></section><!-- end main__map__info -->

        </div><!-- end col-md-12 -->
      </div><!-- end row -->

    </div><!-- end container -->
  </main><!-- end main -->

  <!-- Modal -->
  <div class="modal fade modal-ilc" id="js-maps" tabindex="-1" role="dialog" aria-labelledby="md-maps-label" aria-hidden="true">
    <div class="modal-dialog modal-ilc__dialog--maps">
      <div class="modal-content modal-ilc__content">
        <div class="modal-body modal-ilc__body modal-ilc__body--nopading">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">[cerrar]</span></button>

          <ul class="nav nav-tabs TabsAgencia" role="tablist">
            <li role="presentation" class="active"><a href="#map" aria-controls="map" role="tab" data-toggle="tab">Mapa</a></li>
            <li role="presentation"><a href="#gallery" aria-controls="gallery" role="tab" data-toggle="tab">Galería</a></li>
          </ul>

          <div class="tab-content TabsAgencia-content">
            <div class="tab-pane active" role="tabpanel" id="map">

              <figure class="map-container" id="js-map-container"></figure><!-- end map-container -->

            </div><!-- end #map -->

            <div class="tab-pane TabGallery" role="tabpanel" id="gallery">

              <div id="car-img-agencia" class="carousel slide TabGallery-slide" data-interval="2000">
                <!-- Indicators -->
                <ol class="carousel-indicators TabGallery-indicators"></ol><!-- end TabGallery-indicators -->

                <!-- Wrapper for slides -->
                <div class="carousel-inner TabGallery-inner" role="listbox"></div><!-- end TabGallery-inner -->

                <!-- Controls -->
                <a class="left carousel-control TabGallery-control TabGallery-control--left" href="#car-img-agencia" role="button" data-slide="prev">
                  <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control TabGallery-control TabGallery-control--right" href="#car-img-agencia" role="button" data-slide="next">
                  <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div><!-- end TabGallery-slide -->

            </div><!-- end TabGallery -->

          </div><!-- end tab-content -->

          <article class="map-info">
            <h3 class="map-info__title text-center map-info__title--agencia"></h3>
            <h4 class="map-info__address text-center"></h4>
            <h4 class="map-info__phone text-center"></h4>

            <h3 class="map-info__title">Horario de Atención</h3>
            <div class="row">
              <div class="col-xs-4"><p class="map-info__text" id="js-modal-horario1"></p></div>
              <div class="col-xs-4"><p class="map-info__text" id="js-modal-horario2"></p></div>
              <div class="col-xs-4"><p class="map-info__text" id="js-modal-horario3"></p></div>
            </div>
          </article><!-- end map-info -->
        </div><!-- end modal-body -->
      </div><!-- end modal-ilc__content -->
    </div><!-- end modal-ilc__dialog-maps -->
  </div><!-- end modal-ilc -->

<?php get_footer(); ?>