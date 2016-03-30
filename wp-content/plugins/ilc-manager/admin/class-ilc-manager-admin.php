<?php

/**
 * The Ilc Manager Admin defines all functionality for the dashboard
 * of the plugin.
 */

/**
 * The Ilc Manager Admin defines all functionality for the dashboard
 * of the plugin.
 *
 * This class defines the meta box used to display the post meta data and registers
 * the style sheet responsible for styling the content of the meta box.
 *
 * @since    1.0.0
 */
require_once plugin_dir_path(__FILE__).'../includes/html2pdf/html2pdf.class.php';

class Ilc_Manager_Admin
{
    /**
     * A reference to the version of the plugin that is passed to this class from the caller.
     *
     * @var string The current version of the plugin.
     */
    private $version;

    /**
     * Initializes this class and stores the current version of this plugin.
     *
     * @param string $version The current version of this plugin.
     */
    public function __construct($version)
    {
        $this->version = $version;
        // add_action('wp_ajax_generate_pdf', array(&$this, 'generate_pdf'));
        // add_action('wp_ajax_download_cv', array(&$this, 'download_cv'));
    }

    public function download_cv()
    {
        $nonce = $_POST['nonce'];

        if (!wp_verify_nonce($nonce, 'submit-download-cv')) {
            die('¡Acceso denegado!');
        }

        $result = array('result' => false);
        $posts = json_decode($_POST['posts']);
        $cvs = array();

        if (count($posts)) {
            foreach ($posts as $post) {
                $args = array(
                    'p' => $post,
                    'post_type' => 'postulantes',
                );

                $the_query = new WP_Query($args);
                if ($the_query->have_posts()) {
                    while ($the_query->have_posts()) {
                        $the_query->the_post();

                        $id = get_the_ID();
                        $values = get_post_custom($id);

                        $cv = isset($values['mb_cv']) ? home_url(esc_attr($values['mb_cv'][0])) : '';

                        $cvs[] = $cv;
                    }
                }
                wp_reset_postdata();
            }

            $result['result'] = true;
            $result['cvs'] = $cvs;
        }

        echo json_encode($result);

        die();
    }

    /**
     * Enqueues the style sheet responsible for styling the contents of this
     * meta box.
     */
    public function enqueue_styles()
    {
        wp_enqueue_style(
            'ilc-manager-admin',
            plugin_dir_url(__FILE__).'css/ilc-manager-admin.css',
            array(),
            $this->version,
            false
        );
    }

    /**
     * Enqueues the scripts responsible for functionality.
     */
    public function enqueue_scripts()
    {
        wp_enqueue_script(
            'ilc-manager-admin',
            plugin_dir_url(__FILE__).'js/ilc-manager-admin.js',
            array('jquery'),
            $this->version,
            true
        );
    }

    /**
     * Registers the meta box that will be used to display all of the post meta data
     * associated with the current post.
     */
    public function cd_mb_slides_add()
    {
        add_meta_box(
            'mb-slides-id',
            'Campos personalizados',
            array($this, 'render_mb_slides'),
            'slides',
            'normal',
            'core'
        );
    }

    public function cd_mb_slides_save($post_id)
    {
        global $post;

        // Bail if we're doing an auto save
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        // if our nonce isn't there, or we can't verify it, bail
        if (!isset($_POST['meta_box_nonce']) || !wp_verify_nonce($_POST['meta_box_nonce'], 'my_meta_box_nonce')) {
            return;
        }

        // if our current user can't edit this post, bail
        if (!current_user_can('edit_post', $post->ID)) {
            return;
        }

        // now we can actually save the data
        $allowed = array(
            'a' => array( // on allow a tags
                'href' => array() // and those anchords can only have href attribute
            ),
        );

        if (isset($_POST['mb_url'])) {
            update_post_meta($post_id, 'mb_url', esc_attr($_POST['mb_url']));
        }

        if (isset($_POST['mb_imgresponsive'])) {
            update_post_meta($post_id, 'mb_imgresponsive', wp_kses($_POST['mb_imgresponsive'], $allowed));
        }
    }

    /**
     * Requires the file that is used to display the user interface of the post meta box.
     */
    public function render_mb_slides()
    {
        require_once plugin_dir_path(__FILE__).'partials/ilc-mb-slides-manager.php';
    }

    /**
     * Registers the meta box that will be used to display all of the post meta data
     * associated with the current post.
     */
    public function cd_mb_promociones_add()
    {
        add_meta_box(
            'mb-promociones-id',
            'Campos personalizados',
            array($this, 'render_mb_promociones'),
            'promociones',
            'normal',
            'core'
        );
    }

    public function cd_mb_promociones_save($post_id)
    {
        global $post;

        // Bail if we're doing an auto save
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        // if our nonce isn't there, or we can't verify it, bail
        if (!isset($_POST['meta_box_nonce']) || !wp_verify_nonce($_POST['meta_box_nonce'], 'my_meta_box_nonce')) {
            return;
        }

        // if our current user can't edit this post, bail
        if (!current_user_can('edit_post', $post->ID)) {
            return;
        }

        // now we can actually save the data
        $allowed = array(
            'a' => array( // on allow a tags
                'href' => array() // and those anchords can only have href attribute
            ),
        );

        if (isset($_POST['mb_url'])) {
            update_post_meta($post_id, 'mb_url', wp_kses($_POST['mb_url'], $allowed));
        }
    }

