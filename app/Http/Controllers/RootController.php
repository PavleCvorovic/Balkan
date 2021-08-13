<?php


namespace App\Http\Controllers;


use App\Models\automoto;
use App\Models\HranaiPice1;
use App\Models\nekretnine;
use App\Models\odjeca;
use App\Models\posao;
use App\Models\razno;
use App\Models\tehnika;
use Illuminate\Support\Facades\DB;

class RootController extends \Illuminate\Routing\Controller
{
public function addAutomoto($tip){
 $novi =new automoto();
 $novi->tip=$tip;
$novi->save();
return automoto::all();
}
    public function delAutomoto($id){
     DB::select('delete from automoto where id='.$id);
        return automoto::all();
    }

    public function getAutomoto(){
        return automoto::all();
    }

    public function addHrana($tip){
        $novi =new HranaiPice1();
        $novi->tip=$tip;
        $novi->save();
        return HranaiPice1::all();
    }
    public function delHrana($id){
        DB::select('delete from hrana_ipice where id='.$id);
        return HranaiPice1::all();
    }

    public function getHrana(){
        return HranaiPice1::all();
    }


    public function addNekretnine($tip){
        $novi =new nekretnine();
        $novi->tip=$tip;
        $novi->save();
        return nekretnine::all();
    }
    public function delNekretnine($id){
        DB::select('delete from nekretnine where id='.$id);
        return nekretnine::all();
    }

    public function getNekretnine(){
        return nekretnine::all();
    }

    public function addOdjeca($tip){
        $novi =new odjeca();
        $novi->tip=$tip;
        $novi->save();
        return odjeca::all();
    }
    public function delOdjeca($id){
        DB::select('delete from odjeca where id='.$id);
        return odjeca::all();
    }

    public function getOdjeca(){
        return odjeca::all();
    }
    public function addPosao($tip){
        $novi =new posao();
        $novi->tip=$tip;
        $novi->save();
        return posao::all();
    }
    public function delPosao($id){
        DB::select('delete from posao where id='.$id);
        return posao::all();
    }

    public function getPosao(){
        return posao::all();
    }

    public function addRazno($tip){
        $novi =new razno();
        $novi->tip=$tip;
        $novi->save();
        return razno::all();
    }
    public function delRazno($id){
        DB::select('delete from razno where id='.$id);
        return razno::all();
    }

    public function getRazno(){
        return razno::all();
    }

    public function addTehnika($tip){
        $novi =new tehnika();
        $novi->tip=$tip;
        $novi->save();
        return tehnika::all();
    }
    public function delTehnika($id){
        DB::select('delete from tehnika where id='.$id);
        return tehnika::all();
    }

    public function getTehnika(){
        return tehnika::all();
    }

















}
