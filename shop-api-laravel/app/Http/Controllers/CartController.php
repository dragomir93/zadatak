<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Http\Resources\Cart as CartResource;
use App\Http\Resources\CartCollection;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function index(){
        
     return new CartCollection(
     Cart::where('id_cart','>=',1)
     ->join('articles', 'cart.article_id', '=', 'articles.title')
     ->get());
        
    }

    public function show($id){
        return new CartCollection(Cart::where('id_cart',$id)->join('articles', 'cart.article_id', '=', 'articles.title')->get());
    }

    public function store(Request $request) {

        $cart = Cart::create($request->all());

        $resource = new CartResource($cart);
        return $resource->response()->setStatusCode(200);
    }

    public function total(){
        $cart= new CartCollection(Cart::all());
        $cart = $cart->count();
        return response()->json(['total'=>$cart]);
    }

    public function delete($id) {

        $cart = Cart::where('id_cart',$id);

        $cart = $cart->delete();

        return response()->json();
    }

    public function update(Request $request,$id)
    {

        $cart = Cart::where('id_cart',$id);

        $cart->update([
            'quantity'  =>$request->quantity
        ]);
        
        return response()->json(['quantity'=>$request->quantity]);
    }

    public function dropAll(){
     $cart = Cart::where('id_cart','>=','0');

    $cart = $cart->delete();

    return response()->json();
   }
}
