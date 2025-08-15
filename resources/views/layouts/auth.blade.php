<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Bank Sampah Digital</title>
    <link rel="icon" href="{{ asset('images/icon.png') }}" type="image/png">
    <style>
        :root {
    --green-main: #4CAF50;
    --green-light: #e8f5e9;
    --text-dark: #333;
    --white: #fff;
}

.auth-body {
    background-color: var(--green-light);
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
    margin: 0;
    font-family: 'Segoe UI', sans-serif;
}

.auth-wrapper {
    background-color: var(--white);
    border-radius: 12px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
    width: 100%;
    max-width: 400px;
    padding: 30px 40px;
    box-sizing: border-box;
    text-align: left;
}

.logo {
    text-align: center;
    margin-bottom: 10px;
}

.logo h1 {
    color: var(--green-main);
    margin: 0;
    font-size: 22px;
}

.login-title {
    text-align: center;
    color: var(--green-main);
    margin-bottom: 25px;
    font-size: 20px;
}

label {
    font-weight: 600;
    display: block;
    margin-top: 15px;
    color: var(--text-dark);
}

input[type="email"],
input[type="password"] {
    width: 100%;
    padding: 10px 12px;
    margin-top: 6px;
    border: 1px solid #ccc;
    border-radius: 6px;
    outline: none;
    transition: border-color 0.3s ease;
}

input[type="email"]:focus,
input[type="password"]:focus {
    border-color: var(--green-main);
}

.form-check {
    display: flex;
    align-items: center;
    margin-top: 15px;
}

.form-check-input {
    margin-right: 10px;
}

button.btn-primary {
    background-color: var(--green-main);
    color: var(--white);
    border: none;
    padding: 10px 20px;
    margin-top: 20px;
    border-radius: 6px;
    cursor: pointer;
    font-weight: bold;
    width: 100%;
    transition: background-color 0.3s ease;
}

button.btn-primary:hover {
    background-color: #45a049;
}

a.btn-link {
    display: block;
    margin-top: 15px;
    color: var(--green-main);
    font-size: 14px;
    text-decoration: none;
    text-align: center;
}

a.btn-link:hover {
    text-decoration: underline;
}

    </style>
    @yield('styles')
</head>
<body class="auth-body">
    <div class="auth-wrapper">
        @yield('content')
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
</body>
</html>
