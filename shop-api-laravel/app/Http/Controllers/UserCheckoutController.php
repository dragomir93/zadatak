<?php

namespace App\Http\Controllers;

use App\UsersCheckout;
use App\Http\Resources\UsersCheckout as UsersCheckoutResource;
use App\Http\Resources\UsersCheckoutCollection;
use Illuminate\Http\Request;

class UserCheckoutController extends Controller
{

    public function getUserCheckout(){
        return new UsersCheckoutCollection(UsersCheckout::all());
    }

    public function getUserCheckoutById($id){
        return new UsersCheckoutResource(UsersCheckout::findOrFail($id));
    }

    public function store(Request $request) {

        $users = UsersCheckout::create($request->all());

        $resource = new UsersCheckoutResource($users);
        return $resource->response()->setStatusCode(200);
    }
    
}
