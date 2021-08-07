@extends('layouts.app')

@section('content')
@if (Auth::check())
    <div class="text-center mt-4" style=height:150px>
        <h1>登録情報</h1>
    </div>
    <div>
        <table class="table table-striped">
            <tr>
              <th>氏名：</th>
              <td>{{ $user->name }}</td>
            </tr>
            <tr>
              <th>郵便番号：</th>
              <td>{{ $user->postalCode }}</td>
            </tr>
            <tr>
              <th>住所：</th>
              <td>{{ $user->address }}</td>
            </tr>
            <tr>
              <th>Email：</th>
              <td>{{ $user->email }}</td>
            </tr>
            <tr>
              <th>電話番号：</th>
              <td>{{ $user->telephone }}</td>
            </tr>
            <tr>
              <th>パスワード：</th>
              <td>********</td>
            </tr>
        </table>
    </div>
    {!! link_to_route('items.index', '商品一覧へ', [], ['class'=>'btn btn-primary']) !!}
@endif
@endsection