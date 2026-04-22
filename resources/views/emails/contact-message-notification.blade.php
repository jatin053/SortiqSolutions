<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Contact Message</title>
</head>
<body style="font-family: Arial, sans-serif; color: #1f2937; line-height: 1.6;">
    <h2 style="margin-bottom: 12px;">New contact form enquiry</h2>

    <p><strong>Name:</strong> {{ $contactMessage->name }}</p>
    <p><strong>Email:</strong> {{ $contactMessage->email }}</p>
    <p><strong>Phone:</strong> {{ $contactMessage->phone_label }}</p>
    <p><strong>Subject:</strong> {{ $contactMessage->subject }}</p>

    <div style="margin-top: 20px; padding: 16px; background: #f9fafb; border: 1px solid #e5e7eb; border-radius: 8px;">
        {{ $contactMessage->message }}
    </div>
</body>
</html>
