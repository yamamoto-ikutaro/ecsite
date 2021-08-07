<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Order;
use App\User;

class Purchase extends Model
{
    protected $fillable = ['user_id', 'name', 'address', 'email', 'postalCode', 'telephone'];
    
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    
    public function user(){
        return $this->belongsTo(User::class);
    }
}
