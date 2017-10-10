<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book_category extends Model
{
    protected  $table ='book_categories';
    protected $fillable = ['desc', 'name'];
    public $timestamps = false;

    public function books(){
        return $this->hasOne('App\Books', 'category_id');
    }
    

}
