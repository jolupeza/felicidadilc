<?php
/**
 * Displays the user interface for the Ilc Manager meta box.
 *
 * This is a partial template that is included by the Ilc Manager
 * Admin class that is used to display all of the information that is related
 * to the page meta data for the given page.
 */
?>
<div id="mb-jobs-id">

	<?php $values = get_post_custom(get_the_ID()); ?>

	<?php
        $vacantes = isset($values['mb_vacantes']) ? esc_attr($values['mb_vacantes'][0]) : '';
        $date_due = isset($values['mb_date_due']) ? esc_attr($values['mb_date_due'][0]) : '';
        wp_nonce_field('my_meta_box_nonce', 'meta_box_nonce');
    ?>


	<p class="content-mb">
		<label for="mb_vacantes">Vacantes:</label>
		<input type="text" name="mb_vacantes" id="mb_vacantes" value="<?php echo $vacantes; ?>" />
	</p>

	<p class="content-mb">
		<label for="mb_date_due">Disponibilidad:</label>
	    <input type="date" name="mb_date_due" id="mb_date_due" value="<?php echo $date_due; ?>" />
	</p>

</div><!-- #single-post-meta-manager -->