<?php

namespace App\Http\Controllers;

use App\Models\books;
use App\Models\BookStoreUser;
use Illuminate\Http\Request;

class BooksController extends Controller
{

    public static function  getBooks(){
        
        $allBooks = books::all();
        return response()->json(['allbooks'=>$allBooks],200);

     //  return $allBooks;
    }

    public static function  getBorrowBooks(){
        
        $BookStoreUser = BookStoreUser::all();
        return response()->json(['bookstoreuser'=>$BookStoreUser],200);

    }

    public function addBooks(Request $request){

        $bookid = 1;
        $bTitle ="lll" ;
        $bDescription = "lll";
        $bGenere = "lll";
        $bPrice = 100.23;

        $BookStoreUser = new BookStoreUser();

        $BookStoreUser->bid = $bookid; 
        $BookStoreUser->Title = $bTitle;
        $BookStoreUser->Description =  $bDescription;
        $BookStoreUser->Genre = $bGenere;
        $BookStoreUser->Price = $bPrice;
        $BookStoreUser->save();


    }
    

    public static function  borrowBooks($id){
        
        $book = books::find($id);
        if(!$book){
            return response()->json(['msg'=>"Books not found"],404);    
        }

        $book->delete();

        $bookid = $book-> id;
        $bTitle = $book-> Title ;
        $bDescription = $book-> Description;
        $bGenere = $book-> Genre;
        $bPrice = $book-> Price;

        $BookStoreUser = new BookStoreUser();
        
        $BookStoreUser->bid = $bookid; 
        $BookStoreUser->Title = $bTitle;
        $BookStoreUser->Description =  $bDescription;
        $BookStoreUser->Genre = $bGenere;
        $BookStoreUser->Price = $bPrice;
        $BookStoreUser->save();

        return response()->json(['msg'=>"Books borrowed"],201);

    }

    public static function  removeBooks($id){
        
        $BookStoreUser = BookStoreUser::where('bid',$id)->first();
        if(!$BookStoreUser){
            return response()->json(['msg'=>"Books not found"],404);    
        }

        $BookStoreUser->delete();

        $bookid =  $BookStoreUser->bid;
        $bTitle = $BookStoreUser->Title;
        $bDescription = $BookStoreUser->Description;
        $bGenere = $BookStoreUser->Genre;
        $bPrice = $BookStoreUser->Price;

        $book = new books();
        
        $book-> id = $bookid; 
        $book-> Title  = $bTitle;
        $book-> Description =  $bDescription;
        $book-> Genre  = $bGenere;
        $book-> Price = $bPrice;
        $book->save();

        return response()->json(['msg'=>"user given"],201);

    }

    public static function search(Request $request){

        $search = $request->get('q');
        return books::where('Description', 'like','%'.$search.'%')->get();

    }
}
