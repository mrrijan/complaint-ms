<!DOCTYPE html>
<html>
<head>
    <title>Complaint Confirmation</title>
</head>
<body>
<h2>Hi {{ $complaint->user->name }},</h2>

<p>Your complaint has been submitted successfully!</p>

<p><strong>Complaint Details:</strong></p>
<ul>
    <li><strong>Title:</strong> {{ $complaint->title }}</li>
    <li><strong>Description:</strong> {{ $complaint->description }}</li>
    <li><strong>Location:</strong> {{ $complaint->location }}</li>
    <li><strong>Status:</strong> {{$complaint->status }}</li>
</ul>

<p>We will review your complaint and keep you updated.</p>

<p>Thank you,<br>Complaint Management Team</p>
</body>
</html>
