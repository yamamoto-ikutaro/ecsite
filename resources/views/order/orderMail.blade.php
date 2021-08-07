{{ Auth::user()->name.'様' }}
<p>ご注文ありがとうございます。<br>以下が注文情報になります。</p>
<p>---------------------注文情報---------------------</p>
<p>※ご注文商品(数量)<p>
@foreach($orders as $order)
    <p>{{ $order->item_title }}{{ '（'.$order->quantity.'個）' }}</p>
@endforeach
<p>※合計金額</p>
<p>{{ $orders->sum('totalPrice').'円'.' + 送料（500円）' }}</p>
<p>※お届け先</p>
<p>氏名：{{ $purchase->name.'様' }}</p>
<p>住所：{{ $purchase->address }}</p>
<p>Email：{{ $purchase->email }}</p>
<p>郵便番号：{{ $purchase->postalCode }}</p>
<p>電話番号：{{ $purchase->telephone }}</p>
<p>※ご注文日時：{{ $purchase->created_at->format('Y/m/d H:i') }}</p>
<p>--------------------------------------------------</p>
<p>またのご利用お待ちしております。</p>