@if($errors->any())
    <div style="padding:10px;background:#fff1f2;color:#991b1b;border-radius:8px;margin-bottom:12px">
        <ul style="margin:0;padding-left:18px">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ $action }}">
    @csrf
    @if(in_array(strtoupper($method), ['PUT','PATCH','DELETE']))
        @method($method)
    @endif

    <div style="margin-bottom:12px">
        <label for="name" style="display:block;margin-bottom:6px">ชื่อ</label>
        <input id="name" name="name" value="{{ old('name', optional($user)->name) }}" class="input" style="width:100%;padding:10px;border-radius:8px;border:1px solid #e6eef9">
    </div>

    <div style="margin-bottom:12px">
        <label for="email" style="display:block;margin-bottom:6px">อีเมล</label>
        <input id="email" type="email" name="email" value="{{ old('email', optional($user)->email) }}" class="input" style="width:100%;padding:10px;border-radius:8px;border:1px solid #e6eef9">
    </div>

    <div style="margin-bottom:12px">
        <label for="password" style="display:block;margin-bottom:6px">รหัสผ่าน @if($user) <span style="color:#6b7280;font-size:13px">(เว้นว่างไว้หากไม่ต้องการเปลี่ยน)</span> @endif</label>
        <input id="password" type="password" name="password" class="input" style="width:100%;padding:10px;border-radius:8px;border:1px solid #e6eef9">
    </div>

    <div style="margin-bottom:12px">
        <label for="password_confirmation" style="display:block;margin-bottom:6px">ยืนยันรหัสผ่าน</label>
        <input id="password_confirmation" type="password" name="password_confirmation" class="input" style="width:100%;padding:10px;border-radius:8px;border:1px solid #e6eef9">
    </div>

    <div style="margin-bottom:12px">
        <label for="role" style="display:block;margin-bottom:6px">ตำแหน่ง</label>
        <select id="role" name="role" class="input" style="width:100%;padding:10px;border-radius:8px;border:1px solid #e6eef9;background:#fbfeff;color:#0f172a">
            <option value="">-- เลือกตำแหน่ง --</option>
            <option value="employee" {{ old('role', optional($user)->role) === 'employee' ? 'selected' : '' }}>พนักงาน</option>
            <option value="owner" {{ old('role', optional($user)->role) === 'owner' ? 'selected' : '' }}>เจ้าของร้าน</option>
        </select>
    </div>

    <div style="display:flex;gap:10px;align-items:center">
        <button type="submit" class="btn">บันทึก</button>
        <a href="{{ route('users.index') }}" style="color:#6b7280;text-decoration:none">ยกเลิก</a>
    </div>
</form>
