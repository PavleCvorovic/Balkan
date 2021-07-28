<?php


namespace App\Http\Controllers;


use App\Models\slika;
use App\Models\HranaiPice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class hranaController extends \Illuminate\Routing\Controller
{

    public function getAll() {
        $svi = HranaiPice::all();
        for ($i = 0; $i < sizeof($svi); $i++) {
            $svi[$i]->slika = slika::where('slika_hrana', $svi[$i]->id)->first();
        }
        return $svi;
    }

    public  function getId($id){
        return HranaiPice::find($id);
        $rezultat=  DB::select('select url from slika where slika_hrana='.$id);
        $rezultat1->podaci=$rezultat;
        return $rezultat1;
    }
    public function delAll(){
        DB::select('delete from slika where slika_hrana>=1 ');
        DB::select('delete  from hranapolja');
        return HranaiPice::all();
    }
    public function delId($id){
        DB::select('delete  from slika where slika_hrana='.$id);
        DB::select('delete  from hranapolja where id='.$id);
        return HranaiPice::all();
    }
    public function addPost(Request $request)
    {
        $produkt = new HranaiPice();
        $produkt->hrana_vrsta = $request->hrana_vrsta;
        $produkt->kolicina = $request->kolicina;
        $produkt->naziv = $request->naziv;
        $produkt->opis = $request->opis;
        $produkt->domace = $request->domace;
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
                $slika->slika_hrana=$zadnji;
                $slika->url=$name;
                $slika->save();

            }
        }

 return HranaiPice::all();


    }
    public function modPostbyId(Request $request){
        $post= HranaiPice::find($request->id);

        $post->hrana_vrsta = $request->hrana_vrsta;
        $post->kolicina = $request->kolicina;
        $post->naziv = $request->naziv;
        $post->opis = $request->opis;
        $post->domace = $request->domace;
        $post->lokacija = $request->lokacija;
        $post->kontakt = $request->kontakt;
        $post->cijena = $request->cijena;
        $post->sirina = $request->sirina;
        $post->duzina = $request->duzina;
        $post->user = $request->user;


        $post->save();
        return HranaiPice::all();
    }
}