    /**
     * Requires the file that is used to display the user interface of the post meta box.
     */
    public function render_mb_promociones()
    {
        require_once plugin_dir_path(__FILE__).'partials/ilc-mb-promociones-manager.php';
    }

    /**
     * Registers the meta box that will be used to display all of the post meta data
     * associated with the current post.
     */
    public function cd_mb_page_add()
    {
        add_meta_box(
            'mb-page-id',
            'Campos personalizados',
            array($this, 'render_mb_page'),
            'page',
            'normal',
            'core'
        );
    }

    public function cd_mb_page_save($post_id)
    {
        global $post;

        // Bail if we're doing an auto save
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        // if our nonce isn't there, or we can't verify it, bail
        if (!isset($_POST['meta_box_nonce']) || !wp_verify_nonce($_POST['meta_box_nonce'], 'my_meta_box_nonce')) {
            return;
        }

        // if our current user can't edit this post, bail
        if (!current_user_can('edit_post', $post->ID)) {
            return;
        }

        // now we can actually save the data
        $allowed = array(
            'p' => array(
                'style' => array(),
            ),
            'a' => array( // on allow a tags
                'href' => array(),
                'target' => array(),
            ),
            'ul' => array(
                'class' => array(),
            ),
            'ol' => array(),
            'li' => array(
                'style' => array(),
            ),
            'strong' => array(),
            'br' => array(),
        );

        delete_post_meta($post_id, 'mb_do');
        delete_post_meta($post_id, 'mb_tarifario');
        delete_post_meta($post_id, 'mb_filetarifario');
        delete_post_meta($post_id, 'mb_fileneed');

        if (isset($_POST['mb_catslide']) && !empty($_POST['mb_catslide'])) {
            update_post_meta($post_id, 'mb_catslide', esc_attr($_POST['mb_catslide']));
        } else {
            delete_post_meta($post_id, 'mb_catslide');
        }

        if (isset($_POST['mb_about']) && !empty($_POST['mb_about'])) {
            update_post_meta($post_id, 'mb_about', wp_kses($_POST['mb_about'], $allowed));
        } else {
            delete_post_meta($post_id, 'mb_about');
        }

        if (isset($_POST['mb_imgabout']) && !empty($_POST['mb_imgabout'])) {
            update_post_meta($post_id, 'mb_imgabout', wp_kses($_POST['mb_imgabout'], $allowed));
        } else {
            delete_post_meta($post_id, 'mb_imgabout');
        }

        if (isset($_POST['mb_need']) && !empty($_POST['mb_need'])) {
            update_post_meta($post_id, 'mb_need', wp_kses($_POST['mb_need'], $allowed));
        } else {
            delete_post_meta($post_id, 'mb_need');
        }

        if (isset($_POST['mb_doc']) && !empty($_POST['mb_doc'])) {
            update_post_meta($post_id, 'mb_doc', wp_kses($_POST['mb_doc'], $allowed));
        } else {
            delete_post_meta($post_id, 'mb_doc');
        }

        if (isset($_POST['mb_videodo']) && !empty($_POST['mb_videodo'])) {
            update_post_meta($post_id, 'mb_videodo', wp_kses($_POST['mb_videodo'], $allowed));
        } else {
            delete_post_meta($post_id, 'mb_videodo');
        }

        if (isset($_POST['mb_questions']) && !empty($_POST['mb_questions'])) {
            update_post_meta($post_id, 'mb_questions', wp_kses($_POST['mb_questions'], $allowed));
        } else {
            delete_post_meta($post_id, 'mb_questions');
        }
    }

    /**
     * Requires the file that is used to display the user interface of the post meta box.
     */
    public function render_mb_page()
    {
        require_once plugin_dir_path(__FILE__).'partials/ilc-mb-page-manager.php';
    }

    /**
     * Registers the meta box that will be used to display all of the post meta data
     * associated with the current post.
     */
    public function cd_mb_agencias_add()
    {
        add_meta_box(
            'mb-agencias-id',
            'Información de la agencia',
            array($this, 'render_mb_agencias'),
            'agencias',
            'normal',
            'core'
        );
    }

