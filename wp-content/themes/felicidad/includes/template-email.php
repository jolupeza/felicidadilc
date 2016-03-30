<tr>
  <td class="innerpadding bodycontent" style="padding: 30px 50px 30px 50px; background-color: #f7f7f7;">
    <table width="185" align="left" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td class="bodycopy" align="right" style="padding: 10px 10px 10px 10px; font-size: 14px; line-height: 18px; color: #484848; font-family: Arial; font-weight: bold;">Asunto:</td>
      </tr>
      <tr>
        <td class="bodycopy" align="right" style="padding: 10px 10px 10px 10px; font-size: 14px; line-height: 18px; color: #484848; font-family: Arial; font-weight: bold;">Nombre:</td>
      </tr>
      <?php if (!empty($dni)) : ?>
      <tr>
        <td class="bodycopy" align="right" style="padding: 10px 10px 10px 10px; font-size: 14px; line-height: 18px; color: #484848; font-family: Arial; font-weight: bold;">DNI:</td>
      </tr>
      <?php endif; ?>
      <tr>
        <td class="bodycopy" align="right" style="padding: 10px 10px 10px 10px; font-size: 14px; line-height: 18px; color: #484848; font-family: Arial; font-weight: bold;">Correo electrónico:</td>
      </tr>
      <?php if (!empty($phone)) : ?>
      <tr>
        <td class="bodycopy" align="right" style="padding: 10px 10px 10px 10px; font-size: 14px; line-height: 18px; color: #484848; font-family: Arial; font-weight: bold;">Teléfono:</td>
      </tr>
      <?php endif; ?>
      <?php if(!empty($dpto)) : ?>
      <tr>
        <td class="bodycopy" align="right" style="padding: 10px 10px 10px 10px; font-size: 14px; line-height: 18px; color: #484848; font-family: Arial; font-weight: bold;">Departamento:</td>
      </tr>
      <?php endif; ?>
    </table>
    <!--[if (gte mso 9)|(IE)]>
      <table width="415" align="left" cellpadding="0" cellspacing="0" border="0">
        <tr>
          <td>
            <![endif]-->
            <table class="col415" align="left" border="0" cellpadding="0" cellspacing="0" style="max-width: 415px;">
              <tr>
                <td>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td class="bodycopy" style="padding: 10px 10px 10px 10px; font-size: 14px; line-height: 18px; color: #484848; font-family: Arial;"><?php echo $type; ?></td>
                    </tr>
                    <tr>
                      <td class="bodycopy" style="padding: 10px 10px 10px 10px; font-size: 14px; line-height: 18px; color: #484848; font-family: Arial;"><?php echo $name; ?></td>
                    </tr>
                    <?php if (!empty($dni)) : ?>
                    <tr>
                      <td class="bodycopy" style="padding: 10px 10px 10px 10px; font-size: 14px; line-height: 18px; color: #484848; font-family: Arial;"><?php echo $dni; ?></td>
                    </tr>
                    <?php endif; ?>
                    <tr>
                      <td class="bodycopy" style="padding: 10px 10px 10px 10px; font-size: 14px; line-height: 18px; color: #484848; font-family: Arial;"><?php echo $email ?></td>
                    </tr>
                    <?php if (!empty($phone)) : ?>
                    <tr>
                      <td class="bodycopy" style="padding: 10px 10px 10px 10px; font-size: 14px; line-height: 18px; color: #484848; font-family: Arial;"><?php echo $phone; ?></td>
                    </tr>
                    <?php endif; ?>
                    <?php if (!empty($dpto)) : ?>
                    <tr>
                      <td class="bodycopy" style="padding: 10px 10px 10px 10px; font-size: 14px; line-height: 18px; color: #484848; font-family: Arial;">Lima</td>
                    </tr>
                    <?php endif; ?>
                  </table>
                </td>
              </tr>
            </table>
    <!--[if (gte mso 9)|(IE)]>
          </td>
        </tr>
    </table>
    <![endif]-->
  </td>
</tr>
      <tr>
        <td class="innerpadding" style="padding: 30px 50px 30px 50px;">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td class="bodycopy" align="center" style="font-size: 14px; line-height: 18px; color: #484848; font-family: Arial;">Su mensaje es el siguiente:</td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td class="innerpadding bodycontent bodycopy" style="padding: 30px 50px 30px 50px; background-color: #f7f7f7; font-size: 14px; line-height: 18px; color: #484848; font-family: Arial;" align="center">
          <?php echo $message; ?>
        </td>
      </tr>