<?php
/**
 * Displays the user interface for the Single Post Meta Manager meta box.
 *
 * This is a partial template that is included by the Single Post Meta Manager
 * Admin class that is used to display all of the information that is related
 * to the post meta data for the given post.
 */
?>
<div id="mb-promociones-id">

	<?php $values = get_post_custom(get_the_ID()); ?>

	<?php
        $url = isset($values['mb_url']) ? esc_attr($values['mb_url'][0]) : '';
        wp_nonce_field('my_meta_box_nonce', 'meta_box_nonce');
    ?>

	<p class="content-mb">
		<label for="mb_url">Url Link:</label>
		<input type="text" name="mb_url" id="mb_url" value="<?php echo $url; ?>" />
	</p>

</div><!-- #single-post-meta-manager -->