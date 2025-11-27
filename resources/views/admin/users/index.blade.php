@extends('layouts.app')

@section('content')
<div style="max-width:1100px;margin:36px auto;padding:18px">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:18px">
        <h2>จัดการผู้ใช้</h2>
        <a href="{{ route('users.create') }}" style="padding:8px 12px;background:#2563eb;color:#fff;border-radius:8px;text-decoration:none">สร้างผู้ใช้</a>
    </div>

    @if(session('success'))
        <div style="padding:10px 12px;background:#ecfdf5;color:#065f46;border-radius:8px;margin-bottom:12px">{{ session('success') }}</div>
    @endif

    <div style="background:#fff;border-radius:12px;padding:12px;box-shadow:0 6px 18px rgba(2,6,23,0.04)">
        <table style="width:100%;border-collapse:collapse">
            <thead>
                <tr style="text-align:left;border-bottom:1px solid #eef2ff">
                    <th style="padding:12px">ID</th>
                    <th style="padding:12px">ชื่อ</th>
                    <th style="padding:12px">อีเมล</th>
                    <th style="padding:12px">สร้างเมื่อ</th>
                    <th style="padding:12px;width:220px">การกระทำ</th>
                </tr>
            </thead>
            <tbody>
            @forelse($users as $u)
                <tr style="border-bottom:1px solid #f1f5f9">
                    <td style="padding:12px;vertical-align:middle">{{ $u->id }}</td>
                    <td style="padding:12px;vertical-align:middle">{{ $u->name }}</td>
                    <td style="padding:12px;vertical-align:middle">{{ $u->email }}</td>
                    <td style="padding:12px;vertical-align:middle">{{ $u->created_at->format('Y-m-d') }}</td>
                    <td style="padding:12px;vertical-align:middle">
                        <a href="{{ route('users.edit', $u) }}" style="margin-right:8px;color:#2563eb">แก้ไข</a>
                        <form method="POST" action="{{ route('users.destroy', $u) }}" style="display:inline" onsubmit="return confirm('ลบผู้ใช้นี้จริงหรือไม่?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background:#fee2e2;color:#b91c1c;border:0;padding:6px 10px;border-radius:8px;cursor:pointer">ลบ</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="padding:18px;text-align:center;color:#6b7280">ยังไม่มีผู้ใช้</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <div style="margin-top:12px">{{ $users->links() }}</div>
    </div>
</div>
@endsection
