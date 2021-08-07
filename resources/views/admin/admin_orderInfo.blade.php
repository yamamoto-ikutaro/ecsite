@extends('layouts.app')

@section('content')
    <h1 class="text-center mt-4">注文情報</h1>
    <div>
        <table class="table">
            <tr>
                <th>注文者</th>
                <th>注文商品(数量)</th>
                <th>合計金額</th>
                <th>お届け先</th>
                <th>注文日時</th>
            </tr>
            @foreach($purchases as $purchase)
            <tr>
                <td>{{ $purchase->user->name }}</td>
                <td>
                    <ul class="list-unstyled">
                        @foreach($purchase->orders as $order)
                            <li>{{ $order->item_title }}{{ '（'.$order->quantity.'個）' }}</li>
                        @endforeach
                    </ul>
                </td>
                <td>
                    <ul class="list-unstyled border-bottom border-secondary mb-0">
                        @foreach($purchase->orders as $order)
                            <li class="text-right">{{ $order->totalPrice.'円' }}</li>
                        @endforeach
                    </ul>
                    <div>
                        <p class="text-right">{{ '合計：'.$purchase->orders->sum('totalPrice').'円' }}</p>
                    </div>
                </td>
                <td>
                    <ul class="list-unstyled">
                        <li>氏名：{{ $purchase->name }}</li>
                        <li>住所：{{ $purchase->address }}</li>
                        <li>Email：{{ $purchase->email }}</li>
                        <li>郵便番号：{{ $purchase->postalCode }}</li>
                        <li>電話番号：{{ $purchase->telephone }}</li>
                    </ul>
                </td>
                <td>{{ $purchase->created_at->format('Y/m/d H:i') }}</td>
            </tr>
            @endforeach
        </table>
    </div>
@endsection