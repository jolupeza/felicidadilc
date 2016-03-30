<?php
	/*
	 *	Template Name: Page Transparencia
	 */
?>

<?php get_header(); ?>

		<main class="main">

			<?php if ( !is_page( 'transparencia-de-informacion' ) ) : ?>

				<nav class="menu-trans">

					<?php
						wp_nav_menu(
							array(
								'theme_location' => 'transparency-movil-menu',
								'menu_class' => 'menu list-inline'
							)
						);
					?>

				</nav>

			<?php endif; ?>

	        <div class="container">
	          	<section class="main__header main__header--movil">
	            	<div class="row">

		            	<?php if ( is_page( 'transparencia-de-informacion' )) : ?>

		            		<?php if (have_posts()) : while(have_posts()) : the_post(); ?>

		            			<div class="col-sm-6">
			                		<div class="main__header__info">

										<h2 class="main__header__info__title text-uppercase"><?php echo separteTitle(get_the_title(get_the_ID())); ?></h2>

										<div class="hidden-xs">
											<?php the_content(); ?>
										</div>

			                		</div><!-- end main__header__info -->
			              		</div><!-- end col-sm-6 -->
			              		<div class="col-sm-6 hidden-xs">
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

							<?php endwhile; endif; ?><!-- Fin Loop Principal -->

						<?php endif; ?>

	            	</div><!-- end row -->
	          	</section><!-- end main__header -->

	          	<?php
	          		$args = array(
						'sort_column' => 'menu_order',
						'parent'      => '251'
						// 'parent'      => '238'
	          		);
	          		$pages = get_pages( $args );
	          	?>

				<?php if ( is_page( 'transparencia-de-informacion' ) ) : ?>

					<?php if ( count($pages) ) : ?>

			          	<h2 class="text-uppercase text-center main__title main__title--blue"><span>Te informamos sobre</span></h2>

			          	<!-- Web -->
			          	<section class="main__page__tabs hidden-xs hidden-sm" role="tabpanel">

							<ul class="main__page__tabs__list list-inline" role="tablist">

							<?php foreach ( $pages as $page ) : ?>

								<li role="presentation" class="main__page__tabs__item main__page__tabs__item--<?php echo $page->post_name; ?>">
									<a class="text-uppercase" href="#<?php echo $page->post_name; ?>" aria-controls="<?php echo $page->post_name; ?>" role="tab" data-toggle="tab"><?php echo $page->post_title ?></a>
								</li><!-- end main__page__tabs__item -->

							<?php endforeach; ?>

							</ul><!-- end main__page__tabs__list -->

							<div class="tab-content">

							<?php foreach ( $pages as $page ) : ?>

								<article role="tabpanel" class="tab-pane fade main__page__tabs__content" id="<?php echo $page->post_name; ?>">

									<?php echo $page->post_content; ?>

								</article><!-- end main__page__tabs__content -->

							<?php endforeach; ?>

							</div>

			          	</section><!-- end man__page__tabs -->

						<!-- Movil -->
						<nav class="subpage-trans visible-xs-block visible-sm-block">

		          			<ul class="main__page__tabs__list">

							<?php foreach ( $pages as $page ) : ?>

								<li class="main__page__tabs__item main__page__tabs__item--<?php echo $page->post_name; ?>">
									<a class="text-uppercase" href="<?= get_permalink( $page->ID ); ?>"><?php echo $page->post_title ?></a>
								</li><!-- end main__page__tabs__item -->

							<?php endforeach; ?>

							</ul><!-- end main__page__tabs__list -->

		          		</nav><!-- end subpage-trans -->

      				<?php endif; ?>

				<?php else : ?>

					<?php if (have_posts()) : while(have_posts()) : the_post(); ?>

			          	<h2 class="text-uppercase text-center main__title main__title--blue"><span><?php the_title(); ?></span></h2>

						<article class="main__page__tabs__content">

							<?php the_content(); //echo $page->post_content; ?>

						</article><!-- end main__page__tabs__content -->

					<?php endwhile; endif; ?>

          		<?php endif; ?>

	        </div><!-- end container -->
	    </main><!-- end main -->

<?php get_footer(); ?>