@extends('layouts.app')

@section('content')

@if($objednavka)

<div class="container">
        <h2>Objednávka číslo {{$objednavka->id}}</h2>
                <div class="row nadpis">
                    <h4 class="col-2"></h4>
                    <h4 class="col-5">Názov</h4>
                    <h4 class="col-2">Množstvo</h4>
                    <h4 class="col-3">Cena za kus</h4>
                    <h4 class="col-2"></h4>
                </div>
    @forelse($objednavka->produkty as $produkt)
                    <div class="row riadok">
                        <a class="col-2" href="/produkt/{{$produkt->id}}"><img class="card-img kosikImg " src="/storage/{{$produkt->obrazok}}" alt=""></a>
                        <h4 class="card-title borderKosik col-5" >
                            <a href="/produkt/{{$produkt->id}}">{{$produkt->nazov}}</a>
                        </h4>
                        <h5 class="borderKosik col-2">{{$produkt->pivot->mnozstvo}}ks</h5>
                        <h5 class="borderKosik col-3">{{$produkt->cena}}€</h5>
                    </div>
    @empty
        <p>Ziadne produkty v objednavke</p>
    @endforelse
            </div>
        </div>
    </div>
</div>
@else
    <p>Objednavka sa nenašla</p>
@endif

@endsection
