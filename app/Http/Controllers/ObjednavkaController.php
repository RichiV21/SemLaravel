<?php

namespace App\Http\Controllers;

use App\Models\Produkt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ObjednavkaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $objednavky = Auth::user()->objednavky;
        return view ("objednavka.index", compact("objednavky"));
    }

    public function show($id) {
        $objednavka = Auth::user()->objednavky()->find($id);
        return view ("objednavka.show" ,compact("objednavka"));
    }

    protected function cenaKosika() {
        $cena = 0;
        $kosik = request()->session()->get("kosik");
        foreach ($kosik as $i => $value) {
            $cena += ($value["cena"] * $value["mnozstvo"]);
        }
        return $cena;
    }

    public function store() {
        if (request()->session()->has("kosik")) {
            $user = Auth::user();
            $cena = $this->cenaKosika();
            $objednavka = $user->objednavky()->create([
                "meno" => $user->name,
                "cena" => $cena
            ]);
            $produktid = [];
            $kosik = session('kosik');
            foreach ($kosik as $key => $value) {
                array_push($produktid, $key);
            }
            $produkty = Produkt::find($produktid);
            $syncData = [];
            foreach ($produkty as $produkt) {
                $syncData[$produkt->id] = [
                    "cena" => $kosik[$produkt->id]["cena"],
                    "mnozstvo" => $kosik[$produkt->id]["mnozstvo"]
                ];
            }
            $objednavka->produkty()->syncWithoutDetaching($syncData);
            request()->session()->forget("kosik");
            return redirect('/objednavky');
        }
    }
}
