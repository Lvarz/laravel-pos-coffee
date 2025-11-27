@extends('layouts.app')

@section('title', 'จัดการผู้ใช้')

@section('content')
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:18px">
    <h2 style="color:#e2e8f0;font-size:24px">จัดการผู้ใช้</h2>
    <a href="{{ route('users.create') }}" style="padding:8px 12px;background:#3b82f6;color:#fff;border-radius:8px;text-decoration:none;transition:all 0.2s">สร้างผู้ใช้</a>
</div>

<div style="background:rgba(30,41,59,0.6);border-radius:12px;padding:12px;box-shadow:0 6px 18px rgba(0,0,0,0.3);border:1px solid #334155;overflow:auto">
    <table style="width:100%;border-collapse:collapse">
        <thead>
            <tr style="text-align:left;border-bottom:1px solid #334155">
                <th style="padding:12px;color:#64748b">ID</th>
                <th style="padding:12px;color:#64748b">ชื่อ</th>
                <th style="padding:12px;color:#64748b">อีเมล</th>
                <th style="padding:12px;color:#64748b">ตำแหน่ง</th>
                <th style="padding:12px;color:#64748b">สร้างเมื่อ</th>
                <th style="padding:12px;width:220px;color:#64748b">การกระทำ</th>
            </tr>
        </thead>
        <tbody>
        @forelse($users as $u)
            <tr style="border-bottom:1px solid #334155">
                <td style="padding:12px;vertical-align:middle;color:#e2e8f0">{{ $u->id }}</td>
                <td style="padding:12px;vertical-align:middle;color:#e2e8f0">{{ $u->name }}</td>
                <td style="padding:12px;vertical-align:middle;color:#e2e8f0">{{ $u->email }}</td>
                <td style="padding:12px;vertical-align:middle">
                    <span style="padding:4px 8px;border-radius:6px;font-size:12px;font-weight:600;{{ $u->role === 'owner' ? 'background:rgba(59,130,246,0.1);color:#60a5fa' : 'background:rgba(16,185,129,0.1);color:#6ee7b7' }}">
                        {{ $u->role === 'owner' ? '👑 เจ้าของร้าน' : '🔧 พนักงาน' }}
                    </span>
                </td>
                <td style="padding:12px;vertical-align:middle;color:#64748b">{{ $u->created_at->format('Y-m-d') }}</td>
                <td style="padding:12px;vertical-align:middle">
                    <a href="{{ route('users.edit', $u) }}" style="margin-right:8px;color:#60a5fa;text-decoration:none;transition:all 0.2s">แก้ไข</a>
                    <form method="POST" action="{{ route('users.destroy', $u) }}" style="display:inline" onsubmit="return confirm('ลบผู้ใช้นี้จริงหรือไม่?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="background:rgba(239,68,68,0.1);color:#fca5a5;border:1px solid rgba(239,68,68,0.3);padding:6px 10px;border-radius:8px;cursor:pointer;transition:all 0.2s">ลบ</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" style="padding:18px;text-align:center;color:#64748b">ยังไม่มีผู้ใช้</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <div style="margin-top:12px">{{ $users->links() }}</div>
</div>
@endsection
