<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>POS - ร้านกาแฟ</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-primary: #0a0a0f;
            --bg-secondary: #12121a;
            --bg-card: rgba(18, 18, 26, 0.9);
            --bg-glass: rgba(255, 255, 255, 0.03);
            --text-primary: #ffffff;
            --text-secondary: #a1a1aa;
            --text-muted: #71717a;
            --accent: #f59e0b;
            --accent-light: #fbbf24;
            --accent-glow: rgba(245, 158, 11, 0.3);
            --success: #10b981;
            --success-glow: rgba(16, 185, 129, 0.3);
            --danger: #ef4444;
            --border: rgba(255, 255, 255, 0.08);
            --border-hover: rgba(245, 158, 11, 0.5);
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Prompt', system-ui, -apple-system, sans-serif;
            background: var(--bg-primary);
            color: var(--text-primary);
            min-height: 100vh;
            overflow: hidden;
        }

        /* Layout */
        .app-container {
            display: grid;
            grid-template-columns: 80px 1fr 400px;
            height: 100vh;
            overflow: hidden;
        }

        /* Left Sidebar */
        .sidebar-nav {
            background: var(--bg-secondary);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px 0;
            gap: 8px;
        }

        .logo {
            width: 56px;
            height: 56px;
            background: linear-gradient(135deg, var(--accent), var(--accent-light));
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            margin-bottom: 20px;
            box-shadow: 0 8px 24px var(--accent-glow);
            text-decoration: none;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .logo:hover {
            transform: scale(1.05);
            box-shadow: 0 12px 32px var(--accent-glow);
        }

        .nav-item {
            width: 56px;
            height: 56px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: var(--text-muted);
            text-decoration: none;
            transition: all 0.2s;
            position: relative;
            border: 2px solid transparent;
        }

        .nav-item:hover {
            background: rgba(245, 158, 11, 0.1);
            color: var(--accent);
            border-color: var(--accent);
        }

        .nav-item.active {
            background: rgba(245, 158, 11, 0.15);
            color: var(--accent);
            border-color: var(--accent);
        }

        .nav-tooltip {
            position: absolute;
            left: 70px;
            background: var(--bg-card);
            border: 1px solid var(--border);
            padding: 8px 12px;
            border-radius: 8px;
            font-size: 12px;
            white-space: nowrap;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.2s;
            z-index: 100;
            color: var(--text-primary);
        }

        .nav-item:hover .nav-tooltip { opacity: 1; }

        .nav-spacer { flex: 1; }

        .nav-logout {
            background: rgba(239, 68, 68, 0.1);
            color: #fca5a5;
            border: none;
            cursor: pointer;
            font-family: inherit;
        }

        .nav-logout:hover {
            background: rgba(239, 68, 68, 0.2);
            border-color: rgba(239, 68, 68, 0.5);
        }

        /* Main Content */
        .main-content {
            display: flex;
            flex-direction: column;
            overflow: hidden;
            background: linear-gradient(180deg, var(--bg-primary) 0%, var(--bg-secondary) 100%);
        }

        /* Header */
        .header {
            background: var(--bg-card);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border);
            padding: 16px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .header-title {
            font-size: 24px;
            font-weight: 700;
            background: linear-gradient(135deg, var(--accent), var(--accent-light));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .header-time {
            font-size: 14px;
            color: var(--text-muted);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
            background: var(--bg-glass);
            padding: 8px 16px;
            border-radius: 12px;
            border: 1px solid var(--border);
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--accent), var(--accent-light));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .user-details {
            text-align: right;
        }

        .user-name {
            font-weight: 600;
            font-size: 14px;
        }

        .user-role {
            font-size: 12px;
            color: var(--accent);
        }

        /* Messages */
        .message {
            margin: 16px 24px 0;
            padding: 12px 16px;
            border-radius: 10px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .message-success {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.3);
            color: #6ee7b7;
        }

        .message-error {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #fca5a5;
        }

        /* Products Area */
        .products-area {
            flex: 1;
            overflow-y: auto;
            padding: 24px;
        }

        /* Categories */
        .categories {
            display: flex;
            gap: 10px;
            margin-bottom: 24px;
            flex-wrap: wrap;
        }

        .category-btn {
            padding: 10px 20px;
            border-radius: 12px;
            border: 1px solid var(--border);
            background: var(--bg-glass);
            color: var(--text-secondary);
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            font-family: inherit;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .category-btn:hover {
            border-color: var(--border-hover);
            background: rgba(245, 158, 11, 0.1);
        }

        .category-btn.active {
            background: linear-gradient(135deg, var(--accent), var(--accent-light));
            color: #000;
            border-color: transparent;
            font-weight: 600;
        }

        .category-icon { font-size: 18px; }

        /* Products Grid */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 16px;
        }

        .product-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            position: relative;
            overflow: hidden;
        }

        .product-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--accent), var(--accent-light));
            opacity: 0;
            transition: opacity 0.3s;
        }

        .product-card:hover {
            border-color: var(--border-hover);
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.3);
        }

        .product-card:hover::before { opacity: 1; }

        .product-emoji {
            font-size: 48px;
            text-align: center;
            margin-bottom: 12px;
            filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.3));
        }

        .product-name {
            font-weight: 600;
            font-size: 16px;
            color: var(--text-primary);
            margin-bottom: 4px;
            line-height: 1.3;
        }

        .product-category {
            font-size: 12px;
            color: var(--text-muted);
            margin-bottom: 12px;
        }

        .product-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: auto;
        }

        .product-price {
            font-size: 20px;
            font-weight: 700;
            color: var(--accent);
        }

        .add-btn {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--accent), var(--accent-light));
            color: #000;
            border: none;
            cursor: pointer;
            font-size: 20px;
            font-weight: 700;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .add-btn:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 12px var(--accent-glow);
        }

        .add-btn:active { transform: scale(0.95); }

        /* Cart Sidebar */
        .cart-sidebar {
            background: var(--bg-secondary);
            border-left: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .cart-header {
            padding: 20px;
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .cart-title {
            font-size: 20px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .cart-count {
            background: var(--accent);
            color: #000;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 700;
        }

        .cart-items {
            flex: 1;
            overflow-y: auto;
            padding: 16px;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .cart-empty {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: var(--text-muted);
            gap: 12px;
        }

        .cart-empty-icon { font-size: 64px; opacity: 0.5; }
        .cart-empty-text { font-size: 14px; }

        .cart-item {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 14px;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateX(20px); }
            to { opacity: 1; transform: translateX(0); }
        }

        .cart-item-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 10px;
        }

        .cart-item-name {
            font-weight: 600;
            font-size: 15px;
            color: var(--text-primary);
        }

        .cart-item-price {
            font-size: 13px;
            color: var(--text-muted);
        }

        .cart-item-remove {
            background: rgba(239, 68, 68, 0.1);
            border: none;
            color: #fca5a5;
            padding: 6px 10px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 12px;
            font-family: inherit;
            transition: all 0.2s;
        }

        .cart-item-remove:hover {
            background: rgba(239, 68, 68, 0.2);
        }

        .cart-item-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .qty-controls {
            display: flex;
            align-items: center;
            gap: 8px;
            background: var(--bg-glass);
            border-radius: 10px;
            padding: 4px;
        }

        .qty-btn {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: var(--bg-card);
            border: 1px solid var(--border);
            color: var(--text-primary);
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .qty-btn:hover {
            background: var(--accent);
            color: #000;
            border-color: var(--accent);
        }

        .qty-value {
            width: 40px;
            text-align: center;
            font-weight: 600;
            font-size: 16px;
        }

        .cart-item-total {
            font-size: 18px;
            font-weight: 700;
            color: var(--accent);
        }

        /* Cart Footer */
        .cart-footer {
            padding: 20px;
            border-top: 1px solid var(--border);
            background: var(--bg-card);
        }

        .cart-summary {
            margin-bottom: 16px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 14px;
            color: var(--text-secondary);
        }

        .summary-total {
            display: flex;
            justify-content: space-between;
            padding: 16px;
            background: linear-gradient(135deg, rgba(245, 158, 11, 0.1), rgba(251, 191, 36, 0.1));
            border-radius: 12px;
            border: 1px solid var(--border-hover);
        }

        .summary-total-label {
            font-size: 16px;
            font-weight: 600;
        }

        .summary-total-value {
            font-size: 24px;
            font-weight: 700;
            color: var(--accent);
        }

        .cart-actions {
            display: flex;
            gap: 12px;
            margin-top: 16px;
        }

        .btn {
            flex: 1;
            padding: 16px 24px;
            border-radius: 14px;
            border: none;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            font-family: inherit;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .btn-checkout {
            background: linear-gradient(135deg, var(--success), #34d399);
            color: white;
            box-shadow: 0 8px 24px var(--success-glow);
        }

        .btn-checkout:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 12px 32px var(--success-glow);
        }

        .btn-clear {
            background: rgba(239, 68, 68, 0.1);
            color: #fca5a5;
            border: 1px solid rgba(239, 68, 68, 0.3);
            flex: 0.4;
        }

        .btn-clear:hover:not(:disabled) {
            background: rgba(239, 68, 68, 0.2);
        }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb {
            background: rgba(245, 158, 11, 0.3);
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: rgba(245, 158, 11, 0.5);
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .app-container {
                grid-template-columns: 70px 1fr 350px;
            }
        }

        @media (max-width: 1024px) {
            .app-container {
                grid-template-columns: 1fr;
            }
            .sidebar-nav {
                position: fixed;
                bottom: 0;
                left: 0;
                right: 0;
                height: 70px;
                flex-direction: row;
                justify-content: space-around;
                padding: 0 20px;
                z-index: 100;
                border-right: none;
                border-top: 1px solid var(--border);
            }
            .logo { display: none; }
            .nav-spacer { display: none; }
            .nav-item { width: 50px; height: 50px; font-size: 22px; }
            .nav-tooltip { display: none; }
            .main-content { padding-bottom: 70px; }
            .cart-sidebar {
                position: fixed;
                right: -100%;
                top: 0;
                width: 100%;
                max-width: 400px;
                height: 100%;
                z-index: 200;
                transition: right 0.3s ease;
            }
            .cart-sidebar.open { right: 0; }
        }
    </style>
</head>
<body>
    <div class="app-container">
        <!-- Left Sidebar -->
        <nav class="sidebar-nav">
            <a href="{{ route('pos.index') }}" class="logo">☕</a>

            <a href="{{ route('pos.index') }}" class="nav-item active">
                <span>🛒</span>
                <div class="nav-tooltip">ระบบ POS</div>
            </a>

            @if(auth()->user()->role === 'owner')
            <a href="{{ route('users.index') }}" class="nav-item">
                <span>👥</span>
                <div class="nav-tooltip">จัดการผู้ใช้</div>
            </a>
            @endif

            <div class="nav-spacer"></div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="nav-item nav-logout">
                    <span>🚪</span>
                    <div class="nav-tooltip">ออกจากระบบ</div>
                </button>
            </form>
        </nav>

        <!-- Main Content -->
        <main class="main-content">
            <header class="header">
                <div class="header-left">
                    <div>
                        <h1 class="header-title">☕ Coffee POS</h1>
                        <div class="header-time" id="currentTime"></div>
                    </div>
                </div>
                <div class="user-info">
                    <div class="user-details">
                        <div class="user-name">{{ auth()->user()->name }}</div>
                        <div class="user-role">
                            @if(auth()->user()->role === 'owner')
                                👑 เจ้าของร้าน
                            @else
                                ☕ พนักงาน
                            @endif
                        </div>
                    </div>
                    <div class="user-avatar">
                        {{ mb_substr(auth()->user()->name, 0, 1) }}
                    </div>
                </div>
            </header>

            @if(session('success'))
                <div class="message message-success">
                    <span>✅</span> {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="message message-error">
                    <span>❌</span> {{ session('error') }}
                </div>
            @endif

            <div class="products-area">
                <div class="categories">
                    <button class="category-btn active" onclick="filterByCategory('all', this)">
                        <span class="category-icon">📋</span> ทั้งหมด
                    </button>
                    @foreach($categories as $cat)
                        <button class="category-btn" onclick="filterByCategory('{{ $cat }}', this)">
                            <span class="category-icon">
                                @if(str_contains(strtolower($cat), 'ร้อน') || str_contains(strtolower($cat), 'hot'))
                                    ☕
                                @elseif(str_contains(strtolower($cat), 'เย็น') || str_contains(strtolower($cat), 'cold') || str_contains(strtolower($cat), 'iced'))
                                    🧊
                                @elseif(str_contains(strtolower($cat), 'ชา') || str_contains(strtolower($cat), 'tea'))
                                    🍵
                                @elseif(str_contains(strtolower($cat), 'ขนม') || str_contains(strtolower($cat), 'bakery'))
                                    🥐
                                @else
                                    🍹
                                @endif
                            </span>
                            {{ $cat }}
                        </button>
                    @endforeach
                </div>

                <div class="products-grid" id="productsGrid">
                    @foreach($products as $product)
                        <div class="product-card" data-category="{{ $product->category }}">
                            <div class="product-emoji">
                                @if(str_contains(strtolower($product->category), 'ร้อน') || str_contains(strtolower($product->name), 'ร้อน'))
                                    ☕
                                @elseif(str_contains(strtolower($product->category), 'เย็น') || str_contains(strtolower($product->name), 'เย็น'))
                                    🧋
                                @elseif(str_contains(strtolower($product->name), 'ลาเต้') || str_contains(strtolower($product->name), 'latte'))
                                    🥛
                                @elseif(str_contains(strtolower($product->name), 'มอคค่า') || str_contains(strtolower($product->name), 'mocha'))
                                    🍫
                                @elseif(str_contains(strtolower($product->name), 'ชา') || str_contains(strtolower($product->name), 'tea'))
                                    🍵
                                @elseif(str_contains(strtolower($product->category), 'ขนม') || str_contains(strtolower($product->category), 'bakery'))
                                    🥐
                                @else
                                    ☕
                                @endif
                            </div>
                            <div class="product-name">{{ $product->name }}</div>
                            <div class="product-category">{{ $product->category }}</div>
                            <div class="product-footer">
                                <div class="product-price">฿{{ number_format($product->price, 0) }}</div>
                                <form method="POST" action="{{ route('pos.addToCart', $product) }}">
                                    @csrf
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="add-btn">+</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </main>

        <!-- Cart Sidebar -->
        <aside class="cart-sidebar">
            <div class="cart-header">
                <div class="cart-title">
                    🛒 ตะกร้า
                    @php $cart = session('cart', []); @endphp
                    @if(count($cart) > 0)
                        <span class="cart-count">{{ count($cart) }}</span>
                    @endif
                </div>
            </div>

            <div class="cart-items">
                @if(empty($cart))
                    <div class="cart-empty">
                        <div class="cart-empty-icon">🛒</div>
                        <div class="cart-empty-text">ยังไม่มีสินค้าในตะกร้า</div>
                    </div>
                @else
                    @foreach($cart as $item)
                        <div class="cart-item">
                            <div class="cart-item-header">
                                <div>
                                    <div class="cart-item-name">{{ $item['name'] }}</div>
                                    <div class="cart-item-price">฿{{ number_format($item['price'], 0) }} / ชิ้น</div>
                                </div>
                                <form method="POST" action="{{ route('pos.removeFromCart', $item['id']) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="cart-item-remove">ลบ</button>
                                </form>
                            </div>
                            <div class="cart-item-footer">
                                <div class="qty-controls">
                                    <button type="button" class="qty-btn" onclick="updateQty({{ $item['id'] }}, {{ $item['quantity'] - 1 }})">−</button>
                                    <span class="qty-value">{{ $item['quantity'] }}</span>
                                    <button type="button" class="qty-btn" onclick="updateQty({{ $item['id'] }}, {{ $item['quantity'] + 1 }})">+</button>
                                </div>
                                <div class="cart-item-total">฿{{ number_format($item['price'] * $item['quantity'], 0) }}</div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <div class="cart-footer">
                <div class="cart-summary">
                    @php
                        $cartTotal = 0;
                        $totalItems = 0;
                        foreach(session('cart', []) as $item) {
                            $cartTotal += $item['price'] * $item['quantity'];
                            $totalItems += $item['quantity'];
                        }
                    @endphp
                    <div class="summary-row">
                        <span>จำนวนรายการ</span>
                        <span>{{ $totalItems }} ชิ้น</span>
                    </div>
                    <div class="summary-total">
                        <span class="summary-total-label">ยอดรวม</span>
                        <span class="summary-total-value">฿{{ number_format($cartTotal, 0) }}</span>
                    </div>
                </div>

                <div class="cart-actions">
                    <form method="POST" action="{{ route('pos.clearCart') }}" style="flex:0.4">
                        @csrf
                        <button type="submit" class="btn btn-clear" {{ empty($cart) ? 'disabled' : '' }}>
                            🗑️ ล้าง
                        </button>
                    </form>
                    <form method="POST" action="{{ route('pos.checkout') }}" style="flex:1">
                        @csrf
                        <button type="submit" class="btn btn-checkout" {{ empty($cart) ? 'disabled' : '' }}>
                            💳 ชำระเงิน ฿{{ number_format($cartTotal, 0) }}
                        </button>
                    </form>
                </div>
            </div>
        </aside>
    </div>

    <script>
        // Update time
        function updateTime() {
            const now = new Date();
            const options = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            };
            document.getElementById('currentTime').textContent = now.toLocaleDateString('th-TH', options);
        }
        updateTime();
        setInterval(updateTime, 1000);

        // Filter by category
        function filterByCategory(category, btn) {
            const cards = document.querySelectorAll('.product-card');
            const buttons = document.querySelectorAll('.category-btn');

            buttons.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            cards.forEach(card => {
                if (category === 'all' || card.dataset.category === category) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        // Update quantity
        function updateQty(productId, quantity) {
            if (quantity < 1) {
                if (confirm('ลบสินค้านี้ออกจากตะกร้า?')) {
                    // Create and submit delete form
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/pos/remove-from-cart/${productId}`;
                    form.innerHTML = `
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="DELETE">
                    `;
                    document.body.appendChild(form);
                    form.submit();
                }
                return;
            }

            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route("pos.updateCart") }}';
            form.innerHTML = `
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="quantities[${productId}]" value="${quantity}">
            `;
            document.body.appendChild(form);
            form.submit();
        }

        // Auto hide messages
        setTimeout(() => {
            document.querySelectorAll('.message').forEach(msg => {
                msg.style.transition = 'opacity 0.5s';
                msg.style.opacity = '0';
                setTimeout(() => msg.remove(), 500);
            });
        }, 3000);
    </script>
</body>
</html>
