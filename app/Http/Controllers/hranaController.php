<?php


namespace App\Http\Controllers;


use App\Models\slika;
use App\Models\HranaiPice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class hranaController extends \Illuminate\Routing\Controller
{

    public function getAll() {
        return HranaiPice::all();
    }

    public  function getId($id){
        return HranaiPice::find($id);
    }
    public function delAll(){
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


        $validatedData = $request->validate([
            'slike' => 'required',
            'slike.*' => 'mimes:jpg,png,jpeg,gif,svg'
        ]);
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

        return redirect('upload-multiple-image')->with('status', 'Multiple Image has been uploaded into db and storage directory');


    }}
