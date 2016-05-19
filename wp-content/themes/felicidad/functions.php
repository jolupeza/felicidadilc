<?php
/**********************************************************************************/
/* Define Constants */
/**********************************************************************************/
define('THEMEROOT', get_stylesheet_directory_uri());
define('IMAGES', THEMEROOT . '/images');
define('THEMEDOMAIN', 'ilc-framework');



/**********************************************************************************/
/* Load JS Files */
/**********************************************************************************/
function load_custom_scripts()
{
	wp_deregister_script('jquery');
	wp_register_script('jquery', ("https://code.jquery.com/jquery-1.11.3.min.js"), false, '1.11.3', true);
	wp_enqueue_script('jquery');

	/*wp_register_script('bootstrap', ("https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"), array('jquery'), '3.3.5', true);
	wp_enqueue_script('bootstrap');*/

	wp_enqueue_script('bootstrap', THEMEROOT . '/js/bootstrap.min.js', array('jquery'), '3.3.2', true);
	wp_enqueue_script('mobile', THEMEROOT . '/js/jquery.mobile.custom.min.js', array('jquery'), '1.3.2', true);
	wp_enqueue_script('slidebars', THEMEROOT . '/js/slidebars.min.js', array('jquery'), '0.10.2', true);
	wp_enqueue_script('formValidation', THEMEROOT . '/js/formValidation.min.js', array('jquery'), '0.6.2', true);
	wp_enqueue_script('bootstrapFV', THEMEROOT . '/js/framework/bootstrap.min.js', array('jquery'), '0.6.2', true);
	wp_enqueue_script('imagesloaded', THEMEROOT . '/js/imagesloaded.pkgd.min.js', array(), '3.1.8', true);
	wp_enqueue_script('isotope', THEMEROOT . '/js/isotope.pkgd.min.js', array(), '2.2.0', true);
	wp_enqueue_script('swfobject', THEMEROOT . '/js/swfobject.js', array(), '2.2', true);
	wp_enqueue_script('bootstrap-multiselect', THEMEROOT . '/js/bootstrap-multiselect.js', array('jquery'), false, true);
	wp_enqueue_script('custom_script', THEMEROOT . '/js/script.js', array('jquery'), false, true);
	wp_localize_script('custom_script', 'MyAjax', array( 'url' => admin_url( 'admin-ajax.php' ), 'nonce' => wp_create_nonce( 'myajax-post-comment-nonce' )));
}
add_action('wp_enqueue_scripts', 'load_custom_scripts');



/**********************************************************************************/
/* Add Theme Support for Post Formats, Post Thumbnails ad Automatic Feed Links 	  */
/**********************************************************************************/
if (function_exists('add_theme_support'))
{
	add_theme_support('post-formats', array('link', 'quote', 'gallery', 'video'));

	add_theme_support('post-thumbnails', array('post', 'page', 'slides'));
}



/**********************************************************************************/
/* Add Menus */
/**********************************************************************************/
function register_my_menus()
{
	register_nav_menus(
		array(
			'main-menu' => __('Main Menu', THEMEDOMAIN),
			'movil-menu' => __('Movil Menu', THEMEDOMAIN),
			'services-menu' => __('Services Menu', THEMEDOMAIN),
			'services-movil-menu' => __('Services Movil Menu', THEMEDOMAIN),
			'footer-menu' => __('Footer Menu', THEMEDOMAIN),
			'footer-services-menu' => __('Services Footer Menu', THEMEDOMAIN),
			'top-menu' => __('Top Menu', THEMEDOMAIN),
			'transparency-movil-menu' => __('Transparencia Movil Menu', THEMEDOMAIN),
			'transparency-menu' => __('Transparencia Footer Menu', THEMEDOMAIN),
		)
	);
}
add_action('init', 'register_my_menus');


/**********************************************************************************/
/* Menu Walker Services Menu */
/**********************************************************************************/
class My_menu_services_Walker extends Walker_Nav_Menu {

