	<?php
		$args = array(
			'post_type'		=>	'promociones',
		);

		$the_query = new WP_Query($args);
		if ($the_query->have_posts()) :
			// while ($the_query->have_posts()) : $the_query->the_post();
	?>

	<aside class="sidebar-right hidden-xs hidden-sm">

    <ul class="sidebar-right__list">
      <li class="sidebar-right__list__item sidebar-right__list__item--promo">

        <a href="#" class="text-hide" id="js-promo">Promoción</a>

        <div id="carousel-promociones" class="carousel slide sidebar-right__list__item__promo" data-interval="2000">
        <!-- <div id="carousel-promociones" class="carousel slide sidebar-right__list__item__promo" data-ride="carousel" data-interval="2000"> -->
          <div class="carousel-inner" role="listbox">

            <?php $i = 0; ?>
            <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>

              <?php
                $active = ( $i == 0 ) ? 'active' : '';

                $id = get_the_ID();
                $values = get_post_custom( $id );
                $link = isset($values['mb_url'][0]) ? $values['mb_url'][0] : '';
              ?>

              <div class="item <?php echo $active; ?>">

                <?php if (!empty($link)) : ?>
                  <a href="http://<?php echo $link; ?>" title="<?php the_title(); ?>" target="_blank">
                <?php endif; ?>

                <?php
                  if ( has_post_thumbnail() )
                  {
                    $attr = array(
                      'class' => 'img-responsive'
                    );
                    the_post_thumbnail('full', $attr);
                  }
                ?>

                <?php if (!empty($link)) : ?>
                  </a>
                <?php endif; ?>

              </div><!-- end item -->

              <?php $i++; ?>
            <?php endwhile; ?>

          </div><!-- end carousel-inner -->
        </div><!-- end sidebar-right__list__item__promo -->

      </li>

      <!-- <li class="sidebar-right__list__item sidebar-right__list__item--felicidad">
        <a href="<?php //echo home_url('la-felicidad-en-minutos'); ?>" class="text-hide">La Felicidad</a>
      </li> -->

      <!-- <li class="sidebar-right__list__item sidebar-right__list__item--chat">
        <a href="#" class="text-hide">Chat</a>
      </li> -->
    </ul>

  </aside><!-- end sidebar-right -->

    <?php
    		// endwhile;
    	endif;
    	wp_reset_postdata();
    ?>