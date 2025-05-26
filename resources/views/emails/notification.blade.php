<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $data['subject'] }}</title>
    <style>
        /* Add some basic styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            padding: 20px;
        }
        .email-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333333;
        }
        p {
            font-size: 16px;
            color: #666666;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <h1>{{ $data['greeting'] }}</h1>
        <p>{{ $data['message'] }}</p>
        <p>Thank you,</p>
        <p>{{ config('app.name') }}</p>
    </div>
</body>
</html>
