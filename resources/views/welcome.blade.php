<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Digital Wallet</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }

        .welcome-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: lightgoldenrodyellow;
        }

        .header {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .main-content {
            max-width: 600px;
            text-align: center;
        }

        .auth-buttons {
            margin-top: 1rem;
        }

        .auth-buttons a {
            display: inline-block;
            margin: 0.5rem;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            font-weight: 600;
            text-decoration: none;
            color: #fff;
            background-color: #4299e1;
            border-radius: 0.25rem;
            transition: background-color 0.3s ease;
        }

        .auth-buttons a:hover {
            background-color: #2c5282;
        }

        .footer {
            margin-top: 2rem;
            text-align: center;
            color: #718096;
        }
    </style>
</head>
<body>
<div class="welcome-container">
    <div class="header">
        Welcome to Digital Wallet
    </div>

    <div class="main-content">

        <div class="auth-buttons">
            <a href="{{ route('login') }}">Log in</a>
            <a href="{{ route('register') }}">Register</a>
        </div>
    </div>

    <div class="footer">
        Digital Wallet &copy; {{ date('Y') }}
    </div>
</div>
</body>
</html>
