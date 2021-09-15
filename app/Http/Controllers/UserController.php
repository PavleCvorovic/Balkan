<?php

namespace App\Http\Controllers;

use App\Models\automotopolja;
use App\Models\razno;
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
         'password' =>bcrypt($request->password),
         'role'=>$request->role
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
        $response['user']=$user;
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
                $teh[$i]->slika = slika::where('slika_tehnika', $teh[$i]->id)->get();
            }
            array_push($svi, $teh);}
        if ($aut){
            for ($i = 0; $i < sizeof($aut); $i++) {
                $aut[$i]->slika = slika::where('slika_automoto', $aut[$i]->id)->get();
            }
            array_push($svi, $aut);}
        if ($hrana){
            for ($i = 0; $i < sizeof($hrana); $i++) {
                $hrana[$i]->slika = slika::where('slika_hrana', $hrana[$i]->id)->get();
            }
            array_push($svi, $hrana);}
        if ($nek){
            for ($i = 0; $i < sizeof($nek); $i++) {
                $nek[$i]->slika = slika::where('slika_nekretnine', $nek[$i]->id)->get();
            }
            array_push($svi, $nek);}
        if ($odj){
            for ($i = 0; $i < sizeof($odj); $i++) {
                $odj[$i]->slika = slika::where('slika_odjeca', $odj[$i]->id)->get();
            }
            array_push($svi, $odj);}
        if ($pos){
            for ($i = 0; $i < sizeof($pos); $i++) {
                $pos[$i]->slika = slika::where('slika_posao', $pos[$i]->id)->get();
            }
            array_push($svi, $pos);}
        if ($raz) {
            for ($i = 0; $i < sizeof($raz); $i++) {
                $raz[$i]->slika = slika::where('slika_razno', $raz[$i]->id)->get();
            }
            array_push($svi, $raz);
        }
return $svi;
    }

    public function DelAsUser(Request $request)
    {
        $tabela = $request->tabela;
        $tabela_slika = substr_replace($tabela, "", -5);
       $tabela_slika= 'slika_'.$tabela_slika;
        $sql1 = <<<SQL
                          delete  from slika
                          where $tabela_slika = $request->id
SQL;
        \DB::select(\DB::raw($sql1));

        $sql = <<<SQL
                          delete  from $tabela
                          where id = $request->id
SQL;
        \DB::select(\DB::raw($sql));
  return $this->getPostbyUser($request->user_id);



}
public function ModAsUser(Request $request){
        if($request->tabela == "automotopolja"){
            $a = new automotoController();
        return   $a->modPostbyId($request);
        }
    if($request->tabela == "hranapolja"){
        $a = new hranaController();
        return   $a->modPostbyId($request);
    }
    if($request->tabela == "nekretninepolja"){
        $a = new nekretnineController();
        return   $a->modPostbyId($request);
    }
    if($request->tabela == "odjecapolja"){
        $a = new odjecaController();
        return   $a->modPostbyId($request);
    }
    if($request->tabela == "posaopolja"){
        $a = new posaoController();
        return   $a->modPostbyId($request);
    }
    if($request->tabela == "raznopolja"){
        $a = new raznoController();
        return   $a->modPostbyId($request);
    }
    if($request->tabela == "tehnikapolja"){
        $a = new tehnikaController();
        return   $a->modPostbyId($request);
    }
}
    public function GetPosts(Request $request){

        switch($request->tabela) {
            case('automotopolja'):
                $a = new automotoController();
                return   $a->getType($request->tip);
            case('hranapolja'):
                $a = new hranaController();
                return   $a->getType($request->tip);
            case('nekretninepolja'):
                $a = new nekretnineController();
                return   $a->getType($request->tip);
            case('odjecapolja'):
                $a = new odjecaController();
                return   $a->getType($request->tip);
            case('posaopolja'):
                $a = new posaoController();
                return   $a->getType($request->tip);
            case('raznopolja'):
                $a = new raznoController();
                return   $a->getType($request->tip);
            case('tehnikapolja'):
                $a = new tehnikaController();
                return   $a->getType($request->tip);

        }}




