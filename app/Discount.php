<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $table = "discounts";

    protected $fillable = ['procent', 'days', 'book_id'];

    
    public function books(){
        return $this->belongsTo('App\Book', 'book_id');
    }
    
}
