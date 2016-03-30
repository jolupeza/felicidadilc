<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('links-home')) : ?>

	<article class="main__links__item">

		<figure class="main__links__item__figure">
			<img src="http://lorempixel.com/183/114" class="img-responsive" alt="" />
		</figure><!-- end main__links__item__figure -->
		<div class="main__links__item__content">
			<h3 class="text-uppercase"><a href="<?php home_url(); ?>"><?php bloginfo('title'); ?></a></h3>
			<p><?php bloginfo('description'); ?></p>
		</div><!-- end main__links__item__content -->

	</article><!-- end main__links__item -->

<?php endif; ?>