<?php


namespace App\Http\Controllers;


use App\Models\slika;
use App\Models\nekretninepolja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class nekretnineController extends Controller
{
    public function getAll() {
    return nekretninepolja::all();
}

    public  function getId($id){
    return nekretninepolja::find($id);
}
    public function delAll(){
    DB::select('delete  from nekretninepolja');
    return nekretninepolja::all();
}
    public function delId($id){
    DB::select('delete  from slika where slika_nekretnine='.$id);
    DB::select('delete  from nekretninepolja where id='.$id);
    return nekretninepolja::all();
}
    public function addPost(Request $request)
{
    $produkt = new nekretninepolja();
    $produkt->nekretnine_vrsta = $request->nekretnine_vrsta;
    $produkt->naziv = $request->naziv;
    $produkt->kvadratura = $request->kvadratura;
    $produkt->opis = $request->opis;
    $produkt->tip_vlasnistva = $request->tip_vlasnistva;
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
            $slika->slika_nekretnine=$zadnji;
            $slika->url=$name;
            $slika->save();

        }
    }

    return redirect('upload-multiple-image')->with('status', 'Multiple Image has been uploaded into db and storage directory');


}}