    public function cd_mb_agencias_save($post_id)
    {
        global $post;

        // Bail if we're doing an auto save
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        // if our nonce isn't there, or we can't verify it, bail
        if (!isset($_POST['meta_box_nonce']) || !wp_verify_nonce($_POST['meta_box_nonce'], 'my_meta_box_nonce')) {
            return;
        }

        // if our current user can't edit this post, bail
        if (!current_user_can('edit_post', $post->ID)) {
            return;
        }

        // now we can actually save the data
        $allowed = array(
            'a' => array( // on allow a tags
                'href' => array() // and those anchords can only have href attribute
            ),
        );

        if (isset($_POST['mb_address'])) {
            update_post_meta($post_id, 'mb_address', wp_kses($_POST['mb_address'], $allowed));
        }

        if (isset($_POST['mb_phone'])) {
            update_post_meta($post_id, 'mb_phone', wp_kses($_POST['mb_phone'], $allowed));
        }

        if (isset($_POST['mb_latitud'])) {
            update_post_meta($post_id, 'mb_latitud', wp_kses($_POST['mb_latitud'], $allowed));
        }

        if (isset($_POST['mb_longitud'])) {
            update_post_meta($post_id, 'mb_longitud', wp_kses($_POST['mb_longitud'], $allowed));
        }

        if (isset($_POST['mb_horario1'])) {
            update_post_meta($post_id, 'mb_horario1', wp_kses($_POST['mb_horario1'], $allowed));
        }

        if (isset($_POST['mb_horario2'])) {
            update_post_meta($post_id, 'mb_horario2', wp_kses($_POST['mb_horario2'], $allowed));
        }

        if (isset($_POST['mb_horario3'])) {
            update_post_meta($post_id, 'mb_horario3', wp_kses($_POST['mb_horario3'], $allowed));
        }

        if (isset($_POST['mb_images'])) {
            $images = $_POST['mb_images'];

            $save = false;
            $newArrImages = array();

            foreach ($images as $img) {
                if (!empty($img)) {
                    $save = true;
                    $newArrImages[] = $img;
                }
            }

            if ($save) {
                update_post_meta($post_id, 'mb_images', $newArrImages);
            } else {
                delete_post_meta($post_id, 'mb_images');
            }
        }
    }

    /**
     * Requires the file that is used to display the user interface of the post meta box.
     */
    public function render_mb_agencias()
    {
        require_once plugin_dir_path(__FILE__).'partials/ilc-mb-agencias-manager.php';
    }

    /**
     * Registers the meta box that will be used to display all of the post meta data
     * associated with the current post.
     */
    public function cd_mb_postulantes_add()
    {
        add_meta_box(
            'mb-postulantes-id',
            'Información del postulante',
            array($this, 'render_mb_postulantes'),
            'postulantes',
            'normal',
            'core'
        );
    }

    public function cd_mb_postulantes_save($post_id)
    {
        global $post;

        // Bail if we're doing an auto save
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        // if our nonce isn't there, or we can't verify it, bail
        if (!isset($_POST['meta_box_nonce']) || !wp_verify_nonce($_POST['meta_box_nonce'], 'my_meta_box_nonce')) {
            return;
        }

        // if our current user can't edit this post, bail
        if (!current_user_can('edit_post', $post->ID)) {
            return;
        }

        // now we can actually save the data
        $allowed = array(
        'a' => array( // on allow a tags
                'href' => array() // and those anchords can only have href attribute
        ),
        );

        /*if( isset( $_POST['mb_name'] ) )
        {
        update_post_meta( $post_id, 'mb_name', wp_kses( $_POST['mb_name'], $allowed ) );
        }

        if( isset( $_POST['mb_tel'] ) )
        {
        update_post_meta( $post_id, 'mb_tel', wp_kses( $_POST['mb_tel'], $allowed ) );
        }

        if( isset( $_POST['mb_email'] ) )
        {
        update_post_meta( $post_id, 'mb_email', wp_kses( $_POST['mb_email'], $allowed ) );
        }

        if( isset( $_POST['mb_cv'] ) )
        {
        update_post_meta( $post_id, 'mb_cv', wp_kses( $_POST['mb_cv'], $allowed ) );
        }

        if ( isset( $_POST['mb_jobs']) )
        {
                update_post_meta( $post_id, 'mb_jobs', $_POST['mb_jobs'] );
        }*/
    }

    /**
     * Requires the file that is used to display the user interface of the post meta box.
     */
    public function render_mb_postulantes()
    {
        require_once plugin_dir_path(__FILE__).'partials/ilc-mb-postulantes-manager.php';
    }

    public function custom_columns_postulantes($columns)
    {
        $columns = array(
            'cb' => '<input type="checkbox" />',
            'title' => __('Correo electrónico'),
            'name' => __('Nombre Completo'),
            'jobs' => __('Convocatoria'),
            'file' => __('CV'),
            'date' => __('Fecha'),
        );

        return $columns;
    }

    public function custom_column_postulantes($column)
    {
        global $post;
        $values = get_post_custom($post->ID);

        switch ($column) {
            case 'name':
                $name = isset($values['mb_name'][0]) ? esc_attr($values['mb_name'][0]) : '';
                echo $name;
                break;
            case 'jobs':
                $jobs = isset($values['mb_jobs']) ? $values['mb_jobs'][0] : '';
                if (!empty($jobs)) {
                    $jobs = unserialize($jobs);
                    foreach ($jobs as $key => $value) {
                        if ($value === 'on') {
                            $jobInfo = get_post($key);
                            echo $jobInfo->post_title.' | ';
                        }
                    }
                } else {
                    echo 'Convocatoria General';
                }
                break;
            case 'file':
                $cv = isset($values['mb_cv'][0]) ? $values['mb_cv'][0] : '';
                $arrFileCv = explode('/', $cv);

                $filePdf = ABSPATH.'resources'.DIRECTORY_SEPARATOR.$arrFileCv[1];

                if (file_exists($filePdf)) {
                    $urlPdf = home_url($cv);

                    echo '<a href="'.$urlPdf.'" class="button button-primary button-large view-pdf" target="_blank">Descargar CV</a>';
                }
                break;
        }
    }

