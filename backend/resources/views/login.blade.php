<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>none</title>
</head>
<body>
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    @if (session()->has('error'))
        <p>{{ session('error') }}</p>
    @endif

    @auth
        <h1>You are logged in</h1>
        <form action="{{ route('web.logout')}}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit">Logout</button>
        </form>
    @endauth
    <form action="{{ route('web.login')}}" method="post">
        @csrf
        <label for="nip">NIP</label>
        <input type="text" name="nip">
        <label for="password">Password</label>
        <input type="password" name="password">
        <button type="submit">Login</button>
    </form>
</body>
</html>