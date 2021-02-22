<?php

namespace App\Http\Controllers;

use Session;

use App\User;
use App\Http\Resources\Users as UsersResource;
use App\Http\Resources\UsersCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersController extends Controller
{
    public function index(){
        return new UsersCollection(User::all());
    }

    public function show($id){
        return new UsersResource(User::findOrFail($id));
    }

    public function store(Request $request) {

        $users = User::create($request->all());

        $resource = new UsersResource($users);
        return $resource->response()->setStatusCode(200);
    }
    
    public function total(){
        $users= new UsersCollection(User::all());
        $users = $users->count();
        return response()->json(['total'=>$users]);
    }

    public function update(Request $request,$id)
    {

        $users = User::where('id',$id)->first();

        $users->update([
            'user_name'        => $request->user_name,
            'name'             => $request->name,
            'surname'          => $request->surname,
            'email'            => $request->email,
            'password'         => $request->password,
            'confirm_password' => $request->confirm_password,
            'active'           => $request->active,
        ]);

        return response()->json(new UsersResource($users), 200);
    }

    public function delete($id) {

        $users = User::where('id',$id);

        $users = $users->delete();

        return response()->json();

    }

    public function registration(Request $request) {
        $password = Hash::make($request->password);

        $users = User::create([
            'user_name'        => $request->user_name,
            'name'             => $request->name,
            'surname'          => $request->surname,
            'email'            => $request->email,
            'password'         => $password,
            'confirm_password' => $password,
            'active'           => $request->active,
            'api_token'        => User::createToken(),
        ]);

        $resource = new UsersResource($users);
        return $resource->response()->setStatusCode(200);
    }

    public function checkEmail($email){
        return response()->json(User::mailExists($email), 200);
    }

    public function login(Request $request){
        $user = User::where('user_name',$request->user_name)->first();
        
        $password = Hash::check($request->password,$user->password);

        if($user->user_name == $request->user_name && $password == true){
            return response()->json(new UsersResource($user ), 200);
            Session::set('user',new UsersResource($user ));
        }else{
            return response()->json(['error' => 'User did not log in!'], 400);
        }
    }

    public function loginWithToken(Request $request){
        if (! $request->token) {
            return response()->json(['error' => 'Missing Token!'], 400);
        }
            
        $user = User::where('api_token', $request->token)->first();
        
        if ($user) {
            $user->refreshToken();
        }
        
        return response()->json($user ?  new UsersResource($user) : false, 200);
    }

    public function logout(Request $request){
        $user = User::where('user_name',$request->user_name)->first();
        $user->refreshToken();
        $s = Session::get('user');
        return response()->json($user ?  new UsersResource($user) : false, 200);
    }

}
