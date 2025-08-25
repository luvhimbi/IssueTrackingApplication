<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<h2>User Login</h2>
@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li style="color:red;">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (session('success'))
    <p style="color:green;">{{ session('success') }}</p>
@endif
<form action="{{ route('login.post') }}" method="POST">
    @csrf
    <label>Email:</label>
    <input type="email" name="email" value="{{ old('email') }}" required><br>

    <label>Password:</label>
    <input type="password" name="password" required><br>

    <button type="submit">Login</button>
</form>
<p>Don't have an account? <a href="{{ route('register') }}">Register here</a></p>
</body>
</html>