	public function start_el ( &$output, $item, $depth = 0, $args = array(), $id = 0 )
	{
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
	    $class_names = $value = '';
	    $classes = empty( $item->classes ) ? array() : (array) $item->classes;
	    $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
	    $class_names = ' class="'. esc_attr( $class_names ) . '"';
	    $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';
	    $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->title ) . ' ' . esc_attr( $item->attr_title ) .'"' : '';
	    $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
	    $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';

		$content    = apply_filters( 'the_title', $item->title, $item->ID );
		$title      = apply_filters( 'the_title', $item->attr_title, $item->ID );

		$attributes .= ' href="' . $item->url . '"';

		$item_output = $args->before;
		$item_output .= '<a ' . $attributes . ' >';
		$item_output .= '<span class="mnu-products__list__text">' . $content . ' <span class="text-uppercase mnu-products__list__text--label">' . $title . '</span></span>';
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}




/**********************************************************************************/
/* Menu Walker Services Menu Movil */
/**********************************************************************************/
class My_menu_services_movil_Walker extends Walker_Nav_Menu {

	public function start_el ( &$output, $item, $depth = 0, $args = array(), $id = 0 )
	{
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
	    $class_names = $value = '';
	    $classes = empty( $item->classes ) ? array() : (array) $item->classes;
	    $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
	    $class_names = ' class="'. esc_attr( $class_names ) . '"';
	    $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

	    //$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->title ) . ' ' . esc_attr( $item->attr_title ) .'"' : '';
	    $attributes = ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
	    $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';

		$content    = apply_filters( 'the_title', $item->title, $item->ID );
		$title      = apply_filters( 'the_title', $item->attr_title, $item->ID );

		$attributes .= ' href="' . $item->url . '"';

		$item_output = $args->before;
		$item_output .= '<a ' . $attributes . ' class="services services--' . $item->attr_title . '">';
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}



/**********************************************************************************/
/* Add Sidebar Support */
/**********************************************************************************/
if (function_exists('register_sidebar'))
{
	register_sidebar(
		array(
			'name'          => __('Home Servicios', THEMEDOMAIN),
			'id'            => 'main-sidebar',
			'description'   => __('Area del sidebar principal', THEMEDOMAIN),
			'before_widget' => '<article class="main__services__service">',
			// 'before_widget' => '<article class="main__services__service main__services__service--">',
			'after_widget'  => '</article><!-- end main__services__service -->',
			'before_title'  => '<h2 class="main__services__service__text">',
			'after_title'   => '</h2>'
		)
	);

	register_sidebar(
		array(
			'name'          => __('Home Enlaces', THEMEDOMAIN),
			'id'            => 'links-home',
			'description'   => __('Area del sidebar principal', THEMEDOMAIN),
			'before_widget' => '<article class="main__links__item">',
			'after_widget'  => '</article><!-- end main__links__item -->',
			'before_title'  => '<h3 class="text-uppercase">',
			'after_title'   => '</h3>'
		)
	);

	register_sidebar(
		array(
			'name'          => __('Home Enlaces para Móvil', THEMEDOMAIN),
			'id'            => 'links-movil-home',
			'description'   => __('Area del sidebar principal', THEMEDOMAIN),
			'before_widget' => '<article class="main__links__item">',
			'after_widget'  => '</article><!-- end main__links__item -->',
			'before_title'  => '<h3 class="text-uppercase">',
			'after_title'   => '</h3>'
		)
	);
}


/**********************************************************************************/
/* Support Post Type Page */
/**********************************************************************************/
add_action('init', 'ilc_add_excerpts_to_pages');
function ilc_add_excerpts_to_pages()
{
	add_post_type_support( 'page', 'excerpt' );
}
// Permitimos utilizar shortcode en excerpt
add_filter ('the_excerpt', 'do_shortcode');




/**********************************************************************************/
/* Filter The Content */
/**********************************************************************************/
add_filter( 'the_content', 'my_content_blog' );
if ( !function_exists('my_content_blog') )
{
	function my_content_blog( $content )
	{
		if ( is_category() )
		{
			$content = '<p class="main__blog__item__content__text">' . strip_tags($content) . '</p>';
		}

		return $content;
	}
}


/***********************************************************************************************/
/* Custom Function for Displaying Comments */
/***********************************************************************************************/
function ilc_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;

