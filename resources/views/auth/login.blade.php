<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>เข้าสู่ระบบ | MyApp</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Prompt:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-primary: #0a0a0f;
            --bg-secondary: #12121a;
            --card-bg: rgba(18, 18, 26, 0.8);
            --glass-bg: rgba(255, 255, 255, 0.03);
            --text-primary: #ffffff;
            --text-secondary: #a1a1aa;
            --text-muted: #71717a;
            --accent: #6366f1;
            --accent-light: #818cf8;
            --accent-glow: rgba(99, 102, 241, 0.4);
            --success: #10b981;
            --error: #ef4444;
            --border: rgba(255, 255, 255, 0.08);
            --border-hover: rgba(99, 102, 241, 0.5);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Prompt', 'Inter', system-ui, -apple-system, sans-serif;
            min-height: 100vh;
            background: var(--bg-primary);
            color: var(--text-primary);
            overflow-x: hidden;
        }

        /* Animated Background */
        .bg-animation {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            overflow: hidden;
        }

        .bg-animation::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background:
                radial-gradient(circle at 20% 80%, rgba(99, 102, 241, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(139, 92, 246, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(59, 130, 246, 0.1) 0%, transparent 40%);
            animation: bgRotate 30s linear infinite;
        }

        @keyframes bgRotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
        }

        .shape {
            position: absolute;
            border-radius: 50%;
            filter: blur(60px);
            opacity: 0.5;
            animation: float 20s ease-in-out infinite;
        }

        .shape-1 {
            width: 400px;
            height: 400px;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.3), rgba(139, 92, 246, 0.2));
            top: -100px;
            right: -100px;
            animation-delay: 0s;
        }

        .shape-2 {
            width: 300px;
            height: 300px;
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.25), rgba(99, 102, 241, 0.15));
            bottom: -50px;
            left: -50px;
            animation-delay: -5s;
        }

        .shape-3 {
            width: 200px;
            height: 200px;
            background: linear-gradient(135deg, rgba(236, 72, 153, 0.2), rgba(139, 92, 246, 0.15));
            top: 50%;
            left: 30%;
            animation-delay: -10s;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0) scale(1); }
            25% { transform: translate(30px, -30px) scale(1.05); }
            50% { transform: translate(-20px, 20px) scale(0.95); }
            75% { transform: translate(20px, 30px) scale(1.02); }
        }

        /* Grid Pattern */
        .grid-pattern {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image:
                linear-gradient(rgba(255, 255, 255, 0.02) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.02) 1px, transparent 1px);
            background-size: 60px 60px;
            mask-image: radial-gradient(ellipse at center, black 30%, transparent 70%);
        }

        /* Main Container */
        .wrap {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            position: relative;
            z-index: 1;
        }

        .login-container {
            width: 100%;
            max-width: 480px;
            animation: slideUp 0.8s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Logo Section */
        .logo-section {
            text-align: center;
            margin-bottom: 40px;
        }

        .logo {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--accent), var(--accent-light));
            border-radius: 24px;
            font-size: 36px;
            margin-bottom: 20px;
            box-shadow: 0 20px 40px var(--accent-glow);
            animation: pulse 3s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { box-shadow: 0 20px 40px var(--accent-glow); }
            50% { box-shadow: 0 25px 50px rgba(99, 102, 241, 0.5); }
        }

        .logo-text {
            font-size: 28px;
            font-weight: 700;
            background: linear-gradient(135deg, var(--text-primary), var(--text-secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Card */
        .card {
            background: var(--card-bg);
            backdrop-filter: blur(20px);
            border: 1px solid var(--border);
            border-radius: 24px;
            padding: 48px;
            box-shadow:
                0 25px 50px -12px rgba(0, 0, 0, 0.5),
                0 0 0 1px rgba(255, 255, 255, 0.05) inset;
            position: relative;
            overflow: hidden;
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
        }

        /* Headers */
        h1 {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 8px;
            text-align: center;
            background: linear-gradient(135deg, #ffffff 0%, #a1a1aa 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .subtitle {
            text-align: center;
            color: var(--text-muted);
            font-size: 15px;
            margin-bottom: 36px;
            line-height: 1.6;
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 24px;
            position: relative;
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: 500;
            color: var(--text-secondary);
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 18px;
            color: var(--text-muted);
            transition: color 0.3s ease;
            z-index: 1;
        }

        .input {
            width: 100%;
            padding: 16px 16px 16px 50px;
            border: 1px solid var(--border);
            border-radius: 14px;
            background: var(--glass-bg);
            color: var(--text-primary);
            font-size: 15px;
            font-family: inherit;
            transition: all 0.3s ease;
        }

        .input::placeholder {
            color: var(--text-muted);
        }

        .input:hover {
            border-color: var(--border-hover);
            background: rgba(255, 255, 255, 0.05);
        }

        .input:focus {
            outline: none;
            border-color: var(--accent);
            background: rgba(255, 255, 255, 0.05);
            box-shadow: 0 0 0 4px var(--accent-glow);
        }

        .input:focus + .input-icon,
        .input-wrapper:hover .input-icon {
            color: var(--accent-light);
        }

        /* Remember & Forgot */
        .options-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 28px;
        }

        .checkbox-wrapper {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
        }

        .checkbox-wrapper input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: var(--accent);
            cursor: pointer;
            border-radius: 4px;
        }

        .checkbox-wrapper span {
            font-size: 14px;
            color: var(--text-secondary);
            transition: color 0.2s;
        }

        .checkbox-wrapper:hover span {
            color: var(--text-primary);
        }

        .forgot-link {
            font-size: 14px;
            color: var(--accent-light);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s;
        }

        .forgot-link:hover {
            color: var(--text-primary);
            text-decoration: underline;
        }

        /* Submit Button */
        .btn-primary {
            width: 100%;
            padding: 18px 24px;
            border: none;
            border-radius: 14px;
            background: linear-gradient(135deg, var(--accent), var(--accent-light));
            color: white;
            font-size: 16px;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 30px var(--accent-glow);
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 40px rgba(99, 102, 241, 0.5);
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        /* Divider */
        .divider {
            display: flex;
            align-items: center;
            gap: 16px;
            margin: 28px 0;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--border);
        }

        .divider span {
            font-size: 13px;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Social Buttons */
        .social-buttons {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 28px;
        }

        .btn-social {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 14px 20px;
            border: 1px solid var(--border);
            border-radius: 12px;
            background: var(--glass-bg);
            color: var(--text-primary);
            font-size: 14px;
            font-weight: 500;
            font-family: inherit;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-social:hover {
            border-color: var(--border-hover);
            background: rgba(255, 255, 255, 0.08);
            transform: translateY(-2px);
        }

        .btn-social svg {
            width: 20px;
            height: 20px;
        }

        /* Register Link */
        .register-section {
            text-align: center;
            padding-top: 24px;
            border-top: 1px solid var(--border);
        }

        .register-section p {
            font-size: 14px;
            color: var(--text-muted);
        }

        .register-link {
            color: var(--accent-light);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.2s;
            margin-left: 4px;
        }

        .register-link:hover {
            color: var(--text-primary);
            text-decoration: underline;
        }

        /* Error Message */
        .error-box {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 24px;
            animation: shake 0.5s ease-in-out;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            20%, 60% { transform: translateX(-5px); }
            40%, 80% { transform: translateX(5px); }
        }

        .error-box ul {
            margin: 0;
            padding-left: 20px;
            color: #fca5a5;
            font-size: 14px;
        }

        .error-box li {
            margin: 4px 0;
        }

        /* Footer */
        .footer {
            text-align: center;
            margin-top: 32px;
            font-size: 12px;
            color: var(--text-muted);
        }

        .footer a {
            color: var(--text-muted);
            text-decoration: none;
            margin: 0 12px;
            transition: color 0.2s;
        }

        .footer a:hover {
            color: var(--text-secondary);
        }

        /* Responsive */
        @media (max-width: 640px) {
            .wrap {
                padding: 16px;
            }

            .card {
                padding: 32px 24px;
                border-radius: 20px;
            }

            h1 {
                font-size: 26px;
            }

            .logo {
                width: 64px;
                height: 64px;
                font-size: 28px;
                border-radius: 18px;
            }

            .social-buttons {
                grid-template-columns: 1fr;
            }

            .options-row {
                flex-direction: column;
                gap: 12px;
                align-items: flex-start;
            }
        }
    </style>
</head>
<body>
    <!-- Animated Background -->
    <div class="bg-animation">
        <div class="floating-shapes">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
        </div>
        <div class="grid-pattern"></div>
    </div>

    <div class="wrap">
        <div class="login-container">
            <!-- Logo -->
            <div class="logo-section">
                <div class="logo">☕</div>
                <div class="logo-text">MyApp</div>
            </div>

            <!-- Login Card -->
            <div class="card">
                <h1>ยินดีต้อนรับกลับ</h1>
                <p class="subtitle">เข้าสู่ระบบเพื่อดำเนินการต่อ</p>

                @if($errors->any())
                    <div class="error-box">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ url('/login') }}">
                    @csrf

                    <div class="form-group">
                        <label for="email">อีเมล</label>
                        <div class="input-wrapper">
                            <input id="email" class="input" type="email" name="email" value="{{ old('email') }}" placeholder="your@email.com" required autofocus>
                            <span class="input-icon">📧</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password">รหัสผ่าน</label>
                        <div class="input-wrapper">
                            <input id="password" class="input" type="password" name="password" placeholder="••••••••" required>
                            <span class="input-icon">🔒</span>
                        </div>
                    </div>

                    <div class="options-row">
                        <label class="checkbox-wrapper">
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                            <span>จำฉันไว้</span>
                        </label>
                        <a href="#" class="forgot-link">ลืมรหัสผ่าน?</a>
                    </div>

                    <button type="submit" class="btn-primary">
                        เข้าสู่ระบบ
                    </button>
                </form>

                <div class="divider">
                    <span>หรือ</span>
                </div>

                <div class="social-buttons">
                    <button type="button" class="btn-social">
                        <svg viewBox="0 0 24 24" fill="currentColor">
                            <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                            <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                            <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                            <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                        </svg>
                        Google
                    </button>
                    <button type="button" class="btn-social">
                        <svg viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                        </svg>
                        GitHub
                    </button>
                </div>

                <div class="register-section">
                    <p>ยังไม่มีบัญชี?<a href="/register" class="register-link">สมัครสมาชิก</a></p>
                </div>
            </div>

            <!-- Footer -->
            <div class="footer">
                <p>© {{ date('Y') }} MyApp. All rights reserved.</p>
                <div style="margin-top: 8px;">
                    <a href="#">Privacy Policy</a>
                    <a href="#">Terms of Service</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
