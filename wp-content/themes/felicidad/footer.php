      <?php $options = get_option('ilc_custom_settings'); ?>

      <!-- <button class="footer__button text-hide hidden-xs hidden-sm" id="js-footer">v</button> -->
      <button class="footer__button text-hide hidden-xs hidden-sm" id="js-footer">v</button>

      <!-- <footer class="footer hidden-xs hidden-sm"> -->
      <footer class="footer hidden-xs hidden-sm">

        <div class="container">
          <section class="prefooter">
            <?php $logo = empty( $options[ 'logo_footer' ] ) ? IMAGES . '/logo-footer.png' : $options[ 'logo_footer' ]; ?>
            <h1 class="footer__logo">
              <img src="<?php echo $logo; ?>" alt="<?php bloginfo('name'); ?> | <?php bloginfo('description'); ?>" />
            </h1><!-- end footer__logo -->

            <div class="prefooter__content">
              <div class="prefooter__content__item">

                <?php
                  wp_nav_menu(
                    array(
                      'theme_location' => 'footer-menu',
                      'menu_class' => 'footer__menu'
                    )
                  );
                ?>

              </div><!-- end prefooter__content__item -->

              <div class="prefooter__content__item">
                <h4 class="footer__title text-uppercase">Para personas</h4>

                <?php
                  wp_nav_menu(
                    array(
                      'theme_location' => 'footer-services-menu',
                      'menu_class' => 'footer__menu'
                    )
                  );
                ?>

              </div><!-- end prefooter__content__item -->

              <div class="prefooter__content__item">

                <h4 class="footer__title text-uppercase">Transparencia de Información</h4>
                <?php
                  wp_nav_menu(
                    array(
                      'theme_location' => 'transparency-menu',
                      'menu_class' => 'footer__menu'
                    )
                  );
                ?>

                <!-- <h4 class="footer__title text-uppercase">Para microempresas</h4>
                <ul class="footer__menu">
                  <li class="text-uppercase">
                    Préstamos para microempresa
                    <ul>
                      <li><a href="#">> ¿Cómo lo hago?</a></li>
                      <li><a href="#">> ¿Qué necesito?</a></li>
                      <li><a href="#">> ¿Qué obtengo?</a></li>
                      <li><a href="#">> Tips y consejos</a></li>
                      <li><a href="#">> Preguntas Frecuentes</a></li>
                      <li><a href="#">> Casos de Éxito</a></li>
                    </ul>
                  </li>
                </ul> -->

              </div><!-- end prefooter__content__item -->

              <div class="prefooter__content__item">
                <p class="footer__text text-center">
                  <a href="http://reclamos.inversioneslacruz.com/" target="_blank">
                  <!-- <a href="<?php // echo home_url('libro-de-reclamaciones'); ?>"> -->
                    <img class="img-responsive" src="<?php echo IMAGES; ?>/libro-reclamaciones.png" alt="Libro de reclamaciones" />
                  </a>
                </p>

                <p class="footer__text text-center">regulado por:</p>
                <p class="footer__text text-center">
                  <img src="<?php echo IMAGES; ?>/superintendencia.png" class="img-responsive" />
                </p>

              <?php if ($options['display_social_link']) : ?>
                <p class="footer__text text-center">Síguenos en:</p>
                <ul class="footer__social list-inline text-center">

                <?php if (!empty( $options['facebook'] )) : ?>
                  <li><a class="text-hide footer__social__link footer__social__link--fb" href="http://www.facebook.com/<?php echo $options['facebook']; ?>" target="_blank">facebook</a></li>
                <?php endif; ?>

                <?php if (!empty( $options['twitter'] )) : ?>
                  <li><a class="text-hide footer__social__link footer__social__link--tw" href="http://www.twitter.com/<?php echo $options['twitter']; ?>" target="_blank">twitter</a></li>
                <?php endif; ?>

                </ul>
              <?php endif; ?>

              </div><!-- end col-sm-3 -->
            </div><!-- end prefooter__content -->

          </section><!-- end prefooter -->

          <section class="copy">
            <div class="row">
              <div class="col-sm-12">
                <hr class="fancy-hr" />
                <p class="text-center">Copyright&copy; <?php echo date('Y'); ?>. Derechos Reservados <br />Desarrollado por <a href="http://watson.pe" target="_blank">Watson</a></p>
              </div><!-- end col-sm-12 -->
            </div><!-- end row -->
          </section><!-- end copy -->
        </div><!-- end container -->

      </footer><!-- end footer -->

    </div><!-- end slidebar -->

    <aside class="sb-slidebar sb-left sidebar">
      <h1 class="sidebar__logo text-center">
      <?php
        $logo = empty( $options[ 'logo_sidebar_movil' ] ) ? IMAGES . '/logo-sidebar.png' : $options[ 'logo_sidebar_movil' ];
      ?>
        <a href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>">
          <img class="img-responsive" src="<?php echo $logo ?>" alt="<?php bloginfo('name'); ?> | <?php bloginfo('description'); ?>" />
        </a>
      </h1>
      <nav>
        <?php
          wp_nav_menu(
            array(
              'theme_location' => 'movil-menu',
              'menu_class' => 'sidebar__menu'
            )
          );
        ?>
      </nav>

      <?php if (isset($options['display_social_link']) && $options['display_social_link']) : ?>
      <ul class="list-inline sidebar__social">
        <?php if (!empty( $options['facebook'] )) : ?>
          <li><a class="sidebar__social--facebook text-hide" href="http://www.facebook.com/<?php echo $options['facebook']; ?>" target="_blank">Facebook</a></li>
        <?php endif; ?>

        <?php if (!empty( $options['twitter'] )) : ?>
          <li><a class="sidebar__social--twitter text-hide" href="http://www.twitter.com/<?php echo $options['twitter']; ?>" target="_blank">Twitter</a></li>
        <?php endif; ?>
      </ul>
      <?php endif; ?>

      <footer class="sidebar__footer">
        <p>Copyright@<?php echo date('Y'); ?>. Derechos Reservados</p>
        <p>Desarrollado por <a href="http://watson.pe" target="_blank">Watson</a></p>
      </footer>
    </aside><!-- end sb-slidebar -->

    <!-- Sidebar Right Promo -->
    <?php include_once( TEMPLATEPATH . '/includes/promocion.php' ); ?>

    <script type="text/javascript">
      var _root_ = '<?php echo home_url(); ?>/';
    </script>

    <?php wp_footer(); ?>

    <script>
      <?php if ( isset($_GET['open']) && $_GET['open'] === 'true') : ?>

        j('#js-escribenos').modal('show');
      <?php endif; ?>
    </script>
  </body><!-- end body -->
</html><!-- end html -->