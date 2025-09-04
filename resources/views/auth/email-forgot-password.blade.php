<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reset Your Password</title>
</head>
<body style="margin:0; padding:0; background:#f4f4f4; font-family: Arial, sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center" style="padding:30px;">
                <table width="600" cellpadding="0" cellspacing="0" style="background:#ffffff; border-radius:10px; box-shadow:0px 4px 12px rgba(0,0,0,0.1);">
                    
                    <!-- Header -->
                    <tr>
                        <td align="center" style="background:linear-gradient(135deg,#667eea,#764ba2); padding:20px; border-radius:10px 10px 0 0; color:#fff; font-size:22px; font-weight:bold;">
                            🔐 Password Reset Request
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding:30px; color:#333; font-size:15px; line-height:1.6;">
                            <p>Hello,</p>
                            <p>You recently requested to reset your password for your <b>Task Manager</b> account.</p>
                            <p>Click the button below to reset your password:</p>
                            
                            <!-- Button -->
                            <p style="text-align:center; margin:30px 0;">
                                <a href="{{ $link }}" style="background:#667eea; color:#fff; text-decoration:none; padding:12px 25px; border-radius:8px; font-weight:bold; display:inline-block;">
                                    Reset Password
                                </a>
                            </p>

                            <p>If you did not request a password reset, please ignore this email. This link will expire in 60 minutes.</p>
                            <p>Thanks,<br>Task Manager Team</p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td align="center" style="background:#f4f4f4; padding:15px; font-size:12px; color:#888; border-top:1px solid #ddd; border-radius:0 0 10px 10px;">
                            © {{ date('Y') }} Task Manager. All rights reserved.
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>

</body>
</html>
