<?php
namespace App\Helper;
use Carbon\Carbon;
use App\Book;

class Helper{



    /*Return true or false*/
    static function has_discount(Book $book){
        if(isset($book->discounts->days)){
            $create_date = $book->discounts->updated_at;
            $date_now = Carbon::now();
            $diff_val = $book->discounts->days;
            $start_date = $create_date->addDays($diff_val);
            $diff = $start_date->diffInDays($date_now);
            /* ~~~~~ */
            if(round($diff/24) > 0 ){
                return false;
            }else if ($book->discounts->procent > 0) return true;
        }
        return false;
    }


    /*
     * get procent and price
     * return value
     */
    static function getPrice($procent , $price){
        return  $price - ( $price / 100 * $procent);
    }



}