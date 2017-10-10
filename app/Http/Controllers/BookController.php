<?php

namespace App\Http\Controllers;

use App\Book;
use App\Book_category;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;


class BookController extends Controller
{

    public function index(){
        $books =  Book::where('public', 1)->paginate(6);
        return view('index', compact('books'));
    }

    public function show($slug){
        $book =  Book::where('slug', $slug)->first();
        return view('show', compact('book'));
    }

    public function show_cat($category){
        $category_id = Book_category::where('slug', $category)->first();
        $books =  Book::where('category_id' , $category_id->id)->paginate(6);
        return view('index', compact('books'));
    }
    
    

}
