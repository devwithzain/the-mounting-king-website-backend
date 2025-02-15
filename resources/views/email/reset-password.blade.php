<!DOCTYPE html>
<html>

<head>
   <title>Reset Your Password</title>
</head>

<body>
   <p>Hello,</p>
   <p>You requested to reset your password. Click the link below to set a new password:</p>
   <a href="{{ env('FRONTEND_URL') }}/reset-password?token={{ $token }}">Reset Password</a>
   <p>If you did not request this, please ignore this email.</p>
</body>

</html>