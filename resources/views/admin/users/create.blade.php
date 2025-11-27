@extends('layouts.app')

@section('content')
<div style="max-width:720px;margin:36px auto;padding:18px">
    <h2>สร้างผู้ใช้ใหม่</h2>
    @include('admin.users._form', ['action' => route('users.store'), 'method' => 'POST', 'user' => null])
</div>
@endsection
