<?php get_header(); ?>

	<?php include_once( TEMPLATEPATH . '/includes/sliders-felicidad.php'); ?>

	<main class="main">
        <div class="container">
        	<?php
        		$thisCat = get_category(2);
        	?>

			<section class="Felicidad">

				<?php
					$args = array(
						'post_type' => 'histories',
						'order'     => 'ASC',
						'orderby'   => 'menu_order'
					);
					$the_query = new WP_Query($args);
					$firstVideo = '';
					if ($the_query->have_posts()) :
						$i = 0;
				?>
					<h2 class="Felicidad-title text-center"><span>Historias de Felicidad</span></h2>

					<section class="Felicidad-histories">

						<div class="Felicidad-histories-buttons">

							<?php while($the_query->have_posts()) : $the_query->the_post(); ?>
								<?php
									$id = get_the_ID();
									$values = get_post_custom($id);
									$video = (isset($values['mb_video'])) ? esc_attr($values['mb_video'][0]) : '';
									$active = '';

									if($i === 0) {
										$firstVideo = $video;
										$active = 'active';
									}

									if(!empty($video)) :
								?>

									<article class="Felicidad-histories-button js-load-video <?php echo $active; ?>" data-video="<?php echo $video; ?>" data-site="<?php echo $i; ?>">
										<figure class="Felicidad-histories-link">
											<span class="Felicidad-play"></span>
											<h3 class="text-center"><?php the_title(); ?></h3>
										</figure>
									</article>

								<?php endif; $i++; ?>

							<?php endwhile; ?>

						</div><!-- end Felicidad-histories-buttons -->

						<figure class="Felicidad-histories-video Felicidad-histories-video--0">
							<div id="player"></div>
							<script>
							      // 2. This code loads the IFrame Player API code asynchronously.
							      var tag = document.createElement('script');
							      var height = '390';
							      var width = '640';

							      tag.src = "https://www.youtube.com/iframe_api";
							      var firstScriptTag = document.getElementsByTagName('script')[0];
							      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

							      	if(window.innerWidth < 768) {
							      		height = '240';
							      		width = '426';
								    }

								    if(window.innerWidth < 450) {
							      		height = '240';
							      		width = '320';
								    }

							      // 3. This function creates an <iframe> (and YouTube player)
							      //    after the API code downloads.
							      var player;
							      function onYouTubeIframeAPIReady() {
							        player = new YT.Player('player', {
							          height: height,
							          width: width,
							          videoId: '<?php echo $firstVideo; ?>',
							          // events: {
							          //   'onReady': onPlayerReady,
							          //   'onStateChange': onPlayerStateChange
							          // }
							        });
							      }

							      // 4. The API will call this function when the video player is ready.
							      function onPlayerReady(event) {
							        event.target.playVideo();
							      }

							      // 5. The API calls this function when the player's state changes.
							      //    The function indicates that when playing a video (state=1),
							      //    the player should play for six seconds and then stop.
							      var done = false;
							      function onPlayerStateChange(event) {
							        if (event.data == YT.PlayerState.PLAYING && !done) {
							          setTimeout(stopVideo, 6000);
							          done = true;
							        }
							      }
							      function stopVideo() {
							        player.stopVideo();
							      }

							      function loadVideo(id) {
							      	player.loadVideoById(id);
							      }

							      function resizeVideo(width, height) {
							      	player.setSize(width, height);
							      }
							    </script>
						</figure>

					</section><!-- end Felicidad-histories -->
				<?php endif; wp_reset_postdata(); ?>

				<div class="Felicidad-msg">
					<h3 class="Felicidad-titleMsg text-center">"<?php echo $thisCat->name; ?>"</h3>
					<p class="Felicidad-desc text-center"><?php echo $thisCat->description; ?></p>
				</div>

				<h2 class="Felicidad-title text-center"><span>La Felicidad es</span></h2>

	        	<!-- Post -->
	        	<?php
	        		$args = array(
	        			'posts_per_page' => 6,
	        			'cat' => 2
        			);
        			$the_query = new WP_Query($args);
	        	?>
				<?php if ( $the_query->have_posts() ) : ?>

		          	<!-- MAIN__BLOG -->
		          	<div class="row">
		            	<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

							<div class="col-sm-6 col-md-4">

								<article class="Felicidad-item">
									<?php if(has_post_thumbnail()) : ?>
										<figure class="Felicidad-figure">
											<?php the_post_thumbnail('full', array('class' => 'img-responsive center-block')); ?>
										</figure><!-- end Felicidad-figure -->
									<?php endif; ?>
									<div class="Felicidad-info">
    									<aside class="Felicidad-info-date">
    										<span class="Felicidad-info-date__month text-uppercase"><?php the_time( 'M' ); ?></span> <span class="Felicidad-info-date__day"><?php the_time( 'd' ); ?></span>
										</aside><!-- end Felicidad-info-date  -->

										<h3 class="Felicidad-item-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
    									<p><a href="<?php the_permalink(); ?>">Seguir leyendo &raquo;</a></p>
									</div>
								</article><!-- end Felicidad-item -->

							</div><!-- end col-sm-4 -->

		              	<?php endwhile; ?>
		          	</div><!-- end row -->

					<?php
						$total = $the_query->max_num_pages;
						if ( $total > 1 ) :
					?>

		          	<!-- MAIN__PAGINATION -->
		          	<div class="row">
		            	<div class="col-sm-12">
		              		<nav class="main__pagination text-center">

							<?php
								$current_page = (get_query_var( 'paged' )) ? get_query_var( 'paged' ) : 1;
								$format = ( get_option('permalink_structure' ) == '/%postname%/') ? 'page/%#%/' : '&paged=%#%';

								echo paginate_links(array(
				                    'base'      =>    get_pagenum_link(1) . '%_%',
				                    'format'    =>    $format,
				                    'current'   =>    $current_page,
				                    'prev_next' =>    True,
				                    'prev_text' =>    __('&laquo;', THEMEDOMAIN),
				                    'next_text' =>    __('&raquo;', THEMEDOMAIN),
				                    'total'     =>    $total,
				                    'mid_size'  =>    4,
				                    'type'      =>    'list'
	                  			));
							?>

		              		</nav>
		            	</div><!-- end col-sm-12 -->
		          	</div><!-- end row -->

		          	<?php endif; ?>

	          	<?php else : ?>

	          		<div class="row">
	          			<div class="col-xs-12">
	          				<p class="alert alert-info" style="margin-top: 80px;">No hay noticias que mostrar</p>
	          			</div>
	          		</div>

	          	<?php endif; wp_reset_postdata(); ?>

			</section><!-- end Felicidad -->

        </div><!-- end container -->
	</main><!-- end main -->

<?php get_footer(); ?>