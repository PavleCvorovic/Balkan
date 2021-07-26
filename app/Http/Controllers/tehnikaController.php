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
    return tehnikapolja::all();
    }

    public  function getId($id){
        return tehnikapolja::find($id);
    }
    public function delAll(){
        DB::select('delete  from tehnikapolja');
        return tehnikapolja::all();
    }
    public function delId($id){
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


        $validatedData = $request->validate([
            'slike' => 'required',
            'slike.*' => 'mimes:jpg,png,jpeg,gif,svg'
        ]);
        if ($request->hasfile('slike')) {
            foreach ($request->file('slike') as $key => $file) {
                $path = $file->store('public/file');
                $name = $file->getClientOriginalName();
                $slika=new slika();
                $slika->slika_id=$zadnji;
                $slika->url=$name;
                $slika->save();

            }
        }
echo 'ja';
        return redirect('upload-multiple-image')->with('status', 'Multiple Image has been uploaded into db and storage directory');


    }}
