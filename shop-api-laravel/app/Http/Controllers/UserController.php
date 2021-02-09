<?php

namespace App\Http\Controllers;

use App\Users;
use App\Http\Resources\Users as UsersResource;
use App\Http\Resources\UsersCollection;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function store(Request $request) {

        $users = Users::create($request->all());

        $resource = new UsersResource($users);
        return $resource->response()->setStatusCode(200);
    }
    
}
