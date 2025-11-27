<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>ใบเสร็จ</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root{--dark:#0f172a;--card:#1e293b;--muted:#64748b;--accent:#3b82f6}
        *{box-sizing:border-box;margin:0;padding:0}
        body{font-family:Inter,system-ui;background:var(--dark);color:#e2e8f0;min-height:100vh;display:flex;align-items:center;justify-content:center;padding:20px}
        .receipt{background:var(--card);border:1px solid #334155;border-radius:12px;width:100%;max-width:420px;padding:24px;box-shadow:0 20px 60px rgba(0,0,0,0.5)}
        .receipt-header{text-align:center;margin-bottom:24px;border-bottom:1px solid #334155;padding-bottom:12px}
        .receipt-title{font-size:20px;font-weight:700;color:#e2e8f0}
        .receipt-subtitle{font-size:13px;color:var(--muted);margin-top:4px}
        .receipt-meta{font-size:11px;color:var(--muted);margin-top:8px}
        .items-list{margin:16px 0;border:1px solid #334155;border-radius:8px;overflow:hidden}
        .item-row{display:flex;justify-content:space-between;padding:10px;border-bottom:1px solid #334155;font-size:13px}
        .item-row:last-child{border-bottom:none}
        .item-name{flex:1;color:#e2e8f0}
        .item-qty{color:var(--muted);width:40px;text-align:center}
        .item-price{color:var(--accent);font-weight:600;width:80px;text-align:right}
        .summary{margin:16px 0;padding:12px;background:rgba(59,130,246,0.1);border-radius:8px;font-size:13px}
        .summary-row{display:flex;justify-content:space-between;margin:6px 0}
        .summary-total{display:flex;justify-content:space-between;font-size:16px;font-weight:700;color:var(--accent);border-top:1px solid #334155;padding-top:8px;margin-top:8px}
        .actions{display:flex;gap:10px;margin-top:20px}
        .btn{flex:1;padding:12px;border-radius:8px;border:0;cursor:pointer;font-weight:600;transition:all 0.2s}
        .btn-print{background:var(--accent);color:#fff}
        .btn-print:hover{background:#2563eb;transform:translateY(-1px)}
        .btn-new{background:rgba(16,185,129,0.1);color:#6ee7b7;border:1px solid rgba(16,185,129,0.3)}
        .btn-new:hover{background:rgba(16,185,129,0.2)}
        @media print{
            body{background:#fff;color:#000}
            .receipt{background:#fff;box-shadow:none}
            .actions{display:none}
        }
    </style>
</head>
<body>
    <div class="receipt">
        <div class="receipt-header">
            <div class="receipt-title">☕ ร้านกาแฟ</div>
            <div class="receipt-subtitle">ใบเสร็จรับเงิน</div>
            <div class="receipt-meta">
                เลขที่: {{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}<br>
                วันที่: {{ $order->created_at->format('d/m/Y H:i:s') }}
            </div>
        </div>

        <div class="items-list">
            @foreach($order->items as $item)
                <div class="item-row">
                    <div class="item-name">{{ $item->product->name }}</div>
                    <div class="item-qty">×{{ $item->quantity }}</div>
                    <div class="item-price">฿{{ number_format($item->total_price, 0) }}</div>
                </div>
            @endforeach
        </div>

        <div class="summary">
            <div class="summary-row">
                <span>จำนวนรายการ</span>
                <span>{{ count($order->items) }}</span>
            </div>
            <div class="summary-row">
                <span>จำนวนชิ้น</span>
                <span>{{ $order->items->sum('quantity') }}</span>
            </div>
        </div>

        <div class="summary-total">
            <span>รวมทั้งสิ้น</span>
            <span>฿{{ number_format($order->total_amount, 0) }}</span>
        </div>

        <div style="text-align:center;margin-top:16px;font-size:11px;color:var(--muted)">
            ขอบคุณที่ใช้บริการ 🙏
        </div>

        <div class="actions">
            <button class="btn btn-print" onclick="window.print()">🖨️ พิมพ์</button>
            <a href="{{ route('pos.index') }}" class="btn btn-new" style="text-decoration:none;display:flex;align-items:center;justify-content:center;gap:6px">✚ ออเดอร์ใหม่</a>
        </div>
    </div>
</body>
</html>
