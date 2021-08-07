@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h1>会員情報</h1>
    </div>
    <div>
        @include('users.userInfo_edit_btn')
    </div>
    <div>
        @include('users.user_delete_btn')
    </div>
@endsection