	if (get_comment_type() == 'pingback' || get_comment_type() == 'trackback') : ?>

		<li class="pingback" id="comment-<?php comment_ID(); ?>">

			<article <?php comment_class('clearfix'); ?>>

				<header>

					<h4><?php _e('Pingback:', THEMEDOMAIN); ?></h4>
					<p><?php edit_comment_link(); ?></p>

				</header>

				<?php comment_author_link(); ?>

			</article>

	<?php endif; ?>

	<?php if (get_comment_type() == 'comment') : ?>
		<li id="comment-<?php comment_ID(); ?>">

			<article <?php comment_class('clearfix'); ?>>

				<header>

					<figure class="comment-avatar">
						<?php
							$avatar_size = 80;
							if ($comment->comment_parent != 0) {
								$avatar_size = 48;
							}

							echo get_avatar($comment, $avatar_size);
						?>
					</figure>

					<div class="comment-info">
						<h4><span><?php _e('AUTOR', THEMEDOMAIN); ?></span><?php comment_author_link(); ?></h4>
						<p><?php comment_date(); ?> <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?></p>
						<p><span>Comentario</span></p>
					</div><!-- end comment-info -->

				</header>

				<div class="comment-text">

					<?php if ($comment->comment_approved == '0') : ?>

						<p class="awaiting-moderation text-center"><?php _e('Tu comentario está esperando ser moderado.', THEMEDOMAIN); ?></p>

					<?php endif; ?>

					<?php comment_text(); ?>

				</div><!-- end comment-text -->

			</article>

	<?php endif;
}

/***********************************************************************************************/
/* Custom Comment Form */
/***********************************************************************************************/
function ilc_custom_comment_form($defaults) {
	//var_dump($defaults);
	$comment_notes_after = '' .
		'<div class="allowed-tags">' .
		'<p><strong>' . __('Etiquetas permitidas', THEMEDOMAIN) . '</strong></p>' .
		'<code> ' . allowed_tags() . ' </code>' .
		'</div> <!-- end allowed-tags -->';

	$defaults['comment_notes_before'] = '';
	//$defaults['comment_notes_after'] = $comment_notes_after;
	$defaults['comment_notes_after'] = '';
	$defaults['title_reply'] = __('Comentarios', THEMEDOMAIN);
	$defaults['label_submit'] = __('enviar', THEMEDOMAIN);
	$defaults['id_form'] = 'comment-form';
	$defaults['comment_field'] = '<p><textarea name="comment" id="comment" rows="3" placeholder="' . __('Ingresa aquí tu comentario', THEMEDOMAIN) . '"></textarea></p>';

	return $defaults;
}

add_filter('comment_form_defaults', 'ilc_custom_comment_form');

function ilc_custom_comment_fields() {
	$commenter = wp_get_current_commenter();
	$req       = get_option('require_name_email');
	$aria_req  = ($req ? " aria-required='true'" : '');

	$fields = array(
		'author' => '<p>' .
						'<input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" placeholder="' . __('Nombre o seudónimo', THEMEDOMAIN) . '' . ($req ? __(' (requerido) ', THEMEDOMAIN) : '') . '" ' . $aria_req . ' />' .
						'<label for="author" class="text-hide">' . __('Name', THEMEDOMAIN) . '' . ($req ? __(' (required)', THEMEDOMAIN) : '') . '</label>' .
		            '</p>',
		'email' => '<p>' .
						'<input id="email" name="email" type="text" value="' . esc_attr($commenter['comment_author_email']) . '" placeholder="' . __('Email', THEMEDOMAIN) . '' . ($req ? __(' (requerido)', THEMEDOMAIN) : '') . '" ' . $aria_req . ' />' .
						'<label for="email" class="text-hide">' . __('Email', THEMEDOMAIN) . '' . ($req ? __(' (required) (will not be published)', THEMEDOMAIN) : '') . '</label>' .
		           '</p>',
		//'url' => '<p>' .
		//				'<input id="url" name="url" type="text" value="' . esc_attr($commenter['comment_author_url']) . '" />' .
		//				'<label for="url">' . __('Website', THEMEDOMAIN) . '</label>' .
		//            '</p>'
	);

	return $fields;
}

