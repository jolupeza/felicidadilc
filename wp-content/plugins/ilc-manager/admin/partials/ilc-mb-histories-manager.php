<?php
/**
 * Displays the user interface for the Ilc Manager meta box.
 *
 * This is a partial template that is included by the Ilc Manager
 * Admin class that is used to display all of the information that is related
 * to the page meta data for the given page.
 */
?>
<div id="mb-histories-id">

	<?php
        $values = get_post_custom(get_the_ID());
        $video = isset($values['mb_video']) ? esc_attr($values['mb_video'][0]) : '';
        wp_nonce_field('histories_meta_box_nonce', 'meta_box_nonce');
    ?>

	<p class="content-mb">
		<label for="mb_video">Id Video:</label>
		<input type="text" name="mb_video" id="mb_video" value="<?php echo $video; ?>" />
	</p>

</div><!-- #single-post-meta-manager -->