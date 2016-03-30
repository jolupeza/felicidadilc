<style type="text/css">
    td {
        padding: 5px;
    }
    .subtitle {
        color: #686868;
        display: block;
        font-size: 10pt;
        font-weight: 700;
        text-transform: uppercase;
    }
    .cel {
        border: 0.1mm solid #686868;
        color: #686868;
        font-size: 9pt;
    }
    .cel--nl {
        border-left: none;
    }
    .cel--nb {
        border-bottom: none;
    }
    .cel--nbd {
        border: none;
    }
</style>

<?php
    while ($the_query->have_posts()) :
        $the_query->the_post();

        $namePdf = get_the_title();

        $values = get_post_custom($id);
        $name = (isset($values['mb_name'][0])) ? esc_attr($values['mb_name'][0]) : '';
        $address = (isset($values['mb_address'][0])) ? esc_attr($values['mb_address'][0]) : '';
        $city = (isset($values['mb_city'][0])) ? esc_attr($values['mb_city'][0]) : '';
        $dni = (isset($values['mb_dni'][0])) ? esc_attr($values['mb_dni'][0]) : '';
        $email = (isset($values['mb_email'][0])) ? esc_attr($values['mb_email'][0]) : '';
        $phone = (isset($values['mb_phone'][0])) ? esc_attr($values['mb_phone'][0]) : '';
        $cel = (isset($values['mb_cel'][0])) ? esc_attr($values['mb_cel'][0]) : '';
        $response = (isset($values['mb_response'][0])) ? esc_attr($values['mb_response'][0]) : '';
        $response = (!empty($response) && $response === '1') ? 'En domicilio' : 'Correo electr&oacute;nico';
        $tutor = (isset($values['mb_tutor'][0])) ? esc_attr($values['mb_tutor'][0]) : '';
        $dniTutor = (isset($values['mb_dni_tutor'][0])) ? esc_attr($values['mb_dni_tutor'][0]) : '';
        $service = (isset($values['mb_service'][0])) ? esc_attr($values['mb_service'][0]) : '';
        $monto = (isset($values['mb_monto'][0])) ? esc_attr($values['mb_monto'][0]) : '';
        $contrato = (isset($values['mb_contrato'][0])) ? esc_attr($values['mb_contrato'][0]) : '';
        $asunto = (isset($values['mb_asunto'][0])) ? esc_attr($values['mb_asunto'][0]) : '';
        $obs = (isset($values['mb_obs'][0])) ? esc_attr($values['mb_obs'][0]) : '';
        $detail = (isset($values['mb_detail'][0])) ? esc_attr($values['mb_detail'][0]) : '';
        $order = (isset($values['mb_order'][0])) ? esc_attr($values['mb_order'][0]) : '';
        $obs = (isset($values['mb_obs'][0])) ? esc_attr($values['mb_obs'][0]) : '';
        $date_response = (isset($values['mb_date_response'][0])) ? esc_attr($values['mb_date_response'][0]) : '';
        $date_response = date('d-m-Y', strtotime($date_response));

        switch ($service) {
            case '1':
                $service = 'Cr&eacute;dito con garant&iacute;a de Joyas';
                break;
            case '2':
                $service = 'Cr&eacute;dito con garant&iacute;a de Artículos';
                break;
            case '3':
                $service = 'Cr&eacute;dito con garant&iacute;a Vehicular';
                break;
        }

        switch ($asunto) {
            case '1':
                $asunto = 'Reclamo';
                break;
            case '2':
                $asunto = 'Pedido';
                break;
            case '3':
                $asunto = 'Consulta';
                break;
        }

        // Obtener nombre de Ciudad o Departamento
        $cityName = '';
        if (!empty($city)) {
            $city = (int) $city;
            $cityData = get_category($city);

            if (!is_null($cityData)) {
                $cityName = $cityData->name;
            }
        }

        $date = get_the_time('l j').' de '.ucfirst(get_the_time('F')).' del '.get_the_time('Y');
        $logo = ABSPATH.'wp-content'.DIRECTORY_SEPARATOR.'plugins'.DIRECTORY_SEPARATOR.'ilc-manager'.DIRECTORY_SEPARATOR.'admin'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'logo.jpg';
        $logo_url = home_url('wp-content/plugins/ilc-manager/admin/images/logo.jpg');

        $logo_footer = ABSPATH.'wp-content'.DIRECTORY_SEPARATOR.'plugins'.DIRECTORY_SEPARATOR.'ilc-manager'.DIRECTORY_SEPARATOR.'admin'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'logo-footer.png';