add_filter('comment_form_default_fields', 'ilc_custom_comment_fields');



/**********************************************************************************/
/* Cortar texto */
/**********************************************************************************/
function getSubString($string, $length = NULL)
{
    //Si no se especifica la longitud por defecto es 50
    if ($length == NULL)
        $length = 50;
    //Primero eliminamos las etiquetas html y luego cortamos el string
    $stringDisplay = substr(strip_tags($string), 0, $length);
    //Si el texto es mayor que la longitud se agrega puntos suspensivos
    if (strlen(strip_tags($string)) > $length)
        $stringDisplay .= ' ...';
    return $stringDisplay;
}


/**********************************************************************************/
/* Array Months */
/**********************************************************************************/
$months = array('Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Set', 'Oct', 'Nov', 'Dic');





/**********************************************************************************/
/* Send Email Ajax */
/**********************************************************************************/
add_action( 'wp_ajax_send_email', 'send_email_callback' );
add_action( 'wp_ajax_nopriv_send_email', 'send_email_callback' );

function send_email_callback()
{
	$nonce = $_POST['nonce'];

	if ( !wp_verify_nonce( $nonce, 'myajax-post-comment-nonce') )
	{
		die( 'Acceso denegado' );
	}

	$type   = $_POST['type'];

	$error_name     = false;
	$error_email    = false;
	$error_dni      = false;
	$error_phone    = false;
	$error_dpto     = false;
	$error_message  = false;

	$name           = '';
	$email          = '';
	$dni            = '';
	$phone          = '';
	$dpto           = '';
	$message        = '';
	$receiver_email = '';
	$email_sent     = array();

	// Name
	if (sanitize_text_field(trim($_POST['name'])) === '')
	{
      $error_name = true;
    }
    else
    {
      $name = sanitize_text_field(trim($_POST['name']));
    }

    // Email
    if (sanitize_email(trim($_POST['email'])) === '' || !is_email($_POST['email']))
    {
      $error_email = true;
    }
    else
    {
      $email = sanitize_email(trim($_POST['email']));
    }

    if ($type === 'Consultas')
    {
	    // DNI
	    if (sanitize_text_field(trim($_POST['dni'])) === '' || (strlen($_POST['dni']) < 8 || strlen($_POST['dni']) > 8) || !is_numeric($_POST['dni']))
	    {
	      $error_dni = true;
	    }
	    else
	    {
	      $dni = sanitize_text_field(trim($_POST['dni']));
	    }

	    // Phone
	    if (sanitize_text_field(trim($_POST['phone'])) === '' || (strlen($_POST['phone']) < 7 || strlen($_POST['phone']) > 12) || !is_numeric($_POST['phone']))
	    {
	      $error_phone = true;
	    }
	    else
	    {
	      $phone = sanitize_text_field(trim($_POST['phone']));
	    }

		$parent = get_category_by_slug('ciudades');
        $args = array(
          'parent'  => $parent->cat_ID
        );
        $cities = get_categories( $args );
        $newArr = array();
        foreach ($cities as $city) {
        	$newArr[] = $city->name;
        }
        $cities = $newArr;

	    // Dpto
	    if (trim($_POST['dpto']) === '' && !in_array($_POST['dpto'], $cities))
	    {
	      $error_dpto = true;
	    }
	    else
	    {
	      	$dpto = sanitize_text_field(trim($_POST['dpto']));
	    }
    }

    // Message
    if (sanitize_text_field(trim($_POST['message'])) === '')
    {
      $error_message = true;
    }
    else
    {
      $message = stripslashes(trim($_POST['message']));
    }

    if (!$error_name && !$error_email && !$error_dni && !$error_phone && !$error_dpto && !$error_message)
    {
    	// Get the receiver email from the backend
		$options = get_option('ilc_custom_settings');
		$receiver_email = $options['contact_email'];

		// If none is specified, get the WP admin email
		if (!isset($receiver_email) || $receiver_email == '')
		{
			$receiver_email = get_option('admin_email');
		}

		$subject = 'Has sido contactado por '. $name;

		ob_start();

		include TEMPLATEPATH . '/includes/template-email.php';

		$content = ob_get_contents();

		ob_get_clean();

		/*$headers = "From: $email" . PHP_EOL;
		$headers .= "Reply-To: $email" . PHP_EOL;
		$headers .= "MIME-Version: 1.0" . PHP_EOL;
		$headers .= "Content-type: text/html; charset=utf-8" . PHP_EOL;
		$headers .= "Content-Transfer-Encoding: quoted-printable" . PHP_EOL;*/

		$headers[] = "From: ILC $email";
		$headers[] = "Reply-To: $email";
		$headers[] = "Content-type: text/html; charset=utf-8";

		if (wp_mail($receiver_email, $subject, $content, $headers))
		{
			$email_sent['result'] = TRUE;
		}
		else
		{
			$email_sent['result'] = FALSE;
		}
    }
    else
    {
		// Debemos mostrar mensaje de error
		$email_sent['result'] = FALSE;
    }

    echo json_encode($email_sent);
    die();
}




