<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Telegram\Bot\Laravel\Facades\Telegram;

class OrderController extends Controller
{
    public function create(Request $request){


        $validate_rules = [
            'book_id' => 'required',
            'name' => 'required|min:3',
            'phone' => 'required|digits_between:5,12',
            'comment' => 'required',
        ];

        $validate_message = [
            'book_id.required' => 'Опс ..что то пошло не так ',
            'name.required' => 'Заполните заказ еще раз - вы не заполнили поле "имя" .',
            'phone.required' => "Заполните поле 'Телефон' ",
            'phone.digits_between' => 'Проверьте введенный номер телефона.',
            'comment.required' => "Напишите что то в комментарии"
        ];

        $validator = Validator::make($request->all(), $validate_rules, $validate_message);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)
                ->withInput();
        }


        $order = new Order;
        $order->sum = $request->sum;
        $order->name = $request->name;
        $order->phone = $request->phone;
        $order->kol = $request->kol;
        $order->comment = $request->comment;
        $order->book_id = $request->book_id;
        $order->save();
        $order->notify(new \App\Notifications\PostPublished());
        return redirect()->back()->with('message', 'Заказ оформлен, с вами свяжутся в ближайшее время по указанному номеру телефона.');


    }



}
