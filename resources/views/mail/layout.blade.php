<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{$pageTitle}}</title>
        <style type="text/css">
            /* Client-specific Styles */
            #outlook a {padding:0;} /* Force Outlook to provide a "view in browser" menu link. */
            body{width:100% !important; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; margin:0; padding:0;}
            /* Prevent Webkit and Windows Mobile platforms from changing default font sizes, while not breaking desktop design. */
            .ExternalClass {width:100%;} /* Force Hotmail to display emails at full width */
            .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;} /* Force Hotmail to display normal line spacing.  More on that: http://www.emailonacid.com/forum/viewthread/43/ */
            #backgroundTable {margin:0; padding:0; width:100% !important; line-height: 100% !important;}
            img {outline:none; text-decoration:none;border:none; -ms-interpolation-mode: bicubic;}
            a img {border:none;}
            .image_fix {display:block;}
            p {margin: 0px 0px !important;}

            table td {border-collapse: collapse;}
            table { border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; }
            /*a {color: #e95353;text-decoration: none;text-decoration:none!important;}*/
            /*STYLES*/
            table[class=full] { width: 100%; clear: both; }

            /*################################################*/
            /*IPAD STYLES*/
            /*################################################*/
            @media only screen and (max-width: 640px) {
                a[href^="tel"], a[href^="sms"] {
                    text-decoration: none;
                    color: #ffffff; /* or whatever your want */
                    pointer-events: none;
                    cursor: default;
                }
                .mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {
                    text-decoration: default;
                    color: #ffffff !important;
                    pointer-events: auto;
                    cursor: default;
                }
                table[class=devicewidth] {width: 440px!important;text-align:center!important;}
                table[class=devicewidthinner] {width: 420px!important;text-align:center!important;}
                table[class="sthide"]{display: none!important;}
                img[class="bigimage"]{width: 420px!important;height:219px!important;}
                img[class="col2img"]{width: 420px!important;height:258px!important;}
                img[class="image-banner"]{width: 440px!important;height:106px!important;}
                td[class="menu"]{text-align:center !important; padding: 0 0 10px 0 !important;}
                td[class="logo"]{padding:10px 0 5px 0!important;margin: 0 auto !important;}
                img[class="logo"]{padding:0!important;margin: 0 auto !important;}

            }
            /*##############################################*/
            /*IPHONE STYLES*/
            /*##############################################*/
            @media only screen and (max-width: 480px) {
                a[href^="tel"], a[href^="sms"] {
                    text-decoration: none;
                    color: #ffffff; /* or whatever your want */
                    pointer-events: none;
                    cursor: default;
                }
                .mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {
                    text-decoration: default;
                    color: #ffffff !important;
                    pointer-events: auto;
                    cursor: default;
                }
                table[class=devicewidth] {width: 280px!important;text-align:center!important;}
                table[class=devicewidthinner] {width: 260px!important;text-align:center!important;}
                table[class="sthide"]{display: none!important;}
                img[class="bigimage"]{width: 260px!important;height:136px!important;}
                img[class="col2img"]{width: 260px!important;height:160px!important;}
                img[class="image-banner"]{width: 280px!important;height:68px!important;}

            }
        </style>
    </head>
    <body>
        <div class="block">
            <!-- Start of preheader -->
            <table width="100%" bgcolor="#f6f4f5" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="preheader">
                <tbody>
                <tr>
                    <td width="100%">
                        <table width="580" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                            <tbody>
                            <!-- Spacing -->
                            <tr>
                                <td width="100%" height="10"></td>
                            </tr>
                            <!-- Spacing -->
                            <tr>
                                <td align="center" valign="middle"  st-content="preheader">
                                    <img src="/img/logo.png" alt="" border="0" width="140" height="55.5" style="display:block; border:none; outline:none; text-decoration:none;">
                                </td>
                            </tr>
                            <!-- Spacing -->
                            <tr>
                                <td width="100%" height="20"></td>
                            </tr>
                            <!-- Spacing -->
                            <tr>
                                <td style="font-family: Helvetica, arial, sans-serif; font-size: 24px; color: #333333; text-align:center;line-height: 20px;" st-title="fulltext-title">
                                    BrightStar E-Learning
                                </td>
                            </tr>
                            <tr>
                                <td width="100%" height="10"></td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
            <!-- End of preheader -->
        </div>
        @include($mainView)
        @if($enableSettingsFooter)
            <div class="block">
                <!-- Start of preheader -->
                <table width="100%" bgcolor="#f6f4f5" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="postfooter">
                    <tbody>
                    <tr>
                        <td width="100%">
                            <table width="580" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                                <tbody>
                                <!-- Spacing -->
                                <tr>
                                    <td width="100%" height="5"></td>
                                </tr>
                                <!-- Spacing -->
                                <tr>
                                    <td align="center" valign="middle" style="font-family: Helvetica, arial, sans-serif; font-size: 10px;color: #999999" st-content="preheader">
                                        If you don't want to receive updates. please  <a class="hlite" href="#" style="text-decoration: none; color: #0db9ea">unsubscribe</a>
                                    </td>
                                </tr>
                                <!-- Spacing -->
                                <tr>
                                    <td width="100%" height="5"></td>
                                </tr>
                                <!-- Spacing -->
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <!-- End of preheader -->
            </div>
        @endif
    </body>
</html>