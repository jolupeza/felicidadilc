	<?php $options = get_option('ilc_custom_settings'); ?>

	<!-- MODAL ESCRIBENOS -->
  <div class="modal fade modal-ilc" id="js-escribenos" tabindex="-1" role="dialog" aria-labelledby="md-escribenos-label" aria-hidden="true">
    <div class="modal-dialog modal-ilc__dialog">
      <div class="modal-content modal-ilc__content">
        <div class="modal-header modal-ilc__header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">[cerrar]</span></button>
            <h4 class="modal-title text-uppercase modal-ilc__title text-center" id="md-escribenos-label"><span>Formulario de Contacto</span></h4>
          </div><!-- end modal-ilc__header -->

          <div class="modal-body modal-ilc__body">

              <p class="text-center js-frm-text">Completa el siguiente formulario y envianos tu consulta que nosotros gustosamente te responderemos.</p>

              <div class="loader-ajax hidden text-center js-loader-contact">
                  <img src="<?php echo IMAGES; ?>/loading.gif" />
              </div>

              <form class="frm-ilc text-center js-frm-contact" id="js-frm-contact" action="" method="POST" data-type="test">
                  <div class="form-group">
                    <label for="contact_name" class="sr-only frm-ilc__label"><?php _e('Nombre completo', THEMEDOMAIN); ?></label>
                    <input type="text" class="form-control frm-ilc__input" name="contact_name" id="contact_name" placeholder="<?php _e('Nombre completo', THEMEDOMAIN); ?>">
                  </div><!-- end form-group -->

                  <div class="form-group">
                    <label for="contact_email" class="sr-only frm-ilc__label"><?php _e('Correo electrónico', THEMEDOMAIN); ?></label>
                    <input type="email" class="form-control frm-ilc__input" name="contact_email" id="contact_email" placeholder="<?php _e('Correo electrónico', THEMEDOMAIN); ?>">
                  </div><!-- end form-group -->

                  <div class="row fieldConsulta">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="contact_dni" class="sr-only frm-ilc__label">DNI</label>
                        <input type="text" class="form-control frm-ilc__input" name="contact_dni" id="contact_dni" placeholder="DNI">
                      </div><!-- end form-group -->
                    </div><!-- end col-sm-6 -->
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="contact_phone" class="sr-only frm-ilc__label"><?php _e('Teléfono o Celular', THEMEDOMAIN); ?></label>
                        <input type="text" class="form-control frm-ilc__input" name="contact_phone" id="contact_phone" placeholder="<?php _e('Teléfono o Celular', THEMEDOMAIN); ?>">
                      </div><!-- end form-group -->
                    </div><!-- end col-sm-6 -->
                  </div><!-- end row -->

                  <div class="form-group fieldConsulta">
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
                    <textarea class="form-control frm-ilc__input" rows="2" name="contact_message" id="contact_message" placeholder="<?php _e('Mensaje', THEMEDOMAIN); ?>"></textarea>
                  </div><!-- end form-group -->

                  <button type="submit" class="button button--default"><?php _e('Enviar', THEMEDOMAIN); ?></button>

                </form>

            </div><!-- end modal-ilc__body -->
      </div><!-- end modal-ilc__content -->
    </div><!-- end modal-ilc__dialog -->
  </div><!-- end modal-ilc -->