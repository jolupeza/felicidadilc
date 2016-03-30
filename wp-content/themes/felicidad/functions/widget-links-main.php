<?php
/**********************************************************************************/
/* Widget display links to diferents sections of the site */
/**********************************************************************************/

    class Ilc_Links_Main_Widget extends WP_Widget
    {
        public function __construct()
        {
            parent::__construct(
                'ilc_links_main_w',
                'Custom Widget: Links Principales',
                array(
                    'description' => __('Mostrar links a diferentes secciones del sitio', THEMEDOMAIN),
                )
            );
        }

        public function form($instance)
        {
            $defaults = array(
                'title' => '',
                'subtitle' => '',
                'color' => 'yellow',
                'source' => 'page',
                'page' => '',
                'category' => '',
                'link_externo' => '',
                'img' => '',
                'img-hover' => '',
            );

            $instance = wp_parse_args((array) $instance, $defaults);
            ?>
			<!-- The Title -->
			<p>
				<label for="<?php echo $this->get_field_id('title');
            ?>"><?php _e('Título', THEMEDOMAIN);
            ?></label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id('title');
            ?>" name="<?php echo $this->get_field_name('title');
            ?>" value="<?php echo esc_attr($instance['title']);
            ?>" />
			</p>

			<!-- The Subtitle -->
			<p>
				<label for="<?php echo $this->get_field_id('subtitle');
            ?>"><?php _e('Sub - título', THEMEDOMAIN);
            ?></label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id('subtitle');
            ?>" name="<?php echo $this->get_field_name('subtitle');
            ?>" value="<?php echo esc_attr($instance['subtitle']);
            ?>" />
			</p>

			<!-- Color -->
			<h3>Color del botón:</h3>
			<?php
                $check = '';
            switch ($instance['color']) {
                    case 'yellow':
                        $check = 'yellow';
                        break;

                    case 'blue':
                        $check = 'blue';
                        break;

                    case 'magenta':
                        $check = 'magenta';
                        break;

                    case 'green':
                        $check = 'green';
                        break;

                    default:
                        $check = 'yellow';
                        break;
                }
            ?>
			<p>
				<label for="<?php echo $this->get_field_id('color') ?>-yellow"><?php _e('Amarillo:', THEMEDOMAIN);
            ?></label>
				<input type="radio" class="widefat" id="<?php echo $this->get_field_id('color');
            ?>-yellow" name="<?php echo $this->get_field_name('color');
            ?>" value="yellow" <?php checked($check, 'yellow');
            ?> />

				<label for="<?php echo $this->get_field_id('color') ?>-blue"><?php _e('Azul:', THEMEDOMAIN);
            ?></label>
				<input type="radio" class="widefat" id="<?php echo $this->get_field_id('color');
            ?>-blue" name="<?php echo $this->get_field_name('color');
            ?>" value="blue" <?php checked($check, 'blue');
            ?> />

				<label for="<?php echo $this->get_field_id('color') ?>-magenta"><?php _e('Magenta:', THEMEDOMAIN);
            ?></label>
				<input type="radio" class="widefat" id="<?php echo $this->get_field_id('color');
            ?>-magenta" name="<?php echo $this->get_field_name('color');
            ?>" value="magenta" <?php checked($check, 'magenta');
            ?> />

				<label for="<?php echo $this->get_field_id('color') ?>-green"><?php _e('Verde:', THEMEDOMAIN);
            ?></label>
				<input type="radio" class="widefat" id="<?php echo $this->get_field_id('color');
            ?>-green" name="<?php echo $this->get_field_name('color');
            ?>" value="green" <?php checked($check, 'green');
            ?> />
			</p>

			<!-- Source -->
			<?php $source = $instance['source'];
            ?>
			<h3>Fuente:</h3>
			<p>Seleccione la fuente y guarde para cargar las opciones de acuerdo a su selección.</p>
			<p>
				<label for="<?php echo $this->get_field_id('source') ?>-page"><?php _e('Página:', THEMEDOMAIN);
            ?></label>
				<input type="radio" class="widefat" id="<?php echo $this->get_field_id('source');
            ?>-page" name="<?php echo $this->get_field_name('source');
            ?>" value="page" <?php checked($source, 'page');
            ?> />

				<label for="<?php echo $this->get_field_id('source') ?>-category"><?php _e('Categoría:', THEMEDOMAIN);
            ?></label>
				<input type="radio" class="widefat" id="<?php echo $this->get_field_id('source');
            ?>-category" name="<?php echo $this->get_field_name('source');
            ?>" value="category" <?php checked($source, 'category');
            ?> />

				<label for="<?php echo $this->get_field_id('source') ?>-link"><?php _e('Link externo:', THEMEDOMAIN);
            ?></label>
				<input type="radio" class="widefat" id="<?php echo $this->get_field_id('source');
            ?>-link" name="<?php echo $this->get_field_name('source');
            ?>" value="link" <?php checked($source, 'link');
            ?> />
			</p>

			<!-- Page -->
			<?php if ($instance['source'] == 'page') : ?>
				<?php
                    /*$args = array(
                        'parent' => 13
                    );*/
                    //$pages = get_pages($args);
                    $pages = get_pages();
            ?>
				<p>
					<label for="<?php echo $this->get_field_id('page') ?>"><?php _e('Seleccione la página:', THEMEDOMAIN);
            ?></label>
		        	<select id="<?php echo $this->get_field_id('page') ?>" name="<?php echo $this->get_field_name('page');
            ?>">
	                <?php
                        foreach ($pages as $page) {
                            $selected = ($page->ID == $instance['page']) ? 'selected="selected"' : '';
                            ?>
		                    <option value="<?php echo $page->ID;
                            ?>" <?php echo $selected;
                            ?>><?php echo $page->post_title;
                            ?></option>
		            <?php

                        }
            ?>
		            </select>
				</p>
			<?php endif;
            ?>

			<!-- Category -->
			<?php if ($instance['source'] == 'category') : ?>
				<?php
                    $args = array(
                        'taxonomy' => 'category',
                        'hide_empty' => 0,
                        'exclude' => '1',
                    );
            $categories = get_categories($args);
            ?>
				<p>
					<label for="<?php echo $this->get_field_id('category') ?>"><?php _e('Seleccione la categoría:', THEMEDOMAIN);
            ?></label>
		        	<select id="<?php echo $this->get_field_id('category') ?>" name="<?php echo $this->get_field_name('category');
            ?>">
	                <?php
                        foreach ($categories as $category) {
                            $selected = ($category->cat_ID == $instance['category']) ? 'selected="selected"' : '';
                            ?>
		                    <option value="<?php echo $category->cat_ID;
                            ?>" <?php echo $selected;
                            ?>><?php echo $category->name;
                            ?></option>
		            <?php

                        }
            ?>
		            </select>
				</p>
			<?php endif;
            ?>

			<!-- Link externo -->
			<?php if ($instance['source'] == 'link') : ?>
				<p>
					<label for="<?php echo $this->get_field_id('link_externo') ?>"><?php _e('Link externo:', THEMEDOMAIN);
            ?></label>
					<input type="text" class="widefat" id="<?php echo $this->get_field_id('link_externo');
            ?>" name="<?php echo $this->get_field_name('link_externo');
            ?>" value="<?php echo esc_attr($instance['link_externo']);
            ?>" />
				</p>
			<?php endif;
            ?>

			<!-- Image -->
			<p>
				<label for="<?php echo $this->get_field_id('img') ?>"><?php _e('URL Imagen:', THEMEDOMAIN);
            ?></label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id('img');
            ?>" name="<?php echo $this->get_field_name('img');
            ?>" value="<?php echo $instance['img'];
            ?>" />
			</p>

			<!-- Image Hover -->
			<p>
				<label for="<?php echo $this->get_field_id('img-hover') ?>"><?php _e('URL Imagen Hover:', THEMEDOMAIN);
            ?></label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id('img-hover');
            ?>" name="<?php echo $this->get_field_name('img-hover');
            ?>" value="<?php echo $instance['img-hover'];
            ?>" />
			</p>
	<?php

        }

        public function update($new_instance, $old_instance)
        {
            $instance = $old_instance;

            // The Title - The Subtitle
            $instance['title'] = strip_tags($new_instance['title']);
            $instance['subtitle'] = strip_tags($new_instance['subtitle']);

            $instance['color'] = $new_instance['color'];
            $instance['source'] = $new_instance['source'];
            $instance['page'] = $new_instance['page'];
            $instance['category'] = $new_instance['category'];
            $instance['link_externo'] = $new_instance['link_externo'];
            $instance['img'] = $new_instance['img'];
            $instance['img-hover'] = $new_instance['img-hover'];

            return $instance;
        }

        public function widget($args, $instance)
        {
            extract($args);

            // Get the title and prepare it for display
            $title = apply_filters('widget_title', $instance['title']);
            $subtitle = apply_filters('widget_title', $instance['subtitle']);

            // Get other data
            $color = $instance['color'];
            $source = $instance['source'];
            $img = (!empty($instance['img'])) ? $instance['img'] : '';
            $imgHover = (!empty($instance['img-hover'])) ? $instance['img-hover'] : '';

            $item = 0;
            $permalink = '';
            if ($source === 'page') {
                $item = (int) $instance['page'];
            } elseif ($source === 'category') {
                $item = (int) $instance['category'];
            } else {
                $item = (string) $instance['link_externo'];
            }

            if (is_integer($item)) {
                $permalink = get_permalink($item);
            } else {
                $permalink = $item;
            }

            /*$bw = $before_widget;
            $bw = strstr($bw, '--', TRUE);
            $bw .= '--' . $color . '">';

            echo $bw;*/

            echo $before_widget;
            ?>

			<figure class="main__services__service__figure">
				<a href="<?php echo $permalink;
            ?>">
					<img class="img-responsive img-normal" src="<?php echo $img;
            ?>" />
					<img class="img-responsive hide img-hover" src="<?php echo $imgHover;
            ?>" />
				</a>
			</figure>

			<?php /* echo $before_title; ?>
                  <a href="<?php echo $permalink; ?>">
                    <?php echo $title; ?> <span class="text-uppercase"><?php echo $subtitle; ?></span>
                  </a>
            <?php echo $after_title; */ ?>

	<?php
            echo $after_widget;
        }
    }

    register_widget('Ilc_Links_Main_Widget');
