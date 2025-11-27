<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title', 'MyApp')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body{font-family:Inter,system-ui,-apple-system,'Segoe UI',Roboto,Helvetica,Arial;margin:0;background:#f6fbff;color:#0f172a}
        .nav{background:#fff;padding:12px 20px;border-bottom:1px solid #eef2f6}
        .container{max-width:1100px;margin:20px auto;padding:0 18px}
        a.nav-link{color:#0f172a;text-decoration:none;margin-right:12px;font-weight:600}
        a.cta{background:#2563eb;color:#fff;padding:8px 12px;border-radius:8px;text-decoration:none}
    </style>
</head>
<body>
    <header class="nav">
        <div class="container" style="display:flex;align-items:center;justify-content:space-between">
            <div>
                <a href="/" class="nav-link">MyApp</a>
                <a href="/users" class="nav-link">จัดการผู้ใช้</a>
            </div>
            <div>
                @auth
                    <form method="POST" action="{{ route('logout') }}" style="display:inline">
                        @csrf
                        <button type="submit" class="cta">ออกจากระบบ</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="cta">เข้าสู่ระบบ</a>
                @endauth
            </div>
        </div>
    </header>

    <main class="container">
        @if(session('success'))
            <div style="padding:10px 12px;background:#ecfdf5;color:#065f46;border-radius:8px;margin:14px 0">{{ session('success') }}</div>
        @endif

        @yield('content')
    </main>

    <footer style="text-align:center;padding:24px 0;color:#6b7280;font-size:13px">
        © {{ date('Y') }} MyApp
    </footer>
</body>
</html>
