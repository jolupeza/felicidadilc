<?php get_header(); ?>

	<main class="main">
        <div class="container">
			<div class="row">
				<section class="margin-top">
					<div class="col-md-4 hidden-xs hidden-sm">

						<?php include(TEMPLATEPATH . '/includes/posts-single.php'); ?>

					</div><!-- end col-md-4 -->

					<div class="col-md-8">

						<section class="main__single">

						<?php if (have_posts()) : while(have_posts()) : the_post(); ?>

							<figure class="main__single__figure">
							<?php
								if ( has_post_thumbnail() )
								{
									$attr = array( 'class' => 'img-responsive' );
									the_post_thumbnail( 'full', $attr );
								}
								else
								{
							?>
								<img class="img-responsive" src="http://lorempixel.com/750/375" alt="" />
							<?php
								}
							?>
							</figure><!-- end main__single__figure -->

							<div class="main__single__content">
								<aside class="main__blog__item__content__date"><span class="main__blog__item__content__date__month text-uppercase"><?php the_time( 'M' ); ?></span> <span class="main__blog__item__content__date__day"><?php the_time( 'd' ); ?></span></aside>

								<h2 class="main__single__content__title"><?php the_title(); ?></h2>
								<?php the_content(); ?>
							</div><!-- end main__single__content -->

						<?php endwhile; endif; ?>

							<aside class="comments-area" id="comments">

								<?php comments_template('', true); ?>

							</aside><!-- end comments -->

						</section>

					</div><!-- end col-md-8 -->
				</section><!-- end margin-top -->
			</div><!-- end row -->
        </div><!-- end container -->
    </main><!-- end main -->

<?php get_footer(); ?>