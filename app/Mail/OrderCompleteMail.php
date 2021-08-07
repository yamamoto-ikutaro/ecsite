<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderCompleteMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
     
    protected $orders;
    protected $purchase;
     
    public function __construct($orders, $purchase)
    {
        $this->orders = $orders;
        $this->purchase = $purchase;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
        ->from('i.yamamoto.sxbx37@gmail.com', 'ECSITE')
        ->subject('ご注文情報')
        ->view('order/orderMail')
        ->with(['orders' => $this->orders, 'purchase' => $this->purchase]);
        // ▼参考用：mailableでメールにファイルを添付する方法
        // https://readouble.com/laravel/6.x/ja/mail.html
    }
}
