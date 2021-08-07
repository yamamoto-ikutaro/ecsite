<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Item;
use App\Purchase;

class Order extends Model
{
    protected $fillable = ['item_title', 'quantity', 'totalPrice'];
    
    public function purchase(){
        return $this->belongsTo(Purchase::class);
    }
}