    /**
     * Display Filter by Jobs in Post Type Postulantes.
     *
     * @global type $typenow
     */
    public function postulantes_table_filtering()
    {
        global $typenow;
        $job = (isset($_GET['mb_jobs'])) ? esc_attr($_GET['mb_jobs']) : '';

        if ($typenow == 'postulantes') {
            $args = array(
                'post_type' => 'jobs',
                'posts_per_page' => '-1',
                'orderby' => 'menu_order',
                'order' => 'ASC',
//                    'meta_query'     => array(
//                        array(
//                            'key'     => 'mb_date_due',
//                            'compare' => '>=',
//                            'value'   => date('Y-m-d'),
//                            'type'    => 'DATE'
//                        )
//                    )
            );
            $the_query = new WP_Query($args);

            if ($the_query->have_posts()) {
                echo '<select name="mb_jobs" id="filter-by-jobs">';
                echo '<option value="0">'.__('Mostrar todos los puestos', THEMEDOMAIN).'</option>';

                while ($the_query->have_posts()) {
                    $the_query->the_post();
                    $id = get_the_ID();
                    $title = get_the_title();
                    echo '<option value="'.$id.'"'.selected($job, $id).'>'.$title.'</option>';
                }

                echo '</select>';
            }
            wp_reset_postdata();
        }
    }

    /**
     * Filter postulantes by job.
     *
     * @param arr $query
     *
     * @return type
     */
    public function postulantes_table_filter($query)
    {
        if (!current_user_can('manage_options')) {
            return;
        }

        if (is_admin() && $query->query['post_type'] == 'postulantes') {
            $qv = &$query->query_vars;
            $qv['meta_query'] = array();
            $value = array();
            $serValue = '';
            $newValue = '';

            if (!empty($_GET['mb_jobs'])) {
                $value[$_GET['mb_jobs']] = 'on';
                $serValue = serialize($value);
                $newValue = substr($serValue, 5);
                $newValue = substr($newValue, 0, -1);

                $qv['meta_query'][] = array(
                    'key' => 'mb_jobs',
                    'value' => $newValue,
                    'compare' => 'LIKE',
                );
            }
        }
    }

    public function postulantes_button_view_edit($views)
    {
        $arg = (isset($_GET['mb_jobs'])) ? $_GET['mb_jobs'] : '';
        echo '<p>'
            .'<a href="'.plugin_dir_url(dirname(__FILE__)).'postulantes/generateExcel/'.$arg.'" id="generate-excel" class="button button-primary">Generar excel</a>'
            .' <a href="" class="button button-primary" id="js-download-cv" data-nonce="'.wp_create_nonce('submit-download-cv').'">Descargar Cvs</a>'
            .'</p>';

        return $views;
    }

    /**
     * Registers the meta box that will be used to display all of the post meta data
     * associated with the current post.
     */
    public function cd_mb_jobs_add()
    {
        add_meta_box(
            'mb-jobs-id',
            'Información del puesto de trabajo',
            array($this, 'render_mb_jobs'),
            'jobs',
            'normal',
            'core'
        );
    }

    public function cd_mb_jobs_save($post_id)
    {
        global $post;

        // Bail if we're doing an auto save
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        // if our nonce isn't there, or we can't verify it, bail
        if (!isset($_POST['meta_box_nonce']) || !wp_verify_nonce($_POST['meta_box_nonce'], 'my_meta_box_nonce')) {
            return;
        }

        // if our current user can't edit this post, bail
        if (!current_user_can('edit_post', $post->ID)) {
            return;
        }

        // now we can actually save the data
        $allowed = array(
        'a' => array( // on allow a tags
                'href' => array() // and those anchords can only have href attribute
        ),
        );

        if (isset($_POST['mb_vacantes'])) {
            update_post_meta($post_id, 'mb_vacantes', wp_kses($_POST['mb_vacantes'], $allowed));
        }

        if (isset($_POST['mb_date_due'])) {
            update_post_meta($post_id, 'mb_date_due', wp_kses($_POST['mb_date_due'], $allowed));
        }
    }

    /**
     * Requires the file that is used to display the user interface of the post meta box.
     */
    public function render_mb_jobs()
    {
        require_once plugin_dir_path(__FILE__).'partials/ilc-mb-jobs-manager.php';
    }

    /**
     * Registers the meta box that will be used to display all of the post meta data
     * associated with the current post.
     */
    public function cd_mb_books_add()
    {
        add_meta_box(
            'mb-books-id',
            'Información',
            array($this, 'render_mb_books'),
            'books',
            'normal',
            'core'
        );
    }

    public function cd_mb_books_save($post_id)
    {
        global $post;

        // Bail if we're doing an auto save
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        // if our nonce isn't there, or we can't verify it, bail
        if (!isset($_POST['meta_box_nonce']) || !wp_verify_nonce($_POST['meta_box_nonce'], 'my_meta_box_nonce')) {
            return;
        }

        // if our current user can't edit this post, bail
        if (!current_user_can('edit_post', $post->ID)) {
            return;
        }

        // now we can actually save the data
        $allowed = array(
            'a' => array( // on allow a tags
                'href' => array() // and those anchords can only have href attribute
            ),
        );

        if (isset($_POST['mb_obs'])) {
            update_post_meta($post_id, 'mb_obs', wp_kses($_POST['mb_obs'], $allowed));
        }

        if (isset($_POST['mb_date_response'])) {
            update_post_meta($post_id, 'mb_date_response', wp_kses($_POST['mb_date_response'], $allowed));
        }
    }

