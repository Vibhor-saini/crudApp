<!-- resources/views/emails/welcome.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Welcome!</title>
</head>
<body>
    <h1>Hello {{ $user->name }}!</h1>
    <p>Thanks for registering with our application.</p>
    <p>You can now log in and access your dashboard.</p>

    <p>Regards,<br>The {{ config('app.name') }} Team</p>
</body>
</html>
