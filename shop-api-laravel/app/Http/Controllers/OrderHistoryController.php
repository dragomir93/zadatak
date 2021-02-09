<?php

namespace App\Http\Controllers;

use App\OrderHistory;
use App\Http\Resources\OrderHistory as OrderHistoryResource;
use App\Http\Resources\OrderHistoryCollection;
use Illuminate\Http\Request;

class OrderHistoryController extends Controller
{

    public function index(){
        
        return new OrderHistoryCollection(
        OrderHistory::where('article_id','>=',1)
        ->join('articles', 'order_history.article_id', '=', 'articles.id')
        ->join('users_checkout', 'order_history.email', '=', 'users_checkout.email')
        ->get());
           
       }

    public function store(Request $request) {

        $order_hist = OrderHistory::create([
            'email' => $request->email,
            'article_id' => $request->article_id,
        ]);

        $resource = new OrderHistoryResource($order_hist);
        return $resource->response()->setStatusCode(200);
    }

}