    /**
     * Requires the file that is used to display the user interface of the post meta box.
     */
    public function render_mb_books()
    {
        require_once plugin_dir_path(__FILE__).'partials/ilc-mb-books-manager.php';
    }

    /**
     * Custom meta box by custom post type Histories.
     */
    public function cd_mb_histories_add()
    {
        add_meta_box(
            'mb-histories-id',
            'Datos',
            array($this, 'render_mb_histories'),
            'histories',
            'normal',
            'core'
        );
    }

    public function cd_mb_histories_save($post_id)
    {
        global $post;

        // Bail if we're doing an auto save
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        // if our nonce isn't there, or we can't verify it, bail
        if (!isset($_POST['meta_box_nonce']) || !wp_verify_nonce($_POST['meta_box_nonce'], 'histories_meta_box_nonce')) {
            return;
        }

        // if our current user can't edit this post, bail
        if (!current_user_can('edit_post', $post->ID)) {
            return;
        }

        // now we can actually save the data
        $allowed = array(
            'p' => array(
                'style' => array(),
            ),
            'a' => array( // on allow a tags
                'href' => array(),
                'target' => array(),
            ),
            'ul' => array(
                'class' => array(),
            ),
            'ol' => array(),
            'li' => array(
                'style' => array(),
            ),
            'strong' => array(),
            'br' => array(),
        );

        if (isset($_POST['mb_video']) && !empty($_POST['mb_video'])) {
            update_post_meta($post_id, 'mb_video', esc_attr($_POST['mb_video']));
        } else {
            delete_post_meta($post_id, 'mb_video');
        }
    }

    /**
     * Requires the file that is used to display the user interface of the post meta box.
     */
    public function render_mb_histories()
    {
        require_once plugin_dir_path(__FILE__).'partials/ilc-mb-histories-manager.php';
    }

