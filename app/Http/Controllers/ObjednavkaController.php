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

    public function store() {
        if (request()->session()->has("kosik")) {
            $user = Auth::user();
            $kosik = session('kosik');
            $cena = $kosik["total"];
            $objednavka = $user->objednavky()->create([
                "meno" => $user->name,
                "cena" => $cena
            ]);
            $produktid = [];

            foreach ($kosik as $key => $value) {
                if ($key != "total") {
                    array_push($produktid, $key);
                }
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
