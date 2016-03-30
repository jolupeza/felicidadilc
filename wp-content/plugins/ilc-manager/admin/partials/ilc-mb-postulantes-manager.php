<?php
/**
 * Displays the user interface for the Ilc Manager meta box.
 *
 * This is a partial template that is included by the Ilc Manager
 * Admin class that is used to display all of the information that is related
 * to the page meta data for the given page.
 */
?>
<div id="mb-postulantes-id">

	<?php $values = get_post_custom(get_the_ID()); ?>

	<?php
            $name = isset($values['mb_name']) ? esc_attr($values['mb_name'][0]) : '';
            $tel = isset($values['mb_tel']) ? esc_attr($values['mb_tel'][0]) : '';
            $email = isset($values['mb_email']) ? esc_attr($values['mb_email'][0]) : '';
            $cv = isset($values['mb_cv']) ? esc_attr($values['mb_cv'][0]) : '';
            $jobs = isset($values['mb_jobs']) ? $values['mb_jobs'][0] : '';

            wp_nonce_field('my_meta_box_nonce', 'meta_box_nonce');
    ?>

	<p class="content-mb">
		<label for="mb_name">Nombre completo:</label>
		<input type="text" name="mb_name" id="mb_name" value="<?php echo $name; ?>" />
	</p>

	<p class="content-mb">
		<label for="mb_tel">Teléfono o celular:</label>
		<input type="text" name="mb_tel" id="mb_tel" value="<?php echo $tel; ?>" />
	</p>

	<p class="content-mb">
		<label for="mb_email">Email:</label>
		<input type="email" name="mb_email" id="mb_email" value="<?php echo $email; ?>" />
	</p>

	<p class="content-mb">
		<label for="mb_cv">CV:</label>
		<input type="text" name="mb_cv" id="mb_cv" value="<?php echo $cv; ?>" />
	</p>

	<div class="content-mb">
		<label for="mb_jobs">Puestos:</label>
		<?php
                    if (!empty($jobs)) {
                        $jobs = unserialize($jobs);
                        ?>
		<ul>
		<?php
                        foreach ($jobs as $key => $value) {
                            $jobInfo = get_post($key);
                            ?>
			<li>
				<input type="checkbox" id="mb_jobs_<?php echo $key;
                            ?>" name="mb_jobs[<?php echo $key;
                            ?>]" <?php checked($value, 'on');
                            ?> />
				<label for="mb_jobs_<?php echo $key;
                            ?>"><?php echo $jobInfo->post_title;
                            ?></label>
			</li>
		<?php

                        }
                        ?>
		</ul>
		<?php

                    } else {
                        ?>
			Convocatoria General
		<?php

                    }
        ?>
	</div>

</div><!-- #single-post-meta-manager -->