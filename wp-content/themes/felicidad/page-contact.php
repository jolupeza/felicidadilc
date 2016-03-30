<?php
	/*
	 *	Template Name: Page Contact
	 */
?>
<?php get_header(); ?>

	<main class="main">

  <ul class="nav nav-tabs BarContact" role="tablist">
    <li role="presentation" class="active"><a href="#consulta" aria-controls="consulta" role="tab" data-toggle="tab">Consultas</a></li>
    <li role="presentation"><a href="#sugerencia" aria-controls="sugerencia" role="tab" data-toggle="tab">Sugerencias</a></li>
  </ul>

  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="consulta">
      <div class="container">
        <h2 class="text-uppercase text-center main__title main__title--blue"><span><?php _e('Formulario de Consultas', THEMEDOMAIN) ?></span></h2>

        <!-- MAIN__CONTENT -->
        <section class="main__content">
          <p class="text-center js-frm-text">Completa el siguiente formulario para recibir información sobre cualquiera de nuestros servicios.</p>

          <div class="loader-ajax hidden text-center js-loader-contact">
            <img src="<?php echo IMAGES; ?>/loading.gif" />
          </div>

          <form class="frm-ilc text-center js-frm-contact" action="" method="POST" data-type="Consultas">
            <div class="form-group">
              <label for="contact_name" class="sr-only frm-ilc__label"><?php _e('Nombre completo', THEMEDOMAIN); ?></label>
              <input type="text" class="form-control frm-ilc__input" name="contact_name" id="contact_name" placeholder="<?php _e('Nombre completo', THEMEDOMAIN); ?>">
            </div><!-- end form-group -->

            <div class="form-group">
              <label for="contact_email" class="sr-only frm-ilc__label"><?php _e('Correo electrónico', THEMEDOMAIN); ?></label>
              <input type="email" class="form-control frm-ilc__input" name="contact_email" id="contact_email" placeholder="<?php _e('Correo electrónico', THEMEDOMAIN); ?>">
            </div><!-- end form-group -->

            <div class="form-group">
              <label for="contact_dni" class="sr-only frm-ilc__label">DNI</label>
              <input type="text" class="form-control frm-ilc__input" name="contact_dni" id="contact_dni" placeholder="DNI">
            </div><!-- end form-group -->

            <div class="form-group">
              <label for="contact_phone" class="sr-only frm-ilc__label"><?php _e('Teléfono', THEMEDOMAIN); ?></label>
              <input type="text" class="form-control frm-ilc__input" name="contact_phone" id="contact_phone" placeholder="<?php _e('Teléfono', THEMEDOMAIN); ?>">
            </div><!-- end form-group -->

            <div class="form-group">
              <label for="contact_dpto" class="sr-only frm-ilc__label"><?php _e('Departamento', THEMEDOMAIN); ?></label>
              <select class="form-control frm-ilc__input" name="contact_dpto" id="contact_dpto">
                <option value=""><?php _e('-- Selecciona tu departamento --', THEMEDOMAIN); ?></option>
                <?php
                  $parent = get_category_by_slug('ciudades');
                  $args = array(
                    'parent'  => $parent->cat_ID
                  );
                  $cities = get_categories( $args );

                  if (count($cities))
                  {
                    foreach ( $cities as $city ) :
                ?>
                  <option value="<?php echo $city->name; ?>"><?php echo $city->name; ?></option>
                <?php
                    endforeach;
                  }
                ?>
              </select>
            </div><!-- end form-group -->

            <div class="form-group">
              <label for="contact_message" class="sr-only frm-ilc__label"><?php _e('Mensaje', THEMEDOMAIN); ?></label>
              <textarea class="form-control frm-ilc__input" rows="3" name="contact_message" id="contact_message" placeholder="<?php _e('Mensaje', THEMEDOMAIN); ?>"></textarea>
            </div><!-- end form-group -->

            <button type="submit" class="button button--default">Enviar</button>

          </form>
        </section><!-- end main__content -->
      </div><!-- end container -->
    </div><!-- end #consulta -->
    <div role="tabpanel" class="tab-pane" id="sugerencia">
       <div class="container">
        <h2 class="text-uppercase text-center main__title main__title--blue"><span><?php _e('Formulario de Sugerencias', THEMEDOMAIN) ?></span></h2>

        <!-- MAIN__CONTENT -->
        <section class="main__content">
          <p class="text-center js-frm-text">Completa el siguiente formulario para recibir información sobre cualquiera de nuestros servicios.</p>

          <div class="loader-ajax hidden text-center js-loader-contact">
            <img src="<?php echo IMAGES; ?>/loading.gif" />
          </div>

          <form class="frm-ilc text-center js-frm-contact" action="" method="POST" data-type="Sugerencias">
            <div class="form-group">
              <label for="contact_name" class="sr-only frm-ilc__label"><?php _e('Nombre completo', THEMEDOMAIN); ?></label>
              <input type="text" class="form-control frm-ilc__input" name="contact_name" id="contact_name" placeholder="<?php _e('Nombre completo', THEMEDOMAIN); ?>">
            </div><!-- end form-group -->

            <div class="form-group">
              <label for="contact_email" class="sr-only frm-ilc__label"><?php _e('Correo electrónico', THEMEDOMAIN); ?></label>
              <input type="email" class="form-control frm-ilc__input" name="contact_email" id="contact_email" placeholder="<?php _e('Correo electrónico', THEMEDOMAIN); ?>">
            </div><!-- end form-group -->

            <div class="form-group hidden">
              <label for="contact_dni" class="sr-only frm-ilc__label">DNI</label>
              <input type="text" class="form-control frm-ilc__input" name="contact_dni" id="contact_dni" placeholder="DNI">
            </div><!-- end form-group -->

            <div class="form-group hidden">
              <label for="contact_phone" class="sr-only frm-ilc__label"><?php _e('Teléfono', THEMEDOMAIN); ?></label>
              <input type="text" class="form-control frm-ilc__input" name="contact_phone" id="contact_phone" placeholder="<?php _e('Teléfono', THEMEDOMAIN); ?>">
            </div><!-- end form-group -->

            <div class="form-group hidden">
              <label for="contact_dpto" class="sr-only frm-ilc__label"><?php _e('Departamento', THEMEDOMAIN); ?></label>
              <select class="form-control frm-ilc__input" name="contact_dpto" id="contact_dpto">
                <option value=""><?php _e('-- Selecciona tu departamento --', THEMEDOMAIN); ?></option>
                <?php
                  $parent = get_category_by_slug('ciudades');
                  $args = array(
                    'parent'  => $parent->cat_ID
                  );
                  $cities = get_categories( $args );

                  if (count($cities))
                  {
                    foreach ( $cities as $city ) :
                ?>
                  <option value="<?php echo $city->name; ?>"><?php echo $city->name; ?></option>
                <?php
                    endforeach;
                  }
                ?>
              </select>
            </div><!-- end form-group -->

            <div class="form-group">
              <label for="contact_message" class="sr-only frm-ilc__label"><?php _e('Mensaje', THEMEDOMAIN); ?></label>
              <textarea class="form-control frm-ilc__input" rows="3" name="contact_message" id="contact_message" placeholder="<?php _e('Mensaje', THEMEDOMAIN); ?>"></textarea>
            </div><!-- end form-group -->

            <button type="submit" class="button button--default">Enviar</button>

          </form>
        </section><!-- end main__content -->
      </div><!-- end container -->
    </div>
  </div><!-- end tab-content -->

    <?php /* ?>

    */ ?>

  </main><!-- end main -->

<?php get_footer(); ?>