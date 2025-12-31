<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>สมัครสมาชิก | Coffee POS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-primary: #0a0a0f;
            --bg-secondary: #12121a;
            --card-bg: rgba(18, 18, 26, 0.8);
            --glass-bg: rgba(255, 255, 255, 0.03);
            --text-primary: #ffffff;
            --text-secondary: #a1a1aa;
            --text-muted: #71717a;
            --accent: #f59e0b;
            --accent-light: #fbbf24;
            --accent-glow: rgba(245, 158, 11, 0.4);
            --success: #10b981;
            --error: #ef4444;
            --border: rgba(255, 255, 255, 0.08);
            --border-hover: rgba(245, 158, 11, 0.5);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Prompt', system-ui, -apple-system, sans-serif;
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
                radial-gradient(circle at 20% 80%, rgba(245, 158, 11, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(251, 191, 36, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(217, 119, 6, 0.1) 0%, transparent 40%);
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
            background: linear-gradient(135deg, rgba(245, 158, 11, 0.3), rgba(251, 191, 36, 0.2));
            top: -100px;
            right: -100px;
            animation-delay: 0s;
        }

        .shape-2 {
            width: 300px;
            height: 300px;
            background: linear-gradient(135deg, rgba(217, 119, 6, 0.25), rgba(245, 158, 11, 0.15));
            bottom: -50px;
            left: -50px;
            animation-delay: -5s;
        }

        .shape-3 {
            width: 200px;
            height: 200px;
            background: linear-gradient(135deg, rgba(180, 83, 9, 0.2), rgba(245, 158, 11, 0.15));
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

        .register-container {
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
            margin-bottom: 32px;
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
            margin-bottom: 16px;
            box-shadow: 0 20px 40px var(--accent-glow);
            animation: pulse 3s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { box-shadow: 0 20px 40px var(--accent-glow); }
            50% { box-shadow: 0 25px 50px rgba(245, 158, 11, 0.5); }
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
            padding: 40px;
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
            font-size: 28px;
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
            font-size: 14px;
            margin-bottom: 32px;
            line-height: 1.6;
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: 500;
            color: var(--text-secondary);
            margin-bottom: 8px;
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
            padding: 14px 16px 14px 50px;
            border: 1px solid var(--border);
            border-radius: 12px;
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

        .input.error {
            border-color: var(--error);
        }

        .input.error:focus {
            box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.2);
        }

        /* Password Strength */
        .password-strength {
            margin-top: 8px;
            height: 4px;
            background: var(--border);
            border-radius: 2px;
            overflow: hidden;
        }

        .password-strength-bar {
            height: 100%;
            width: 0;
            transition: all 0.3s ease;
            border-radius: 2px;
        }

        .password-strength-bar.weak { width: 33%; background: var(--error); }
        .password-strength-bar.medium { width: 66%; background: var(--accent); }
        .password-strength-bar.strong { width: 100%; background: var(--success); }

        .password-hint {
            font-size: 12px;
            color: var(--text-muted);
            margin-top: 6px;
        }

        /* Submit Button */
        .btn-primary {
            width: 100%;
            padding: 16px 24px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--accent), var(--accent-light));
            color: #000;
            font-size: 16px;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 30px var(--accent-glow);
            margin-top: 8px;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 40px rgba(245, 158, 11, 0.5);
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        /* Error Message */
        .error-box {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
            border-radius: 12px;
            padding: 14px;
            margin-bottom: 20px;
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
            font-size: 13px;
        }

        .error-box li {
            margin: 4px 0;
        }

        .field-error {
            color: #fca5a5;
            font-size: 12px;
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* Divider */
        .divider {
            display: flex;
            align-items: center;
            gap: 16px;
            margin: 24px 0;
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
        }

        /* Login Link */
        .login-section {
            text-align: center;
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid var(--border);
        }

        .login-section p {
            font-size: 14px;
            color: var(--text-muted);
        }

        .login-link {
            color: var(--accent-light);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.2s;
            margin-left: 4px;
        }

        .login-link:hover {
            color: var(--text-primary);
            text-decoration: underline;
        }

        /* Terms */
        .terms {
            font-size: 12px;
            color: var(--text-muted);
            text-align: center;
            margin-top: 16px;
            line-height: 1.6;
        }

        .terms a {
            color: var(--accent-light);
            text-decoration: none;
        }

        .terms a:hover {
            text-decoration: underline;
        }

        /* Footer */
        .footer {
            text-align: center;
            margin-top: 24px;
            font-size: 12px;
            color: var(--text-muted);
        }

        /* Benefits List */
        .benefits {
            background: var(--glass-bg);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 24px;
        }

        .benefits-title {
            font-size: 13px;
            font-weight: 600;
            color: var(--text-secondary);
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .benefits-list {
            list-style: none;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
        }

        .benefits-list li {
            font-size: 12px;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .benefits-list li::before {
            content: '✓';
            color: var(--success);
            font-weight: 700;
        }

        /* Responsive */
        @media (max-width: 640px) {
            .wrap {
                padding: 16px;
            }

            .card {
                padding: 28px 20px;
                border-radius: 20px;
            }

            h1 {
                font-size: 24px;
            }

            .logo {
                width: 64px;
                height: 64px;
                font-size: 28px;
                border-radius: 18px;
            }

            .benefits-list {
                grid-template-columns: 1fr;
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
        <div class="register-container">
            <!-- Logo -->
            <div class="logo-section">
                <div class="logo">☕</div>
                <div class="logo-text">Coffee POS</div>
            </div>

            <!-- Register Card -->
            <div class="card">
                <h1>สร้างบัญชีใหม่</h1>
                <p class="subtitle">สมัครสมาชิกเพื่อเริ่มใช้งานระบบ</p>

                <!-- Benefits -->
                <div class="benefits">
                    <div class="benefits-title">🎁 สิทธิประโยชน์สมาชิก</div>
                    <ul class="benefits-list">
                        <li>ใช้งานระบบ POS</li>
                        <li>ดูรายงานยอดขาย</li>
                        <li>จัดการออเดอร์</li>
                        <li>บันทึกประวัติ</li>
                    </ul>
                </div>

                @if($errors->any())
                    <div class="error-box">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}" id="registerForm">
                    @csrf

                    <div class="form-group">
                        <label for="name">ชื่อ-นามสกุล</label>
                        <div class="input-wrapper">
                            <input
                                id="name"
                                class="input @error('name') error @enderror"
                                type="text"
                                name="name"
                                value="{{ old('name') }}"
                                placeholder="กรอกชื่อ-นามสกุล"
                                required
                                autofocus
                            >
                            <span class="input-icon">👤</span>
                        </div>
                        @error('name')
                            <div class="field-error">⚠️ {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">อีเมล</label>
                        <div class="input-wrapper">
                            <input
                                id="email"
                                class="input @error('email') error @enderror"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="your@email.com"
                                required
                            >
                            <span class="input-icon">📧</span>
                        </div>
                        @error('email')
                            <div class="field-error">⚠️ {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">รหัสผ่าน</label>
                        <div class="input-wrapper">
                            <input
                                id="password"
                                class="input @error('password') error @enderror"
                                type="password"
                                name="password"
                                placeholder="อย่างน้อย 6 ตัวอักษร"
                                required
                            >
                            <span class="input-icon">🔒</span>
                        </div>
                        <div class="password-strength">
                            <div class="password-strength-bar" id="strengthBar"></div>
                        </div>
                        <div class="password-hint" id="passwordHint">รหัสผ่านต้องมีอย่างน้อย 6 ตัวอักษร</div>
                        @error('password')
                            <div class="field-error">⚠️ {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">ยืนยันรหัสผ่าน</label>
                        <div class="input-wrapper">
                            <input
                                id="password_confirmation"
                                class="input"
                                type="password"
                                name="password_confirmation"
                                placeholder="กรอกรหัสผ่านอีกครั้ง"
                                required
                            >
                            <span class="input-icon">🔐</span>
                        </div>
                        <div class="field-error" id="confirmError" style="display: none;">⚠️ รหัสผ่านไม่ตรงกัน</div>
                    </div>

                    <button type="submit" class="btn-primary" id="submitBtn">
                        🚀 สมัครสมาชิก
                    </button>

                    <p class="terms">
                        การสมัครสมาชิกหมายความว่าคุณยอมรับ
                        <a href="#">ข้อกำหนดการใช้งาน</a> และ
                        <a href="#">นโยบายความเป็นส่วนตัว</a>
                    </p>
                </form>

                <div class="login-section">
                    <p>มีบัญชีอยู่แล้ว?<a href="{{ route('login') }}" class="login-link">เข้าสู่ระบบ</a></p>
                </div>
            </div>

            <!-- Footer -->
            <div class="footer">
                <p>© {{ date('Y') }} Coffee POS. All rights reserved.</p>
            </div>
        </div>
    </div>

    <script>
        // Password strength checker
        const passwordInput = document.getElementById('password');
        const strengthBar = document.getElementById('strengthBar');
        const passwordHint = document.getElementById('passwordHint');
        const confirmInput = document.getElementById('password_confirmation');
        const confirmError = document.getElementById('confirmError');

        passwordInput.addEventListener('input', function() {
            const password = this.value;
            let strength = 0;
            let hint = '';

            if (password.length >= 6) strength++;
            if (password.length >= 8) strength++;
            if (/[A-Z]/.test(password) && /[a-z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            if (/[^A-Za-z0-9]/.test(password)) strength++;

            strengthBar.className = 'password-strength-bar';

            if (password.length === 0) {
                strengthBar.style.width = '0';
                hint = 'รหัสผ่านต้องมีอย่างน้อย 6 ตัวอักษร';
            } else if (strength <= 2) {
                strengthBar.classList.add('weak');
                hint = '🔴 รหัสผ่านอ่อนแอ - ลองเพิ่มตัวเลขหรืออักขระพิเศษ';
            } else if (strength <= 3) {
                strengthBar.classList.add('medium');
                hint = '🟡 รหัสผ่านปานกลาง - ดีขึ้นแล้ว!';
            } else {
                strengthBar.classList.add('strong');
                hint = '🟢 รหัสผ่านแข็งแรง - ยอดเยี่ยม!';
            }

            passwordHint.textContent = hint;
            checkPasswordMatch();
        });

        confirmInput.addEventListener('input', checkPasswordMatch);

        function checkPasswordMatch() {
            const password = passwordInput.value;
            const confirm = confirmInput.value;

            if (confirm.length > 0 && password !== confirm) {
                confirmError.style.display = 'flex';
                confirmInput.classList.add('error');
            } else {
                confirmError.style.display = 'none';
                confirmInput.classList.remove('error');
            }
        }

        // Form validation before submit
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            const password = passwordInput.value;
            const confirm = confirmInput.value;

            if (password !== confirm) {
                e.preventDefault();
                confirmError.style.display = 'flex';
                confirmInput.classList.add('error');
                confirmInput.focus();
            }
        });
    </script>
</body>
</html>
