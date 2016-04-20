<!DOCTYPE html>
<!--[if IE 8]> <html <?php language_attributes(); ?> class="ie8"> <![endif]-->
<!--[if !IE]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->
  <head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="description" content="<?php bloginfo('description'); ?>">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>

    <!-- Latest Bootstrap compiled and minified CSS -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"> -->

    <!-- Font Awesome -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" />

    <!-- Stylesheets -->
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" />

    <!-- Pingbacks -->
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Favicon and Apple Icons -->
    <link rel="shortcut icon" href="<?php print IMAGES; ?>/icons/favicon.png">
    <!-- <link rel="apple-touch-icon" href="<?php //print IMAGES; ?>/icons/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php //print IMAGES; ?>/icons/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php //print IMAGES; ?>/icons/apple-touch-icon-114x114.png"> -->

    <!-- Script required for extra functionality on the comment form -->
    <?php if (is_singular()) wp_enqueue_script( 'comment-reply' ); ?>

    <!-- Google Maps -->
    <!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAc46ZKbmYbITWqfAXVjMY5phVxS1lElfI"></script> -->
    <!-- <script type="text/javascript" src="https://google-maps-utility-library-v3.googlecode.com/svn/trunk/infobox/src/infobox_packed.js"></script> -->
    <!--script type="text/javascript" src="http://google-maps-utility-library-v3.googlecode.com/svn/trunk/infobox/src/infobox.js"></script-->

    <!-- PictureFill -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/picturefill/2.3.1/picturefill.min.js"></script>

    <?php wp_head(); ?>

    <!-- Facebook Pixel Code -->
    <script>
    !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
    n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
    document,'script','https://connect.facebook.net/en_US/fbevents.js');

      fbq('init', '620944741340401');
      fbq('track', "PageView");
      <?php if (!is_home()) : ?>
        fbq('track', 'ViewContent');
      <?php endif; ?>
    </script>
    <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=620944741340401&ev=PageView&noscript=1"
    /></noscript>
    <!-- End Facebook Pixel Code -->
  </head><!-- end head -->
  <body <?php body_class(); ?>>
    <!-- Google Tag Manager -->
    <noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-NJH7PJ"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    '//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-NJH7PJ');</script>
    <!-- End Google Tag Manager -->

    <?php $options = get_option('ilc_custom_settings'); ?>

    <header class="header sb-slide">

      <?php $logoMovil = empty( $options[ 'logo_movil' ] ) ? IMAGES . '/logo-movil.png' : $options[ 'logo_movil' ]; ?>

      <h1 class="header__logo text-right visible-xs-block visible-sm-block">
        <a href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>">
          <img class="img-responsive" src="<?php echo $logoMovil; ?>" />
        </a>
      </h1><!-- end header__logo -->

      <div class="header__menu sb-toggle-left visible-xs-block visible-sm-block">
        <i class="fa fa-bars"></i>
      </div><!-- end header__menu -->

      <div class="container hidden-xs hidden-sm">
        <div class="row">
          <div class="col-sm-6">

            <?php $logo = empty( $options[ 'logo' ] ) ? IMAGES . '/logo-web.png' : $options[ 'logo' ]; ?>

            <h1 class="header__logo">
              <a href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>">
                <img src="<?php echo $logo; ?>" alt="<?php bloginfo('name'); ?> | <?php bloginfo('description'); ?>" />
              </a>
            </h1><!-- end header__logo -->
          </div><!-- end col-sm-6 -->
          <div class="col-sm-6">
            <?php
              wp_nav_menu(
                array(
                  'theme_location' => 'main-menu',
                  'menu_class' => 'Header-menu list-inline text-center'
                )
              );
              /*wp_nav_menu(
                array(
                  'theme_location' => 'top-menu',
                  'menu_class' => 'header__menutop list-inline'
                )
              );*/
            ?>

          </div><!-- end col-sm-6 -->
        </div><!-- end row -->

        <?php /*
        <nav class="header__main-menu">
          <?php
            wp_nav_menu(
              array(
                'theme_location' => 'main-menu',
                'menu_class' => 'header__main-menu__list list-inline'
              )
            );
          ?>
        </nav><!-- end header__main-menu -->
        */ ?>
      </div>
    </header><!-- end header -->

    <div id="sb-site" class="slidebar">