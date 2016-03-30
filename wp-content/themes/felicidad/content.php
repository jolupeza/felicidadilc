<?php
/**********************************************************************************/
/* Template for the default post format */
/**********************************************************************************/
?>

	<!-- <div class="col-sm-6 col-md-4"> -->

		<article class="main__blog__item" id="post-<?php the_ID(); ?>">
  			<figure class="main__blog__item__figure">
  				<?php
  					if ( has_post_thumbnail() )
  					{
  						$attr = array( 'class' => 'img-responsive' );

  						the_post_thumbnail('full', $attr);
  					}
  					else
  					{
  				?>
    				<img class="img-responsive" src="http://lorempixel.com/358/179" alt="" />
    			<?php
    				}
    			?>
  			</figure><!-- end main__blog__item__figure -->

  			<div class="main__blog__item__content">

    			<aside class="main__blog__item__content__date"><span class="main__blog__item__content__date__month text-uppercase"><?php the_time( 'M' ); ?></span> <span class="main__blog__item__content__date__day"><?php the_time( 'd' ); ?></span></aside>
    			<h2 class="main__blog__item__content__title"><?php the_title(); ?></h2>

    			<?php the_content('...'); ?>

    			<p class="main__blog__item__content__link"><a href="<?php the_permalink(); ?>">Seguir leyendo &raquo;</a></p>

  			</div><!-- end main__blog__item__content -->
		</article><!-- end main__blog___item -->

	<!-- </div> --><!-- end col-sm-4 -->