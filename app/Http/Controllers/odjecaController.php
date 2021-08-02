<?php


namespace App\Http\Controllers;


use App\Models\odjeca;
use App\Models\odjecapolja;
use App\Models\slika;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class odjecaController extends \Illuminate\Routing\Controller
{

    public function getAllTypes(){
        return odjeca::all();
    }
    public  function  getType($tip){

        $svi= DB::select('select * from odjecapolja where odjeca_vrsta='.$tip);

        for($i=0; $i<sizeof($svi);$i++){
            $svi[$i]->slika = slika::where('slika_odjeca', $svi[$i]->id)->first();

        }
        return $svi;

    }



    public function getAll() {
        $svi = odjecapolja::all();
        for ($i = 0; $i < sizeof($svi); $i++) {
            $svi[$i]->slika = slika::where('slika_odjeca', $svi[$i]->id)->first();
        }
        return $svi;
    }

    public  function getId($id){
        return odjecapolja::find($id);
        $rezultat=  DB::select('select url from slika where slika_odjeca='.$id);
        $rezultat1->podaci=$rezultat;
        return $rezultat1;
    }
    public function delAll(){
        DB::select('delete from slika where slika_odjeca>=1 ');
        DB::select('delete  from odjecapolja');
        return odjecapolja::all();
    }
    public function delId($id){
        DB::select('delete  from slika where slika_odjeca='.$id);
        DB::select('delete  from odjecapolja where id='.$id);
        return odjecapolja::all();
    }
    public function addPost(Request $request)
    {
        $produkt = new odjecapolja();
        $produkt->odjeca_vrsta = $request->odjeca_vrsta;
        $produkt->naziv = $request->naziv;
        $produkt->dimenzije = $request->dimenzije;
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
                $slika->slika_odjeca=$zadnji;
                $slika->url=$name;
                $slika->save();

            }
        }


return odjecapolja::all();

    }
    public function modPostbyId(Request $request){
        $post= odjecapolja::find($request->id);
        $post->odjeca_vrsta = $request->odjeca_vrsta;
        $post->naziv = $request->naziv;
        $post->dimenzije = $request->dimenzije;
        $post->opis = $request->opis;
        $post->stanje = $request->stanje;
        $post->lokacija = $request->lokacija;
        $post->kontakt = $request->kontakt;
        $post->cijena = $request->cijena;
        $post->sirina = $request->sirina;
        $post->duzina = $request->duzina;
        $post->user = $request->user;

        $post->save();
        return odjecapolja::all();
    }

    public function Filter(Request $request){


        $id=$request->id;
        $cijena_min= $request->cijenaMin;
        $cijena_max= $request->cijenaMax;
        $stanje= $request->stanje;



        $sve= odjecapolja::select('odjecapolja.*');

        if ($id)
            $sve= $sve->where('odjeca_vrsta',$id);

        if ($cijena_min)
            $sve = $sve->where('cijena','>=',$cijena_min);

        if ($cijena_max)
            $sve = $sve->where('cijena','<',$cijena_max);

        if ($stanje)

            $sve= $sve->where('stanje',$stanje);


        $sve = $sve->get();
        for($i=0; $i<sizeof($sve);$i++){

            $sve[$i]->slika = slika::where('odjeca_razno', $sve[$i]->id)->first();

        }

        return  $sve;
    }


}
