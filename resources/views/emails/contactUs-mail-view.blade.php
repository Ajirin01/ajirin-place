<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Enquiry</title>
</head>
<body>
    <h2>New Contact Form Message</h2>

    <p><strong>Name:</strong> {{ $email['name'] }}</p>
    <p><strong>Email:</strong> {{ $email['email'] }}</p>
    <p><strong>Message:</strong><br>{!! nl2br($email['message']) !!}</p>
</body>
</html>
