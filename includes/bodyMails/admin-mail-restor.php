<html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office" style="width:100%;font-family:arial, 'helvetica neue', helvetica, sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0">
<?php
date_default_timezone_set('America/Bogota');

$sitename = 'Quam';
$primaryColor = '#d1333c';
$termsLinks = '';
$imageUrl = 'https://i.ibb.co/0rhG7H5/Logo-quam-1.png';

setlocale(LC_TIME, 'es_CO.utf8', 'es_CO.utf-8', 'es_CO', 'spanish');
$Date = date('Y-m-d H:i:s');
$fecha = new DateTime('now', new DateTimeZone('America/Bogota'));
$locale = 'es_ES';
$formatter = new IntlDateFormatter($locale, IntlDateFormatter::FULL, IntlDateFormatter::FULL);
$formatter->setPattern("EEEE, dd 'de' MMMM 'de' y 'a las' HH:mm");
$formattedDate = $formatter->format($fecha);
?>

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <meta name="x-apple-disable-message-reformatting">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="telephone=no" name="format-detection">
  <title><?= $sitename ?></title>
  <!--[if (mso 16)]>
    <style type="text/css">
    a {text-decoration: none;}
    </style>
    <![endif]-->
  <!--[if gte mso 9]><style>sup { font-size: 100% !important; }</style><![endif]-->
  <!--[if gte mso 9]>
<xml>
    <o:OfficeDocumentSettings>
    <o:AllowPNG></o:AllowPNG>
    <o:PixelsPerInch>96</o:PixelsPerInch>
    </o:OfficeDocumentSettings>
</xml>
<![endif]-->
  <style type="text/css">
    #outlook a {
      padding: 0;
    }

    .ExternalClass {
      width: 100%;
    }

    .ExternalClass,
    .ExternalClass p,
    .ExternalClass span,
    .ExternalClass font,
    .ExternalClass td,
    .ExternalClass div {
      line-height: 100%;
    }

    .es-button {
      mso-style-priority: 100 !important;
      text-decoration: none !important;
    }

    a[x-apple-data-detectors] {
      color: inherit !important;
      text-decoration: none !important;
      font-size: inherit !important;
      font-family: inherit !important;
      font-weight: inherit !important;
      line-height: inherit !important;
    }

    .es-desk-hidden {
      display: none;
      float: left;
      overflow: hidden;
      width: 0;
      max-height: 0;
      line-height: 0;
      mso-hide: all;
    }

    @media only screen and (max-width:600px) {

      p,
      ul li,
      ol li,
      a {
        font-size: 16px !important;
        line-height: 150% !important
      }

      h1 {
        font-size: 30px !important;
        text-align: center;
        line-height: 120% !important
      }

      h2 {
        font-size: 26px !important;
        text-align: center;
        line-height: 120% !important
      }

      h3 {
        font-size: 20px !important;
        text-align: center;
        line-height: 120% !important
      }

      h1 a {
        font-size: 30px !important
      }

      h2 a {
        font-size: 26px !important
      }

      h3 a {
        font-size: 20px !important
      }

      .es-menu td a {
        font-size: 16px !important
      }

      .es-header-body p,
      .es-header-body ul li,
      .es-header-body ol li,
      .es-header-body a {
        font-size: 16px !important
      }

      .es-footer-body p,
      .es-footer-body ul li,
      .es-footer-body ol li,
      .es-footer-body a {
        font-size: 16px !important
      }

      .es-infoblock p,
      .es-infoblock ul li,
      .es-infoblock ol li,
      .es-infoblock a {
        font-size: 12px !important
      }

      *[class="gmail-fix"] {
        display: none !important
      }

      .es-m-txt-c,
      .es-m-txt-c h1,
      .es-m-txt-c h2,
      .es-m-txt-c h3 {
        text-align: center !important
      }

      .es-m-txt-r,
      .es-m-txt-r h1,
      .es-m-txt-r h2,
      .es-m-txt-r h3 {
        text-align: right !important
      }

      .es-m-txt-l,
      .es-m-txt-l h1,
      .es-m-txt-l h2,
      .es-m-txt-l h3 {
        text-align: left !important
      }

      .es-m-txt-r img,
      .es-m-txt-c img,
      .es-m-txt-l img {
        display: inline !important
      }

      .es-button-border {
        display: block !important
      }

      a.es-button {
        font-size: 20px !important;
        display: block !important;
        border-width: 10px 0px 10px 0px !important
      }

      .es-btn-fw {
        border-width: 10px 0px !important;
        text-align: center !important
      }

      .es-adaptive table,
      .es-btn-fw,
      .es-btn-fw-brdr,
      .es-left,
      .es-right {
        width: 100% !important
      }

      .es-content table,
      .es-header table,
      .es-footer table,
      .es-content,
      .es-footer,
      .es-header {
        width: 100% !important;
        max-width: 600px !important
      }

      .es-adapt-td {
        display: block !important;
        width: 100% !important
      }

      .adapt-img {
        width: 100% !important;
        height: auto !important
      }

      .es-m-p0 {
        padding: 0px !important
      }

      .es-m-p0r {
        padding-right: 0px !important
      }

      .es-m-p0l {
        padding-left: 0px !important
      }

      .es-m-p0t {
        padding-top: 0px !important
      }

      .es-m-p0b {
        padding-bottom: 0 !important
      }

      .es-m-p20b {
        padding-bottom: 20px !important
      }

      .es-mobile-hidden,
      .es-hidden {
        display: none !important
      }

      tr.es-desk-hidden,
      td.es-desk-hidden,
      table.es-desk-hidden {
        width: auto !important;
        overflow: visible !important;
        float: none !important;
        max-height: inherit !important;
        line-height: inherit !important
      }

      tr.es-desk-hidden {
        display: table-row !important
      }

      table.es-desk-hidden {
        display: table !important
      }

      td.es-desk-menu-hidden {
        display: table-cell !important
      }

      .es-menu td {
        width: 1% !important
      }

      table.es-table-not-adapt,
      .esd-block-html table {
        width: auto !important
      }

      table.es-social {
        display: inline-block !important
      }

      table.es-social td {
        display: inline-block !important
      }
    }
  </style>
