<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>POS - ร้านกาแฟ</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root{--dark:#0f172a;--darker:#020617;--card:#1e293b;--muted:#64748b;--accent:#3b82f6;--accent-light:#60a5fa;--success:#10b981;--border:#334155}
        *{box-sizing:border-box;margin:0;padding:0}
        body{font-family:Inter,system-ui,-apple-system,'Segoe UI',Roboto;background:var(--dark);color:#e2e8f0;min-height:100vh}
        .app-container{display:grid;grid-template-columns:80px 1fr 380px;gap:0;height:100vh;overflow:hidden;background:linear-gradient(135deg, var(--dark) 0%, var(--darker) 100%)}
        .sidebar-left{background:rgba(30,41,59,0.9);border-right:1px solid var(--border);display:flex;flex-direction:column;align-items:center;padding:16px 0;gap:12px;overflow-y:auto}
        .logo{width:50px;height:50px;background:linear-gradient(135deg, var(--accent), var(--accent-light));border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:24px;font-weight:700;color:#fff;margin-bottom:8px;cursor:pointer;transition:all 0.2s;text-decoration:none}
        .logo:hover{transform:scale(1.05)}
        .nav-item{width:56px;height:56px;border-radius:10px;display:flex;align-items:center;justify-content:center;cursor:pointer;transition:all 0.2s;font-size:24px;border:2px solid transparent;position:relative;text-decoration:none;color:#e2e8f0}
        .nav-item:hover{background:rgba(59,130,246,0.1);border-color:var(--accent)}
        .nav-item.active{background:rgba(59,130,246,0.2);border-color:var(--accent);color:var(--accent)}
        .nav-item-tooltip{position:absolute;left:70px;background:rgba(30,41,59,0.95);padding:6px 10px;border-radius:6px;font-size:11px;white-space:nowrap;opacity:0;pointer-events:none;transition:opacity 0.2s;border:1px solid var(--border);z-index:100}
        .nav-item:hover .nav-item-tooltip{opacity:1}
        .nav-spacer{flex:1}
        .container{display:grid;grid-template-columns:1fr 380px;gap:20px;height:100%;overflow:hidden}
        .main{display:flex;flex-direction:column;overflow:hidden}
        .header{background:rgba(30,41,59,0.8);backdrop-filter:blur(10px);padding:16px 20px;border-bottom:1px solid var(--border);display:flex;justify-content:space-between;align-items:center}
        .header-title{font-size:20px;font-weight:700;color:#e2e8f0}
        .logout-btn{background:rgba(239,68,68,0.1);color:#fca5a5;border:1px solid rgba(239,68,68,0.3);padding:6px 12px;border-radius:8px;cursor:pointer;font-size:13px;transition:all 0.2s}
        .logout-btn:hover{background:rgba(239,68,68,0.2)}
        .products-area{flex:1;overflow-y:auto;padding:20px}
        .categories{display:flex;gap:8px;margin-bottom:20px;overflow-x:auto;padding-bottom:8px}
        .category-btn{padding:8px 14px;border-radius:8px;border:1px solid var(--border);background:rgba(51,65,85,0.5);color:var(--muted);cursor:pointer;white-space:nowrap;transition:all 0.2s;font-size:13px}
        .category-btn.active{background:var(--accent);color:#fff;border-color:var(--accent)}
        .category-btn:hover{border-color:var(--accent)}
        .products-grid{display:grid;grid-template-columns:repeat(auto-fill, minmax(140px, 1fr));gap:12px}
        .product-card{background:rgba(30,41,59,0.6);border:1px solid var(--border);border-radius:10px;padding:12px;cursor:pointer;transition:all 0.2s;display:flex;flex-direction:column;gap:8px}
        .product-card:hover{background:rgba(30,41,59,0.9);border-color:var(--accent);transform:translateY(-2px)}
        .product-name{font-weight:600;font-size:14px;color:#e2e8f0;line-height:1.2}
        .product-category{font-size:11px;color:var(--muted)}
        .product-price{font-size:16px;font-weight:700;color:var(--accent-light);margin-top:auto}
        .add-btn{background:var(--accent);color:#fff;border:0;padding:6px 10px;border-radius:6px;cursor:pointer;font-size:12px;font-weight:600;transition:all 0.2s}
        .add-btn:hover{background:var(--accent-light)}
        .add-btn:active{transform:scale(0.95)}
        .sidebar{background:rgba(30,41,59,0.6);border-left:1px solid var(--border);display:flex;flex-direction:column;overflow:hidden}
        .sidebar-header{padding:16px 14px;border-bottom:1px solid var(--border);font-weight:600;font-size:14px}
        .cart-items{flex:1;overflow-y:auto;padding:12px;display:flex;flex-direction:column;gap:10px}
        .cart-item{background:rgba(51,65,85,0.5);border-radius:8px;padding:10px;font-size:12px;border:1px solid var(--border)}
        .cart-item-header{display:flex;justify-content:space-between;margin-bottom:6px}
        .cart-item-name{font-weight:600;color:#e2e8f0}
        .cart-item-remove{color:#fca5a5;cursor:pointer;text-decoration:underline;font-size:11px}
        .cart-item-footer{display:flex;justify-content:space-between;align-items:center}
        .qty-input{width:40px;padding:3px 4px;background:rgba(15,23,42,0.8);border:1px solid var(--border);border-radius:4px;color:#e2e8f0;text-align:center;font-size:11px}
        .cart-item-total{color:var(--accent-light);font-weight:600}
        .empty-cart{text-align:center;color:var(--muted);padding:20px;font-size:13px}
        .sidebar-footer{padding:12px;border-top:1px solid var(--border);display:flex;flex-direction:column;gap:8px}
        .summary-row{display:flex;justify-content:space-between;font-size:13px}
        .total-amount{display:flex;justify-content:space-between;font-size:16px;font-weight:700;color:var(--accent-light);padding:8px;background:rgba(59,130,246,0.1);border-radius:8px}
        .action-btn{padding:10px;border-radius:8px;border:0;cursor:pointer;font-weight:600;font-size:13px;transition:all 0.2s;color:#fff}
        .checkout-btn{background:var(--success);flex:1}
        .checkout-btn:hover{background:#059669;transform:translateY(-1px)}
        .clear-btn{background:rgba(239,68,68,0.2);color:#fca5a5;border:1px solid rgba(239,68,68,0.3)}
        .clear-btn:hover{background:rgba(239,68,68,0.3)}
        .success-msg{background:rgba(16,185,129,0.1);border:1px solid rgba(16,185,129,0.3);color:#6ee7b7;padding:10px 12px;border-radius:8px;margin:12px;font-size:13px}
        .error-msg{background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.3);color:#fca5a5;padding:10px 12px;border-radius:8px;margin:12px;font-size:13px}
        @media(max-width:1024px){
            .app-container{grid-template-columns:80px 1fr}
            .sidebar{position:fixed;right:0;top:0;width:350px;height:100%;z-index:1000;box-shadow:-4px 0 12px rgba(0,0,0,0.3)}
        }
        ::-webkit-scrollbar{width:8px}
        ::-webkit-scrollbar-track{background:rgba(51,65,85,0.3)}
        ::-webkit-scrollbar-thumb{background:rgba(59,130,246,0.5);border-radius:4px}
        ::-webkit-scrollbar-thumb:hover{background:rgba(59,130,246,0.7)}
    </style>
</head>
<body>
    <div class="app-container">
        <!-- Left Sidebar Navigation -->
        <div class="sidebar-left">
            <a href="{{ route('pos.index') }}" class="logo" title="Home">☕</a>

            <a href="{{ route('pos.index') }}" class="nav-item active" title="ระบบ POS">
                <span>🛒</span>
                <div class="nav-item-tooltip">ระบบ POS</div>
            </a>

            <a href="{{ route('users.index') }}" class="nav-item" title="จัดการผู้ใช้">
                <span>👥</span>
                <div class="nav-item-tooltip">จัดการผู้ใช้</div>
            </a>

            <div class="nav-spacer"></div>

            <form method="POST" action="{{ route('logout') }}" style="width:100%;display:flex;justify-content:center">
                @csrf
                <button type="submit" class="nav-item" title="ออกจากระบบ" style="background:rgba(239,68,68,0.1);border-color:rgba(239,68,68,0.3);color:#fca5a5">
                    <span>🚪</span>
                    <div class="nav-item-tooltip">ออกจากระบบ</div>
                </button>
            </form>
        </div>

        <!-- Main Content -->
        <div class="container">
            <div class="main">
                <div class="header" style="display:flex;justify-content:space-between;align-items:center">
                    <div class="header-title">☕ ระบบ POS - ร้านกาแฟ</div>
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

            @if(session('success'))
                <div class="success-msg">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="error-msg">{{ session('error') }}</div>
            @endif

            <div class="products-area">
                <div class="categories">
                    <button class="category-btn active" onclick="filterByCategory('all')">ทั้งหมด</button>
                    @foreach($categories as $cat)
                        <button class="category-btn" onclick="filterByCategory('{{ $cat }}')">{{ $cat }}</button>
                    @endforeach
                </div>

                <div class="products-grid" id="productsGrid">
                    @foreach($products as $product)
                        <div class="product-card" data-category="{{ $product->category }}">
                            <div class="product-name">{{ $product->name }}</div>
                            <div class="product-category">{{ $product->category }}</div>
                            <div class="product-price">฿{{ number_format($product->price, 0) }}</div>
                            <form method="POST" action="{{ route('pos.addToCart', $product) }}" style="display:contents">
                                @csrf
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="add-btn">เพิ่ม</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="sidebar">
            <div class="sidebar-header">🛒 ตะกร้า</div>

            <div class="cart-items" id="cartItems">
                @php $cart = session('cart', []); @endphp
                @if(empty($cart))
                    <div class="empty-cart">ตะกร้าว่างเปล่า</div>
                @else
                    @foreach($cart as $item)
                        <div class="cart-item">
                            <div class="cart-item-header">
                                <div class="cart-item-name">{{ $item['name'] }}</div>
                                <form method="POST" action="{{ route('pos.removeFromCart', $item['id']) }}" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="cart-item-remove">ลบ</button>
                                </form>
                            </div>
                            <div class="cart-item-footer">
                                <div>
                                    <input type="number" class="qty-input" value="{{ $item['quantity'] }}" min="1" onchange="updateQuantity({{ $item['id'] }}, this.value)">
                                </div>
                                <div class="cart-item-total">฿{{ number_format($item['price'] * $item['quantity'], 0) }}</div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <div class="sidebar-footer">
                @php
                    $cartTotal = 0;
                    foreach(session('cart', []) as $item) {
                        $cartTotal += $item['price'] * $item['quantity'];
                    }
                @endphp
                <div class="total-amount">
                    <div>รวมทั้งสิ้น</div>
                    <div>฿{{ number_format($cartTotal, 0) }}</div>
                </div>

                <form method="POST" action="{{ route('pos.checkout') }}">
                    @csrf
                    <button type="submit" class="action-btn checkout-btn" {{ empty($cart) ? 'disabled' : '' }}>ชำระเงิน</button>
                </form>

                <form method="POST" action="{{ route('pos.clearCart') }}">
                    @csrf
                    <button type="submit" class="action-btn clear-btn" {{ empty($cart) ? 'disabled' : '' }}>ล้างตะกร้า</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function filterByCategory(category) {
            const cards = document.querySelectorAll('.product-card');
            const buttons = document.querySelectorAll('.category-btn');

            buttons.forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');

            cards.forEach(card => {
                if (category === 'all' || card.dataset.category === category) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        function updateQuantity(productId, quantity) {
            // Implement AJAX update or form submission
            console.log('Update quantity:', productId, quantity);
        }
    </script>
</body>
</html>
