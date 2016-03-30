<?php
/**
 * Displays the user interface for the Single Post Meta Manager meta box.
 *
 * This is a partial template that is included by the Single Post Meta Manager
 * Admin class that is used to display all of the information that is related
 * to the post meta data for the given post.
 */
?>
<div id="mb-slides-id">

	<?php $values = get_post_custom(get_the_ID()); ?>

	<?php
        $selected = isset($values['mb_url']) ? esc_attr($values['mb_url'][0]) : '';
        wp_nonce_field('my_meta_box_nonce', 'meta_box_nonce');
    ?>

	<p class="content-mb">
		<label for="mb_url">Seleccione el enlace del slide</label>
		<select name="mb_url" id="mb_url">
			<option value="" <?php selected($selected, ''); ?>>-- Seleccione página de destino --</option>
			<?php
                $args = array(
                    'post_type' => 'page',
                    'post_parent' => 9,
                );
                $the_query = new WP_Query($args);

                if ($the_query->have_posts()) {
                    while ($the_query->have_posts()) {
                        $the_query->the_post();
                        $link = get_permalink();
                        ?>
			<option value="<?php echo $link;
                        ?>" <?php selected($selected, $link);
                        ?>><?php the_title();
                        ?></option>
			<?php

                    }
                }
                wp_reset_postdata();
            ?>
		</select>
	</p>

	<fieldset>
		<legend>Imagen Responsive</legend>
		<?php
            $imgresponsive = isset($values['mb_imgresponsive']) ? esc_attr($values['mb_imgresponsive'][0]) : '';
        ?>

		<div class="container-upload-file">
			<p class="btn-add-file">
				<a title="Agregar archivo" href="javascript:;" class="set-file button button-primary">Añadir imagen</a>
			</p>

			<div class="hidden media-container">

				<img src="<?php echo $imgresponsive; ?>" alt="<?php //echo get_post_meta( $post->ID, 'slider-1-alt', true ); ?>" title="<?php //echo get_post_meta( $post->ID, 'slider-1-title', true ); ?>" />

			</div><!-- .media-container -->

			<p class="hidden">
				<a title="Eliminar archivo" href="javascript:;" class="remove-file button button-secondary">Quitar</a>
			</p>

			<p class="media-info">
				<input class="hd-src" type="hidden" name="mb_imgresponsive" value="<?php echo $imgresponsive; ?>" />
			</p><!-- end .media-info -->
		</div><!-- end container-upload-file -->
	</fieldset>

</div><!-- #single-post-meta-manager -->