</head>

<body style="width:100%;font-family:arial, 'helvetica neue', helvetica, sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0">
  <div class="es-wrapper-color" style="background-color:#F6F6F6">
    <!--[if gte mso 9]>
			<v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="t">
				<v:fill type="tile" color="#f6f6f6"></v:fill>
			</v:background>
		<![endif]-->
    <table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top">
      <tbody>
        <tr style="border-collapse:collapse">
          <td valign="top" style="padding:0;Margin:0">
            <table class="es-content" cellspacing="0" cellpadding="0" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;margin-top: 35px;">
              <tbody>
                <tr style="border-collapse:collapse">
                  <td align="center" style="padding:0;Margin:0">
                    <table class="es-content-body" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;width:600px">
                      <tbody>
                        <tr style="border-collapse:collapse">
                          <td align="left" style="/* Margin:0; */padding-top:20px;padding-bottom:20px;padding-left:20px;padding-right:20px;/* margin-top: 30px; */">
                            <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                              <tbody>
                                <tr style="border-collapse:collapse">
                                  <td class="es-m-p20b" align="center" style="padding:0;Margin:0;width:560px">
                                    <table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                      <tbody>
                                        <tr style="border-collapse:collapse">
                                          <td align="center" style="padding:0;Margin:0;padding-bottom:15px;font-size:0px"><img class="adapt-img" src="<?= $imageUrl ?>" alt="" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic" width="190"></td>
                                        </tr>
                                      </tbody>
                                    </table>
                                  </td>
                                </tr>
                                <tr style="border-collapse:collapse">
                                  <td valign="top" align="center" style="padding:0;Margin:0;width:560px">
                                    <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                      <tbody>
                                        <tr style="border-collapse:collapse">
                                          <td align="center" style="padding:0;Margin:0">
                                            <h2 style="Margin:0;line-height:29px;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;font-size:24px;font-style:normal;font-weight:normal;color:#494848">
                                              Nueva consulta en <?= $sitename ?></h2>
                                          </td>
                                        </tr>
                                        <tr style="border-collapse:collapse">
                                          <td align="left" style="padding:0;Margin:0;padding-top:15px">
                                            <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#333333">
                                              Un usuario ha escrito en nuestro formulario de contacto y está atento a
                                              que sus dudas sean respondidas.</p>
                                            <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#333333">
                                              <br>
                                            </p>
                                            <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#333333">
                                              A continuación, te damos los datos:</p>
                                          </td>
                                        </tr>
                                        <tr style="border-collapse:collapse">
                                          <td align="left" style="padding:0;Margin:0;padding-top:25px;margin-top: 8px;">
                                            <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#333333;/* margin-top: 8px; */">
                                            <p style="color: black; font-size:14px; text-align:start;">Nombre: <span style="color: #0d6efd; font-size:14px;"><?php echo $txtName; ?></span></p>
                                            <p style="color: black; font-size:14px; text-align:start;">Telefono: <span style="color: #0d6efd; font-size:14px;"><?php echo $txtPhone; ?></span></p>
                                            <p style="color: black; font-size:14px; text-align:start;">Email: <span style="color: #0d6efd; font-size:14px;"><?php echo $txtEmail; ?></span></p>
                                            <p style="color: black; font-size:14px; text-align:start;">Mensaje: <span style="color: #0d6efd; font-size:14px;"><?php echo $txtMessage; ?></span></p>
                                            <p style="color: black; font-size:14px; text-align:start;">Hora del registro: <span style="color: #0d6efd; font-size:14px;"><?php echo $formattedDate; ?></span></p>
                                            <br><br>
                                            </p>
                                          </td>
                                        </tr>
                                      </tbody>
                                    </table>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
              </tbody>
            </table>
            <table class="es-footer" cellspacing="0" cellpadding="0" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top">
              <tbody>
                <tr style="border-collapse:collapse">
                  <td align="center" style="padding:0;Margin:0">
                    <table class="es-footer-body" cellspacing="0" cellpadding="0" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px">
                      <tbody>
                        <tr style="border-collapse:collapse">
                          <td align="left" style="Margin:0;padding-top:20px;padding-bottom:20px;padding-left:20px;padding-right:20px">
                            <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                              <tbody>
                                <tr style="border-collapse:collapse">
                                  <td valign="top" align="center" style="padding:0;Margin:0;width:560px">
                                    <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                      <tbody>
                                        <tr style="border-collapse:collapse">
                                          <td align="center" style="padding:20px;Margin:0;font-size:0">
                                            <table width="75%" height="100%" cellspacing="0" cellpadding="0" border="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                              <tbody>
                                                <tr style="border-collapse:collapse">
                                                  <td style="padding:0;Margin:0;border-bottom:1px solid #CCCCCC;background:none;height:1px;width:100%;margin:0px">
                                                  </td>
                                                </tr>
                                              </tbody>
                                            </table>
                                          </td>
                                        </tr>
                                        <tr style="border-collapse:collapse">
                                          <td align="center" style="padding:0;Margin:0">
                                            <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:13px;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:20px;color:#333333">
                                              <strong><a target="_blank" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;font-size:13px;text-decoration:none;color:<?= $primaryColor ?>" href="<?= $termsLinks ?>">Términos y
                                                  condiciones<u></u><u></u></a></strong>
                                            </p>
                                          </td>
                                        </tr>
                                        <tr style="border-collapse:collapse">
                                          <td align="center" style="padding:0;Margin:0;padding-top:10px;padding-bottom:10px">
                                            <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:11px;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:17px;color:#333333">
                                              © <?= date("Y") ?> <?= $sitename ?> - Todos los derechos reservados</p>
                                          </td>
                                        </tr>
                                      </tbody>
                                    </table>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
              </tbody>
            </table>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</body>

</html>