/**********************************************************************************/
/* Get Agencias Ajax */
/**********************************************************************************/
add_action( 'wp_ajax_get_agencias', 'get_agencias_callback' );
add_action( 'wp_ajax_nopriv_get_agencias', 'get_agencias_callback' );

function get_agencias_callback()
{
	$nonce = $_POST['nonce'];
	$result = array( 'result' => FALSE );

	if ( !wp_verify_nonce( $nonce, 'myajax-post-comment-nonce') )
	{
		die( 'Acceso denegado!' );
	}

	global $post;

	$ciudad   = sanitize_text_field( $_POST['ciudad'] );
	$distrito = (int)$_POST['distrito'];
	// $tag      = (int)$_POST['tag'];
	$page     = (int)$_POST['page'];

	$cityName = ($ciudad > 0) ? get_the_category_by_ID( $ciudad ) : '';
	$distritoName = ($distrito > 0) ? get_the_category_by_id( $distrito ) : '';
	// $tagName = ($tag > 0) ? get_tag( $tag ) : '';

	$args = array(
		'post_status'   => 'publish',
		'post_type'     => 'agencias',
		'orderby'       => 'menu_order',
		'order'         => 'ASC',
		'offset'        => ( $page - 1 ) * 8
	);

	if ( $distrito > 0 )
	{
		$args['cat'] = $distrito;
	}
	/*elseif ( $tag)
	{
		$args['tag_id'] = $tag;
	}*/
	else
	{
		$args['cat'] = $ciudad;
	}

	$the_query = new WP_Query( $args );

	if ( $the_query->have_posts() )
	{
		$result['result'] = TRUE;

		ob_start();

		include TEMPLATEPATH . '/includes/agencias-ajax.php';

		$content = ob_get_contents();

		ob_get_clean();

		$result['content'] = $content;
	}

	wp_reset_postdata();

	echo json_encode( $result );

	die();
}



/**********************************************************************************/
/* Get Distritos Ajax */
/**********************************************************************************/
add_action( 'wp_ajax_get_distritos', 'get_distritos_callback' );
add_action( 'wp_ajax_nopriv_get_distritos', 'get_distritos_callback' );

