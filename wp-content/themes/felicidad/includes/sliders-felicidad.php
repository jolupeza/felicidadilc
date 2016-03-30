	<?php
		$args = array(
			'post_type'     => 'slides',
			'orderby'       => 'menu_order',
			'order'         => 'ASC'
		);

		$the_query = new WP_Query($args);
		$totalSliders = 0;

		if ($the_query->have_posts()) :
			$totalSliders = count($the_query->posts);
	?>

	    <div id="main-slide" class="carousel slide" data-ride="carousel">
	        <ol class="carousel-indicators slide__indicators">
	        	<?php $i = 0; ?>
		    	<?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
		    		<?php $active = ($i == 0) ? 'active' : ''; ?>

	          	<li data-target="#main-slide" data-slide-to="<?php echo $i; ?>" class="<?php echo $active; ?>"></li>

	          	<?php $i++; ?>
		    	<?php endwhile; ?>
	        </ol>

	        <div class="carousel-inner" role="listbox">
	        	<?php $i = 0; ?>
		    	<?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
		    		<?php
		    			$id = get_the_ID();
		    			$values = get_post_custom( $id );

		    			$active = ($i == 0) ? 'active' : '';
		    		?>
		        <div class="item <?php echo $active; ?> slide__item">

				<?php
					if (has_post_thumbnail())
					{
						$imgresponsive = isset( $values['mb_imgresponsive'] ) ? esc_attr( $values['mb_imgresponsive'][0] ): '';

						$post_thumb_id = get_post_thumbnail_id( $id );
						$post_thumb_src = wp_get_attachment_image_src( $post_thumb_id, 'full' );
				?>

					<picture>
						<!--[if IE 9]><video style="display: none;"><![endif]-->
						<source class="img-responsive" srcset="<?php echo $imgresponsive; ?>" media="(max-width: 991px)" />

						<!--[if IE 9]></video><![endif]-->
						<img srcset="<?php echo $post_thumb_src[0]; ?>" alt="" class="img-responsive" />
					</picture><!-- end picture -->

				<?php
					}
					else
					{
				?>

					<picture>
						<!--[if IE 9]><video style="display: none;"><![endif]-->
						<source class="img-responsive" srcset="http://lorempixel.com/991/430" media="(max-width: 991px)" />

						<!--[if IE 9]></video><![endif]-->
						<img srcset="http://lorempixel.com/1920/480" alt="" class="img-responsive" />
					</picture><!-- end picture -->

				<?php } ?>

				<?php $content = get_the_content(); ?>

				<?php if ( !empty($content) ) : ?>

		            <div class="carousel-caption slide__item__caption">
						<h2 class="text-uppercase text-center slide__item__caption__text">

						<?php
							$link = isset($values['mb_url'][0]) ? $values['mb_url'][0] : '';

							if (!empty($link)) {
						?>

						<a href="<?php echo $link; ?>">
						  <?php the_content(); ?>
						</a>

						<?php
							}
							else
							{
								the_content();
							}
						?>

						</h2>
		            </div><!-- end slide__item__caption -->

				<?php endif; ?>

		        </div>
		        <?php $i++; ?>
		    	<?php endwhile; ?>
	        </div><!-- end carousel-inner -->

			<?php if($totalSliders > 1) : ?>
		        <!-- Controls -->
		        <a class="left carousel-control slide__control slide__control--left" href="#main-slide" role="button" data-slide="prev">
		          <span aria-hidden="true"></span>
		        </a>
		        <a class="right carousel-control slide__control slide__control--right" href="#main-slide" role="button" data-slide="next">
		          <span aria-hidden="true"></span>
		        </a>
		    <?php endif; ?>
	    </div><!-- end slide -->

	<?php else : ?>

		<div class="container">
			<div class="row">
				<div class="col-xs-12"><p class="alert alert-danger text-center margin-top">No hay slider</p></div>
			</div><!-- end row -->
		</div><!-- end container -->

	<?php endif; wp_reset_postdata(); ?>