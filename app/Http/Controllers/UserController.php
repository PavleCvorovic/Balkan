<?php

namespace App\Http\Controllers;

use App\Models\slika;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Namshi\JOSE\JWT;
use phpDocumentor\Reflection\Types\String_;
use Tymon\JWTAuth\Contracts\Providers\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exception\JWTException;
use Illuminate\Contracts\Auth\Factory;
use function Symfony\Component\String\s;

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

    public function getPostbyUser($id)
    {

        $svi=[];

        $teh = DB::select('select * from tehnikapolja where user_id=' . $id);
        $aut = DB::select('select * from automotopolja where user_id=' . $id);
        $hrana = DB::select('select * from hranapolja where user_id=' . $id);
        $nek = DB::select('select * from nekretninepolja where user_id=' . $id);
        $odj = DB::select('select * from odjecapolja where user_id=' . $id);
        $pos = DB::select('select * from posaopolja where user_id=' . $id);
        $raz = DB::select('select * from raznopolja where user_id=' . $id);
        if ($teh){
            for ($i = 0; $i < sizeof($teh); $i++) {
                $teh[$i]->slika = slika::where('slika_tehnika', $teh[$i]->id)->first();
            }
            array_push($svi, $teh);}
        if ($aut){
            for ($i = 0; $i < sizeof($aut); $i++) {
                $aut[$i]->slika = slika::where('slika_automoto', $aut[$i]->id)->first();
            }
            array_push($svi, $aut);}
        if ($hrana){
            for ($i = 0; $i < sizeof($hrana); $i++) {
                $hrana[$i]->slika = slika::where('slika_hrana', $hrana[$i]->id)->first();
            }
            array_push($svi, $hrana);}
        if ($nek){
            for ($i = 0; $i < sizeof($nek); $i++) {
                $nek[$i]->slika = slika::where('slika_nekretnine', $nek[$i]->id)->first();
            }
            array_push($svi, $nek);}
        if ($odj){
            for ($i = 0; $i < sizeof($odj); $i++) {
                $odj[$i]->slika = slika::where('slika_odjeca', $odj[$i]->id)->first();
            }
            array_push($svi, $odj);}
        if ($pos){
            for ($i = 0; $i < sizeof($pos); $i++) {
                $pos[$i]->slika = slika::where('slika_posao', $pos[$i]->id)->first();
            }
            array_push($svi, $pos);}
        if ($raz) {
            for ($i = 0; $i < sizeof($raz); $i++) {
                $raz[$i]->slika = slika::where('slika_razno', $raz[$i]->id)->first();
            }
            array_push($svi, $raz);
        }

    }

    public function DelAsUser($tabela){

        $sql = <<<SQL
                          select * from $tabela

SQL;
        $g = \DB::select(\DB::raw($sql));
        return $g;



}}
