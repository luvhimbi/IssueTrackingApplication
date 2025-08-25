<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<h2>Welcome, {{ auth()->user()->name }}</h2>
@if (session('success'))
    <p style="color:green;">{{ session('success') }}</p>
@endif
<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit">Logout</button>
</form>
</body>
</html>
