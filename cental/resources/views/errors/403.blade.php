<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 Forbidden</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Include your styles -->
</head>
<body>
    <div class="container">
        <h1>403 Forbidden</h1>
        <p>{{ $exception->getMessage() }}</p> <!-- Display the custom message -->
        <a href="/">Return to Home</a> <!-- Adjust this link as needed -->
    </div>
</body>
</html>
