<!DOCTYPE html>
<html>
<head>
    <title>登入</title>
</head>
<body>
    <h2>系統登入</h2>

    @if ($errors->any())
        <div style="color: red; margin-bottom: 10px;">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('login.submit') }}">
        @csrf <div>
            <label>帳號 (Username):</label>
            <input type="text" name="username" required>
        </div>
        <br>
        <div>
            <label>密碼 (Password):</label>
            <input type="password" name="password" required>
        </div>
        <br>
        <button type="submit">登入</button>
    </form>
</body>
</html>