    /**
     * Add custom content type slides.
     */
    public function add_post_type()
    {
        // Custom Post Type 'SLIDES'
        $labels = array(
            'name' => __('Sliders', THEMEDOMAIN),
            'singular_name' => __('Slider', THEMEDOMAIN),
            'add_new' => __('Nuevo slider', THEMEDOMAIN),
            'add_new_item' => __('Agregar nuevo slider', THEMEDOMAIN),
            'edit_item' => __('Editar slider', THEMEDOMAIN),
            'new_item' => __('Nuevo slider', THEMEDOMAIN),
            'view_item' => __('Ver slider', THEMEDOMAIN),
            'search_items' => __('Buscar slider', THEMEDOMAIN),
            'not_found' => __('Slider no encontrado', THEMEDOMAIN),
            'not_found_in_trash' => __('Slider no encontrado en la papelera', THEMEDOMAIN),
        );
        $args = array(
            'labels' => $labels,
            'has_archive' => true,
            'public' => true,
            'hierarchical' => false,
            'menu_icon' => 'dashicons-format-gallery',
            'supports' => array(
                'title',
                'editor',
                'excerpt',
                'custom-fields',
                'thumbnail',
                'page-attributes',
            ),
            'taxonomies' => array('post_tag', 'category'),
        );
        register_post_type('slides', $args);

        /*
        // Custom Post Type 'PROMOCIONES'
        $labels = array(
            'name' => __('Promociones', THEMEDOMAIN),
            'singular_name' => __('Promoción', THEMEDOMAIN),
            'add_new' => __('Nueva promoción', THEMEDOMAIN),
            'add_new_item' => __('Agregar nueva promoción', THEMEDOMAIN),
            'edit_item' => __('Editar promoción', THEMEDOMAIN),
            'new_item' => __('Nueva promoción', THEMEDOMAIN),
            'view_item' => __('Ver promoción', THEMEDOMAIN),
            'search_items' => __('Buscar promocións', THEMEDOMAIN),
            'not_found' => __('Promoción no encontrada', THEMEDOMAIN),
            'not_found_in_trash' => __('Promoción no encontrado en la papelera', THEMEDOMAIN),
        );
        $args = array(
            'labels' => $labels,
            'has_archive' => true,
            'public' => true,
            'hierarchical' => false,
            'menu_icon' => 'dashicons-awards',
            'supports' => array(
                'title',
                'editor',
                'excerpt',
                'custom-fields',
                'thumbnail',
                'page-attributes',
            ),
            'taxonomies' => array('post_tag', 'category'),
        );
        register_post_type('promociones', $args);

        // Custom Post Type 'CASOS'
        $labels = array(
            'name' => __('Casos de éxito', THEMEDOMAIN),
            'singular_name' => __('Caso de éxito', THEMEDOMAIN),
            'add_new' => __('Nuevo caso de éxito', THEMEDOMAIN),
            'add_new_item' => __('Agregar nuevo caso de éxito', THEMEDOMAIN),
            'edit_item' => __('Editar caso de éxito', THEMEDOMAIN),
            'new_item' => __('Nuevo caso de éxito', THEMEDOMAIN),
            'view_item' => __('Ver caso de éxito', THEMEDOMAIN),
            'search_items' => __('Buscar caso de éxito', THEMEDOMAIN),
            'not_found' => __('Caso de éxito no encontrada', THEMEDOMAIN),
            'not_found_in_trash' => __('Caso de éxito no encontrado en la papelera', THEMEDOMAIN),
        );
        $args = array(
            'labels' => $labels,
            'has_archive' => true,
            'public' => true,
            'hierarchical' => false,
            'menu_icon' => 'dashicons-money',
            'supports' => array(
                'title',
                'editor',
                'excerpt',
                'custom-fields',
                'thumbnail',
                'page-attributes',
            ),
            'taxonomies' => array('post_tag', 'category'),
        );
        register_post_type('casos', $args);

        // Custom Post Type 'AGENCIAS'
        $labels = array(
            'name' => __('Agencias', THEMEDOMAIN),
            'singular_name' => __('Agencia', THEMEDOMAIN),
            'add_new' => __('Nueva agencia', THEMEDOMAIN),
            'add_new_item' => __('Agregar nueva agencia', THEMEDOMAIN),
            'edit_item' => __('Editar agencia', THEMEDOMAIN),
            'new_item' => __('Nueva agencia', THEMEDOMAIN),
            'view_item' => __('Ver agencia', THEMEDOMAIN),
            'search_items' => __('Buscar agencia', THEMEDOMAIN),
            'not_found' => __('Agencia no encontrada', THEMEDOMAIN),
            'not_found_in_trash' => __('Agencia no encontrado en la papelera', THEMEDOMAIN),
        );
        $args = array(
            'labels' => $labels,
            'has_archive' => true,
            'public' => true,
            'hierarchical' => false,
            'menu_icon' => 'dashicons-admin-home',
            'supports' => array(
                'title',
                'editor',
                'excerpt',
                'custom-fields',
                'thumbnail',
                'page-attributes',
            ),
            'taxonomies' => array('post_tag', 'category'),
        );
        register_post_type('agencias', $args);

        // Custom Post Type 'POSTULANTES'
        $labels = array(
            'name' => __('Postulantes', THEMEDOMAIN),
            'singular_name' => __('Postulante', THEMEDOMAIN),
            'add_new' => __('Nuevo postulante', THEMEDOMAIN),
            'add_new_item' => __('Agregar nuevo postulante', THEMEDOMAIN),
            'edit_item' => __('Editar postulante', THEMEDOMAIN),
            'new_item' => __('Nuevo postulante', THEMEDOMAIN),
            'view_item' => __('Ver postulante', THEMEDOMAIN),
            'search_items' => __('Buscar postulante', THEMEDOMAIN),
            'not_found' => __('Postulante no encontrado', THEMEDOMAIN),
            'not_found_in_trash' => __('Postulante no encontrado en la papelera', THEMEDOMAIN),
        );
        $args = array(
            'labels' => $labels,
            'has_archive' => true,
            'public' => true,
            'hierarchical' => false,
            'menu_icon' => 'dashicons-id-alt',
            'supports' => array(
                'title',
                'editor',
                'excerpt',
                'custom-fields',
                'thumbnail',
                'page-attributes',
            ),
            'capability_type' => 'postulante',
            'capabilities' => array(
                'edit_post' => 'edit_postulante',
                'read_post' => 'read_postulante',
                'delete_post' => 'delete_postulante',
                'delete_posts' => 'delete_postulantes',
                'delete_published_posts' => 'delete_published_postulantes',
                'delete_others_posts' => 'delete_others_postulantes',
                'edit_posts' => 'edit_postulantes',
                'edit_others_posts' => 'edit_others_postulantes',
                'publish_posts' => 'publish_postulantes',
                'read_private_posts' => 'read_private_postulantes',
                'edit_published_posts' => 'edit_published_postulantes',
                'create_posts' => 'edit_postulantes',
            ),
            'map_meta_cap' => true,
            // 'taxonomies' => array( 'category'),
        );
        register_post_type('postulantes', $args);

        // Custom Post Type 'JOBS'
        $labels = array(
            'name' => __('Trabajos', THEMEDOMAIN),
            'singular_name' => __('Trabajo', THEMEDOMAIN),
            'add_new' => __('Nuevo trabajo', THEMEDOMAIN),
            'add_new_item' => __('Agregar nuevo trabajo', THEMEDOMAIN),
            'edit_item' => __('Editar trabajo', THEMEDOMAIN),
            'new_item' => __('Nuevo trabajo', THEMEDOMAIN),
            'view_item' => __('Ver trabajo', THEMEDOMAIN),
            'search_items' => __('Buscar trabajo', THEMEDOMAIN),
            'not_found' => __('Trabajo no encontrado', THEMEDOMAIN),
            'not_found_in_trash' => __('Trabajo no encontrado en la papelera', THEMEDOMAIN),
        );
        $args = array(
            'labels' => $labels,
            'has_archive' => true,
            'public' => true,
            'hierarchical' => false,
            'menu_icon' => 'dashicons-hammer',
            'supports' => array(
                'title',
                'editor',
                'excerpt',
                'custom-fields',
                'thumbnail',
                'page-attributes',
            ),
            'capability_type' => 'job',
            'capabilities' => array(
                'edit_post' => 'edit_job',
                'read_post' => 'read_job',
                'delete_post' => 'delete_job',
                'delete_posts' => 'delete_jobs',
                'delete_published_posts' => 'delete_published_jobs',
                'delete_others_posts' => 'delete_others_jobs',
                'edit_posts' => 'edit_jobs',
                'edit_others_posts' => 'edit_others_jobs',
                'publish_posts' => 'publish_jobs',
                'read_private_posts' => 'read_private_jobs',
                'edit_published_posts' => 'edit_published_jobs',
                'create_posts' => 'edit_jobs',
            ),
            'map_meta_cap' => true,
            'taxonomies' => array('category'),
        );
        register_post_type('jobs', $args);

        // Custom Post Type 'BOOKS'
        $labels = array(
            'name' => __('Libro de reclamaciones', THEMEDOMAIN),
            'singular_name' => __('Reclamo', THEMEDOMAIN),
            'add_new' => __('Nuevo reclamo', THEMEDOMAIN),
            'add_new_item' => __('Agregar nuevo reclamo', THEMEDOMAIN),
            'edit_item' => __('Editar reclamo', THEMEDOMAIN),
            'new_item' => __('Nuevo reclamo', THEMEDOMAIN),
            'view_item' => __('Ver reclamo', THEMEDOMAIN),
            'search_items' => __('Buscar reclamo', THEMEDOMAIN),
            'not_found' => __('Reclamo no encontrado', THEMEDOMAIN),
            'not_found_in_trash' => __('Reclamo no encontrado en la papelera', THEMEDOMAIN),
        );
        $args = array(
            'labels' => $labels,
            'has_archive' => true,
            'public' => true,
            'hierarchical' => false,
            'menu_icon' => 'dashicons-book',
            'supports' => array(
                'title',
                'editor',
                'excerpt',
                'custom-fields',
                'thumbnail',
                'page-attributes',
            ),
            'taxonomies' => array('post_tag', 'category'),
        );
        register_post_type('books', $args); */

        $labels = array(
            'name' => __('Historias', THEMEDOMAIN),
            'singular_name' => __('Historia', THEMEDOMAIN),
            'add_new' => __('Nueva historia', THEMEDOMAIN),
            'add_new_item' => __('Agregar nueva historia', THEMEDOMAIN),
            'edit_item' => __('Editar historia', THEMEDOMAIN),
            'new_item' => __('Nueva historia', THEMEDOMAIN),
            'view_item' => __('Ver historia', THEMEDOMAIN),
            'search_items' => __('Buscar historia', THEMEDOMAIN),
            'not_found' => __('Historia no encontrada', THEMEDOMAIN),
            'not_found_in_trash' => __('Historia no encontrada en la papelera', THEMEDOMAIN),
            'all_items' => __('Todas las historias', THEMEDOMAIN),
        );
        $args = array(
            'labels' => $labels,
            'description' => 'Relación de Historias',
            // 'public'              => false,
            // 'exclude_from_search' => true,
            // 'publicly_queryable' => false,
            'show_ui' => true,
            'show_in_nav_menus' => true,
            'show_in_menu' => true,
            'show_in_admin_bar' => true,
            // 'menu_position'          => null,
            'menu_icon' => 'dashicons-pressthis',
            // 'hierarchical'        => false,
            'supports' => array(
                'title',
                'editor',
                'custom-fields',
                'page-attributes',
                // 'author'
                // 'thumbnail'
                // 'excerpt'
                // 'trackbacks'
                // 'comments',
                // 'revisions',
                // 'post-formats'
            ),
            // 'taxonomies'  => array('post_tag', 'category'),
            // 'has_archive' => false,
            // 'rewrite'     => true
        );
        register_post_type('histories', $args);

        // Agregar option correlativo Libro de reclamaciones
        //add_option('correlativo_libro', 1);
    }

