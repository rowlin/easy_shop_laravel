<?php

namespace App\Http\Controllers;

use App\Book;
use App\Discount;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all = Book::all();
        return view('admin.home', compact('all'));
    }


    public function add_discount(Request $request)
    {
        foreach ($request->data as $data) {
            if ($data['value'] > 0 || $data['day'] > 0) {
              $cur_dis =  Discount::where('book_id',$data['key'])->first();
                if ($cur_dis != null) {
                    $cur_dis->update(['procent' =>$data['value'],'days' => $data['day'] ]);
                } else {
                   $discount = new Discount;
                    $discount->book_id = $data['key'];
                    $discount->procent = $data['value'];
                    $discount->days = $data['day'];
                    $discount->save();
                }
            } else {
                return response()->json(['message', 'Ooops value cant be < 0']);
            }
        }
        return redirect()->back();
    }


}
