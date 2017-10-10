<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
class Order extends Model
{
    use Notifiable;
    protected $table = "order";

    protected $fillable = ['sum', 'name', 'phone', 'kol', 'comment', 'book_id'];



}
