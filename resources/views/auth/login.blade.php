<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>เข้าสู่ระบบ</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root{--bg:#0f172a;--card:#1e293b;--muted:#94a3b8;--accent:#3b82f6;--accent-light:#60a5fa;--success:#10b981;--error:#ef4444;--border:#334155}
        *{box-sizing:border-box;margin:0;padding:0}
        body{font-family:Inter,system-ui,-apple-system,'Segoe UI',Roboto;min-height:100vh;background:linear-gradient(135deg, var(--bg) 0%, #1a2847 100%);color:#e2e8f0}
        .wrap{min-height:100vh;display:flex;align-items:center;justify-content:center;padding:20px}
        .container{width:100%;max-width:1100px;display:grid;grid-template-columns:1fr 450px;gap:40px;align-items:center}
        .visual{position:relative;border-radius:16px;overflow:hidden;box-shadow:0 20px 60px rgba(0,0,0,0.4);min-height:480px;background:linear-gradient(135deg, rgba(59,130,246,0.15), rgba(139,92,246,0.1));display:flex;align-items:center;justify-content:center;border:1px solid rgba(59,130,246,0.2)}
        .visual::before{content:'';position:absolute;top:-50%;right:-50%;width:400px;height:400px;background:radial-gradient(circle, rgba(59,130,246,0.3), transparent);border-radius:50%;animation:float 8s ease-in-out infinite}
        .visual::after{content:'';position:absolute;bottom:-30%;left:-10%;width:300px;height:300px;background:radial-gradient(circle, rgba(139,92,246,0.2), transparent);border-radius:50%;animation:float 6s ease-in-out infinite reverse}
        @keyframes float{0%,100%{transform:translateY(0)}50%{transform:translateY(-20px)}}
        .visual img{width:100%;height:100%;object-fit:cover;opacity:0.85;position:relative;z-index:1}
        .brand{position:absolute;left:24px;top:24px;background:rgba(30,41,59,0.8);backdrop-filter:blur(8px);padding:10px 16px;border-radius:10px;font-weight:700;font-size:16px;color:#3b82f6;z-index:2}
        .card{background:linear-gradient(135deg, rgba(30,41,59,0.95), rgba(30,41,59,0.8));padding:40px;border-radius:16px;box-shadow:0 20px 60px rgba(0,0,0,0.5);border:1px solid rgba(148,163,184,0.1);backdrop-filter:blur(10px)}
        h1{margin:0 0 8px 0;font-size:28px;font-weight:700;background:linear-gradient(135deg, #e2e8f0, #cbd5e1);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}
        p.lead{margin:0 0 24px 0;color:var(--muted);font-size:14px;line-height:1.6}
        label{display:block;margin-bottom:8px;font-size:13px;color:var(--muted);font-weight:500;text-transform:uppercase;letter-spacing:0.5px}
        .form-group{margin-bottom:16px}
        .input{width:100%;padding:12px 16px;border:1px solid var(--border);border-radius:10px;background:rgba(2,6,23,0.4);color:#e2e8f0;font-size:14px;transition:all 0.3s ease}
        .input::placeholder{color:#64748b}
        .input:focus{outline:none;box-shadow:0 0 0 3px rgba(59,130,246,0.2);border-color:var(--accent-light);background:rgba(2,6,23,0.6)}
        .input:hover{border-color:rgba(59,130,246,0.5)}
        .row{display:flex;gap:12px;align-items:center;margin-top:12px}
        .checkbox-label{display:flex;align-items:center;gap:8px;font-size:13px;color:var(--muted);cursor:pointer;user-select:none}
        .checkbox-label input[type="checkbox"]{width:16px;height:16px;cursor:pointer;accent-color:var(--accent)}
        .checkbox-label:hover{color:#e2e8f0}
        .forgot-link{color:var(--accent-light);text-decoration:none;font-size:13px;font-weight:500;transition:color 0.2s}
        .forgot-link:hover{color:#93c5fd}
        .btn{display:inline-block;padding:12px 24px;border-radius:10px;background:linear-gradient(135deg, var(--accent), var(--accent-light));color:white;border:0;cursor:pointer;font-weight:600;font-size:14px;transition:all 0.3s ease;box-shadow:0 4px 12px rgba(59,130,246,0.3)}
        .btn:hover{transform:translateY(-2px);box-shadow:0 6px 16px rgba(59,130,246,0.4)}
        .btn:active{transform:translateY(0)}
        .divider{color:var(--muted);font-size:13px;white-space:nowrap}
        .register-link{color:var(--accent-light);text-decoration:none;font-weight:600;font-size:13px;transition:color 0.2s}
        .register-link:hover{color:#93c5fd}
        .muted{color:var(--muted);font-size:13px}
        .field-error{background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.3);color:#fca5a5;font-size:13px;margin-top:8px;padding:8px 12px;border-radius:8px}
        .field-error ul{margin:0;padding-left:18px}
        .field-error li{margin:4px 0}
        .footer-links{display:flex;justify-content:space-between;margin-top:24px;padding-top:16px;border-top:1px solid var(--border);font-size:12px}
        .footer-link{color:var(--muted);text-decoration:none;transition:color 0.2s}
        .footer-link:hover{color:var(--accent-light)}
        @media(max-width:920px){
            .container{grid-template-columns:1fr;gap:24px}
            .visual{order:2;min-height:300px}
            .card{order:1;padding:32px}
            h1{font-size:24px}
            .wrap{padding:16px}
        }
        @media(max-width:640px){
            .card{padding:24px}
            h1{font-size:20px}
            p.lead{margin-bottom:18px}
            .row{gap:8px;flex-wrap:wrap}
        }
    </style>
</head>
<body>
    <div class="wrap">
        <div class="container">
            <div class="visual" aria-hidden="true">
                <div class="brand">MyApp</div>
                <img src="{{ asset('images/bg-forest.svg') }}" alt="background">
            </div>

            <div class="card" role="main">
                <h1>เข้าสู่ระบบ</h1>
                <p class="lead">ยินดีต้อนรับกลับ — ลงชื่อเข้าใช้เพื่อดำเนินการต่อ</p>

                @if($errors->any())
                    <div class="field-error">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ url('/login') }}" style="margin-top:20px">
                    @csrf

                    <div class="form-group">
                        <label for="email">อีเมล</label>
                        <input id="email" class="input" type="email" name="email" value="{{ old('email') }}" placeholder="คุณ@example.com" required autofocus>
                    </div>

                    <div class="form-group">
                        <label for="password">รหัสผ่าน</label>
                        <input id="password" class="input" type="password" name="password" placeholder="••••••••" required>
                    </div>

                    <div class="row" style="margin-top:14px">
                        <label class="checkbox-label"><input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> จำฉันไว้</label>
                        <div style="flex:1"></div>
                        <a href="#" class="forgot-link">ลืมรหัสผ่าน?</a>
                    </div>

                    <div style="margin-top:24px;display:flex;gap:12px;align-items:center;flex-wrap:wrap">
                        <button type="submit" class="btn">เข้าสู่ระบบ</button>
                        <span class="divider">หรือ</span>
                        <a href="/register" class="register-link">สมัครสมาชิก</a>
                    </div>
                </form>

                <div class="footer-links">
                    <a href="#" class="footer-link">© {{ date('Y') }} MyApp</a>
                    <div style="display:flex;gap:16px">
                        <a href="#" class="footer-link">Privacy</a>
                        <a href="#" class="footer-link">Terms</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
