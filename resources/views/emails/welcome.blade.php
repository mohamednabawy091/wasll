<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Wasll</title>
</head>
<body>
    <h3>Hello {{$user->name}}</h3>

    <p>
        Welcome to Wasll Transportation System 🎉, thank you for joining us.
    </p>

    <a href="{{$verificationUrl}}">
        Verify Email
    </a>
</body>
</html>