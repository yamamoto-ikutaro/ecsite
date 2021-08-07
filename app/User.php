<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Item;
use App\Purchase;
use App\Cart;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'address', 'email', 'password', 'postalCode', 'telephone',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function cart()
    {
        return $this->belongsToMany(Item::class, 'carts', 'user_id', 'item_id')->withPivot('quantity', 'price')->withTimestamps();
    }
    
    
    public function add_cart($itemId, $itemPrice)
    {
        $this->cart()->attach($itemId, ['quantity' => 1, 'price' => $itemPrice]);
    }
    
    public function del_item($itemIds)
    {
        $this->cart()->detach($itemIds);
        
        return $this->cart;
    }
    
    public function purchase(){
        return $this->hasMany(Purchase::class);
    }
    
}
