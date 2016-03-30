<?php
	// Post anterior
	$prev_post = get_previous_post();

	if (!empty( $prev_post ))
	{
?>

	<article class="main__blog__item">
		<figure class="main__blog__item__figure">
			<?php
				$thumbnail = get_the_post_thumbnail( $prev_post->ID, 'full', array('class' => 'img-responsive') );

				if ( !empty($thumbnail) )
				{
					echo $thumbnail;
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

			<?php
				$date =  $prev_post->post_date;
				$month = date( 'n', strtotime($date) );
				$day = date( 'd', strtotime($date) );
			?>

		<aside class="main__blog__item__content__date">
			<span class="main__blog__item__content__date__month text-uppercase"><?php echo $months[ $month - 1 ]; ?></span>
			<span class="main__blog__item__content__date__day"><?php echo $day; ?></span>
		</aside>

		<h2 class="main__blog__item__content__title"><?php echo $prev_post->post_title; ?></h2>

		<p class="main__blog__item__content__text">
			<?php
				echo getSubString($prev_post->post_content, 200);
			?>
		</p>

		<?php
			$permalink = get_permalink( $prev_post->ID );
		?>

		<p class="main__blog__item__content__link"><a href="<?php echo $permalink; ?>">Seguir leyendo &raquo;</a></p>

		</div><!-- end main__blog__item__content -->
	</article><!-- end main__blog___item -->

<?php
	}

	// Post siguiente
	$next_post = get_next_post();

	if (!empty( $next_post ))
	{
?>

	<article class="main__blog__item">
		<figure class="main__blog__item__figure">
			<?php
				$thumbnail = get_the_post_thumbnail( $next_post->ID, 'full', array('class' => 'img-responsive') );

				if ( !empty($thumbnail) )
				{
					echo $thumbnail;
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

			<?php
				$date =  $next_post->post_date;
				$month = date( 'n', strtotime($date) );
				$day = date( 'd', strtotime($date) );
			?>

		<aside class="main__blog__item__content__date">
			<span class="main__blog__item__content__date__month text-uppercase"><?php echo $months[ $month - 1 ]; ?></span>
			<span class="main__blog__item__content__date__day"><?php echo $day; ?></span>
		</aside>

		<h2 class="main__blog__item__content__title"><?php echo $next_post->post_title; ?></h2>

		<p class="main__blog__item__content__text">
			<?php
				echo getSubString($next_post->post_content, 200);
			?>
		</p>

		<?php
			$permalink = get_permalink( $next_post->ID );
		?>

		<p class="main__blog__item__content__link"><a href="<?php echo $permalink; ?>">Seguir leyendo &raquo;</a></p>

		</div><!-- end main__blog__item__content -->
	</article><!-- end main__blog___item -->

<?php
	}
?>