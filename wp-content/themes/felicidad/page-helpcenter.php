<?php
	/*
	 *	Template Name: Page Help Center
	 */
?>

<?php get_header(); ?>

	<main class="main">
        <div class="container">
          	<section class="main__header">
            	<div class="row">

					<?php if (have_posts()) : while(have_posts()) : the_post(); ?>

              		<div class="col-sm-6">
                		<div class="main__header__info">

                			<?php $title = get_the_title(); ?>

							<h2 class="main__header__info__title text-uppercase"><?php echo separteTitle($title); ?></h2>

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
                			?>
                		</figure><!-- end main__header__figure -->
              		</div><!-- end col-sm-6 -->

              		<?php endwhile; endif; ?>
            	</div><!-- end row -->
          	</section><!-- end main__header -->

          	<!-- MAIN__CONTENT -->
          	<section class="main__content">

				<div class="row">
					<div class="col-md-4">

						<article class="main__content__help">
							<a href="#" data-toggle="modal" data-target="#js-escribenos" data-type="Consultas">
								<figure class="main__content__help__figure main__content__help__figure--consulta"></figure><!-- end main__content__help__figure -->
								<div class="main__content__help__info">
									<h3 class="h4">Consúltanos</h3>
									<p>Si estas interesado(a) en alguno de nuestros servicios o tienes alguna inquietud sobre ellos haz clic aquí.</p>
								</div><!-- end main__content__help__info -->
							</a>
						</article><!-- end main__content__help -->

					</div><!-- end col-md-4 -->
					<div class="col-md-4">

						<article class="main__content__help">
							<a href="#" data-toggle="modal" data-target="#js-escribenos" data-type="Sugerencias">
								<figure class="main__content__help__figure main__content__help__figure--sugerencia"></figure><!-- end main__content__help__figure -->
								<div class="main__content__help__info">
									<h3 class="h4">Sugerencias</h3>
									<p>Ayúdanos a crecer y mejorar los servicios que te brindamos. Haz tu sugerencia aquí</p>
								</div><!-- end main__content__help__info -->
							</a>
						</article><!-- end main__content__help -->

					</div><!-- end col-md-4 -->
					<div class="col-md-4">

						<article class="main__content__help">
                  			<a href="http://reclamos.inversioneslacruz.com/" target="_blank">
							<!-- <a href="<?php // echo home_url('libro-de-reclamaciones'); ?>"> -->
								<figure class="main__content__help__figure main__content__help__figure--reclamo"></figure><!-- end main__content__help__figure -->
								<div class="main__content__help__info">
									<h3 class="h4">Reclamos</h3>
									<p>Para reclamos o quejas sobre cualquiera de nuestros servicios haz clic aquí.</p>
								</div><!-- end main__content__help__info -->
							</a>
						</article><!-- end main__content__help -->

					</div><!-- end col-md-4 -->
				</div><!-- end row -->

          	</section><!-- end main__content -->

        </div><!-- end container -->
    </main><!-- end main -->

    <!-- Formulario de contacto -->
    <?php include_once( TEMPLATEPATH . '/includes/contact.php' ); ?>

<?php get_footer(); ?>