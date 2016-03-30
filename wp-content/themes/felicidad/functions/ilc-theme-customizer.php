<?php
    /***********************************************************************************************/
    /* Add a menu option to link to the customizer */
    /***********************************************************************************************/
    add_action('admin_menu', 'display_custom_options_link');
    function display_custom_options_link()
    {
        add_theme_page('Opciones Theme ILC', 'Opciones Theme ILC', 'edit_theme_options', 'customize.php');
    }

    /***********************************************************************************************/
    /* Add options in the theme customizer page */
    /***********************************************************************************************/
    add_action('customize_register', 'ilc_customize_register');
    function ilc_customize_register($wp_customize)
    {
        $currentUser = wp_get_current_user();
        if ($currentUser->roles[0] === 'administrator') {
            // Logo Web
            $wp_customize->add_section('ilc_logo', array(
                'title' => __('Logo', THEMEDOMAIN),
                'description' => __('Le permite cargar un logo personalizado.', THEMEDOMAIN),
                'priority' => 35,
            ));

                $wp_customize->add_setting('ilc_custom_settings[logo]', array(
                'default' => IMAGES.'/logo-web.png',
                'type' => 'option',
            ));

                $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'logo', array(
                'label' => __('Sube tu Logo', THEMEDOMAIN),
                'section' => 'ilc_logo',
                'settings' => 'ilc_custom_settings[logo]',
            )));

                    // Logo Movil
            $wp_customize->add_section('ilc_logo_movil', array(
                'title' => __('Logo Móvil', THEMEDOMAIN),
                'description' => __('Le permite cargar un logo personalizado.', THEMEDOMAIN),
                'priority' => 36,
            ));

                $wp_customize->add_setting('ilc_custom_settings[logo_movil]', array(
                'default' => IMAGES.'/logo-movil.png',
                'type' => 'option',
            ));

                $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'logo_movil', array(
                'label' => __('Sube tu Logo', THEMEDOMAIN),
                'section' => 'ilc_logo_movil',
                'settings' => 'ilc_custom_settings[logo_movil]',
            )));

            // Logo Sidebar Movil
            $wp_customize->add_section('ilc_logo_sidebar_movil', array(
                'title' => __('Logo Sidebar Móvil', THEMEDOMAIN),
                'description' => __('Le permite cargar un logo personalizado.', THEMEDOMAIN),
                'priority' => 37,
            ));

                $wp_customize->add_setting('ilc_custom_settings[logo_sidebar_movil]', array(
                'default' => IMAGES.'/logo-sidebar.png',
                'type' => 'option',
            ));

                $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'logo_sidebar_movil', array(
                'label' => __('Sube tu Logo', THEMEDOMAIN),
                'section' => 'ilc_logo_sidebar_movil',
                'settings' => 'ilc_custom_settings[logo_sidebar_movil]',
            )));

            // Logo Sidebar Movil
            $wp_customize->add_section('ilc_logo_footer', array(
                'title' => __('Logo Footer', THEMEDOMAIN),
                'description' => __('Le permite cargar un logo personalizado.', THEMEDOMAIN),
                'priority' => 38,
            ));

                $wp_customize->add_setting('ilc_custom_settings[logo_footer]', array(
                'default' => IMAGES.'/logo-footer.png',
                'type' => 'option',
            ));

                $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'logo_footer', array(
                'label' => __('Sube tu Logo', THEMEDOMAIN),
                'section' => 'ilc_logo_footer',
                'settings' => 'ilc_custom_settings[logo_footer]',
            )));

            // Social Media
            $wp_customize->add_section('ilc_social', array(
                'title' => __('Links Redes Sociales', THEMEDOMAIN),
                'description' => __('Mostrar links a redes sociales.', THEMEDOMAIN),
                'priority' => 39,
            ));

                $wp_customize->add_setting('ilc_custom_settings[display_social_link]', array(
                'default' => 0,
                'type' => 'option',
            ));

                $wp_customize->add_control('ilc_custom_settings[display_social_link]', array(
                'label' => __('¿Mostrar links?', THEMEDOMAIN),
                'section' => 'ilc_social',
                'settings' => 'ilc_custom_settings[display_social_link]',
                'type' => 'checkbox',
            ));

            // Facebook
            $wp_customize->add_setting('ilc_custom_settings[facebook]', array(
                'default' => '',
                'type' => 'option',
            ));

                $wp_customize->add_control('ilc_custom_settings[facebook]', array(
                'label' => __('Facebook', THEMEDOMAIN),
                'section' => 'ilc_social',
                'settings' => 'ilc_custom_settings[facebook]',
                'type' => 'text',
            ));

            // Twitter
            $wp_customize->add_setting('ilc_custom_settings[twitter]', array(
                'default' => '',
                'type' => 'option',
            ));

                $wp_customize->add_control('ilc_custom_settings[twitter]', array(
                'label' => __('Twitter', THEMEDOMAIN),
                'section' => 'ilc_social',
                'settings' => 'ilc_custom_settings[twitter]',
                'type' => 'text',
            ));

            // Información
            $wp_customize->add_section('ilc_info', array(
                'title' => __('Datos de la empresa', THEMEDOMAIN),
                'description' => __('Configurar datos de información de la empresa.', THEMEDOMAIN),
                'priority' => 40,
            ));

                $wp_customize->add_setting('ilc_custom_settings[central_phone]', array(
                'default' => '',
                'type' => 'option',
            ));

                $wp_customize->add_control('ilc_custom_settings[central_phone]', array(
                'label' => __('Central telefónica', THEMEDOMAIN),
                'section' => 'ilc_info',
                'settings' => 'ilc_custom_settings[central_phone]',
                'type' => 'text',
            ));

                $wp_customize->add_setting('ilc_custom_settings[contact_email]', array(
                'default' => '',
                'type' => 'option',
            ));

                $wp_customize->add_control('ilc_custom_settings[contact_email]', array(
                'label' => __('Email receptor formulario de contacto', THEMEDOMAIN),
                'section' => 'ilc_info',
                'settings' => 'ilc_custom_settings[contact_email]',
                'type' => 'text',
            ));
        }

        // Format CV
        $wp_customize->add_section('ilc_format_cv', array(
            'title' => __('Formato CV', THEMEDOMAIN),
            'description' => __('Cargar PDF con formato de CV.', THEMEDOMAIN),
            'priority' => 41,
        ));

        $wp_customize->add_setting('ilc_custom_settings[format_cv]', array(
            'default' => '',
            'type' => 'option',
        ));

        $wp_customize->add_control(new WP_Customize_Upload_Control($wp_customize, 'format_cv', array(
            'label' => __('Subir PDF', THEMEDOMAIN),
            'section' => 'ilc_format_cv',
            'settings' => 'ilc_custom_settings[format_cv]',
        )));
    }
