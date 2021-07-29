<?php


namespace App\Http\Controllers;


use App\Models\automoto;
use App\Models\automotopolja;
use App\Models\slika;
use App\Models\tehnikapolja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class automotoController extends \Illuminate\Routing\Controller
{

    public function getAllTypes(){
        return automoto::all();
    }
public  function  getType($tip){

     $svi= DB::select('select * from automotopolja where automoto_vrsta='.$tip);

    for($i=0; $i<sizeof($svi);$i++){
        $svi[$i]->slika = slika::where('slika_automoto', $svi[$i]->id)->first();

    }
return $svi;

}


    public function getAll() {
        $svi= automotopolja::all();
        for($i=0; $i<sizeof($svi);$i++){
            $svi[$i]->slika = slika::where('slika_automoto', $svi[$i]->id)->first();

        }

    }

    public  function getId($id){
        $rezultat1= automotopolja::find($id);
        $rezultat=  DB::select('select url from slika where slika_automoto='.$id);
        $rezultat1->podaci=$rezultat;
        return $rezultat1;
    }
    public function delAll(){
        DB::select('delete from slika where slika_automoto>=1 ');
        DB::select('delete  from automotopolja');
        return automotopolja::all();
    }
    public function delId($id){
        DB::select('delete  from slika where slika_automoto='.$id);
        DB::select('delete  from automotopolja where id='.$id);
        return automotopolja::all();
    }
    public function addPost(Request $request)
    {
        $produkt = new automotopolja();
        $produkt->automoto_vrsta = $request->automoto_vrsta;
        $produkt->naziv = $request->naziv;
        $produkt->marka = $request->marka;
        $produkt->model = $request->model;
        $produkt->godina_proizvodnje = $request->godina_proizvodnje;
        $produkt->kubikaza = $request->kubikaza;
        $produkt->kilometraza = $request->kilometraza;
        $produkt->boja = $request->boja;
        $produkt->registrovan = $request->registrovan;
        $produkt->datum_isteka = $request->datum_isteka;
        $produkt->opis = $request->opis;
        $produkt->stanje = $request->stanje;
        $produkt->lokacija = $request->lokacija;
        $produkt->kontakt = $request->kontakt;
        $produkt->cijena = $request->cijena;
        $produkt->sirina = $request->sirina;
        $produkt->duzina = $request->duzina;
        $produkt->user = $request->user;

        $produkt->save();
        $zadnji = $produkt->id;


        if($request->hasFile('prva_slika')){
            $name = $request->file('prva_slika')->getClientOriginalName();
            $path = $request->file('prva_slika')->storeAs('public/file',$name);
            $slika=new slika();
            $slika->slika_razno=$zadnji;
            $slika->url=$name;
            $slika->save();
        }
        else{ echo 'nema';}

        if ($request->hasfile('slike')) {
            foreach ($request->file('slike') as $key => $file) {
                $path = $file->store('public/file');
                $name = $file->getClientOriginalName();
                $slika=new slika();
                $slika->slika_automoto=$zadnji;
                $slika->url=$name;
                $slika->save();

            }
        }

    return automotopolja::all();


    }
    public function modPostbyId(Request $request){
        $post= automotopolja::find($request->id);
        $post->automoto_vrsta = $request->automoto_vrsta;
        $post->naziv = $request->naziv;
        $post->marka = $request->marka;
        $post->model = $request->model;
        $post->godina_proizvodnje = $request->godina_proizvodnje;
        $post->kubikaza = $request->kubikaza;
        $post->kilometraza = $request->kilometraza;
        $post->boja = $request->boja;
        $post->registrovan = $request->registrovan;
        $post->datum_isteka = $request->datum_isteka;
        $post->opis = $request->opis;
        $post->stanje = $request->stanje;
        $post->lokacija = $request->lokacija;
        $post->kontakt = $request->kontakt;
        $post->cijena = $request->cijena;
        $post->sirina = $request->sirina;
        $post->duzina = $request->duzina;
        $post->user = $request->user;

        $post->save();



        return automotopolja::all();
    }


    public function Filter(Request $request){

        $cijena= $request->cijena;
        $marka=$request->marka;
        $model=$request->model;
        $godiste=$request->godiste;
        $kubikaza=$request->kubikaza;

        $sve= automotopolja::select('automotopolja.*');




        if ($cijena)

            $sve= $sve->where('cijena',$cijena);

        if ($marka)

            $sve= $sve->where('marka',$marka);

        if ($model)

            $sve= $sve->where('model',$model);

        if ($godiste)

            $sve= $sve->where('godiste',$godiste);

        if ($kubikaza)

            $sve= $sve->where('kubikaza',$godiste);



        $sve = $sve->get();

        for($i=0; $i<sizeof($sve);$i++){
            $sve[$i]->slika = slika::where('slika_automoto', $sve[$i]->id)->first();

        }

        return  $sve;
    }



}
