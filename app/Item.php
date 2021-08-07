<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
            'category_id', 'item_title', 'content', 'item_quantity', 'image_url', 'price',
    ];
    
    public function users()
    {
        return $this->belongsToMany(User::class, 'carts', 'item_id', 'user_id')->withTimestamps();
    }
    
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
}