?>

<page backtop="10mm" backbottom="10mm" backleft="10mm" backright="10mm">
    <!-- <page_header>
        <table style="width: 100%;">
            <tr>
                <td style="text-align: left; width: 50%; fotnt-size: 9pt; color: #686868;">Hora de Solicitud: <?php //the_time('G:i a'); ?></td>
                <td style="text-align: right; width: 50%; fotnt-size: 9pt; color: #686868;">Lima, <?php //echo $date; ?></td>
            </tr>
        </table>
    </page_header> -->

    <page_footer>
        <table style="width: 100%;">
            <tr>
                <td style="text-align: center; width: 100%;">
                    <img src="<?php echo $logo_footer; ?>" alt="Inversiones La Cruz" style="width: 40%" />
                </td>
            </tr>
        </table>
    </page_footer>

    <table style="width: 100%;" cellspacing="0">
        <tr>
            <td style="text-align: left; width: 50%; fotnt-size: 9pt; color: #686868;">Hora de Solicitud: <?php the_time('h:i a'); ?></td>
            <td style="text-align: right; width: 50%; fotnt-size: 9pt; color: #686868;">Lima, <?php echo $date; ?></td>
        </tr>
    </table>

    <table cellspacing="0" style="width: 100%;">
        <tr>
            <td style="width: 100%;"><img src="<?php echo $logo; ?>" style="width: 100%;" alt="Inversiones La Cruz" /></td>
        </tr>
        <tr>
            <td style="width: 100%; text-transform: uppercase; font-size: 13pt; color: #686868; font-weight: 600; text-align: center;">Atencion al Cliente - Libro de Reclamaciones</td>
        </tr>
        <tr>
            <td style="width: 100%; font-size: 10pt; color: #686868; text-align: center; text-transform: uppercase;">EDPYME Inversiones La Cruz S.A. RUC: 20538763072</td>
        </tr>
        <tr>
            <td style="width: 100%; font-size: 10pt; color: #686868; text-align: right; text-transform: uppercase; font-weight: bold;">N&#176; <?php the_title(); ?></td>
        </tr>
    </table>

    <br />

    <span class="subtitle">1. Identificaci&Oacute;n del cliente</span>

    <br />
    <br />

    <table style="width: 100%;" cellspacing="0">
        <tr>
            <td class="cel cell--nb" style="width: 20%;">Nombre Completo:</td>
            <td class="cel cel--nl cell--nb" style="width: 80%;"><?php echo $name; ?></td>
        </tr>
        <tr>
            <td class="cel" style="width: 20%;">Domicilio:</td>
            <td class="cel cel--nl" style="width: 80%;"><?php echo $address; ?></td>
        </tr>
    </table>
    <table style="width: 100%;" cellspacing="0">
        <tr>
            <td class="cel" style="width: 25%;">Ciudad:</td>
            <td class="cel cel--nl" style="width: 25%;"><?php echo $cityName; ?></td>
            <td class="cel" style="width: 25%;">Correo Electr&oacute;nico:</td>
            <td class="cel cel--nl" style="width: 25%;"><?php echo $email; ?></td>
        </tr>
    </table>
    <table style="width: 100%;" cellspacing="0">
        <tr>
            <td class="cel" style="width: 16.67%;">DNI o CE:</td>
            <td class="cel cel--nl" style="width: 16.67%;"><?php echo $dni; ?></td>
            <td class="cel cel--nl" style="width: 16.67%;">Tel&eacute;fono:</td>
            <td class="cel cel--nl" style="width: 16.67%;"><?php echo $phone; ?></td>
            <td class="cel cel--nl" style="width: 16.67%;">Celular:</td>
            <td class="cel cel--nl" style="width: 16.67%;"><?php echo $cel; ?></td>
        </tr>
    </table>
    <table style="width: 100%;" cellspacing="0">
        <tr>
            <td class="cel" style="width: 40%;">Padre, Madre o Tutor (para - 18 a&ntilde;os)</td>
            <td class="cel cel--nl" style="width: 60%;"><?php echo $tutor; ?></td>
        </tr>
    </table>
    <table style="width: 100%;" cellspacing="0">
        <tr>
            <td class="cel" style="width: 25%;">DNI o CE:</td>
            <td class="cel cel--nl" style="width: 25%;"><?php echo $dniTutor; ?></td>
            <td class="cel" style="width: 25%;">Método de respuesta:</td>
            <td class="cel cel--nl" style="width: 25%;"><?php echo $response; ?></td>
        </tr>
    </table>

    <br />
    <br />

    <span class="subtitle">2. Identificaci&Oacute;n del producto o servicio contratado</span>

    <br />
    <br />

    <table style="width: 100%;" cellspacing="0">
        <tr>
            <td class="cel" style="width: 20%;">Tipo de Producto:</td>
            <td class="cel cel--nl" style="width: 80%;"><?php echo $service; ?></td>
        </tr>
    </table>
    <table style="width: 100%;" cellspacing="0">
        <tr>
            <td class="cel" style="width: 25%;">N&#176; de Contrato:</td>
            <td class="cel cel--nl" style="width: 25%;"><?php echo $contrato; ?></td>
            <td class="cel" style="width: 25%;">Monto a reclamar:</td>
            <td class="cel cel--nl" style="width: 25%;"><?php echo $monto; ?></td>
        </tr>
    </table>

    <br />
    <br />

    <span class="subtitle">3. Detalle del asunto</span>

    <br />
    <br />

    <table style="width: 60%;" cellspacing="0">
        <tr>
            <td class="cel" style="width: 50%;">Tipo de Asunto:</td>
            <td class="cel cel--nl" style="width: 50%;"><?php echo $asunto; ?></td>
        </tr>
        <tr>
            <td class="cel" style="width: 50%;">Detalle de la Reclamaci&oacute;n:</td>
            <td class="cel cel--nbd" style="width: 50%;"></td>
        </tr>
    </table>

    <table style="width: 100%;" cellspacing="0">
        <tr>
            <td colspan="2" class="cel" style="width: 100%;"><?php echo $detail; ?></td>
        </tr>
        <tr>
            <td class="cel" style="width: 30%;">Pedido:</td>
            <td class="cel cel--nbd" style="width: 70%;"></td>
        </tr>
        <tr>
            <td colspan="2" class="cel" style="width: 100%;"><?php echo $order; ?></td>
        </tr>
    </table>

    <br />
    <br />

    <span class="subtitle">4. Acciones de EDPYME Inversiones La Cruz</span>

    <br />
    <br />

    <table style="width: 60%;" cellspacing="0">
        <tr>
            <td class="cel" style="width: 50%;">Fecha de Respuesta:</td>
            <td class="cel cel--nl" style="width: 50%;"><?php echo $date_response; ?></td>
        </tr>
        <tr>
            <td class="cel" style="width: 50%;">Respuesta del Área:</td>
            <td class="cel cel--nbd" style="width: 50%;"></td>
        </tr>
    </table>

    <table style="width: 100%;" cellspacing="0">
        <tr>
            <td class="cel" style="width: 100%;"><?php echo $obs; ?></td>
        </tr>
    </table>

    <br />
    <br />

    <span class="subtitle">5. Notas importantes</span>

    <br />
    <br />

    <table style="width: 100%;" cellspacing="0">
        <tr>
            <td class="cel cel--nbd" style="width: 100%;">
                1. De acuerdo a la circular N&#176; G-146-2009, la consulta, reclamo, o queja presentado por el usuario a trav&eacute;s del presente documento ha sido derivado al &aacute;rea de Atenci&oacute;n al Usuario y ser&aacute; atendido en un plazo que no podr&aacute; exceder los 30 d&iacute;as calendarios, salvo que la naturaleza del reclamo as&iacute; lo justifique.
            </td>
        </tr>
        <tr>
            <td class="cel cel--nbd" style="width: 100%;">
                2. Si al recibir nuestra respuesta, puede presentar su RECONSIDERACI&Oacute;N a nuestra empresa en cualquier agencia o acudir al Servicio de Atenci&oacute;n al Ciudadano de INDECOPI, l&iacute;nea gratuita a nivel nacional 0-800-44040, o a la Plataforma de Atenci&oacute;n al Usuario (PAU) de la Superintendencia de Banca, Seguros y AFPs, l&iacute;nea gratuita a nivel nacional 0-800-10840, v&iacute;a correo electr&oacute;nico pau@sbs.gob.pe.
            </td>
        </tr>
    </table>

</page>

<?php endwhile; ?>