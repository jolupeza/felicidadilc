  <?php if ( !empty($cityName) ) : ?>
    <h3 class="main__map__info__title text-center text-uppercase"><span>Agencias en <?php echo $cityName; ?></span></h3>
  <?php endif; ?>

  <?php if ( !empty($distritoName) ) : ?>
    <h3 class="main__map__info__title text-center text-uppercase"><span><?php echo $distritoName; ?></span></h3>
  <?php endif; ?>

  <?php if ( !empty($tagName) ) : ?>
    <h3 class="main__map__info__title text-center text-uppercase"><span><?php echo $tagName->name; ?></span></h3>
  <?php endif; ?>

  <?php
    $args = array(
      'parent'     => $ciudad,
    );
    $distritos = get_categories( $args );

    if (count($distritos))
    {
  ?>
  <!-- Select distrito -->
  <div class="form-group visible-xs-block visible-sm-block">

    <select class="frm-ilc__select form-control sel-distrito" data-ciudad="<?php echo $ciudad; ?>">
      <option value="">-- Selecciona Distrito --</option>

      <?php
          foreach ( $distritos as $row ) :
            $selected = '';
            if ( $distrito > 0 )
            {
              $selected = ($distrito == $row->cat_ID) ? 'selected' : $selected;
            }
      ?>
        <option value="<?php echo $row->cat_ID; ?>" <?php echo $selected; ?>><?php echo $row->name; ?></option>
      <?php
          endforeach;
      ?>

    </select>

  <?php } ?>

  </div><!-- end form-group select distrito -->

  <section class="main__map__info__table">

    <?php while ( $the_query->have_posts() ) : ?>
      <?php
        $the_query->the_post();

        $id = get_the_ID();
        $values = get_post_custom( $id );
        $address = ( isset($values['mb_address'][0]) ) ? esc_attr( $values['mb_address'][0] ) : '';
        $phone = ( isset($values['mb_phone'][0]) ) ? esc_attr( $values['mb_phone'][0] ) : '';
        $latitud = ( isset($values['mb_latitud'][0]) ) ? esc_attr( $values['mb_latitud'][0] ) : '';
        $longitud = ( isset($values['mb_longitud'][0]) ) ? esc_attr( $values['mb_longitud'][0] ) : '';
        $horario1 = ( isset($values['mb_horario1'][0]) ) ? esc_attr( $values['mb_horario1'][0] ) : '';
        $horario2 = ( isset($values['mb_horario2'][0]) ) ? esc_attr( $values['mb_horario2'][0] ) : '';
        $horario3 = ( isset($values['mb_horario3'][0]) ) ? esc_attr( $values['mb_horario3'][0] ) : '';

        // Images
        $images = ( isset( $values['mb_images'] ) ) ? $values['mb_images'][0] : '';
        $json = '';

        $data = array(
          'title'    => get_the_title(),
          'address'  => $address,
          'phone'    => $phone,
          'latitud'  => $latitud,
          'longitud' => $longitud,
          'horario1' => $horario1,
          'horario2' => $horario2,
          'horario3' => $horario3,
          'images'   => ''
        );

        if ( !empty($images) )
        {
          $images = unserialize( $images );
          $data['images'] = implode(',', $images);
        }

        $json = implode('|', $data);
      ?>

      <article class="main__map__info__table__item">
        <h4 class="main__map__info__table__item__title text-center"><?php the_title(); ?></h4>
        <p class="main__map__info__table__item__desc text-center"><?php echo $address; ?></p>
        <p class="main__map__info__table__item__desc text-center">PrendaFono: <?php echo $phone; ?></p>
        <p class="text-center main__map__info__table__item__link hidden-xs hidden-sm">
          <button class="js-map-info" data-toggle="modal" data-target="#js-maps" data-info="<?php echo $json; ?>">Ver más</button>
        </p>
      </article><!-- end main__map__info__item -->

    <?php endwhile; ?>

  </section><!-- end main__map__info__table -->

  <?php
    $total = $the_query->max_num_pages;

    if ( $total > 1 )
    {
      $format = '';
  ?>

    <nav class="main__pagination text-center main__pagination--agencias" id="js-pag-maps">

      <?php
        /*if ( $tag > 0 )
        {
          $base = $tag . '/tag';
        }
        elseif ( $distrito > 0 )*/
        if ($distrito > 0)
        {
          $base = $distrito . '/distrito' . '/' . $ciudad;
        }
        else
        {
          $base = $ciudad . '/city';
        }

        echo paginate_links(array(
          'base'      =>    $base,
          'format'    =>    $format,
          'current'   =>    $page,
          'prev_next' =>    True,
          'prev_text' =>    '&laquo;',
          'next_text' =>    '&raquo;',
          'total'     =>    $total,
          'show_all'  =>    TRUE,
          'type'      =>    'list'
        ));
      ?>

    </nav>

  <?php
    }
  ?>
    <span id="js-totalpage" class="hidden"><?php echo $the_query->max_num_pages; ?></span>