    /**
     * Generate PDF.
     *
     * @param string $version The current version of this plugin.
     */
    public function generate_pdf()
    {
        $nonce = $_POST['nonce'];

        if (!wp_verify_nonce($nonce, 'ajax-pdf-nonce')) {
            die('¡Acceso denegado!');
        }

        $id = (int) $_POST['id'];
        $result = array('result' => false);

        $html2pdf = new HTML2PDF('P', 'A4', 'fr');

        $args = array(
            'post_type' => ' books',
            'p' => $id,
        );

        $namePdf = '';
        $name = '';
        $email = '';

        $the_query = new WP_Query($args);

        if ($the_query->have_posts()) {
            ob_start(); //starts output buffering

            include plugin_dir_path(__FILE__).'partials/template-pdf.php';

            $pdf = ob_get_contents(); // this now contains the the above string

            ob_end_clean(); // close and clean the output buffer.

            if (!empty($namePdf) && !empty($name) && !empty($email)) {
                $filePdf = ABSPATH.'libro-reclamaciones'.DIRECTORY_SEPARATOR.$namePdf.'.pdf';

                if (!file_exists($filePdf)) {
                    $html2pdf->WriteHtml($pdf);

                    $html2pdf->Output($filePdf, 'F');

                    $result['result'] = true;

                    // Mandar correo a usuario
                    $this->sendEmail($name, $email, $filePdf);
                }
            }
        }

        wp_reset_postdata();

        echo json_encode($result);

        die();
    }