public function getAllApproved(){


    $svi = array();

    $teh = DB::select('select * from tehnikapolja  where placen=true and javno="1"' );
    $aut = DB::select('select * from automotopolja  where placen=true and javno="1"' );
    $hrana = DB::select('select * from hranapolja  where placen=true and javno="1"' );
    $nek = DB::select('select * from nekretninepolja where placen=true and javno="1" ' );
    $odj = DB::select('select * from odjecapolja where placen=true and javno="1" ' );
    $pos = DB::select('select * from posaopolja where placen=true and javno="1" ' );
    $raz = DB::select('select * from raznopolja where placen=true and javno="1" ' );
    if ($teh){
        for ($i = 0; $i < sizeof($teh); $i++) {
            $teh[$i]->slika = slika::where('slika_tehnika', $teh[$i]->id)->get();
        }
        array_push($svi, $teh);}
    if ($aut){
        for ($i = 0; $i < sizeof($aut); $i++) {
            $aut[$i]->slika = slika::where('slika_automoto', $aut[$i]->id)->get();
        }
        array_push($svi, $aut);}
    if ($hrana){
        for ($i = 0; $i < sizeof($hrana); $i++) {
            $hrana[$i]->slika = slika::where('slika_hrana', $hrana[$i]->id)->get();
        }
        array_push($svi, $hrana);}
    if ($nek){
        for ($i = 0; $i < sizeof($nek); $i++) {
            $nek[$i]->slika = slika::where('slika_nekretnine', $nek[$i]->id)->get();
        }
        array_push($svi, $nek);}
    if ($odj){
        for ($i = 0; $i < sizeof($odj); $i++) {
            $odj[$i]->slika = slika::where('slika_odjeca', $odj[$i]->id)->get();
        }
        array_push($svi, $odj);}
    if ($pos){
        for ($i = 0; $i < sizeof($pos); $i++) {
            $pos[$i]->slika = slika::where('slika_posao', $pos[$i]->id)->get();
        }
        array_push($svi, $pos);}
    if ($raz) {
        for ($i = 0; $i < sizeof($raz); $i++) {
            $raz[$i]->slika = slika::where('slika_razno', $raz[$i]->id)->get();
        }
        array_push($svi, $raz);
    }
   shuffle($svi);
    return $svi;
}

    public function getAllNew(){


        $svi = array();

        $teh = DB::select('select * from tehnikapolja  where  javno=0' );
        $aut = DB::select('select * from automotopolja  where  javno=0' );
        $hrana = DB::select('select * from hranapolja  where  javno=0' );
        $nek = DB::select('select * from nekretninepolja where  javno=0 ' );
        $odj = DB::select('select * from odjecapolja where  javno=0 ' );
        $pos = DB::select('select * from posaopolja where  javno=0 ' );
        $raz = DB::select('select * from raznopolja where  javno=0 ' );
        if ($teh){
            for ($i = 0; $i < sizeof($teh); $i++) {
                $teh[$i]->slika = slika::where('slika_tehnika', $teh[$i]->id)->get();
            }
            array_push($svi, $teh);}
        if ($aut){
            for ($i = 0; $i < sizeof($aut); $i++) {
                $aut[$i]->slika = slika::where('slika_automoto', $aut[$i]->id)->get();
            }
            array_push($svi, $aut);}
        if ($hrana){
            for ($i = 0; $i < sizeof($hrana); $i++) {
                $hrana[$i]->slika = slika::where('slika_hrana', $hrana[$i]->id)->get();
            }
            array_push($svi, $hrana);}
        if ($nek){
            for ($i = 0; $i < sizeof($nek); $i++) {
                $nek[$i]->slika = slika::where('slika_nekretnine', $nek[$i]->id)->get();
            }
            array_push($svi, $nek);}
        if ($odj){
            for ($i = 0; $i < sizeof($odj); $i++) {
                $odj[$i]->slika = slika::where('slika_odjeca', $odj[$i]->id)->get();
            }
            array_push($svi, $odj);}
        if ($pos){
            for ($i = 0; $i < sizeof($pos); $i++) {
                $pos[$i]->slika = slika::where('slika_posao', $pos[$i]->id)->get();
            }
            array_push($svi, $pos);}
        if ($raz) {
            for ($i = 0; $i < sizeof($raz); $i++) {
                $raz[$i]->slika = slika::where('slika_razno', $raz[$i]->id)->get();
            }
            array_push($svi, $raz);
        }
        shuffle($svi);
        return $svi;
    }






    public function AddAsUser(Request $request){
        if($request->tabela == "automotopolja"){
            $a = new automotoController();
            return   $a->addPost($request);
        }
        if($request->tabela == "hranapolja"){
            $a = new hranaController();
            return   $a->addPost($request);
        }
        if($request->tabela == "nekretninepolja"){
            $a = new nekretnineController();
            return   $a->addPost($request);
        }
        if($request->tabela == "odjecapolja"){
            $a = new odjecaController();
            return   $a->addPost($request);
        }
        if($request->tabela == "posaopolja"){
            $a = new posaoController();
            return   $a->addPost($request);
        }
        if($request->tabela == "raznopolja"){
            $a = new raznoController();
            return   $a->addPost($request);
        }
        if($request->tabela == "tehnikapolja"){
            $a = new tehnikaController();
            return   $a->addPost($request);
        }
    }
    public function Filter(Request $request){
        if($request->tabela == "automotopolja"){
            $a = new automotoController();
            return   $a->Filter($request);
        }
        if($request->tabela == "hranapolja"){
            $a = new hranaController();
            return   $a->Filter($request);
        }
        if($request->tabela == "nekretninepolja"){
            $a = new nekretnineController();
            return   $a->Filter($request);
        }
        if($request->tabela == "odjecapolja"){
            $a = new odjecaController();
            return   $a->Filter($request);
        }
        if($request->tabela == "posaopolja"){
            $a = new posaoController();
            return   $a->Filter($request);
        }
        if($request->tabela == "raznopolja"){
            $a = new raznoController();
            return   $a->Filter($request);
        }
        if($request->tabela == "tehnikapolja"){
            $a = new tehnikaController();
            return   $a->Filter($request);
        }
    }
    public function GetId(Request $request){
        if($request->tabela == "automotopolja"){
            $a = new automotoController();
            $b= $request->id;
            return   $a->getId($b);
        }
        if($request->tabela == "hranapolja"){
            $a = new hranaController();
            $b= $request->id;
            return   $a->getId($b);
        }
        if($request->tabela == "nekretninepolja"){
            $a = new nekretnineController();
            $b= $request->id;
            return   $a->getId($b);
        }
        if($request->tabela == "odjecapolja"){
            $a = new odjecaController();
            $b= $request->id;
            return   $a->getId($b);
        }
        if($request->tabela == "posaopolja"){
            $a = new posaoController();
            $b= $request->id;
            return   $a->getId($b);
        }
        if($request->tabela == "raznopolja"){
            $a = new raznoController();
            $b= $request->id;
            return   $a->getId($b);
        }
        if($request->tabela == "tehnikapolja"){
            $a = new tehnikaController();
            $b= $request->id;
            return   $a->getId($b);
        }
    }

    public function deleteAdmin()
    {
        if(Auth::user()->hasRole('admin'))
        {
           return razno::all();
        }else
        {
            return 23;
        }
    }


    public function show()
    {
        return User::all();
    }
    public function showId($id)
    {
        return User::find($id);
    }

    public function delete($id)
    {

        DB::select('DELETE FROM users WHERE id='.$id);
        return User::all();
    }

}
