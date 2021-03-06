<div class="block">
    <!-- start textbox-with-title -->
    <table width="100%" bgcolor="#f6f4f5" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="fulltext">
        <tbody>
        <tr>
            <td>
                <table bgcolor="#ffffff" width="580" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth" modulebg="edit">
                    <tbody>
                    <!-- Spacing -->
                    <tr>
                        <td width="100%" height="30"></td>
                    </tr>
                    <!-- Spacing -->
                    <tr>
                        <td>
                            <table width="540" align="center" cellpadding="0" cellspacing="0" border="0" class="devicewidthinner">
                                <tbody>
                                <!-- Title -->
                                <tr>
                                    <td style="font-family: Helvetica, arial, sans-serif; font-size: 18px; color: #333333; text-align:center;line-height: 20px;" st-title="fulltext-title">
                                        Reset your password
                                    </td>
                                </tr>
                                <!-- End of Title -->
                                <!-- spacing -->
                                <tr>
                                    <td height="5"></td>
                                </tr>
                                <!-- End of spacing -->
                                <!-- content -->
                                <tr>
                                    <td style="font-family: Helvetica, arial, sans-serif; font-size: 14px; color: #95a5a6; text-align:left;line-height: 30px;" st-content="fulltext-paragraph">
                                        Dear {{$name}},<br/>
                                        You have requested to have a password reset for your account.<br/>
                                        Please click the button below to continue.
                                    </td>
                                </tr>
                                <!-- End of content -->
                                <!-- Spacing -->
                                <tr>
                                    <td width="100%" height="30"></td>
                                </tr>
                                <!-- /Spacing -->
                                <!-- button -->
                                <tr>
                                    <td>
                                        <table height="36" align="center" valign="middle" border="0" cellpadding="0" cellspacing="0" class="tablet-button" st-button="edit">
                                            <tbody>
                                            <tr>
                                                <td width="auto" align="left" valign="middle" height="36" style=" background-color:#e74c3c; border-top-left-radius:4px; border-bottom-left-radius:4px;border-top-right-radius:4px; border-bottom-right-radius:4px; background-clip: padding-box;font-size:13px; font-family:Helvetica, arial, sans-serif; text-align:center;  color:#ffffff; font-weight: 300; padding-left:25px; padding-right:25px;">
                                                         <span style="color: #ffffff; font-weight: 300;">
                                                            <a style="color: #ffffff; text-align:center;text-decoration: none;" href="{!!$reset_password_link!!}">Reset Password</a>
                                                         </span>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <!-- /button -->
                                <!-- Spacing -->
                                <tr>
                                    <td width="100%" height="30"></td>
                                </tr>
                                <!-- /Spacing -->
                                <!-- content -->
                                <tr>
                                    <td style="font-family: Helvetica, arial, sans-serif; font-size: 14px; color: #999999; text-align:left;line-height: 30px;" st-content="fulltext-paragraph">
                                        If you are unable to click the button above, copy & paste this url in your browser:<br/>
                                        {!!$reset_password_link!!}
                                    </td>
                                </tr>
                                <!-- /content -->
                                <!-- Spacing -->
                                <tr>
                                    <td width="100%" height="10"></td>
                                </tr>
                                <!-- /Spacing -->
                                <!-- content -->
                                <tr>
                                    <td style="font-family: Helvetica, arial, sans-serif; font-size: 14px; color: #999999; text-align:left;line-height: 30px;" st-content="fulltext-paragraph">
                                        If you received this email in error, you can safely ignore this email.
                                    </td>
                                </tr>
                                <!-- /content -->
                                <tr>
                                    <td width="100%" height="10"></td>
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
    <!-- end of textbox-with-title -->
</div>
