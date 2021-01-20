<?php

namespace App\Http\Controllers;

use App\Models\Kategoria;
use App\Models\Produkt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProduktController extends Controller
{
    public function index() {
        $produkty = Produkt::where("vymazane","=",false)->paginate(8);
        $zobraz = false;
        return view ("produkt.index", compact("produkty", "zobraz"));
    }

    public function show(Produkt $produkt) {
        if ($produkt->vymazane)
            abort(404);
        return view ("produkt.show", compact("produkt"));
    }

    public function getByKategoria(Kategoria $kategoria) {
        $zobraz = false;
        $produkty = $kategoria->produkty()->where("vymazane","=",false)->paginate(8);
        return view ("produkt.getByKategoria", compact("produkty", "kategoria","zobraz" ));
    }

    public function create() {
        $produkt = new Produkt();
        $kategorie = Kategoria::all();
        return view ("produkt.create", compact("kategorie","produkt"));
    }

    public function store() {
        request()->validate([
            "kategoria" => "required"
        ]);
        $produkt = Produkt::create(request()->validate([
            'nazov' => 'required',
            'cena' => 'required|numeric',
            'popis' => 'required|min:10',
            'obrazok' => 'required|file|image'
        ]));
        $produkt->kategorie()->sync(request()->kategoria);
        $dest = public_path('/storage/obrazky_produkt/');
        $img = request()->file('obrazok');
        $image_name = Str::random(16) .'.'.$img->extension();
        $image = Image::make($img->path());
        $image->resize(900, 600)->save($dest . $image_name);
        $produkt->update([
            'obrazok' => ('obrazky_produkt/' . $image_name)
        ]);
        return redirect("/");
    }

    public function edit(Produkt $produkt) {
        $kategorie = Kategoria::all();
        return view ("produkt.edit", compact("produkt","kategorie"));
    }

    public function update(Produkt $produkt) {
        request()->validate([
            "kategoria" => "required"
        ]);
        $obrazok = $produkt->obrazok;
        $produkt->update(request()->validate([
            'nazov' => 'required',
            'cena' => 'required|numeric',
            'popis' => 'required|min:10',
            'obrazok' => 'sometimes|file|image',
            "vymazane" => "required"
        ]));

        $produkt->kategorie()->sync(request()->kategoria);
        if (request()->obrazok != null) {
            Storage::delete("public/".$obrazok);
            $dest = public_path('/storage/obrazky_produkt/');
            $img = request()->file('obrazok');
            $image_name = Str::random(16) .'.'.$img->extension();
            $image = Image::make($img->path());
            $image->resize(900, 600)->save($dest . $image_name);
            $produkt->update([
                'obrazok' => ('obrazky_produkt/' . $image_name)
            ]);
        }
        return redirect('/');
    }

    public function destroy(Produkt $produkt) {
        $produkt->update(["vymazane" => true]);
        return redirect('/');
    }

    public function indexAdmin() {
        $produkty = Produkt::paginate(6);
        $zobraz = true;
        return view ("produkt.index", compact("produkty","zobraz"));
    }
}