function get_distritos_callback()
{
	$nonce = $_POST['nonce'];
	$result = array( 'result' => FALSE );

	if ( !wp_verify_nonce( $nonce, 'myajax-post-comment-nonce') )
	{
		die( 'Acceso denegado' );
	}

	global $post;


	$ciudad = sanitize_text_field( $_POST['ciudad'] );

	$args = array(
		'parent' => $ciudad
	);

	$distritos = get_categories( $args );

	if ( count($distritos) )
	{
		$result['result'] = TRUE;
		$result['distritos'] = $distritos;
	}

	echo json_encode( $result );

	die();
}




/**********************************************************************************/
/* Set posts_per_page query search category Novedades                             */
/**********************************************************************************/
add_action('pre_get_posts', 'set_customs_var_query');

function set_customs_var_query($query)
{
	if (is_home() && $query->is_category('la-felicidad-en-minutos')) {
		$url = get_current_page_url();
		$urlParts = explode('/', $url);
		if (count($urlParts) === 5) {
			$query->set('paged', $urlParts[4]);
		}
	}
}


/**********************************************************************************/
/* Separar titulo de página en dos para mostrar texto en regular y bold */
/**********************************************************************************/
function separteTitle($title)
{
	$arrTitle = explode(' ', $title);
	return array_shift($arrTitle) . ' <span>' . implode(' ', $arrTitle) . '</span>';
}


if ( ! function_exists( 'get_current_page_url' ) ) {
	function get_current_page_url() {
  	global $wp;
  	return add_query_arg( $_SERVER['QUERY_STRING'], '', home_url( $wp->request ) );
	}
}

if ( ! function_exists( 'the_current_page_url' ) ) {
	function the_current_page_url() {
	  echo get_current_page_url();
	}
}


/**********************************************************************************/
/* Change Logo and footer Area Administration */
/**********************************************************************************/
// Cambiamos el logo para el formulario de acceso al wordpress
function my_custom_login_logo()
{
    echo '<style type="text/css">h1 a {background-color: #335abc; background-image:url('.get_bloginfo('template_directory').'/images/logo-footer.png) !important; background-size: contain !important; width: 100% !important;}</style>';
}
add_action('login_head', 'my_custom_login_logo');


// Cambiar el pie de pagina del panel de Administración
function change_footer_admin()
{
    echo 'Copyright © ' . date('Y') . ' Inversiones La Cruz - Web desarrollada por <a target="_blank" href="http://watson.pe">Agencia Watson</a>';
}
add_filter('admin_footer_text', 'change_footer_admin');


/**********************************************************************************/
/* Load Theme Options Page and Custom Widgets */
/**********************************************************************************/
require_once('functions/ilc-theme-customizer.php');
require_once('functions/widget-links-secondary.php');
require_once('functions/widget-links-main.php');


function login_errors_message() {
	return 'Ooooops!';
}
add_filter('login_errors', 'login_errors_message');

remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);




/*
 * Dump helper. Functions to dump variables to the screen, in a nicley formatted manner.
 * @author Joost van Veen
 * @version 1.0
 */
if (!function_exists('dump')) {
    function dump($var, $label = 'Dump', $echo = true)
    {
        // Store dump in variable
        ob_start();
        var_dump($var);
        $output = ob_get_clean();

        // Add formatting
        $output = preg_replace("/\]\=\>\n(\s+)/m", '] => ', $output);
        $output = '<pre style="background: #FFFEEF; color: #000; border: 1px dotted #000; padding: 10px; margin: 10px 0; text-align: left;">'.$label.' => '.$output.'</pre>';

        // Output
        if ($echo == true) {
            echo $output;
        } else {
            return $output;
        }
    }
}

if (!function_exists('dump_exit')) {
    function dump_exit($var, $label = 'Dump', $echo = true)
    {
        dump($var, $label, $echo);
        exit;
    }
}
