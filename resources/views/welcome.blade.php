<!DOCTYPE html>


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My App</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            background-color: #0a0f1f; 
            color: #ffffff; 

        }

        .container {
            text-align: center;
        }

        h1 {
            font-size: 2rem;
            margin-bottom: 20px;
        }

        .buttons {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .btn {
            padding: 10px 20px;
            text-decoration: none;
            color: white;
            background-color: #3490dc;
            border-radius: 5px;
        }

        .btn:hover {
            background-color: #2779bd;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Welcome to Raja Shop!</h1>
        <h2>Log in or Register to continue</h2>
        <div class="buttons">
            @auth
                <a href="{{ url('/dashboard') }}" class="btn">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="btn">Login</a>
                <a href="{{ route('register') }}" class="btn">Register</a>
            @endauth
        </div>
    </div>
</body>

</html>
