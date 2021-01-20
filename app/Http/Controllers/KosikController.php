<?php

namespace App\Http\Controllers;

use App\Models\Produkt;


class KosikController extends Controller
{
    protected function kontrola() {
        $kosik = session('kosik');
        $kosik2 = [];
        $kosik2["total"] = 0;
        foreach ($kosik as $key => $value) {
            if ($key != "total" && !Produkt::find($key)->vymazane) {
                $kosik2[$key] = $value;
                $kosik2["total"] += $value["mnozstvo"] * $value["cena"];
            }
        }
        request()->session()->forget("kosik");
        request()->session()->put("kosik",$kosik2);
    }

    public function index() {
        $kosik = [];
        $produktid = [];
        if (request()->session()->has("kosik")) {
            $this->kontrola();
            $kosik = session('kosik');
            foreach ($kosik as $key => $value) {
                array_push($produktid, $key);
            }
        }
        $produkty = Produkt::find($produktid);
        return view ("kosik.index", compact("produkty", "kosik"));
    }

    public function store() {
        $produktid = request()->produktid;
        $produkt = Produkt::find($produktid);
        if ($produkt) {
            $item = [];
            $item["id"] = $produktid;
            $item["mnozstvo"] = 1;
            $item["cena"] = $produkt->cena;
            $najdeny = false;
            $kosik2 = [];
            $kosik2["total"] = 0;
            if (request()->session()->has("kosik")) {
               $kosik = request()->session()->get("kosik");
               foreach ($kosik as $i => $value) {
                   if ($item["id"] == $i && !$najdeny) {
                       $najdeny = true;
                       $value["mnozstvo"]++;

                   }
                   if ($i != "total") {
                       $kosik2["total"] += $value["mnozstvo"] * $value["cena"];
                       $kosik2[$i] = $value;
                   }
               }
            }
            if (!$najdeny) {
                $kosik2[$item["id"]] = [
                    "mnozstvo" => $item["mnozstvo"],
                    "cena" => $item["cena"]
                ];
                $kosik2["total"] += $item["mnozstvo"] * $item["cena"];
            }
            request()->session()->forget("kosik");
            request()->session()->put("kosik",$kosik2);
        }
        //$kosik = request()->session()->get("kosik");
        //foreach ($kosik as $i => $value) {
            //echo $i." ".$value["mnozstvo"]." ".$value["cena"]."<br>";
        //}
        //return redirect('/kosik');
        return "Produkt bol pridaný do košíka";
    }

    public function update() {
        $mnozstvo = request()->mnozstvo;
        $produktid = request()->produktid;
        if(is_numeric($mnozstvo) && strpos($mnozstvo, ".") === false) {
            if ($mnozstvo > 0) {
                if (request()->session()->has("kosik")) {
                    $kosik = request()->session()->get("kosik");
                    $kosik2 = [];
                    $kosik2["total"] = 0;
                    foreach ($kosik as $i => $value) {
                        if ($i == $produktid) {
                            $kosik2[$i] = [
                                "mnozstvo" => $mnozstvo,
                                "cena" => $value["cena"]
                            ];
                            $kosik2["total"] += $mnozstvo * $value["cena"];
                        } else {
                            if ($i != "total") {
                                $kosik2["total"] += $value["mnozstvo"] * $value["cena"];
                                $kosik2[$i] = $value;
                            }
                        }
                    }

                    request()->session()->forget("kosik");
                    request()->session()->put("kosik",$kosik2);
                }
                return "Kosik updatnuty";
            }
            return "Zadal si množstvo menšie ako 1";
        }
        return "Množstvo musí byť celé číslo";
    }

    public function destroy() {
        $produktid = request()->produktid;
        if (request()->session()->has("kosik")) {
            $kosik = request()->session()->get("kosik");
            $kosik2 = [];
            $kosik2["total"] = 0;
            foreach ($kosik as $i => $value) {
               if ($i != $produktid) {
                   if ($i != "total") {
                       $kosik2[$i] = $value;
                       $kosik2["total"] += $value["mnozstvo"] * $value["cena"];
                   }
               }
            }
            request()->session()->forget("kosik");
            request()->session()->put("kosik",$kosik2);
        }
        //$kosik = request()->session()->get("kosik");
        //foreach ($kosik as $i => $value) {
            //echo $i." ".$value["mnozstvo"]." ".$value["cena"]."<br>";
        //}
        return "Produkt bol vymazaný z košíka";
    }
}
