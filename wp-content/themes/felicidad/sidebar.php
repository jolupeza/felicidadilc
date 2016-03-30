<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('main-sidebar')) : ?>

	<article class="main__services__service main__services__service--yellow">

		<h2 class="main__services__service__text"><?php bloginfo('title'); ?></h2>
		<p><?php bloginfo('description'); ?></p>

	</article><!-- end main__services__service -->

<?php endif; ?>