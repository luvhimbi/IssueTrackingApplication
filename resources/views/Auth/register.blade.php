<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<h2>User Registration</h2>
@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li style="color:red;">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ route('register.post') }}" method="POST">
    @csrf
    <label>Name:</label>
    <input type="text" name="name" value="{{ old('name') }}" required><br>

    <label>Email:</label>
    <input type="email" name="email" value="{{ old('email') }}" required><br>

    <label>Password:</label>
    <input type="password" name="password" required><br>

    <label>Confirm Password:</label>
    <input type="password" name="password_confirmation" required><br>

    <button type="submit">Register</button>
</form>
<p>Already have an account? <a href="{{ route('login') }}">Login here</a></p>
</body>
</html>
