<?php
/**
 * Displays the user interface for the Ilc Manager meta box.
 *
 * This is a partial template that is included by the Ilc Manager
 * Admin class that is used to display all of the information that is related
 * to the page meta data for the given page.
 */
?>
<div id="mb-page-id">

	<?php $values = get_post_custom(get_the_ID()); ?>

	<?php
        $catSlide = isset($values['mb_catslide']) ? esc_attr($values['mb_catslide'][0]) : '';
        wp_nonce_field('my_meta_box_nonce', 'meta_box_nonce');
    ?>

	<p class="content-mb">
		<label for="mb_url">Seleccione categoría de slide</label>
		<select name="mb_catslide" id="mb_catslide">
			<option value="" <?php selected($catSlide, ''); ?>>-- Seleccione página de destino --</option>

			<?php
                $args = array(
                    'parent' => 6,
                    'hide_empty' => 0,
                );
                $categories = get_categories($args);

                foreach ($categories as $cat) {
                    ?>

			<option value="<?php echo $cat->cat_ID;
                    ?>" <?php selected($catSlide, $cat->cat_ID);
                    ?>><?php echo $cat->cat_name;
                    ?></option>

			<?php

                }
            ?>

		</select>
	</p>

	<!-- Sobre el servicio -->
	<fieldset>
		<legend>Sobre el servicio</legend>
		<?php
            $about = isset($values['mb_about']) ? esc_attr($values['mb_about'][0]) :  '';
            $imgAbout = isset($values['mb_imgabout']) ? esc_attr($values['mb_imgabout'][0]) : '';
        ?>
		<p>
			<label for="mb_about"></label>
			<textarea name="mb_about" id="mb_about" rows="5"><?php echo $about ?></textarea>
		</p>

		<div class="container-upload-file">
			<p class="btn-add-file">
				<a title="Agregar archivo" href="javascript:;" class="set-file button button-primary">Añadir imagen</a>
			</p>

			<div class="hidden media-container">

				<img src="<?php echo $imgAbout; ?>" alt="<?php //echo get_post_meta( $post->ID, 'slider-1-alt', true ); ?>" title="<?php //echo get_post_meta( $post->ID, 'slider-1-title', true ); ?>" />

			</div><!-- .media-container -->

			<p class="hidden">
				<a title="Eliminar archivo" href="javascript:;" class="remove-file button button-secondary">Quitar</a>
			</p>

			<p class="media-info">
				<input class="hd-src" type="hidden" name="mb_imgabout" value="<?php echo $imgAbout; ?>" />
			</p><!-- end .media-info -->
		</div><!-- end container-upload-file -->
	</fieldset>

	<!-- ¿Qué necesito? -->
	<fieldset>
		<legend>¿Qué necesito?</legend>
		<?php
            $need = isset($values['mb_need']) ? esc_attr($values['mb_need'][0]) :  '';
            /*$fileNeed = isset( $values['mb_fileneed'] ) ? esc_attr( $values['mb_fileneed'][0] ) : '';

            $title = explode( '/', $fileNeed );
            $title = $title[ count($title) - 1 ];*/
        ?>
		<p>
			<label for="mb_need"></label>
			<textarea name="mb_need" id="mb_need" rows="5"><?php echo $need ?></textarea>
		</p>
	</fieldset>

	<!-- Documentos -->
	<fieldset>
		<legend>Documentos</legend>
		<?php
            $doc = isset($values['mb_doc']) ?  $values['mb_doc'][0]  :  '';
        ?>
		<p>
			<label for="mb_doc"></label>

		<?php
            $settings = array(
                'wpautop' => false,
                'textarea_name' => 'mb_doc',
                'media_buttons' => false,
                'textarea_rows' => 10,
            );
            wp_editor($doc, 'mb_doc', $settings);
        ?>

		</p>
	</fieldset>

	<?php /*
    <!-- Tarifario -->
    <fieldset>
        <legend>Tarifario</legend>
        <?php
            $total = 4;
            $tarifario = isset( $values['mb_tarifario'] ) ? esc_attr( $values['mb_tarifario'][0] ) :  '';
        ?>
        <p>
            <label for="mb_tarifario"></label>
            <textarea name="mb_tarifario" id="mb_tarifario" rows="5"><?php echo $tarifario; ?></textarea>
        </p>

        <?php
            $count = 0;
            $fileTarifario = isset( $values['mb_filetarifario'] ) ? $values['mb_filetarifario'][0] : '';
            if ( !empty($fileTarifario) )
            {
                $newFileTarifario = unserialize( $fileTarifario );
                $count = count($newFileTarifario);

                foreach ($newFileTarifario as $ft) :
                    $title = explode( '/', $ft);
                    $title = $title[ count($title) - 1 ];
        ?>
            <div class="container-upload-file">
                <p class="btn-add-file">
                    <a title="Agregar archivo" href="javascript:;" class="set-file button button-primary">Añadir PDF</a>
                </p>

                <div class="hidden media-container">
                    <p>
                        <span class="dashicons dashicons-media-default"></span>
                        <span class="name"><?php echo $title; ?></span>
                    </p>
                </div><!-- .media-container -->

                <p class="hidden">
                    <a title="Eliminar archivo" href="javascript:;" class="remove-file button button-secondary">Quitar PDF</a>
                </p>

                <p class="media-info">
                    <input class="hd-src" type="hidden" name="mb_filetarifario[]" value="<?php echo $ft; ?>" />
                </p><!-- end .media-info -->
            </div><!-- end container-upload-file -->
        <?php
                endforeach;
            }
        ?>

        <?php
            if ( $count < $total )
            {
                for ( $i = 0; $i < ($total - $count); $i++ )
                {
        ?>
                <div class="container-upload-file">
                    <p class="btn-add-file">
                        <a title="Set Slider Image" href="javascript:;" class="set-file button button-primary">Añadir PDF</a>
                    </p>

                    <div class="hidden media-container">
                        <p>
                            <span class="dashicons dashicons-media-default"></span>
                            <span class="name"></span>
                        </p>
                    </div><!-- .media-container -->

                    <p class="hidden">
                        <a title="Eliminar archivo" href="javascript:;" class="remove-file button button-secondary">Quitar PDF</a>
                    </p>

                    <p class="media-info">
                        <input class="hd-src" type="hidden" name="mb_filetarifario[]" value="" />
                    </p><!-- end .media-info -->
                </div><!-- end container-upload-file -->
        <?php
                }
            }
        ?>
    </fieldset>
    */ ?>

	<!-- Questions -->
	<fieldset>
		<legend>Preguntas</legend>
		<?php
            $questions = isset($values['mb_questions']) ? $values['mb_questions'][0] :  '';
        ?>
		<p>
			<label for="mb_questions"></label>

		<?php
            wp_editor($questions, 'mb_questions', array('textarea_name' => 'mb_questions', 'media_buttons' => false));
        ?>
		</p>
	</fieldset>

	<?php
        $videodo = isset($values['mb_videodo']) ? esc_attr($values['mb_videodo'][0]) : '';
    ?>
	<p class="content-mb">
		<label for="mb_videodo">Id del Video: </label>
		<input type="text" name="mb_videodo" id="mb_videodo" value="<?php echo $videodo; ?>" />
	</p>

</div><!-- #single-post-meta-manager -->