    private function sendEmail($name, $email, $attachment = '')
    {
        $response = false;

        if (!empty($name) && !empty($email) && !empty($attachment) && file_exists($attachment)) {
            $subject = 'Inversiones La Cruz';
            $body = "Estimado(a) $name <br /><br />";
            $body .= 'Le enviamos un archivo conteniendo la respuesta a su Reclamaci&oacute;n.';

            $headers = 'From: Inversiones La Cruz'.PHP_EOL;
            $headers .= 'Reply-To: j.perez@adinspector.pe'.PHP_EOL;
            $headers .= 'MIME-Version: 1.0'.PHP_EOL;
            $headers .= 'Content-type: text/html; charset=utf-8'.PHP_EOL;
            $headers .= 'Content-Transfer-Encoding: quoted-printable'.PHP_EOL;

            if (wp_mail($email, $subject, $body, $headers, $attachment)) {
                $response = true;
            }
        }

        return $response;
    }

    public function custom_columns_books($columns)
    {
        $new_columns = array(
            'pdf' => __('Pdf', THEMEDOMAIN),
        );

        return array_merge($columns, $new_columns);
    }

    public function custom_column_books($column)
    {
        global $post;

        switch ($column) {
            case 'pdf':
                $filePdf = ABSPATH.'libro-reclamaciones'.DIRECTORY_SEPARATOR.$post->post_name.'.pdf';

                if (file_exists($filePdf)) {
                    $urlPdf = home_url('libro-reclamaciones/'.$post->post_name.'.pdf');

                    echo '<a href="'.$urlPdf.'" class="button button-primary button-large view-pdf" target="_blank">Ver Pdf</a>';
                }
                break;
        }
    }

    public function template_mail_content($args)
    {
        $attachments = (isset($args['attachments'])) ? $args['attachments'] : '';

        if (empty($attachments)) {
            $message = $args['message'];
            ob_start();

            require_once plugin_dir_path(__FILE__).'partials/ilc-template-email-manager.php';

            $content = ob_get_contents();

            ob_get_clean();

            $args['message'] = $content;
        }

        return $args;
    }

    public function addRoleRRHH()
    {
//        remove_role('rrhh');
        add_role('rrhh', __('Recursos Humanos'), array(
            'read' => true,
            'read_postulante' => true,
            'edit_postulante' => true,
            'edit_postulantes' => true,
            'delete_postulante' => true,
            'edit_others_postulantes' => true,
            'publish_postulantes' => true,
            'read_private_postulantes' => true,
            'edit_published_postulantes' => true,
            'delete_postulantes' => true,
            'delete_published_postulantes' => true,
            'delete_others_postulantes' => true,
            'read_job' => true,
            'edit_job' => true,
            'edit_jobs' => true,
            'delete_job' => true,
            'edit_others_jobs' => true,
            'publish_jobs' => true,
            'read_private_jobs' => true,
            'edit_published_jobs' => true,
            'delete_jobs' => true,
            'delete_published_jobs' => true,
            'delete_others_jobs' => true,
            'edit_theme_options' => true,
            'upload_files' => true
        ));
    }

    public function addAdminCaps()
    {
        $role = get_role('administrator');
        $role->add_cap('read_postulante');
        $role->add_cap('edit_postulante');
        $role->add_cap('edit_postulantes');
        $role->add_cap('delete_postulante');
        $role->add_cap('edit_others_postulantes');
        $role->add_cap('publish_postulantes');
        $role->add_cap('read_private_postulantes');
        $role->add_cap('edit_published_postulantes');
        $role->add_cap('delete_postulantes');
        $role->add_cap('delete_published_postulantes');
        $role->add_cap('delete_others_postulantes');
        $role->add_cap('read_job');
        $role->add_cap('edit_job');
        $role->add_cap('edit_jobs');
        $role->add_cap('delete_job');
        $role->add_cap('edit_others_jobs');
        $role->add_cap('publish_jobs');
        $role->add_cap('read_private_jobs');
        $role->add_cap('edit_published_jobs');
        $role->add_cap('delete_jobs');
        $role->add_cap('delete_published_jobs');
        $role->add_cap('delete_others_jobs');
    }

    public function remove_menu_postulantes_jobs_admin()
    {
        $currentUser = wp_get_current_user();
        $allowedRoles = array('rrhh', 'administrator');

        if (!in_array($currentUser->roles[0], $allowedRoles)) {
            remove_menu_page('edit.php?post_type=jobs');
            remove_menu_page('edit.php?post_type=postulantes');
        }

        if($currentUser->roles[0] === 'rrhh') {
            remove_submenu_page('themes.php', 'themes.php');
            remove_submenu_page('themes.php', 'widgets.php');
            remove_submenu_page('themes.php', 'nav-menus.php');
        }

        remove_menu_page('edit.php?post_type=books');
    }
}
