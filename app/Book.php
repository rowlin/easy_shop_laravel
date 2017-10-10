<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = "books";

    protected $fillable = ['name' ,'author' ,'description' ,'slug' ,'ratio' ,'public', 'koll' ];

    public function categories(){
        return $this->belongsTo('App\Book_category');
    }

    
    public function setImagesAttribute($value)
    {
        $this->attributes['images'] =   json_encode($value);
    }

    public function getImagesAttribute(){
        $value = $this->attributes['images'];
        return json_decode($value);
    }


    public function discounts(){
        return $this->hasOne('App\Discount', 'book_id');
    }


}