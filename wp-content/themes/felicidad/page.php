<?php get_header(); ?>

		<main class="main">
	        <div class="container">
	          	<section class="main__header">
	            	<div class="row">

						<?php if (have_posts()) : while(have_posts()) : the_post(); ?>

	              		<div class="col-sm-6">
	                		<div class="main__header__info">

	                			<?php the_content(); ?>

	                		</div><!-- end main__header__info -->
	              		</div><!-- end col-sm-6 -->
	              		<div class="col-sm-6">
	                		<figure class="main__header__figure">
	                			<?php
	                				if (has_post_thumbnail())
	                				{
	                					$attr = array('class' => 'img-responsive');
	                					the_post_thumbnail('full', $attr);
	                				}
	                				else
	                				{
	                  					echo '<img src="http://lorempixel.com/555/278" alt="" class="img-responsive">';
	                				}
	                			?>
	                		</figure><!-- end main__header__figure -->
	              		</div><!-- end col-sm-6 -->

	              		<?php endwhile; endif; ?>
	            	</div><!-- end row -->
	          	</section><!-- end main__header -->

	          	<h2 class="text-uppercase text-center main__title main__title--blue"><span>Nos caracterizamos por</span></h2>

				<?php
					$args = array(
						'post_type'   => 'page',
						'post_parent' => 7,
						'orderby'     => 'menu_order',
						'order'       => 'ASC'
					);

					$the_query = new WP_Query($args);

              		if ($the_query->have_posts()) :
				?>
	          	<!-- MAIN__CONTENT -->
	          	<section class="main__content">
					<?php
						$countItems = $the_query->post_count;
						$mitad = ceil( $countItems / 2 );
					?>

	            	<article class="main__content__column">
	              		<ul class="main__content__column__list">

						<?php for ( $i = 0; $i < $mitad; $i++) : ?>

			                <li class="main__content__column__list__item">
			                  	<div class="main__content__column__list__item__text">
			                    	<h4 class="main__content__column__list__item__text__title text-uppercase"><?php echo $the_query->posts[$i]->post_title; ?></h4>
			                    	<p><?php echo $the_query->posts[$i]->post_content; ?></p>
			                  	</div>
			                  	<figure class="main__content__column__list__item__figure">
				                  	<?php
				                  		$image = get_the_post_thumbnail($the_query->posts[$i]->ID, 'full', array( 'class' => 'img-responsive' ));
				                  		echo $image;
				                  	?>
			                  	</figure><!-- end main__content__column__list__item__figure -->
			                </li><!-- end main__content__column__list__item -->

			            <?php endfor; ?>

	              		</ul><!-- end main_content__column__list -->
	            	</article><!-- end main__content__column -->

		            <article class="main__content__column">
		              	<ul class="main__content__column__list">

		              		<?php for ( $i = $mitad; $i < $countItems; $i++) : ?>

			                <li class="main__content__column__list__item">
			                  <figure class="main__content__column__list__item__figure">
			                    <?php
			                  		$image = get_the_post_thumbnail($the_query->posts[$i]->ID, 'full', array( 'class' => 'img-responsive' ));
			                  		echo $image;
			                  	?>
			                  </figure><!-- end main__content__column__list__item__figure -->
			                  <div class="main__content__column__list__item__text">
			                    <h4 class="main__content__column__list__item__text__title text-uppercase"><?php echo $the_query->posts[$i]->post_title; ?></h4>
			                    <p><?php echo $the_query->posts[$i]->post_content; ?></p>
			                  </div>
			                </li><!-- end main__content__column__list__item -->

			            	<?php endfor; ?>

		              	</ul><!-- end main_content__column__list -->
		            </article><!-- end main__content__column -->

	          	</section><!-- end main__content -->
	          	<?php endif; wp_reset_postdata(); ?>

				<?php
					$args = array(
						'post_type'      =>	'casos',
						'posts_per_page' => 2
					);

					$the_query = new WP_Query($args);
					if ($the_query->have_posts()) :
				?>
	          	<!-- MAIN__CASOS -->
	          	<aside class="main__casos">
		            <h2 class="text-uppercase main__title main__title--blue"><span>Casos de éxito</span></h2>
		            <div class="row">

						<?php while ($the_query->have_posts()) : $the_query->the_post(); ?>

			              	<div class="col-sm-6">
				                <article class="main__casos__item">
				                  	<figure class="main__casos__item__figure">
									<?php
										if (has_post_thumbnail())
										{
											$attr = array( 'class' => 'img-responsive' );
											the_post_thumbnail('thumbnail', $attr);
										}
										else
										{
									?>
				                  		<img src="http://lorempixel.com/166/166" class="img-responsive" />
				                  	<?php } ?>
				                  	</figure>
				                  	<div class="main__casos__item__text">
					                    <h5 class="main__casos__item__text__title text-uppercase"><?php the_title(); ?></h5>

										<?php $cargo = get_the_excerpt(); ?>
					                    <h6 class="main__casos__item__text__subtitle text-uppercase"><?php echo $cargo; ?></h6>

					                    <?php the_content(); ?>

				                  	</div><!-- end main__casos__item__text -->
				                </article><!-- end main__casos__item -->
			            	</div><!-- end col-sm-6 -->

		            	<?php endwhile; ?>

		            </div><!-- endrow -->
	          	</aside><!-- end man__casos -->

	            <?php endif; wp_reset_postdata(); ?>

	        </div><!-- end container -->
	    </main><!-- end main -->

<?php get_footer(); ?>