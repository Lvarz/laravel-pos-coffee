<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title', 'MyApp')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        :root{--dark:#0f172a;--darker:#020617;--card:#1e293b;--muted:#64748b;--accent:#3b82f6;--accent-light:#60a5fa;--border:#334155}
        *{box-sizing:border-box;margin:0;padding:0}
        body{font-family:Inter,system-ui,-apple-system,'Segoe UI',Roboto,Helvetica,Arial;background:linear-gradient(135deg, var(--dark) 0%, var(--darker) 100%);color:#e2e8f0;min-height:100vh}
        .app-layout{display:grid;grid-template-columns:80px 1fr;gap:0;min-height:100vh}
        .sidebar-left{background:rgba(30,41,59,0.9);border-right:1px solid var(--border);display:flex;flex-direction:column;align-items:center;padding:16px 0;gap:12px;overflow-y:auto}
        .logo{width:50px;height:50px;background:linear-gradient(135deg, var(--accent), var(--accent-light));border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:24px;font-weight:700;color:#fff;margin-bottom:8px;cursor:pointer;transition:all 0.2s;text-decoration:none}
        .logo:hover{transform:scale(1.05)}
        .nav-item{width:56px;height:56px;border-radius:10px;display:flex;align-items:center;justify-content:center;cursor:pointer;transition:all 0.2s;font-size:24px;border:2px solid transparent;position:relative;text-decoration:none;color:#e2e8f0}
        .nav-item:hover{background:rgba(59,130,246,0.1);border-color:var(--accent)}
        .nav-item.active{background:rgba(59,130,246,0.2);border-color:var(--accent);color:var(--accent)}
        .nav-item-tooltip{position:absolute;left:70px;background:rgba(30,41,59,0.95);padding:6px 10px;border-radius:6px;font-size:11px;white-space:nowrap;opacity:0;pointer-events:none;transition:opacity 0.2s;border:1px solid var(--border);z-index:100}
        .nav-item:hover .nav-item-tooltip{opacity:1}
        .nav-spacer{flex:1}
        .main-content{display:flex;flex-direction:column;overflow:hidden}
        .header{background:rgba(30,41,59,0.8);backdrop-filter:blur(10px);padding:12px 20px;border-bottom:1px solid var(--border)}
        .header-title{font-size:18px;font-weight:700;color:#e2e8f0}
        .container{max-width:1200px;margin:0 auto;padding:20px;flex:1;overflow-y:auto}
        .nav-link{color:#e2e8f0;text-decoration:none;margin-right:12px;font-weight:600}
        .cta{background:var(--accent);color:#fff;padding:8px 12px;border-radius:8px;text-decoration:none;transition:all 0.2s}
        .cta:hover{background:var(--accent-light)}
        .success-msg{padding:10px 12px;background:rgba(16,185,129,0.1);color:#6ee7b7;border-radius:8px;margin:14px 0;border:1px solid rgba(16,185,129,0.3)}
        ::-webkit-scrollbar{width:8px}
        ::-webkit-scrollbar-track{background:rgba(51,65,85,0.3)}
        ::-webkit-scrollbar-thumb{background:rgba(59,130,246,0.5);border-radius:4px}
        ::-webkit-scrollbar-thumb:hover{background:rgba(59,130,246,0.7)}
    </style>
</head>
<body>
    <div class="app-layout">
        <!-- Left Sidebar Navigation -->
        <div class="sidebar-left">
            <a href="{{ route('pos.index') }}" class="logo" title="Home">☕</a>

            <a href="{{ route('pos.index') }}" class="nav-item {{ request()->routeIs('pos.*') ? 'active' : '' }}" title="ระบบ POS">
                <span>🛒</span>
                <div class="nav-item-tooltip">ระบบ POS</div>
            </a>

            <a href="{{ route('users.index') }}" class="nav-item {{ request()->routeIs('users.*') ? 'active' : '' }}" title="จัดการผู้ใช้">
                <span>👥</span>
                <div class="nav-item-tooltip">จัดการผู้ใช้</div>
            </a>

            <div class="nav-spacer"></div>

            <form method="POST" action="{{ route('logout') }}" style="width:100%;display:flex;justify-content:center">
                @csrf
                <button type="submit" class="nav-item" title="ออกจากระบบ" style="background:rgba(239,68,68,0.1);border-color:rgba(239,68,68,0.3);color:#fca5a5;border:none;padding:0">
                    <span>🚪</span>
                    <div class="nav-item-tooltip">ออกจากระบบ</div>
                </button>
            </form>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="header" style="display:flex;justify-content:space-between;align-items:center">
                <div class="header-title">@yield('title', 'MyApp')</div>
                @auth
                    <div style="display:flex;align-items:center;gap:12px;font-size:13px;color:#e2e8f0">
                        <div style="text-align:right">
                            <div style="font-weight:600">{{ auth()->user()->name }}</div>
                            <div style="font-size:11px;color:#60a5fa">
                                @if(auth()->user()->role === 'owner')
                                    👑 เจ้าของร้าน
                                @else
                                    🔧 พนักงาน
                                @endif
                            </div>
                        </div>
                    </div>
                @endauth
            </div>

            <div class="container">
                @if(session('success'))
                    <div class="success-msg">{{ session('success') }}</div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>
