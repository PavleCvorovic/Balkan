<?php


namespace App\Http\Controllers;
use App\Models\slika;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\tehnikapolja;
use Illuminate\Support\Facades\DB;

class tehnikaController extends Controller
{

    public function getAll() {
        $svi = tehnikapolja::all();
        for ($i = 0; $i < sizeof($svi); $i++) {
            $svi[$i]->slika = slika::where('slika_tehnika', $svi[$i]->id)->first();
        }
        return $svi;
    }

    public  function getId($id){
        return tehnikapolja::find($id);
        $rezultat=  DB::select('select url from slika where slika_tehnika='.$id);
        $rezultat1->podaci=$rezultat;
        return $rezultat1;
    }
    public function delAll(){
        DB::select('delete from slika where slika_tehnika>=1 ');
        DB::select('delete  from tehnikapolja');
        return tehnikapolja::all();
    }
    public function delId($id){
        DB::select('delete  from slika where slika_tehnika='.$id);
        DB::select('delete  from tehnikapolja where id='.$id);
        return tehnikapolja::all();
    }
    public function addPost(Request $request)
    {
        $produkt = new tehnikapolja();
        $produkt->tehnika_vrsta = $request->tehnika_vrsta;
        $produkt->naziv = $request->naziv;
        $produkt->opis = $request->opis;
        $produkt->stanje = $request->stanje;
        $produkt->lokacija = $request->lokacija;
        $produkt->kontakt = $request->kontakt;
        $produkt->cijena = $request->cijena;
        $produkt->sirina = $request->sirina;
        $produkt->duzina = $request->duzina;
        $produkt->user = $request->user;
        $produkt->karakteristike = $request->karakteristike;
        $produkt->godina_proizvodnje = $request->godina_proizvodnje;
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
                $slika->slika_tehnika=$zadnji;
                $slika->url=$name;
                $slika->save();

            }
        }

    return tehnikapolja::all();


    }
    public function modPostbyId(Request $request){
        $post= tehnikapolja::find($request->id);
        $post->tehnika_vrsta = $request->tehnika_vrsta;
        $post->naziv = $request->naziv;
        $post->opis = $request->opis;
        $post->stanje = $request->stanje;
        $post->lokacija = $request->lokacija;
        $post->kontakt = $request->kontakt;
        $post->cijena = $request->cijena;
        $post->sirina = $request->sirina;
        $post->duzina = $request->duzina;
        $post->user = $request->user;
        $post->karakteristike = $request->karakteristike;
        $post->godina_proizvodnje = $request->godina_proizvodnje;
        $post->save();


        return tehnikapolja::all();
    }


}
