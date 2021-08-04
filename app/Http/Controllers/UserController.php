<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Namshi\JOSE\JWT;
use Tymon\JWTAuth\Contracts\Providers\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exception\JWTException;
use Illuminate\Contracts\Auth\Factory;

class UserController extends Controller
{
    public function register(Request $request){
$user=User::where('email',$request['email'])->first();
$user1=User::where('name',$request['name'])->first();
if ($user){
    $response['status']=0;
    $response['message']='Duplikat email';
    $response['code']=409;
}


        elseif($user1){

                $response['status']=0;
                $response['message']='Duplikat username';
                $response['code']=409;

        }
            else{


 $user = User::create([

   'name' =>$request->name,
         'email' =>$request->email,
         'password' =>bcrypt($request->password)
     ]

 );
$response['status']=1;
$response['message']='Svaka caaast';
$response['code']=200;


    }
        return $response;
    }



    public function  login(Request  $request){
        $credientals= $request->only('email','password');
        try {


            if (!JWTAuth::attempt($credientals)){
                $response['status']=0;
                $response['data']=null;
                $response['message']='Neuspjesno';
                $response['code']=401;
                return response()->json($response);
            }

}
       catch (Exception $e){

           $response['data']=null;
           $response['message']='Ne moze kreirati token';
           $response['code']=500;
           return response()->json($response);
       }
       $user = auth()->user();
$data['token'] = auth()->claims([
   'user_id' => $user->id,
    'email'=> $user->email
])->attempt($credientals);
        $response['status']=1;
        $response['data']=$data;
        $response['message']='Uspjesno ste se ulogovali';
        $response['code']=200;
        return response()->json($response);
    }

    public function user(){
        return Auth::user();
    }


}
