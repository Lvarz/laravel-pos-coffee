@extends('layouts.app')

@section('content')
<div style="max-width:720px;margin:36px auto;padding:18px">
    <h2>แก้ไขผู้ใช้</h2>
    @include('admin.users._form', ['action' => route('users.update', $user), 'method' => 'PUT', 'user' => $user])
</div>
@endsection
